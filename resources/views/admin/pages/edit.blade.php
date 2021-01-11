@extends('admin.master')

@section('title', Lang::get('Edit Page'))

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{!! url('/admin') !!}"><i class="fas fa-home"></i> @lang('Dashboard') /</a>
	<a href="{!! route('Pages') !!}"><i class="fas fa-pager"></i> @lang('Pages') /</a>
	<a href="{!! url('admin/page/'.$page->id.'/edit') !!}"><i class="fas fa-edit"></i> @lang('Edit')</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-9">
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="fas fa-edit"></i> @lang('Edit Page')</h2>
					<a class="btn btn-danger btn-back" href="{!! route('Pages') !!}"><i class="fas fa-undo-alt"></i> @lang('Back to Pages')</i></a>
				</div>

				<div class="inside">
				{!! Form::open(['url' => '/admin/page/'.$page->id.'/edit', 'files' => true]) !!}
					<div class="form-row">

					    <div class="col-md-8">
					        <label for="title">@lang('Title')</label>	
					        <div class="input-group">
					      	    <div class="input-group-prepend">
	                           		<span class="input-group-text" id="basic-addon1">
	                           	   		<i class="fas fa-marker"></i>
	                           		</span>
	                        	</div>
	                        	{!! Form::text('title', $page->title, ['class' => 'form-control required']) !!}
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
		                        {!! Form::select('robots', ['index' => 'Index', 'noindex' => 'No Index'], $page->robots, ['class' => 'custom-select required']) !!}
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
		                        {!! Form::select('links', ['follow' => 'Follow', 'nofollow' => 'No Follow'], $page->links, ['class' => 'custom-select required']) !!}
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
							  {!! Form::text('short', $page->short, ['class' => 'form-control required']) !!}
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
		                        {!! Form::select('status', ['0' => 'Borrador', '1' => 'Publico'], $page->status, ['class' => 'custom-select']) !!}
							</div>
						</div>

						<div class="col-md-9 mtop16">
					        <label for="meta_keywords">@lang('Meta Keywords')</label>
					        <div class="input-group">
					      	    <div class="input-group-prepend">
	                           		<span class="input-group-text" id="basic-addon1">
	                           	   		<i class="fab fa-searchengin"></i>
	                           		</span>
	                        	</div>
	                        	{!! Form::text('meta_keywords', $page->meta_keywords, ['class' => 'form-control required']) !!}
					     	</div>
						</div>

						<div class="col-md-3 mtop16">
							<label for="img">@lang('Image')</label>
							<div class="custom-file">
								{!! Form::file('img', ['class' => 'custom-file-input', 'id' => 'customFile', 'accept' => 'image/*']) !!}
								<label class="custom-file-label" for="customFile" data-browse="@lang('Browse')"><i class="far fa-image"></i> @lang('Find file') ...</label>
							</div>
						</div>

						<div class="col-md-10 mtop16">
					        <label for="meta_description">@lang('Meta Description')</label>
					        <div class="input-group">
					      	    <div class="input-group-prepend">
	                           		<span class="input-group-text" id="basic-addon1">
	                           	   		<i class="fab fa-searchengin"></i>
	                           		</span>
	                        	</div>
	                        	{!! Form::text('meta_description', $page->meta_description, ['class' => 'form-control required']) !!}
					     	</div>
						</div>

						<div class="col-md-2 mtop16">
							<label for="category">@lang('Category')</label>
							<div class="input-group">
								<div class="input-group-prepend">
		                           <span class="input-group-text" id="basic-addon1">
		                           	   <i class="fas fa-folder-open"></i>
		                           	</span>
		                        </div>
		                        {!! Form::select('category', $cats, $page->category, ['class' => 'custom-select required']) !!}
							</div>
						</div>

						<div class="col-md-12 mtop16">
					        <label for="content">@lang('Content')</label>	
						  	{!! Form::textarea('content', $page->content, ['class' => 'form-control ckeditor required']) !!}
						</div>
					</div>
					{!! Form::submit('Editar Pagina', ['class' => 'btn btn-success mtop16']) !!}
					{!! Form::close() !!}
				</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="panel shadow">
					<div class="header">
						<h2 class="title"><i class="far fa-image"></i> @lang('Outstanding Image')</h2>
						<div class="inside">
							<img src="{!! asset('storage/pages/'.$page->file_path.'/'.$page->image) !!}" class="img-fluid" alt="@lang('Page Image')">
						</div>					
					</div>
				</div>

				<div class="panel shadow mtop16 lateral">
					<div class="header">
						<h2 class="title">Proximas zonas <i class="fas fa-question"></i></h2>
						<div class="inside">
							<p>Prueba</p>
						</div>
					</div>
				</div>

				<div class="panel shadow mtop16 lateral">
					<div class="header">
						<h2 class="title">Proximas zonas <i class="fas fa-question"></i></h2>
						<div class="inside">
							<p>Prueba</p>
						</div>
					</div>
				</div>	
			</div>
	
	</div>
</div>

@endsection
