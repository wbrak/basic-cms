@extends('admin.master')

@section('title', Lang::get('Details Comment'))

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{!! url('/admin') !!}"><i class="fas fa-home"></i> @lang('Dashboard') /</a>
	<a href="{!! route('Comments') !!}"><i class="fas fa-comments"></i> @lang('Comments') /</a>
	<a href="{!! url('admin/comment/'.$comment->id.'/detail') !!}"><i class="fas fa-eye"></i> @lang('Details')</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="panel shadow">
		<div class="header">
			<h2 class="title"><i class="far fa-eye"></i> @lang('Details Comment')</h2>
			<a class="btn btn-danger btn-back" href="{!! route('Comments') !!}"><i class="fas fa-undo-alt"></i> @lang('Back to Comments')</i></a>
		</div>

			<div class="inside">

				<div class="form-row">

				    <div class="col-md-9">
						<fieldset disabled="">
					        <label for="title">@lang('Title')</label>
					        <div class="input-group">
					      	    <div class="input-group-prepend">
	                           		<span class="input-group-text" id="basic-addon1">
	                           	   		<i class="fas fa-marker"></i>
	                           		</span>
	                        	</div>
	                        	{!! Form::text('title', $comment->post_id, ['class' => 'form-control', 'readonly']) !!}
					     	</div>
					     </fieldset>
					</div>

					<div class="col-md-3">
						<fieldset disabled="">
					        <label for="user_id">@lang('Created by')</label>
					        <div class="input-group">
					      	    <div class="input-group-prepend">
	                           		<span class="input-group-text" id="basic-addon1">
	                           	   		<i class="fas fa-user"></i>
	                           		</span>
	                        	</div>
	                        	{!! Form::text('user_id', $comment->user->name, ['class' => 'form-control', 'readonly']) !!}
					     	</div>
					    </fieldset>
					</div>

					<div class="col-md-3 mtop16">
						<fieldset disabled="">
					        <label for="created_at">@lang('Created on')</label>
					        <div class="input-group">
					      	    <div class="input-group-prepend">
	                           		<span class="input-group-text" id="basic-addon1">
	                           	   		<i class="fas fa-calendar-alt"></i>
	                           		</span>
	                        	</div>
	                        	{!! Form::text('created_at', $comment->created_at, ['class' => 'form-control', 'readonly']) !!}
					     	</div>
					     </fieldset>
					</div>

					<div class="col-md-3 mtop16">
						<fieldset disabled="">
					        <label for="updated_at">@lang('Last Modification')</label>
					        <div class="input-group">
					      	    <div class="input-group-prepend">
	                           		<span class="input-group-text" id="basic-addon1">
	                           	   		<i class="fas fa-calendar-check"></i>
	                           		</span>
	                        	</div>
	                        	{!! Form::text('updated_at', $comment->updated_at, ['class' => 'form-control', 'readonly']) !!}
					     	</div>
					     </fieldset>
					</div>

					<div class="col-md-12 mtop16">
						<fieldset disabled="">
					        <label for="comment">@lang('Comments')</label>
					        <div class="input-group">
					      	    <div class="input-group-prepend">
	                           		<span class="input-group-text" id="basic-addon1">
	                           	   		<i class="fas fa-keyboard"></i>
	                           		</span>
	                        	</div>
	                        	{!! Form::textarea('comment', $comment->comment, ['class' => 'form-control', 'readonly']) !!}
					     	</div>
					     </fieldset>
					</div>

				</div>
			</div>

	</div>
</div>

@endsection
