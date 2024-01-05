@extends('layout.app')

@section('title', 'Performance Management System')
@section('content')


<div class="container">
    <div class="row d-flex justify-content-center">
       <div class="col lg-12">
           <div class="card">
               <div class="card-header bg-primary">
                  <h4 class="text-white mt-2"> <i class="fa fa-user-o text-white " style="font-size:26px;"></i> Rater</h4>
               </div>
               <div class="card-body"> 
            
                   <div class="row ">
                    <div class="col-lg-12 ">
                                <div class="card">
                                    <div class="card-header">All Rater Forms</div>
                                    <div class="card-body ">
                                        <div class="p-2"style="height:350px;background:#D6D8DA;overflow:auto;">
       
                                            @foreach ($perf_rater as $perform)
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