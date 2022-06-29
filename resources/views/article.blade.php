@extends('layouts.articlelayout')

@section('content')
    <div class="container post-container">
        <script src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&amp;version=v7.0" crossorigin="anonymous" async="" defer=""></script>
        <div id="fb-root"></div>
        <label>{{$post->user->name}}&nbsp;&nbsp;&bull;&nbsp;&nbsp;{{date('d M, Y', strtotime($post->created_at))}}&nbsp;&nbsp;&bull;&nbsp;&nbsp;{{$post->master_category->name}}</label>
        <div class="post-header" >{{$post->title}} </div> 
        @if($post->headerUrl() !== null)  
            <div class="img-excerpt">
                <img class="file-upload-image" src="{{$post->headerUrl()}}" alt="header image"></img>
            </div>
        @endif
        <div >{!! $post->body !!}</div>
        <!-- AddToAny BEGIN -->
        <div v-show="shareIcons == post.uid" class="a2a_kit a2a_kit_size_32 a2a_default_style"  v-bind:data-a2a-url="url" v-bind:data-a2a-title="title">
            <a class="a2a_button_facebook"></a>
            <a class="a2a_button_twitter"></a>
            <a class="a2a_button_email"></a>
            <a class="a2a_button_whatsapp"></a>
            <a class="a2a_button_telegram"></a>
            <a class="a2a_button_google_gmail"></a>
            <a class="a2a_button_linkedin"></a>
        </div>
        <!-- AddToAny END -->
        <div>
            <div class="fb-comments" data-numposts="5" data-width=""></div>
        </div>
        <script async src="https://static.addtoany.com/menu/page.js"></script>
    </div>
@endsection
