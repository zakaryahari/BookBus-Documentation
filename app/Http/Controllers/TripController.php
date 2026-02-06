<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripController extends Controller
{
    public function SearchForOffer($StartDes , $EndDes){
        if ($StartDes == $EndDes) {
            return "You are already there! Please choose a different destination.";
        }

        return "Searching for buses from ". $StartDes ." to ". $EndDes ."...";
    }

    public function contact(Request $request){
        return view('welcome' , 
            ['email' => $request->email ,
            'password' => $request->password ]
        );
    }
}
