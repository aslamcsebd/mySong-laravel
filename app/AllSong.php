<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class AllSong extends Model{

   protected $dates = ['created_at'];   

   function AllSong_RelationTo_Songtype(){
      return $this->hasOne('App\Songtype', 'id', 'songTypeId');
      // N:B: hasOne('Destination model', 'Destination model id(primary key)', 'to this model foreign key');
   }
   function AllSong_RelationTo_SingerList(){
      return $this->hasOne('App\SingerList', 'id', 'singerNameId');
      // N:B: hasOne('Destination model', 'Destination model id(primary key)', 'to this model foreign key');
   }

}
