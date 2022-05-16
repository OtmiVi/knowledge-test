<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
<div class="offcanvas-header">
	<h5 class="offcanvas-title" id="offcanvasNavbarLabel">Меню студента</h5>
	<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body">
	<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
	<li class="nav-item">
		<a class="nav-link active" aria-current="page" href="{{route('student')}}">Головна</a>
	</li>
	<li class="nav-item">
		<a class="nav-link active" aria-current="page" href="{{route('student')}}">Група</a>
	</li>
	<hr>
	@forelse(Auth::user()->group[0]->disciplines as $discipline)
	<li class="nav-item">
		<a class="nav-link" href="{{route('student.disciplines.show', $discipline->id)}}">{{$discipline->name}}</a>
	</li>
	@empty
	<li class="nav-item">
		<p class="nav-link">На жаль у вас немає навчальни дисциплін</p>
	</li>
	@endforelse
	<div class="dropdown">
	<p class="dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
		{{Auth::user()->name}}
	</p>
	<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		<li>
		<a class="dropdown-item" href="{{ route('logout') }}"
			onclick="event.preventDefault();
				document.getElementById('logout-form').submit();">
			{{ __('Вийти') }}
		</a>

		<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
			@csrf
		</form>
		</li>
		<li><a class="dropdown-item" href="#">Another action</a></li>
		<li><a class="dropdown-item" href="#">Something else here</a></li>
	</ul>
	</div>
</div>
</div>