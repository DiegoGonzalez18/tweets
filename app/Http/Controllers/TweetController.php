<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class TweetController extends Controller
{
    //
    public function index(){
    $t= DB::table('tweets')
    ->join('users','users.id','=','tweets.id_user')
    ->select('users.name','tweets.*')->get();
    return $t;
    }
    public function store(Request $request){
        $t= new Tweet();
        $t->content=$request->content;
        $t->id_user=Auth::user()->id;
        return $t->save();
    }
    public function destroy(Request $request){
       
        $t = Tweet::find($request->id);
        
    return     $t->delete();

    }
    public function update(Request $request){
        
        $t = Tweet::find($request->id);
        $t->content=$request->content;
        return $t->save();

    }
    public function show(Request $request){
        
    
        $t= DB::table('tweets')
        ->join('users','users.id','=',$request->id)
        ->select('users.name','tweets.*')->get();
       
        return $t;

    }
}
