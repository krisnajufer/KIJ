<!DOCTYPE html>
<html lang="en">

<head>

    @include('admin.includes.meta')

    <title>YMS - Login</title>

    @stack('before-stylle')
    @include('admin.includes.style')
    @stack('after-style')

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->

                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="row mb-0 mt-2 ml-0 mr-0">
                                    <div class="col-md-12">
                                        @if (session()->has('incorrect'))
                                            <div class="alert alert-danger text-center">
                                                {{ session('incorrect') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome!</h1>
                                    </div>
                                    <form class="user" action="{{ route('auth.login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                style="color: black; font-weight: 500px;" id="username" name="username"
                                                aria-describedby="emailHelp" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                style="color: black; font-weight: 500px;" id="password" name="password"
                                                placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @stack('before-script')
    @include('admin.includes.script')
    @stack('after-script')

</body>

</html>
