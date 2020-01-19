@extends('layout')
@section('çontent')
<div id="content">
    @foreach($posts as $post)
			<div class="title">
				<h2>{{  $post->title }}</h2> 
            </div>
			<p>{{ $post->description }}</p>
            @endforeach
		</div>
        	<div id="sidebar">
			<ul class="style1">
                @foreach($posts as $post)
                <li class="first">
					<h3>{{ $post->title }}</h3>
					<p><a href="{{ route('posts.show', $post) }}">{{ $post->description }}</a></p>
				</li>
                @endforeach
			</ul>
			<div id="stwo-col">
				<div class="sbox1">
					<h2>Etiam rhoncus</h2>
					<ul class="style2">
						<li><a href="#">Semper quis egetmi dolore</a></li>
						<li><a href="#">Quam turpis feugiat dolor</a></li>
						<li><a href="#">Amet ornare hendrerit lectus</a></li>
						<li><a href="#">Quam turpis feugiat dolor</a></li>
					</ul>
				</div>
				<div class="sbox2">
					<h2>Integer gravida</h2>
					<ul class="style2">
						<li><a href="#">Semper quis egetmi dolore</a></li>
						<li><a href="#">Quam turpis feugiat dolor</a></li>
						<li><a href="#">Consequat lorem phasellus</a></li>
						<li><a href="#">Amet turpis feugiat amet</a></li>
					</ul>
				</div>
			</div>
		</div>
@endsection