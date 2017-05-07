

<div class="posts">

        <h2>Browse Directory 1</h2>
    <br/>

    @if(isset($posts) && count($posts))
        <ul class="list-group">
        @foreach($posts as $postObject)

            <li class="list-group-item">
                <a href="{{ $postObject->permalink }}" title="{{ $postObject->post_title }}">
                    {{ $postObject->ID }}: {{ $postObject->post_title }}
                </a>
            </li>
        @endforeach
    </ul>

    {{--{{ \IlluminePlugin1\Helper::url('directory') }}--}}

    @include('pagination.default-html5',[
        'paginator' => $posts
    ])

    @else
    <div class="alert">
    Whoops, we couldn't find any posts.
    </div>
    @endif
</div>