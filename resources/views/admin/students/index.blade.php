@extends('admin.layouts.app')

@section('content')


<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>

<p class="text-center fs-1">Студенти</p>
@include('layouts.error')
@include('layouts.success')

<form action="{{route('admin.students.search')}}" method="get">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Пошук студента" name="name">
        <button type="submit" class="btn btn-outline-primary">знайти</button>
    </div>
</form>
<br>
@if(count($items))
<table class="table table-striped table-hover" >
    <thead >
        <tr class="table-dark">
            <th>Студент</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach($items as $item )
        <tr>
            
            <td>{{$item->name}}</td>
            <td>
                <a class="btn btn-outline-info" href="{{route('admin.students.show', $item->id)}}">Переглянути профіль</a>
            </td>
            <td>
                <a class="btn btn-outline-warning" href="{{route('admin.students.edit', $item->id)}}">Оновити</a>
                <form action="{{route('admin.students.destroy', $item->id)}}" 
                    method="post" 
                    class="d-inline"
                    onSubmit="return confirm('Підтвердити видалення');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        Видалити профіль
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
    Студентів немає
</div>
@endif

@endsection