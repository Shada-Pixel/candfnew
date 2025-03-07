<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\Project;
use App\Models\Member;
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
        return view('welcome');
    }


    public function generalMember(Request $request): View
    {
        $agents = Agent::all();
        return view('general-member',['agents' => $agents]);
    }


    // Displaying story page
    public function story(Request $request): View
    {

        $exicutives = Member::where('type',1)->get();
        return view('story',['exicutives' => $exicutives]);
    }

    // Displaying services page
    public function services(Request $request): View
    {
        return view('services');
    }


    // Displaying contact page
    public function contact(Request $request): View
    {
        return view('contact');
    }

    // Displaying career page
    public function career(Request $request): View
    {
        return view('career');
    }



    // Displaying uiux work page
    public function uiux(Request $request): View
    {
        return view('works.uiux');
    }



    public function industries($industry)
    {
        $industry = Category::with('projects')->where('slug', $industry)->first();
        return view('works.index', [
            'industry' => $industry,
        ]);
    }


    // Members Parotfolio
    public function memberProtfolio($member)
    {
        $member = Member::with('projects')->find($member);
        return view('members.index', [
            'member' => $member,
        ]);
    }

    // Returning to project detsils page
    public function pdtails($project)
    {
        $project = Project::with('category','members')->where('slug', $project)->first();
        return view('works.show', [
            'project' => $project,
        ]);
    }

}
