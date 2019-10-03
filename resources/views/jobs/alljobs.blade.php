@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <form action="{{route('jobs.alljobs')}}" method="GET">
            <div class="form-inline">
                <div class="form-group">
                    <label for="">Keyword&nbsp;</label>
                    <input type="text" name="title" class="form-control">&nbsp;&nbsp;
                </div>
                <div class="form-group">
                    <label for="">Employment Type&nbsp;</label>
                    <select name="type" class="form-control">
                        <option value="">Select Type</option>
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option>
                        <option value="Casual">Casual</option>
                    </select>
                    &nbsp;&nbsp;
                </div>
                <div class="form-group">
                    <label for="">Category&nbsp;</label>
                    <select name="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach(App\Category::all() as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>&nbsp;&nbsp;
                </div>
                <div class="form-group">
                    <label for="">Address&nbsp;</label>
                    <input type="text" class="form-control" name="address">&nbsp;&nbsp;
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-success">Submit</button>
                </div>
            </div>
        </form>
        <table class="table">
            <thead>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                <tr>
                    <td>
                        <img src="{{asset('uploads/logo')}}/{{$job->company->logo}}" width="100" alt="">
                    </td>

                    <td>
                        Position : {{ $job->position }}<br>
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                        &nbsp;{{ $job->type }}
                    </td>

                    <td>
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        &nbsp;Address : {{ $job->address }}
                    </td>

                    <td>
                        <i class="fa fa-globe" aria-hidden="true"></i>
                        &nbsp;Date : {{ $job->created_at->diffForHumans() }}
                    </td>

                    <td>
                        <a href="{{route('jobs.show', [$job->id, $job->slug])}}">
                            <button class="btn btn-success btn-sm">Apply</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
        <div class="mx-auto">
            {{$jobs->appends(Illuminate\Support\Facades\Request::except('page'))->links()}}
            <div>
            </div>
        </div>
        @endsection

        <style>
            .fa {
                color: #91AEC1;
                /* #BFD7EA, #91AEC1, #508CA4, #0A8754, #00452D */
            }

            .heading {
                color: #2d4739;
            }
        </style>
