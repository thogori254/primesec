<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="text-align: center;" class="modal-title" id="loginModal">{{ __('Login') }}</h5>
                <div>
                    <img id="login_modal_img"  src="{{ URL::asset('images/How_to_pay_login_page.jpeg') }}" alt="Mpesa">
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ url('user/login') }}" class="center">
                    @csrf

                    <div class="form-group">
                        <label>Email</label>
                        <input autocomplete="false" type="email" placeholder="Your email e.g john@example.com" value="{{ old('email') }}" name="email" required class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label>Password</label>
                        <input autocomplete="false" type="password" placeholder="Choose a strong password" name="password" value="" required class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg w-75 rounded-pill">Next&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                    <hr/>
                    <div class="form-group center mt-4 ml-2 row mb-0" style="text-align: center;">

                        Don't have an account?&nbsp;&nbsp;<a href="{{route('register')}}" >Register here >></a>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
@section('scripts')
    @parent

    @if($errors->has('email') || $errors->has('password'))
        <script>
            $(function() {
                $('#loginModal').modal({
                    show: true
                });
            });
        </script>
    @endif
@endsection
