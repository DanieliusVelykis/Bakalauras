<?php

?>

@extends('layout')
@section('title', 'Danieliaus paslaugos')
@section('content')

<div class="success-message">
    <p>Užrezervuota sėkmingai</p>
    <div class="reservationDone"><button id="goBack" onclick="backToMain()">PAGRINDINIS LANGAS</button></div>
</div>

<script>

function backToMain(){
    window.location.href = "/";
}
</script>

<style>
.success-message {
    text-align: center;
    margin-top: 50px;
}

.success-message p {
    font-size: 24px;
    color: #4CAF50;
}

.reservationDone {
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 20px;
    width:200px;
    height:20px;
    margin-left:43%;
}

.success-message button:hover {
    background-color: #45a049;
}
</style>

@endsection
