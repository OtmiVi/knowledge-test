<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->
    group(function(){
    
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index']);

    Route::prefix('admin')->
    namespace('App\Http\Controllers\Admin')->
    middleware('role:admin')->
    group( function(){

        #AdminController
        Route::get('/', 'AdminController@index')->name('admin');

        #GroupController
        Route::resource('groups', AdminGroupController::class)->names('admin.groups');

        #UserController
        Route::get('/users/search','AdminUserController@search')
            ->name('admin.users.search');
        Route::resource('users', AdminUserController::class)->names('admin.users');

        #StudentController
        Route::get('/students/search','AdminStudentController@search')
            ->name('admin.students.search');
        $studentMetods = ['index', 'edit', 'store', 'show', 'update', 'destroy'];
        Route::resource('students', AdminStudentController::class)->names('admin.students')
            ->only($studentMetods);
        Route::get('/students/addGroup/{student}','AdminStudentController@addGroup')
            ->name('admin.students.addGroup');
        

        #TeacherController
        Route::get('/teachers/search','AdminTeacherController@search')
            ->name('admin.teachers.search');
        $teacherMetods = ['index', 'edit', 'store', 'show', 'update', 'destroy'];
        Route::resource('teachers', AdminTeacherController::class)
            ->names('admin.teachers')
            ->only($teacherMetods);
        Route::get('/teachers/add_discipline/{teacher}','AdminTeacherController@addDiscipline')
            ->name('admin.teachers.addDiscipline');
        Route::delete('/teachers/destroy_discipline/{techer}/{discipline}','AdminTeacherController@destroyDiscipline')
            ->name('admin.teachers.destroyDiscipline');
        #DisciplineController
        Route::resource('disciplines', AdminDisciplineController::class)->names('admin.disciplines');

        #DisciplineGroupController
        $disciplinesGroupsMetods = ['store', 'show'];
        Route::resource('disciplinesgroups', AdminDisciplineGroupController::class)
            ->names('admin.disciplinesgroups')
            ->only($disciplinesGroupsMetods);
        Route::delete('/disciplinesgroups/destroy/{discipline}/{group}','AdminDisciplineGroupController@destroy')
            ->name('admin.disciplinesgroups.destroy');

        #TestController
        Route::resource('test', AdminTestController::class)->names('admin.tests');
        Route::get('/test/create/{discipline}','AdminTestController@create')
            ->name('admin.tests.create');
        Route::post('/test/update_test/{test}','AdminTestController@updateTest')
            ->name('admin.tests.update_test');
        Route::post('/test/destroy_question/{question}','AdminTestController@destroyQuestion')
            ->name('admin.tests.destroy_question');
        Route::post('/test/destroy_answer/{answer}','AdminTestController@destroyAnswer')
            ->name('admin.tests.destroy_answer');
        Route::get('test/visible/{test}', 'AdminTestController@changeVisible')
            ->name('admin.tests.visible');
    });
    Route::prefix('teacher')->
    namespace('App\Http\Controllers\Teacher')->
    middleware('role:teacher')->
    group( function(){
        #AdminController
        Route::get('/', 'TeacherController@index')->name('teacher');

        Route::get('/discipline/{discipline}', 'TeacherDisciplineController@show')
            ->name('teacher.disciplines.show');

        Route::resource('test', TeacherTestController::class)->names('teacher.tests');
        Route::get('/test/create/{discipline}','TeacherTestController@create')
            ->name('teacher.tests.create');
        Route::post('/test/update_test/{test}','TeacherTestController@updateTest')
            ->name('teacher.tests.update_test');
        Route::post('/test/destroy_question/{question}','TeacherTestController@destroyQuestion')
            ->name('teacher.tests.destroy_question');
        Route::post('/test/destroy_answer/{answer}','TeacherTestController@destroyAnswer')
            ->name('teacher.tests.destroy_answer');
        Route::get('test/visible/{test}', 'TeacherTestController@changeVisible')
            ->name('teacher.tests.visible');
    });

    Route::prefix('student')->
    namespace('App\Http\Controllers\Student')->
    middleware('role:student')->
    group( function(){
        #AdminController
        Route::get('/', 'StudentController@index')->name('student');

        Route::get('/discipline/{discipline}', 'StudentDisciplineController@show')
            ->name('student.disciplines.show');

        Route::get('/group', 'StudentGroupController@index')
            ->name('student.groups.index');

        Route::get('/test/open/{test}', 'StudentTestController@open')
            ->name('student.tests.open');
        Route::get('/test/show/{test}', 'StudentTestController@show')
            ->name('student.tests.show');
        Route::post('/test/calculate_score', 'StudentTestController@calculateScore')
            ->name('student.tests.calculateScore');
    });

});
