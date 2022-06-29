<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm app-nav">
            <div class="container">
                <a class="navbar-brand app-nav-logo" href="{{ url('/') }}">
                    <img src="/images/logo.png" class="d-inline-block align-top" alt=""></img>
                </a>

                <div class="dropdown ">
                    <button class="navbar-toggler" type="button" data-toggle="dropdown" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="/" class="nav-link">{{ __('Home') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="/products" class="nav-link">{{ __('Products') }}</a>
                            </li>

                            <li class="nav-item">
                                <a href="/blog" class="nav-link">{{ __('Blog') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="/analysis" class="nav-link" >{{ __('Updates') }}</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{url('recommendations')}}" class="nav-link" >{{ __('Recommendations') }}</a>
                            </li>

                            <li class="nav-item">
                                <a href="/articles" class="nav-link" >{{ __('Articles') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="/contact-us" class="nav-link">{{ __('Contact Us') }}</a>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="/" class="nav-link">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/products" class="nav-link">{{ __('Products') }}</a>
                        </li>

                        <li class="nav-item">
                            <a href="/blog" class="nav-link">{{ __('Blog') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/analysis" class="nav-link" >{{ __('Analysis') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/articles" class="nav-link" >{{ __('Articles') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/contact-us" class="nav-link">{{ __('Contact Us') }}</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
