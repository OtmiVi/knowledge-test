@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <a href="{{route('admin.groups.index')}} " class="col text-decoration-none">
            <div class="alert alert-primary">
                <h4 class="alert-heading">Групи</h4>
                <hr>
                <p class="mb-0">Перегляд та редагуваня груп та їхніх зв'язків.</p>
            </div>
        </a>
        <a href="{{route('admin.students.index')}} " class="col text-decoration-none">
            <div class="alert alert-success">
                <h4 class="alert-heading">Студенти</h4>
                <hr>
                <p class="mb-0">Список всіх студентів, редагування та перегляд інформації про них.</p>
            </div>
        </a>
    </div>
    <div class="row">
        <a href="{{route('admin.teachers.index')}} " class="col text-decoration-none">
            <div class="alert alert-secondary">
                <h4 class="alert-heading">Викладачі</h4>
                <hr>
                <p class="mb-0">Інформація про викладачів та їхні дисципліни.</p>
            </div>
        </a>
        <a href="{{route('admin.disciplines.index')}} " class="col text-decoration-none">
            <div class="alert alert-warning">
                <h4 class="alert-heading">Дисципліни</h4>
                <hr>
                <p class="mb-0">Навчальні дисципліни. Їхнє редагування та перегляд.</p>
            </div>
        </a>
    </div>
</div>
@endsection 