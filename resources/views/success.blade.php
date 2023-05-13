@extends('layout')

@section('content')
    <div class="success">
      <div class="green-tick"></div>
      <h2>Success</h2>
      <p>You have successfully registered</p>
      <a href="{{ url('/') }}">Back</a>
    </div>
@endsection
