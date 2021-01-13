@extends('admin.master')

@section('title', Lang::get('Add Post'))

@section('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{!! url('/admin') !!}"><i class="fas fa-home"></i> @lang('Dashboard') /</a>
		<a href="{!! route('Posts') !!}"><i class="fas fa-newspaper"></i> @lang('Posts') /</a>
		<a href="{!! url('admin/post/add') !!}"><i class="fas fa-plus"></i> @lang('Add')</a>
	</li>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="panel shadow">
			<div class="header">
				<h2 class="title"><i class="far fa-plus-square"></i> @lang('Add Post')</h2>
				<a class="btn btn-back btn-danger mtop16" href="{!! route('Posts') !!}"><i class="fas fa-undo-alt"></i> @lang('Back to Posts')</a>
			</div>

			<div class="inside">
				{!! Form::open(['url' => '/admin/post/add', 'files' => true]) !!}
				<div class="form-row">

				    <div class="col-md-8">
				        <label for="title">@lang('Title')</label>
				        <div class="input-group">
				      	    <div class="input-group-prepend">
	                       		<span class="input-group-text" id="basic-addon1">
	                       	   		<i class="fas fa-marker"></i>
	                       		</span>
	                    	</div>
	                    	{!! Form::text('title', null, ['class' => 'form-control required']) !!}
				     	</div>
					</div>

					<div class="col-md-2">
						<label for="robots">@lang('Allow Robots')</label>
						<div class="input-group">
							<div class="input-group-prepend">
	                           <span class="input-group-text" id="basic-addon1">
	                           	   <i class="fas fa-robot"></i>
	                           	</span>
	                        </div>
	                        {!! Form::select('robots', ['index' => 'Index', 'noindex' => 'No Index'], null, ['class' => 'custom-select required']) !!}
						</div>
					</div>

					<div class="col-md-2">
						<label for="links">@lang('Follow Links')</label>
						<div class="input-group">
							<div class="input-group-prepend">
	                           <span class="input-group-text" id="basic-addon1">
	                           	   <i class="fas fa-link"></i>
	                           	</span>
	                        </div>
	                        {!! Form::select('links', ['follow' => 'Follow', 'nofollow' => 'No Follow'], null, ['class' => 'custom-select required']) !!}
						</div>
					</div>

					<div class="col-md-10 mtop16">
				        <label for="short">@lang('Short')</label>
				        <div class="input-group">
				      	    <div class="input-group-prepend">
				      	    	<span class="input-group-text" id="basic-addon1">
		                   	   		<i class="fas fa-tags"></i>
		                   		</span>
		                   	</div>
						  {!! Form::text('short', null, ['class' => 'form-control required']) !!}
						</div>
					</div>

					<div class="col-md-2 mtop16">
						<label for="status">@lang('Status')</label>
						<div class="input-group">
							<div class="input-group-prepend">
	                           <span class="input-group-text" id="basic-addon1">
	                           	   <i class="fas fa-toggle-on"></i>
	                           	</span>
	                        </div>
	                        {!! Form::select('status', ['0' => 'Borrador', '1' => 'Publico'], null, ['class' => 'custom-select']) !!}
						</div>
					</div>

					<div class="col-md-9 mtop16">
				        <label for="meta_keywords">@lang('Meta Keywords') (Meta Keywords para buscadores)</label>
				        <div class="input-group">
				      	    <div class="input-group-prepend">
		                   		<span class="input-group-text" id="basic-addon1">
		                   	   		<i class="fab fa-searchengin"></i>
		                   		</span>
		                	</div>
		                	{!! Form::text('meta_keywords', null, ['class' => 'form-control required']) !!}
				     	</div>
					</div>

					<div class="col-md-3 mtop16">
						<label for="category">@lang('Category')</label>
						<div class="input-group">
							<div class="input-group-prepend">
	                           <span class="input-group-text" id="basic-addon1">
	                           	   <i class="fas fa-folder-open"></i>
	                           	</span>
	                        </div>
	                        {!! Form::select('category', $cats, 0, ['class' => 'custom-select required']) !!}
						</div>
					</div>

					<div class="col-md-10 mtop16">
				        <label for="meta_description">@lang('Meta Description') (Meta Descripcion para buscadores)</label>
				        <div class="input-group">
				      	    <div class="input-group-prepend">
	                       		<span class="input-group-text" id="basic-addon1">
	                       	   		<i class="fab fa-searchengin"></i>
	                       		</span>
	                    	</div>
	                    	{!! Form::text('meta_description', null, ['class' => 'form-control required']) !!}
				     	</div>
					</div>

					<div class="col-md-2 mtop16">
						<label for="img">@lang('Image')</label>
						<div class="custom-file">
							{!! Form::file('img', ['class' => 'custom-file-input', 'id' => 'customFile', 'accept' => 'image/*', 'required']) !!}
							<label class="custom-file-label" for="customFile" data-browse="@lang('Browse')"><i class="far fa-image"></i> @lang('Find file') ...</label>
						</div>
					</div>

					<div class="col-md-12 mtop16">
				        <label for="content">@lang('Content')</label>
					  	{!! Form::textarea('content', null, ['class' => 'form-control ckeditor required']) !!}
					</div>

				  </div>
				{!! Form::submit(Lang::get('Add Post'), array('class' => 'btn btn-success mtop16')) !!}
				{!! Form::close() !!}
			</div>

		</div>
	</div>
@endsection
