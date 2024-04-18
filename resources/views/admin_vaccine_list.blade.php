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
                            <h6 class="loginAS_head mb-3"><i class="fa fa-arrow-left border-end border-black bg-dark text-light rounded-pill p-2 "></i> <b class="border-start border-5 ms-5 ps-5" style="color: #FF6969;">List of Vaccine </b></h6>

                        </div>
                        <div class="col-lg-6 float-end">
                            <h6 class=" mt-2 float-end">Total Vaccine : <span style="font-weight: bold;">{{$totalQuantity}}</span></h6>

                        </div>
                    </div>
                 

                    <hr style="color: rgb(0, 0, 0);">
                    <div class="row px-5">
                        <table class="table table-stripped table-hover">
                            <thead>

                                <tr>
                                    <td style="font-weight: bolder;">id</td>
                                    <td style="font-weight: bolder;">Registered Date & Time</td>
                                    <td style="font-weight: bolder;">Vacine Name</td>
                                    <!-- <td style="font-weight: bolder;">Inward</td>    
                                    <td style="font-weight: bolder;">Outward</td> -->
                                    <td style="font-weight: bolder;">Balance</td>
                                    <td style="font-weight: bolder;">Add Quantity</td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($vaccines as $vaccine)
                                @if($vaccine->hosp_id == NULL)
                                <tr class="text-light">
                                    <td>{{ $vaccine->id }}</td>
                                    <td>{{ $vaccine->created_at }}</td>
                                    <td>{{ $vaccine->name }}</td>
                                    <td>{{ $vaccine->quantity }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.vaccine.update', ['vaccine_id' => $vaccine->id]) }}">
                                            @csrf
                                            <!-- Change the HTTP method to POST -->
                                            @method('POST')
                                            <div class="row">

                                                <div class="form-group col-8">
                                                    <input type="number" class="form-control" name="update_quantity" min="0" required>
                                                </div>
                                                <div class="form-group col-4">
                                                    <button type="submit" class="btn btn-primary">Add</button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <table class="table">
                            <thead>
                                <tr class="text-light">
                                    <th>Vaccine Name</th>
                                    <th>Quantity</th>
                                    <th>Hospital Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vaccines as $vaccine)
                                @if($vaccine->hosp_id != NULL)
                                <tr class="text-light">
                                    <td>{{ $vaccine->name }}</td>
                                    <td>{{ $vaccine->quantity }}</td>
                                    <td>{{ $vaccine->hospital->name }}</td>
                            
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>



                </div>
            </div>
    <!-- <div class="row">
        <h2>Admin Vaccine List</h2>
        <table class="table">
            <thead>
                <tr class="text-light">
                    <th>Vaccine Name</th>
                    <th>Quantity</th>
                    <th>Update Quantity</th>
                </tr>
            </thead>
            <tbody>
            @foreach($vaccines as $vaccine)
                @if($vaccine->hosp_id == NULL)
                <tr class="text-light">
                    <td>{{ $vaccine->name }}</td>
                    <td>{{ $vaccine->quantity }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.vaccine.update', ['vaccine_id' => $vaccine->id]) }}">
                            @csrf
                  
                            @method('POST')
                            <div class="form-group">
                                <input type="number" class="form-control" name="update_quantity" min="0" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </td>
                </tr>
                @endif
            @endforeach
 
            @foreach($vaccines as $vaccine)
                @if($vaccine->hosp_id == NULL)
                <tr class="text-light">
                    <td>{{ $vaccine->name }}</td>
                    <td>{{ $vaccine->quantity }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.vaccine.update', ['vaccine_id' => $vaccine->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <input type="number" class="form-control" name="update_quantity" min="0" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        
    </div> -->








    <!-- <div class="row"> -->
        <!-- <h2>Hospitals Vaccine List</h2> -->
      
        
    <!-- </div> -->

@endsection