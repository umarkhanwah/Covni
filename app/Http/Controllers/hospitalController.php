<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\test_timing;
use App\Models\Booking;
use App\Models\vaccine;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;
use Illuminate\Support\Facades\Storage;
use App\Models\test_report;

class hospitalController extends Controller
{
  
    public function create(){
        return view('hospitalform');
    }
    public function store(Request $req){
        $req->validate([
            'name'  => 'required',
            'email'  => 'required | email ',
            'phone'  => 'required | min:11 | max:11',
            'adress'  => 'required ',
            'country'  => 'required ',
            'city'  => 'required ',
            'province'  => 'required ',
            'password'  => 'required | min:6 | confirmed'
        ]);
        $input = $req->all();
        Hospital::create([
            'name'  => $input['name'],
            'email'  => $input['email'],
            'phone'  => $input['phone'],
            'adress'  => $input['adress'],
            'country'  => $input['country'],
            'city'  => $input['city'],
            'province'  => $input['province'],
            'password'  => Hash::make($input['password'])
        ]);
        return redirect('/h_login');
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
            return view('h_login');
        }
    }
    public function login(Request $request){
        $request->validate([
            'email' =>  'required',
            'password'  =>  'required'
        ]);
        $credentials = $request->only('email', 'password');

        // if(Auth::attempt($credentials))
        if(Auth::guard('hospital')->attempt($credentials))
        {
            return redirect('/');
        }

        return redirect('/h_login')->with('warning', 'Email or password is incorrect');
    
    }
    public function edit($id){
        $hospital = hospital::find($id);
        return view('h_edit', compact('hospital'));
    }
    public function update(Request $req){
     $req->validate([
            'name'  => 'required',

            'email'  => 'required | email ',
            // 'email'  => 'required | email | unique',
            'phone'  => 'required | min:11 | max:11',
            'adress'  => 'required ',
            'country'  => 'required ',
            'city'  => 'required ',
            'province'  => 'required ',
            'password'  => 'required | min:6 | confirmed'
        ]);
       
        $hospital = hospital::findOrFail($req->id); // Find the user by ID

        $input = $req->all();
        $hospital->update([
            'name'  => $input['name'],
            'email'  => $input['email'],
            'phone'  => $input['phone'],
            'adress'  => $input['adress'],
            'country'  => $input['country'],
            'city'  => $input['city'],
            'province'  => $input['province'],
            'password'  => Hash::make($input['password'])
        ]);
        return redirect('/');
    }
    function logout()
    {
        // Session::flush();

        // Auth::logout();
        // Auth::guard('hospital')->logout();
        Auth::guard('hospital')->logout();
        return Redirect('/');
    }
       
    public function tests(){
        if(Auth::guard('hospital')->check()){
            // Select all records where 'user_id' is not null and eager load the user data
            // $tests = test_timing::whereNotNull('user_id')->with('user','report')->get();
            $tests = booking::with('user','report')->get();
            return view('h_tests', compact('tests'));
        }
    }
    
    
public function delete_rep($id)
{
    // Find the report by ID
    $report = Test_report::find($id);

    if (!$report) {
        return redirect()->back()->with('error', 'Report not found.');
    }

    // Find and update related bookings
    $bookings = Booking::where('report_id', $id)->get();

    foreach ($bookings as $booking) {
        $booking->report_id = null;
        $booking->save();
    }

    // Now, delete the report
    $report->delete();

    return redirect()->back()->with('success', 'Report deleted, and related bookings updated.');
}

    // public function delete_rep($id)
// {
//     // Find the report by its ID
//     $report = Test_report::find($id);

//     // Check if the report exists
//     if (!$report) {
//         return redirect()->back()->with('error', 'Report not found.');
//     }

//     // Delete the report
//     $report->delete();

