<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\Project;
use App\Models\Member;
use App\Models\Notice;
use App\Models\Agent;



class HomeController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // function __construct()
    // {
    //     $this->middleware('permission:admin-dash', ['only' => ['dashboard']]);
    //     $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    // }

    /**
     * Display visitor home page.
     */
    public function index(Request $request): View
    {
        $notices = Notice::orderBy('publish_date', 'desc')->take(5)->get();
        return view('welcome', ['notices' => $notices]);
    }


    public function generalMember(Request $request): View
    {
        $agents = Agent::orderBy('name', 'asc')->get();
        return view('general-member',['agents' => $agents]);
    }



    // Displaying contact page
    public function contact(Request $request): View
    {
        return view('contact');
    }


    // Displaying my agency page
    public function myagency(Request $request): View
    {
        $agent = Agent::with('donations')->find(auth()->user()->agency->id);

        if (!$agent) {
            abort(404, 'Agency not found');
        }

        // Information completion percentage
        $attributes = $agent->getAttributes();
        $filledColumns = collect($attributes)->filter(fn($value) => !is_null($value) && $value !== '')->count();
        $completionPercentage = ($filledColumns / count($attributes)) * 100;

        return view('myagency', [
            'agent' => $agent,
            'completionPercentage' => round($completionPercentage) // Round to the nearest whole number
        ]);
    }



}
