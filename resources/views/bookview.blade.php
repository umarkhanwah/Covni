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
                                <h6 class="loginAS_head mb-3">Book an apointment</h6>
                            </div>
                           
                            <hr style="color: rgb(0, 0, 0);">
                            <div class="col-12 mt-5 pt-5 d-flex justify-content-center">
                            <form action="" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <!-- <div class="dropdown"> -->
                                        <select name="hospital"class="form-control P_btn_FI  form-select" id="">
                                            @foreach($hospitals as $hosp)
                                                <option value="{{$hosp->id}}">{{$hosp->name}}</option>
                                            @endforeach    
                                        </select>
                                        @error('hospital')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                
                                        <!-- </div> -->
                                    </div>
                                    <div class="mb-3">
                                        <!-- <div class="dropdown"> -->
                                        <input type="hidden" value="{{$user_id}}" name="user_id"  class="form-control  " readonly id="">
                                        <input type="time" name="time" class="form-control P_btn_FI " id="">
                                        @error('time')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror

                                          
                                        <!-- </div> -->
                                    </div>

                                    <div class="mb-3">
                                        <input type="date" name="date"  class="form-control P_btn_FI " id="">
                                        
                                        
                                        @error('date')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        <!-- <input type="datetime-local" class="form-control P_btn_FI" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email address"> -->
                                    </div>
                                    <button type="submit" class="btn float-end P_btn_login">Check for apointment</button>
                                    @if ($errors->has('error'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('error') }}
                                        </div>
                                        <div class="form-group">
                                            <label for="time">Available Time Slots:</label>
                                            <select name="time" class="form-control form-select my-3">
                                                @foreach ($availableTimeSlots as $timeSlot)
                                                    <option value="{{ $timeSlot }}">{{ $timeSlot }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    @endif
                                </form>
                </div>                
            </div>
            </div>

@endsection