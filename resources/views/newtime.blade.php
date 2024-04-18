@extends('u_main')
@section('right')
<div class="col-lg-9  mb-5">
                <div class="row">
                        <style>
                            .loginAS_head {
                                color: rgb(0, 0, 0);
                                font-size: 1.5rem;
                                text-align: left;
                            }   
                            
                            .P_btn_login {
                                border-radius: 10px;
                                /* padding: 0px 10px; */
                                border: 2px solid #FF6969;
                                font-weight: 900;
                                /* color: white; */
                                transform: skew(10deg);
                                transition: 0.5s;
                            }            
                            .P_btn_login:hover {
                                border-radius: 10px;
                                background: #FF6969;
                                /* border: 20px solid #ffffff; */
                                box-shadow: 0px 0px 50px 1px #FF6969;
                                transform: scale(1.05) skew(0deg);
                            }
                            
                            .P_btn_login_active {
                                border-radius: 10px;
                                /* padding: 0px 10px; */
                                border: 2px solid #FF6969;
                                font-weight: 900;
                                color: white;
                                transform: skew(10deg);
                                transition: 0.5s;
                                background: #FF6969;
                            }
                            
                            .P_btn_FI {
                                border: 2px solid #FF6969;
                                border-radius: 40px;
                                width: 20vw;
                            }.form-label{
                                color: black;
                                padding: 0;
                            }
                        </style>
                            <div class="col-lg-12 mt-4">
                                <h6 class="loginAS_head mb-3">Already Booked :(</h6>
                            </div>
                           
                            <hr style="color: rgb(0, 0, 0);">
                            <div class="row">
                                    <div class="col-5 mx-auto">
                                        <div class="alert alert-info">
                                        
                                            The Timing You Selected is Not Available , The Nearest timing available is <b>{{$time}}</b> , Do you wan't to Book this timing?
                                        </div>
                                        <form action="{{ route('booktiming') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="hospital" value="{{ $selectedHospital }}">
                                            <input type="hidden" name="user_id" value="{{ $user_id }}">
                                            <input type="hidden" name="time" value="{{ $suggestedTimeString }}">
                                            <input type="hidden" name="date" value="{{ $selectedDate }}">
                                            <a href="" class="btn btn-danger">No , I will try Another</a>
                                            <button type="submit" class="btn btn-primary">Yes , Confirm</button>
                                        </form>
                                    </div>
                            </div>             
            </div>
            </div>
<!-- <div class="row">
    <div class="col-5 mx-auto">
        <div class="alert alert-info">
           
            The Timing You Selected is Not Available , The Nearest timing available is <b>{{$time}}</b> , Do you wan't to Book this timing?
        </div>
        <form action="{{ route('booktiming') }}" method="post">
            @csrf
            <input type="hidden" name="hospital" value="{{ $selectedHospital }}">
            <input type="hidden" name="user_id" value="{{ $user_id }}">
            <input type="hidden" name="time" value="{{ $suggestedTimeString }}">
            <input type="hidden" name="date" value="{{ $selectedDate }}">
            <a href="" class="btn btn-danger">No , I will try Another</a>
            <button type="submit" class="btn btn-primary">Yes , Confirm</button>
        </form>
    </div>
</div> -->
@endsection