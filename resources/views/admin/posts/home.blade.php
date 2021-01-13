@extends('admin.master')

@section('title', Lang::get('Posts'))

@section('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{!! url('/admin') !!}"><i class="fas fa-home"></i> @lang('Dashboard') /</a>
		<a href="{!! route('Posts') !!}"><i class="fas fa-newspaper"></i> @lang('Posts')</a>
	</li>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="panel shadow">
			<div class="header">
				<h2 class="title"><img src="{{asset('storage/svg/001-sla.svg')}}"> @lang('Posts')</h2>
				@if(kvfj(Auth::user()->permissions, 'PostAdd'))
				<a class="btn btn-danger btn-back" href="{!! route('PostAdd') !!}"><i class="fas fa-plus"></i> @lang('Add Post')</a>
				@endif
			</div>

			<div class="inside">

				<div class="card-deck">
				  @foreach($posts as $post)

				  <div class="card md-3">
					  <div class="card-body">
					    <h5 class="card-title"><a data-toggle="tooltip" data-placement="top" title="@lang('Details')" href="{!! url('admin/post/'.$post->id.'/detail') !!}">{!! $post->title !!}</a></h5>
					    <h6 class="card-subtitle text-muted">@lang('Category') {!! $post->cat->name !!}</h6>
					  </div>
					  <div class="status">
					  	<span @if($post->status == "0") class="card-danger"@endif>@lang('Status Post')</span>
					  </div>
					  	<img src="{!! asset('storage/posts/'.$post->file_path.'/t_'.$post->image) !!}" class="card-img-top" alt="@lang('Post Image')">
					  <div class="card-body">
					    <p class="card-text">{!! $post->short !!}</p>
					    <p class="card-text">{!! $post->content !!}</p>
					  </div>

					  	<div class="opts">
							@if(kvfj(Auth::user()->permissions, 'PostEdit'))
							<a href="{!! url('/admin/post/'.$post->id.'/edit') !!}"><button class="btn btn-warning btn-edit" data-toggle="tooltip" data-placement="top" title="@lang('Edit')"><i class="far fa-eye"></i></button></a>
							@endif
							@if(kvfj(Auth::user()->permissions, 'PostDelete'))
							<a type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#staticBackdrop{!! $post->id !!}"><i class="fas fa-trash-alt"></i></a>

							<div class="modal fade" id="staticBackdrop{!! $post->id !!}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="staticBackdropLabel">@lang('Important Announcement!')</h5>
							      </div>
							      <div class="modal-body">
							        <h5>@lang('Are you sure to delete the post '){!! $post->title !!} ? @lang('This action has no turning back.')</h5>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-noconfirm btn-danger" data-dismiss="modal">@lang('Cancel')</button>
							        {!! Form::open(['method' => 'DELETE', 'action' => ['Admin\PostController@deletePost', $post->id]]) !!}
							        {!! Form::submit(Lang::get('Remove'), array('class'=>'btn btn-confirm btn-success')) !!}
							        {!! Form::close() !!}
							      </div>
							    </div>
							  </div>
							</div>
							@endif
						</div>

					  <div class="card-footer text-muted">
					    @lang('Created') {!! $post->created_at !!} @lang('by') <a data-toggle="tooltip" data-placement="top" title="Usuario" href="{!! url('admin/usuario/'.$post->user_id.'/detail') !!}">{!! $post->user->nick !!}</a>
					  </div>
					</div>
				  @endforeach
				</div>
				<div class="nav-pag">{!! $posts->links() !!}</div>
			</div>

		</div>
	</div>
@endsection
