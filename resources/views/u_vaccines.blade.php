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
                        <h6 class="loginAS_head mb-3">Needed Vaccines</h6>
                    </div>

                    <hr style="color: rgb(0, 0, 0);">
                    <div class="row px-5">
                    @foreach($needed_vaccines as $vaccine)
                        @if($vaccine->vaccine)
                        <div class="col-4">
                            <div class="card bg-danger">
                                        <!-- <img src="example" class="card-img-top" alt="bg-missing" /> -->
                                        <div class="card-body">
                                            <h5 class="card-title">{{$vaccine->vaccine->name}}</h5>
                                            <p class="card-text">
                                                {{ $vaccine->hospital->name }}
                                            </p>
                                            <form id="confirmForm" action="/update-vaccine/{{ $vaccine->vaccine->id }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary" onclick="return confirm('sure?')" id="confirmButton">
                                                    Buy Vaccine
                                                </button>
                                                <!-- <a href="#" class="btn vaccine-link btn-primary" data-vaccine-id="{{ $vaccine->vaccine->id }}">Buy Vaccine</a> -->
                                            </form>
                                        </div>
                                </div>
                        </div>
                        <!-- <div class="modal fade text-dark" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Confirm Vaccine</h5>
                                        <a href="/u_vaccines">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </a>
                                        </div>
                                    <form id="confirmForm" action="/update-vaccine/{{$vaccine->vaccine->id }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            Are you sure you want to Buy this vaccine ?
                                        </div>
                                        <div class="modal-footer">
                                        <a href="/u_vaccines"  class="">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="/">Cancel</button>
                                        </a>
                                        <button type="submit" class="btn btn-primary" id="confirmButton">Confirm</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> -->
                            <!-- <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                const vaccineLinks = document.querySelectorAll(".vaccine-link");
                        
                                vaccineLinks.forEach(link => {
                                    link.addEventListener("click", function () {
                                        const vaccineId = this.getAttribute("data-vaccine-id");
                                        const confirmModal = new bootstrap.Modal(document.getElementById("confirmModal"));
                        
                                        // Show the modal
                                        confirmModal.show();
                        
                                        // Handle "Confirm" button click
                                        document.getElementById("confirmButton").addEventListener("click", function () {
                                            // Perform AJAX request to update the vaccine record
                                            fetch(`/update-vaccine/${vaccineId}`, {
                                                method: 'POST',
                                                headers: {
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                    'Content-Type': 'application/json'
                                                },
                                                body: JSON.stringify({ vaccineId: vaccineId })
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                // Handle the response
                                                if (data.success) {
                                                    // Refresh the page or update the UI
                                                    window.location.reload();
                                                }
                                            });
                                        });
                                    });
                                });
                            });
                        </script> -->

                            @endif
                        @endforeach
                    
                    </div>
                        <div class="col-lg-12 mt-4">
                        <h6 class="loginAS_head mb-3">Available Vaccines</h6>
                    </div>
                    <hr style="color: rgb(0, 0, 0);">
                    <div class="row px-5">

                    @foreach($all_vaccines as $vaccine)
                            @if($vaccine->hospital)
                            <div class="col-4 my-2 ">
                                <form id="confirmForm" action="/update-vaccine/{{ $vaccine->id }}" method="POST">
                                        @csrf
                                    <button type="submit" class="border-0 text-start w-100" onclick="return confirm('sure?')" id="confirmButton">
                                <!-- <a href="#" class="vaccine-link text-light text-decoration-none" data-vaccine-id="{{ $vaccine->id }}"> -->
                                        <div class="card w-100 bg-info text-light">
                                            <!-- <img src="example" class="card-img-top" alt="bg-missing" /> -->
                                            <div class="card-body">
                                                <h5 class="card-title h-100">{{$vaccine->name}}</h5>
                                                <p class="card-text">
                                                    {{ $vaccine->hospital->name }}
                                                </p>
                                                <p class="card-text">
                                                    {{ $vaccine->quantity }}
                                                </p>
                                                <!-- <a href="#" class="btn btn-primary">Buy Vaccine</a> -->
                                            </div>
                                        </div>
                                    </button>
                                        <!-- </a> -->
                                </form>

                            </div>
                        

                            <!-- <div class="modal fade text-dark" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirm Vaccine</h5>
                                            <a href="/u_vaccines">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </a>
                                            </div>
                                        <form id="confirmForm" action="/update-vaccine/{{ $vaccine->id }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                Are you sure you want to Buy this vaccine ?
                                            </div>
                                            <div class="modal-footer">
                                            <a href="/u_vaccines"  class="">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="/">Cancel</button>
                                            </a>
                                            <button type="submit" class="btn btn-primary" id="confirmButton">Confirm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                const vaccineLinks = document.querySelectorAll(".vaccine-link");
                        
                                vaccineLinks.forEach(link => {
                                    link.addEventListener("click", function () {
                                        const vaccineId = this.getAttribute("data-vaccine-id");
                                        const confirmModal = new bootstrap.Modal(document.getElementById("confirmModal"));
                        
                                        // Show the modal
                                        confirmModal.show();
                        
                                        // Handle "Confirm" button click
                                        document.getElementById("confirmButton").addEventListener("click", function () {
                                            // Perform AJAX request to update the vaccine record
                                            fetch(`/update-vaccine/${vaccineId}`, {
                                                method: 'POST',
                                                headers: {
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                    'Content-Type': 'application/json'
                                                },
                                                body: JSON.stringify({ vaccineId: vaccineId })
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                // Handle the response
                                                if (data.success) {
                                                    // Refresh the page or update the UI
                                                    window.location.reload();
                                                }
                                            });
                                        });
                                    });
                                });
                                });
                            </script> -->
                            @endif
                            @endforeach

    
                            </div>
            </div>
@endsection