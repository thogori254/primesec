<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm app-nav">
            <div class="container">
                <a class="navbar-brand app-nav-logo" href="{{ url('/') }}">
                    <img src="/images/logo.png" class="d-inline-block align-top" alt=""></img>
                    {{ config('app.name', 'Laravel') }}
                </a>

                <div class="dropdown ">
                    <button class="navbar-toggler" type="button" data-toggle="dropdown" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <router-link to="/edit/homepage" class="nav-link">{{ __('Edit Home') }}</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/new-analysis" class="nav-link">{{ __('New Analysis') }}</router-link>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('admin_recommendation_create')}}">{{ __('New Recommendation') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('admin_discussion_create')}}">{{ __('New Discussion') }}</a>
                            </li>
                            <li class="nav-item">
                                <router-link to="/new-article" class="nav-link">{{ __('New Article') }}</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/new-post" class="nav-link">{{ __('New Post') }}</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/manage-content" class="nav-link">{{ __('Content') }}</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/subscriptions" class="nav-link">{{ __('Subscriptions') }}</router-link>
                            </li>


                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @else
                                <li class="nav-item">


                                    <div aria-labelledby="navbarDropdown">
                                        <a class="nav-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest

                        </ul>
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Manage
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <router-link to="/edit/homepage" class="nav-link">{{ __('Home') }}</router-link>
                                <router-link to="/edit/products" class="nav-link">{{ __('Products') }}</router-link>
                                <router-link to="/manage-content" class="nav-link">{{ __('Content') }}</router-link>
                            </div>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Create
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <router-link to="/new-analysis" class="nav-link">{{ __('New Analysis') }}</router-link>
                                <router-link to="/new-article" class="nav-link">{{ __('New Article') }}</router-link>
                                <router-link to="/new-post" class="nav-link">{{ __('New Post') }}</router-link>

                            </div>
                        </li>
                        <li class="nav-item">
                            <router-link to="/subscriptions" class="nav-link">{{ __('Subscriptions') }}</router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('admin_view_subscribers') }}">
                                Subscribers mgt
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Discussions
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="nav-link" href="{{ url('admin_view_discussions') }}">
                                    Discussions
                                </a>
                                <a class="nav-link" href="{{ url('admin_view_topics') }}">
                                    Topics
                                </a>

                            </div>
                        </li>
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Recommendations
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                        <a class="nav-link" href="{{ url('admin_view_recommendations') }}">
                                                            Recommendations
                                                        </a>
                                                        <a class="nav-link" href="{{ url('admin_view_tags') }}">
                                                            Tags
                                                        </a>
                                                        <a class="nav-link" href="{{ url('admin_view_categories') }}">
                                                            Categories
                                                        </a>
                                                    </div>
                                                </li>

                        <li class="nav-item">
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item">


                                <div aria-labelledby="navbarDropdown">
                                    <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
