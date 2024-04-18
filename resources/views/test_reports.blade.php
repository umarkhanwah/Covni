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
                    <div class="col-lg-12 mt-4">
                        <h6 class="loginAS_head mb-3">Show previous apointment</h6>
                    </div>

                    <hr style="color: rgb(0, 0, 0);">
                    <div class="row px-5">
                    @foreach($testReports as $reports)
                        <div class="col-lg-5 mx-auto card {{ $reports->status === 'Positive' ? 'result_negative' : 'result_positive' }} result_positive mt-4">
                            <div class="row m-0 p-0">
                                <div class="col-lg-5 m-0 p-0">
                                    <div style="background-color: rgb(187, 187, 187); height: 40vh; "
                                        class="report_preview p-0">
                                        <iframe src="{{ asset('pdf/u_report.pdf') }}" width="100%" class="h-100"></iframe>

                                    </div>
                                </div>

                                <div class="col-lg-7 d-flex justify-content-center align-items-center">
                                    <div class="">

                                        <h6>Hospital: {{$reports->hospital->name}}</h6>
                                        <h6>Date & Time: {{$reports->created_at}}</h6>
                                        <h6>Result: {{$reports->status}}</h6>
                                        <h6>Vaccine :  @if ($reports->vaccine)
                                            {{$reports->vaccine->name}}
                                        @else
                                            N/A
                                        @endif</h6>
                                        <div class="mt-5">

                                            <a href="/u_report/{{$reports->id}}" class="btn btn-primary">Preview</a>
                                            <a href="/u_report/{{$reports->id}}" class="btn btn-primary">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                        <!-- <div class="col-lg-6 card result_positive mt-4">
                            <div class="row m-0 p-0">
                                <div class="col-lg-5 m-0 p-0">
                                    <div style="background-color: rgb(187, 187, 187); height: 40vh;"
                                        class="report_preview">

                                    </div>
                                </div>
                                <div class="col-lg-7 d-flex justify-content-center align-items-center">
                                    <div class="">

                                        <h6>Hospital: Agha Khan</h6>
                                        <h6>Date & Time: 18-Sep-2023</h6>
                                        <h6>Result: Positive</h6>
                                        <div class="mt-5">

                                            <button class="btn btn-primary">Preview</button>
                                            <button class="btn btn-primary">Download</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 card result_negative mt-4">
                            <div class="row m-0 p-0">
                                <div class="col-lg-5 m-0 p-0">
                                    <div style="background-color: rgb(187, 187, 187); height: 40vh;"
                                        class="report_preview">

                                    </div>
                                </div>
                                <div class="col-lg-7 d-flex justify-content-center align-items-center">
                                    <div class="">

                                        <h6>Hospital: Agha Khan</h6>
                                        <h6>Date & Time: 18-Sep-2023</h6>
                                        <h6>Result: Positive</h6>
                                        <div class="mt-5">

                                            <button class="btn btn-primary">Preview</button>
                                            <button class="btn btn-primary">Download</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         -->

                        
                    </div>
            </div>
@endsection