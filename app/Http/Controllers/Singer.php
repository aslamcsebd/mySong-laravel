<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use App\Songtype;
use App\SingerList;
use App\AllSong;
use DB, Validator, Redirect, View;
use Fomvasss\Youtube\Facades\Youtube;
use Carbon\Carbon;

class Singer extends Controller{ 

   //1 After Login button
   //1 all song button
   //1 Home page start
      public function index(){
         $userId = Auth::user()->id;

         $SongtypeCount = Songtype::where('userId', $userId)->get();
         $Songtypes = Songtype::where('userId', $userId)->get();

         $SingerListCount = SingerList::where('userId', $userId)->get();
         $SingerLists = SingerList::where('userId', $userId)->get();
         $When_All_Singer = true;
         return view('home', compact('SongtypeCount', 'Songtypes', 'SingerListCount', 'SingerLists', 'When_All_Singer'));
      }
   
      public function select_songType(Request $request){
         $userId = Auth::user()->id;

         $SongtypeCount = Songtype::where('userId', $userId)->get();
         $Songtypes = Songtype::where('userId', $userId)->get();

         $request-> validate(['songTypeId'=> 'required']);
         $songTypeId = $request->songTypeId;

         $SingerListCount = SingerList::where('userId', $userId)->where('songTypeId', $songTypeId)->get();
         $SingerLists = SingerList::where('userId', $userId)->where('songTypeId', $songTypeId)->get();

         $all_singerNameCount = SingerList::where('userId', $userId)->where('songTypeId', $songTypeId)->get();
         $all_singerNames = SingerList::where('userId', $userId)->where('songTypeId', $songTypeId)->get();

         return view('home', compact('SongtypeCount', 'Songtypes', 'SingerListCount', 'SingerLists', 'all_singerNameCount', 'all_singerNames'));
      }

      // select_singerName
      public function select_singerName(Request $request){
         $userId = Auth::user()->id;

         $SongtypeCount = Songtype::where('userId', $userId)->get();
         $Songtypes = Songtype::where('userId', $userId)->get();

         $SingerListCount = SingerList::where('userId', $userId)->get();         
         $SingerLists = SingerList::where('userId', $userId)->get();

         $request-> validate(['singerNameId'=> 'required']);

         $singerNameId = $request->singerNameId;
         $singerInfos = SingerList::where('userId', $userId)->where('id', $singerNameId)->get();

         $all_songsCount = AllSong::where('userId', $userId)->where('singerNameId', $singerNameId)->get();
         $all_songs = AllSong::where('userId', $userId)
                     ->where('singerNameId', $singerNameId)
                     ->simplePaginate(2, ['*'], 'p1');
         // $all_songs->appends($request->only('singerNameId'));
         return view('home', compact('SongtypeCount', 'Songtypes', 'SingerListCount', 'SingerLists', 'singerInfos', 'all_songsCount', 'all_songs'));
      }
   //1 Home page end

   //2 add singer page start
      public function add_singer(){
         $userId = Auth::user()->id;      
         $Songtypes = Songtype::where('userId', $userId)->orderBy('songType')->get();
         return view('pages/add_singer', compact('Songtypes'));
      }
   
      public function add_songType(Request $request){
         $userId = Auth::user()->id;
         $request-> validate([
            'songType'=> 'required'
         ]);

         if (Songtype::where('userId', $userId)->where('songType', $request->songType)->count() > 0) {
            return back()->with('fail', 'This Song type has already been taken');         
         }else{
            Songtype::insert([
               'userId'=>$userId,
               'songType'=>$request->songType,
               'created_at'   => Carbon::now()
            ]);
            return back()->with('success','Song Type Save Successfully');
         }
      }

      public function add_singer_now(Request $request){
         $userId = Auth::user()->id;
         $songTypeId = $request->songTypeId;
         $singerName = $request->singerName;

         $request-> validate([
            'songTypeId'=> 'required',
            'singerName'=> 'required'
         ]);

         if ($request->dob !=null) {
            $dob = Carbon::parse($request->dob)->format('Y-M-d');
         }else{
            $dob = $request->dob;
         }

         if (SingerList::where('userId', $userId)
            ->where('songTypeId', $songTypeId)
            ->where('singerName', $singerName)
            ->count() > 0) {

               return back()->with('fail', 'This singer name has already been taken'); 
         }else{  

            $last_inserted_id = SingerList::insertGetId([
               'userId'=>$userId,
               'songTypeId'=>$request->songTypeId,
               'singerName'=>$request->singerName,
               'country'=>$request->country,
               'gender'=>$request->gender,
               'dob'=> $dob,
               'created_at' => Carbon::now()            
            ]);

            if ($request->hasFile('photo')){
               if($files=$request->file('photo')){
                  $singerName = $request->singerName;
                  $name=$last_inserted_id.".".$singerName.".".$files->getClientOriginalExtension();
                  $files->move('SingerPhoto/', $name);
                  SingerList::find($last_inserted_id)->update(['photo'=> $name]);
               }    
            }
            return back()->with('success', 'Singer Info Save Successfully');
         }
      }      
   // add singer page end

   //3 add song page start
      public function add_song(){
         $userId = Auth::user()->id;
         $Songtypes = Songtype::where('userId', $userId)->orderBy('songType')->get();
         // $SingerLists = SingerList::where('userId', $userId)->get();
         // return view('pages/add_song', compact('Songtypes', 'SingerLists'));
         return view('pages/add_song', compact('Songtypes'));
      }
   
