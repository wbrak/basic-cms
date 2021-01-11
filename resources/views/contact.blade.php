@extends('master')

@section('meta_keywords', 'palabra clave 1, palabra clave 2, palabra clave 3')
@section('meta_description', 'Esta es la metadescripcion de la pagina que luego tendra que salir de bd, no mas de 155 caracteres')

@section('title', 'Contacto')

@section('pager')

	<header class="masthead" style="background-image: url('img/contact.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Contacto</h1>
                        <span class="subheading">Alguna pregunta? Tenemos respuestas.</span>
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
            <p>¿Quieres contactarnos? Complete el siguiente formulario para enviarme un mensaje y me pondré en contacto con usted lo antes posible!</p>
            <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
            <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
            <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
            <form name="sentMessage" id="contactForm" novalidate>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                  <label>Nombre</label>
                  <input type="text" class="form-control" placeholder="Nombre" id="name" required data-validation-required-message="Por favor introduce tu nombre.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                  <label>Correo Electrónico</label>
                  <input type="email" class="form-control" placeholder="Correo Electrónico" id="email" required data-validation-required-message="Por favor introduce tu correo electrónico.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">
                  <label>Número de Teléfono (opcional)</label>
                  <input type="tel" class="form-control" placeholder="Número de Teléfono (opcional)" id="phone">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                  <label>Mensaje</label>
                  <textarea rows="5" class="form-control" placeholder="Mensaje" id="message" required data-validation-required-message="Por favor introduce un mensaje."></textarea>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <br>
              <div id="success"></div>
              <button type="submit" class="btn btn-primary" id="sendMessageButton">Enviar</button>
            </form>
          </div>
        </div>
      </div>

@endsection