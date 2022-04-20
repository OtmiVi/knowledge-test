@extends('admin.layouts.header')

@section('content')

<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="{{route('admin.teachers.index')}}" class="btn btn-secondary btn-sm">Список викладачів</a>

@include('layouts.error')
@include('layouts.success')
<p  class="text-center fs-1">Викладач: {{$item->name}}</p>
<hr>

<p>Email: {{$item->email}}</p>
<p>Посада: {{$item->teacherDescription->position}}</p>
<p>{{$item->teacherDescription->description}}</p>
<ul class="list-group">
    <li class="list-group-item list-group-item-success d-flex justify-content-between">
        <p class="fs-5 mb-0">Дисципліни які викладаються:</p> 
        <a class="btn btn-outline-dark" href="{{route('admin.teachers.create', $item->id)}}"> редагувати дисципліни</a>
    </li>
    @foreach($item->disciplines as $discipline)
    <li class="list-group-item d-flex justify-content-between">
        <a href="{{route('admin.disciplines.show', $discipline->id)}}">{{$discipline->name}}</a>
        <form action="{{route('admin.teachers.destroy_discipline',[$item->id,$discipline->id])}}" 
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
    @endforeach
</ul>
<hr>
<a class="btn btn-outline-warning" href="{{route('admin.teachers.edit', $item->id)}}">Редагувати</a>
<form action="{{route('admin.teachers.destroy', $item->id)}}" 
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