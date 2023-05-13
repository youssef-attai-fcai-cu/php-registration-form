@extends('layout')

@section('content')
    <div class="success">
      <div class="green-tick"></div>
      <h2><?php echo __('strings.success') ?></h2>
      <p><?php echo __('strings.successmsg') ?></p>
      <a href="{{ url('/') }}"><?php echo __('strings.back') ?></a>
    </div>
@endsection
