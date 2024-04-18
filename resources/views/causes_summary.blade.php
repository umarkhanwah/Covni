@extends('h_main')
@section('right')

              <div class="col-lg-9 mb-5 text-light text-center ">

                <div class="row">
                    
                    <div class="col-lg-4 mt-5">
                        <div class="Dash_chips">
                            <span style="color: black" class="">
                                No. of Cases
                            </span>
                            <hr class="m-0 my-2 text-dark">
                            <h3 style="color: #FF6969;">{{$cases}}</h3>
                        </div>
                    </div>
                    <div class="col mt-5">
                        <div class="Dash_chips">
                            <span style="color: black" class="">
                                No. of Positive Cases
                            </span>
                            <hr class="m-0 my-2 text-dark">
                            <h3 style="color: #FF6969;">{{$positive}}</h3>
                        </div>
                    </div>
                    <div class="col mt-5">
                        <div class="Dash_chips">
                            <span style="color: black" class="">
                                No. of Negative Cases
                            </span>
                            <hr class="m-0 my-2 text-dark">
                            <h3 style="color: #FF6969;">{{$negative}}</h3>
                        </div>
                    </div>

                </div>
            </div>



@endsection