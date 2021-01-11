@extends('master')

@section('meta_keywords', 'palabra clave 1, palabra clave 2, palabra clave 3')
@section('meta_description', 'Esta es la metadescripcion de la pagina que luego tendra que salir de bd, no mas de 155 caracteres')

@section('title', 'Inicio')

@section('pager')

	<header class="masthead" style="background-image: url('img/home.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>{!! Config::get('company.name') !!}</h1>
                        <span class="subheading">{!! Config::get('company.activity') !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

@endsection

@section('content')

	<div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
            	@foreach($posts as $post)
                <div class="post-preview">
                    <a href="{!! url('/') !!}">
                    	<img style="width: 40%;" src="{!! asset('storage/posts/'.$post->file_path.'/t_'.$post->image) !!}" />
                        <h2 class="post-title">
                            {!! $post->title !!}
                        </h2>
                        <h3 class="post-subtitle">
                            {!! $post->short !!}
                        </h3>
                    </a>
                    <p class="post-meta">Creado por
                        <a href="{!! url('/') !!}">{!! $post->user->nick !!}</a>
                        {!! $post->created_at->diffForHumans() !!}</p>
                </div>
                <hr>
                @endforeach

                <!-- Pager -->
                <div class="clearfix">
                    <a class="btn btn-primary float-right" href="/posts">Entradas Antiguas &rarr;</a>
                </div>
            </div>
        </div>
    </div>

@endsection
