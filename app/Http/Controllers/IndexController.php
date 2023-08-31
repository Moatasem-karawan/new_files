<?php

namespace App\Http\Controllers;




use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class IndexController extends Controller
{
    public function check_route (){
        if (Request::isMethod('post'))
        {
            return "post";
        }
        if (Request::isMethod('get'))
        {

             return $this->test2();
        }
    }
public function test2(){
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
        'id'        => "407164383",
        'type'  => "1"
    ]);
    if (is_null($response["psarchive"] ) ){
      return 'not found';
    }else{;
    //print_r($response['psarchive'][0]['name']);
    return response()->json(["states"=>true,'data'=>$response["psarchive"][0]["hae"]]);}
}
    function test(){

        $headers = array
        (
            'Authorization' =>"Basic cHNBcmNoZWZOZXc6cHMxMjNQc0F0SG9tZTk4Nw==",
            'Content-Type'  => 'application/x-www-form-urlencoded; charset=UTF-8',
            "cache-control: no-cache",
            'User-Agent'  => 'Dalvik/2.1.0 (Linux; U; Android 9; SM-J701F Build/PPR1.180610.011)',
            'Host'  => 'zezsoft.xyz',
            'Connection'  => 'Keep-Alive',
            'Accept-Encoding'  => 'gzip',
            'Content-Length'  => '20',
        );

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://zezsoft.xyz/PSApp/PsArchive/getIDP.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "type=407164383&id=1",
            CURLOPT_HTTPHEADER => $headers,
        ));
        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        if (!$err)
        {
            var_dump($response);}


//        $fields = array
//        (
//            'id'        => "407164383",
//            'type'  => "1"
//        );

//        $headers = array
//        (
//            'Authorization' =>"Basic cHNBcmNoZWZOZXc6cHMxMjNQc0F0SG9tZTk4Nw==",
//            'Content-Type'  => 'application/x-www-form-urlencoded; charset=UTF-8',
//            "cache-control: no-cache",
//            'User-Agent'  => 'Dalvik/2.1.0 (Linux; U; Android 9; SM-J701F Build/PPR1.180610.011)',
//            'Host'  => 'zezsoft.xyz',
//            'Connection'  => 'Keep-Alive',
//            'Accept-Encoding'  => 'gzip',
//            'Content-Length'  => '20',
//        );
        //#Send Reponse To FireBase Server
//        $ch = curl_init();
//        curl_setopt( $ch,CURLOPT_URL, 'http://zezsoft.xyz/PSApp/PsArchive/getIDP.php' );
//        curl_setopt( $ch,CURLOPT_POST, true );
//        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
////        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
////        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
//        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
//        $result = curl_exec($ch );
//       print_r( $result);
//        curl_close( $ch );


    }
}
