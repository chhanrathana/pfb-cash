<?php
namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    
    public function index()
    {
        $branches = Branch::paginate(env('PAGINATE'));
        return view('master-data.branches.index',['branches'=> $branches]);
    }
    
    public function create()
    {            
        return view('master-data.branches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:250|unique:branches',
            'name' => 'required|string|max:250',
            'description' => 'required|string|max:500',
        ]);

        DB::beginTransaction();
        try {
             Branch::create([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description,                
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
        $branch = Branch::where('id', $id)->first();
        
        return view('master-data.branches.edit', [
            'branch' => $branch,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|string|max:250|unique:branches'. ',id,' . $id,
            'name' => 'required|string|max:250',            
            'description' => 'required|string|max:500',
        ]);

        DB::beginTransaction();
        try {
            $branch = Branch::find($id);
            $branch->code = $request->code;
            $branch->name = $request->name;            
            $branch->description = $request->description;
            $branch->save();        
            DB::commit();
            return redirect()->back()->with('success', 'កែប្រែបានជោគជ័យ!');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'កែប្រែបានមិនបានជោគជ័យ! '.$ex->getMessage());
        }
    }

    public function destroy($id)
    {        
        Branch::find($id)->delete();
        return redirect()->route('master-data.branch.index');
    }   
}