//     return redirect()->back()->with('success', 'Report deleted successfully.');
// }

    // Decline Test Booking
    public function updateUserId($testId)
    {
        $testTiming = booking::find($testId);

        if ($testTiming) {
            // $testTiming->user_id = null; // Set user_id to null
            // $testTiming->save();
            $testTiming->delete();
            // Redirect or return a response as needed
            return redirect('/patient_list');
        } else {
            
            return redirect('/patient_list');
            // Handle the case where the record was not found
            // Redirect or return an error response
        }
    }

    // Delete Previuos test report
    public function deleteRecord($testId)
    {
        // Find the test record by ID and delete it
        $test = Test_report::find($testId);

        if ($test) {
            $test->delete();
            // Redirect or return a response as needed
            return redirect()->route('tests');
        } else {
            // Handle the case where the record was not found
            // Redirect or return an error response
        }
    }
    // public function tests()
    // {
    // if (Auth::guard('hospital')->check()) {
    //     // Select all records where 'user_id' is not null, eager load the user data, 
    //     // and filter tests without reports
    //     $tests = test_timing::whereNotNull('user_id')
    //         ->with('user')
    //         ->whereDoesntHave('report') // Only select tests without reports
    //         ->get();

    //     return view('h_tests', compact('tests'));
    // }
    // }

    public function report_view($user_id , $test_id)
    {
        $hosp_id = Auth::guard('hospital')->user()->id; // Get the logged-in hospital's ID
        $vaccines = vaccine::all();
        // Fetch the test record for the user and hospital
        $test = booking::where('user_id', $user_id)
            ->where('hosp_id', $hosp_id)
            ->first();

        if (!$test) {
            // logout();
            // Handle the case where the test record is not found, possibly show an error message or redirect.
        }

        // Load the 'h_report.blade.php' view and pass the user_id and hospital_id to it
        return view('h_report', [
            'test_id' => $test_id,
            'user_id' => $user_id,
            'hosp_id' => $hosp_id,
            'vaccines' => $vaccines,
        ]);
    }


    // public function generatePDF(Test_report $testReport)
    // {
    //     // Fetch the test report data from the database using the provided $testReport instance
    //     $pdf = PDF::loadView('pdf.test_report', compact('testReport'));

    //     // To save the PDF to a specific directory within the storage/app/ directory:
    //         $pdfPath = public_path('pdf/' . $testReport->id . '_test_report.pdf');

    //     // $pdf->save(storage_path($pdfPath));

    //     // Save the PDF to the public folder
    //     Storage::put('pdf/' . $testReport->id . '_test_report.pdf', $pdf->output());        // To return the PDF as a response:
    //     return $pdf->stream('test_report.pdf');
    // }
    
    public function h_vaccine_list(){
        $hosp_id = Auth('hospital')->user()->id;
        $vaccines = vaccine::where('hosp_id', $hosp_id)->get();
        $count = vaccine::where('hosp_id', $hosp_id)->sum('quantity');
        return view('h_vaccines' , compact('count','vaccines'));
    }
    public function causes(){
        $hosp_id = Auth('hospital')->user()->id;
        $cases = test_report::where('hosp_id', $hosp_id)->count('id'); // Eager load the hospital relationship
        $positive = test_report::where('hosp_id', $hosp_id)->where('status', 'positive')->count('id'); // Eager load the hospital relationship
        $negative = test_report::where('hosp_id', $hosp_id)->where('status', 'negative')->count('id'); // Eager load the hospital relationship
        // $timings = test_timing::with('user') // Eager load the hospital relationship
        // ->whereNull('user_id')
        // ->get();
        return view('causes_summary', compact('cases','positive','negative'));
    
    }
    public function patient_list(){
        $hosp_id = Auth('hospital')->user()->id;
        $tests = booking::with('user')->where('hosp_id', $hosp_id)->get();
        $count = booking::where('hosp_id', $hosp_id)->count('id');
        return view('patients_list' , compact('count','tests'));
    }
    public function h_reports(){
        $hosp_id = Auth::guard('hospital')->user()->id;
        $reports = test_report::where('hosp_id', $hosp_id)->get();
        $count = test_report::where('hosp_id', $hosp_id)->count('id');

        return view('h_reports',compact('reports' , 'count'));

    }
    public function generatePDF()
    {
        // Fetch the test report data from the database
        $hosp_id=Auth::guard('hospital')->user()->id;
        // $testReports = Test_report::all(); // Assuming you want to fetch all test reports
        $testReports = Test_report::with('user', 'hospital','vaccine')->where('hosp_id',$hosp_id)->get();

        // Load the view with the data
        $pdf = PDF::loadView('pdf.test_report', compact('testReports'));
        
        // To save the PDF to a specific directory within the storage/app/ directory:
        $pdfPath = public_path('pdf/test_reports.pdf');

        // Save the PDF to the public folder
        Storage::put('pdf/test_reports.pdf', $pdf->output());

        // To return the PDF as a response:
        return $pdf->stream('test_reports.pdf');
    }
    public function createTestReport(Request $request)
    {
        $testReport = new test_report;
        $testReport->hosp_id = $request->input('hosp_id'); 
        $testReport->user_id = $request->input('user_id'); 
        $testReport->status = $request->input('status');
        // $testReport->vaccination = $request->input('vaccination'); 
        $testReport->vaccine_id = $request->input('vaccine_id'); 
            // Save the TestReport record first to generate an ID
        $testReport->save();

        $test_id = $request->input('test_id');
    
        // Update the associated test_timing record
        $booking = booking::find($test_id);
        if ($booking) {
            $booking->report_id = $testReport->id;
            $booking->save();
        }
        // Old Work 
        // $testTiming = Test_timing::find($test_id);
        // if ($testTiming) {
        //     $testTiming->report_id = $testReport->id;
        //     $testTiming->save();
        // }
        
        // Generate the PDF report for the newly created test report
        $generatedPdf = $this->generatePDF($testReport);

        // Update the test report record with the PDF path
        $pdfPath = 'pdf/' . $testReport->id . '_test_report.pdf';
        $testReport->pdf_path = $pdfPath;
        $testReport->save();

        return redirect('/patient_list');
    }
  

