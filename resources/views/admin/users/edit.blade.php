@extends('admin.layouts.app')

@section('content')
<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="{{route('admin.users.index')}}" class="btn btn-secondary btn-sm">Список користувачів</a>
<a href="{{route('admin.users.show', $item->id)}}" class="btn btn-secondary btn-sm">Профіль користувача</a>
@include('layouts.error')
@include('layouts.success')

<form action="{{route('admin.users.update', $item->id)}}" method="POST">
@method('PATCH')
@csrf
    <div class="mb-3">
        <label for="userName" class="form-label fs-3">Редагувати користувача користувача</label>
        <div id="hint" class="form-text">Введіть ім'я користувача</div>
        <input type="text" 
            class="form-control" 
            id="userName" 
            name="name" 
            required
            aria-describedby="hint"
            value="{{$item->name}}">
        <div id="hintEmail" class="form-text">Введіть e-mail</div>
        <input type="email" 
            class="form-control" 
            id="userEmail" 
            name="email" 
            required
            aria-describedby="hintEmail"
            value="{{$item->email}}">
        <div id="user_type" class="form-text">Виберіть тип користувача</div>
        <select name="user_type" id="user_type" class="form-select">
            <option value="" 
            @if($item->user_type == null) 
                selected
            @endif
            >
                Без типу
            </option>
            <option value="admin" 
            @if($item->user_type == 'admin') 
                selected
            @endif
            >
                Адмін
            </option>
            <option value="teacher" 
            @if($item->user_type == 'teacher') 
                selected
            @endif>
                Викладач
            </option>
            <option value="student" 
            @if($item->user_type == 'student') 
                selected
            @endif>
                Студент
            </option>
        </select>
       
    </div>
    <button type="submit" class="btn btn-warning" onclick="return validateForm()">Оновити</button>
</form>

<script src="{{ asset('js/userValid.js')}}"></script>
@endsection