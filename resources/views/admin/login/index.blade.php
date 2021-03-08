<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Login Page | {{config("app.name")}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Nutritation" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('admin')}}/images/favicon.ico">

        <!-- App css -->
        <link href="{{asset('admin')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="{{asset('admin')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin')}}/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

    </head>

    <body class="authentication-page">

        <div class="account-pages my-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-header bg-img p-5 position-relative">
                                <div class="bg-overlay"></div>
                            <h4 class="text-white text-center mb-0">Sign In to {{config("app.name")}}</h4>
                            </div>
                            <div class="card-body p-4 mt-2">
                              <form method="POST" action="{{ route('login') }}" class="p-3" aria-label="{{ __('login') }}">
                                  @csrf
                                    <div class="form-group mb-3">
                                        <input name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" required="" placeholder="Email">
                                         @if ($errors->has('email'))
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                          </span>
                                          @endif
                                    </div>

                                    <div class="form-group mb-3">
                                        <input name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" required="" placeholder="Password">
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input" id="checkbox-signin">
                                            <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="form-group text-center mt-5 mb-4">
                                        <button class="btn btn-primary waves-effect width-md waves-light" type="submit"> Log In </button>
                                    </div>

                                    <div class="form-group row mb-0">
                                        {{-- <div class="col-sm-7">
                                            <a href="pages-recoverpw.html"><i class="fa fa-lock mr-1"></i> Forgot your password?</a>
                                        </div> --}}
                                        <div class="col-sm-12 text-center">
                                            Designed &amp; Developed By <a style="color: #F26A11" target="_blank" href="https://riseuplabs.com/">Riseup Labs</a>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <!-- end row -->

                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div>
        </div>

    </body>

</html>

