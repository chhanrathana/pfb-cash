<?php
namespace App\Http\Controllers\Expenses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\ExpenseItem;
use App\Models\ExpenseType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExpenseItemController extends Controller
{    
    public function index(Request $request)
    {
        
        $fromDate = $request->from_date ? Carbon::createFromFormat('d/m/Y', $request->from_date):Carbon::now()->firstOfMonth();        
        $toDate = $request->to_date ? Carbon::createFromFormat('d/m/Y', $request->to_date): Carbon::now()->endOfMonth();
        $branchId = $request->branch_id;
        $expenseTypeId = $request->expense_type_id;

        $query = ExpenseItem::query();

        $query->when($branchId, function($query) use($branchId){
            $query->where('branch_id', $branchId);
         });

       $query->when($expenseTypeId, function($query) use($expenseTypeId){
           $query->where('expense_type_id', $expenseTypeId);
        });

       $query->when($fromDate, function($query) use($fromDate){
           $query->where('expense_datetime','>=', $fromDate);
       });

       $query->when($toDate, function($query) use($toDate){
           $query->where('expense_datetime','<=', $toDate);
        });
       
       
       $query->orderBy('expense_datetime','desc');
       $expenses = $query->get();
       
        return view('expenses.expense-items.index',[
            'expenses'=> $expenses,
            'fromDate' => $fromDate->format('d/m/Y'),
            'toDate' => $toDate->format('d/m/Y'),
            'types' => ExpenseType::all(),
            'branches' => Branch::all()
        ]);
    }
  
    public function create()
    {            
        return view('expenses.expense-items.create',[
            'types' => ExpenseType::all(),
            'branches' => Branch::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([            
            'branch_id'         => 'required',
            'expense_type_id'   => 'required',            
            'expense_amount'    => 'required|numeric',
            'description'       => 'required|string|max:250',
        ]);
        
        DB::beginTransaction();
        try {
            ExpenseItem::create([
                'branch_id' => $request->branch_id,
                'expense_type_id' => $request->expense_type_id,
                'expense_amount' => $request->expense_amount,
                'description' => $request->description,                
                'expense_datetime' => Carbon::now()
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'បញ្ចូលថ្មីជោគជ័យ!');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'មិនអាចបញ្ចូលថ្មីបាន '.$ex->getMessage());
        }
    }
  
    public function edit($id)
    {
        $expense = ExpenseItem::where('id', $id)->first();        
        return view('expenses.expense-items.edit', [
            'expense' => $expense,
            'types' => ExpenseType::all(),
            'branches' => Branch::all()
        ]);
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'branch_id'         => 'required',
            'expense_type_id'   => 'required',            
            'expense_amount' => 'required|numeric',
            'description' => 'required|string|max:250',
        ]);

        DB::beginTransaction();
        try {
            $expense = ExpenseItem::find($id);
            $expense->branch_id = $request->branch_id;
            $expense->expense_type_id = $request->expense_type_id;
            $expense->expense_amount = $request->expense_amount;
            $expense->description = $request->description;
            $expense->expense_datetime = Carbon::now();
            $expense->save();        
            DB::commit();
            return redirect()->back()->with('success', 'កែប្រែបានជោគជ័យ!');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'កែប្រែបានមិនបានជោគជ័យ! '.$ex->getMessage());
        }
    }

    public function destroy($id)
    {
        ExpenseItem::find($id)->delete();
        return redirect()->route('expense.item.index');
    }   
}