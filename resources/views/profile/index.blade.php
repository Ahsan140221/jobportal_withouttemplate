@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @if(empty(Auth::user()->profile->avatar))
            <img src="{{asset('avatar/main.jpg')}}" alt="" style="width:100%;">
            @else
            <img src="{{asset('uploads/avatar')}}/{{ Auth::user()->profile->avatar }}" alt="" style="width:100%;">

            @endif
            <br><br>
            <form action="{{route('profile.avatar')}}" method="POST" enctype="multipart/form-data">@csrf
                <div class="card">
                    <div class="card-header">Update Picture</div>
                    <div class="card-body">
                        <input type="file" name="avatar" class="form-control"><br>
                        <button type="submit" class="btn btn-success float-right">Update</button>
                    </div>
                    @if($errors->has('avatar'))
                    <div class="error errcolor">{{$errors->first('avatar')}}</div>
                    @endif
                </div>
            </form>
        </div>
        <div class="col-md-5">
            <div class="card">
                @if(Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message')}}
                </div>
                @endif
                <div class="card-header">
                    Update Your Profile
                </div>
                <form action="{{route('profile.create')}}" method="POST">@csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="address"
                                value="{{ Auth::user()->profile->address }}">
                            @if($errors->has('address'))
                            <div class="error errcolor">{{$errors->first('address')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number"
                                value="{{ Auth::user()->profile->phone_number }}">
                            @if($errors->has('phone_number'))
                            <div class="error errcolor">{{$errors->first('phone_number')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Experience</label>
                            <textarea name="experience"
                                class="form-control">{{ Auth::user()->profile->experience }}</textarea>
                            @if($errors->has('experience'))
                            <div class="error errcolor">{{$errors->first('experience')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Bio</label>
                            <textarea name="bio" class="form-control">{{ Auth::user()->profile->bio }}</textarea>
                            @if($errors->has('bio'))
                            <div class="error errcolor">{{$errors->first('bio')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Update</button>
                        </div>
                    </div>

                </form>


            </div>

        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Your Information
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Address:</strong> {{ Auth::user()->profile->address }}</p>
                    <p><strong>Phone Number:</strong> {{ Auth::user()->profile->phone_number }}</p>
                    <p><strong>Gender:</strong> {{ Auth::user()->profile->gender }}</p>
                    <p><strong>Date of Birth:</strong> {{ Auth::user()->profile->dob }}</p>
                    <p><strong>Experience:</strong> {{ Auth::user()->profile->experience }}</p>
                    <p><strong>Bio:</strong> {{ Auth::user()->profile->bio }}</p>
                    <p><strong>Member On: </strong> {{ date('F d Y',strtotime(Auth::user()->created_at)) }}</p>

                    @if(!empty( Auth::user()->profile->resume ))
                    <p><a href="{{Storage::url( Auth::user()->profile->resume )}}">Resume</a></p>

                    @else
                    <p>Please upload resume</p>
                    @endif

                    @if(!empty( Auth::user()->profile->cover_letter ))
                    <p><a href="{{ Storage::url( Auth::user()->profile->cover_letter )}}">Cover Letter</a></p>
                    @else
                    <p>Please upload cover letter</p>
                    @endif


                </div>
            </div>
            <br>

            <form action="{{route('profile.resume')}}" method="POST" enctype="multipart/form-data">@csrf
                <div class="card">

                    <div class="card-header">
                        Update Resume
                    </div>
                    <div class="card-body">
                        <input type="file" class="form-control" name="resume"><br>
                        <button type="submit" class="btn btn-success float-right">Update</button>
                    </div>
                    @if($errors->has('resume'))
                    <div class="error errcolor">{{$errors->first('resume')}}</div>
                    @endif
                </div>
            </form>
            <br>

            <form action="{{route('profile.coverletter')}}" method="POST" enctype="multipart/form-data">@csrf
                <div class="card">
                    <div class="card-header">Update Cover Letter</div>
                    <div class="card-body">
                        <input type="file" class="form-control" name="cover_letter"><br>
                        <button type="submit" class="btn btn-success float-right">Update</button>
                    </div>
                    @if($errors->has('cover_letter'))
                    <div class="error errcolor">{{$errors->first('cover_letter')}}</div>
                    @endif

                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<style>
    .errcolor {
        color: red;
    }
</style>
