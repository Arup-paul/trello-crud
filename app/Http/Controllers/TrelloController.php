<?php

namespace App\Http\Controllers;

use App\Service\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class TrelloController extends Controller
{
   public function login(Request $request){
       $request->validate([
           'api_key' => 'required',
           'api_token' => 'required'
       ]);
        $url = 'https://api.trello.com/1/members/me?key='.$request->api_key.'&token='.$request->api_token;
       $curlData = new Service();
       $response = $curlData->curlData($url);
       $userInfo =  json_decode($response);

       $organizationUrl = 'https://api.trello.com/1/members/'.$userInfo->id.'/organizations?key='.$request->api_key.'&token='.$request->api_token;
       $organizationResponse =  $curlData->curlData($organizationUrl);
       $organizationInfo =  json_decode($organizationResponse);

       if($userInfo){
          $data = [
            'api_key' => $request->api_key,
            'api_token' => $request->api_token,
            'user_id' => $userInfo->id,
          ];
          Session::put('data',$data);
          if($organizationInfo){
              return redirect()->route('board',$organizationInfo[0]->id);
          }else{
              return redirect()->route('organizations');
          }


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
       $curlData = new Service();
       $response = $curlData->curlData($url);
       $boards =  json_decode($response);

       return view('board',compact('boards'));

   }

   public function StoreList(Request $request){
       $data = Session::get('data');
       $request->validate([
           'name' => 'required',
       ]);
       $query = array(
           'name' => $request->name,
           'idBoard' => $request->boardId,
           'key' => $data['api_key'],
           'token' => $data['api_token']
       );
       $headers = array('Accept' => 'application/json');

       $response = Http::withHeaders($headers)->post('https://api.trello.com/1/lists?', $query);
       if ($response) {
           return response()->json([
               'message' => 'List Created Successfully',
               'redirect' => url()->previous()
           ]);
       }
   }

   public function showList($id){
       $data = Session::get('data');
       $url = 'https://api.trello.com/1/lists/'.$id.'/cards?key='.$data['api_key'].'&token='.$data['api_token'];
       $curlData = new Service();
       $response = $curlData->curlData($url);
        $cards =  json_decode($response);

       return view('lists.show',compact('cards','id'));
   }

    public function StoreCard(Request $request){
        $data = Session::get('data');
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        $query = array(
            'name' => $request->name,
            'desc' => $request->description,
            'idList' => $request->listId,
            'key' => $data['api_key'],
            'token' => $data['api_token']
        );
        $headers = array('Accept' => 'application/json');

        $response = Http::withHeaders($headers)->post('https://api.trello.com/1/cards?', $query);
        if ($response) {
            return response()->json([
                'message' => 'Card Created Successfully',
                'redirect' => url()->previous()
            ]);
        }
    }

    public function showCard($id){
        $data = Session::get('data');
        $url = 'https://api.trello.com/1/cards/'.$id.'?key='.$data['api_key'].'&token='.$data['api_token'];
        $curlData = new Service();
        $response = $curlData->curlData($url);
        $card =  json_decode($response);

        return view('card.index',compact('card'));
    }


    public function logout(){
       Session::flush();
       return redirect()->route('login.home');
    }



}
