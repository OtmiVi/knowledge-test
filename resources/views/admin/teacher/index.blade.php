@extends('admin.layouts.app')

@section('content')


<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<p class="text-center fs-1">Викладачі</p>

@include('layouts.error')
@include('layouts.success')

<table class="table table-striped table-hover" >
    <thead >
        <tr class="table-dark">
            <th>Викладач</th>
            <th>Посада</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach($items as $item )
        <tr>
            
            <td>{{$item->name}}</td>
            <td>{{$item->teacherDescription->position}}</td>
            <td>
                <a class="btn btn-outline-info" href="{{route('admin.teachers.show', $item->id)}}">Переглянути профіль</a>
            </td>
            <td>
                <a class="btn btn-outline-warning" href="{{route('admin.teachers.edit', $item->id)}}">Оновити</a>
                <form action="{{route('admin.teachers.destroy', $item->id)}}" 
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

{{ $items->links() }}
@endsection