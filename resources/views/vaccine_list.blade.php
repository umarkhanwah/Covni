@extends('dashboard')

@section('right')
<!-- <div class="container ">
    <h2>Vaccine List</h2> -->
    <!-- <table class="table">
        <thead>
            <tr>
                <th>Vaccine Name</th>
                <th>Quantity</th>
                <th>Allocate Quantity</th>
            </tr>
        </thead>
        <tbody> -->
           
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
                                <b class="border-start border-5 ms-5 ps-5" style="color: #FF6969;">Issuance of Vaccine </b>
                            </h6>

                        </div>
                        <div class="col-lg-6 float-end">
                            <h6 class=" mt-2 float-end">Total Vaccine : <span style="font-weight: bold;">{{$totalQuantity}}</span></h6>

                        </div>
                    </div>


                    <hr style="color: rgb(0, 0, 0);">
                    <div class="row px-5">
                        <div class="col-12 mt-5 pt-5 d-flex justify-content-center">
                        <form method="POST" action="{{ route('vaccine.allocate') }}">
                        @csrf
                        <div class="mb-3">
                                <select class="form-control P_btn_FI form-select" id="vaccine_id" name="vaccine_id" required>
                                    @foreach($vaccines as $vaccine)
                                    <option value="{{ $vaccine->id }}">{{ $vaccine->name }}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="mb-3">
                                <select class="form-control P_btn_FI form-select" id="hosp_id" name="hosp_id" required>
                                    @foreach($hospitals as $hospital)
                                    <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="mb-3">
                                    <!-- <input type="number" class="form-control P_btn_FI" id="exampleInputPassword1"
                                        placeholder="Enter Vaccine qty"> -->
                                     <input type="number" placeholder="Enter Vaccine qty" class="form-control P_btn_FI" id="allocation_quantity" name="allocation_quantity" min="0" required>

                                </div>
                                <button type="submit" class="btn float-end P_btn_login">Give to this hospital</button>
                            </form>
                        </div>
                    </div>

    

                </div>
            </div>
    <!-- <form method="POST" action="{{ route('vaccine.allocate') }}">
        @csrf
        <div class="form-group">
            <label for="vaccine_id">Select Vaccine:</label>
            <select class="form-control P_btn_FI form-select" id="vaccine_id" name="vaccine_id" required>
                @foreach($vaccines as $vaccine)
                  <option value="{{ $vaccine->id }}">{{ $vaccine->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="hosp_id">Select Hospital:</label>
            <select class="form-control P_btn_FI form-select" id="hosp_id" name="hosp_id" required>
                @foreach($hospitals as $hospital)
                <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="allocation_quantity">Allocate Quantity:</label>
            <input type="number" class="form-control P_btn_FI" id="allocation_quantity" name="allocation_quantity" min="0" required>
        </div>
        <button type="submit" class="btn btn-primary">Allocate</button>

    </form> -->
            <!-- @foreach($vaccines as $vaccine)
            <tr class="text-light">
                <td>{{ $vaccine->name }}</td>
                <td>{{ $vaccine->quantity }}</td>
                <td>
               
                <form method="POST" action="{{ route('vaccine.allocate', ['vaccine_id' => $vaccine->id]) }}">
                        @csrf
                        <div class="form-group">
                            <input type="number" class="form-control" name="allocation_quantity" min="0" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Allocate</button>
                    </form>
                </td>
            </tr>
            @endforeach -->
        <!-- </tbody>
    </table> -->
<!-- </div> -->
@endsection
