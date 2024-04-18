@extends('main')
@section('main')

<div class="row">

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
</div>

<div class="row">
    <h2 class="display-5">
        Needed Vaccines
    </h2>
</div>
<div class="row">
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
                <a href="#" class="btn vaccine-link btn-primary" data-vaccine-id="{{ $vaccine->vaccine->id }}">Buy Vaccine</a>
              </div>
            </div>
    </div>
    <div class="modal fade text-dark" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div>
    <script>
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
  </script>

    @endif
    @endforeach
</div>
<div class="row">
    <h2 class="display-5">
        Available Vaccines
    </h2>
</div>
<div class="row">
    @foreach($all_vaccines as $vaccine)
    @if($vaccine->hospital)
    <div class="col-4 my-2 ">
        <a href="#" class="vaccine-link text-light text-decoration-none" data-vaccine-id="{{ $vaccine->id }}">
      
            <div class="card w-100 bg-secondary">
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
        </a>
    </div>
 

    <div class="modal fade text-dark" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div>
    <script>
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
  </script>
    @endif
    @endforeach
</div>
@endsection