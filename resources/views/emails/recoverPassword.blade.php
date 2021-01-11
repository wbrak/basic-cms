@extends('emails.master')

@section('content')
<p>@lang('Hi: ')<strong>{{ $user->name }}</strong></p>
<p>@lang('This is an email that will help you reset your account password on our platform')</p>
<p>@lang('To continue click on the following button and enter the following code: ')<h2>{{ $user->password_code }}</h2></p>
<p><a href="{{ url('/reset?email='.$user->email) }}" style="display: inline-block; background-color: #82b440; color: #fff; padding: 12px; border-radius: 4px; text-decoration: none;">@lang('Reset my password')</a></p>
<p>@lang('If the above button doesn`t work for you, copy and paste the following url into your web browser:')</p>
<p>{{ url('/reset?email='.$user->email) }}</p>
@stop
