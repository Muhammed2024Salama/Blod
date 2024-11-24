@extends('theme.master')
@section('title','Login')

@section('content')
    @include('theme.partials.hero', ['title' => 'Login'])


    <!-- ================ contact section start ================= -->
    <section class="section-margin--small section-margin">
        <div class="container">
            <div class="row">
                <div class="col-6 mx-auto">
                    <form action="{{ route('login') }}" class="form-contact contact_form" method="post" novalidate="novalidate">
                        @csrf
                        <div class="form-group">
                            <input class="form-control border" name="email" value="{{ old('email') }}" type="email" placeholder="Enter email address">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input class="form-control border" name="password" type="password" placeholder="Enter your password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group text-center text-md-right mt-3">
                            <a href="{{ route('register') }}" class="mx-3">Sign Up instead !?</a>
                            <button type="submit" class="button button--active button-contactForm">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection
