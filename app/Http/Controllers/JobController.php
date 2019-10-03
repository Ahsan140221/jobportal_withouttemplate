<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use App\Job;
use Illuminate\Support\Str;
use App\Http\Requests\JobPostRequest;
use Auth;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware(['employer', 'verified'], ['except' => array('index', 'show', 'apply', 'alljobs', 'searchjob')]);
    }
    public function index()
    {
        $jobs = Job::latest()->limit(10)->where('status', 1)->get();
        $companies = Company::get()->random(12);
        return view('welcome', compact('jobs', 'companies'));
    }

    public function show($id, Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(JobPostRequest $request)
    {
        $user_id = auth()->user()->id;
        $company = Company::where('user_id', $user_id)->first();
        $company_id = $company->id;
        Job::create([
            'user_id' => $user_id,
            'company_id' => $company_id,
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'description' => request('description'),
            'roles' => request('roles'),
            'category_id' => request('category_id'),
            'position' => request('position'),
            'address' => request('address'),
            'type' => request('type'),
            'status' => request('status'),
            'last_date' => request('last_date')

        ]);
        return redirect()->back()->with('message', 'Job Posted successfully');
    }

    public function myjob()
    {
        $jobs = Job::where('user_id', auth()->user()->id)->get();
        return view('jobs.myjob', compact('jobs'));
    }

    public function edit($id, Job $job)
    {
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, $id, Job $job)
    {
        $job->update($request->all());
        return redirect()->back()->with('message', 'Job updated successfully');
    }

    public function apply(Request $request, $id)
    {
        $jobId = Job::find($id);
        $jobId->users()->attach(Auth::user()->id);
        return redirect()->back()->with('message', 'Applied to the job successfully');
    }

    public function applicants()
    {
        $applicants = Job::has('users')->where('user_id', auth()->user()->id)->get();
        return view('jobs.viewapplicant', compact('applicants'));
    }
    public function alljobs(Request $request)
    {
        $position = request('title');
        $type = request('type');
        $category = request('category_id');
        $address = request('address');
        $fields = ['title', 'type', 'category_id', 'address'];
        $jobs = Job::query();
        if ($position) {
            $jobs = $jobs->where('position', 'LIKE', '%' . $position . '%');
        }
        if ($type) {
            $jobs = $jobs->where('type', $type);
        }
        if ($category) {
            $jobs = $jobs->where('category_id', $category);
        }
        if ($address) {
            $jobs = $jobs->where('address', $address);
        }
        $jobs = $jobs->paginate(5);
        return view('jobs.alljobs', compact('jobs'));
    }

    public function searchjob(Request $request)
    {

        $keyword = $request->get('keyword');
        $users = Job::where('title', 'like', '%' . $keyword . '%')
            ->orWhere('position', 'like', '%' . $keyword . '%')
            ->limit(5)->get();
        return response()->json($users);
    }
}
