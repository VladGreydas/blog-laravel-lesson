<select name="category_id">
    @foreach($categories as $category)
        <option
            @selected($category->id == $currentId)
            value="{{$category->id}}">{{$category->name}}</option>
    @endforeach
</select>
