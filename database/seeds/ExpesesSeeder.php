<?php

use Illuminate\Database\Seeder;

class ExpesesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('expenses')->delete();
        $expense = new \App\Expense();
        $expense->expense_name = 'Fuel';
        $expense->code = 'FUEL';
        $expense->amount_type = 'Custom';
        $expense->status = true;
        $expense->amount = '0';
        $expense->save();

    }
}
