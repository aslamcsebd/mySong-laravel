@extends('layouts.app')

@section('content')
   <div class="container-fluid any_delete_page">
      <div class="row justify-content-center">
         <div class="col-12 col-lg-4 col-md-4 col-sm-6 col-sm-12 mt-2 mb-2">
            <fieldset>
               <legend>Any Delete</legend>
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
                     
                        <form action="{{url('all_songType')}}" method="get" class="border">
                           {{-- @csrf --}}
                           <div class="row">
                              <div class="col">
                                 <select name="songType" id="city" class="form-control">
                                    <option value="">Song Type</option>
                                    <option value="all_songType">All Song Type</option>
                                 </select>
                              </div>
                              <div class="col">
                                 <button class="btn btn-primary btn-block" type="submit">Select Now</button>
                              </div>                 
                           </div> 
                        </form>

                        <form action="{{url('all_singer')}}" method="get" class="border">
                           {{-- @csrf --}}
                           <div class="row">
                              <div class="col">
                                 <select name="singerList" id="city" class="form-control">
                                    <option value="">Singer List</option>
                                    <option value="all_singer">All Singer</option>
                                 </select>
                              </div>
                              <div class="col">
                                 <button class="btn btn-secondary btn-block" type="submit">Select Now</button>
                              </div>                 
                           </div> 
                        </form>
                    
                        <form action="{{ url('singerName') }}" method="get" class="border">
                           {{-- @csrf --}}
                           <div class="row">
                              <div class="col">
                                 <select name="singerName" id="city" class="form-control">
                                    <option value="">Singer Name</option>
                                    @foreach($SingerLists as $SingerList)
                                       <option value="{{$SingerList->id}}">{{ $SingerList->singerName }}</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col">
                                 <button class="btn btn-info btn-block" type="submit">Select Now</button>
                              </div>                 
                           </div> 
                        </form>  

                        <form action="{{ url('all_songs') }}" method="get" class="border">
                           {{-- @csrf --}}
                           <div class="row">
                              <div class="col">
                                 <select name="all_songs" id="city" class="form-control">
                                    <option value="">All Song Select</option>
                                    <option value="all_songs">All Song List</option>
                                 </select>
                              </div>
                              <div class="col">
                                 <button class="btn btn-success btn-block" type="submit">Select Now</button>
                              </div>                 
                           </div> 
                        </form>

                     </div>
                  </div>
            </fieldset>
         </div>
      </div>

      {{-- All song type... --}}
      @if(isset($AllSongtypes))
         <div class="row singerList justify-content-center">
            <div class="col-12 col-lg-4 col-md-4 col-sm-6 col-sm-12 mt-1 mb-1">
               <fieldset>
                  <legend>All Type List</legend>
                     <div class="card">
                        <div class="card-header list-group-item-primary text-center">
                           All Item [{{ $AllSongtypeCount->count() }}]         
                        </div>
                        <div class="card-body">

                           @if (session('success'))
                              <div class="alert alert-success">
                                 <strong>Success!</strong> {{ session('success') }}
                              </div>
                           @endif
                           <table id="table" class="table any_delete_table table-bordered">
                              <thead class="bg-info">
                                 <tr class="text-center">
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Total song</th>
                                    <th>Action</th>            
                                 </tr>
                              </thead>
                              <tbody>
                                 @forelse($AllSongtypes as $AllSongtype)
                                    @php
                                       $userId = Auth::user()->id;  
                                       $AllSongs = App\AllSong::where('userId', $userId)
                                                   ->where('songTypeId', $AllSongtype->id)->get();
                                    @endphp

                                    <tr class="text-center">
                                       <td>{{ $loop->index + $AllSongtypes->firstItem() }}</td>
                                       <td> {{ $AllSongtype->songType }} </td>
                                       <td> {{ $AllSongs->count() }} </td>
                                       <td>
                                          <div class="btn-group" role="group">      
                                             <a href="{{ url('songType_delete')}}/{{$AllSongtype->id}}" class="btn btn-sm btn-danger">Delete</a>
                                          </div>                                            
                                       </td>
                                    </tr>
                                    @empty
                                       <tr class="text-center text-danger">
                                          <td colspan="4">No data found...</td>
                                       </tr>
                                    @endforelse
                              </tbody>
                           </table>
                           {{$AllSongtypes->appends($_GET)->links()}}
                        </div>
                     </div>
               </fieldset>  
            </div>
         </div>         
      @endif

      {{-- All song type... --}}
      @if(isset($AllSingers))
         <div class="row singerList justify-content-center">
            <div class="col-12 col-lg-4 col-md-4 col-sm-6 col-sm-12 mt-1 mb-1">
               <fieldset>
                  <legend>All Singer List</legend>
                     <div class="card">
                        <div class="card-header list-group-item-primary text-center">
                           All Singer [{{ $AllSingerCount->count() }}]
                        </div>
                        <div class="card-body">

                           @if (session('success'))
                              <div class="alert alert-success">
                                 <strong>Success!</strong> {{ session('success') }}
                              </div>
                           @endif
                           <table id="table" class="table any_delete_table table-bordered">
                              <thead class="bg-info">
                                 <tr class="text-center">
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Total song</th>
                                    <th>Action</th>          
                                 </tr>
                              </thead>
                              <tbody>
                                 @forelse($AllSingers as $AllSinger)
                                    @php
                                       $userId = Auth::user()->id; 
                                       $AllSongs = App\AllSong::where('userId', $userId)
                                                   ->where('singerNameId', $AllSinger->id)->get();
                                    @endphp
                                  
                                    <tr class="text-center">
                                       <td>{{ $loop->index + $AllSingers->firstItem() }}</td>
                                       <td> {{ $AllSinger->singerName }} </td>
                                       <td> {{ $AllSongs->count() }} </td>
                                       <td>
                                          <div class="btn-group" role="group">      
                                             <a href="{{ url('singer_delete')}}/{{$AllSinger->id}}" class="btn btn-sm btn-danger">Delete</a>
                                          </div>                                            
                                       </td>
                                    </tr> 
                                    @empty
                                       <tr class="text-center text-danger">
                                          <td colspan="4">No data found...</td>
                                       </tr>
                                    @endforelse
                              </tbody>
                           </table>
                           {{$AllSingers->appends($_GET)->links()}}
                        </div>
                     </div>
               </fieldset>  
            </div>
         </div>         
      @endif

      {{-- Singer songs... --}}
      @if(isset($Songs))
         <div class="row justify-content-center Songs">
            <div class="col-12 col-lg-6 col-md-4 col-sm-6 col-sm-12 mt-1 mb-1">
               <fieldset>
                  <legend>All Songs</legend>
                     <div class="card">
                        <div class="card-header list-group-item-primary text-center">
                           @foreach($Songs as $key => $Song) 
                              @if($key == 0)
                                 <?php
                                    $userId = Auth::user()->id;
                                    $singerImages = App\SingerList::where('userId', $userId)
                                             ->where('id', $Song->singerNameId)->get();
                                    foreach($singerImages as $singerImage) { ?>
                                       <img src="{{asset('SingerPhoto')}}/{{$singerImage->photo}}" class="img-thumbnail responsive" alt="No Image found" width="30" height="30">
                                       &nbsp;
                                 <?php } ?>
                                 {{ $Song->AllSong_RelationTo_SingerList->singerName}}'s 
                              @endif
                             
                           @endforeach All [{{$SongsCount->count()}}] 
                        </div>
                        <div class="card-body">
                           @if (session('success'))
                              <div class="alert alert-success text-center">
                                 <strong>Success!</strong> {{session('success') }}
                              </div>
                           @endif
                           <table class="table any_delete_Songs_table table-bordered">
                              <thead class="bg-info">
                                 <tr class="text-center">
                                    <th>No</th>
                                    <th>Song Name</th>  
                                    <th>Add date</th>  
                                    <th>Action</th>          
                                 </tr>
                              </thead>
                              <tbody>
                                 @forelse($Songs as $Song)                                    
                                  
                                    <tr class="text-center">
                                       <td>{{ $loop->index + $Songs->firstItem() }}</td>
                                       <td> {{ $Song->songName }} </td>
                                       <td>{{-- 
                                          {{ \Carbon\Carbon::parse($allSong->created_at)->format('d-M-Y') }} <br> --}}
                                          {{ \Carbon\Carbon::parse($Song->created_at)->diffForHumans() }}
                                       </td>
                                       <td>
                                          <div class="btn-group" role="group">      
                                             <a href="{{ url('singerSongId_delete')}}/{{$Song->id}}" class="btn btn-sm btn-danger">Delete</a>
                                          </div>                                            
                                       </td>
                                    </tr>
                                    @empty
                                       <tr class="text-center text-danger">
                                          <td colspan="6">No data found...</td>
                                       </tr>
                                    @endforelse
                              </tbody>
                           </table>
                           {{$Songs->appends($_GET)->links()}}
                        </div>
                     </div>
               </fieldset>  
            </div>
         </div>         
      @endif

      {{-- All songs... --}}
      @if(isset($allSongs))
         <div class="row singerList justify-content-center allSongs">
            <div class="col-12 col-lg-8 col-md-4 col-sm-6 col-sm-12 mt-1 mb-1">
               <fieldset>
                  <legend>All Songs</legend>
                     <div class="card">
                        <div class="card-header list-group-item-primary text-center">
                           All [{{$allSongsCount->count()}}] Item            
                        </div>
                        <div class="card-body">
                           @if (session('success'))
                              <div class="alert alert-success">
                                 <strong>Success!</strong> {{ session('success') }}
                              </div>
                           @endif
                           <table class="table any_delete_allSong_table table-bordered">
                              <thead class="bg-info">
                                 <tr class="text-center">
                                    <th>No</th>
                                    <th>Song Type</th>
                                    <th>Singer Name</th>
                                    <th>Song Name</th>  
                                    <th>Add date</th>  
                                    <th>Action</th>          
                                 </tr>
                              </thead>
                              <tbody>
                                 @forelse($allSongs as $allSong)   
                                    <tr class="text-center">
                                       <td>{{ $loop->index + $allSongs->firstItem() }}</td>
                                       <td> {{ $allSong->AllSong_RelationTo_Songtype->songType }} </td>
                                       <td> {{ $allSong->AllSong_RelationTo_SingerList->singerName }} </td>
                                       <td> {{ $allSong->songName }} </td>
                                       {{-- <td> {{ $allSong->created_at }} </td> --}}
                                       <td>{{-- 
                                          {{ \Carbon\Carbon::parse($allSong->created_at)->format('d-M-Y') }} <br> --}}
                                          {{ \Carbon\Carbon::parse($allSong->created_at)->diffForHumans() }}
                                       </td>
                                       <td>
                                          <div class="btn-group" role="group">      
                                             <a href="{{ url('songId_delete')}}/{{$allSong->id}}" class="btn btn-sm btn-danger">Delete</a>
                                          </div>                                            
                                       </td>
                                    </tr>
                                    @empty
                                       <tr class="text-center text-danger">
                                          <td colspan="6">No data found...</td>
                                       </tr>
                                    @endforelse
                              </tbody>
                           </table>
                           {{$allSongs->appends($_GET)->links()}}
                        </div>
                     </div>
               </fieldset>  
            </div>
         </div>         
      @endif

   </div>
@endsection
