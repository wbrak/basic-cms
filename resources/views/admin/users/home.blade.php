@extends('admin.master')

@section('title', Lang::get('Users'))

@section('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{!! url('/admin') !!}"><i class="fas fa-home"></i> @lang('Dashboard') /</a>
		<a href="{!! url('/admin/users/all') !!}"><i class="fas fa-user-friends"></i> @lang('Users')</a>
	</li>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="panel shadow">
			<div class="header">
				<h2 class="title"><i class="fas fa-users"></i> @lang('Users')</h2>
			</div>

			<div class="inside table-responsive">
				<div class="row">
					<div class="col-md-2 offset-md-10">
						<div class="dropdown">
							<button class="btn btn-filter dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-filter"></i> @lang('Filter')
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							    <a class="dropdown-item" href="{{ url('/admin/users/all') }}"><i class="fas fa-stream"></i> @lang('All')</a>
							    <a class="dropdown-item" href="{{ url('/admin/users/0') }}"><i class="fas fa-unlink"></i> @lang('Registered')</a>
							    <a class="dropdown-item" href="{{ url('/admin/users/1') }}"><i class="fas fa-user-check"></i> @lang('Verified')</a>
							    <a class="dropdown-item" href="{{ url('/admin/users/100') }}"><i class="fas fa-heart-broken"></i> @lang('Banned')</a>
							</div>
						</div>
					</div>
				</div>

				<table class="table table-hover">
					<thead>
						<tr>
	                        <th scope="col">@lang('Avatar')</th>
	                        <th scope="col">@lang('Name')</th>
	                        <th scope="col">@lang('E-Mail Address')</th>
	                        <th scope="col">@lang('User Role')</th>
	                        <th scope="col">@lang('Status')</th>
	                        <th scope="col">@lang('Actions')</th>
						</tr>
	                </thead>
	                <tbody>
	                    @foreach($users as $user)
						<tr @if($user->status == "100") class="table-danger" @endif>
							<td>@if(is_null($user->avatar))
                            <img src="{{ asset('storage/default-avatar.png') }}" class="table-img rounded-circle" alt="@lang('Default Avatar')">
                            @else
                            <img src="{{ asset('storage/profiles/'.$user->id.'/av_'.$user->avatar) }}" class="table-img rounded-circle" alt="@lang('User Avatar')">
                            @endif</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ getRoleUserArray(null, $user->role) }}</td>
							<td>{{ getUserStatusArray(null, $user->status) }}</td>
							<td>
								<div>
									@if(kvfj(Auth::user()->permissions, 'UserEdit'))
									<a href="{{ url('/admin/user/'.$user->id.'/edit') }}"><button class="btn btn-warning btn-edit" data-toggle="tooltip" data-placement="top" title="@lang('Show User')"><i class="far fa-eye"></i></button></a>
									@endif
									@if(kvfj(Auth::user()->permissions, 'UserPermissions'))
									<a href="{{ url('/admin/user/'.$user->id.'/permissions') }}"><button class="btn btn-primary btn-permission" data-toggle="tooltip" data-placement="top" title="@lang('User Permissions')"><i class="fas fa-user-shield"></i></button></a>
									@endif
									@if(kvfj(Auth::user()->permissions, 'UserDelete'))
									<a type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#staticBackdrop{{ $user->id }}"><i class="fas fa-trash-alt"></i></a>

									<div class="modal fade" id="staticBackdrop{{ $user->id }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
									  <div class="modal-dialog" role="document">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="staticBackdropLabel">@lang('Important Announcement!')</h5>
									      </div>
									      <div class="modal-body">
									        <h5>@lang('Are you sure to delete the user '){{ $user->name }} {{ $user->lastname }} ? @lang('This action has no turning back.')</h5>
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-noconfirm btn-danger" data-dismiss="modal">@lang('Cancel')</button>
									        {!! Form::open(['method' => 'DELETE', 'action' => ['Admin\UserController@deleteUser', $user->id]]) !!}
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
				<div class="nav-pag">{{ $users->links() }}</div>
			</div>
		</div>

	</div>
@endsection
