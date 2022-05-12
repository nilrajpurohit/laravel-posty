@extends('layouts.app')
@section('content')
   <div class="flex justify-center">
        <div class="w-8/12">
            <div class="p-6">
                <h1 class="text-2xl font-medium mb-1">{{$user->name}}</h1>
                <p>Posted {{$posts->count()}} {{Str::plural('post',$posts->count())}} and received {{$user->receivedLikes->count()}} {{Str::plural('like',$user->receivedLikes->count())}}</p>
            </div>
            <div class="bg-white p-6 rounded-lg">
                @if($posts->count() > 0)
                @foreach ($posts as $item)
                  <x-post :item="$item"/>
                @endforeach
                   {{$posts->links()}}
                @else
                    <p>{{$user->name}} does not have any post!</p>
                @endif
            </div>
        </div>
   </div>
@endsection