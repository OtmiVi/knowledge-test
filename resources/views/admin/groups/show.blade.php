@extends('admin.layouts.app')

@section('content')
<a href="{{route('admin')}}" class="btn btn-secondary btn-sm">На головну</a>
<a href="{{route('admin.groups.index')}}" class="btn btn-secondary btn-sm">Список груп</a>

<p  class="text-center fs-1">Група: {{$item->name}}</p>

@include('layouts.error')
@include('layouts.success')

@if($item->users->count())
<table class="table table-striped table-hover" >
    <thead >
        <tr class="table-dark">
            <th>№</th>
            <th>Студент</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @php
        $number = 1
    @endphp

    @foreach($item->users->sortBy('name') as $user)
        <tr>
            <td>{{$number ++}}</td>
            <td><a class="text-decoration-none" href="{{route('admin.students.show', $user->id)}}">{{$user->name}}</a></td>
            <td>
                <form action="{{route('admin.students.destroy', $user->id)}}" 
                    method="post" 
                    class="d-inline"
                    onSubmit="return confirm('Підтвердити видалення');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        X
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@else
<div class="alert alert-dark" role="alert">
    Студентів немає
</div>
@endif
@endsection