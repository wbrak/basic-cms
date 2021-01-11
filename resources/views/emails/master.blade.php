<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body style="margin: 0; padding: 0; background-color: #f3f3f3;">

    <img src="https://informaticocoruna.com/mail_logo.png" style="width: 25%; display: block; margin-left: 37.5%;">

	<div style="
	display: block;
	max-width: 1024px;
	margin: 0 auto;
	width: 60%;
	">

		<div style="
		    background-color: #fff;
		    padding: 24px;
		">
			@yield('content')

		</div>

		<div style="
		    padding: 24px;
			text-align: center;
			">
			<p>@lang('Mail footer')</p>
		</div>

	</div>

</body>
</html>
