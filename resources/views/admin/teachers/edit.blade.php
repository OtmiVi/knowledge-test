@extends('admin.layouts.app')

@section('content')
<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="{{route('admin.teachers.index')}}" class="btn btn-secondary btn-sm">Список викладачів</a>
<a href="{{route('admin.teachers.show', $item->id)}}" class="btn btn-secondary btn-sm">Профіль</a>
@include('layouts.error')

<form action="{{route('admin.teachers.update', $item->id)}}" method="POST">
@method('PATCH')
@csrf
    <div class="mb-3">
        <label for="teacherName" class="form-label fs-3">Редагування профілю</label>
        <input type="text" 
            required
            class="form-control" 
            id="teacherName" 
            name="name" 
            aria-describedby="hintName" 
            value="{{$item->name}}">
        <div id="hintName" class="form-text">Введіть нове ім'я викладача</div>
        <input type="email" 
            required
            class="form-control" 
            id="teacherEmail" 
            name="email" 
            aria-describedby="hintEmail" 
            value="{{$item->email}}">
        <div id="hintEmail" class="form-text">Введіть новий email викладача</div>
        <input type="text" 
            required
            class="form-control" 
            id="teacherPosition" 
            name="position" 
            aria-describedby="hintName" 
            value="{{$item->teacherDescription->position}}">
        <div id="hintPosition" class="form-text">Введіть нову посаду викладача</div>
        <textarea
            required
            class="form-control" 
            id="teacherDescription" 
            name="description" 
            aria-describedby="hintName"
            rows="3">{{$item->teacherDescription->description}}
        </textarea>
        <div id="hintDescription" class="form-text">Введіть новий опис викладача</div>
    </div>
    <button type="submit" class="btn btn-warning">Оновити</button>
</form>

@endsection