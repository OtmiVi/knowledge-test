@extends('admin.layouts.app')

@section('content')
<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="{{route('admin.teachers.index')}}" class="btn btn-secondary btn-sm">Список викладачів</a>
<a href="{{route('admin.teachers.show', $item->id)}}" class="btn btn-secondary btn-sm">Профіль</a>
@include('layouts.error')
@include('layouts.success')

<p class="text-center fs-1">Викладач: {{$item->name}}</p>

@if(!empty($disciplines))
<form action="{{route('admin.teachers.store')}}" method="POST">
@csrf
    <input type="hidden" name="user_id" value="{{$item->id}}">
    <div class="mb-3">
        <label for="teacherName" class="form-label fs-3">Виберіть дисципліну для викладача</label>
        <select class="form-select" aria-describedby="hintDiscipline" name="discipline_id">
            @foreach($disciplines as $discipline)
                @if(!$item->disciplines->contains($discipline))
                <option value="{{$discipline->id}}">{{$discipline->name}}</option>
                @endif
            @endforeach
        </select>
        <div id="hintDiscipline" class="form-text">Дисципліна</div>
    </div>
    <button type="submit" class="btn btn-success">Додати нову дисципліну</button>
</form>
@else
    <p>
        На жаль жодної дисципліни не створено
    </p>
    <a href="{{route('admin.disciplines.create')}}" class="btn btn-success">
        Створити дисципліну
    </a>
@endif
<hr>
<ul class="list-group">
    <li class="list-group-item list-group-item-success">
        <p class="fs-5 mb-0">Дисципліни які викладаються:</p> 
    </li>
    @forelse($item->disciplines as $discipline)
    <li class="list-group-item d-flex justify-content-between">
        <a href="{{route('admin.disciplines.show', $discipline->id)}}">{{$discipline->name}}</a>
        <form action="{{route('admin.teachers.destroyDiscipline',[$item->id,$discipline->id])}}" 
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
    @empty
    <li class="list-group-item list-group-item-secondary">
        Цей викладач немає дисциплін
    </li>
    @endforelse
</ul>
@endsection