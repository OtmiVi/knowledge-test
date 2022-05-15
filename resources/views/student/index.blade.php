@extends('student.layouts.app')

@section('content')
@include('layouts.error')
<div class="container">
    <p  class="text-center fs-1">Дисципліни які вивчаються в групі</p>
    <hr>
    @if($item->group[0]->disciplines->count())
        @foreach($item->group[0]->disciplines as $discipline)
            <div class="alert alert-primary">
                <a class='text-decoration-none' href="{{route('student.disciplines.show', $discipline->id)}}">
                    <p class="alert-heading fs-4">{{$discipline->name}}</p>
                </a>
                <hr>
                <p class="mb-0">{{$discipline->description}}</p>
            </div>
        @endforeach
    @else
        <div class="alert alert-warning">
            <p class="alert-heading fs-4">На жаль ви не маєте доступу до дисциплін</p>
            <hr>
            <p class="mb-0">Звернітся до адміністратора за допомогою</p>
        </div>  
    @endif
</div>
@endsection         