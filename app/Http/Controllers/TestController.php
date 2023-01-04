<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class TestController extends Controller
{
    //
    public function any(Request $req){
        $res = DB::table('clients')->max('code');
       dd($res+1);
    }
}
