@extends('layouts.app')

@section('content')
<div id="login-wrap">
  <div id="login-form">
    <a href="" class="logo2"><img src="assets/img/logo2.png" class="logo2"/></a>
    <h1 class="user-title centered">Baggage check-in</h1>
    <form class="login-form" role="form" method="POST" action="{{ url('/login') }}">
      {{ csrf_field() }}
      <div>
        <h2 class="user-title">Login</h2>
      </div>
      <div>
        <input id="username" type="text" name="username" placeholder="Username" value="{{ old('email') }}">
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        <input id="password" type="password" name="password" placeholder="Password">
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
        <input type="submit" value="Submit" class="submit" name="submit">
      </div>
    </form>
  </div>
</div>
@endsection
