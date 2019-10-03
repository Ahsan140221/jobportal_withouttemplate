@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(Auth::user()->user_type=='seeker')
            @if(count($jobs)>0)
            @foreach ($jobs as $job)
            <div class="card">
                <div class="card-header">{{$job->title}}</div>
                <small class="badge badge-primary w-25">{{$job->position }}</small>

                <div class="card-body">

                    {{$job->description}}

                </div>
                <div class="card-footer">
                    <span><a href="{{route('jobs.show', [$job->id, $job->slug])}}">Read</a></span>
                    <span class="float-right">Last Date to Apply: {{$job->last_date}}</span>
                </div>
            </div>
            @endforeach
            @else
            You have not any Saved Jobs.
            <a href="/">Find Jobs</a>
            @endif
            @else
            You're logged in.
            @endif
            <br><br>
        </div>
    </div>
</div>
@endsection
