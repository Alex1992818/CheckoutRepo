<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public $auth;

    public $firestore;
    public function __construct()
    {
        $this->auth = app('firebase.auth');
        $firestoreConnection = app('firebase.firestore');
        $this->firestore = $firestoreConnection->database();
    }
    public function emailSubmit(Request $request){
          // dd($request->all());
        $collection = $this->firestore->collection('special_offer_emails');
        $query = $collection->where('email', '=', $request->email)->limit(1);
    
        if($query->documents()->size() == 0){
          $data=[
            'email'=>$request->email
          ];
          $collection = $this->firestore->collection('special_offer_emails');
          $document = $collection->newDocument();
          $document->set($data);
       
          return view('app.about_us');
        }
        else {
            return view('app.about_us');
        }
        }
}
