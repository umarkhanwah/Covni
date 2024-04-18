
@extends('u_main')
@section('title')
    Patient - Dashboard
@endsection
@section('right')




<div class="col-lg-9 text-light text-center mb-5">
                <div class="row">
                   
                    <div class="col-lg-4 mt-5">
                        <div class="Dash_chips">
                            <span style="color: black" class="">
                                No. of Appointments
                            </span>
                            <hr class="m-0 my-2 text-dark">
                            <h3 style="color: #FF6969;">{{$tests}}</h3>
                          </div>
                        </div>
                        
                        <div class="col-lg-4 mt-5">
                          <div class="Dash_chips">
                            <span style="color: black" class="">
                              No. of Reports
                            </span>
                            <hr class="m-0 my-2 text-dark">
                            <h3 style="color: #FF6969;">{{$reports}}</h3>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-5">
                        <div class="Dash_chips">
                            <span style="color: black" class="">
                                No. of Positive reports
                            </span>
                            <hr class="m-0 my-2 text-dark">
                            <h3 style="color: #FF6969;">{{$positive}}</h3>
                        </div>
                    </div>
                    <div class="col mt-5">
                        <div class="Dash_chips">
                            <span style="color: black" class="">
                                No. of Negative reports
                            </span>
                            <hr class="m-0 my-2 text-dark">
                            <h3 style="color: #FF6969;">{{$negative}}</h3>
                        </div>
                    </div>

                </div>
            </div>












@endsection
 