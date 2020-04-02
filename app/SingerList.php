<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SingerList extends Model
{
   protected $fillable = ['photo'];



   function singerList_RelationTo_Songtype(){
      return $this->hasOne('App\Songtype', 'id', 'songTypeId');
      // N:B: hasOne('Destination model', 'Destination model id(primary key)', 'to this model foreign key');
   }


   


   // function relationToCard(){
   //    return $this->hasOne('App\Product', 'id', 'product_id');
   //    // N:B: hasOne('Destination model', 'Destination model id(primary key)', 'to this model foreign key');
   // }



   // @forelse($card_items as $card_item)

   //    <img src="{{ asset('Full_Project/images/product_images') }}/{{ $card_item->relationToCard->product_image }}" width="70">

   //    @if($card_item->relationToCard->quantity < $card_item->product_quantity)
   //       <div class="alert alert-danger" width="20px">
   //          Please remove
   //       </div>
   //    @endif

   //      {{ $card_item->relationToCard->name}}






















}
