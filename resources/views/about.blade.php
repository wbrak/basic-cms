@extends('master')

@section('meta_keywords', 'palabra clave 1, palabra clave 2, palabra clave 3')
@section('meta_description', 'Esta es la metadescripcion de la pagina que luego tendra que salir de bd, no mas de 155 caracteres')

@section('title', 'Acerca de ..')

@section('pager')

	<header class="masthead" style="background-image: url('img/about.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Acerca de ..</h1>
                        <span class="subheading">A lo que te dedicas</span>
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
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur?</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius praesentium recusandae illo eaque architecto error, repellendus iusto reprehenderit, doloribus, minus sunt. Numquam at quae voluptatum in officia voluptas voluptatibus, minus!</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut consequuntur magnam, excepturi aliquid ex itaque esse est vero natus quae optio aperiam soluta voluptatibus corporis atque iste neque sit tempora!</p>
      </div>
    </div>
  </div>

@endsection