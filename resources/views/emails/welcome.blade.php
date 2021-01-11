@extends('emails.master')

@section('content')
<p>@lang('Hi: ')<strong>{{ $user->name }}</strong></p>
<p>@lang('This is a message to confirm your email on our platform')</p>
<p>@lang('To continue click on the following link: ')<button><a href="{{ url('/register/verify/' . $user->confirmation_code) }}">
            @lang('To confirm the email')
        </a></button></p>
@stop
