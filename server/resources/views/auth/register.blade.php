@extends('layouts.auth', ['title' => 'Instructor Dashboard Login'])

@section('content')

<div class="row justify-content-center align-items-center h-100">
    <div class="col-4 col-md-5 col-sm-8">
        <div class="login-form rounded shadow p-5" style="background: RGBA(255, 255, 255, .8)">
            <div class="" style="text-align: center;">
                <h3 class="mb-4">Time Tracker</h3>
                <div style="height: 20px"></div>
            </div>
            <div class="card-content">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>NAME</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter your name">
                        @error('name')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div style="height: 20px"></div>
                    <div class="form-group">
                        <label>EMAIL</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email">
                        @error('email')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div style="height: 20px"></div>
                    <div class="form-group">
                        <label>PASSWORD</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password">
                        @error('password')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div style="height: 20px"></div>
                    <div class="form-group">
                        <label>PASSWORD CONFIRMATION</label>
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                        @error('password_confirmation')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <button class="btn btn-primary mr-1 btn-submit" type="submit" style="width: 100%;">Register</button>
                    <div style="height: 20px"></div>
                    <div class="d-flex">
                        <p class="mr-2">already have an account ? </p>
                        <a href="{{ route('register') }}" style="cursor: pointer">Login Here</a>
                    </div>
                    

                </form>
            </div>
        </div>
    </div>
    
</div>

@endsection