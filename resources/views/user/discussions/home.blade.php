@extends('layouts.userrecommendationslayout')


@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
	<style>
		.fa-thumbs-up:hover{
			color:#f41115;
		}

	</style>
@endsection
@section('main-content')
	<!-- Main Content -->
	<div class="container" style="background-color: #f9f5f4;">
        <div class="row col-md-12"  >

	          @foreach( $discussions as $discussion)
               @php $src = str_replace("public/","",$discussion->image);
               @endphp
                <div class="col-md-4" style="margin-bottom: 20px;">
                    <div class="card text-center" style="color: #456AC8;">
                        <div class="card-body" >
                            <img class="card-img-top" width = "100%" height = "200px" src="{{ asset('storage/'.$src) }}" alt=" ">
                            <h2 class="card-title">{{$discussion->title}}</h2>
                            <p class="card-text">{{$discussion->subtitle}}</p>
                            <a href="{{url('discussion/'.$discussion->id)}}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>



    @endforeach
    </div>
    </div>
	<script src="{{ asset('js/app.js') }}"></script>
@endsection
