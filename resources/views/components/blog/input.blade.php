@error('title')
<p style="color: #a90707">{{$message}}</p>
@enderror
<input name="title" type="text" id="title" placeholder="Title" value="{{old('title', $post->title ?? '')}}">
@error('description')
<p style="color: #a90707">{{$message}}</p>
@enderror
<textarea name="description">{{old('description', $post->description ?? '')}}</textarea>
@error('body')
<p style="color: #a90707">{{$message}}</p>
@enderror
<textarea name="body">{{old('body', $post->body ?? '')}}</textarea>
