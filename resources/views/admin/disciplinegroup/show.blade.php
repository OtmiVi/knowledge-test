@extends('admin.layouts.app')

@section('content')
<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="{{route('admin.disciplines.index')}}" class="btn btn-secondary btn-sm">Список дисциплін</a>
<a href="{{route('admin.disciplines.show', $item->id)}}" class="btn btn-secondary btn-sm">Дисципліна</a>
@include('layouts.error')
@include('layouts.success')

<p class="text-center fs-1">Дисципліна: {{$item->name}}</p>
<form action="{{route('admin.disciplinesgroups.store')}}" method="POST">
@csrf
    <input type="hidden" name="discipline_id" value="{{$item->id}}">
    <div class="mb-3">
        <label for="groupName" class="form-label fs-3">Виберіть групу для дисципліни</label>
        <select class="form-select" aria-describedby="hintgroup" name="group_id">
            @foreach($groups as $group)
                <option value="{{$group->id}}">{{$group->name}}</option>
            @endforeach
        </select>
        <div id="hintgroup" class="form-text">Група</div>
    </div>
    <button type="submit" class="btn btn-success">Додати нову групу</button>
</form>
<hr>
<ul class="list-group">
    <li class="list-group-item list-group-item-success">
        <p class="fs-5 mb-0">Групи в яких викладається дисципліна:</p> 
    </li>
    @foreach($item->groups as $group)
    <li class="list-group-item d-flex justify-content-between">
        <a class="text-decoration-none" href="{{route('admin.groups.show', $group->id)}}">{{$group->name}}</a>
        <form action="{{route('admin.disciplinesgroups.destroy',[$item->id, $group->id])}}" 
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


@endsection