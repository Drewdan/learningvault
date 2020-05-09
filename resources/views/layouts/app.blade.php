<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title', config('app.name', 'Learning Vault'))</title>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>

	<!-- Bootstrap core CSS -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

	<!-- Custom styles for this template -->
	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
  </head>

	<body>
		<div class="container">
			<header class="blog-header">
				<div class="row py-3">
					<div class="d-none d-md-block col-md-3 pt-2">
						<a class="text-muted" href="#">Subscribe</a>
					</div>
					<div class="col-sm-12 col-md-6 text-center text-center">
						<a class="blog-header-logo text-dark" href="/">{{ config('app.name', 'Learning Vault') }}</a>
					</div>
					<div class="col-sm-12 col-md-3 d-flex justify-content-center ml-auto mt-3 mt-md-0">
						<a class="text-muted d-none d-md-block" href="#">
						<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
						</a>
						{{-- <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a> --}}
						<!-- Authentication Links -->
						@guest
						<a class="btn btn-outline-secondary mr-1" href="{{ route('login') }}">{{ __('Login') }}</a>
						<a class="btn btn-outline-secondary" href="{{ route('register') }}">{{ __('Register') }}</a>
						@else
						<div class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('profile.user.show', ['user' => Auth::user()]) }}">
									My Account
								</a>
								<a class="dropdown-item" href="{{ route('profile.lesson.index') }}">
									Lessons
								</a>
								@can('level.index')
									<a class="dropdown-item" href="{{ route('profile.level.index') }}">
										Levels
									</a>
								@endcan
								@can('subject.index')
									<a class="dropdown-item" href="{{ route('profile.subject.index') }}">
										Subjects
									</a>
								@endcan
								@can('user.index')
									<a class="dropdown-item" href="{{ route('profile.user.index') }}">
										Users
									</a>
								@endcan


								<a class="dropdown-item" href="{{ route('logout') }}"
								   onclick="event.preventDefault();
												 document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</div>
						</div>
						@endguest
					</div>
				</div>
			</header>

			<div class="py-1 mb-2">
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
						<ul class="navbar-nav">
							@foreach($subjects as $subject)
								<li class="nav-item">
									<a class="nav-link {{ Request::is('subject') ? 'active' : '' }}" href="{{ route('lesson.index', compact('subject')) }}">{{ $subject->name }} <span class="sr-only">(current)</span></a>
								</li>
							@endforeach
						</ul>
					</div>
				</nav>
			</div>

			@yield('jumbotron')
		</div>

		<main role="main" class="container mt-2 mb-5">
			@yield('content')
		</main><!-- /.container -->

		<footer class="container blog-footer text-center">
			<p>Opensource Learning. Designed & Managed by <a href="https://www.prometheuscomputing.co.uk/">Prometheus Computing Ltd</a></p>
			<p>
			<a href="#">Back to top</a>
			</p>
		</footer>
	</body>
</html>
