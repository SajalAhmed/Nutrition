@extends('admin.layout.default')
@section('title_area')
Manage Course
@endsection
@section('main_section')
<div class="content">
    <div class="container-fulid">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get("class")}} mt-4">{{Session::get("message")}}</div>
        @endif
        @if(hasPermission("course",ADD))
            <div class="row">
                <div class="col-sm-12">
                    <div class="card mt-4">
                        <div class="card-header bg-primary">
                            <h3 class="card-title text-white">Manage App Version</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route("admin.appVersion")}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="version_code">Version Code</label><small class="req"> *</small>
                                        <input type="number" value="{{@$single->version_code}}" name="version_code" placeholder="Version Code" min="1" class="form-control {{ $errors->has('version_code') ? ' is-invalid' : '' }}" required id="version_code" >
                                        <input type="hidden" value="{{@$single->id}}" name="id" >
                                            @if ($errors->has('version_code'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('version_code') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="version_name">Version Name</label><small class="req"> *</small>
                                        <input type="text" name="version_name" value="{{@$single->version_name}}" placeholder="Version Code(1.0.0)" class="form-control {{ $errors->has('version_name') ? ' is-invalid' : '' }}" required id="version_name" >
                                            @if ($errors->has('version_name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('version_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="force_update">Force Update</label><small class="req"> *</small>
                                            <select name="force_update" id="force_update" class="form-control">
                                                <option {{@$single->force_update==1?"selected":""}} value="1">Yes</option>
                                                <option {{@$single->force_update==0?"selected":""}} value="0">No</option>
                                            </select>
                                            @if ($errors->has('force_update'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('force_update') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group pull-left mt-4">
                                            <button name="" type="submit" class="btn btn-primary"><i class="md md-add m-r-5"></i>Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- col -->
            </div> <!-- End Row -->
        @endif

    </div> <!-- container -->
</div>
@endsection
