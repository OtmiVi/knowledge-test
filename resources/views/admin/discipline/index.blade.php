@extends('admin.layouts.header')

@section('content')
<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<p class="text-center fs-1">Перегляд дисциплін 
    <a class="btn btn-outline-success" href="{{route('admin.disciplines.create')}}">Нова дисципліна</a>
</p>

@include('layouts.error')
@include('layouts.success')

<table class="table table-striped table-hover" >
    <thead >
        <tr class="table-dark">
            <th>Назва дисципліни</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach($items as $item )
        <tr>
            <td>{{$item->name}}</td>
            <td>
                <a class="btn btn-outline-info" href="{{route('admin.disciplines.show', $item->id)}}">Переглянути</a>
            </td>
            <td>
                <a class="btn btn-outline-warning" href="{{route('admin.disciplines.edit', $item->id)}}">Оновити</a>
                <form action="{{route('admin.disciplines.destroy', $item->id)}}" 
                    method="post" 
                    class="d-inline" 
                    onSubmit="return confirm('Підтвердити видалення');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        Видалити
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $items->links() }}
@endsection