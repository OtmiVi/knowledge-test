@extends('student.layouts.app')

@section('content')
<div class="container">
    <a href="{{route('student')}}" class="btn btn-secondary btn-sm">На головну</a>
    <a href="{{route('student.disciplines.show', $item->discipline_id)}}" class="btn btn-secondary btn-sm">Дисципліна</a>
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $item->title }}</div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <p>Ви ще не проходили даний тест</p>
                            <p>Тест складається з {{$item->questions->count()}} питань</p>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a href="{{route('student.tests.show', $item->id)}}" class="btn btn-primary">
                                    розпочати тест
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
