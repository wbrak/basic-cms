@extends('admin.master')

@section('title', Lang::get('Edit Category'))

@section('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{!! url('/admin') !!}"><i class="fas fa-home"></i> @lang('Dashboard') /</a>
		<a href="{!! url('/admin/categories/0') !!}"><i class="far fa-folder-open"></i> @lang('Categories') /</a>
		<a href="{!! route('CategoryEdit',$category->id) !!}"><i class="fas fa-edit"></i> @lang('Edit')</a>
	</li>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="panel shadow">
					<div class="header">
						<h2 class="title"><i class="fas fa-edit"></i> @lang('Edit Category')</h2>
						<a class="btn btn-danger btn-back mtop16" href="{!! url('/admin/categories/0') !!}"><i class="fas fa-undo-alt"></i> @lang('Back to Categories')</a>
					</div>

					<div class="inside">
						{!! Form::open(['url' => '/admin/category/'.$category->id.'/edit', 'files' => true]) !!}
						<label for="name">@lang('Name')</label>
						<div class="input-group">
							<div class="input-group-prepend">
	                        	<span class="input-group-text" id="basic-addon1">
	                        		<i class="fas fa-file-signature"></i>
	                        	</span>
	                        </div>
	                        {!! Form::text('name', $category->name, ['class' => 'form-control']) !!}
						</div>

						<label for="module" class="mtop16">@lang('Module')</label>
						<div class="input-group">
							<div class="input-group-prepend">
		                        <span class="input-group-text" id="basic-addon1">
		                        	<i class="fas fa-archive"></i>
		                        </span>
	                        </div>
	                        {!! Form::select('module', getModulesArray(), $category->module, ['class' => 'custom-select']) !!}
						</div>

						<label for="icon" class="mtop16">@lang('Icon')</label>
						<div class="custom-file">
						{!! Form::file('icon', ['class' => 'custom-file-input', 'id' => 'customFile', 'accept' => 'image/*']) !!}
						<label class="custom-file-label" for="customFile" data-browse="@lang('Browse')">
							<span><i class="far fa-image" aria-hidden="true"></i> @lang('Find file') ...</span>
						</label>
						</div>

						{!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
						{!! Form::close() !!}
					</div>
				</div>
			</div>

			@if(!is_null($cat->icono))
			<div class="col-md-4">
				<div class="panel shadow">
					<div class="header">
						<h2 class="title"><i class="fas fa-edit"></i> @lang('Icon')</h2>
					</div>

					<div class="inside">
						<img src="{{ url('/storage/categories/'.$category->file_path.'/'.$category->icono) }}" class="img-fluid" alt="@lang('Category Icon')">
					</div>
				</div>
			</div>
			@endif
		</div>
	</dic>
@endsection
