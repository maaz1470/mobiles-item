<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verify;

class VerifyController extends Controller
{
    public function authVerification($token)
    {
        $v = Verify::where('token',$token)->get()->first();
        if(($v->expire / 60) > ((time()/60)-30)){
            echo "hello";
        }
    }
}
