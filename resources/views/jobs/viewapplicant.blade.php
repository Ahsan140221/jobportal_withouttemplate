@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @foreach($applicants as $applicant)
            <div class="card">
                <div class="card-header"><strong>Job Title: </strong><a
                        href="{{route('jobs.show',[$applicant->id,$applicant->slug])}}">{{$applicant->title}}</a></div>

                <div class="card-body">
                    @foreach ($applicant->users as $user)
                    <table class="table" style="table-layout:fixed;width:100%;">
                        <thead>
                            <tr>
                                <th class="font-weight-bold h6" style="width:12.5%;">Applicant Details</th>
                                <th style="width:12.5%;"></th>
                                <th style="width:12.5%;"></th>
                                <th style="width:12.5%;"></th>
                                <th style="width:12.5%;"></th>
                                <th style="width:12.5%;"></th>
                                <th style="width:12.5%;"></th>
                                <th style="width:12.5%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width:12.5%;"><img
                                        src="{{asset('uploads/avatar')}}/{{$user->profile->avatar}}" alt=""
                                        width="100;"></td>
                                <td style="width:12.5%;">Email:{{$user->email}}</td>
                                <td style="width:12.5%;">Address:{{$user->profile->address}}</td>
                                <td style="width:12.5%;">Gender:{{$user->profile->gender}}</td>
                                <td style="width:12.5%;">Bio:{{$user->profile->bio}}</td>
                                <td style="width:12.5%;">Experience:{{$user->profile->experience}}</td>
                                <td style="width:12.5%;"><a href="{{Storage::url($user->profile->resume)}}">Resume</a>
                                </td>
                                <td style="width:12.5%;"><a href="{{Storage::url($user->profile->cover_letter)}}">Cover
                                        Letter</a></td>

                            </tr>
                        </tbody>
                    </table>
                    @endforeach
                </div>

            </div>
            @endforeach
            <br>
        </div>
    </div>
</div>
@endsection
<style>
</style>
