@extends('layout.app')

@section('title', 'Performance Management System')
@section('content')


<div class="container">
    <div class="row d-flex justify-content-center">
       <div class="col lg-12">
           <div class="card">
               <div class="card-header bg-success">
                  <h4 class="text-white mt-2"> <i class="fa fa-user text-white " style="font-size:26px;"></i> Ratee</h4>
               </div>
               <div class="card-body"> 
                <button class="btn btn-primary col-lg-2 ">New Form</button>
                
                   <div class="row mt-3">
                    <div class="col-lg-12 ">
                                <div class="card">
                                    <div class="card-header">All Ratee Forms</div>
                                    <div class="card-body ">
                                        <div class="p-2"style="height:350px;background:#D6D8DA;overflow:auto;">
       
                                            @foreach ($perf_ratee as $perform)
                                                <a href="/instruction/{{ $perform->cid }}/{{ $perform->ratee_cid }}">
       
                                                    <div class="p-2  m-2 bg-success rounded border border-white">
                                                        <p style="font-size:14px;" class="text-white">#
                                                            {{ $perform->cid }}
                                                            -
                                                            {{ $perform->document->doc_name }}
       
                                                            <br>
                                                            Last Updated : {{ $perform->updated_at }}
                                                        </p>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                   </div>
               </div>
           </div>
       </div>
    </div>
</div>


@endsection 