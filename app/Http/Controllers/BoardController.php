<?php

namespace App\Http\Controllers;

use App\Service\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BoardController extends Controller
{

    public function create(){
        return view('board.create');
    }

    public function store(Request $request)
    {
        $data = Session::get('data');
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        $query = array(
            'name' => $request->name,
            'desc' => $request->description,
            'key' => $data['api_key'],
            'token' => $data['api_token']
        );
        $headers = array('Accept' => 'application/json');

        $response = Http::withHeaders($headers)->post('https://api.trello.com/1/boards/', $query);
        if ($response) {
            return response()->json('Create Board Successfully');
        }
    }


   public function edit($id){
            $data = Session::get('data');
            $url = 'https://api.trello.com/1/boards/'.$id.'?key='.$data['api_key'].'&token='.$data['api_token'];
            $curlData = new Service();
            $response = $curlData->curlData($url);
            $board =  json_decode($response);

            return view('board.edit',compact('board'));

        }
    public function update(Request $request,$id)
    {
        $data = Session::get('data');
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        $query = array(
            'name' => $request->name,
            'desc' => $request->description,
            'key' => $data['api_key'],
            'token' => $data['api_token']
        );
        $headers = array('Accept' => 'application/json');

          $response = Http::withHeaders($headers)->put('https://api.trello.com/1/boards/'.$id, $query);
        if ($response) {
            return response()->json('Update Board Successfully');
        }
    }

    public function show($id){
        $data = Session::get('data');
        $url = 'https://api.trello.com/1/boards/'.$id.'/lists?key='.$data['api_key'].'&token='.$data['api_token'];
        $curlData = new Service();
        $response = $curlData->curlData($url);
        $lists =  json_decode($response);

      return view('lists.index',compact('lists','id'));
    }

    public function destroy($id)
    {
        $data = Session::get('data');

        $query = array(
            'key' => $data['api_key'],
            'token' => $data['api_token']
        );
        $headers = array('Accept' => 'application/json');
        $response = Http::withHeaders($headers)->delete('https://api.trello.com/1/boards/'.$id, $query);
        if($response){
            return response()->json([
                'message' => __('Board Deleted Successfully'),
                'redirect' => url()->previous()
            ]);
        }

    }


}
