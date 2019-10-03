@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @if(empty(Auth::user()->company->logo))
            <img src="{{asset('logo/main.jpg')}}" alt="" width="100">
            @else
            <img src="{{asset('uploads/logo')}}/{{ Auth::user()->company->logo }}" alt="" width="100">

            @endif
            <br><br>
            <form action="{{route('company.logo')}}" method="POST" enctype="multipart/form-data">@csrf
                <div class="card">
                    <div class="card-header">Update Company Logo</div>
                    <div class="card-body">
                        <input type="file" name="logo" class="form-control"><br>
                        <button type="submit" class="btn btn-dark float-right">Update</button>
                    </div>
                    @if($errors->has('logo'))
                    <div class="error errcolor">{{$errors->first('logo')}}</div>
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
                    Update Your Company Information
                </div>
                <form action="{{route('company.store')}}" method="POST">@csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="address"
                                value=" {{ Auth::user()->company->address }}">
                            @if($errors->has('address'))
                            <div class="error errcolor">{{$errors->first('address')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" class="form-control" name="phone"
                                value=" {{ Auth::user()->company->phone }}">
                            @if($errors->has('phone'))
                            <div class="error errcolor">{{$errors->first('phone')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Website</label>
                            <input type="text" class="form-control" name="website"
                                value=" {{ Auth::user()->company->website }}">
                            @if($errors->has('website'))
                            <div class="error errcolor">{{$errors->first('website')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Slogan</label>
                            <input type="text" class="form-control" name="slogan"
                                value=" {{ Auth::user()->company->slogan }}">
                            @if($errors->has('slogan'))
                            <div class="error errcolor">{{$errors->first('slogan')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description"
                                class="form-control"> {{ Auth::user()->company->description }}</textarea>
                            @if($errors->has('description'))
                            <div class="error errcolor">{{$errors->first('description')}}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <button class="btn btn-dark" type="submit">Update</button>
                        </div>
                    </div>

                </form>


            </div>

        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Company Information
                </div>
                <div class="card-body">
                    <p><strong>Company Name:</strong> {{ Auth::user()->company->cname }}</p>
                    <p><strong>Address:</strong> {{ Auth::user()->company->address }}</p>
                    <p><strong>Phone Number:</strong> {{ Auth::user()->company->phone }}</p>
                    <p><strong>Website:</strong><a
                            href="{{ Auth::user()->company->website }}">{{Auth::user()->company->website}}</a></p>
                    <p><strong>Slogan:</strong> {{ Auth::user()->company->slogan }}</p>
                    <p><strong>Description:</strong> {{ Auth::user()->company->description }}</p>
                    <p><strong>Go to Company Home Page:</strong><a href="company/{{ Auth::user()->company->slug}}">
                            View</a></p>

                </div>
            </div>
            <br>

            <form action="{{route('company.coverphoto')}}" method="POST" enctype="multipart/form-data">@csrf
                <div class="card">
                    <div class="card-header">Update Cover Photo</div>
                    <div class="card-body">
                        <input type="file" class="form-control" name="cover_photo"><br>
                        <button type="submit" class="btn btn-dark float-right">Update</button>
                    </div>
                    @if($errors->has('cover_photo'))
                    <div class="error errcolor">{{$errors->first('cover_photo')}}</div>
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
