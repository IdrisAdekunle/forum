<div class="list-group">
    @forelse($threads as $thread)

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="{{route('thread.show',$thread->id)}}"> {{$thread->subject}}</a></h3>
            </div>
            <div class="panel-body">
                <p>{{str_limit($thread->thread,100) }}
                    <br>
                    Posted by <a href="">{{$thread->user->name}}</a> {{$thread->created_at->diffForHumans()}}
                </p>
                @if (count($thread->tags))
                    Tags:
                @foreach($thread->tags as $tag)

            <a href="{{route('threads_tags',$tag->name)}}"> <span class="badge">  #{{$tag->name}}    </span>  </a>

                     @endforeach

                    @endif
            </div>
        </div>

    @empty
        <h1>No threads</h1>

    @endforelse
</div>
{{ $threads->links() }}
