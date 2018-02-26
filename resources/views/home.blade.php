@extends('layouts.master')

@section('title')
    LaraMemo | Sign Up to make your first memo today!
@endsection

@section('content')
    <header class="laramemo-header">
        <h1>LaraMemo</h1>
    </header>
    <div class="LaraMemo">
        <div class="LaraMemo-wrapper">
            @include('includes.errors')
            <div class="signup">
                <div class="signup-wrapper">
                    <h1>Sign Up</h1>
                     <form action="{{ route('signup_user') }}" class="signup-form" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="username" placeholder="Username" value="{{ Request::old('username') }}"/>
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" placeholder="Password" />
                        </div>
                        <div class="form-group">
                            <label class="label-style">Remember Me <input type="checkbox" name="remember" /></label>
                        </div>
                        <div class="form-group">
                            <button type="submit">Join us</button>
                        </div>
                    </form>
                    <div class="already-registered">
                        <p>Already registered user? <a href="{{ route('login-page') }}">Login</a></p>
                    </div>
                </div>
            </div><!-- /.signup -->
        </div><!-- /.LaraMemo-wrapper -->
    </div><!-- /.LaraMemo -->
@endsection