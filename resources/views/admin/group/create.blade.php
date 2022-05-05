@extends('admin.layouts.app')

@section('content')
<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="{{route('admin.groups.index')}}" class="btn btn-secondary btn-sm">Список груп</a>
@include('layouts.error')

<form action="{{route('admin.groups.store')}}" method="POST">
@csrf
    <div class="mb-3">
        <label for="groupName" class="form-label fs-3">Назва групи</label>
        <input type="text" 
            class="form-control" 
            id="groupName" 
            name="name" 
            aria-describedby="hint"
            value="{{old('name')}}">
        <div id="hint" class="form-text">Введіть назву нової групи</div>
    </div>
    <button type="submit" class="btn btn-primary">Додати</button>
</form>

@endsection