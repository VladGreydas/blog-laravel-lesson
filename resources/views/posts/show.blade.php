<x-layouts.main>
    <div class="content">
        <section class="big-pad-sec">
            <div class="container">
                <!-- post -->
                <div class="post fl-wrap fw-post">
                    <h2><span>{{$post->title}}</span></h2>
                    <ul class="blog-title-opt">
                        <li><a href="#">{{$post->created_at->format('d M y')}}</a></li>
                        <li> -</li>
                        <li><a href="#" style="text-transform: uppercase">{{$post->category?->name}} </a></li>
                        <li> -</li>
                        <li><a href="#">{{$post->user?->name}} </a></li>
                    </ul>
                    <!-- blog media -->
                    <div class="blog-media fl-wrap">
                        <div class="single-slider fl-wrap" data-effects="slide">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"><img src="{{ asset($post->cover) }}" alt=""></div>
                                </div>
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>
                                <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <!-- blog media end -->
                    <div class="blog-text fl-wrap">
                        <div class="pr-tags fl-wrap">
                            <span>Tags : </span>
                            <ul>
                                @foreach($post->tags as $tag)
                                    <li><a href="#">{{$tag->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <p>
                            {{$post->body}}
                        </p>
                        <p>Ut nec hinc dolor possim. An eros argumentum vel, elit diceret duo eu, quo et aliquid ornatus
                            delicatissimi. Cu nam tale ferri utroque, eu habemus albucius mel, cu vidit possit ornatus
                            eum.
                            Eu ius postulant salutatus definitionem, explicari. Graeci viderer qui ut, at habeo facer
                            solet
                            usu. Pri choro pertinax indoctum ne, ad partiendo persecuti forensibus est.</p>
                        <blockquote>
                            <p>Vestibulum id ligula porta felis euismod semper. Sed posuere consectetur est at lobortis.
                                Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Duis
                                mollis,
                                est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
                                Donec
                                ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod
                                semper.</p>
                        </blockquote>
                        <p>Ut nec hinc dolor possim. An eros argumentum vel, elit diceret duo eu, quo et aliquid ornatus
                            delicatissimi. Cu nam tale ferri utroque, eu habemus albucius mel, cu vidit possit ornatus
                            eum.
                            Eu ius postulant salutatus definitionem, an e trud erroribus explicari. Graeci viderer qui
                            ut,
                            at habeo facer solet usu. Pri choro pertinax indoctum ne, ad partiendo persecuti forensibus
                            est.</p>
                        <div class="share-holder block-share  fl-wrap ">
                            <span>Share :</span>
                            <div class="share-container  isShare"></div>
                        </div>
                    </div>
                    <div class="content-nav fl-wrap">
                        <ul>
                            <li>
                                <span>Next</span>
                                <a href="portfolio-single.html">Living my dream</a>
                            </li>
                            <li>
                                <span>Prev</span>
                                <a href="portfolio-single.html">Sunny side up</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- post end-->
                <!-- post-author-->
                <div class="post-author">
                    <div class="author-img">
                        <img alt='' src="{{asset('images/blog/1.jpg')}}">
                    </div>
                    <div class="author-content">
                        <h5><a href="#">{{$post->user?->name}}</a></h5>

                        <p>{{$post->user->description}}</p>
                        <div class="author-social">
                            @auth
                                @if($post->user_id != auth()->id())
                                    <ul id="button-wrapper">
                                        @if(!$isSubscribed)
                                            <li style="cursor:pointer;" id="subscribeButton"
                                                onclick="subscribe({{$post->user->id}})">
                                                <span>
                                                    <i style="color: #ffffff" class="fa fa-plus"></i>
                                                </span>
                                            </li>
                                        @else
                                            <li style="cursor:pointer;" id="unsubscribeButton"
                                                onclick="unsubscribe({{$post->user->id}})">
                                            <span>
                                                <i style="color: #FFFFFF" class="fa fa-minus"></i>
                                            </span>
                                            </li>
                                        @endif
                                    </ul>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
                <!--post-author end-->
                <x-blog.comments :post="$post"/>
                <!--comments end -->
            </div>
        </section>
    </div>
</x-layouts.main>
<script>
    async function subscribe(authorId) {
        let response = await fetch('{{route('subscriptions.store')}}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
                'X-CSRF-Token': '{{csrf_token()}}'
            },
            body: JSON.stringify({
                author_id: authorId
            })
        });

        if (response.status === 201) {
            document.querySelector('#subscribeButton').remove()

            let button = document.createElement('li');

            button.style = 'cursor:pointer;';
            button.id = 'unsubscribeButton';
            button.innerHTML = `<span><i style="color: #FFFFFF" class="fa fa-minus"></i></span>`;
            button.onclick = function () {unsubscribe({{$post->user->id}})}

            document.querySelector('#button-wrapper').append(button);
        }
    }

    async function unsubscribe(authorId) {
        let response = await fetch('{{route('subscriptions.destroy')}}', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
                'X-CSRF-Token': '{{csrf_token()}}'
            },
            body: JSON.stringify({
                author_id: authorId
            })
        });

        if (response.status === 200) {
            document.querySelector('#unsubscribeButton').remove()

            let button = document.createElement('li');

            button.style = 'cursor:pointer;';
            button.id = 'subscribeButton';
            button.onclick = function () {subscribe({{$post->user->id}})}
            button.innerHTML = `<span><i style="color: #FFFFFF" class="fa fa-plus"></i></span>`;

            document.querySelector('#button-wrapper').append(button);
        }
    }
</script>
