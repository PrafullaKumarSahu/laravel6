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
Route::post('posts', 'web\PostController@store')->name('posts.store');
Route::get('posts/create', 'web\PostController@create')->name('posts.create');
Route::get('posts/{post}', 'web\PostController@show')->name('posts.show');
Route::put('posts/{post}', 'web\PostController@update')->name('posts.update');
Route::get('posts/{post}/edit', 'web\PostController@edit')->name('posts.edit');

Route::get('tags/{tag}', 'web\TagController@show')->name('tags.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
