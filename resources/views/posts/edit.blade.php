@extends('layout')
@section('çontent')
<div id="content">
			<div class="title">
				<h2 class="heading has-text-weight-normal">Edit Post</h2> </div>
			<form action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
			@method('PUT')
                <div class="field">
                    <label class="label" for="title">
                    <div class="control">
                        <input type="text" class="input" name="title" id="title" value="{{ $post->title }}" />
                    </div>
                </div>
                <div class="field">
                    <label class="label" for="description">
                    <div class="control">
                        <textarea class="input" id="description" name="description">{{ $post->description }}</textarea>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <input type="submit" class="btn btn-primary" id="submit" value="Submit"/>
                    </div>
                </div>
            </form>
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