@extends('admin.master')

@section('title', Lang::get('Edit Comment'))

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{!! url('/admin') !!}"><i class="fas fa-home"></i> @lang('Dashboard') /</a>
	<a href="{!! route('Comments') !!}"><i class="fas fa-comments"></i> @lang('Comments') /</a>
	<a href="{!! url('admin/comment/'.$comment->id.'/edit') !!}"><i class="fas fa-edit"></i> @lang('Edit')</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="panel shadow">
		<div class="header">
			<h2 class="title"><img src="{{asset('storage/svg/050-comments.svg')}}"> @lang('Edit Comment')</h2>
			<a class="btn btn-back btn-danger mtop16" href="{!! route('Comments') !!}"><i class="fas fa-undo-alt"></i> @lang('Back to Comments')</a>
		</div>

		<div class="inside">
			{!! Form::open(['url' => '/admin/comment/'.$comment->id.'/edit']) !!}

			<div class="form-row">

			    <div class="col-md-9">
			        <label for="post_id">@lang('Title of Post')</label>
			        <div class="input-group">
			      	    <div class="input-group-prepend">
                       		<span class="input-group-text" id="basic-addon1">
                       	   		<i class="fas fa-marker"></i>
                       		</span>
                    	</div>
                    	{!! Form::text('post_id', $comment->post_id, ['class' => 'form-control', 'required']) !!}
			     	</div>
				</div>

				<div class="col-md-3">
					<label for="status">@lang('Status')</label>
					<div class="input-group">
						<div class="input-group-prepend">
                           <span class="input-group-text" id="basic-addon1">
                           	   <i class="fas fa-toggle-on"></i>
                           	</span>
                        </div>
                        {!! Form::select('status', ['0' => 'Borrador', '1' => 'Publico'], $comment->status, ['class' => 'custom-select']) !!}
					</div>
				</div>

				<div class="col-md-3">
			        <label for="user_id">@lang('Created by')</label>
			        <div class="input-group">
			      	    <div class="input-group-prepend">
                       		<span class="input-group-text" id="basic-addon1">
                       	   		<i class="fas fa-user"></i>
                       		</span>
                    	</div>
                    	{!! Form::text('user_id', $comment->user->name, ['class' => 'form-control', 'required']) !!}
			     	</div>
				</div>

			    <div class="col-md-12 mtop16">
		        <label for="comment">@lang('Comments')</label>
			  		{!! Form::textarea('comment', $comment->comment, ['class' => 'form-control', 'id' => 'contenido', 'required']) !!}
				  <script>
					// Replace the textarea #example with SCEditor
					var textarea = document.getElementById('contenido');
					sceditor.create(textarea, {
						format: 'bbcode',
						style: 'minified/themes/content/default.min.css'
					});
					</script>
				</div>

			</div>
			{!! Form::submit(Lang::get('Add Comment'), ['class' => 'btn btn-success mtop16']) !!}
			{!! Form::close() !!}
		</div>

	</div>
</div>

@endsection
