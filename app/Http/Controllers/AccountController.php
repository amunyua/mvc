<?php

namespace App\Http\Controllers;

use App\Bus;
use App\DailyBankAccumulations;
use App\DailyExpenses;
use App\DailyTransaction;
use App\Expense;
use App\Journal;
use App\Masterfile;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\InputOption;

class AccountController extends Controller
{
    private $_date;

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getAccounts(){
        $daily_trans = DailyTransaction::all();
        $buses = Bus::all();
        $drivers = Masterfile::where('user_role','Driver')->get();
        $conductors = Masterfile::where('user_role','Conductor')->get();
        $expenses = Expense::where('amount_type','Custom',['status','1'])->get();
        return view('configurations.account',array(
            'buses'=>$buses,
            'drivers'=>$drivers,
            'expenses'=>$expenses,
            'daily_trans'=>$daily_trans,
            'conductors'=>$conductors
        ));
    }

    public function storeTransaction(Request $request){
//        print_r($_POST);die;
        $this->validate($request, array(
            'vehicle'=>'required',
            'transaction_date'=>'required|unique:daily_transactions,transaction_date',
            'total_amount_collected'=>'required',
            'actual_banked'=>'required',
            'total_trips'=>'required',
            'conductor'=>'required'
        ));
//        echo $date =  date('Y-m-d', strtotime($request->transaction_date));
        $date = strtotime($request->transaction_date);
//        var_dump($request->transaction_date);die;
        echo $this->_date = strtotime($request->transaction_date);
//        echo date('Y-m-d',1477958400).'<br>';die;

        if(DB::transaction(function (){
            //store a transaction on the daily transactions table and return the transaction id
            $daily_transaction = new DailyTransaction();
            $daily_transaction->bus_id = Input::get('vehicle');
            $daily_transaction->transaction_date = $this->_date;
            $daily_transaction->driver_id = Input::get('driver_id');
            $daily_transaction->total_amount_collected = Input::get('total_amount_collected');
            $daily_transaction->total_trips = Input::get('total_trips');
            $daily_transaction->conductor_id = Input::get('conductor');
            $daily_transaction->save();
            //return the transaction id to be used in other tables

            $transaction_id =$daily_transaction->id;


            //prepare an array to store all expenses
            $all_expenses = array();

            //get all expenses that have a fixed amount
            $constant_expenses = Expense::where('amount_type','Fixed')->get();
            if(count($constant_expenses)){
                foreach($constant_expenses as $expense){
                    $all_expenses[]= array('expense'=>$expense->id,'amount'=>$expense->amount);
                }
            }
            //add expenses than have custom amount to all expenses array
            if(count($_POST)) {
                foreach ($_POST as $key => $post) {
                    if (is_numeric($key)) {
//                    echo $key.'   '.$post.'<br>';
                        $all_expenses[] = array('expense' => $key, 'amount' => $post);
                    }
                }
            }

            //save the expenses in expenses table with the transaction id

            //loop through all the expenses for that day
            if(count($all_expenses)) {
                foreach ($all_expenses as $expenses) {
                    $daily_expenses = new DailyExpenses();
                    $daily_expenses->transaction_id = $transaction_id;
                    $daily_expenses->expense_id = $expenses['expense'];
                    $daily_expenses->amount = $expenses['amount'];
                    $daily_expenses->save();
//                    echo $expense_id = $daily_expenses->id;
                }
            }

            //save bank details in the daily accumulations table
            $daily_bank_accumulation = new DailyBankAccumulations();
            $daily_bank_accumulation->transaction_id = $transaction_id;
            $daily_bank_accumulation->total_amount_collected = Input::get('total_amount_collected');
            $daily_bank_accumulation->actual_banked = Input::get('actual_banked');
            $daily_bank_accumulation->save();
//            echo $b = $daily_bank_accumulation->id;

            //record journal

            $journal = new Journal();
            $journal->bus_id = Input::get('vehicle');
            $journal->amount = Input::get('actual_banked');
            $journal->journal_date = Input::get('transaction_date');
            $journal->dr_cr = "CR";
            $journal->particulars = 'Income for '.Input::get('transaction_date');
            $journal->daily_transaction_id = $transaction_id;
            $journal->status = true;
            $journal->save();
        })){
        }
        Session::flash('success','The Transaction has been Created');
        return redirect('accounts');
    }
    public function deleteTransaction($id){
        $id = DailyTransaction::find($id);
        $id->delete();
        Session::flash('success','The transaction has been deleted');
        return redirect('accounts');
    }
}
