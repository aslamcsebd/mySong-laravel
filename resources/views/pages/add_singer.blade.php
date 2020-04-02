@extends('layouts.app')

@section('content')
   <div class="container">      
      <div class="row justify-content-center add_singer_page">         
         {{-- Add Info --}}
         <div class="col-12 col-lg-4 col-md-4 col-sm-6 col-sm-12 mt-1 mb-1">
            <fieldset>
               <legend>Add Singer</legend>
                  <div class="card">
                     <div class="card-header list-group-item-primary text-center">General Information</div>
                     <div class="card-body">

                        @if (session('success'))
                           <div class="alert alert-success">
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

                        <form action="{{ url('add_songType') }}" method="post" class="border">
                           @csrf
                           <div class="row justify-content-center">                           
                              <div class="col">
                                 <input type="text" name="songType" class="form-control" placeholder="Song Type">
                              </div>
                              <div class="col">
                                 <button class="btn btn-success btn-block" type="submit">Add Item</button>
                              </div>                 
                           </div> 
                        </form>

                        <hr>
                        
                        <form action="{{ url('add_singer_now')}}" method="post" enctype="multipart/form-data" class="border">
                           @csrf
                           <div class="row justify-content-center">
                              <div class="col">
                                 <label for="singerType" class="form-control">Song Type</label>
                              </div>
                              <div class="col">
                                 <select name="songTypeId" id="singerType" class="form-control" style="padding: 5px;">
                                    <option value="">Select Now</option>
                                    @foreach($Songtypes as $Songtype)
                                       <option value="{{$Songtype->id}}">{{$Songtype->songType}}</option>
                                    @endforeach
                                 </select>
                              </div>                                                         
                           </div>
                           <div class="row justify-content-center">
                              <div class="col">
                                 <label for="name" class="form-control ">Singer Name</label>
                              </div>
                              <div class="col">
                                 <input type="text" name="singerName" value="{{ old('singerName')}}" class="form-control" id="name" placeholder="Name">
                              </div>                                          
                           </div>

                           <div class="row justify-content-center">
                              <div class="col">
                                 <label for="country" class="form-control">Singer Country</label>
                              </div>
                              <div class="col">
                                 <input type="text" name="country" value="{{ old('country')}}" class="form-control" id="country" placeholder="Country Name">
                              </div>                                          
                           </div>

                           <div class="row justify-content-center">
                              <div class="col">
                                 <label for="gender" class="form-control">Singer Gender</label>
                              </div>
                              <div class="col btn btn-group btn-group-toggle " data-toggle="buttons">
                                 <label class="btn btn-sm btn-info active">
                                    <input type="radio" name="gender" value="Male" id="gender">Male
                                 </label>
                                 <div class="vl"></div>
                                 <label class="btn btn-sm btn-info">
                                    <input type="radio" name="gender" value="Female" id="gender">Female
                                 </label>
                              </div>
                           </div>

                           <div class="row date justify-content-center">
                              <div class="col-6">
                                 <label for="datepicker" class="form-control">Date of birth</label>
                              </div>
                              <div class="col-6">
                                 <input type="text" id="datepicker" name="dob" value="{{ old('dob')}}" placeholder="Insert date" class="form-control">
                              </div>                                          
                           </div>

                           <div class="row justify-content-center">
                              <div class="col">
                                 <label for="image" class="form-control">Singer Photo</label>
                              </div>
                              <div class="col">
                                 <input type="file" name="photo" class="form-control" id="image">
                              </div>                                          
                           </div>
                           <div class="row">
                              <div class="col">
                                 <button class="btn btn-primary btn-block" type="submit">Add Now</button>
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