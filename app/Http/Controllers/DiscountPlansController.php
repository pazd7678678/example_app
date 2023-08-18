<?php

namespace App\Http\Controllers;

use App\Models\DiscountPlan;
use Illuminate\Http\Request;

class DiscountPlansController extends Controller
{
    public function check(Request $request)

    {
       
        $validated = $request->validate([


            'mycart'=>'required'

        ]);


        return $validated;

       
         

    }
}
