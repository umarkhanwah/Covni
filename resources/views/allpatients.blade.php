@extends('dashboard')


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
                            <h6 class="loginAS_head mb-3"><i class="fa fa-arrow-left border-end border-black bg-dark text-light rounded-pill p-2 "></i> <b class="border-start border-5 ms-5 ps-5" style="color: #FF6969;">List of Patient</b></h6>

                        </div>
                        <div class="col-lg-6 float-end">
                            <h6 class=" mt-2 float-end">Total Patients <span style="font-weight: bold;">{{$count}}</span></h6>

                        </div>
                    </div>                 
                    <hr style="color: rgb(0, 0, 0);">
                    <div class="row px-5">
                        <table class="table table-stripped table-hover">
                            <thead>

                                <tr>
                                    <td style="font-weight: bolder;">id</td>
                                    <td style="font-weight: bolder;">Registration Date & Time</td>
                                    <td style="font-weight: bolder;">Patient Name</td>
                                    <td style="font-weight: bolder;">Patients Phone</td>
                                    <td style="font-weight: bolder;">Age</td>
                                    <td style="font-weight: bolder;">Gender</td>
                                
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $h)
                                <tr>
                                <td scope="row" >{{$h->id}}</td>
                                <td  >{{$h->created_at}}</td>
                                <td  >{{$h->name}}</td>
                                <td  >{{$h->phone}}</td>
                                <td  >{{$h->age}}</td>
                                <td  >{{$h->gender}}</td>
                                </tr>
                        
                                           
                                @endforeach 
                            </tbody>
                        </table>
                    </div>



                </div>
            </div>


@endsection
