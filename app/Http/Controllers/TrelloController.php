<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TrelloController extends Controller
{
   public function login(Request $request){
        $url = 'https://api.trello.com/1/members/me?key='.$request->api_key.'&token='.$request->api_token;
       $response =  $this->curlHelper($url);
       $userInfo =  json_decode($response);

      if($userInfo){
          $data = [
            'api_key' => $request->api_key,
            'api_token' => $request->api_token,
            'user_id' => $userInfo->id,
          ];
          Session::put('data',$data);

         return redirect()->route('organizations');
      }else{
          Session::flash("message","Your api key or token Invalid");
          return redirect()->back();
      }


   }


   public function organizations(){

       return view('organization');
   }

   public function boards($id){
       $data = Session::get('data');
       $url = 'https://api.trello.com/1/organizations/'.$id.'/boards?key='.$data['api_key'].'&token='.$data['api_token'];
       $response =  $this->curlHelper($url);
       $boards =  json_decode($response);

       return view('board',compact('boards'));

   }


   public function curlHelper($url){
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_POST, 0);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

       $response = curl_exec ($ch);
       $err = curl_error($ch);  //if you need
       curl_close ($ch);

       return $response;
   }
}
