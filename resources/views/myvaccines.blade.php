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
                        <h6 class="loginAS_head mb-3">Owned Vaccines</h6>
                    </div>

                    <hr style="color: rgb(0, 0, 0);">
                    <div class="row px-5">
    @foreach($vaccines as $vaccine)
        <div class="col-3 mx-auto">
            <div class="card bg-info text-light" style="width: 18rem">
                  <!-- <img src="example" class="card-img-top" alt="bg-missing" /> -->
                  <div class="card-body">
                    <h5 class="card-title">{{$vaccine->vaccine->name}}</h5>
                    <!-- <p class="card-text">{{$vaccine->hosp_id}} -->
                    <p class="card-text">{{ optional($vaccine->hospital)->name }}</p>
                     </p>
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                  </div>
                </div>
        </div>
    @endforeach
</div>



</div>
            </div>

@endsection
