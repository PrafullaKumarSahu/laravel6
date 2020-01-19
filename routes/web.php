<?php
use Symfony\Component\Routing\Loader\DependencyInjection\ServiceRouterLoader;

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

Route::get('test', function () {
    echo 'test';
});

Route::get('about', function () {
    $posts = \App\Models\Post::latest()->paginate(10);
    return view('about', compact('posts'));
});
Route::get('posts', 'web\PostController@index')->name('posts.index');
Route::get('posts/{post}', 'web\PostController@show')->name('posts.show');
