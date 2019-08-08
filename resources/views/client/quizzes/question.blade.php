@extends('layouts.client.master')

@section('content')

<quiz-component default-subject="{{ $subject }}" default-topic="{{ $topic }}" default-questions="{{ $questions }}"></quiz-component>

@endsection