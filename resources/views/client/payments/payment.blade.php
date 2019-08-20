@extends('layouts.client.stranger')

@section('content')
<payment-component default-subject="{{ $subject }}"></payment-component>
@endsection