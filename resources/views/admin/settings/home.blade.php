@extends('admin.master')

@section('title', Lang::get('Settings'))
@section('meta')
<meta http-equiv="Expires" content="0">
<meta http-equiv="Cache-Control" content="no-cache">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{!! url('/admin') !!}"><i class="fas fa-home"></i> @lang('Dashboard') /</a>
	<a href="{{ url('/admin/settings') }}"><i class="fas fa-cogs"></i> @lang('Settings')</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-user">
        <div class="row">
            <div class="col-md-4">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-cogs"></i> @lang('Settings Company')</h2>
                    </div>

                    <div class="inside">
                        {!! Form::open(['url' => '/admin/settings/', 'files' => true]) !!}
                        <div class="form-row">

                            <div class="col-md-12">
                                <label for="name">@lang('Company Name')</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-building"></i>
                                    </span>
                                    {!! Form::text('name', Config::get('company.name'), ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-12 mtop16">
                                <label for="email">@lang('Admin Email')</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-mail-bulk"></i>
                                    </span>
                                    {!! Form::email('email', Config::get('company.email'), ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-12 mtop16">
                                <label for="phone">@lang('Company Phone')</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    {!! Form::text('phone', Config::get('company.phone'), ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-12 mtop16">
                                <label for="slogan">@lang('Slogan Company')</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-store-alt"></i>
                                    </span>
                                    {!! Form::text('slogan', Config::get('company.slogan'), ['class' => 'form-control']) !!}
                                </div>
                            </div>

                        </div>
                        {!! Form::submit(Lang::get('Save'), array('class' => 'btn btn-success mtop16')) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-cogs"></i> @lang('Images')</h2>
                    </div>

                    <div class="inside">
                        <div class="col-md-12">
                            {!! Form::open(['url' => '/admin/settings/logo', 'files' => true]) !!}
                            <label for="logo">@lang('Logo')</label>
                            <div class="logo">
                                <img src="{!! asset('storage/logo.png') !!}" alt="@lang('Logo')">
                            </div>
                            <div class="custom-file">
                                {!! Form::file('logo', ['class' => 'custom-file-input', 'id' => 'customFile', 'accept' => 'image/*', 'required']) !!}
                                <label class="custom-file-label" for="customFile" data-browse="@lang('Browse')"><i class="far fa-image"></i> @lang('Find file') ...</label>
                            </div>
                            {!! Form::submit(Lang::get('Save'), array('class' => 'btn btn-success mtop16')) !!}
                            {!! Form::close() !!}
                        </div>
                        <hr>

                        <div class="col-md-12 mtop16">
                            {!! Form::open(['url' => '/admin/settings/faviconAdmin', 'files' => true]) !!}
                            <label for="faviconAdmin">@lang('Favicon Admin')</label>
                            <div class="faviconAdmin">
                                <img src="{!! asset('storage/faviconAdmin.ico') !!}" alt="@lang('Favicon Admin')">
                            </div>
                            <div class="custom-file">
                                {!! Form::file('faviconAdmin', ['class' => 'custom-file-input', 'id' => 'customFile', 'accept' => 'image/*', 'required']) !!}
                                <label class="custom-file-label" for="customFile" data-browse="@lang('Browse')"><i class="far fa-image"></i> @lang('Find file') ...</label>
                            </div>
                            {!! Form::submit(Lang::get('Save'), array('class' => 'btn btn-success mtop16')) !!}
                            {!! Form::close() !!}
                        </div>
                        <hr>

                        <div class="col-md-12 mtop16">
                            {!! Form::open(['url' => '/admin/settings/favicon', 'files' => true]) !!}
                            <label for="favicon">@lang('Favicon Shop')</label>
                            <div class="favicon">
                                <img src="{!! asset('storage/favicon.ico') !!}" alt="@lang('Favicon Shop')">
                            </div>
                            <div class="custom-file">
                                {!! Form::file('favicon', ['class' => 'custom-file-input', 'id' => 'customFile', 'accept' => 'image/*', 'required']) !!}
                                <label class="custom-file-label" for="customFile" data-browse="@lang('Browse')"><i class="far fa-image"></i> @lang('Find file') ...</label>
                            </div>
                            {!! Form::submit(Lang::get('Save'), array('class' => 'btn btn-success mtop16')) !!}
                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-cogs"></i> @lang('Settings Cms')</h2>
                    </div>

                    <div class="inside">
                        <!--Comprobamos si el status esta a true y existe más de un lenguaje-->
                        @if (config('locale.status') && count(config('locale.languages')) > 1)
                        <div class="top-right links">
                        @foreach (array_keys(config('locale.languages')) as $lang)
                            @if ($lang != App::getLocale())
                                <span>@lang('Change Language Administration') <i class="fas fa-flag"></i><a href="{!! route('SettingsLang', $lang) !!}"> {!! $lang !!} <small>{!! $lang !!}</small></a></span>
                            @endif
                        @endforeach
                        </div>
                        @endif

                        <div class="col-md-12 mtop16">
                            <label for="posts_per_page">@lang('Posts per Page')</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fas fa-list-ol"></i>
                                </span>
                                {!! Form::text('posts_per_page', Config::get('company.posts_per_page'), ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-12 mtop16">
                            <label for="maintenance">@lang('Maintenance Mode')</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fas fa-tools"></i>
                                </span>
                                {!! Form::select('maintenance', ['0' => 'Desactivado', '1' => 'Activado'], Config::get('company.maintenance'), ['class' => 'form-control']) !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
