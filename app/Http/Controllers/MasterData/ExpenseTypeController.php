<?php
namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExpenseType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExpenseTypeController extends Controller
{    
    public function index()
    {
        $expenses = ExpenseType::paginate(env('PAGINATE'));
        return view('master-data.expense-types.index',['expenses'=> $expenses]);
    }
  
    public function create()
    {            
        return view('master-data.expense-types..create');
    }

    public function store(Request $request)
    {
        $request->validate([            
            'name_kh' => 'required|string|max:250',
        ]);
        
        DB::beginTransaction();
        try {
             ExpenseType::create([
                'name_kh' => $request->name_kh,
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
        $expense = ExpenseType::where('id', $id)->first();        
        return view('master-data.expense-types.edit', [
            'expense' => $expense,
        ]);
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_kh' => 'required|string|max:250',
        ]);

        DB::beginTransaction();
        try {
            $expense = ExpenseType::find($id);
            $expense->name_kh = $request->name_kh;
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

        ExpenseType::find($id)->delete();
        return redirect()->route('master-data.expense-type.index');
    }   
}