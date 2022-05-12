@extends('layouts.app')
@section('content')
   <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <form action="{{route('posts')}}" method="post" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="30" rows="4" 
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" 
                        placeholder="Post something!">
                    </textarea>

                    @error('body')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
                </div>
            </form>
            @if($posts->count() > 0)
            @foreach ($posts as $item)
               <div class="mb-4">
                    <a href="" class="font-bold">{{$item->user->name}}</a>
                    <span class="text-gray-600 text-sm">{{$item->created_at->diffForHumans()}}</span>
                    <p class="mb-2">{{$item->body}}</p>
                    <div class="flex items-center">
                        @if(!$item->likedBy(auth()->user()))
                            <form action="{{route('posts.like',$item)}}" method="post" class="mr-1">
                                @csrf
                                <button type="submit" class="text-blue-500">
                                    Like
                                </button>
                            </form>
                        @else
                            <form action="{{route('posts.like',$item)}}" method="post" class="mr-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-blue-500">
                                    Unlike
                                </button>
                            </form>
                        @endif
                        <span>{{$item->likes->count()}} {{Str::plural('like',$item->likes->count())}}</span>
                    </div>
               </div>
            @endforeach
               {{$posts->links()}}
            @else
                <p>There is no post!</p>
            @endif
        </div>
   </div>
@endsection