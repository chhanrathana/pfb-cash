<?php
namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Deposit;
use App\Models\Shareholder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{
    
    public function index(Request $request)
    {

        $branchId = $request->branch_id;

        $query = Deposit::query();
        $query->when($branchId, function($query) use($branchId){
            $query->where('branch_id', $branchId);
         });
    
        $deposits = $query->orderBy('deposit_datetime','desc')
        ->paginate(env('PAGINATE'));

        return view('master-data.deposits.index',[
            'deposits'=> $deposits,
            'branches' => Branch::all()
        ]);

    }
  
    public function create()
    {            
        return view('master-data.deposits.create',[
            'shareholders' => Shareholder::all(),
            'branches' => Branch::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
            'name_kh' => 'required|string|max:250',
            'name_en' => 'required|string|max:250',
            'deposit_amount' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {

            $shareholder = new Shareholder();
            $shareholder->name_kh  = $request->name_kh;
            $shareholder->name_en  = $request->name_en;
            $shareholder->save();

             Deposit::create([
                'branch_id' => $request->branch_id,
                'shareholder_id' => $shareholder->id,
                'deposit_amount' => $request->deposit_amount,
                'deposit_datetime' => Carbon::now()
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
        $deposit = Deposit::where('id', $id)->first();        
        
        return view('master-data.deposits.edit', [
            'deposit' => $deposit,
            'branches' => Branch::all()
        ]);
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'branch_id' => 'required',
            'shareholder_id' => 'required',
            'name_kh' => 'required|string|max:250',
            'name_en' => 'required|string|max:250',
            'deposit_amount' => 'required|numeric',            
        ]);

        DB::beginTransaction();
        try {            
            $deposit = Deposit::where('id', $id)->first();
            $deposit->branch_id = $request->branch_id;
            $deposit->shareholder_id = $request->shareholder_id;
            $deposit->deposit_amount = $request->deposit_amount;            
            $deposit->deposit_datetime = Carbon::now();
            $deposit->save();      
            
            $shareholder = Shareholder::find($request->shareholder_id);
            $shareholder->name_kh  = $request->name_kh;
            $shareholder->name_en  = $request->name_en;
            $shareholder->save();

            DB::commit();
            return redirect()->back()->with('success', 'កែប្រែបានជោគជ័យ!');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'កែប្រែបានមិនបានជោគជ័យ! '.$ex->getMessage());
        }
    }

    public function destroy($id)
    {
        $deposit = Deposit::find($id);
        $deposit->shareholder()->delete();
        $deposit->delete();
        
        return redirect()->route('master-data.deposit.index');
    }   
}