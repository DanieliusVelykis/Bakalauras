@extends('layout')
@section('title','Registracija')
@section('content')
<div class="welcomeText"><h3>Užpildykite registracijos formą ir prisijunkite prie sistemos!</h3></div>
<div class="container">

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
    <form action="{{route('registration.post')}}" method="POST" class="registration">
    @csrf
        <label>Vardas ir pavardė</label>
        <input type="text" name="name">
        <label>Telefono numeris</label>
        <input type="tel" name="phoneNumber" pattern="\+370[0-9]{8}" placeholder="Įveskite telefono numerį">
        <label>El. pašto adresas</label>
        <input type="email" name="email">
        <label>Slaptažodis</label>
        <input type="password" name="password">
        <label>Pakartoti slaptažodį</label>
        <input type="password" name="retypedPassword">
        <label></label>
        <input type="submit" name="registerme" value="REGISTRUOTIS">
    </form>
</div>
@endsection