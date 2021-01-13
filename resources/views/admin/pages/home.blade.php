@extends('admin.master')

@section('title', Lang::get('Pages'))

@section('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{!! url('/admin') !!}"><i class="fas fa-home"></i> @lang('Dashboard') /</a>
		<a href="{!! route('Pages') !!}"><i class="fas fa-list-alt"></i> @lang('Pages')</a>
	</li>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="panel shadow">
			<div class="header">
				<h2 class="title"><img src="{{asset('storage/svg/023-data.svg')}}"> @lang('Pages')</h2>
				<a class="btn btn-danger btn-back" href="{!! route('PageAdd') !!}"><i class="fas fa-plus"></i> @lang('Add Page')</a>
			</div>

			<div class="inside table-responsive">

				<table class="table table-hover">
				    <thead>
					    <tr>
					      <th scope="col">@lang('Title')</th>
					      <th scope="col">@lang('Friendly Url')</th>
					      <th scope="col">@lang('Image')</th>
					      <th scope="col">@lang('Short')</th>
					      <th scope="col">@lang('Created by')</th>
					      <th scope="col">@lang('Last Modification')</th>
					      <th scope="col">@lang('Actions')</th>
					    </tr>
				    </thead>
				    <tbody>
				    	@foreach($pages as $page)
					    <tr @if($page->status == "0") class="table-danger" @endif>
					      <td data-toggle="tooltip" data-placement="top" title="@lang('Details')"><a href="{!! url('admin/page/'.$page->id.'/detail') !!}">{!! $page->title !!}</a></td>
					      <td>{!! $page->slug !!}</td>
					      <td><img src="{!! asset('storage/pages/'.$page->file_path.'/'.$page->image) !!}" class="table-img" alt="@lang('Page Image')"></td>
					      <td>{!! $page->short !!}</td>
					      <td>{!! $page->user->name !!}</td>
					      <td>{!! $page->created_at !!}</td>
					      <td>

					      	<div class="opts">
								@if(kvfj(Auth::user()->permissions, 'PageEdit'))
								<a href="{!! url('/admin/page/'.$page->id.'/edit') !!}"><button class="btn btn-warning btn-edit" data-toggle="tooltip" data-placement="top" title="@lang('Edit')"><i class="far fa-eye"></i></button></a>
								@endif
								@if(kvfj(Auth::user()->permissions, 'PageDelete'))
								<a type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#staticBackdrop{!! $page->id !!}"><i class="fas fa-trash-alt"></i></a>

								<div class="modal fade" id="staticBackdrop{!! $page->id !!}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="staticBackdropLabel">@lang('Important Announcement!')</h5>
								      </div>
								      <div class="modal-body">
								        <h5>@lang('Are you sure to delete the page '){!! $page->title !!} ? @lang('This action has no turning back.')</h5>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-noconfirm btn-danger" data-dismiss="modal">@lang('Cancel')</button>
								        {!! Form::open(['method' => 'DELETE', 'action' => ['Admin\PageController@deletePage', $page->id]]) !!}
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
				<div class="nav-pag">{!! $pages->links() !!}</div>

			</div>
		</div>
	</div>
@endsection
