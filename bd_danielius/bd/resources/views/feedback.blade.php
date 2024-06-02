@extends('layout')

@section('title', 'Feedback')

@section('content')
<div class="feedback-container">
    <h2>Atsiliepimai</h2>
    @foreach ($feedbacks as $feedback)
    <div class="feedback-card">
        <h3>{{$feedback->serviceName}}</h3>
        <p>{{$feedback->feedback}}</p>
        <span class="user">[{{$feedback->user}}]</span>
    </div>
    @endforeach
</div>
@endsection
