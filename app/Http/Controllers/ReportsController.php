<?php

namespace App\Http\Controllers;

use App\Journal;
use App\Masterfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getDailyReport(){
        $daily_reports = DB::table('daily_report_view')
            ->where('transaction_date',date('Y-m-d'))
            ->get();
        return view('reports.daily-report',array(
            'daily_reports'=>$daily_reports
        ));
    }

    public function viewDailyReport($id){
        $daily_reports = DB::table('daily_report_view')
            ->where('id',$id)
            ->get();
        return view('reports.daily-report',array(
            'daily_reports'=>$daily_reports
        ));
    }

    public function viewAllTransactionsReport(){
        $reports =DB::table('on_demand_daily_report')->get();
//        print_r($reports);
        $drivers = Masterfile::where('user_role','Driver')->get();
        return view('reports.on-demand-report',array(
            'reports'=>$reports,
            'drivers'=>$drivers
        ));
    }

    public function getSupplierReport($id){
        if(!empty($id)) {
            $reports = DB::table('supplier_report_view')
                ->where('id', $id)->get();
            return view('reports.supplier-report',array(
                'reports'=>$reports
            ));
        }
        return view('reports.supplier-report');
    }

    public function getFilteredData(Request $request){
        if(isset($request->date_range)){
            $data = explode('-',$request->date_range);
            $date1 = strtotime($data[0]);
            $date2 = strtotime($data[1]);

//            die;
//            $date_f = explode('/',$date1);
//            $date_f2 = explode('/',$date2);
//             $final_date2 = $date_f2[1].'/'.$date_f2[0].'/'.$date_f2[2];
//             $final_date1 = $date_f[1].'/'.$date_f[0].'/'.$date_f[2];
//            echo strtotime($final_date1);
//            echo strtotime($final_date2);
//            die;
//            echo strtotime("30/11/2016");


            $reports = DB::table('on_demand_daily_report')
                ->whereBetween('transaction_date', [$date1, $date2])
                ->get();
//            var_dump($reports);die;
            $drivers = Masterfile::where('user_role','Driver')->get();
            return view('reports.on-demand-report',array(
                'reports'=>$reports,
                'drivers'=>$drivers
            ));
//            return redirect('all-transactions');
        }elseif (isset($request->driver_id)){
//            var_dump($_POST);
            $reports = DB::table('on_demand_daily_report')
                ->where('driver_id',$request->driver_id)
                ->get();
//            print_r($reports);
            $drivers = Masterfile::where('user_role','Driver')->get();
            return view('reports.on-demand-report',array(
                'reports'=>$reports,
                'drivers'=>$drivers
            ));
        }
    }

    public function accountStatus(){
        $journals = Journal::all();
        return view('reports.account_status',array(
            'journals'=> $journals
        ));
    }
}
