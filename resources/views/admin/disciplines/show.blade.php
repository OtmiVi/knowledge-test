@extends('admin.layouts.app')

@section('content')
<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="{{route('admin.disciplines.index')}}" class="btn btn-secondary btn-sm">Список дисциплін</a>
@include('layouts.error')
@include('layouts.success')

<p  class="text-center fs-1">Дисципліна: {{$item->name}}</p>
<p>{{$item->description}}</p>
<hr>

<ul class="list-group mb-3">
    <li class="list-group-item list-group-item-success">
        <p class="fs-5 mb-0">Викладачі які викладають:</p> 
    </li>
    @forelse($item->users->sortBy('name') as $user)
    <li class="list-group-item d-flex justify-content-between">
        <a class="text-decoration-none" href="{{route('admin.teachers.show', $user->id)}}">{{$user->name}}</a>
        <form action="{{route('admin.teachers.destroyDiscipline',[$user->id, $item->id])}}" 
            method="post" 
            class="d-inline"
            onSubmit="return confirm('Підтвердити видалення');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">
                X
            </button>
        </form>
    </li>
    @empty
    <li class="list-group-item list-group-item-secondary">
        Викладачів не вибрано
    </li>
    @endforelse
</ul>

<ul class="list-group mb-3">
    <li class="list-group-item list-group-item-success d-flex justify-content-between">
        <p class="fs-5 mb-0">Групи в яких викладається дисципліна:</p> 
        <a class="btn btn-outline-dark" href="{{route('admin.disciplinesgroups.show', $item->id)}}"> редагувати групи</a>
    </li>
    @forelse($item->groups->sortBy('name') as $group)
    <li class="list-group-item d-flex justify-content-between">
        <a class="text-decoration-none" href="{{route('admin.groups.show', $group->id)}}">{{$group->name}}</a>
        <form action="{{route('admin.disciplinesgroups.destroy',[$item->id, $group->id])}}" 
            method="post" 
            class="d-inline"
            onSubmit="return confirm('Підтвердити видалення');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">
                X
            </button>
        </form>
    </li>
    @empty
    <li class="list-group-item list-group-item-secondary">
        Групи не вибрано
    </li>
    @endforelse
</ul>


<ul class="list-group">
    <li class="list-group-item list-group-item-success d-flex justify-content-between">
        <p class="fs-5 mb-0">Тести:</p> 
        <a class="btn btn-outline-dark" href="{{route('admin.tests.create', $item->id)}}"> додати тест</a>
    </li>
    @forelse($item->tests as $test)
    <li class="list-group-item d-flex justify-content-between">
        <a class="text-decoration-none" href="{{route('admin.tests.show', $test->id)}}">{{$test->title}}</a>
        <div>
            <a href="{{route('admin.tests.edit',$test->id)}}" class="btn btn-outline-warning">O</a>
            <form action="{{route('admin.tests.destroy',$test->id)}}" 
                method="post" 
                class="d-inline"
                onSubmit="return confirm('Підтвердити видалення');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">
                    X
                </button>
            </form>
        </div>
    </li>
    @empty
    <li class="list-group-item list-group-item-secondary">
        Дисципліни не вибрано
    </li>
    @endforelse
</ul>
<hr>
<a class="btn btn-outline-warning" href="{{route('admin.disciplines.edit', $item->id)}}">Оновити</a>
<form action="{{route('admin.disciplines.destroy', $item->id)}}" 
    method="post" 
    class="d-inline" 
    onSubmit="return confirm('Підтвердити видалення');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-outline-danger">
        Видалити
    </button>
</form>

@endsection