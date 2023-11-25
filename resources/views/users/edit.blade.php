@extends('layouts.app')
@section('content')
<div>
    <header class="d-flex flex-wrap justify-content-between py-3 mb-4 border-bottom">
        <img src="{{ asset('img/smallLogo.png') }}" id="logo">
        <a href="{{url('/admin/logout')}}" class="btn btn-group-vertical btn-secondary">Log out</a>
    </header>
  </div>
  <h1 class="display-6 fw-bold border-bottom">Edit Account</h1>
@if ($errors->any())
    <ul class="alert alert-danger">
        {!! implode('',$errors->all('<li class="list-group-item bg-danger">:message</li>')) !!}
    </ul>
@endif
<form method="POST" action="{{route('user-update',$user->id)}}">
    @csrf
    <div class="row p-2">
      <div class="col">
        <label for="organisation" class="form-label fw-bold">Organisation</label>
        <input type="text" class="form-control" name="organization" value="{{ $user->organization}}">
          @error('organization')
          <strong style="color:red;">{{ $errors->first('organization') }}</strong>
          @enderror
      </div>
      <div class="col">
        <label for="firstName" class="form-label fw-bold">First Name</label>
        <input type="text" class="form-control" name="first_name" value="{{$user->first_name }}">
          @error('first_name')
          <strong style="color:red;">{{ $errors->first('first_name') }}</strong>
          @enderror
      </div>
      <div class="col">
        <label for="lastName" class="form-label fw-bold">Last Name</label>
        <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
          @error('last_name')
          <strong style="color:red;">{{ $errors->first('last_name') }}</strong>
          @enderror
      </div>
    </div>
    <div class="row p-2">
      <div class="col">
        <label for="user" class="form-label fw-bold">Username (admin user)</label>
        <input type="text" class="form-control" name="username" value="{{$user->username }}">
          @error('username')
          <strong style="color:red;">{{ $errors->first('username') }}</strong>
          @enderror
      </div>
      <div class="col">
        <label for="lastName" class="form-label fw-bold">Password</label>
        <input type="password" class="form-control" name="password" >
          @error('password')
          <strong style="color:red;">{{ $errors->first('password') }}</strong>
          @enderror
      </div>
      <div class="col">
        <label for="lastName" class="form-label fw-bold">Confirm Password</label>
        <input type="password" class="form-control" name="password_confirmation">
          @error('password_confirmation')
          <strong style="color:red;">{{ $errors->first('password_confirmation') }}</strong>
          @enderror
      </div>
    </div>

    <!--<div class="row p-2">
      <div class="col">
        <label for="plan" class="form-label fw-bold">Plan</label>
        <input type="text" class="form-control" >
      </div>
      <div class="col">
        <label for="domaine" class="form-label fw-bold">Domaine</label>
        <input type="text" class="form-control" >
      </div>
    </div>-->

    <div class="row p-2">
      <div class="col">
        <label for="email" class="form-label fw-bold">Email</label>
        <input type="email" class="form-control" name="email" value="{{ $user->email }}">
          @error('email')
          <strong style="color:red;">{{ $errors->first('email') }}</strong>
          @enderror
      </div>
      <div class="col">
        <label for="mobile" class="form-label fw-bold ">Mobile</label>
        <input type="text" class="form-control" name="mobile" value="{{ $user->mobile }}">
          @error('mobile')
          <strong style="color:red;">{{ $errors->first('mobile') }}</strong>
          @enderror
      </div>
    </div>

    <div class="row p-2">
      <div class="col">
        <label for="address" class="form-label fw-bold">Address</label>
        <input type="text" class="form-control" name="address" value="{{ $user->address }}">
          @error('address')
          <strong style="color:red;">{{ $errors->first('address') }}</strong>
          @enderror
      </div>
      <div class="col">
        <label for="city" class="form-label fw-bold">City</label>
        <input type="text" class="form-control" name="city" value="{{$user->city }}">
          @error('city')
          <strong style="color:red;">{{ $errors->first('city') }}</strong>
          @enderror
      </div>
      <div class="col">
        <label for="zip" class="form-label fw-bold">Zip</label>
        <input type="text" class="form-control" name="zip" value="{{ $user->zip }}">
          @error('zip')
          <strong style="color:red;">{{ $errors->first('zip') }}</strong>
          @enderror
      </div>
    </div>

    <div class="col-1 p-2">
      <button class="btn btn-dark btn-lg" type="submit">Update</button>
    </div>
  </form>
@endsection
@section('footer')
@endsection
