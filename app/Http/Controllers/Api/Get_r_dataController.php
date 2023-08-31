<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\handel_id_number;
use App\Http\Resources\handel_name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;


class Get_r_dataController extends Controller
{
    public function get_by_id_number(Request $request){

        $rules=[
            "id_number"=>"required|digits:9"
        ];

        $message=[
            "id_number.required"=>"رقم الهوية مطلوب ",
            "id_number.digits"=>"رقم الهوية يجب ان يتكون من 9 خانات",
//            "id_number.max"=>"رقم الهوية يجب ان يتكون من 9 خانات"
        ];

        $m1="required_key1:id_number";



        $validator=Validator::make($request->all(),$rules,$message);
        if ($validator->fails()){
            return response()->json(["status"=>false,"status_code"=>200,"errors"=>$validator->errors()->all(),"keys_request"=>[$m1]]);
        }
        else{


     $id=intval($request->id_number);
        $response = Http::withHeaders([
            'Authorization' =>"Basic cHNBcmNoZWZOZXc6cHMxMjNQc0F0SG9tZTk4Nw==",
            'Content-Type'  => 'application/x-www-form-urlencoded; charset=UTF-8',
            "cache-control: no-cache",
            'User-Agent'  => 'Dalvik/2.1.0 (Linux; U; Android 9; SM-J701F Build/PPR1.180610.011)',
            'Host'  => 'zezsoft.xyz',
            'Connection'  => 'Keep-Alive',
            'Accept-Encoding'  => 'gzip',
            'Content-Length'  => '20',

        ])->asForm()->post('http://zezsoft.xyz/PSApp/PsArchive/getIDP.php', [
            'id'        => $id,
            'type'  => "1"
        ]);
        if (is_null($response["psarchive"] ) ){
            return response()->json(["status"=>false,"status_code"=>200,"message"=>"not_found",'data'=>[]]);
        }else{;

            return response()->json(["status"=>true,"status_code"=>200,"message"=>"found",'data'=>new handel_id_number($response["psarchive"][0])]);}
    }}
    public function get_by_full_name(Request $request){
        $rules = [
            'person_name' => 'required|String',
            'family_name' => 'required|String',
        ];

        $messages = [
            'person_name.required' => "اسم الشخص  مطلوب",
            'person_name.String' => "اسم الشخص يجب ان يكون نص وليس رقم",

            'family_name.required' => "اسم العائلة مطلوب",
            'family_name.string' => "اسم العائلة يجب ان يكون نص وليس رقم",
        ];
        $m1="required_key1:person_name";

        $m2="required_key2:family_name";
        $m3="optional_key2:father_name";


        $validator = Validator::make($request->all(), $rules, $messages);
        $message_errors=$validator->errors()->all();


        if ($validator->fails()){
            return response()->json(["status"=>false,"error"=>$message_errors,"keys_request"=>[$m1,$m2,$m3]]);
        }
        else{

            if (isset($request->father_name) ){

                //name+dad+family
                if (is_null($request->father_name)){
                    return response()->json(["status"=>false,"error"=> "name father cant be empty"]);}
                else{
                $person_informatio=[
                    "name"        =>$request->person_name,
                    "father"  =>$request->father_name,
                    'family'  => $request->family_name,];
                $url='http://zezsoft.xyz/PSApp/PsArchive/getPFF.php';}
            }
        else{

            //name+family
            $person_informatio=[
                "name"=>$request->person_name,
                'family'  => $request->family_name,];
            $url='http://zezsoft.xyz/PSApp/PsArchive/getNF.php';


        }

        $response = Http::withHeaders([
            'Authorization' =>"Basic cHNBcmNoZWZOZXc6cHMxMjNQc0F0SG9tZTk4Nw==",
            'Content-Type'  => 'application/x-www-form-urlencoded; charset=UTF-8',
            "cache-control: no-cache",
            'User-Agent'  => 'Dalvik/2.1.0 (Linux; U; Android 9; SM-J701F Build/PPR1.180610.011)',
            'Host'  => 'zezsoft.xyz',
            'Connection'  => 'Keep-Alive',
            'Accept-Encoding'  => 'gzip',
            'Content-Length'  => '20',



        ])->asForm()->post($url,$person_informatio);
        if (is_null($response["psarchive"] ) ){
            return response()->json(["status"=>false,"status_code"=>200,"message"=>"not_found",'data'=>[]]);
        }else{;


            return response()->json(["status"=>true,"status_code"=>200,"message"=>"found",'data'=>handel_name::collection($response["psarchive"])]);}
    }}

}
