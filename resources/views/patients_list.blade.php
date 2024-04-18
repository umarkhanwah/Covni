@extends('h_main')
@section('right')

<div class="col-lg-9 mb-5" >
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
                        }

                        .form-label {
                            color: black;
                            padding: 0;
                        }

                        .result_positive {
                            background: greenyellow;
                        }

                        .result_negative {
                            background: red;
                            color: white;
                        }
                    </style>
                    <div class="row mt-4">
                        <div class="col-lg-6">
                            <h6 class="loginAS_head mb-3"><i class="fa fa-arrow-left border-end border-black bg-dark text-light rounded-pill p-2 "></i> <b class="border-start border-5 ms-5 ps-5" style="color: #FF6969;">List of Booked Timings</b></h6>

                        </div>
                        <div class="col-lg-6 float-end">
                            <h6 class=" mt-2 float-end">Total Appointments :<span style="font-weight: bold;">{{$count}}</span></h6>

                        </div>
                    </div>
                 

                    <hr style="color: rgb(0, 0, 0);">
                    <div class="row px-5">
                        <table class="table table-stripped table-hover">
                            <thead>

                                <tr>
                                    <td style="font-weight: bolder;">id</td>
                                    <td style="font-weight: bolder;">Booking</td>
                                    <td style="font-weight: bolder;">Patient Name</td>
                                    <td style="font-weight: bolder;">Patients Phone</td>
                                    <td style="font-weight: bolder;">Age</td>
                                    <td style="font-weight: bolder;">Gender</td>
                                    <td style="font-weight: bolder;">Actions</td>
                                
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($tests as $test)
                                @if($test->report_id == NULL)
                                    <tr >
                                        <td scope="row">{{$test->id}}</td>
                                        <td>{{$test->time." ".$test->date}}</td>
                                        <td scope="row">{{$test->user->name}}</td>
                                        <td>{{$test->user->phone}}</td>
                                        <td>{{$test->user->age}}</td>
                                        <td>{{$test->user->gender}}</td>
                                        <td>
                                            <form method="POST" class="d-inline" action="{{ route('update_user_id', ['test_id' => $test->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to decline?')">Decline</button>
                                            </form>
                                            <a href="{{ route('report_view', ['user_id' => $test->user->id, 'test_id' => $test->id]) }}" class="btn btn-success">Make Report</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="row mt-4">
                        <div class="col-lg-6">
                            <h6 class="loginAS_head mb-3"><i class="fa fa-arrow-left border-end border-black bg-dark text-light rounded-pill p-2 "></i> <b class="border-start border-5 ms-5 ps-5" style="color: #FF6969;">List of Booked Timings</b></h6>

                        </div>
                        <div class="col-lg-6 float-end">
                            <h6 class=" mt-2 float-end">Total Appointments :<span style="font-weight: bold;">{{$count}}</span></h6>

                        </div>
                    </div>
                 

                    <hr style="color: rgb(0, 0, 0);">
                    <div class="row px-5">
                        <table class="table table-stripped table-hover">
                            <thead>

                                <tr>
                                    <td style="font-weight: bolder;">id</td>
                                    <td style="font-weight: bolder;">Booking</td>
                                    <td style="font-weight: bolder;">Patient Name</td>
                                    <td style="font-weight: bolder;">Patients Phone</td>
                                    <td style="font-weight: bolder;">Age</td>
                                    <td style="font-weight: bolder;">Gender</td>
                                    <td style="font-weight: bolder;">Actions</td>
                                
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($tests as $test)

                                @if($test->report_id != NULL)
                                <tr class="table-secondary" >
                                <td scope="row">{{$test->user->name}}</td>
                                <td>{{$test->user->age}}</td>
                                <td>{{$test->user->gender}}</td>
                                <td>{{$test->report->status}}</td>
                                <td>{{$test->days." ".$test->timing}} </td>
                                <td>
                                    <form method="POST" action="{{ route('delete_record', ['test_id' => $test->report_id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete record</button>
                                    </form>
                                </td>

                                </tr>
                                @endif

                            @endforeach
                            </tbody>
                        </table>
                    </div> -->



                </div>
            </div>
@endsection