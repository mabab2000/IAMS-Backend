<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use App\Models\User;

Route::get('/assign-role', function () {
    $user = User::find(1);
    $role = Role::findByName('admin');
    $user->assignRole($role);
    return 'Role assigned';
});

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
Route::get('/add', function () {
    return view('posts/add');
});
Route::get('/posts', 'PostsController@index')->name('posts.index');
Route::get('/posts/details/{id}', 'PostsController@details')->name('posts.details');
Route::get('/posts/add', 'PostsController@add')->name('posts.add');
Route::post('/posts/insert', 'PostsController@insert')->name('posts.insert');
Route::get('/posts/edit/{id}', 'PostsController@edit')->name('posts.edit');
Route::post('/posts/update/{id}', 'PostsController@update')->name('posts.update');
Route::get('/posts/delete/{id}', 'PostsController@delete')->name('posts.delete');