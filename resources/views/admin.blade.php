@extends('layouts.adminlayout')

@section('content')
<div class="container full-view">
    <div class="row">
        <!-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body" id="editor">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div> -->
        <router-view></router-view>
    </div>
</div>

@endsection
