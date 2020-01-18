<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($post)
    {
        $posts = [
            'first' => 'My First Post',
            'second' => 'My Second Post'
        ];
        return $posts[$post] ?? abort('404');
    }
}
