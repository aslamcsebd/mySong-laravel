@extends('layouts.app')

@section('content')
   <div class="container singer_list_page">      
      <div class="row justify-content-center">
         <div class="col-12 col-lg-8 col-md-4 col-sm-6 col-sm-12 mt-2 mb-2 singerList">
            <fieldset>
               <legend>Singer List [{{ $SingerListCount->count() }}]</legend>                
                  <table class="table singer_list_table table-bordered">
                     <thead class="bg-info">
                        <tr class="text-center">
                           <th idth="9%">No</th>
                           <th width="20%">Singer</th>
                           <th>Song Type</th>
                           <th width="10%">Country</th>
                           <th width="15%">Gender</th>
                           <th>Age</th>
                        </tr>
                     </thead>
                     <tbody>
                     @foreach($SingerLists as $SingerList)
                        <tr class="text-center">
                           <td> {{$loop->index + 1}}  </td>
                           <td>
                              @if($SingerList->photo !=null)

                              <img src="{{asset('SingerPhoto')}}/{{$SingerList->photo}}" class="img-thumbnail" alt="No Image found" width="60">
                              <br>
                              @endif

                              <span class="singerName"> {{$SingerList->singerName}}</span>
                           </td>
               
                           <td>{{ $SingerList->singerList_RelationTo_Songtype->songType}}</td>
                           <td>{{ $SingerList->country}}</td>
                           <td>{{ $SingerList->gender}}</td>
                           <td>
                              @if ($SingerList->dob!=null)

                                <p>[ {{ \Carbon\Carbon::parse($SingerList->dob)->format('Y-M-d') }} ]</p>
                                                          
                                 {{\Carbon\Carbon::parse($SingerList->dob)->diff(\Carbon\Carbon::now())->format(' %y years ')}}                              
                              @endif
                           </td>                                 
                        </tr>
                      @endforeach                                               
                        </tbody>
                  </table>
            </fieldset>
         </div>
      </div>      
   </div>
@endsection