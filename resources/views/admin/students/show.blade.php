@extends('admin.layouts.app')

@section('content')
<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="{{route('admin.students.index') }}" class="btn btn-secondary btn-sm">Список студентів</a>

@include('layouts.error')
@include('layouts.success')
<p  class="text-center fs-1">Студент: {{$item->name}}</p>
<hr>
@if(!isset($item->group[0]))
    <div class="mb-3">
        <p class="d-inline">Без групи</p>
        <a class="btn btn-success d-inline" href="{{route('admin.students.addGroup', $item->id)}}">Додати групу</a>
    </div>
@else
    <p>Група: <a class="text-decoration-none" href="{{route('admin.groups.show', $item->group[0]->id)}}">{{$item->group[0]->name}}</a></p>
@endif
<p>Email: {{$item->email}}</p>
<hr>
@if(isset($item->group[0]))
<ul class="list-group">
    <li class="list-group-item list-group-item-success">
        <p class="fs-5 mb-0">Дисципліни які вивчаються:</p> 
    </li>
    @forelse($item->group[0]->disciplines as $discipline)
    <li class="list-group-item">
        <a class="text-decoration-none" href="{{route('admin.disciplines.show', $discipline->id)}}">{{$discipline->name}}</a>
    </li>
    @empty
    <li class="list-group-item list-group-item-secondary">
        Дисципліни не вибрано
    </li>
    @endforelse
</ul>
<hr>
@endif
<a class="btn btn-outline-warning" href="{{route('admin.students.edit', $item->id)}}">Редагувати</a>
<form action="{{route('admin.students.destroy', $item->id)}}" 
    method="post" 
    class="d-inline"
    onSubmit="return confirm('Підтвердити видалення');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-outline-danger">
        Видалити профіль
    </button>
</form>
@endsection