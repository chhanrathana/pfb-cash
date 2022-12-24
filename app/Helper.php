<?php

use App\Models\PaymentTransaction;
use Carbon\Carbon;

function convertDaytoKhmer($weekDay)
{
    $day = ['Sun' => 'អាទិត្យ', 'Mon' => 'ច័ន្ទ', 'Tue' => 'អង្គារ៍', 'Wed' => 'ពុធ', 'Thu' => 'ព្រ.ហ', 'Fri' => 'សុក្រ', 'Sat' => 'សៅរ៍'];
    return $day[$weekDay];
}


function currentParamter(){	
	return  str_replace(url()->current(),'',url()->full());
}


function getBackupData($name){
    $file = json_decode(file_get_contents(base_path('database/seeders/Data/20220520_kunpukqp_loan.json')), true);        
    foreach ($file as $item) {            
        if($item['type'] == 'table' && $item['name'] == $name){
            return $item['data'];                
        }
    }
}

function paymentTransaction($payment, $transactionAmount, $type = 'interest'){
        
    // payment trx for income report
    $trx = new PaymentTransaction();
    $trx->payment_id = $payment->id;
    $trx->type = $type;

    $paidDate = $payment->last_payment_paid_date?$payment->last_payment_paid_date:$payment->payment_date;
    
    $trx->transaction_datetime = Carbon::createFromFormat('d/m/Y', $paidDate)->format('Y-m-d');
    $trx->transaction_amount = $transactionAmount;

    $sumLastTrxDeductAmount = PaymentTransaction::where('payment_id', $payment->id)->sum('deduct_amount');
    $sumLastTrxInterestAmount = PaymentTransaction::where('payment_id', $payment->id)->sum('interest_amount');
    $pendingDeductAmount = ($payment->deduct_amount - $sumLastTrxDeductAmount);

    // block amount for principal loan first (deduct amount)
    // the raise of amount will separate into interest  
    if($pendingDeductAmount > $trx->transaction_amount){
        $trx->deduct_amount = $trx->transaction_amount;
        $trx->interest_amount = 0 ;
        $trx->revenue_amount = 0;
        $trx->commission_amount = 0;
    }                
    else{
        $trx->deduct_amount = $pendingDeductAmount;
        $trx->revenue_amount = ($trx->transaction_amount - $pendingDeductAmount);
        
        if($payment->interest_amount > $sumLastTrxInterestAmount){
            
            if($trx->revenue_amount > $payment->interest_amount){
                $trx->interest_amount = $payment->interest_amount - $sumLastTrxInterestAmount;
            }else{
                $trx->interest_amount =  $trx->revenue_amount;  
            }
        }
        else{
            $trx->interest_amount = 0;
        }            
        $trx->commission_amount =  $trx->revenue_amount -  $trx->interest_amount;
    }
    $trx->save();
}