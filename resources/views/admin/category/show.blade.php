@extends('layouts.adminrecommendationslayout')

@section('headSection')
    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('vendor/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@section('main-content')
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
        <h3 class="box-title">Categories</h3>

        <a class='col-lg-offset-5 btn btn-success' href="{{ url('admin_create_category') }}">Add New</a>

      </div>
            <!-- Begin Page Content -->
            <div class="container-fluid">


                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Categories Table</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                          <th>S.No</th>
                          <th>Tag Name</th>
                          <th>Slug</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                        </thead>
                                <tfoot>
                                <tr>
                                    <th>S.No</th>
                                    <th>Tag Name</th>
                                    <th>Slug</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </tfoot>

                        @foreach ($categories as $category)
                          <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                              <td><a href="{{ url('admin_edit_category',$category->id) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
                              <td>

{{--                                <form id="delete-form-{{ $category->id }}" method="post" action="{{ route('category.destroy',$category->id) }}" style="display: none">--}}
{{--                                  {{ csrf_field() }}--}}
{{--                                  {{ method_field('DELETE') }}--}}
{{--                                </form>--}}

                                <a href="{{ url('admin_delete_category',$category->id) }}"

{{--                                   onclick="--}}
{{--                                if(confirm('Are you sure, You Want to delete this?'))--}}
{{--                                    {--}}
{{--                                      event.preventDefault();--}}
{{--                                      document.getElementById('delete-form-{{ $category->id }}').submit();--}}
{{--                                    }--}}
{{--                                    else{--}}
{{--                                      event.preventDefault();--}}
{{--                                    }"--}}
                                ><span class="glyphicon glyphicon-trash"></span></a>
                              </td>
                            </tr>
                          </tr>
                        @endforeach

                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
      </div>

      <!-- /.box-footer-->
    </div>
    <!-- /.box -->
        </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


@endsection

@section('scripts')

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" defer></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        } );
    </script>

@endsection
