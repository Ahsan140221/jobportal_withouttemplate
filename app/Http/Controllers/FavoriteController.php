<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function savejob($id) {
        $jobid = Job::find($id);
        $jobid->favorites()->attach(auth()->user()->id);
        return redirect()->back();

    }

    public function unsavejob($id) {
        $jobid = Job::find($id);
        $jobid->favorites()->detach(auth()->user()->id);
        return redirect()->back();

    }
}
