@extends('admin.master')

@section('title', Lang::get('User Edit'))

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{!! url('/admin') !!}"><i class="fas fa-home"></i> @lang('Dashboard') /</a>
	<a href="{!! url('/admin/users/all') !!}"><i class="fas fa-users"></i> @lang('Users') /</a>
    <a href="{!! route('UserEdit', $user->id) !!}"><i class="fas fa-edit"></i> @lang('Edit')</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-user">
        <div class="row">
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><img src="{{asset('storage/svg/004-client.svg')}}"> @lang('User Profile')</h2>
                    </div>

                    <div class="inside">
                        <div class="mini-profile">
                            @if(is_null($user->avatar))
                            <img src="{!! asset('storage/default-avatar.png') !!}" class="avatar" alt="@lang('Default Avatar')">
                            @else
                            <img src="{!! asset('storage/profiles/'.$user->id.'/av_'.$user->avatar) !!}" class="avatar" alt="@lang('User Avatar')">
                            @endif
                                @if(kvfj(Auth::user()->permissions, 'UserBanned'))
                                    @if($user->status == "100")
                                        <a href="{!! url('/admin/user/'.$user->id.'/banned') !!}" class="btn btn-success">@lang('Activate User')</a>
                                    @else
                                        <a href="{!! url('/admin/user/'.$user->id.'/banned') !!}" class="btn btn-danger">@lang('Suspend User')</a>
                                    @endif
                                @endif
                            <div class="info">
                                <span class="title"><i class="fas fa-envelope"></i> @lang('E-Mail Address')</span>
                                    <span class="text">{!! $user->email !!}</span>
                                <span class="title"><i class="fas fa-address-card"></i> @lang('Name') @lang('And') @lang('Lastname')</span>
                                    <span class="text">{!! $user->name !!} {!! $user->lastname !!}</span>
                                <span class="title"><i class="fas fa-calendar-alt"></i> @lang('Registration Date')</span>
                                    <span class="text">{!! $user->created_at !!}</span>
                                <span class="title"><i class="fas fa-user-check"></i> @lang('User Status')</span>
                                    <span class="text">{!! getUserStatusArray(null, $user->status) !!}</span>
                                <span class="title"><i class="fas fa-calendar-check"></i> @lang('Verification Date')</span>
                                    <span class="text">{!! $user->email_verified_at !!}</span>
                                {!! Form::open(['url' => '/admin/user/'.$user->id.'/edit']) !!}
                                <span class="title"><i class="fas fa-user-shield"></i> @lang('User Role')</span>
                                <div class="input-group mtop16">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon1">
                                           <i class="fas fa-user-shield"></i>
                                        </span>
                                    </div>
                                {!! Form::select('role', ['0' => Lang::get('User'), '1' => Lang::get('Customer'), '2' => Lang::get('SuperAdmin'),
                                                          '3' => Lang::get('Employee'), '4' => Lang::get('Interpreter')], $user->role, ['class' => 'custom-select']) !!}
                                {!! Form::submit(Lang::get('Save'), array('class' => 'btn btn-success')) !!}
                                {!! Form::close() !!}
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-history"></i> @lang('User Timeline')</h2>
                    </div>

                    <div class="inside">
                        <div class="info">
                            @if(Session::has($user->current_login->diffForHumans()))
                            <span class="log">@lang('Last Access') {!! $user->last_login->diffForHumans() !!}</span>
                            @else
                            <span class="log">@lang('Connect to') {!! $user->current_login->diffForHumans() !!}</span>
                            @endif
                            <div class="timeline">

                                @foreach($posts as $post)
                                <div class="container left">
                                    <div class="content post">
                                        <div class="date">@lang('Post Created') {!! $post->created_at->diffForHumans() !!}</div>
                                        <img src="{!! asset('storage/profiles/'.$user->id.'/av_'.$user->avatar) !!}" class="avatar" alt="@lang('User Avatar')"><div class="name">{{ $post->user->name }} {{ $post->user->lastname }}</div>
                                        <div class="title"><strong>{!! $post->title !!}</strong></div>
                                        <p>{!! $post->short !!}</p>
                                    </div>
                                </div>
                                @endforeach
                                @foreach($pages as $page)
                                <div class="container right">
                                    <div class="content page">
                                        <div class="date">@lang('Page Created at') {!! $page->created_at->diffForHumans() !!}</div>
                                        <img src="{!! asset('storage/profiles/'.$user->id.'/av_'.$user->avatar) !!}" class="avatar" alt="@lang('User Avatar')"><div class="name">{{ $page->user->name }} {{ $page->user->lastname }}</div>
                                        <div class="title"><strong>{!! $page->title !!}</strong></div>
                                        <p>{!! $page->short !!}</p>
                                    </div>
                                </div>
                                @endforeach
                                @foreach($comments as $comment)
                                <div class="container right">
                                    <div class="content comment">
                                        <div class="date">@lang('Comment Created at') {!! $comment->created_at->diffForHumans() !!}</div>
                                        <img src="{!! asset('storage/profiles/'.$user->id.'/av_'.$user->avatar) !!}" class="avatar" alt="@lang('User Avatar')"><div class="name">{{ $comment->user->name }} {{ $comment->user->lastname }}</div>
                                        <div class="title"><strong>{!! $post->title !!}</strong></div>
                                        <p>{!! $comment->comment !!}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
