<?php

namespace App\Http\Services;

use App\Models\Guarantor;
use Carbon\Carbon;
use App\Enums\ClientStatusEnum;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClientService
{


    private function generateClientCode()
    {
//        $count = DB::table('clients')
//        ->where('branch_id', auth()->user()->branch_id)
//        ->count();
//        $count = auth()->user()->branch_id ? DB::table('clients')
//        ->where('branch_id', auth()->user()->branch_id)
//        ->count(): Client::count();
        $count= DB::table('clients')->max('code');
//        $code = (168 + $count + 1);
        $code = $count +1;
        return str_pad($code, 5, '0', STR_PAD_LEFT);
    }

    public function checkExistClient($request){
        $client = Client::where(DB::raw('trim(lower(name_en))'), '=', Str::lower(trim($request->loaner_name_en)))
        ->where('village_id', $request->loaner_village_id)
        ->first();
        if($client){
            if($request->client_id == $client->id){
                return false;
            }
        }
        return $client;
    }

    public function createClient($req)
    {
        $client = Client::find($req->client_id);
        if(!$client){
            $client = new Client();
            $client->code = $this->generateClientCode();
            // new client is client do new loan first time
            $client->is_new = 1;
        }else{
            $client->is_new = 0;
        }

        $client -> name_en = $req->loaner_name_en;
        $client -> name_kh = $req->loaner_name_kh;
        $client -> date_of_birth = $req->loaner_date_of_birth;
        $client -> phone_number = $req -> loaner_phone_number;
        $client -> document_type_id = $req -> loaner_document_type;
        $client -> document_number = $req -> loaner_document_number;
        $client -> sex = $req -> loaner_sex;
        $client -> province_id = $req -> loaner_province_id;
        $client -> district_id = $req -> loaner_district_id;
        $client -> commune_id = $req -> loaner_commune_id;
        $client -> village_id = $req -> loaner_village_id;
        $client->user_id = auth()->user()->id??null;
        $client->branch_id = $req->branch_id;
        $client->status = ClientStatusEnum::ACTIVE;
        $client->save();
        return $client;
    }

    public function getClients(Request $request){
        $query = Client::query();

        if($request->code || $request->name_kh || $request->name_en){
            $query->when($request->code, function ($q) use ($request) {
                $code = mb_strtoupper(trim($request->code));
                $q->where('code', $code);
            });

            $query->when($request->name_kh, function ($q) use ($request) {
                $nameKh = mb_strtoupper(trim($request->name_kh));
                $q->where('name_kh', 'like', '%' . $nameKh . '%');
            });

            $query->when($request->name_en, function ($q) use ($request) {
                $nameEn = mb_strtoupper(trim($request->name_en));
                $q->where('name_en', 'like', '%' . $nameEn . '%');
            });
        }else{
            $query->where('id',  '*');
        }
        return $query->get();
    }

    public function getClientById($id)
    {
        return Client::find($id);
    }
}
