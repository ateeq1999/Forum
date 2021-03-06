{{-- Editing The Thread --}}
<div class="rounded-lg shadow bg-gray-100 mt-4 mx-1" v-if="editing" v-cloak>
    <div class="md:p-6 p-3">
        <article class="overflow-hidden">
            <div>
                <input type="text" name="title" v-model="form.title" class="input-field focus:bg-gray-300 bg-gray-300">
            </div>
            <wysiwyg name="body" v-model="form.body" class="mt-4"></wysiwyg>
            <div class="flex mt-4">
                <div>
                    <button class="text-md rounded-lg bg-gray-300 p-1 cursor-pointer" @click="cancel">
                        Cancel
                    </button>
                </div>
                <div class="ml-2">
                    <button class="text-md rounded-lg text-white bg-green-500 p-1 cursor-pointer" @click="save">
                        Save
                    </button>
                </div>
                <div class="ml-2 ml-auto">
                    <form action="{{ $thread->path() }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-md rounded-lg text-red-800 bg-red-300 p-1 cursor-pointer">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </article>
    </div>
</div>

{{-- Viewing The Thread --}}

<div class="rounded-lg shadow bg-gray-100 mt-4 mx-1" v-else>
    <div class="md:p-6 p-3">
        <article>
            <div class='text-gray-800 text-xl'>
                <div class="flex items-start">
                    <img class="w-12 h-12 mr-4 rounded-full" src="{{ $thread->user->avatar }}" alt="avatar">
                    <div>
                        <a  href="{{ url($thread->path()) }}">
                            @if (auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                            <strong><h4 v-text="form.title"></h4></strong>
                            @else
                            <h4 v-text="form.title"></h4>
                            @endif
                        </a>
                        <span class="text-sm font-semibold">
                            Posted By <a href="{{ route('profile', $thread->user->name) }}">{{ $thread->user->name }}</a>
                        </span>
                        <span class='inline-block text-sm mt-0 text-gray-600'>
                            {{ $thread->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <div class="ml-auto" v-cloak>
                        <span class="text-sm rounded-lg bg-gray-300 p-1">
                            {{ $thread->channel->name }}
                        </span>
                        <button class="inline mr-1 rounded bg-gray-600 text-sm text-white px-2 ml-1" @click="editing = true" v-show="this.authorize('owns', thread)">
                            <i class="fa fa-pencil"></i>
                        </button>
                    </div>
                </div>
            </div>
            <p class="text-gray-700 bg-gray-100 rounded-lg p-4 body break-words" v-html="body"></p>
            <div class="flex mt-4">
                <div v-cloak class="ml-2">
                    <a class="text-xs bg-gray-300 text-gray-700 p-1 rounded-full" href="{{ url($thread->path()) }}"><strong>{{ number_format($thread->replies_count) }} <i class="fa fa-comment"></i></strong></a>
                </div>
                <favorite class="ml-2" :model="thread" :endpoint="'/favorite/' + 'threads/' + id"></favorite>
                <div v-cloak class="text-xs bg-gray-300 ml-4 p-1 rounded-full">
                    <strong>{{ number_format($thread->visits) }} Visits</strong>
                </div>
            </div>
        </article>
    </div>
</div>
