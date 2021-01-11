@extends('admin.master')

@section('title', Lang::get('User Profile'))

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{!! url('/admin') !!}"><i class="fas fa-home"></i> @lang('Dashboard') /</a>
	<a href="{{ url('/admin/users/all') }}"><i class="fas fa-users"></i> @lang('Users') /</a>
	<a href="{{ route('UserProfile', Auth::user()->id) }}"><i class="fas fa-user-edit"></i> @lang('User Profile') | {{ Auth::user()->nick }}</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-user">
        <div class="row">
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-user"></i> @lang('User Profile')</h2>
                    </div>

                    <div class="inside">
                        <div class="mini-profile">
                            {!! Form::open(['url' => 'admin/user/profile/avatar', 'id' => 'form_avatar_change', 'files' => true]) !!}
                                <a href="#" id="btn_avatar_edit">
                                    <div class="overlay" id="avatar_change_overlay"><i class="fas fa-camera"></i></div>
                                    @if(is_null(Auth::user()->avatar))
                                        <img src="{{ asset('storage/default-avatar.png') }}" alt="@lang('Default Avatar')">
                                    @else
                                    <img src="{{ asset('storage/profiles/'.Auth::id().'/av_'.Auth::user()->avatar) }}" alt="@lang('User Avatar')">
                                    @endif
                                </a>
                                {!! Form::file('avatar', ['id' => 'input_file_avatar', 'accept' => 'image/*', 'class' => 'form-control']) !!}
                            {!! Form::close() !!}

                            <div class="info">
                                <span class="title"><i class="fas fa-envelope"></i> @lang('E-Mail Address')</span>
                                    <span class="text">{{ Auth::user()->email }}</span>
                                <span class="title"><i class="fas fa-address-card"></i> @lang('Name') @lang('And') @lang('Lastname')</span>
                                    <span class="text">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</span>
                                <span class="title"><i class="fas fa-calendar-alt"></i> @lang('Registration Date')</span>
                                    <span class="text">{{ Auth::user()->created_at }}</span>
                                <span class="title"><i class="fas fa-user-shield"></i> @lang('User Role')</span>
                                    <span class="text">{{ getRoleUserArray(null, Auth::user()->role) }}</span>
                                <span class="title"><i class="fas fa-user-check"></i> @lang('User Status')</span>
                                    <span class="text">{{ getUserStatusArray(null, Auth::user()->status) }}</span>
                                <span class="title"><i class="fas fa-calendar-check"></i> @lang('Verification Date')</span>
                                    <span class="text">{{ Auth::user()->email_verified_at }}</span>
                                <span class="title"><i class="fas fa-user-cog"></i> @lang('Updated')</span>
                                    <span class="text">{{ Auth::user()->updated_at }}</span>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-user-edit"></i> @lang('Edit Profile')</h2>
                    </div>

                    <div class="inside">
                        {!! Form::open(['url' => '/admin/user/profile/info']) !!}

                        <div class="row">

                            <div class="col-md-6">
                                <label for="name">@lang('Name')</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-address-card"></i>
                                    </span>
                                    </div>
                                    {!! Form::text('name', Auth::user()->name, ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="lastname">@lang('Lastname')</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-address-card"></i>
                                    </span>
                                    </div>
                                    {!! Form::text('lastname', Auth::user()->lastname, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-6 mtop16">
                                <label for="email">@lang('E-Mail Address')</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    </div>
                                    {!! Form::text('email', Auth::user()->email, ['class' => 'form-control', 'disabled']) !!}
                                </div>
                            </div>

                        </div>
                        {!! Form::submit(Lang::get('Update Profile'), array('class' => 'btn btn-profile mtop16')) !!}
                        {!! Form::close() !!}

                    </div>
                </div>

                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-unlock-alt"></i> @lang('Change Password')</h2>
                    </div>

                    <div class="inside">

                        {!! Form::open(['url' => '/admin/user/profile/password']) !!}

                        <div class="row">

                            <div class="col-md-6">
                                <label for="apassword">@lang('Current Password')</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon1">
                                           <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    {!! Form::password('apassword', ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="npassword">@lang('New Password')</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon1">
                                           <i class="fas fa-lock-open"></i>
                                        </span>
                                    </div>
                                    {!! Form::password('npassword', ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6 mtop16">
                                <label for="cnpassword">@lang('Confirm New Password')</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon1">
                                           <i class="fas fa-unlock"></i>
                                        </span>
                                    </div>
                                    {!! Form::password('cnpassword', ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                        </div>
                        {!! Form::submit(Lang::get('Change Password'), array('class' => 'btn btn-profile mtop16')) !!}
                        {!! Form::close() !!}

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
