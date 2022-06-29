@extends('layouts.userrecommendationslayout')


@section('head')
    <link rel="stylesheet" href="{{ asset('user/css/prism.css') }}">
@endsection
@section('title',$recommendation->title)
@section('sub-heading',$recommendation->subtitle)

@section('main-content')
    <!-- Post Content -->

    <article>

            @php $src = str_replace("public/","",$recommendation->image);
            @endphp

{{--        <div class="container" style="background-image: url('{{ asset('storage/'.$src) }}')">--}}
            <div class="container">
            <div class="row">

                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <h4>Created at {{ $recommendation->created_at }}</h4>


                    @foreach ($recommendation->categories as $category)

                         <h5 class="pull-right" style="margin-right: 20px">
                             <a href="{{ route('category',$category->slug) }}"> Category: {{ $category->name }}</a>
                        </h5>
                    @endforeach
                    <img  width = "100%" height = "300px" src="{{ asset('storage/'.$src) }}" alt="rec" onerror="this.style.display='none'">

                    <div style="color: #456AC8; margin-top: 50px">
{{--                    {!! htmlspecialchars_decode($recommendation->body) !!}--}}
                        {!! $recommendation->body !!}
                    </div>

                    @foreach ($recommendation->tags as $tag)
                        <a href="{{ route('tag',$tag->slug) }}"><small class="pull-left" style="margin-right: 20px;border-radius: 5px;border: 1px solid gray;padding: 5px;">
                                Tag cloud: {{ $tag->name }}
                            </small></a>
                    @endforeach
                </div>
            </div>
        </div>
    </article>

    <hr>
@endsection
@section('footer')
    <script src="{{ asset('user/js/prism.js') }}"></script>
@endsection
