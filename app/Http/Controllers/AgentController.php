<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreAgentRequest;
use App\Http\Requests\UpdateAgentRequest;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class AgentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:agent-list', only: ['index']),
            new Middleware('permission:agent-create', only: ['create','store']),
            new Middleware('permission:agent-edit', only: ['edit','update']),
            new Middleware('permission:agent-delete', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $agents = Agent::orderBy('created_at', 'DESC');

        if ($request->ajax()) {
            return Datatables::of($agents)->make(true);
        }

        return view('admin.agents.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.agents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAgentRequest $request)
    {

        // return $request;
        $agent = new Agent();
        $agent->ain_no = $request->ain_no;
        $agent->name = $request->name;
        $agent->bangla_name	= $request->bangla_name;
        $agent->license_no = $request->license_no;
        $agent->license_issue_date = $request->license_issue_date;
        $agent->membership_no = $request->membership_no;
        $agent->owners_name = $request->owners_name;
        $agent->owners_gender = $request->owners_gender;

        if ($request->hasFile('owner_photo')) {
            $image = $request->owner_photo;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid() . '.' . $ext;
            $request->owner_photo->move(public_path('images'), $filename);
            $agent->owner_photo = 'images/' . $filename;
        }

        if ($request->hasFile('agency_logo')) {
            $image = $request->agency_logo;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid() . '.' . $ext;
            $request->agency_logo->move(public_path('images'), $filename);
            $agent->agency_logo = 'images/' . $filename;
        }

        $agent->owners_designation = $request->owners_designation;
        $agent->office_address = $request->office_address;
        $agent->phone = $request->phone;
        $agent->email = $request->email;
        $agent->house = $request->house;
        $agent->parmanent_address = $request->parmanent_address;
        $agent->note = $request->note;
        $agent->save();
        // return response()->json(['success' => 'Agent added successfully.']);
        return redirect()->route('agents.index')->with('success', 'Agent added successfully.');


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $agent = Agent::find($id)->with('donations')->first();

        // Information completions parcentage
        $attributes = $agent->toArray();
        $totalColumns = count($attributes);
        $filledColumns = collect($attributes)->filter(function ($value) {
            return !is_null($value) && $value !== '';
        })->count();
        $completionPercentage = ($filledColumns / $totalColumns) * 100;


        return view('admin.agents.show', [
            'agent' => $agent,
            'completionPercentage' => round($completionPercentage, 2) // Round to 2 decimal places
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $agent = Agent::find($id);
        return view('admin.agents.edit', ['agent'=>$agent]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgentRequest $request, Agent $agent)
    {
        $agent->ain_no = $request->ain_no;
        $agent->name = $request->name;
        $agent->owners_name = $request->owners_name;

        //$agent->photo = $request->photo;

        if ($request->hasFile('photo')) {
            $image = $request->photo;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid() . '.' . $ext;
            Storage::delete("images/{$agent->image}");
            $request->photo->move(public_path('images'), $filename);
            $agent->photo = 'images/' . $filename;
        }

        $agent->owners_designation = $request->owners_designation;
        $agent->office_address = $request->office_address;
        $agent->phone = $request->phone;
        $agent->email = $request->email;
        $agent->house = $request->house;

        if ($request->note) {
            $agent->note = $request->note;
        }
        $agent->save();

        return redirect()->route('agents.index') ->with('success', 'Agent updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $agent = Agent::find($id);
        $agent->delete();
        return response()->json(['success' => 'Agent sent to trash.']);
    }



    public function trash(Request $request){
        $tAgents = Agent::onlyTrashed()->get();

        if ($request->ajax()) {
            return Datatables::of($tAgents)->make(true);
        }

        return view('admin.agents.trash');
    }


    // Restore soft deleted data
    public function restore($id)
    {
        $agent = Agent::onlyTrashed()->find($id);

        $agent->restore();
        return response()->json(['success' => 'Agent restored successfully.']);
    }


    // Premanent delete
    public function forcedelete($id)
    {
        $agent = Agent::onlyTrashed()->find($id);
        $response = 'Something Wrong';

        if ($agent->photo) {
            // Deleting profile picture
            $filePath = public_path($agent->photo);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        if ($agent->agency_logo) {
            // Deleting profile picture
            $filePath = public_path($agent->agency_logo);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $agent->forceDelete();
        return response()->json(['success' => 'Agent deleted permanently.']);
    }
}
