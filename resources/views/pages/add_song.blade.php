@extends('layouts.app')

@section('content')
   <div class="container add_song_page">      
      <div class="row justify-content-center">
         {{-- Add Info --}}
         <div class="col-12 col-lg-4 col-md-4 col-sm-6 col-sm-12 mt-1 mb-1">
            <fieldset>
               <legend>Add Item</legend>
                  <div class="card">
                     <div class="card-header list-group-item-primary text-center">General Information</div>
                     <div class="card-body">

                        @if (session('success'))
                           <div class="alert alert-success text-center">
                              <strong>Success!</strong> {{ session('success') }}
                           </div>
                        @endif
                        @if (session('fail'))
                           <div class="alert alert-danger">
                              <strong>Sorry!</strong> {{ session('fail') }}
                           </div>
                        @endif

                        @if ($errors-> all())
                           <div class="alert alert-danger">
                              @foreach ($errors->all() as $error)
                                 <li>{{$error}}</li>
                              @endforeach
                           </div>
                        @endif

                        <form action="{{ url('add_song_now')}}" method="post" enctype="multipart/form-data" class="border">
                           @csrf
                           <div class="row justify-content-center">
                              <div class="col">
                                 <label for="song_Type_Id" class="form-control">Song Type</label>
                              </div>
                              <div class="col">
                                 <select name="songTypeId" id="song_Type_Id" class="form-control">
                                    <option value="">Select Now</option>
                                    <?php
                                       foreach($Songtypes as $Songtype){
                                          echo '<option value="'.$Songtype->id.'">'.$Songtype->songType.'</option>';
                                       }
                                    ?>

                                   {{--  @foreach($Songtypes as $Songtype)
                                       <option value="{{$Songtype->songType}}">{{$Songtype->songType}}</option>
                                    @endforeach --}}
                                 </select>
                              </div>                                                         
                           </div>
                           <div class="row justify-content-center">
                              <div class="col">
                                 <label for="singer_Name_Id" class="form-control">Singer Name</label>
                              </div>
                              <div class="col">
                                 <select name="singerNameId" id="singer_Name_Id" class="form-control">
                                    <option value="">Select Now</option>
                                    {{-- @foreach($SingerLists as $SingerList)
                                       <option value="{{$SingerList->singerName}}">{{$SingerList->singerName}}</option>
                                    @endforeach --}}
                                 </select>
                              </div>                                          
                           </div>

                           <div class="row justify-content-center">
                              <div class="col">
                                 <label for="Song Name" class="form-control">Song Name</label>
                              </div>
                              <div class="col">
                                 <input type="text" name="songName" value="{{ old('songName')}}" class="form-control" id="Song Name" placeholder="Name">
                              </div>                                          
                           </div>                           
                           <div class="row justify-content-center">
                              <div class="col">
                                 <div class="input-group">
                                    <div class="input-group-prepend">
                                       <label class="input-group-text" for="songLink">Song Link</label>
                                    </div>

                                    <textarea name="songLink" rows="2" type="text" class="form-control" id="songLink" placeholder="Enter Youtube Link" aria-label="With textarea">{{ old('songLink')}}</textarea>
                                 </div>
                              </div>                               
                           </div>
                           <br>
                           <div class="row">
                              <div class="col">
                                 <button class="btn btn-success btn-block" type="submit">Add Now</button>
                              </div> 
                           </div>

                        </form>
                     </div>
                  </div>
            </fieldset>
         </div> 
      </div>     
   </div>
@endsection

