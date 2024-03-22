<div id="comments" class="single-post-comm">
    <!--title-->
    <h6 id="comments-title">Comments<span>( {{count($post->comments)}} )</span></h6>
    <ul class="commentlist clearafix">
        @foreach($post->comments as $comment)
        <x-blog.comment :$comment :$post :margin="0"/>
        @endforeach
    </ul>
    <div class="clearfix"></div>
    @auth
    <div id="responseForm" class="clearafix">
        <div class="comment-reply-form clearfix">
            <form action="{{route('comments.store')}}" method="post" id="commentform" class="form-horizontal" name="commentform">
                @csrf
                <div class="comment-form-comment control-group">
                    <div class="controls">
                        <input type='hidden' name='post_id' value='{{$post->id}}' />
                        <textarea id="text" name="text" cols="50" rows="4" aria-required="true" placeholder="Your comment here.." required onclick="hideAllForms()"></textarea>
                    </div>
                </div>
                <div class="form-submit">
                    <div class="controls">
                        <button class="transition button" type="submit">Post Comment</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
    @endauth
    <!--end respond-->
</div>

<script>
    function showReplyForm(id) {
        hideAllForms()

        document.querySelector('#responseForm-'+id).hidden=false
    }

    function showEditForm(id) {
        hideAllForms()

        document.querySelector('#editForm-'+id).hidden=false
    }

    function hideAllForms() {
        let forms = document.querySelectorAll('.responseForm')
        forms.forEach(form => {
            form.hidden = true;
        })
    }
</script>
