@extends('admin.layout.default')
@section("title_area")
    Profile Change
@endsection
@section("main_section")
     <div class="content">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get("class")}} mt-4">{{Session::get("message")}}</div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card mt-4">
                        <div class="card-header bg-primary">
                            <h3 class="card-title text-white">Profile Change</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['route' => 'password_change',"method"=>"post"]) !!}
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="email">Email</label><small class="req">*</small>
                                            <input required  name="email" type="email" value="{{ Auth::user()->email  }}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email">
                                            <input   name="id" type="hidden" value="@isset($single){{  $single->id }} @endisset">
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="oldPass">Old Password</label><small class="req">*</small>
                                            <input   required name="oldPass" placeholder="Old Password" type="password"  class="form-control {{ $errors->has('oldPass') ? ' is-invalid' : '' }}" id="oldPass">
                                            @if ($errors->has('oldPass'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('oldPass') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="password">New Password</label><small class="req">*</small>
                                            <input  required  name="password" placeholder="New Password" type="password"  class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password">
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="col-sm-3">
                                        <div class="form-group pull-left mt-4">
                                            <input type="submit" class=" btn btn-primary pull-right" value="Change" name="submit" />
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                        </div>
                    </div>
                </div> <!-- col -->
            </div> <!-- End row -->
        </div> <!-- container -->
    </div>
@endsection