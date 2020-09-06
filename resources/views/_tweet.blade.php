<div class="flex p-4 relative {{ $loop->last ? '' : 'border-b border-b-gray-400' }}">
    <div class="mr-2 flex-shrink-0">
        <a href="{{ $tweet->user->path() }}">
            <img
                src="{{ $tweet->user->avatar }}"
                alt=""
                class="rounded-full mr-2"
                width="50"
                height="50"
            >
        </a>
    </div>


    @can ('edit', $tweet->user)
    <form method="post" action="{{ route('tweet_delete',$tweet->id)}}">
        @csrf
        <div class="absolute right-0 mr-3 text-gray-500 hover:text-gray-700">
            <button type="submit"><svg viewBox="0 0 20 20"
                 class="w-3"
            >
                <g id="Page-1"
                   stroke="none"
                   stroke-width="1"
                   fill="none"
                   fill-rule="evenodd"
                >
                    <g class="fill-current">
                        <path d="M2,2 L18,2 L18,4 L2,4 L2,2 Z M8,0 L12,0 L14,2 L6,2 L8,0 Z M3,6 L17,6 L16,20 L4,20 L3,6 Z M8,8 L9,8 L9,18 L8,18 L8,8 Z M11,8 L12,8 L12,18 L11,18 L11,8 Z"
                              id="Fill-97">

                        </path>
                    </g>
                </g>
            </svg>
            </button>
        </div>
    </form>
    @endcan
    <div>
        <h5 class="font-bold mb-2">
            <a href="{{ $tweet->user->path() }}">
                {{ $tweet->user->name }}
            </a>
        </h5>


        @if(!empty($tweet->imageTweet))
            <div>
                <img src="{{$tweet->imageTweet}}" class="align-center justify-center" alt="" style="max-height: 300px; max-width: 100%">
            </div>
        @endif
        <p class="text-sm mb-3">
            {{ $tweet->body }}
        </p>
        @auth
            <x-like-buttons :tweet="$tweet" />
        @endauth
    </div>
</div>
