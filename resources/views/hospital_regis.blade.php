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
                            <h6 class="loginAS_head mb-3"><i class="fa fa-arrow-left border-end border-black bg-dark text-light rounded-pill p-2 "></i> <b class="border-start border-5 ms-5 ps-5" style="color: #FF6969;">List of registered Hospital</b></h6>

                        </div>
                        <div class="col-lg-6 float-end">
                            <h6 class=" mt-2 float-end">Total hospital <span style="font-weight: bold;">{{$count}}</span></h6>

                        </div>
                    </div>
                 

                    <hr style="color: rgb(0, 0, 0);">
                    <div class="row px-5">
                    <form action="{{ route('update.permissions') }}" method="post">
                        @csrf
                        <table class="table table-stripped table-hover">
                            <thead>
                                            
                                <tr>
                                    <td style="font-weight: bolder;">id</td>
                                    <td style="font-weight: bolder;">Registered Date & Time</td>
                                    <td style="font-weight: bolder;">Hospital</td>
                                    <td style="font-weight: bolder;">Email</td>
                                    <td style="font-weight: bolder;">Country</td>
                                    <td style="font-weight: bolder;">City</td>
                                    <td style="font-weight: bolder;">Adress</td>
                                    <td style="font-weight: bolder;">Permissions</td>
                                    <!-- <td style="font-weight: bolder;">Causes</td> -->
                                    <!-- <td style="font-weight: bolder;">Postitve</td> -->
                                    <!-- <td style="font-weight: bolder;">Negative</td> -->
                                </tr>
                            </thead>
                            <tbody>
                                           @foreach ($hospitals as $h)
                                                  <tr class="table-light" >
                                                      <td scope="row" >{{$h->id}}</td>
                                                      <td  >{{$h->created_at}}</td>
                                                      <td  >{{$h->name}}</td>
                                                      <td  >{{$h->email}}</td>
                                                      <td  >{{$h->country}}</td>
                                                      <td  >{{$h->city}}</td>
                                                      <td  >{{$h->adress}}</td>
                                                      <td  >
                                                                                          {{-- Failed Practices --}}
                                                                                          {{-- <form action="" method="post">

                                                                                              <div class="form-check form-switch">
                                                                                                  <input class="form-check-input" type="checkbox" name="permission" id="flexSwitchCheckDefault">
                                                                                                  <label class="form-check-label" for="flexSwitchCheckDefault">Confirm Hospital Registration</label>
                                                                                              </div>
                                                                                              
                                                                                          </form> --}}
                                                                                          {{-- <form action="{{ route('update.permissions') }}" method="post">

                                                                                              @csrf --}}
                                                                                              {{-- <div class="form-check form-switch">
                                                                                                  
                                                                                                  <input class="form-check-input" type="checkbox" name="permission[{{$h->id}}]" id="permission{{$h->id}}" {{ $h->permission ? 'checked' : '' }}>
                                                                                                  <label class="form-check-label" for="flexSwitchCheckDefault">Confirm Hospital Registration</label>
                                                                                                </div> --}}
                                                                                                {{-- <div class="form-check form-switch">
                                                                                                  <input type="hidden" name="permissions[{{ $h->id }}]" value="no">
                                                                                                  <form action="{{ route('update.permissions') }}" method="post">
                                                                                                    @csrf
                                                                                                    <button type="submit" >
                                                                                                      <input class="" type="checkbox" name="permissions[{{ $h->id }}]" id="permission_{{ $h->id }}" value="yes" @if ($h->permission == 'yes') checked @endif>
                                                                                                      
                                                                                                    </button>
                                                                                                  </form>
                                                                                              </div> --}}
                                                          <div class="form-check form-switch">
                                                              <input type="hidden" name="permissions[{{ $h->id }}]" value="no">
                                                            
                                                              <input class="form-check-input" type="checkbox" name="permissions[{{ $h->id }}]" id="permission_{{ $h->id }}" value="yes" @if ($h->permission == 'yes') checked @endif>
                                                              <label class="form-check-label" for="permission_{{ $h->id }}">Confirm Hospital Registration</label>
                                                          </div>
                                                
                                                          
                                                      </td>
                                                  </tr>
                                                      
                                            @endforeach
                             
                               
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-info float-end">Update Permissions</button>
                    </form>
                    </div>



                </div>
            </div>






@endsection