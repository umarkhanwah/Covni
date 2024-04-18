@extends('dashboard')


@section('right')
    <div class="col-9 text-light text-center ">
                <div class="row">
                    <div class="col-4 mt-5">
                        <div class="Dash_chips">
                            <span style="color: black" class="">
                                No. of Hospital
                            </span>
                            <hr class="m-0 my-2 text-dark">
                            <h3 style="color: #FF6969;">{{$hospitals}}</h3>
                        </div>
                    </div>
                    <div class="col-4 mt-5">
                        <div class="Dash_chips">
                            <span style="color: black" class="">
                                No. of Patient
                            </span>
                            <hr class="m-0 my-2 text-dark">
                            <h3 style="color: #FF6969;">{{$users}}</h3>
                        </div>
                    </div>
                    <div class="col-4 mt-5">
                        <div class="Dash_chips">
                            <span style="color: black" class="">
                                Total Vaccine in stock
                            </span>
                            <hr class="m-0 my-2 text-dark">
                            <h3 style="color: #FF6969;">{{$totalQuantity}}</h3>
                        </div>
                    </div>
                    <div class="col-4 mt-5">
                        <div class="Dash_chips">
                            <span style="color: black" class="">
                                No. of Cases
                            </span>
                            <hr class="m-0 my-2 text-dark">
                            <h3 style="color: #FF6969;">{{$all}}</h3>
                        </div>
                    </div>
                    <div class="col-4 mt-5">
                        <div class="Dash_chips">
                            <span style="color: black" class="">
                                No. of Positive Cases
                            </span>
                            <hr class="m-0 my-2 text-dark">
                            <h3 style="color: #FF6969;">{{$positive}}</h3>
                        </div>
                    </div>
                    <div class="col-4 mt-5">
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

            
<!-- {{-- <a href="/a_logout" class="btn btn-danger">Logout</a> --}}

            {{-- {{ Auth::guard('hospital')->user()->name}} --}} -->
  @endsection  
  