<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking; // Import the Booking model
use App\Models\Hospital;
use App\Models\test_timing;
use App\Models\Test_report;
use App\Models\Vaccine;
use App\Models\User_vaccine;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class userController extends Controller
{
    // public function index(){
    //     if(Auth::guard('user')->id()){
    //         return view('u_dashboard');
    //     }
    //     else if(Auth::guard('hospital')->id()){
    //         return view('h_dashboard');
    //     }
    //     else{
    //         return redirect('/u_login');
    //     }
    // }
    public function create(){
        return view('userform');
    }
    public function store(Request $req){
        $req->validate([
            'name'  => 'required',
            'age'  => 'required',
            'gender'  => 'required',
            'phone'  => 'required | min:11 | max:11',
            'adress'  => 'required ',
            // 'img'  => 'required ',
            'password'  => 'required | min:6 | confirmed'
        ]);
        $input = $req->all();
        User::create([
            'name'  => $input['name'],
            'age'  => $input['age'],
            'adress'  => $input['adress'],
            'gender'  => $input['gender'],
            'phone'  => $input['phone'],
            'password'  => Hash::make($input['password'])
        ]);

        return redirect('/u_login');
    }
    public function edit($id){
        $user = User::find($id);
        return view('u_edit', compact('user'));
    }
    public function update(Request $req){
        $req->validate([
            'name'  => 'required',
            'age'  => 'required',
            'gender'  => 'required',
            'phone'  => 'required | min:11 | max:11',
            'adress'  => 'required ',
            'password'  => 'required | min:6 | confirmed'
        ]);
       
        $user = User::findOrFail($req->id); // Find the user by ID

        $input = $req->all();
        $user->update([
            'name'     => $input['name'],
            'age'      => $input['age'],
            'adress'   => $input['adress'],
            'gender'   => $input['gender'],
            'phone'    => $input['phone'],
            'password' => Hash::make($input['password'])
        ]);
        return redirect('/');
    }
    public function login_view(Request $request){
        if(Auth::guard('hospital')->check()){
            return redirect('/');
        }
        else if(Auth::guard('user')->check()){
            return redirect('/');
        }
        else if(Auth::guard('admin')->check()){
            return redirect('/');
        }
        else{
            return view('u_login');
        }
    }
    public function login(Request $request){
        $request->validate([
            'phone' =>  'required',
            'password'  =>  'required'
        ]);
        $credentials = $request->only('phone', 'password');

        // if(Auth::attempt($credentials))
        if(Auth::guard('user')->attempt($credentials))
    {
        return redirect('/');
    }
    
    // dd($credentials);
        return redirect('/u_login')->with('warning', 'Phone or password is incorrect');
    
    }
    function logout()
    {
        // Session::flush();

        // Auth::logout();
        // Auth::guard('hospital')->logout();
        Auth::guard('user')->logout();
        return Redirect('/');
    }
   
    function delete(Request $req)
    {
        User::find($req->id)->delete();
        return redirect('/');
    }
    
    public function updateTiming(Request $request, $timingId)
{
    $user = Auth::guard('user')->user();

    if ($user) {
        // $timing = test_timing::find($timingId);
        $timing = Test_timing::where('id', $timingId)->first();

        // Update the timing record
        $timing->update([
            'user_id' => $user->id,
        ]);

        return redirect('/');
        // return response()->json(['success' => true]);
    }
    return redirect('/');
    // return response()->json(['success' => false]);
}


    public function booked_records(){
        $user = Auth::guard('user')->user();
        if ($user) {
            // $tests = test_timing::with('hospital')->find($user->id);
            // $tests = test_timing::with('hospital')->where('user_id', $user->id)->get();
            $tests = booking::with('hospital')->where('user_id', $user->id)->get();
            
            
    
            return view('u_booked_records' , compact('tests'));
            // return response()->json(['success' => true]);
        }
        return redirect('/');
    }
    public function delete_timing($timingId){
        // $timing = test_timing::find($timingId);
        $timing = booking::find($timingId);
        
        // Update the timing record
        $timing->delete();
        // $timing->update([
        //     'user_id' => null,
        // ]); 
        return redirect('/booked_records');
    }
    public function myreports(){
        $user_id = Auth::guard('user')->user()->id;
        // dd($user_id);
        $testReports = Test_report::with('user', 'hospital','vaccine')->where('user_id',$user_id)->get();
        // dd($testReports);
        return view('test_reports', compact('testReports'));
    }

   
    public function generatePDF($id)
    {
        // $user_id = Auth::guard('user')->user()->id;
        // Fetch the test report data from the database
        // $testReports = Test_report::all(); // Assuming you want to fetch all test reports
        $testReports = Test_report::with('user', 'hospital')->where('id',$id)->get();

        // Load the view with the data
        $pdf = PDF::loadView('pdf.u_report', compact('testReports'));

        // To save the PDF to a specific directory within the storage/app/ directory:
        $pdfPath = public_path('pdf/u_report.pdf');

        // Save the PDF to the public folder
        Storage::put('pdf/u_report.pdf', $pdf->output());

        // To return the PDF as a response:
        // return $pdf->stream('u_report.pdf');
        return $pdf->stream('u_report.pdf', ['Content-Type' => 'application/pdf']);

    }





    public function vaccines(){
        $user = Auth::guard('user')->user();
        if ($user) {
            $user_id = $user->id;
        $needed_vaccines = test_report::with('vaccine','hospital')->where('user_id' ,$user_id)->get();
        // $all_vaccines = Vaccine::with('hospital')->get();
        // $all_vaccines = Vaccine::all();
        $all_vaccines = Vaccine::with('hospital')->where('user_id' ,null)->get();
        return view('u_vaccines',compact('needed_vaccines','all_vaccines'));
        }
        else{
            return redirect("/u_login")->with('warning' , "Please Login First");
        }
    }

    
    // wothout try
    public function updateVaccine(Request $request, $vaccineId)
    {
        $user = Auth::guard('user')->user();
    
        if ($user) {
            // Check if the user has already bought a vaccine
            $existingUser_vaccine = User_vaccine::where('vaccine_id', $vaccineId)->first();
            
            if ($existingUser_vaccine) {
                // User has already bought a vaccine, prevent them from buying another
                return redirect('/u_vaccines')->with('error', 'You have already bought a vaccine.');
            }
    
            // Find the vaccine to purchase
            $vaccine = Vaccine::where('id', $vaccineId)->first();
            
            if (!$vaccine) {
                // Vaccine not found, handle accordingly (e.g., redirect with an error message)
                return redirect('/u_vaccines')->with('error', 'Vaccine not found.');
            }
    
            if ($vaccine->quantity < 1) {
                // Check if there are available vaccines
                return redirect('/u_vaccines')->with('error', 'No vaccines available.');
            }
    
            // Create a new User_vaccine record
            User_vaccine::create([
                'vaccine_id' => $vaccine->id,
                'user_id' => $user->id,
                'hosp_id' => $vaccine->hosp_id,
                'quantity' => 1,

                // 'vaccine_id' => $vaccineId,
            ]);
    
            // Subtract 1 from the quantity of the purchased vaccine
            $vaccine->decrement('quantity', 1);
    
            return redirect('/u_vaccines')->with('success', 'Vaccine purchased successfully.');
        }
    
        return redirect('/');
    }
    // public function updateVaccine(Request $request, $vaccineId)
    // {
    
    
    //     $user = Auth::guard('user')->user();
    //     try {
    //         // Your existing code for inserting the record goes here
    //         $existingUser_vaccine = User_vaccine::where('vaccine_id', $vaccineId)->first();
            
    //         if ($existingUser_vaccine) {
    //             // User has already bought a vaccine, prevent them from buying another
    //             return redirect('/u_vaccines')->with('error', 'You have already bought a vaccine.');
    //         }
    
    //         // Find the vaccine to purchase
    //         $vaccine = Vaccine::where('id', $vaccineId)->first();
            
    //         if (!$vaccine) {
    //             // Vaccine not found, handle accordingly (e.g., redirect with an error message)
    //             return redirect('/u_vaccines')->with('error', 'Vaccine not found.');
    //         }
    
    //         if ($vaccine->quantity < 1) {
    //             // Check if there are available vaccines
    //             return redirect('/u_vaccines')->with('error', 'No vaccines available.');
    //         }
    //         // Create a new User_vaccine record
    //         User_vaccine::create([
    //             'vaccine_id' => $vaccine->id,
    //             'user_id' => $user->id,
    //             'hosp_id' => $vaccine->hosp_id,
    //             'quantity' => 1,
    //         ]);
    
    //         // Rest of your code...
    //         $vaccine->decrement('quantity', 1);
    
    //         return redirect('/u_vaccines')->with('success', 'Vaccine purchased successfully.');
    //     } catch (\Exception $e) {
    //         // Log the exception for debugging
    //         \Log::error($e);
    
    //         // Handle the exception and provide a user-friendly error message if necessary
    //         return redirect('/u_vaccines')->with('error', 'An error occurred while purchasing the vaccine.');
    //     }
    //     // if ($user) {
    //     //     // Check if the user has already bought a vaccine
    //     //     $existingUser_vaccine = User_vaccine::where('vaccine_id', $vaccineId)->first();
            
    //     //     if ($existingUser_vaccine) {
    //     //         // User has already bought a vaccine, prevent them from buying another
    //     //         return redirect('/u_vaccines')->with('error', 'You have already bought a vaccine.');
    //     //     }
    
    //     //     // Find the vaccine to purchase
    //     //     $vaccine = Vaccine::where('id', $vaccineId)->first();
            
    //     //     if (!$vaccine) {
    //     //         // Vaccine not found, handle accordingly (e.g., redirect with an error message)
    //     //         return redirect('/u_vaccines')->with('error', 'Vaccine not found.');
    //     //     }
    
    //     //     if ($vaccine->quantity < 1) {
    //     //         // Check if there are available vaccines
    //     //         return redirect('/u_vaccines')->with('error', 'No vaccines available.');
    //     //     }
    
    //     //     // Create a new User_vaccine record
    //     //     User_vaccine::create([
    //     //         'vaccine_id' => $vaccine->id,
    //     //         'user_id' => $user->id,
    //     //         'hosp_id' => $vaccine->hosp_id,
    //     //         'quantity' => 1,

    //     //         // 'vaccine_id' => $vaccineId,
    //     //     ]);
    
    //     //     // Subtract 1 from the quantity of the purchased vaccine
    //     //     $vaccine->decrement('quantity', 1);
    
    //     //     return redirect('/u_vaccines')->with('success', 'Vaccine purchased successfully.');
    //     // }
    
    //     // return redirect('/');
    // }
    
    // public function updateVaccine(Request $request, $vaccineId)
    // {
    //     $user = Auth::guard('user')->user();

    //     if ($user) {
    //         // $timing = test_timing::find($timingId);
    //         $vaccine = Vaccine::where('id', $vaccineId)->first();

    //         // Update the timing record
    //         $vaccine->update([
    //             'user_id' => $user->id,
    //         ]);

    //         return redirect('/u_vaccines');
    //         // return response()->json(['success' => true]);
    //     }
    //     return redirect('/');
    //     // return response()->json(['success' => false]);
    // }







    // Failed
    // public function updateVaccine(Request $request, $vaccineId)
    // {
    //     $user = Auth::guard('user')->user();
    
    //     if ($user) {
    //         // Check if the user has already bought a vaccine
    //         $existingVaccine = Vaccine::where('user_id', $user->id)->first();
    
    //         if ($existingVaccine) {
    //             // User has already bought a vaccine, prevent them from buying another
    //             return redirect('/u_vaccines')->with('error', 'You have already bought a vaccine.');
    //         }
    
    //         // Find the vaccine that the user wants to buy
    //         $vaccine = Vaccine::where('id', $vaccineId)->first();
    
    //         if ($vaccine && $vaccine->quantity > 0) {
    //             // Start a database transaction to ensure consistency
    //             DB::beginTransaction();
    
    //             try {
    //                 // Create a new vaccine record for the user
    //                 Vaccine::create([
    //                     'name' => $vaccine->name,
    //                     'quantity' => 1,
    //                     'user_id' => $user->id,
    //                 ]);
    
    //                 // Subtract 1 from the hospital's vaccine quantity
    //                 $vaccine->decrement('quantity', 1);
    
    //                 // Commit the transaction
    //                 DB::commit();
    
    //                 return redirect('/u_vaccines')->with('success', 'Vaccine purchased successfully.');
    //             } catch (\Exception $e) {
    //                 // An error occurred, rollback the transaction
    //                 DB::rollback();
    //                 return redirect('/u_vaccines')->with('error', 'An error occurred while purchasing the vaccine.');
    //             }
    //         }
    //     }
    
    //     return redirect('/');
    // }
    
    

    public function myvaccines(){
        $user_id = Auth::guard('user')->user()->id;
        $vaccines = user_vaccine::with('hospital' , 'vaccine')->where('user_id',$user_id)->get();
        return view('myvaccines',compact('vaccines'));
    }
    
 
    


    //Working (No Suggestion) 
    public function bookview(){

        $user = Auth::guard('user')->user();
        if ($user) {
            $user_id = $user->id;

            $hospitals = hospital::where('permission','yes')->get();
            // $vaccines = user_vaccine::with('hospital' , 'vaccine')->where('user_id',$user_id)->get();
            return view('bookview',compact('user_id' , 'hospitals'));
            
        }
        else{
            return redirect("/u_login")->with('warning' , "Please Login First");
        }
    }
    


    // public function bookview()
    // {
    //     $user_id = Auth::guard('user')->user()->id;
    //     $hospitals = hospital::where('permission', 'yes')->get();
        
    //     // Initialize selectedHospital to a default value or null
    //     $selectedHospital = null;
    
    //     // Initialize selectedDate to a default value or null
    //     $selectedDate = null;
    
    //     // Initialize suggestedTimeString to an empty string
    //     $suggestedTimeString = '';
    
    //     return view('bookview', compact('user_id', 'hospitals', 'selectedHospital', 'selectedDate', 'suggestedTimeString'));
    // }
    
    
    






    // Bekaar
    // public function bookview(Request $request)
    // {
    //     $user_id = Auth::guard('user')->user()->id;
    //     $hospitals = hospital::where('permission', 'yes')->get();
    
    //     // Check if there's a conflict and get available time slots
    //     $availableTimeSlots = $request->session()->get('bookingConflict') ?? [];
    //     $formattedDate = now()->toDateString(); // Get today's date in YYYY-MM-DD format
    //     return view('bookview', compact('user_id', 'hospitals', 'availableTimeSlots', 'formattedDate'));

    //     // return view('bookview', compact('user_id', 'hospitals', 'availableTimeSlots'));
    // }
    
    // public function getAvailableTimings(Request $request)
    // {
    //     // Validate the incoming request data
    //     $request->validate([
    //         'hospital' => 'required|integer',
    //         'date' => 'required|date',
    //     ]);

    //     // Get the hospital ID and date from the request
    //     $hospitalId = $request->input('hospital');
    //     $selectedDate = $request->input('date');

    //     // Get the booked time slots for the selected hospital and date
    //     $bookedTimeSlots = DB::table('bookings')
    //         ->where('hosp_id', $hospitalId)
    //         ->where('date', $selectedDate)
    //         ->pluck('time')
    //         ->toArray();

    //     // Define your available time slots logic here
    //     $allTimeSlots = [
    //         '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30',
    //         '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30',
    //     ];

    //     // Filter out the booked time slots to get available time slots
    //     $availableTimeSlots = array_diff($allTimeSlots, $bookedTimeSlots);

    //     return $availableTimeSlots;
    // }






    //Increasing 15 Minutes but not increasing day 
    public function booktiming(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'hospital' => 'required|integer',
            'user_id' => 'required|integer',
            'time' => 'required|date_format:H:i|after:07:00|before:12:00',
            'date' => 'required|date|after:today',
        ]);
       
        // Get the user-selected time
        $userSelectedTime = Carbon::createFromFormat('H:i', $request->input('time'));
    
        // Initialize the suggested time with the user-selected time
        $suggestedTime = $userSelectedTime;
        $isAlreadyBooked = DB::table('bookings')
                ->where('hosp_id', $request->input('hospital'))
                ->where('time', $request->input('time'))
                ->where('date', $request->input('date'))
                ->exists();
        
            if ($isAlreadyBooked) {
                // The same date and time are already booked
                // Redirect back to the booking form with an error message
                // getAvailableTimings();
                // return redirect()->route('bookview')->withErrors(['error' => 'The selected date and time are already booked. Please choose another time.']);
                while (DB::table('bookings')
                    ->where('hosp_id', $request->input('hospital'))
                    ->where('time', $suggestedTime->format('H:i'))
                    ->where('date', $request->input('date'))
                    ->exists()
                ) {
                    // Increment the suggested time by 15 minutes
                    $suggestedTime->addMinutes(16);
                }
                // $user_id = Auth::guard('user')->user()->id;
                // Pass the suggested time to the view
                $time = $suggestedTime->format('h:i A');

                $suggestedTimeString = $suggestedTime->format('H:i');
                $selectedHospital = $request->input('hospital');
                $user_id = $request->input('user_id');
                $selectedDate = $request->input('date');
                
            
                return view('newtime', compact('user_id' ,'time','selectedDate','selectedHospital','suggestedTimeString'));
            }
       // Create a new booking record
        $booking = new Booking();
        $booking->hosp_id = $request->input('hospital');
        $booking->user_id = $request->input('user_id');
        $booking->time = $request->input('time');
        $booking->date = $request->input('date');
        
        // You might want to generate a report_id here or use some other logic
        $booking->report_id =NULL; // Replace with your logic
        
        $booking->save();
    
        // Redirect to a success page or return a response
        return redirect()->route('bookview')->with('success', 'Appointment booked successfully');


    }




    
    // Check if the same date and suggested time are already booked
    // public function booktiming(Request $request)
    // {
    //     // Validate the incoming request data
    //     $request->validate([
    //         'hospital' => 'required|integer',
    //         'user_id' => 'required|integer',
    //         'time' => 'required|date_format:H:i',
    //         'date' => 'required|date',
    //     ]);

    //     // Get the user-selected time and date
    //     $userSelectedTime = Carbon::createFromFormat('H:i', $request->input('time'));
    //     $userSelectedDate = Carbon::createFromFormat('Y-m-d', $request->input('date'));

    //     // Initialize the suggested time with the user-selected time
    //     $suggestedTime = $userSelectedTime;
    //     $isAlreadyBooked = DB::table('bookings')
    //         ->where('hosp_id', $request->input('hospital'))
    //         ->where('time', $request->input('time'))
    //         ->where('date', $request->input('date'))
    //         ->exists();

    //     if ($isAlreadyBooked) {
    //         // The same date and time are already booked
    //         // Increment the suggested time by 15 minutes until available
    //         while (DB::table('bookings')
    //             ->where('hosp_id', $request->input('hospital'))
    //             ->where('time', $suggestedTime->format('H:i'))
    //             ->where('date', $suggestedTime->format('Y-m-d'))
    //             ->exists()
    //         ) {
    //             // Increment the suggested time by 15 minutes
    //             $suggestedTime->addMinutes(15);

    //             // Check if 24 hours have passed
    //             if ($suggestedTime->diffInHours($userSelectedTime) >= 24) {
    //                 // Increment the date by 1 day
    //                 $userSelectedDate->addDay();
    //                 // Reset the time to the user-selected time
    //                 $suggestedTime->setTime($userSelectedTime->hour, $userSelectedTime->minute);
    //             }
    //         }
    //     }

    //     // Pass the suggested time and date to the view
    //     $suggestedTimeString = $suggestedTime->format('H:i');
    //     $selectedHospital = $request->input('hospital');
    //     $user_id = $request->input('user_id');
    //     $selectedDate = $userSelectedDate->format('Y-m-d');

    //     // Create a new booking record
    //     $booking = new Booking();
    //     $booking->hosp_id = $selectedHospital;
    //     $booking->user_id = $user_id;
    //     $booking->time = $suggestedTimeString;
    //     $booking->date = $selectedDate;

    //     // You might want to generate a report_id here or use some other logic
    //     $booking->report_id = NULL; // Replace with your logic

    //     $booking->save();

    //     // Redirect to a success page or return a response
    //     return redirect()->route('bookview')->with('success', 'Appointment booked successfully');
    // }






    //Perfect Working (Expected rror on same timing)
    // public function booktiming(Request $request){
    //     // Validate the incoming request data
    //     $request->validate([
    //         'hospital' => 'required|integer',
    //         'user_id' => 'required|integer',
    //         'time' => 'required|date_format:H:i',
    //         'date' => 'required|date',
    //     ]);
    
    //     // Check if the same date and time are already booked
    //     $isAlreadyBooked = DB::table('bookings')
    //         ->where('hosp_id', $request->input('hospital'))
    //         ->where('time', $request->input('time'))
    //         ->where('date', $request->input('date'))
    //         ->exists();
    
    //     if ($isAlreadyBooked) {
    //         // The same date and time are already booked
    //         // Redirect back to the booking form with an error message
    //         // getAvailableTimings();
    //         return redirect()->route('bookview')->withErrors(['error' => 'The selected date and time are already booked. Please choose another time.']);
    //     }
    
    //     // Create a new booking record
    //     $booking = new Booking();
    //     $booking->hosp_id = $request->input('hospital');
    //     $booking->user_id = $request->input('user_id');
    //     $booking->time = $request->input('time');
    //     $booking->date = $request->input('date');
        
    //     // You might want to generate a report_id here or use some other logic
    //     $booking->report_id =NULL; // Replace with your logic
        
    //     $booking->save();
    
    //     // Redirect to a success page or return a response
    //     return redirect()->route('bookview')->with('success', 'Appointment booked successfully');
    // }
    





    //Working (Same timings will be inserted) 
    // public function booktiming(Request $request){
    //     // Validate the incoming request data
    //     $request->validate([
    //         'hospital' => 'required|integer', // Assuming hospital is an integer
    //         'user_id' => 'required|integer',
    //         'time' => 'required|date_format:H:i',
    //         'date' => 'required|date',
    //     ]);

    //     // Create a new booking record
    //     $booking = new Booking();
    //     $booking->hosp_id = $request->input('hospital');
    //     $booking->user_id = $request->input('user_id');
    //     $booking->time = $request->input('time');
    //     $booking->date = $request->input('date');
        
    //     // You might want to generate a report_id here or use some other logic
    //     $booking->report_id = NULL; // Replace with your logic
        
    //     $booking->save();

    //     // Redirect to a success page or return a response
    //     return redirect()->route('bookview')->with('success', 'Appointment booked successfully');
    // }
}
