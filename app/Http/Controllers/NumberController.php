<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NumberController extends Controller
{
    public function number() {
        /*
        $number = random_int(0, 100);
        // view('strona_widoku (blade)', [przekazywana tablica asocjacyjna])
        return view('number', ['number' => $number]); 
         * 
         */
        
        $numbers = [
            random_int(0, 100),
            random_int(0, 100),
            random_int(0, 100)
            ];
        return view('number', ['numbers' => $numbers]);
    }
}
