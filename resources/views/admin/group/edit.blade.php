@extends('admin.layouts.header')

@section('content')
<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="{{route('admin.groups.index')}}" class="btn btn-secondary btn-sm">Список груп</a>
<a href="{{route('admin.groups.show', $item->id)}}" class="btn btn-secondary btn-sm">Група</a>
@include('layouts.error')

<form action="{{route('admin.groups.update', $item->id)}}" method="POST">
@method('PATCH')
@csrf
    <div class="mb-3">
        <label for="groupName" class="form-label fs-3">Назва групи</label>
        <input type="text" 
            class="form-control" 
            id="groupName" 
            name="name" 
            aria-describedby="hint" 
            value="{{$item->name}}">
        <div id="hint" class="form-text">Введіть нову назву групи</div>
    </div>
    <button type="submit" class="btn btn-warning">Оновити</button>
</form>

@endsection