//  ----------------------------------- Daaaaammnnnn CHat GPT--------------------------------------
        // public function generatePDF(Request $request)
        // {
        //     // Fetch data or create a new TestReport instance
        //     $testReport = Test_report::findOrNew($request->input('test_report_id'));
            
        //     // Populate the testReport object with your data as needed
        //     // Example: $testReport->status = $request->input('status');
            
        //     // Generate PDF
        //     $pdf = PDF::loadView('test_report_pdf', compact('testReport'));

        //     // Define a file name for the PDF (you can customize this)
        //     $pdfFileName = 'test_report_' . $testReport->id . '.pdf';

        //     // Save the PDF to a temporary location
        //     $pdfPath = storage_path('app/pdf/' . $pdfFileName);
        //     $pdf->save($pdfPath);

        //     // Optionally, you can store the PDF path in your database
        //     $testReport->pdf_path = $pdfPath;
        //     $testReport->save();

        //     // Return the PDF as a download response
        //     return response()->download($pdfPath, $pdfFileName)->deleteFileAfterSend(true);
        // }

        
        
        
        // public function generatePDF(Request $request)
        // {
        //     // Fetch data or create a new TestReport instance
        //     $testReport = TestReport::findOrNew($request->input('test_report_id'));
            
        //     // Populate the testReport object with your data as needed
        //     // Example: $testReport->status = $request->input('status');
            
        //     // Generate PDF
        //     $pdf = PDF::loadView('test_report_pdf', compact('testReport'));
        
        //     // Define a file name for the PDF (you can customize this)
        //     $pdfFileName = 'test_report_' . $testReport->id . '.pdf';
        
        //     // Save the PDF using Laravel's storage system
        //     Storage::put('pdf/' . $pdfFileName, $pdf->output());
        
        //     // Optionally, you can store the PDF path in your database
        //     $testReport->pdf_path = 'pdf/' . $pdfFileName;
        //     $testReport->save();
        
        //     // Return the PDF as a download response
        //     return response()->download(storage_path('app/pdf/' . $pdfFileName), $pdfFileName)->deleteFileAfterSend(true);
        // }
        //         public function createTestReport(Request $request)
        // {
        //     $testReport = new test_report;
        //     $testReport->hosp_id = $request->input('hosp_id'); 
        //     $testReport->user_id = $request->input('user_id'); 
        //     $testReport->status = $request->input('status');
        //     $testReport->vaccination = $request->input('vaccination'); 

        //     // Save the TestReport record first to generate an ID
        //     $testReport->save();

        //     // Generate PDF
        //     $pdf = PDF::loadView('test_report_pdf', compact('testReport'));

        //     // Define a file name for the PDF (you can customize this)
        //     $pdfFileName = 'test_report_' . $testReport->id . '.pdf';

        //     // Specify the path within the public folder where you want to save the PDF
        //     // $pdfFilePath = public_path().'pdf/' . $pdfFileName;
        //     $publicPath = public_path();
        //     $pdfRelativePath = 'pdf/';
        //     $pdfDestination = public_path($pdfRelativePath);
        //     Storage::put($pdfRelativePath . $pdfFileName, $pdf->output());

        //     // Save the PDF to the public folder using Laravel's storage system
        //     // Storage::put($pdfFilePath, $pdf->output());

        //     // Optionally, you can store the PDF path in your database
        //     $testReport->pdf_path = $pdfDestination;
        //     $testReport->save();

        //     return redirect('/tests');
        // }

        // Saving in Storage folder
        // public function createTestReport(Request $request)
        // {
        
        //     $testReport = new test_report;
        //     $testReport->hosp_id = $request->input('hosp_id'); 
        //     $testReport->user_id = $request->input('user_id'); 
        //     $testReport->status = $request->input('status');
        //     $testReport->vaccination = $request->input('vaccination'); 
            
        //     // Save the TestReport record first to generate an ID
        //     $testReport->save();

        
        //         // Generate PDF
        //     $pdf = PDF::loadView('test_report_pdf', compact('testReport'));
        
        //     // Define a file name for the PDF (you can customize this)
        //     $pdfFileName = 'test_report_' . $testReport->id . '.pdf';
        
        //     // Save the PDF using Laravel's storage system
        //     Storage::put('pdf/' . $pdfFileName, $pdf->output());
        
        //     // Optionally, you can store the PDF path in your database
        //     $testReport->pdf_path = 'pdf/' . $pdfFileName;
        //     $testReport->save();
            
        //     // Get the image path
        //     // $imagePath = $this->displayTestReportPdfImage($testReport->pdf_path);

        //     // Pass the image path to your view
        //     // return view('h_allreports', ['imagePath' => $imagePath]);
        //     return redirect('/tests');
        // }
        // public function displayTestReportPdfImage($testReportId)
        // {
        //     // Fetch the test report from the database based on its ID
        //     $testReport = Test_report::find($testReportId);
        
        //     if (!$testReport) {
        //         abort(404); // Handle the case where the test report is not found
        //     }
        
        //     // Generate the PDF using Laravel's PDF package
        //     $pdf = PDF::loadView('test_report_pdf', compact('testReport'));
        
        //     // Convert the PDF to a base64-encoded image
        //     $pdfData = $pdf->output();
        //     $base64Image = 'data:image/jpeg;base64,' . base64_encode($pdfData);
        
        //     // Return the image as a response with the appropriate content type
        //     return Response::make($base64Image)->header('Content-Type', 'image/jpeg');
        //     // return Response::make($pdfData)->header('Content-Type', 'application/pdf');

        // }
        
        // public function displayPdfAsImage($pdfPath)
        // {
        //     $pdf = new Pdf(storage_path('app/' . $pdfPath));
        //     $imagePath = storage_path('app/pdf/') . pathinfo($pdfPath, PATHINFO_FILENAME) . '.jpg';
        //     $pdf->setOutputFormat('jpg')->saveImage($imagePath);

        //     return $imagePath;
        // }





        public function pdfs(){
            $test_reports = test_report::with('vaccine')->get();
            return view('h_allreports',compact('test_reports'));
        }


       
        












    public function updatePermissions(Request $request)
    {
        $permissions = $request->input('permissions');
        
        if ($permissions) {
            foreach ($permissions as $hospitalId => $permissionValue) {
                $hospital = Hospital::find($hospitalId);
                
                if ($hospital) {
                    $hospital->permission = $permissionValue === 'yes' ? 'yes' : 'no';
                    $hospital->save();
                }
            }
            
            return redirect()->back()->with('success', 'Permissions updated successfully.');
        } else {
            return redirect()->back()->with('error', 'No permissions data received.');
        }
    }
 

    
    // public function updatePermissions(Request $request)
    // {
    //     $permissions = $request->input('permission');
    
    //     foreach ($permissions as $hospitalId => $permissionValue) {
    //         $hospital = Hospital::find($hospitalId);
    //         if ($hospital) {
    //             $hospital->permission = $permissionValue ? 'yes' : 'no';
    //             $hospital->save();
    //         }
    //     }
    
    //     return redirect()->back()->with('success', 'Permissions updated successfully.');
    // }
    
    
}
