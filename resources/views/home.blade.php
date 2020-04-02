@extends('layouts.app')

@section('content')
   <div class="container-fluid home_page">
      <div class="row justify-content-center home">
         <div class="col-12 col-lg-4 col-md-4 col-sm-6 col-sm-12 mt-2 mb-2 ">
            <fieldset>
               <legend>My Song</legend>
                  <div class="card">
                     <div class="card-header list-group-item-primary text-center">General Information</div>
                     <div class="card-body">

                        @if ($errors-> all())
                           <div class="alert alert-danger">
                              @foreach ($errors->all() as $error)
                                 <li>{{$error}}</li>
                              @endforeach
                           </div>
                        @endif
                     
                        <form action="{{url('select_songType')}}" method="get" class="border">
                           {{-- @csrf --}}
                           <div class="row">
                              <div class="col">
                                 <select name="songTypeId" id="city" class="form-control">
                                    <option value="">Song Type ({{ $SongtypeCount->count()}}) </option>
                                    @php $i=1; @endphp
                                    @foreach($Songtypes as $Songtype)
                                       <option value="{{$Songtype->id}}">{{$i}}) {{$Songtype->songType}}</option>
                                          @php $i = $i+1; @endphp                                       
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col">
                                 <button class="btn btn-primary btn-block" type="submit">Select Now</button>
                              </div>                 
                           </div> 
                        </form>

                        <style type="text/css">
                           form select option .a{ color: blue; background-color: red;}
                        </style>

                        @if(isset($SingerLists))
                           <form action="{{ url('select_singerName') }}" method="get" class="border">
                              {{-- @csrf --}}
                              <div class="row">
                                 <div class="col">
                                    <select name="singerNameId" id="city" class="form-control">
                                       <option value="">Singer Name ({{ $SingerListCount->count()}})</option>
                                       @php $j=1; @endphp
                                       @foreach($SingerLists as $SingerList)                                          
                                          <option value="{{$SingerList->id}}">{{$j}}) {{ $SingerList->singerName }}
                                             @if(isset($When_All_Singer))
                                               <p class="a"> [{{$SingerList->singerList_RelationTo_Songtype->songType}}]</p>
                                             @endif
                                          </option>
                                             @php $j = $j+1; @endphp
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="col">
                                    <button class="btn btn-info btn-block" type="submit">Select Now</button>
                                 </div>                 
                              </div> 
                           </form>  
                        @endif
                     </div>
                  </div>
            </fieldset>
         </div>
      </div>  

      {{-- All song... --}}
      @if(isset($all_singerNames))
         <fieldset>
            <legend>All Items [{{ $all_singerNameCount->count() }}]</legend>
               <div class="row singerList justify-content-center">
                  @foreach($all_singerNames as $all_singerName)
                     <div class="col-12 col-lg-4 col-md-4 col-sm-6 col-sm-12 mt-1 mb-1">
                        <div class="card card_row">
                           <div class="card-header">
                              <table class="table table-bordered badge-info text-center">
                                 <thead>

                                    @php 
                                       $rowspan = 2;
                                       if($all_singerName->country !=null){

                                          $rowspan = $rowspan +1;
                                       }if($all_singerName->dob !=null){

                                          $rowspan = $rowspan +1;
                                       }
                                    @endphp
                                   
                                    <tr>
                                       <th rowspan="{{ $rowspan }}">
                                          <img src="{{asset('SingerPhoto')}}/{{$all_singerName->photo}}" class="img-thumbnail responsive" alt="No Image found" width="80"><br>
                                          <i> {{$all_singerName->singerName}}</i>
                                       </th>

                                        @if($all_singerName->country !=null)
                                          <tr>
                                             <td>Country</td>
                                             <td>{{$all_singerName->country}}</td>
                                          </tr>
                                        @endif

                                       @if($all_singerName->dob !=null)
                                          <tr>
                                             <td>Age</td>
                                             <td>
                                                {{ \Carbon\Carbon::parse($all_singerName->dob)
                                                   ->diff(\Carbon\Carbon::now())
                                                   ->format(' %y years ') }} 
                                             </td>
                                          </tr> 
                                       @endif


                                       @php
                                          $userId = Auth::user()->id;
                                          $all_songsCount = App\AllSong::where('userId', $userId)
                                                      ->where('singerNameId', $all_singerName->id)->get();
                                       @endphp                      
                                       <tr>
                                          <td>Total Item</td>
                                          <td>{{$all_songsCount->count()}}</td>
                                       </tr>
                                    </tr>
                                 </thead>
                              </table>                  
                           </div>
                           <div class="card-body">
                              @php
                                 $userId = Auth::user()->id;
                                 $all_songs = App\AllSong::where('userId', $userId)
                                             ->where('singerNameId', $all_singerName->id)
                                             ->simplePaginate(2, ['*'], 'page_'.$all_singerName->id);
                              @endphp
                              <table class="table home_table table-bordered text-center">
                                 <thead class="bg-info">
                                    <tr>
                                       <th>No</th>
                                       <th>Action / Song name</th>            
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @forelse($all_songs as $all_song)
                                       <tr>
                                          <td>
                                             {{ $loop->index + $all_songs->firstItem() }}
                                          </td>
                                          <td>
                                             {!! Youtube::iFrame($all_song->songLink) !!}
                                             {{ $all_song->songName }}
                                          </td>
                                       </tr>                                             
                                       </tr>
                                    @empty
                                       <tr class="text-center text-danger">
                                          <td colspan="3">No data found...</td>
                                       </tr>
                                    @endforelse 
                                 </tbody>
                              </table>
                              {{$all_songs->appends($_GET)->links()}}
                           </div>
                        </div>
                     </div>
                  @endforeach
               </div>    
         </fieldset> 
      @endif

      {{-- Single Singer --}}
      @if(isset($all_songs) && isset($singerInfos))
         <div class="row singerList justify-content-center">
            <div class="col-12 col-lg-4 col-md-4 col-sm-6 col-sm-12 mt-1 mb-1">
               <fieldset>
                  <legend>This Singer's songs</legend>
                     <div class="card card_row">
                        <div class="card-header">
                           <table class="table table-bordered badge-info text-center">
                              <thead>
                                 @foreach($singerInfos as $singerInfo)

                                    @php
                                       $rowspan = 1;    
                                       if($singerInfo->country !=null){
                                          $rowspan = $rowspan +1;

                                       }if($singerInfo->dob !=null){
                                          $rowspan = $rowspan +1;

                                       }if($all_songsCount->count() !=null){
                                          $rowspan = $rowspan +1;
                                       }
                                    @endphp

                                    <tr>
                                       <th rowspan="{{ $rowspan }}">
                                          <img src="{{asset('SingerPhoto')}}/{{$singerInfo->photo}}" class="img-thumbnail responsive" alt="No Image found" width="80"><br>
                                          <span> {{$singerInfo->singerName}}</span> 
                                       </th>

                                       @if($singerInfo->country !=null)
                                          <tr>
                                             <td>Country</td>
                                             <td>{{$singerInfo->country}}</td>
                                          </tr>
                                       @endif

                                       @if($singerInfo->dob !=null)
                                          <tr>
                                             <td>Age</td>
                                             <td>
                                                {{ \Carbon\Carbon::parse($singerInfo->dob)
                                                   ->diff(\Carbon\Carbon::now())
                                                   ->format(' %y years ') }} 
                                             </td>
                                          </tr>
                                       @endif

                                       @if ($all_songsCount->count()!=null)
                                          <tr>
                                             <td>Total Item</td>
                                             <td>{{$all_songsCount->count()}}</td>
                                          </tr>
                                       @endif

                                    </tr>
                                 @endforeach
                              </thead>
                           </table>                  
                        </div>
                           <div class="card-body">
                              <table class="table home_table table-bordered text-center">
                                 <thead class="bg-info">
                                    <tr>
                                       <th>No</th>
                                       <th>Action / Song name</th>                      
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @forelse($all_songs as $all_song)
                                       <tr>
                                          <td>{{ $loop->index + $all_songs->firstItem() }}</td>
                                          <td>
                                             {!! Youtube::iFrame($all_song->songLink) !!}
                                             {{ $all_song->songName }}
                                          </td>
                                       </tr>
                                    @empty
                                       <tr class="text-center text-danger">
                                          <td colspan="3">No data found...</td>
                                       </tr>
                                    @endforelse
                                 </tbody>
                              </table>
                              {{ $all_songs->appends($_GET)->links() }}                       
                           </div>
                     </div>
               </fieldset>
            </div>
         </div>                  
      @endif 

   </div>
@endsection
