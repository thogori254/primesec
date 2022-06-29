@extends('layouts.adminrecommendationslayout')

@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <section class="content-header" style="text-align: center">
	    <h3>
	      Edit Tag

	    </h3>

	  </section>

	  <!-- Main content -->
	  <section class="content" style="margin-left: 10%;margin-right: 10%; background-color: #f9f5f4;">
	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->
	        <div class="box box-primary">

	          @include('includes.messages')
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{ url('admin_update_tag',$tag->id) }}" method="post">
	          {{ csrf_field() }}
{{--	          {{ method_field('PUT') }}--}}
	            <div class="box-body">
	            <div class="col-lg-offset-3 col-lg-6">
	              <div class="form-group">
	                <label for="name">Tag title</label>
	                <input type="text" class="form-control" id="name" name="name" placeholder="Tag Title" value="{{ $tag->name }}">
	              </div>

	              <div class="form-group">
	                <label for="slug">Tag Slug</label>
	                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ $tag->slug }}">
	              </div>

	            <div class="form-group">
	              <button type="submit" class="btn btn-primary">Submit</button>
	              <a href='{{ url('admin_view_tags') }}' class="btn btn-warning">Back</a>
	            </div>

	            </div>

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
        $("#name").keyup(function(){
            $("#slug").val($(this).val());
        });

    </script>
@endsection
