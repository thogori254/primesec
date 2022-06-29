@extends('layouts.userrecommendationslayout')


@section('head')
    <link rel="stylesheet" href="{{ asset('user/css/prism.css') }}">
@endsection
@section('title',$discussion->title)
@section('sub-heading',$discussion->subtitle)

@section('main-content')
    <!-- Post Content -->

    <article>

            @php $src = str_replace("public/","",$discussion->image);
            @endphp

{{--        <div class="container" style="background-image: url('{{ asset('storage/'.$src) }}')">--}}
            <div class="container">
            <div class="row">

                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <h4>Created at {{ $discussion->created_at }}</h4>


                    @foreach ($discussion->topics as $topic)

                         <h3 class="pull-right" style="margin-right: 20px">
                             <a href="{{ route('topic',$topic->slug) }}"> TOPIC: {{ $topic->name }}</a>
                        </h3>
                    @endforeach
                    <img  width = "100%" height = "300px" src="{{ asset('storage/'.$src) }}" alt="rec" onerror="this.style.display='none'">

                    <div style="color: #456AC8; margin-top: 50px">
{{--                    {!! htmlspecialchars_decode($recommendation->body) !!}--}}
                        {!! $discussion->body !!}
                    </div>

                </div>
            </div>
        </div>
    </article>

    <hr>
@endsection
@section('footer')
    <script src="{{ asset('user/js/prism.js') }}"></script>
@endsection
