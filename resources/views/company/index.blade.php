@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="company-profile">
            @if(empty($name->cover_photo))
            <img src="{{asset('cover/bg_cover.jpg')}}" alt="" width="100%;" height="35%;">
            @else
            <img src="{{asset('uploads/cover')}}/{{ $name->cover_photo}}" alt="" width="100%;" height="35%;">
            @endif
            <br>
            <br>
            <div class="company-description">
                @if(empty($name->logo))
                <img src="{{asset('logo/main.jpg')}}" alt="" width="100">
                @else
                <img src="{{asset('uploads/logo')}}/{{$name->logo}}" alt="" width="100">
                @endif
                <br><br>
                <h1 class="text-uppercase">{{ $name->cname }}</h1>
                <p><strong>Description:</strong> {{ $name->description }}</p>
                <p>
                    <strong>Slogan:</strong> {{ $name->slogan }}&nbsp;
                    <strong>Address:</strong> {{ $name->address }}&nbsp;
                    <strong>Phone#:</strong> {{ $name->phone }}-&nbsp;
                    <strong>Website:</strong> {{ $name->website }}</p>
            </div>
        </div>

        <table class="table">
            <thead>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach($name->jobs as $job)
                <tr>
                    <td>
                        <img src="{{asset('avatar/main.jpg')}}" width="80" alt="">
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

    </div>
</div>
@endsection

<style>
    h1 {
        color: #2d4739;
    }
</style>
