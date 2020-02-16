<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
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

Route::get('containers', function () {
    $container = new App\Http\Containers\Container;
    $container->bind('example', function () {
        return new \App\Http\Containers\Example;
    });

    $example = $container->resolve('example');
    ddd($example->test());
});

app()->bind('example', function () {
    return new \App\Http\Containers\Example;
});
Route::get('default-container', function () {
    $example = resolve('example');
    ddd($example->test());
});

app()->bind('example2', function () {
    $example2 = config('services.learning');
    return new \App\Http\Containers\Example2($example2);
});

Route::get('default-container-with-param', function () {
    $example2 = resolve('example2');
    ddd($example2->test());
});

Route::get('simple-conatiner', function () {
    $example = resolve(\App\Http\Containers\Example::class);
    ddd($example->test());
});


Route::get('simplest-container', function () {
    $example3 = resolve(\App\Http\Containers\Example3::class);
    ddd($example3->test());
});

Route::get('yet-simplest-container', function (\App\Http\Containers\Example3 $example3) {
    ddd($example3->test());
});

/*
app()->bind(App\Http\Containers\Example4::class, function () {
    $collborator = new \App\Http\Containers\Collaborator;
    $extra = 'This can be moved inside controller just like any other logic can be moved to controller from these route closure';
    return new \App\Http\Containers\Example4($collborator, $extra);
});*/

Route::get('simplest-container-with-paramter', function (\App\Http\Containers\Example4 $example4) {
    ddd($example4->test());
});

Route::get('singletone-container-with-paramter', function (\App\Http\Containers\Example4 $example4) {
    ddd($example4->test());
});

Route::get('contact-us', 'Web\ContactController@create')->name('contacts.create');
Route::post('contact-us', 'Web\ContactController@store')->name('contacts.store');