@extends('layouts.userslayout')
@section('head_section')
    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('vendor/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    @endsection

    @section('content')


            <!-- Begin Page Content -->
            <div class="container-fluid">


                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Subscribers Table</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <!-- Table headers -->
                                <thead>
                                <tr style="color: black; ">

                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Subscription status</th>
                                    <th>Amount Paid</th>
                                    <th>Subscription expiration date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>


                                </tr>
                                </thead>
                                <tfoot>
                                <tr style="color: black; ">

                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Subscription status</th>
                                    <th>Amount Paid</th>
                                    <th>Subscription expiration date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>


                                </tr>
                                </tfoot>
                             @foreach($users as $user)
                                <tr>
                                    <td width="(100/6)%">{{ $user->id }}</td>
                                    <td width="(100/6)%">{{ $user->name }}</td>
                                    <td width="(100/6)%">{{ $user->email }}</td>
                                    <td width="(100/6)%">{{ $user->phone_number }}</td>
                                    <td width="(100/6)%">{{ $user->subscription_status }}</td>
                                    <td width="(100/6)%">{{ $user->samount }}</td>
                                    <td width="(100/6)%">{{ $user->sexpiration }}</td>

                                    <td width="(100/6)%">
                                        <a  href="{{ url('admin_edit_subscribers', $user->id) }}"><button  style="float: left;" class='btn btn-success btn-sm'>Edit</button></a>
                                    </td>
                                    <td width="(100/6)%">
                                        <a  href="{{ url('admin_delete_subscribers', $user->id) }}"><button  style="float: left;" class='btn btn-danger btn-sm'>Delete</button></a>

                                    </td>

                                </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->


        <!-- End of Main Content -->



    <!-- End of Content Wrapper -->

<!-- Delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>



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
