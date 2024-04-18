@extends('dashboard')
@section('title')
   Add Vaccine - Covni
@endsection
@section('right')
<!-- <div class="row">
    <div class="col-8 mx-auto">
        <form method="POST" action="{{ route('vaccine.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Vaccine Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Vaccine</button>
        </form>
    </div>
</div> -->
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
                            <h6 class="loginAS_head mb-3"><i
                                    class="fa fa-arrow-left border-end border-black bg-dark text-light rounded-pill p-2 "></i>
                                <b class="border-start border-5 ms-5 ps-5" style="color: #FF6969;">List of Vaccine </b>
                            </h6>

                        </div>
                        <div class="col-lg-6 float-end">
                            <h6 class=" mt-2 float-end">Total Vaccine : <span style="font-weight: bold;">{{$totalQuantity}}</span></h6>

                        </div>
                    </div>


                    <hr style="color: rgb(0, 0, 0);">
                    <div class="row px-5">
                        <div class="col-12 mt-5 pt-5 d-flex justify-content-center">
                            <form method="POST" action="{{ route('vaccine.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <div class="dropdown">
                                        <!-- <button class="btn P_btn_FI btn-light dropdown-toggle" type="button"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Vaccine
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul> -->
                                        <input type="text" placeholder="Enter Vaccine Name" class="form-control P_btn_FI  dropdown-toggle" id="name" name="name" required>
            
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <!-- <input type="number" class="form-control P_btn_FI" id="exampleInputPassword1"
                                        placeholder="Qty"> -->
                                    <input type="number" class="form-control P_btn_FI" id="quantity" name="quantity" placeholder="Qty" required>
            
                                </div>
                                <button type="submit" class="btn float-end P_btn_login">Add Vaccine in stock</button>
                            </form>
                        </div>
                    </div>



                </div>
        </div>
@endsection