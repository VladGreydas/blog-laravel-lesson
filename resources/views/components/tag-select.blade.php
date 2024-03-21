<label for="">Tags</label>
<div style="display: flex">
    @foreach($tags->chunk(4) as $chunk)
        <div>
            @foreach($chunk as $tag)
                <div>
                    <input
                        type="checkbox"
                        name="tags[]"
                        value="{{$tag->id}}"
                        style="margin: 10px"
                        @checked($current?->contains($tag))
                    >{{$tag->name}}
                </div>
            @endforeach
        </div>
    @endforeach
</div>
