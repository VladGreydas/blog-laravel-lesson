<li class="comment" style="float: none; margin-left: {{$margin}}px">
    <div class="comment-body">
        <div class="comment-author">
            <img alt='' src='images/blog/users/1.jpg' width="50" height="50">
        </div>
        <cite class="fn"><a href="#">{{$comment->user->name}}</a></cite>
        <div class="comment-meta">
            <h6><a href="#">{{$comment->created_at->diffForHumans()}}</a> /
                @auth
                    <span class='comment-reply-link' href="#" onclick="showReplyForm('{{$comment->id}}')">Reply</span> /
                    @can('commentOwner', $comment)
                        <span class='comment-reply-link' href="#" onclick="showEditForm('{{$comment->id}}')">Edit</span>
                        /
                        <span class='comment-reply-link' href="#"
                              onclick="document.querySelector('#deleteComment-{{$comment->id}}').submit()">Delete</span>
                    @endcan
                @endauth
            </h6>
        </div>
        <p>{{$comment->text}}</p>
    </div>
    @auth
        <form action="{{route('comments.destroy', compact('comment'))}}" method="post"
              id="deleteComment-{{$comment->id}}">
            @csrf
            @method('DELETE')
        </form>
        <div id="editForm-{{$comment->id}}" class="clearafix responseForm" hidden>
            <div class="comment-reply-form clearfix">
                <form action="{{route('comments.update', compact('comment'))}}" method="post" id="commentform"
                      class="form-horizontal"
                      name="commentform">
                    @csrf
                    @method('put')
                    <div class="comment-form-comment control-group">
                        <div class="controls">
                            <input type='hidden' name='post_id' value='{{$post->id}}'/>
                            <input type='hidden' name='comment_id' value='{{$comment->id}}'/>
                            <textarea id="text" name="text" cols="50" rows="4" aria-required="true"
                                      placeholder="Your comment here.." required>{{$comment->text}}</textarea>
                        </div>
                    </div>
                    <div class="form-submit">
                        <div class="controls">
                            <button class="transition button" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="responseForm-{{$comment->id}}" class="clearafix responseForm" hidden>
            <div class="comment-reply-form clearfix">
                <form action="{{route('comments.store')}}" method="post" id="commentform" class="form-horizontal"
                      name="commentform">
                    @csrf
                    <div class="comment-form-comment control-group">
                        <div class="controls">
                            <input type='hidden' name='post_id' value='{{$post->id}}'/>
                            <input type='hidden' name='comment_id' value='{{$comment->id}}'/>
                            <textarea id="text" name="text" cols="50" rows="4" aria-required="true"
                                      placeholder="Your comment here.." required></textarea>
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
</li>
@foreach($comment->comments as $comment)
    <x-blog.comment :$comment :$post :margin="$margin+60"/>
@endforeach
