@extends('admin.layouts.app')

@section('content')


<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>

<p class="text-center fs-1">Користувачі
    <a class="btn btn-outline-success" href="{{route('admin.users.create')}}">Новий користувач</a>
</p>
@include('layouts.error')
@include('layouts.success')

<form action="{{route('admin.users.search')}}" method="get">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Пошук користувача" name="name">
        <select class="form-select" name="user_type">
            <option value="all" selected>Всі</option>
            <option value="teacher">Викладачі</option>
            <option value="student">Студенти</option>
            <option value="admin">Адміністратори</option>
            <option value="">Пусті</option>
        </select>
        <button type="submit" class="btn btn-outline-primary">знайти</button>
    </div>
</form>
<br>
@if($items->count())
<table class="table table-striped table-hover" >
    <thead >
        <tr class="table-dark">
            <th>Користувач</th>
            <th>Тип</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach($items as $item )
        <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->user_type ?? "none"}}</td>
            <td>
                <a class="btn btn-outline-info" href="{{route('admin.users.show', $item->id)}}">Переглянути профіль</a>
            </td>
            <td>
                <a class="btn btn-outline-warning" href="{{route('admin.users.edit', $item->id)}}">Редагувати</a>
                <form action="{{route('admin.users.destroy', $item->id)}}" 
                    method="post" 
                    class="d-inline"
                    onSubmit="return confirm('Підтвердити видалення');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        Видалити аккаунт
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $items->withQueryString()->links() }}
@else
<div class="alert alert-dark" role="alert">
    Користувачів немає
</div>
@endif
@endsection