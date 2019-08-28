@extends('layouts.client.stranger')

@section('content')
<payment-component default-subject="{{ $subject }}" site-url="{{ $siteurl }}"></payment-component>
@endsection