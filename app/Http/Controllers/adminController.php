<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Hospital;
use App\Models\Vaccine;
use App\Models\test_timing;
use App\Models\test_report;
use App\Models\User;
use App\Models\booking;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;
use Illuminate\Support\Facades\Storage;

class adminController extends Controller
{
    //
    public function create(){
        return view('adminform');
    }
    public function store(Request $req){
        // dd($req->all());
        // $req->validate([
        //     'name'  => 'required',
        //     'email'  => 'required',
        //     'age'  => 'required',
        //     'gender'  => 'required',
        //     'phone'  => 'required | min:11 | max:11',
        //     'adress'  => 'required ',
        //     'password'  => 'required | min:6 | confirmed'
        // ]);
        $input = $req->all();
        $admin = Admin::all();
        // $admin->create($input);
        Admin::create([
            'name'  => $input['name'],
            'age'  => $input['age'],
            'adress'  => $input['adress'],
            'gender'  => $input['gender'],
            'phone'  => $input['phone'],
            'password'  => Hash::make($input['password'])
        ]);
        return redirect('/a_login');
    }
    public function index(){
  
        if (Auth::guard('user')->check()) {
            $user_id = Auth('user')->user()->id;
            // $timings = test_timing::whereNull('user_id')->get();
            // $timings = booking::with('hospital')->paginate(10); // Eager load the hospital relationship
            $tests = booking::where('user_id',$user_id)->count('id'); // Eager load the hospital relationship
            $reports = test_report::where('user_id',$user_id)->count('id'); // Eager load the hospital relationship
            $negative = test_report::where('user_id',$user_id)->where('status','positive')->count('id'); // Eager load the hospital relationship
            $positive = test_report::where('user_id',$user_id)->where('status','negative')->count('id'); // Eager load the hospital relationship
            // $timings = test_timing::with('hospital') // Eager load the hospital relationship
            // ->whereNull('user_id')
            // ->paginate(10);
            return view('u_dashboard', compact('tests','reports','negative','positive'));
        } 
        else if (Auth::guard('hospital')->check()) {
            $hosp_id = Auth('hospital')->user()->id;
            $patients = booking::where('hosp_id', $hosp_id)->count('id'); // Eager load the hospital relationship
            $vaccines = vaccine::where('hosp_id', $hosp_id)->sum('quantity'); // Eager load the hospital relationship
            $cases = test_report::where('hosp_id', $hosp_id)->count('id'); // Eager load the hospital relationship
            $positive = test_report::where('hosp_id', $hosp_id)->where('status', 'positive')->count('id'); // Eager load the hospital relationship
            $negative = test_report::where('hosp_id', $hosp_id)->where('status', 'negative')->count('id'); // Eager load the hospital relationship
            // $timings = test_timing::with('user') // Eager load the hospital relationship
            // ->whereNull('user_id')
            // ->get();
            return view('h_dashboard', compact('patients','vaccines','cases','positive','negative'));
        } 
        else if (Auth::guard('admin')->check()) {
            // $hospitals = Hospital::all();
            $hospitals = Hospital::count('id');
            // $users = User::all();
            $users = User::count('id');
            $totalQuantity = Vaccine::whereNull('hosp_id')->sum('quantity');;

            // $timings = test_timing::with('user','hospital') // Eager load the hospital relationship
            $timings = booking::with('user','hospital') // Eager load the hospital relationship
            ->whereNotNull('user_id')
            ->get();
            $all = test_report::count('id');
            $positive = test_report::where('status','positive')->count('id');
            $negative = test_report::where('status','negative')->count('id');
            // $reports = test_report::with('user','hospital') // Eager load the hospital relationship
            // ->get();
            return view('a_dashboard',compact('hospitals','all','negative', 'users','timings','positive','totalQuantity'));
        }
         else {
            return redirect('/allroles');
        }
    }
    public function timingPDF()
    {
        // Fetch the test report data from the database
        // $testReports = Test_report::all(); // Assuming you want to fetch all test reports
        // $test_timings = Test_timing::with('user', 'hospital')->whereNotNull('user_id')->get();
        $test_timings = booking::with('user', 'hospital')->whereNotNull('user_id')->get();

        // Load the view with the data
        $pdf = PDF::loadView('pdf.test_timings', compact('test_timings'));
        
        // To save the PDF to a specific directory within the storage/app/ directory:
        $pdfPath = public_path('pdf/test_timings.pdf');

        // Save the PDF to the public folder
        Storage::put('pdf/test_reports.pdf', $pdf->output());

        // To return the PDF as a response:
        return $pdf->stream('test_timings.pdf');
    }
    public function reportPDF()
    {
        // Fetch the test report data from the database
        // $testReports = Test_report::all(); // Assuming you want to fetch all test reports
        $testReports = Test_report::with('user', 'hospital')->get();

        // Load the view with the data
        $pdf = PDF::loadView('pdf.test_report', compact('testReports'));
        
        // To save the PDF to a specific directory within the storage/app/ directory:
        $pdfPath = public_path('pdf/test_reports.pdf');

        // Save the PDF to the public folder
        Storage::put('pdf/test_reports.pdf', $pdf->output());

        // To return the PDF as a response:
        return $pdf->stream('test_reports.pdf');
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
            return view('a_login');
        }
    }
    public function login(Request $request){
        $request->validate([
            'phone' =>  'required',
            'password'  =>  'required'
        ]);
        
    // $credentials = $request->only('email', 'password');
        // if(Auth::attempt($credentials))
    //     if(Auth::guard('admin')->attempt($credentials))
    // {
    //         return redirect('/');
    //     }
    if (Auth::guard('admin')->attempt($request->only('phone', 'password'))) {
        return redirect('/');
    }
    // dd($credentials);
        return redirect('/a_login')->with('warning', 'Email or password is incorrect');
    
    }
    function logout()
    {
        // Session::flush();
        

        // Auth::logout();
        // Auth::guard('hospital')->logout();
        Auth::guard('admin')->logout();
        return Redirect('/');
    }
    



    
    public function vaccine_form()
    {
        $totalQuantity = Vaccine::whereNull('hosp_id')->sum('quantity');;

        return view('a_vaccineform' ,compact('totalQuantity'));
    }

    public function add_vaccine(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
        ]);
        $a_vaccine = Vaccine::where('name', $validatedData['name'])->first();
    
        if ($a_vaccine) {   
            $a_vaccine->quantity += $validatedData['quantity'];
            $a_vaccine->save();
        }
        else{

            // Create a new vaccine record
            $vaccine = new Vaccine;
            $vaccine->name = $validatedData['name'];
            $vaccine->quantity = $validatedData['quantity'];
            $vaccine->save();
        }

        return redirect()->route('vaccine.create')->with('success', 'Vaccine added successfully.');
    }

    public function vaccine_list()
    {
        $vaccines = Vaccine::whereNull('hosp_id')->get();
        $hospitals = Hospital::all(); // Retrieve all hospitals
                $totalQuantity = Vaccine::whereNull('hosp_id')->sum('quantity');;
        
        return view('vaccine_list', compact('vaccines', 'hospitals' , 'totalQuantity'));
    }

    // Inserting new vaccine for hospital  
    // public function allocate_vaccines(Request $request)
    // {
    //     // Validate the form data
    //     $validatedData = $request->validate([
    //         'vaccine_id' => 'required|integer',
    //         'hosp_id' => 'required|integer',
    //         'allocation_quantity' => 'required|integer|min:0',
    //     ]);

    //     $vaccine = Vaccine::find($validatedData['vaccine_id']);
    //     $hosp_vaccine = Vaccine::find($validatedData['vaccine_id'])::whereNotNull('hosp_id');

    //     if ($vaccine) {
    //         // Create a new record with the selected hospital and quantity
    //         $newVaccine = new Vaccine();
    //         $newVaccine->name = $vaccine->name;
    //         $newVaccine->quantity = $validatedData['allocation_quantity'];
    //         $newVaccine->hosp_id = $validatedData['hosp_id'];
    //         $newVaccine->save();

    //         // Subtract the quantity from the old record
    //         $vaccine->quantity -= $validatedData['allocation_quantity'];
    //         $vaccine->save();

    //         return redirect()->route('vaccine.list')->with('success', 'Quantity allocated successfully.');
    //     } else {
    //         // Handle the case where the vaccine is not found
    //         // Redirect or return an error response
    //     }
    // }


    // My Work Not working
    // public function allocate_vaccines(Request $request)
    // {
    //     // Validate the form data
    //     $validatedData = $request->validate([
    //         'vaccine_id' => 'required|integer',
    //         'hosp_id' => 'required|integer',
    //         'allocation_quantity' => 'required|integer|min:0',
    //     ]);

    //     $vaccine = Vaccine::find($validatedData['vaccine_id']);
    //     $hosp_vaccine = Vaccine::find($validatedData['vaccine_id'])::whereNotNull('hosp_id');

    //     if ($hosp_vaccine) {
    //         // Increment old record which is already inserted
    //         // $newVaccine = $hosp_vaccine;
    //         $hosp_vaccine->name = $vaccine->name;
    //         $hosp_vaccine->quantity += $validatedData['allocation_quantity'];
    //         // $hosp_vaccine->hosp_id = $validatedData['hosp_id'];
    //         $hosp_vaccine->save();

    //         // Subtract the quantity from the old record
    //         $vaccine->quantity -= $validatedData['allocation_quantity'];
    //         $vaccine->save();

    //         // return redirect()->route('vaccine.list')->with('success', 'Quantity allocated successfully.');
    //     } else {
    //         // IF no record inserted , add a new vaccine with hso_id
    //         $newVaccine = new Vaccine();
    //         $newVaccine->name = $vaccine->name;
    //         $newVaccine->quantity = $validatedData['allocation_quantity'];
    //         $newVaccine->hosp_id = $validatedData['hosp_id'];
    //         $newVaccine->save();
            
    //         // Subtract the quantity from the old record
    //         $vaccine->quantity -= $validatedData['allocation_quantity'];
    //         $vaccine->save();
    //     }
    //     return redirect()->route('vaccine.list')->with('success', 'Quantity allocated successfully.');
    // }



    public function home(){
        $hosp = Hospital::count('id');
        $report = test_report::count('id');
        $positive = test_report::where('status','positive')->count('id');
        $negative = test_report::where('status','negative')->count('id');
        // $user = user::count('id');
        // $count = User::count('id');
        return view('index',compact('hosp','report','positive','negative'));
    }
    public function allpatients(){
        $users = User::all();
        $count = User::count('id');
        return view('allpatients',compact('users','count'));
    }
    public function trusted_hosp(){
        $hospitals = Hospital::where('permission','yes')->get();
        $count = Hospital::count('id');
        return view('trusted_hosp',compact('hospitals','count'));
    }
    public function hosp_list(){
            $hospitals = Hospital::all();
            $count = Hospital::count('id');
        return view('hospital_regis',compact('hospitals','count'));
    }
    public function allocate_vaccines(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'vaccine_id' => 'required|integer',
            'hosp_id' => 'required|integer',
            'allocation_quantity' => 'required|integer|min:0',
        ]);
    
        $vaccine = Vaccine::find($validatedData['vaccine_id']);
        
        // Find the existing hospital-specific vaccine record
        $hosp_vaccine = Vaccine::where('name', $vaccine->name)->where('hosp_id',$validatedData['hosp_id'] )->first();
    
        if ($hosp_vaccine) {
            // Increment the quantity of the existing hospital-specific record
            $hosp_vaccine->quantity += $validatedData['allocation_quantity'];
            $hosp_vaccine->save();
        } else {
            // Create a new hospital-specific vaccine record
            $newVaccine = new Vaccine();
            $newVaccine->name = $vaccine->name;
            $newVaccine->quantity = $validatedData['allocation_quantity'];
            $newVaccine->hosp_id = $validatedData['hosp_id'];
            $newVaccine->save();
        }
        
        // Subtract the quantity from the old record
        $vaccine->quantity -= $validatedData['allocation_quantity'];
        $vaccine->save();
    
        return redirect()->route('vaccine.list')->with('success', 'Quantity allocated successfully.');
    }
    


    // public function vaccine_list()
    // {
    //     $vaccines = Vaccine::all();
    //     return view('vaccine_list', compact('vaccines'));
    // }
    // public function allocate_vaccines(Request $request, $vaccineId)
    // {
    //  // Validate the form data
    //     $validatedData = $request->validate([
    //         'allocation_quantity' => 'required|integer|min:0',
    //     ]);

    //     $vaccine = Vaccine::find($vaccineId);

    //     if ($vaccine) {
    //         // Update the vaccine quantity with the allocated quantity
    //         $vaccine->quantity += $validatedData['allocation_quantity'];
    //         $vaccine->save();

    //         return redirect()->route('vaccine.list')->with('success', 'Quantity allocated successfully.');
    //     } else {
    //     // Handle the case where the vaccine is not found
    //     // Redirect or return an error response
    //         }
    // }



    
    public function adminVaccineList()
    {
        $vaccines = Vaccine::with('hospital')->get();
        $totalQuantity = Vaccine::whereNull('hosp_id')->sum('quantity');
        return view('admin_vaccine_list', compact('vaccines','totalQuantity'));
    }



    // Not Working
    // public function updateVaccineQuantity(Request $request)
    // {
    //     // Validate the form data
    //     $validatedData = $request->validate([
    //         'vaccine_name' => 'required|string',
    //         'update_quantity' => 'required|integer|min:0',
    //     ]);

    //     // Find the vaccine by name
    //     $vaccine = Vaccine::where('name', $validatedData['vaccine_name'])->first();

    //     if ($vaccine) {
    //         // Increment the existing vaccine's quantity
    //         $vaccine->quantity += $validatedData['update_quantity'];
    //         $vaccine->save();
    //     } else {
    //         // Handle the case where the vaccine is not found (optional)
    //         return redirect()->route('admin.vaccine.list')->with('error', 'Vaccine not found.');
    //     }

    //     return redirect()->route('admin.vaccine.list')->with('success', 'Vaccine quantity updated successfully.');
    // }


    // Updating the new quantity  
    public function updateVaccineQuantity(Request $request, $vaccine_id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'update_quantity' => 'required|integer|min:0',
        ]);

        // Find the vaccine by ID
        $vaccine = Vaccine::find($vaccine_id);

        if ($vaccine) {
            // Update the existing record
            // $vaccine->quantity = $validatedData['update_quantity'];
            $oldvalue = $vaccine->quantity;
            $vaccine->quantity = $oldvalue + $validatedData['update_quantity'];
            $vaccine->save();
        } else {
            // Handle the case where the vaccine is not found (optional)
            return redirect()->route('admin.vaccine.list')->with('error', 'Vaccine not found.');
        }

        return redirect()->route('admin.vaccine.list')->with('success', 'Vaccine quantity updated successfully.');
    }

    // public function updateVaccineQuantity(Request $request)
    // {
    //     // Validate the form data
    //     $validatedData = $request->validate([
    //         'update_quantity' => 'required|integer|min:0',
    //         'hosp_id' => 'required|integer',
    //         'vaccine_name' => 'required|string',
    //     ]);

    //     // Debugging: Dump the validated data
    //     dd($validatedData);

    //     // Find the vaccine by name and hospital ID
    //     $vaccine = Vaccine::where('name', $validatedData['vaccine_name'])
    //                     ->where('hosp_id', $validatedData['hosp_id'])
    //                     ->first();

    //     // Debugging: Dump the found vaccine
    //     dd($vaccine);

    //     if ($vaccine) {
    //         // Update the existing record
    //         $vaccine->quantity = $validatedData['update_quantity'];
    //         $vaccine->save();
    //     } else {
    //         // Create a new record
    //         $newVaccine = new Vaccine();
    //         $newVaccine->name = $validatedData['vaccine_name'];
    //         $newVaccine->quantity = $validatedData['update_quantity'];
    //         $newVaccine->hosp_id = $validatedData['hosp_id'];
    //         $newVaccine->save();
    //     }

    //     return redirect()->route('admin.vaccine.list')->with('success', 'Vaccine quantity updated successfully.');
    // }
    // public function updateVaccineQuantity(Request $request, $vaccineId)
    // {
    //     // Validate the form data
    //     $validatedData = $request->validate([
    //         'update_quantity' => 'required|integer|min:0',
    //     ]);

    //     $vaccine = Vaccine::find($vaccineId);

    //     if ($vaccine) {
    //         // Update the vaccine quantity
    //         $vaccine->quantity = $validatedData['update_quantity'];
    //         $vaccine->save();

    //         return redirect()->route('admin.vaccine.list')->with('success', 'Vaccine quantity updated successfully.');
    //     } else {
    //         // Handle the case where the vaccine is not found
    //         // Redirect or return an error response
    //     }
    // }
}
