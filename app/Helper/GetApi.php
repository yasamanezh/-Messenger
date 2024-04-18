<?php

namespace App\Helper;


use App\Models\User;
use Carbon\Carbon;

class GetApi {

    public function get_result($method, $post=null ) {

        $user = User::where('id', auth()->user()->id)->first();
        $url ='https://api.commerce.coinbase.com'.'/'.$method.'/';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);



        if($post){
        $post = json_encode($post);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_POST, 1);
         }

        $headers = array();

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($result,true);

        return $response;
    }


}
