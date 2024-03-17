<label for="">Tags</label>
<div style="display: flex">
    @foreach($tags->chunk(4) as $chunk)
        <div>
            @foreach($chunk as $tag)
                <div>
                    @checked()
                    <input type="checkbox" name="" style="margin: 10px">{{$tag->name}}
                </div>
            @endforeach
        </div>
    @endforeach
</div>
