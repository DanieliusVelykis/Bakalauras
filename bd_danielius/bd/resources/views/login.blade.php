@extends('layout')
@section('title','Prisijungimas')
@section('content')
<div class="welcomeText"><h3>Užpildykite prisijungimo formą ir prisijunkite prie sistemos!</h3></div>
@if($errors->any())
<div class="error">
    @foreach($errors->all() as $error)
    <div class="error-item">{{$error}}</div>
    @endforeach
</div>
@endif
@if(session()->has('error'))
<div class="error-item">{{session('error')}}</div>
@endif
@if(session()->has('success'))
<div class="error-item-success">{{session('success')}}</div>
@endif
<div class="container">
    <form action="{{route('login.post')}}" method="POST" class="registration">
    @csrf
        <label>El. pašto adresas</label>
        <input type="email" name="email">
        <label>Slaptažodis</label>
        <input type="password" name="password">
        <label></label>
        <input type="submit" name="registerme" value="PRISIJUNGTI">
    </form>
</div>
@endsection