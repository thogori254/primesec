@extends('layouts.adminrecommendationslayout')

@section('headSection')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
@endsection

@section('main-content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header" style="text-align: center; color: #456AC8;">
            <h3>
                Post a Recommendation
            </h3>
        </section>

        <!-- Main content -->
        <section class="content" style="margin-left: 10%;margin-right: 10%; background-color: #f9f5f4;">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">Titles</h4>
                        </div>
                    @include('includes.messages')
                    <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('admin_update_recommendations',$recommendation->id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
{{--                            {{ method_field('PATCH') }}--}}
                            <div class="box-body">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="title">Recommendation Title</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $recommendation->title }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="subtitle">Recommendation Sub Title</label>
                                        <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Sub Title" value="{{ $recommendation->subtitle }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="slug">Recommendation Slug</label>
                                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ $recommendation->slug }}">
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <br>
                                    <div class="form-group">
                                        <div class="pull-right">
                                            <label for="image">File input</label>
                                            <input type="file" name="image" id="image">
                                        </div>
                                        <div class="checkbox pull-left">
                                            <label>
                                                <input type="checkbox" name="status" value="1" @if ($recommendation->status == 1)
                                                    {{'checked'}}
                                                    @endif> Publish
                                            </label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group" style="margin-top:18px;">
                                        <label>Select Tags</label>
                                        <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" tabindex="-1" aria-hidden="true" name="tags[]">
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}"
                                                        @foreach ($recommendation->tags as $recommendationTag)
                                                        @if ($recommendationTag->id == $tag->id)
                                                        selected
                                                    @endif
                                                    @endforeach
                                                >{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" style="margin-top:18px;">
                                        <label>Select Category</label>
                                        <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" tabindex="-1" aria-hidden="true" name="categories[]">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                        @foreach ($recommendation->categories as $recommendationCategory)
                                                        @if ($recommendationCategory->id == $category->id)
                                                        selected
                                                    @endif
                                                    @endforeach
                                                >{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Write Post Body Here

                                    </h3>

                                </div>
                                <!-- /.box-header -->
                                <div class="box-body pad">
                                    <textarea name="body" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px; " id="summernote">{{ $recommendation->body }}</textarea>
                                </div>
                            </div>

                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary">
                                <a href="{{url('admin_view_recommendations')}}" class="btn btn-warning">Back</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col-->
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->




@endsection

@section('scripts')

    <script type="application/javascript">
        $('#summernote').summernote({
            placeholder: 'Your Body here',
            tabsize: 2,
            height: 100
        });
    </script>


    <script type="text/javascript" src="{{ asset('admin/plugins/select2/select2.full.min.js') }}" defer></script>

    <script type="application/javascript">
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>
    <script>
        $("#title").keyup(function(){
            $("#slug").val($(this).val());
        });

    </script>
@endsection
