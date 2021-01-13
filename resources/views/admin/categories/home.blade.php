@extends('admin.master')

@section('title', Lang::get('Categories'))

@section('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{!! url('/admin') !!}"><i class="fas fa-home"></i> @lang('Dashboard') /</a>
		<a href="{!! url('/admin/categories/0') !!}"><i class="fas fa-folder-open"></i> @lang('Categories')</a>
	</li>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="panel shadow">
					<div class="header">
						<h2 class="title"><img src="{{asset('storage/svg/038-tshirt.svg')}}"> @lang('Add Category')</h2>
					</div>

					<div class="inside">
						@if(kvfj(Auth::user()->permissions, 'CategoryAdd'))
						{!! Form::open(['url' => '/admin/category/add', 'files' => true]) !!}
						<label for="name">@lang('Name')</label>
						<div class="input-group">
							<div class="input-group-prepend">
	                        	<span class="input-group-text" id="basic-addon1">
	                        		<i class="fas fa-file-signature"></i>
	                        	</span>
	                        </div>
	                        {!! Form::text('name', null, ['class' => 'form-control required']) !!}
						</div>

						<label for="module" class="mtop16">@lang('Module')</label>
						<div class="input-group">
							<div class="input-group-prepend">
		                        <span class="input-group-text" id="basic-addon1">
		                        	<i class="fas fa-archive"></i>
		                        </span>
	                        </div>
	                        {!! Form::select('module', getModulesArray(), 0, ['class' => 'custom-select']) !!}
						</div>

						<label for="icon" class="mtop16">@lang('Icon')</label>
						<div class="custom-file">
						{!! Form::file('icon', ['class' => 'custom-file-input required', 'id' => 'customFile', 'accept' => 'image/*']) !!}
						<label class="custom-file-label" for="customFile" data-browse="@lang('Browse')">
							<span><i class="far fa-image" aria-hidden="true"></i> @lang('Find file') ...</span>
						</label>
						</div>

						{!! Form::submit(Lang::get('Save'), array('class' => 'btn btn-success mtop16')) !!}
						{!! Form::close() !!}
						@endif
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="panel shadow">
					<div class="header">
						<h2 class="title"><img src="{{asset('storage/svg/038-tshirt.svg')}}"> @lang('Categories')</h2>
					</div>

					<div class="inside">
						<nav class="nav nav-tabs">
						@foreach(getModulesArray() as $m => $k)
						<a class="nav-item nav-link active" href="{!! url('/admin/categories/'.$m) !!}"><i class="fas fa-list"></i> {!! $k !!}</a>
						@endforeach
	                    </nav>
						<table class="table mtop16">
							<thead class="table-cat">
								<tr>
									<td>@lang('Icon')</td>
									<td>@lang('Name')</td>
									<td>@lang('Url')</td>
									<td>@lang('Actions')</td>
								</tr>
							</thead>
							<tbody>
								@foreach($categories as $category)
								<tr>
									<td>
										@if(!is_null($category->icono))
											<img src="{{ url('/storage/categories/'.$category->file_path.'/'.$category->icono) }}" class="table-img" alt="@lang('Category Icon')">
										@endif
									</td>
									<td>{!! $category->name !!}</td>
									<td>{!! $category->slug !!}</td>
									<td>
										@if(kvfj(Auth::user()->permissions, 'CategoryEdit'))
										<a href="{!! url('admin/category/'.$category->id.'/edit') !!}"><button class="btn btn-warning btn-edit" data-toggle="tooltip" data-placement="top" title="@lang('Edit')"><i class="fas fa-edit"></i></button></a>
										@endif
										@if(kvfj(Auth::user()->permissions, 'CategoryDelete'))
										<a type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#staticBackdrop{!! $category->id !!}"><i class="fas fa-trash-alt"></i></a>
										@endif

										<div class="modal fade" id="staticBackdrop{!! $category->id !!}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h3 class="modal-title" id="staticBackdropLabel">@lang('Important Announcement!')</h3>
													</div>
												<div class="modal-body">
													<h5>@lang('Are you sure to delete the category '){!! $category->name !!} ? @lang('This action has no turning back.')</h5>
												</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-noconfirm btn-danger" data-dismiss="modal">@lang('Cancel')</button>
														{!! Form::open(['method' => 'DELETE', 'action' => ['Admin\CategoryController@deleteCategory', $category->id]]) !!}
														{!! Form::submit(Lang::get('Remove'), array('class'=>'btn btn-confirm btn-success')) !!}
														{!! Form::close() !!}
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</dic>
@endsection
