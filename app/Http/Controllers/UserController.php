<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\UserHasMenu;
use App\Models\UserType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::paginate(env('PAGINATE'));
        return view('users.index',['users'=> $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {         

        return view('users.create', [
            'types' => UserType::all(),
            'branches' => Branch::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:100|unique:users',
            'password' => 'required|string|min:8'
        ]);

        DB::beginTransaction();
        try {
            
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'user_type_id' => $request->user_type_id,
                'branch_id' => $request->branch_id,
                'password' => Hash::make($request->password),
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'បញ្ចូលថ្មីជោគជ័យ!');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'មិនអាចបញ្ចូលថ្មីបាន '.$ex->getMessage());
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         
        return view('users.edit', [
            'types' => UserType::all(),
            'branches' => Branch::all(),
            'user'  => User::find($id)
        ]);
    }

    
    public function update(Request $request, $id)
    {    
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:100|unique:users'. ',id,' . $id,
            'password' => 'nullable|string|min:8'
        ]);

        DB::beginTransaction();
        try {
            $user = User::find($id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->user_type_id = $request->user_type_id;
            $user->branch_id = $request->branch_id;
            if(trim($user->password) != null){
                $user->password = Hash::make($request->password);
            }            
            $user->save();           
            DB::commit();
            return redirect()->back()->with('success', 'កែប្រែបានជោគជ័យ!');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'កែប្រែបានមិនបានជោគជ័យ! '.$ex->getMessage());
        }
    }

    public function destroy($id)
    {
        if(!auth()->user()->user_type_id ){
            return view('errors.403');    
        }

        User::find($id)->delete();
        return redirect()->route('user.index');
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        $user = User::find(auth()->user()->id);
        $user->name = $request->name;

        if ($user->password != $request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('profile');
    }
}