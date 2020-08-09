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

   public function login() {
      if (false == Auth::check()) {
         return redirect('auth/login');
      }else{
         $userId = Auth::user()->id;

         $SongtypeCount = Songtype::where('userId', $userId)->get();
         $Songtypes = Songtype::where('userId', $userId)->get();

         $SingerListCount = SingerList::where('userId', $userId)->get();
         $SingerLists = SingerList::where('userId', $userId)->get();
         $When_All_Singer = true;
         return view('home', compact('SongtypeCount', 'Songtypes', 'SingerListCount', 'SingerLists', 'When_All_Singer'));        
      }
   }




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
