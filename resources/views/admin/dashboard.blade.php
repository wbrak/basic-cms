@extends('admin.master')

@section('title', Lang::get('Dashboard') )

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin') }}"><i class="fas fa-home"></i> @lang('Dashboard')</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
	@if(kvfj(Auth::user()->permissions, 'Dashboard_small_stats'))
	<div class="panel shadow">
		<div class="header">
			<h2 class="title"><i class="fas fa-chart-bar"></i> @lang('Quick Stats')</h2>
		</div>
	</div>
	@endif

	

	<div class="row">
		<div class="col-md-6">
			<canvas id="users" height="100"></canvas>
			<script>
				var ctx = document.getElementById('users').getContext('2d');
				var users = new Chart(ctx, {
				    type: 'bar',
				    data: {
				        labels: ['@lang('Users')'],
				        datasets: [{
				            label: ['@lang('Registered')'],
				            data: <?php echo json_encode($users); ?>,
				            backgroundColor: [
				            	'rgba(19, 134, 4, 0.1)',
				            ],
				            borderColor: [
				            	'rgba(19, 134, 4, 0.96)',
				            ],
				            borderWidth: 2
				        }, {
				            label: ['@lang('Verified')'],
				            data: <?php echo json_encode($usersVerified); ?>,
				            backgroundColor: [
				                'rgba(4, 112, 134, 0.1)',
				            ],
				            borderColor: [
				                'rgba(4, 112, 134, 0.96)',
				            ],
				            borderWidth: 2
				        }, {
				            label: ['@lang('No Verified')'],
				            data: <?php echo json_encode($usersNoVerified); ?>,
				            backgroundColor: [
				                'rgba(198, 131, 6, 0.1)',
				            ],
				            borderColor: [
				                'rgba(198, 131, 6, 0.98)',
				            ],
				            borderWidth: 2
				        }, {
				            label: ['@lang('Banned')'],
				            data: <?php echo json_encode($usersBanned); ?>,
				            backgroundColor: [
				                'rgba(198, 25, 6, 0.1)',
				            ],
				            borderColor: [
				                'rgba(198, 25, 6, 0.98)',
				            ],
				            borderWidth: 2
				        }]
				    },
				    options: {
				    	title: {
			            display: true,
			            fontSize: 20,
			            text: '@lang('Users')'
			        },
				        scales: {
				            yAxes: [{
				                ticks: {
				                    beginAtZero: true
				                }
				            }]
				        }
				    }
				});
			</script>
		</div>

		<div class="col-md-6">
			<canvas id="posts" height="100"></canvas>
			<script>
				var ctx = document.getElementById('posts').getContext('2d');
				var posts = new Chart(ctx, {
				    type: 'bar',
				    data: {
				        labels: ['@lang('Posts')'],
				        datasets: [{
				            label: ['@lang('Posts')'],
				            data: <?php echo json_encode($posts); ?>,
				            backgroundColor: [
				            	'rgba(19, 134, 4, 0.1)',
				            ],
				            borderColor: [
				            	'rgba(19, 134, 4, 0.96)',
				            ],
				            borderWidth: 2
				        }, {
				            label: ['@lang('Posts Published')'],
				            data: <?php echo json_encode($postsPublished); ?>,
				            backgroundColor: [
				                'rgba(4, 112, 134, 0.1)',
				            ],
				            borderColor: [
				                'rgba(4, 112, 134, 0.96)',
				            ],
				            borderWidth: 2
				        }, {
				            label: ['@lang('In Draft')'],
				            data: <?php echo json_encode($postsDraft); ?>,
				            backgroundColor: [
				                'rgba(198, 131, 6, 0.1)',
				            ],
				            borderColor: [
				                'rgba(198, 131, 6, 0.98)',
				            ],
				            borderWidth: 2
				        }]
				    },
				    options: {
				    	title: {
			            display: true,
			            fontSize: 20,
			            text: '@lang('Posts')'
			        },
				        scales: {
				            yAxes: [{
				                ticks: {
				                    beginAtZero: true
				                }
				            }]
				        }
				    }
				});
			</script>
		</div>

		<div class="col-md-6">
			<canvas id="pages" height="100"></canvas>
			<script>
				var ctx = document.getElementById('pages').getContext('2d');
				var pages = new Chart(ctx, {
				    type: 'bar',
				    data: {
				        labels: ['@lang('Pages')'],
				        datasets: [{
				            label: ['@lang('Pages')'],
				            data: <?php echo json_encode($pages); ?>,
				            backgroundColor: [
				            	'rgba(19, 134, 4, 0.1)',
				            ],
				            borderColor: [
				            	'rgba(19, 134, 4, 0.96)',
				            ],
				            borderWidth: 2
				        }, {
				            label: ['@lang('Pages Published')'],
				            data: <?php echo json_encode($pagesPublished); ?>,
				            backgroundColor: [
				                'rgba(4, 112, 134, 0.1)',
				            ],
				            borderColor: [
				                'rgba(4, 112, 134, 0.96)',
				            ],
				            borderWidth: 2
				        }, {
				            label: ['@lang('In Draft')'],
				            data: <?php echo json_encode($pagesDraft); ?>,
				            backgroundColor: [
				                'rgba(198, 131, 6, 0.1)',
				            ],
				            borderColor: [
				                'rgba(198, 131, 6, 0.98)',
				            ],
				            borderWidth: 2
				        }]
				    },
				    options: {
				    	title: {
			            display: true,
			            fontSize: 20,
			            text: '@lang('Pages')'
			        },
				        scales: {
				            yAxes: [{
				                ticks: {
				                    beginAtZero: true
				                }
				            }]
				        }
				    }
				});
			</script>
		</div>

		<div class="col-md-6">
			<canvas id="comments" height="100"></canvas>
			<script>
				var ctx = document.getElementById('comments').getContext('2d');
				var comments = new Chart(ctx, {
				    type: 'bar',
				    data: {
				        labels: ['@lang('Comments')'],
				        datasets: [{
				            label: ['@lang('Comments')'],
				            data: <?php echo json_encode($comments); ?>,
				            backgroundColor: [
				            	'rgba(19, 134, 4, 0.1)',
				            ],
				            borderColor: [
				            	'rgba(19, 134, 4, 0.96)',
				            ],
				            borderWidth: 2
				        }, {
				            label: ['@lang('Comments Published')'],
				            data: <?php echo json_encode($commentsPublished); ?>,
				            backgroundColor: [
				                'rgba(4, 112, 134, 0.1)',
				            ],
				            borderColor: [
				                'rgba(4, 112, 134, 0.96)',
				            ],
				            borderWidth: 2
				        }, {
				            label: ['@lang('To be Approved')'],
				            data: <?php echo json_encode($commentsApproved); ?>,
				            backgroundColor: [
				                'rgba(198, 131, 6, 0.1)',
				            ],
				            borderColor: [
				                'rgba(198, 131, 6, 0.98)',
				            ],
				            borderWidth: 2
				        }]
				    },
				    options: {
				    	title: {
			            display: true,
			            fontSize: 20,
			            text: '@lang('Comments')'
			        },
				        scales: {
				            yAxes: [{
				                ticks: {
				                    beginAtZero: true
				                }
				            }]
				        }
				    }
				});
			</script>
		</div>

	</div>
	
</div>

@endsection