<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Songtype;
use App\SingerList;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

   //1 After Login button
   //1 all song button
   public function index(){
      $email = Auth::user()->email;      
      $Songtypes = Songtype::where('email', $email)->get();
      // $SingerLists = SingerList::where('email', $email)->get();
      // return view('home', compact('Songtypes', 'SingerLists'));
      return view('home', compact('Songtypes'));
    }
}
