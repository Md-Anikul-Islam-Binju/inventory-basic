@extends('welcome')
@section('content')
    <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
        <div class="container text-center text-md-left" data-aos="fade-up">
            <h1>Welcome to Admin</h1>
            <a href="{{ route('login') }}" class="btn-get-started scrollto">Get Started</a>
        </div>
    </section>
@endsection
