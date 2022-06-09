@extends('admin.layouts.app')

@section('content')
<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="{{route('admin.disciplines.index')}}" class="btn btn-secondary btn-sm">Список дисциплін</a>
<a href="{{route('admin.disciplines.show', $item->id)}}" class="btn btn-secondary btn-sm">Дисципліна</a>
@include('layouts.error')

<form action="{{route('admin.disciplines.update', $item->id)}}" method="POST">
@method('PATCH')
@csrf
    <div class="mb-3">
        <label for="disciplineName" class="form-label fs-3">Редагування дисципліни</label>
        <div id="hint" class="form-text">Введіть нову назву дисципліни</div>
        <input type="text" 
            required
            class="form-control" 
            id="disciplineName" 
            name="name" 
            aria-describedby="hint" 
            value="{{$item->name}}">
        <div id="hintDescription" class="form-text">Введіть новий опис дисципліни</div>
        <textarea
            required
            class="form-control" 
            id="disciplineDescription" 
            name="description" 
            aria-describedby="hintName"
            rows="3">{{$item->description}}
        </textarea>
    </div>
    <button type="submit" class="btn btn-warning">Оновити</button>
</form>

@endsection