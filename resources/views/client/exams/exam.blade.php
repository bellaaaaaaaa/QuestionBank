@extends('layouts.client.master')

@section('content')

<exam-component default-subject="{{ $subject }}" default-questions="{{ $questions }}"></exam-component>

@endsection