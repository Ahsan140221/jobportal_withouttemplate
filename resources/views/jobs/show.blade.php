@extends('layouts.app')

@section('content')
<div class="container" id="app">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(Session::has('message'))
                <div class="alert alert-success">{{Session::get('message')}}</div>
                @endif
                <div class="card-header">
                    <h1>Job Title</h1>
                    {{ $job->title }}
                </div>

                <div class="card-body">
                    <p class="lead">
                        <h3>Description : </h3>
                        {{ $job->description }}
                    </p>
                    <p class="lead">
                        <h3>Roles and Responsibilites : </h3>
                        {{ $job->roles }}
                    </p>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Short Info
                </div>
                <div class="card-body">
                    <p>Company:<a
                            href="{{route('company.index',[$job->company->id, $job->company->slug])}}">{{ $job->company->cname }}</a>
                    </p>
                    <p>Address:{{ $job->address }}</p>
                    <p>Employment Type:{{ $job->type }}</p>
                    <p>Position:{{ $job->position }}</p>
                    <p>Posted: {{ $job->created_at->diffForHumans()}}</p>
                    <p>Last Date to Apply: {{ date('F d, Y', strtotime($job->last_date)) }}</p>
                    <br>
                    @if(Auth::check() && Auth::user()->user_type=='seeker')
                    @if(!$job->checkIfUserAlreadyAppliedToJob())
                    <apply-component :jobid={{ $job->id }}></apply-component>
                    @endif
                    <favorite-component :jobid={{ $job->id }} :favorited={{ $job->checkJobSaved()?'true':'false'}}>
                    </favorite-component>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>
@endsection

<style>
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        color: #2d4739;
    }
</style>
