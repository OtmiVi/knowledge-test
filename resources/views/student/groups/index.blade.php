@extends('student.layouts.app')

@section('content')
<a href="{{route('student')}}" class="btn btn-secondary btn-sm">На головну</a>

<p  class="text-center fs-1">Група: {{$item->name}}</p>
<hr>
<table class="table table-striped table-hover" >
    <thead >
        <tr class="table-dark">
            <th>№</th>
            <th>Студент</th>
            <th>email</th>
        </tr>
    </thead>
    <tbody>
    @php
        $number = 1
    @endphp

    @foreach($item->users->sortBy('name') as $user)
        <tr>
            <td>{{$number ++}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection