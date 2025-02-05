<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Ie_data;
use App\Models\File_data;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreFile_dataRequest;
use App\Http\Requests\UpdateFile_dataRequest;

class FileDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $now = Carbon::now();
        $year = $now->year;

        // Retrieve the latest File_data record
        $file_data = File_data::latest()->first();

        // Get the last agent ID from the latest File_data record
        $lastagent = $file_data ? $file_data->agent->name : null;

        // Determine the next lodgement number
        if ($file_data) {
            if ($file_data->lodgement_no == '94020') {
                $next_lodgement_no = 1;
            } else {
                $next_lodgement_no = $file_data->lodgement_no + 1;
            }
        } else {
            $next_lodgement_no = 1;
        }

        $today = date('d-m-Y');

        return view('admin.file_datas.create', compact('next_lodgement_no', 'file_data', 'today', 'lastagent'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Retrieve the latest File_data record
        $latest_file_data = File_data::latest()->first();
        // Determine the next lodgement number
        if ($latest_file_data) {
            if ($latest_file_data->lodgement_no == '94020') {
                $next_lodgement_no = 1;
            } else {
                $next_lodgement_no = $latest_file_data->lodgement_no + 1;
            }
        } else {
            $next_lodgement_no = 1;
        }

        // Check if the manifest_no already exists for the current year
        $currentYear = Carbon::now()->year;
        $isDuplicateManifest = File_data::where('manifest_no', $request->manifest_no)
            ->whereYear('created_at', $currentYear)
            ->exists();
        $agent_id = null;
        $ie_data_id = null;

        if ($isDuplicateManifest) {
            return redirect()->back()->withErrors([
                'manifest_no' => 'The manifest number already exists for this year.'
            ])->withInput();
        }

        if ($request->agentain != null) {
            $agent_id = Agent::where('name', $request->agentain)->value('id');
        }

        if ($request->impexp != null) {
            $ie_data_id = Ie_data::where('name', $request->impexp)->value('id');
        }

        $time = strtotime($request->lodgement_date);
        $lmd = date('d/m/Y', $time);
        $mtime = strtotime($request->manifest_date);
        $mnfd = date('d/m/Y', $mtime);

        $file_data = new File_data();
        $file_data->lodgement_no = $next_lodgement_no;


        if ($request->manifest_no) {
            $file_data->manifest_no = $request->manifest_no;
        }
        if ($request->page) {
            $pages =  $request->page;
            $numberofPages = ($pages  >  1) ? ceil((($pages - 1) / 3  + 1)) : 1;
            $file_data->page = $pages;
            $file_data->no_of_items  = $numberofPages;
        }

        $file_data->lodgement_date = $lmd;
        $file_data->manifest_date = $mnfd;

        // Assign agent_id if  exist
        if ($agent_id) {
            $file_data->agent_id = $agent_id;
        }
        // Assign ie_data_id if  exist
        if ($ie_data_id) {
            $file_data->ie_data_id = $ie_data_id;
        }

        $file_data->status = 'Received';
        $file_data->reciver_id = Auth::user()->id;
        $file_data->save();

        if (Auth::user()->hasRole('extra') || $request->printable) {
            $file_data->status = 'Printed';
            $file_data->save();
            return redirect()->route('file_datas.show', $file_data->id)->with(['status' => 200, 'message' => 'File Received and Printed!']);
        }


        return redirect()->route('file_datas.create')->with(['status' => 200, 'message' => 'File Received!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(File_data $file_data)
    {
        if (Auth::user()->hasRole('admin|deliver')) {
            $file_data->status = 'Printed';
            $file_data->save();
        }

        return view('admin.file_datas.show', compact('file_data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File_data $file_data)
    {

        $now = Carbon::now();
        $year = $now->year;
        $file_data = File_data::where('id', $file_data->id)->with('ie_data')->with('agent')->first();
        return view('admin.file_datas.edit', compact('file_data','year'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFile_dataRequest $request, File_data $file_data)
    {

        // return $request->all();
         $time = strtotime($request->lodgement_date);
         $lmd = date('d/m/Y', $time);
         $mtime = strtotime($request->manifest_date);
         $mnfd = date('d/m/Y', $mtime);

        if ($request->agentain != null) {
            $agent_id = Agent::where('name', $request->agentain)->value('id');
            $file_data->agent_id = $agent_id;
        }

        if ($request->impexp != null) {
            $ie_data_id = Ie_data::where('name', $request->impexp)->value('id');
            $file_data->ie_data_id = $ie_data_id;
            if (!$ie_data_id) {
                // return redirect()->back()->withInput()->with(['status' => 200, 'message' => 'Please create Importer/Exporter first!']);
                return redirect()->back()->withInput()->withErrors(['Please create valid Importer/Exporter first!']);
            }
        }

        // Calculate the number of pages
        $pages =  $request->page;
        $numberofPages = ($pages  >  1) ? ceil((($pages - 1) / 3  + 1)) : 1;
        $file_data->no_of_items  = $numberofPages;

        $file_data->lodgement_no = $request->lodgement_no;
        $file_data->lodgement_date = $lmd;
        $file_data->manifest_no = $request->manifest_no;
        $file_data->manifest_date = $mnfd;


        $file_data->ie_type = $request->ie_type;

        $file_data->group = $request->group;
        $file_data->goods_name = $request->goods_name;
        $file_data->goods_type = $request->goods_type;
        $file_data->be_number = $request->be_number;
        $file_data->be_date = $request->be_date;
        $file_data->page = $request->page;

        $file_data->fees = $request->fees;
        $file_data->status = 'Delivered';
        $file_data->delivered_at = Carbon::now();
        $file_data->save();


        $agent = Agent::where('id', $file_data->agent_id)->first();
        $agent_email = $agent->email;
        $agent_phone = $agent->phone;

        //Sms Data
        $ie_name = Ie_data::where('id', $file_data->ie_data_id)->first();
        $ie_name = $ie_name->name;
        $sms_data = 'B/E Number:' . $file_data->be_number . '. B/E Date: ' . $file_data->be_date . '. ' . $file_data->ie_type . '. Name: ' . $ie_name . '. Manifest No: ' . $file_data->manifest_no . '. Manifest Date: ' . $file_data->manifest_date;


        function send_sms($in_phone, $in_textmessage){
            $url = "https://login.esms.com.bd/api/v3/sms/send";
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $headers = array(
            "Accept: application/json",
            "Authorization: Bearer  196|qHtRIf6gAw56CAk96DAl6oMwKSaOb0PqwRBdQ6dm",
            "Content-Type: application/json",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $data = [
            'recipient' => '88'.$in_phone,
            'sender_id' => '8809601001203',
            'message' => urldecode($in_textmessage),
            ];

            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $resp = curl_exec($curl);
            curl_close($curl);

            return $resp ;
        }
        $re = send_sms($agent_phone, $sms_data);

        //Email Sending Function
        if (!empty($agent_email)) {
            $email_data = ['be_number' => $file_data->be_number, 'be_date' => $file_data->be_date, 'ie_type' => $file_data->ie_type, 'ie_name' => $ie_name, 'manifest_no' => $file_data->manifest_no, 'manifest_date' => $file_data->manifest_date];
            $file_data_check = Data_user::where('user_id', Auth::user()->id)->where('file_data_id', $file_data->id)->count();
            // if (count($file_data_check) == '0') {
            if ($file_data_check == '0') {
                $data_user = new Data_user();
                $data_user->file_data_id = $file_data->id;
                $data_user->user_id = Auth::user()->id;
                $data_user->note = Auth::user()->name;
                $data_user->save();
                $djm = 'bnplcnfasso@gmail.com';
            }
        }

        if (Auth::user()->hasRole('operator')) {
            return redirect()->route('dashboard')->with(['status' => 200, 'message' => 'File Operated and Delivered!']);
        }

        return redirect()->route('file_datas.show', $file_data->id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File_data $file_data)
    {
        //
    }

    public function isBeNumberUnique(Request $request){

        // $year = date('Y');
        $be_number = $request->be_number;

        // $file_data = File_data::whereYear('created_at', $year )->where('be_number', $be_number)->first();
        $file_data = Dj_year_be_numbers::where('be_number', $be_number)->first();

      //  return $file_data;
      return response()->json(['success' => $file_data]);
    }
}
