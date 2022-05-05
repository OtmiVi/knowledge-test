@extends('admin.layouts.app')

@section('content')
<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="{{route('admin.disciplines.index')}}" class="btn btn-secondary btn-sm">Список дисциплін</a>

@include('layouts.error')
<form action="{{route('admin.disciplines.store')}}" method="POST">
@csrf
    <div class="mb-3">
        <label for="disciplineName" class="form-label fs-3">Нова дисципліна</label>
        <input type="text" 
            class="form-control" 
            id="disciplineName" 
            name="name" 
            aria-describedby="hint"
            value="{{old('name')}}">
        <div id="hint" class="form-text">Введіть назву дисципліни</div>
        <textarea
            class="form-control" 
            id="disciplineDescription" 
            name="description" 
            aria-describedby="hintName"
            rows="3">{{old('name')}}
        </textarea>
        <div id="hintDescription" class="form-text">Введіть опис дисципліни</div>
    </div>
    <button type="submit" class="btn btn-primary">Додати</button>
</form>

@endsection