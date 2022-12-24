<?php

namespace App\Http\Controllers\FinancialReports;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\ExpenseItem;
use App\Models\ExpenseType;
use Carbon\Carbon;


class ExpenseController extends Controller
{
    
    public function index(Request $request)
    {  
        $fromDate = $request->from_date ? Carbon::createFromFormat('d/m/Y', $request->from_date):Carbon::now()->firstOfMonth();        
        $toDate = $request->to_date ? Carbon::createFromFormat('d/m/Y', $request->to_date): Carbon::now()->endOfMonth();
        $branchId = $request->branch_id;
        $expenseTypeId = $request->expense_type_id;

        $query = ExpenseItem::query();

        $query->when($branchId && $branchId <> 'all' , function($query) use($branchId){
            $query->where('branch_id', $branchId);
         });

       $query->when($expenseTypeId  && $expenseTypeId <> 'all' , function($query) use($expenseTypeId){
           $query->where('expense_type_id', $expenseTypeId);
        });

       $query->when($fromDate, function($query) use($fromDate){
           $query->whereDate('expense_datetime','>=', $fromDate);
       });

       $query->when($toDate, function($query) use($toDate){
           $query->whereDate('expense_datetime','<=', $toDate);
        });
       
       
       $query->orderBy('expense_datetime','desc');
       $expenses = $query->get();
       
       return view('report-financials.expenses.index',[
            'expenses'=> $expenses,
            'fromDate' => $fromDate->format('d/m/Y'),
            'toDate' => $toDate->format('d/m/Y'),
            'types' => ExpenseType::all(),
            'branches' => Branch::all()
        ]);

    }

    
}