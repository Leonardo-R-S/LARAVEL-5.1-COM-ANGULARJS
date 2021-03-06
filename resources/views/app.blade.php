<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
	<meta charset="utf-8" >
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>



	@if(Config::get('app.debug'))
		<link href="{{ asset('build/css/app.css') }}" rel="stylesheet"/>
		<link href="{{ asset('build/css/components.css') }}" rel="stylesheet"/>
		<link href="{{ asset('build/css/flaticon.css') }}" rel="stylesheet"/>
		<link href="{{ asset('build/css/font-awesome.css') }}" rel="stylesheet"/>

	@else

		<link href="{{ url(elixir('css/all.css')) }}" rel="stylesheet"/>
	@endif

	<!-- Fonts -->


	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Laravel</a>
			</div>

			<div class="collapse navbar-collapse" id="navbar">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Welcome</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if(auth()->guest())
						@if(!Request::is('auth/login'))
							<li><a href="{{ url('/auth/login') }}">Login</a></li>
						@endif
						@if(!Request::is('auth/register'))
							<li><a href="{{ url('/auth/register') }}">Register</a></li>
						@endif
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>


	<div ng-view>

	</div>

	@if(Config::get('app.debug'))
		<script src="{{asset('build/js/vendor/jquery.min.js') }}"></script>

		<script src="{{asset('build/js/vendor/angular.js') }}"></script>

		<script src="{{asset('build/js/vendor/angular-route.min.js') }}"></script>
		<script src="{{asset('build/js/vendor/angular-resource.js') }}"></script>
		<script src="{{asset('build/js/vendor/angular-animate.min.js') }}"></script>

		<script src="{{asset('build/js/vendor/ui-bootstrap-tpls.min.js') }}"></script>
		<script src="{{asset('build/js/vendor/navbar.min.js') }}"></script>
		<script src="{{asset('build/js/vendor/angular-messages.min.js') }}"></script>

		<script src="{{asset('build/js/vendor/query-string.js') }}"></script>

		<script src="{{asset('build/js/vendor/angular-oauth2.min.js') }}"></script>
		<script src="{{asset('build/js/vendor/angular-cookies.min.js') }}"></script>
		<script src="{{asset('build/js/vendor/ng-file-upload.min.js') }}"></script>
		<script src="{{asset('build/js/vendor/http-auth-interceptor.js') }}"></script>
		<script src="{{asset('build/js/vendor/dirPagination.js') }}"></script>

		<script src="{{asset('build/js/app.js') }}"></script>

		<!-- CONTROLLERS !-->
		<script src="{{asset('build/js/controllers/login.js') }}"></script>
		<script src="{{asset('build/js/controllers/loginModal.js') }}"></script>
		<script src="{{asset('build/js/controllers/home.js') }}"></script>

		<script src="{{asset('build/js/controllers/client/client.js') }}"></script>
		<script src="{{asset('build/js/controllers/client/clientList.js') }}"></script>
		<script src="{{asset('build/js/controllers/client/clientNew.js') }}"></script>
		<script src="{{asset('build/js/controllers/client/clientEdit.js') }}"></script>
		<script src="{{asset('build/js/controllers/client/clientRemove.js') }}"></script>

		<script src="{{asset('build/js/controllers/project/projectList.js') }}"></script>
		<script src="{{asset('build/js/controllers/project/projectNew.js') }}"></script>
		<script src="{{asset('build/js/controllers/project/project.js') }}"></script>
		<script src="{{asset('build/js/controllers/project/projectEdit.js') }}"></script>
		<script src="{{asset('build/js/controllers/project/projectRemove.js') }}"></script>

		<script src="{{asset('build/js/controllers/projectNote/projectNoteList.js') }}"></script>
		<script src="{{asset('build/js/controllers/projectNote/projectNote.js') }}"></script>
		<script src="{{asset('build/js/controllers/projectNote/projectNoteNew.js') }}"></script>
		<script src="{{asset('build/js/controllers/projectNote/projectNoteEdit.js') }}"></script>
		<script src="{{asset('build/js/controllers/projectNote/projectNoteRemove.js') }}"></script>

		<script src="{{asset('build/js/controllers/projectMember/projectMemberList.js') }}"></script>
		<script src="{{asset('build/js/controllers/projectMember/projectMember.js') }}"></script>
		<script src="{{asset('build/js/controllers/projectMember/projectMemberNew.js') }}"></script>

		<script src="{{asset('build/js/controllers/projectMember/projectMemberRemove.js') }}"></script>

		<script src="{{asset('build/js/controllers/projectTask/projectTaskList.js') }}"></script>
		<script src="{{asset('build/js/controllers/projectTask/projectTask.js') }}"></script>
		<script src="{{asset('build/js/controllers/projectTask/projectTaskNew.js') }}"></script>
		<script src="{{asset('build/js/controllers/projectTask/projectTaskEdit.js') }}"></script>
		<script src="{{asset('build/js/controllers/projectTask/projectTaskRemove.js') }}"></script>

		<script src="{{asset('build/js/controllers/projectFile/projectFileList.js') }}"></script>
		<script src="{{asset('build/js/controllers/projectFile/projectFile.js') }}"></script>
		<script src="{{asset('build/js/controllers/projectFile/projectFileNew.js') }}"></script>
		<script src="{{asset('build/js/controllers/projectFile/projectFileEdit.js') }}"></script>
		<script src="{{asset('build/js/controllers/projectFile/projectFileRemove.js') }}"></script>

		<!-- DIRECTIVES !-->
		<script src="{{asset('build/js/directives/projectFileDownload.js') }}"></script>
		<script src="{{asset('build/js/directives/loginForm.js') }}"></script>

		<!-- FILTERS !-->
		<script src="{{asset('build/js/filters/date-br.js') }}"></script>

		<!-- SERVICES !-->

		<script src="{{asset('build/js/services/url.js') }}"></script>
		<script src="{{asset('build/js/services/client.js') }}"></script>
		<script src="{{asset('build/js/services/project.js') }}"></script>
		<script src="{{asset('build/js/services/projectNote.js') }}"></script>
		<script src="{{asset('build/js/services/projectMember.js') }}"></script>
		<script src="{{asset('build/js/services/projectTask.js') }}"></script>
		<script src="{{asset('build/js/services/projectFile.js') }}"></script>
		<script src="{{asset('build/js/services/user.js') }}"></script>
		<script src="{{asset('build/js/services/oauthFixInterceptor.js') }}"></script>


	@else
		<script src="{{url(elixir('js/all.js'))}}"></script>
	@endif
</body>
</html>
