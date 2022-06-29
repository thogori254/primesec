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
            <div class="container-fluid" style="text-align: center;">


                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Subscriber {{$user->name}}</h6>
                    </div>
                    <div class="card-body">


                            <form  action="{{ url('admin_update_subscribers', $user) }}" method="POST"  >
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input   type="text" id="name" name="name" value="{{$user->name}}">
                                </div>

                                <div class="form-group">
                                    <label for="payment">Email</label>
                                    <input   type="text" id="email" name="email" value="{{$user->email}}" >
                                </div>

                                <div class="form-group">
                                    <label for="subject">Phone Number</label>
                                    <input   type="text" value="{{$user->phone_number}}"  id="phone_number" name="phone_number">
                                </div>


                                <div class="form-group">
                                    <label for="subject">Subscription Status</label>
                                    <input   type="text" value="{{$user->subscription_status}}"  id="subscription_status" name="subscription_status">
                                    <div>
                                    <sub>0 for Not subscribed <br> 1 for Subscribed</sub>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary" name="submit" value="Submit Form" >Submit</button>
                                <!--  <input type="submit" name="submit" value="Submit Form"> -->
                            </form>

                        </div>
                    </div>
                </div>

            <!-- /.container-fluid -->


        <!-- End of Main Content -->


    <!-- End of Content Wrapper -->


<!-- End of Page Wrapper -->






    @endsection

@section('scripts')
    <!-- Bootstrap core JavaScript-->
    <script  src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script  src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <scrip src="{{ asset('vendor/js/sb-admin-2.min.js')}}'"></scrip>

    <!-- Page level plugins -->
    <script  src="{{ asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script  src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('vendor/js/demo/datatables-demo.js')}}"></script>
@endsection
