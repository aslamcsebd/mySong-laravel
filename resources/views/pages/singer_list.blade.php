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
                           <th>Serial</th>
                           <th>Singer</th>
                           <th>Song Type</th>
                           <th>Country</th>
                           <th>Gender</th>
                           <th>Age</th>
                        </tr>
                     </thead>
                     <tbody>
                     @forelse($SingerLists as $SingerList)  {{-- foreach don't have @empty option --}}
                        <tr class="text-center">
                           <td>{{$loop->index + $SingerLists->firstItem()}}</td>
                           <td>
                              @if($SingerList->photo !=null)

                              <img src="{{asset('SingerPhoto')}}/{{$SingerList->photo}}" class="img-thumbnail" alt="No Image found" width="60">
                              <br>
                              @endif

                              <span style="font-style: italic;"> {{$SingerList->singerName}}</span>
                           </td>
               
                           <td>{{ $SingerList->singerList_RelationTo_Songtype->songType}}</td>
                           <td>{{ $SingerList->country}}</td>
                           <td>{{ $SingerList->gender}}</td>
                           <td>
                              @if ($SingerList->dob!=null)

                                <p>[ {{ \Carbon\Carbon::parse($SingerList->dob)->format('Y-M-d') }} ]
                              </p>
                                                          
                                 {{\Carbon\Carbon::parse($SingerList->dob)->diff(\Carbon\Carbon::now())->format(' %y years ')}}                              
                              @endif
                           </td>                                 
                        </tr>
                      @empty
                        <tr class="text-center text-danger">
                           <td colspan="6">No data found...</td>
                        </tr>
                      @endforelse                                              
                        </tbody>
                  </table>
                  {{ $SingerLists->links() }}                 
            </fieldset>
         </div>
      </div>      
   </div>
@endsection