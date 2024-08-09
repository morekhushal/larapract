<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanDetail;
use DB;
use Schema;

class LoanDetailController extends Controller
{
    public function loanDetails() {
        $data = LoanDetail::get();
        return view('loan_details', compact('data'));
    } 

    public function monthsDiff($min, $max) {
        $ts1 = strtotime($min);
        $ts2 = strtotime($max);

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);
        
        $diffMonths = (($year2 - $year1) * 12) + ($month2 - $month1);        
        return $diffMonths+1;
    }

    public function processData() {
        return view('processed_data');
        
    }
    function loadProcessData() {
        $loanDetails = DB::table('loan_details')->get();
        $oldestDate = DB::table('loan_details')->oldest('first_payment_date')->first();
        $latestDate = DB::table('loan_details')->latest('last_payment_date')->first();
        if($oldestDate && $latestDate) {
            $diffMonths = $this->monthsDiff($oldestDate->first_payment_date, $latestDate->last_payment_date);
          
            $time = strtotime($oldestDate->first_payment_date);

            //Schema
            Schema::dropIfExists('emi_details');
            Schema::connection('mysql')->create('emi_details', function($table) use($diffMonths, $time){
                $table->increments('id');
                $table->integer('clientid');
                for($i = 0; $i < $diffMonths; $i++) {
                    $final = date("Y_M", strtotime("+$i month", $time));
                    $table->decimal($final, 10, 2)->default(0);
                }
            });            
        }

        $data = [];
        foreach($loanDetails as $detail) {
            $diffMonths = $this->monthsDiff($detail->first_payment_date, $detail->last_payment_date);
            $time = strtotime($detail->first_payment_date);
            $loanEmi = $detail->loan_amount/$detail->num_of_payment;
            $dates = [];
            $totalEmi = 0;
            for($i = 0; $i < $diffMonths; $i++) {
                $emi = round($loanEmi, 2);
                if($i==($diffMonths-1)) {
                    $emi = round(($detail->loan_amount-$totalEmi), 2);
                }
                $totalEmi+=$emi;
                $dates = array_merge($dates, [date("Y_M", strtotime("+$i month", $time)) => $emi]);
            }
            $data = array_merge(['clientid' => $detail->clientid], $dates) ;
            DB::table('emi_details')->insert($data);
        };

        $loanData = DB::table('emi_details')->get();
        return view('load_processed_data', compact('loanData'));
    }
}
