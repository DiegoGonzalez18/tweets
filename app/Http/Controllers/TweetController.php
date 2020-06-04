<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TweetController extends Controller
{
    //
    public function index(Request $request){
    $t= DB::table('tweets')
    ->join('users','users.id','=','tweets.id_user')
    ->select('users.name','tweets.*')->get();
    return $t;
    }
}
