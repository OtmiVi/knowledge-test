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
        Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin');

        Route::resource('groups', AdminGroupController::class)->names('admin.groups');

        $studentMetods = ['index', 'edit', 'store', 'show', 'update', 'destroy'];
        Route::resource('students', AdminStudentController::class)->names('admin.students')
            ->only($studentMetods);
        Route::get('/students/create/{student}',[App\Http\Controllers\Admin\AdminStudentController::class, 'create'])
            ->name('admin.students.create');

        $teacherMetods = ['index', 'edit', 'store', 'show', 'update', 'destroy'];
        Route::resource('teachers', AdminTeacherController::class)->names('admin.teachers')->only($teacherMetods);
        Route::get('/teachers/create/{teacher}',[App\Http\Controllers\Admin\AdminTeacherController::class, 'create'])
            ->name('admin.teachers.create');
        Route::delete('/teachers/destroy_discipline/{techer}/{discipline}',
            [App\Http\Controllers\Admin\AdminTeacherController::class, 'destroyDiscipline'])
            ->name('admin.teachers.destroy_discipline');

        Route::resource('disciplines', AdminDisciplineController::class)->names('admin.disciplines');

        $disciplinesGroupsMetods = ['store', 'show'];
        Route::resource('disciplinesgroups', AdminDisciplineGroupController::class)
            ->names('admin.disciplinesgroups')
            ->only($disciplinesGroupsMetods);
        Route::delete('/disciplinesgroups/destroy/{discipline}/{group}',
            [App\Http\Controllers\Admin\AdminDisciplineGroupController::class, 'destroy'])
            ->name('admin.disciplinesgroups.destroy');

        Route::resource('test', AdminTestController::class)->names('admin.tests');
        Route::get('/test/create/{discipline}',[App\Http\Controllers\Admin\AdminTestController::class, 'create'])
            ->name('admin.tests.create');
        Route::post('/test/update_test/{test}',[App\Http\Controllers\Admin\AdminTestController::class, 'updateTest'])
            ->name('admin.tests.update_test');
        Route::post('/test/destroy_question/{question}',
            [App\Http\Controllers\Admin\AdminTestController::class, 'destroy_question'])
            ->name('admin.tests.destroy_question');
        Route::post('/test/destroy_answer/{answer}',
            [App\Http\Controllers\Admin\AdminTestController::class, 'destroy_answer'])
            ->name('admin.tests.destroy_answer');
    });

});
