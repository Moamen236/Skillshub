@extends('web.layout');

@section('title')
    Verify Email
@endsection

@section('main')
<div class="jumbotron text-center">
    <h1>Verification Email</h1>
    <p>A verification Email sent successfully, please check your inbox</p>
    <form action="{{ url("email/verification-notification") }}" method="post">
        @csrf
        <input type="submit" value="Resent Email" class="btn btn-default">
    </form>
    {{-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p> --}}
  </div>
@endsection