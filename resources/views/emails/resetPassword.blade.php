@extends('emails.master')

@section('content')
<p>@lang('Hi: ')<strong>{{ $user->name }}</strong></p>
<p>@lang('This is the new password for your account on our platform')</p>
<p><h2>{{ $data['password'] }}</h2>
<p>@lang('To log in click on the following button')</p>
<p><a href="{{ url('/login') }}" style="display: inline-block; background-color: #82b440; color: #fff; padding: 12px; border-radius: 4px; text-decoration: none;">@lang('Access Platform')</a></p>
<p>@lang('If the above button doesn`t work for you, copy and paste the following url into your web browser:')</p>
<p>{{ url('/login') }}</p>
@stop
