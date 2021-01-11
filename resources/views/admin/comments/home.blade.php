@extends('admin.master')

@section('title', Lang::get('Comments'))

@section('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{!! url('/admin') !!}"><i class="fas fa-home"></i> @lang('Dashboard') /</a>
		<a href="{!! route('Comments') !!}"><i class="fas fa-comments"></i> @lang('Comments')</a>
	</li>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="panel shadow">
			<div class="header">
				<h2 class="title"><i class="fas fa-newspaper"></i> @lang('Comments')</h2>
			</div>

			<div class="inside table-responsive">

				<table class="table table-hover">
				    <thead>
					    <tr>
					      <th scope="col">@lang('Created by')</th>
					      <th scope="col">@lang('Post of Comment')</th>
					      <th scope="col">@lang('Comment')</th>
					      <th scope="col">@lang('Creation Date')</th>
					      <th scope="col">@lang('Actions')</th>
					    </tr>
				    </thead>
				    <tbody>
				    	@foreach($comments as $comment)
					    <tr @if($comment->status == "0") class="table-danger" @endif>
					    	<td>{!! $comment->user->name !!}</td>
					    	<td>{!! $comment->post_id !!}</td>
					      	<td data-toggle="tooltip" data-placement="top" title="@lang('Details')"><a href="{!! url('admin/comment/'.$comment->id.'/detail') !!}">{!! $comment->comment !!}</a></td>
					      	<td>{!! $comment->created_at !!}</td>
					      	<td>

					      	<div class="opts">
								@if(kvfj(Auth::user()->permissions, 'CommentEdit'))
								<a href="{!! url('/admin/comment/'.$comment->id.'/edit') !!}"><button class="btn btn-warning btn-edit" data-toggle="tooltip" data-placement="top" title="@lang('Edit Comment')"><i class="far fa-eye"></i></button></a>
								@endif
								@if(kvfj(Auth::user()->permissions, 'CommentDelete'))
								<a type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#staticBackdrop{!! $comment->id !!}"><i class="fas fa-trash-alt"></i></a>

								<div class="modal fade" id="staticBackdrop{!! $comment->id !!}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="staticBackdropLabel">@lang('Important Announcement!')</h5>
								      </div>
								      <div class="modal-body">
								        <h5>@lang('Are you sure to delete the comment '){!! $comment->title !!} ? @lang('This action has no turning back.')</h5>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-noconfirm btn-danger" data-dismiss="modal">@lang('Cancel')</button>
								        {!! Form::open(['method' => 'DELETE', 'action' => ['Admin\CommentController@deleteComment', $comment->id]]) !!}
								        {!! Form::submit(Lang::get('Remove'), array('class'=>'btn btn-confirm btn-success')) !!}
								        {!! Form::close() !!}
								      </div>
								    </div>
								  </div>
								</div>
								@endif
							</div>
					      </td>
					    </tr>
					    @endforeach
				    </tbody>
				</table>
				<div class="nav-pag">{!! $comments->links() !!}</div>
			</div>
		</div>
	</div>
@endsection
