<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
<div class="offcanvas-header">
	<h5 class="offcanvas-title" id="offcanvasNavbarLabel">Меню адміністратора</h5>
	<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body">
	<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
	<li class="nav-item">
		<a class="nav-link active" aria-current="page" href="{{route('admin')}}">Головна</a>
	</li>
	<hr>
	<li class="nav-item">
		<a class="nav-link" href="{{route('admin.groups.index')}}">Групи</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="{{route('admin.students.index')}}">Студенти</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="{{route('admin.teachers.index')}}">Викладачі</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="{{route('admin.disciplines.index')}}">Дисципліни</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="{{route('admin.users.index')}}">Користувачі</a>
	</li>
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
	</ul>
	</div>
</div>
</div>