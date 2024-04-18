@extends('main')
@section('main')

<div class="row">
    <div class="col-5 mx-auto">
        <div class="alert alert-info">
           
            The Timing You Selected is Not Available , The Nearest timing available is <b>{{$time}}</b> , Do you wan't to Book this timing?
        </div>
        <form action="{{ route('booktiming') }}" method="post">
            @csrf
            <input type="hidden" name="hospital" value="{{ $selectedHospital }}">
            <input type="hidden" name="user_id" value="{{ $user_id }}">
            <input type="hidden" name="time" value="{{ $suggestedTimeString }}">
            <input type="hidden" name="date" value="{{ $selectedDate }}">
            <a href="" class="btn btn-danger">No , I will try Another</a>
            <button type="submit" class="btn btn-primary">Yes , Confirm</button>
        </form>
    </div>
</div>
@endsection