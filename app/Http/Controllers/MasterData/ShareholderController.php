<?php
namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shareholder;
use Illuminate\Support\Facades\DB;

// to do >> current not use
class ShareholderController extends Controller
{
    
    public function index()
    {
        $shareholders = Shareholder::paginate(env('PAGINATE'));
        return view('shareholders.index',['shareholders'=> $shareholders]);
    }
  
    public function create()
    {            

        return view('shareholders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_kh' => 'required|string|max:250',
            'name_en' => 'required|string|max:250'
        ]);

        DB::beginTransaction();
        try {
             Shareholder::create([
                'name_kh' => $request->name_kh,
                'name_en' => $request->name_en,                
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
        $shareholder = Shareholder::where('id', $id)->first();
        
        return view('shareholders.edit', [
            'shareholder' => $shareholder,
        ]);
    }
   
    public function update(Request $request, $id)
    {
        $request->validate([
            // 'code' => 'required|string|max:250|unique:shareholders'. ',id,' . $id,
            'name_kh' => 'required|string|max:250',
            'name_en' => 'required|string|max:250'
        ]);

        DB::beginTransaction();
        try {
            $Shareholder = Shareholder::find($id);
            // $Shareholder->code = $request->code;
            $Shareholder->name_kh = $request->name_kh;            
            $Shareholder->name_en = $request->name_en;
            $Shareholder->save();        
            DB::commit();
            return redirect()->back()->with('success', 'កែប្រែបានជោគជ័យ!');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'កែប្រែបានមិនបានជោគជ័យ! '.$ex->getMessage());
        }
    }

    public function destroy($id)
    {
        Shareholder::find($id)->delete();
        return redirect()->route('shareholder.index');
    }   
}