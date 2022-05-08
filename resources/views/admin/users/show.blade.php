@extends('admin.layouts.app')

@section('content')

<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="{{route('admin.users.index')}}" class="btn btn-secondary btn-sm">Список користувачів</a>

@include('layouts.error')
@include('layouts.success')
<p  class="text-center fs-1">Користувач: {{$item->name}}</p>
<hr>
<p>Email: {{$item->email}}</p>
<p>Тип: {{$item->user_type ?? "Немає"}}</p>
<hr>

@if($item->user_type != 'admin' && $item->user_type != null)
<a class="btn btn-outline-info mb-3" 
    href="{{route('admin.'.$item->user_type.'s.show', $item->id)}}">
    Перегоянути сторінку
</a>
@endif
<br>
<a class="btn btn-outline-warning" href="{{route('admin.users.edit', $item->id)}}">Редагувати</a>
<form action="{{route('admin.users.destroy', $item->id)}}" 
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