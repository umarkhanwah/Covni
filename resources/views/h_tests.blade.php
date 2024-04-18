@extends('main')
@section('title')
   Patients Appointments - Covni
@endsection
@section('main')
<div class="row">
   <h2 class="display-4 text-light text-center">
      Upcoming Tests
   </h2>
</div>
   <div class="row">
      <div class="col-8 mx-auto">
         <div class="table-responsive">
            <table class="table table-striped
            table-hover	
            table-borderless
            table-primary
            align-middle">
               <thead class="table-dark">
                  <caption>Patients Tests</caption>
                  <tr>
                     <th>Patient Name</th>
                     <th>Patient Age</th>
                     <th>Patient Sex</th>
                     <th>Test Timings</th>
                     <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody class="table-group-divider">
                  @foreach($tests as $test)
                     @if($test->report_id == NULL)
                        <tr class="table-secondary">
                              <td scope="row">{{$test->user->name}}</td>
                              <td>{{$test->user->age}}</td>
                              <td>{{$test->user->gender}}</td>
                              <td>{{$test->time." ".$test->date}}</td>
                              <td>
                                 <form method="POST" class="d-inline" action="{{ route('update_user_id', ['test_id' => $test->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to decline?')">Decline</button>
                                 </form>
                                 <a href="{{ route('report_view', ['user_id' => $test->user->id, 'test_id' => $test->id]) }}" class="btn btn-success">Make Report</a>
                              </td>
                        </tr>
                     @endif
                  @endforeach

                     <!-- @foreach($tests as $test)

                     @if($test->report_id == NULL)
                     <tr class="table-secondary" >
                        <td scope="row">{{$test->user->name}}</td>
                        <td>{{$test->user->age}}</td>
                        <td>{{$test->user->gender}}</td>
                        <td>{{$test->days." ".$test->timing}} </td>
                        <td>
                           <a href="#" class="btn btn-danger">Decline</a>
                           <a href="{{ route('report_view', ['user_id' => $test->user->id, 'test_id' => $test->id]) }}" class="btn btn-success">Make Report</a>

                           </td>
                     </tr>
                     @endif
                     
                     @endforeach -->
                  </tbody>
                  <tfoot>
                     
                  </tfoot>
            </table>
         </div>
         
      </div>
   </div>



   
<div class="row">
   <h2 class="display-4 text-light text-center">
      Previuos Tests
   </h2>
</div>

<div class="row">
      <div class="col-8 mx-auto">
         <div class="table-responsive">
            <table class="table table-striped
            table-hover	
            table-borderless
            table-primary
            align-middle">
               <thead class="table-dark">
                  <caption>Patients Tests</caption>
                  <tr>
                     <th>Patient Name</th>
                     <th>Patient Age</th>
                     <th>Patient Sex</th>
                     <th>Test Report</th>
                     <th>Test Timings</th>
                     <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody class="table-group-divider">
                     @foreach($tests as $test)

                     @if($test->report_id != NULL)
                     <tr class="table-secondary" >
                        <td scope="row">{{$test->user->name}}</td>
                        <td>{{$test->user->age}}</td>
                        <td>{{$test->user->gender}}</td>
                        <td>{{$test->report->status}}</td>
                        <td>{{$test->days." ".$test->timing}} </td>
                        <td>
                           <form method="POST" action="{{ route('delete_record', ['test_id' => $test->report_id]) }}">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete record</button>
                           </form>
                        </td>

                     </tr>
                     @endif
                     
                     @endforeach
                  </tbody>
                  <tfoot>
                     
                  </tfoot>
            </table>
         </div>
         
      </div>
   </div>
@endsection