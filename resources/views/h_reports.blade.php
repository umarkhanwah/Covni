

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
                            <h6 class="loginAS_head mb-3"><i class="fa fa-arrow-left border-end border-black bg-dark text-light rounded-pill p-2 "></i> <b class="border-start border-5 ms-5 ps-5" style="color: #FF6969;">Test Reports</b></h6>

                        </div>
                        <div class="col-lg-6 float-end">
                            <h6 class=" mt-2 float-end">Total Reports : <span style="font-weight: bold;">{{$count}}</span></h6>

                        </div>
                    </div>
                 

                    <hr style="color: rgb(0, 0, 0);">
                    <div class="row px-5">
                        <table class="table table-stripped table-hover">
                            <thead>

                                <tr>
                                    <td style="font-weight: bolder;">ID</td>
                                    <td style="font-weight: bolder;">Patient Name</td>
                                    <td style="font-weight: bolder;">Status</td>
                                    <td style="font-weight: bolder;">Vaccination</td>
                                    <td style="font-weight: bolder;">Actions</td>
                                    <!-- <td style="font-weight: bolder;">Gender</td> -->
                                    <!-- <td style="font-weight: bolder;">Actions</td> -->
                                    <!-- <th scope="col">ID </th> -->
                                    <!-- <th scope="col"></th> -->
                                    <!-- <th scope="col">Status</th> -->
                                    <!-- <th scope="col">Vaccination</th> -->
                                
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($reports as $r)
                                <tr class="">
                                    <td scope="row">{{$r->id}}</td>
                                    <td>{{$r->user->name}}</td>
                                    <td>{{$r->status}}</td>
                                    <td>
                                        @if ($r->vaccine)
                                            {{$r->vaccine->name}}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/gen_report" class="btn btn-info">Download PDF</a>
                                        <a href="/delete_report/{{$r->id}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                


                </div>
            </div>
@endsection
