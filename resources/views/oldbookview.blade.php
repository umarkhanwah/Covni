@extends('main')
@section('main')
    <div class="row">
        <div class="col-8 mx-auto">

            



            <form action="" method="post">
                @csrf
                <select name="hospital"class="form-control my-3 form-select" id="">
                    @foreach($hospitals as $hosp)
                        <option value="{{$hosp->id}}">{{$hosp->name}}</option>
                    @endforeach    
                </select>
                <input type="hidden" value="{{$user_id}}" name="user_id"  class="form-control my-3" readonly id="">
                <input type="time" name="time" class="form-control my-3" id="">
                

                <input type="date" name="date"  class="form-control my-3" id="">
                
                <button type="submit" id="datepicker" class="btn btn-info" name="submit">Book Appointment</button>
                @if ($errors->has('error'))
                    <div class="alert alert-danger">
                        {{ $errors->first('error') }}
                    </div>
                    <div class="form-group">
                        <label for="time">Available Time Slots:</label>
                        <select name="time" class="form-control form-select my-3">
                            @foreach ($availableTimeSlots as $timeSlot)
                                <option value="{{ $timeSlot }}">{{ $timeSlot }}</option>
                            @endforeach
                        </select>
                    </div>

                @endif
            </form>
            <script>
                    // Get today's date
                    var today = new Date();

                    // Format it as YYYY-MM-DD (required format for the date input)
                    var yyyy = today.getFullYear();
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
                    var dd = String(today.getDate()).padStart(2, '0');
                    var formattedDate = yyyy + '-' + mm + '-' + dd;

                    // Set the minimum date for the datepicker input
                    document.getElementById('datepicker').setAttribute('min', formattedDate);
            </script>

        </div>
    </div>
@endsection