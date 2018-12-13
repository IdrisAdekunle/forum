@extends('layouts.front')

@section('content')


        <div class="dp">
            <img src="https://dummyimage.com/300x200/000/fff" alt="">
        </div>
        <h3>
            {{$user->name}}
        </h3>

        <br/>

<div style="margin-left: 30%">

    <h3>{{$user->name}}'s latest Threads</h3>

</div>
        <br/> <br/>


        @include('thread.partials.thread-list')


@endsection