      public function add_song_now(Request $request){
         $userId = Auth::user()->id;
         $songTypeId = $request->songTypeId;
         $singerNameId = $request->singerNameId;
         $songName = $request->songName;
         $songLink = $request->songLink;

         $request-> validate([
            'songTypeId'=> 'required',
            'singerNameId'=> 'required',
            'songName'=> 'required',
            'songLink'=> 'required'
         ]);

         if (AllSong::where('userId', $userId)
            ->where('songTypeId', $songTypeId)
            ->where('singerNameId', $singerNameId)
            ->where('songName', $songName)
            ->count() > 0) {

               return back()->with('fail', 'This song name has already been taken. Try another name');
         }elseif (AllSong::where('userId', $userId)
            ->where('songTypeId', $songTypeId)
            ->where('singerNameId', $singerNameId)
            ->where('songLink', $songLink)
            ->count() > 0){
                 return back()->with('fail', 'This song link has already been taken. Try another link');
         }else{
        
            AllSong::insert([
               'userId'=>$userId,
               'songTypeId'=>$request->songTypeId,
               'singerNameId'=>$request->singerNameId,
               'songName'=>$request->songName,
               'songLink'=>$request->songLink,
               'created_at'   => Carbon::now()
               // 'created_at'   => Carbon::now('Asia/Dhaka')
               ////All time zone set  [go config/app.config/line no 70  'Asia/Dhaka']
            ]);
            return back()->with('success', 'Successfully Save this song link');
         }
      }
   // add song page end

   // 4 singer List page start 
      public function singerList(){
         $userId = Auth::user()->id;
         $SingerListCount = SingerList::where('userId', $userId)->get();         
         $SingerLists = SingerList::where('userId', $userId)->simplePaginate(5);
         return view('pages/singer_list', compact('SingerListCount', 'SingerLists'));
      }
   // singer List page start 

//5 any delete page start
      // any delete button
      public function any_delete(){
         $userId = Auth::user()->id;    
         // Default
         $SingerLists = SingerList::where('userId', $userId)->get();
         return view('pages/any_delete', compact('SingerLists'));
      }

      // Any delete pages [song type button]1
      public function all_songType(Request $request){
         $userId = Auth::user()->id;      
         $AllSongtypeCount = Songtype::where('userId', $userId)->get();
         $AllSongtypes = Songtype::where('userId', $userId)->simplePaginate(5);
         // Default         
         $SingerLists = SingerList::where('userId', $userId)->get();
         $request-> validate(['songType'=> 'required']);
         return view('pages/any_delete', compact('AllSongtypeCount', 'AllSongtypes', 'SingerLists'));
      }

      // Any delete pages  [song type delete]
      function songType_delete($songType_id){
         $userId = Auth::user()->id;
         $songTypeId = Songtype::find($songType_id);
         $songTypeId->delete();      
         $songTypeId = $songTypeId->id;
         $SingerLists = SingerList::where('userId', $userId)->where('songTypeId', $songTypeId)->delete();
         $SingerLists = AllSong::where('userId', $userId)->where('songTypeId', $songTypeId)->delete();
         return back()->with('success', 'Item Type delete successfully');
      }


      // Any delete pages [singer List button]2
      public function all_singer(Request $request){
         $userId = Auth::user()->id;
         // Default            
         $SingerLists = SingerList::where('userId', $userId)->get();      
         $AllSingers = SingerList::where('userId', $userId)->simplePaginate(5);
         $AllSingerCount = SingerList::where('userId', $userId)->get();
         $request-> validate(['singerList'=> 'required']);
         return view('pages/any_delete', compact('SingerLists', 'AllSingers', 'AllSingerCount'));
      }

      // Any delete pages  [singer delete]
      function singer_delete($singer_id){
         $userId = Auth::user()->id;
         $singerNameId = SingerList::find($singer_id);
         $singerNameId->delete();
         $singerNameId = $singerNameId->id;
         $SingerLists = AllSong::where('userId', $userId)->where('singerNameId', $singerNameId)->delete();
         return back()->with('success', 'Singer delete successfully');
      }


      // Any delete pages  [singer name select button]3
      public function singerName(Request $request){
         $userId = Auth::user()->id;
         $request-> validate(['singerName'=> 'required']);
         $singerNameId = $request->singerName;
         // Default
         $SingerLists = SingerList::where('userId', $userId)->get();
         $SongsCount = AllSong::where('userId', $userId)->where('singerNameId', $singerNameId)->get();
         $Songs = AllSong::where('userId', $userId)->where('singerNameId', $singerNameId)->orderBy('id', 'DESC')->simplePaginate(5);
         return view('pages/any_delete', compact('SingerLists', 'SongsCount', 'Songs'));
      }

      // Any delete pages [singer song select delete]
      function singerSongId_delete($song_id){
         $userId = Auth::user()->id;
         AllSong::where('userId', $userId)->where('id', $song_id)->delete();
         return back()->with('success', 'Song delete successfully');
      }

      // Any delete pages  [all song select button]4
      public function all_songs(Request $request){
         $userId = Auth::user()->id;
         // Default         
         $SingerLists = SingerList::where('userId', $userId)->get();
         $allSongsCount = AllSong::where('userId', $userId)->get();
         $allSongs = AllSong::where('userId', $userId)->orderBy('id', 'DESC')->simplePaginate(10);
         $request-> validate(['all_songs'=> 'required']);
         return view('pages/any_delete', compact('SingerLists', 'allSongsCount', 'allSongs'));
      }

      // Any delete pages [all song select delete]
      function songId_delete($song_id){
         $userId = Auth::user()->id;
         AllSong::where('userId', $userId)->where('id', $song_id)->delete();
         return back()->with('success', 'Song delete successfully');
      }

}  
