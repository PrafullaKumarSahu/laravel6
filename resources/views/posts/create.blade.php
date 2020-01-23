@extends('layout')
@section('çontent')
<div id="content">
			<div class="title">
				<h2 class="heading has-text-weight-normal">Create New Post</h2> </div>
			<form action="{{ route('posts.store') }}" method="POST">
            @csrf
                <div class="field">
                    <label class="label" for="title">Title</label>
                    <div class="control">
                        <input type="text" class="input" name="title" id="title" value="{{ old('title') }}" />
                        @error('title')
						<p class="help is-danger">{{ $errors->first('title') }}</p>
						@enderror
                    </div>
                </div>
                <div class="field">
                    <label class="label" for="description">Description</label>
                    <div class="control">
                        <textarea class="textarea" id="description" name="description">{{ old('description') }}</textarea>
                        @error('description')
                        <p class="help is-danger">{{ $errors->first('description') }}</p>
                        @enderror
                    </div>
                </div>

				<div class="field">
					<label class="label" for="tag">Tags</label>
					<div class="control">
						@if($tags)
							@foreach ( $tags as $tag)
								<label for="tag-{{ $tag->id  }}"><input type="checkbox" name="tags[]" class="checkbox" id="tag-{{ $tag->id  }}" value="{{ $tag->id }}">{{ $tag->title }}</label>
							@endforeach
						@endif
						@error('tags')
                        <p class="help is-danger">{{ $errors->first('tags') }}</p>
                        @enderror
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