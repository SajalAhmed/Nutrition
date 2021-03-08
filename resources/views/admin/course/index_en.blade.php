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
            @isset($add)
                <div class="row">
                    <div class="col-sm-12">
                        <div class="custom-accordion" id="accordionbg">
                            <div class="card mb-1 shadow-none border mt-4">
                                <a href="" class="text-dark collapsed" data-toggle="collapse" data-target="#customborder_collapseOne" aria-expanded="true" aria-controls="customborder_collapseOne">
                                    <div class="card-header bg-primary" id="customborder_headingOne">
                                        <h5 class="card-title text-white m-0">
                                            Manage Course
                                            <i class="mdi mdi-minus-circle-outline float-right accor-plus-icon"></i>
                                        </h5>
                                    </div>
                                </a>

                                <div id="customborder_collapseOne" class="collapse" aria-labelledby="customborder_headingOne" data-parent="#accordionbg">
                                    <div class="card-body">
                                        <form action="{{route("admin.course")}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="name_en">Course Name English</label><small class="req"> *</small>
                                                        <input type="text" name="name_en" placeholder="Course Name English" class="form-control {{ $errors->has('name_en') ? ' is-invalid' : '' }}" required id="name" >
                                                        @if ($errors->has('name_en'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name_en') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="name_bn">Course Name Bangla</label><small class="req"> *</small>
                                                        <input type="text" name="name_bn" placeholder="Course Name Bangla" class="form-control {{ $errors->has('name_bn') ? ' is-invalid' : '' }}" required id="name_bn" >
                                                        @if ($errors->has('name_bn'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name_bn') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="picture">Cover Picture</label><small class="req"> *</small><code>(JPG,PNG AND MAX SIZE 2MB)</code>
                                                        <input type="file" data-max-file-size="2M" data-allowed-file-extensions="jpg png" name="picture" class="form-control {{ $errors->has('picture') ? ' is-invalid' : '' }}" required id="picture" >
                                                        @if ($errors->has('picture'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('picture') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="course_zip_file_name">Course File</label><small class="req"> *</small><code>(ZIP AND MAX SIZE 50MB)</code>
                                                        <input type="file" data-max-file-size="50M"  data-allowed-file-extensions="zip" name="course_zip_file_name" class="form-control {{ $errors->has('courseip_file_name_z') ? ' is-invalid' : '' }}"  id="coursip_file_namee_z" >
                                                        @if ($errors->has('course_zip_file_name'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('course_zip_file_name') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="purpose_en">Course Purpose English</label><small class="req"> *</small>
                                                        <textarea required name="purpose_en" id="purpose_en" class="form-control {{ $errors->has('purpose_en') ? ' is-invalid' : '' }}" placeholder="Course Purpose English" cols="30" rows="10"></textarea>
                                                        @if ($errors->has('purpose_en'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('purpose_en') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="purpose_bn">Course Purpose Bangla</label><small class="req"> *</small>
                                                        <textarea required name="purpose_bn" id="purpose_bn" class="form-control {{ $errors->has('purpose_bn') ? ' is-invalid' : '' }}" placeholder="Course Purpose Bangla" cols="30" rows="10"></textarea>
                                                        @if ($errors->has('purpose_bn'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('purpose_bn') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="method_en">Course Method English</label><small class="req"> *</small>
                                                        <textarea required name="method_en" id="method_en" class="form-control {{ $errors->has('method_en') ? ' is-invalid' : '' }}" placeholder="Course Method English" cols="30" rows="10"></textarea>
                                                        @if ($errors->has('method_en'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('method_en') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="method_bn">Course Method Bangla</label><small class="req"> *</small>
                                                        <textarea required name="method_bn" id="method_bn" class="form-control {{ $errors->has('method_bn') ? ' is-invalid' : '' }}" placeholder="Course Method Bangla" cols="30" rows="10"></textarea>
                                                        @if ($errors->has('method_bn'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('method_bn') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group pull-left mt-4">
                                                        <button name="" type="submit" class="btn btn-primary"><i class="md md-add m-r-5"></i>Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- col -->
                </div> <!-- End row -->
            @endisset
        @endif
        @if(hasPermission("course",EDIT))
        @isset($edit)
            <div class="row">
                <div class="col-sm-12">
                    <div class="custom-accordion" id="accordionbg">
                        <div class="card mb-1 shadow-none border mt-4">
                            <a href="" class="text-dark" data-toggle="collapse" data-target="#customborder_collapseOne" aria-expanded="true" aria-controls="customborder_collapseOne">
                                <div class="card-header bg-primary" id="customborder_headingOne">
                                    <h5 class="card-title text-white m-0">
                                        Manage Course
                                        <i class="mdi mdi-minus-circle-outline float-right accor-plus-icon"></i>
                                    </h5>
                                </div>
                            </a>

                            <div id="customborder_collapseOne" class="collapse show" aria-labelledby="customborder_headingOne" data-parent="#accordionbg">
                                <div class="card-body">
                                    {!! Form::open(['route' =>['admin.courseUpdate', 'course_id'=>$single->id],'files' => true]) !!}
                                     @method("PUT")
                                     <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name_en">Course Name English</label><small class="req"> *</small>
                                                <input type="text" name="name_en" value="{{$single->name_en}}" placeholder="Course Name English" class="form-control {{ $errors->has('name_en') ? ' is-invalid' : '' }}" required id="name" >
                                            <input type="hidden" name="id" value="{{$single->id}}" required>
                                                @if ($errors->has('name_en'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name_en') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name_bn">Course Name Bangla</label><small class="req"> *</small>
                                                <input type="text" name="name_bn" value="{{$single->name_bn}}" placeholder="Course Name Bangla" class="form-control {{ $errors->has('name_bn') ? ' is-invalid' : '' }}" required id="name_bn" >
                                                @if ($errors->has('name_bn'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name_bn') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="picture">Cover Picture</label><code>(JPG,PNG AND MAX SIZE 2MB)</code>
                                                <input type="file" data-max-file-size="2M" data-default-file="{{asset("storage/".$single->picture)}}" data-allowed-file-extensions="jpg png" name="picture" class="form-control {{ $errors->has('picture') ? ' is-invalid' : '' }}"  id="picture" >
                                                @if ($errors->has('picture'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('picture') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="course_zip_file_name">Course File</label><code>(ZIP AND MAX SIZE 50MB)</code>
                                                <input type="file" data-max-file-size="50M" data-default-file="{{asset("storage/".$single->course_zip_file_name)}}" data-allowed-file-extensions="zip" name="course_zip_file_name" class="form-control {{ $errors->has('courseip_file_name_z') ? ' is-invalid' : '' }}"  id="coursip_file_namee_z" >
                                                @if ($errors->has('course_zip_file_name'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('course_zip_file_name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="purpose_en">Course Purpose English</label><small class="req"> *</small>
                                                <textarea required name="purpose_en"   id="purpose_en" class="form-control {{ $errors->has('purpose_en') ? ' is-invalid' : '' }}" placeholder="Course Purpose English" cols="30" rows="10">{{$single->purpose_en}}</textarea>
                                                @if ($errors->has('purpose_en'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('purpose_en') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="purpose_bn">Course Purpose Bangla</label><small class="req"> *</small>
                                                <textarea required name="purpose_bn"  id="purpose_bn" class="form-control {{ $errors->has('purpose_bn') ? ' is-invalid' : '' }}" placeholder="Course Purpose Bangla" cols="30" rows="10">{{$single->purpose_bn}}</textarea>
                                                @if ($errors->has('purpose_bn'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('purpose_bn') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="method_en">Course Method English</label><small class="req"> *</small>
                                                <textarea required name="method_en"  id="method_en" class="form-control {{ $errors->has('method_en') ? ' is-invalid' : '' }}" placeholder="Course Method English" cols="30" rows="10">{{$single->method_en}}</textarea>
                                                @if ($errors->has('method_en'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('method_en') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="method_bn">Course Method Bangla</label><small class="req"> *</small>
                                                <textarea required name="method_bn"   id="method_bn" class="form-control {{ $errors->has('method_bn') ? ' is-invalid' : '' }}" placeholder="Course Method Bangla" cols="30" rows="10">{{$single->method_bn}}</textarea>
                                                @if ($errors->has('method_bn'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('method_bn') }}</strong>
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
                        </div>
                    </div>
                </div> <!-- col -->
            </div> <!-- End row -->
        @endisset
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card mt-4">
                    <div class="card-header bg-primary">
                        <h3 class="card-title text-white">View Courses</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">SL.</th>
                                            <th class="text-center">Course Name English</th>
                                            <th class="text-center">Course Name Bangla</th>
                                            <th class="text-center">Details</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($courses as $key=>$value)
                                            <tr id="{{$value->id}}">
                                                <td class="text-center">{{++$key}}</td>
                                                <td class="text-center">{{$value->name_en}}</td>
                                                <td class="text-center">{{$value->name_bn}}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-primary waves-effect waves-light details" data-toggle="modal" data-id="{{$value->id}}" data-target="#con-close-modal"><i class="mdi mdi-format-list-bulleted-triangle"></i></button>
                                                </td>
                                                <td class="text-center">
                                                    @if(hasPermission("course",EDIT))
                                                    <a  href="{{route("admin.courseEdit",['course_id'=>$value->id])}}"  class="text-white btn btn-primary btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit" id=""><i class="fa fa-edit"></i></a>
                                                    @endif
                                                    @if(hasPermission("course",PUBLISH))
                                                    <a onclick="return confirm('Are You Sure?')" href="{{route("admin.courseControl",['course_id'=>$value->id])}}" title="{{($value->status==1)?"Enable":"Disable"}}" class="btn btn-{{($value->status==1)?"success":"danger"}}   btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View" id=""><i class="fa fa-check-circle"></i></a>
                                                    @endif
                                                    @if(is_super_admin())
                                                    <a onclick="return confirm('Are You Sure?')" href="{{route("admin.courseDelete",['course_id'=>$value->id])}}" title="Delete" class="btn btn-danger  btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View" id=""><i class="fa fa-trash"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- col -->
        </div> <!-- End Row -->

    </div> <!-- container -->
</div>
<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                    <h5 class="modal-title">Course Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-justify"><strong>Course Bangla:</strong> <span id="details_course_name_bn"></span> </p>
                        <p class="text-justify"><strong>Course Name English:</strong> <span id="details_course_name_en"></span> </p>
                        <p class="text-justify mb-2"><strong>Cover Picture:</strong></p>
                        <p class="text-justify mt-0"><img id="details_course_picture" style="height: auto;width:100%"> </p>
                        <p class="text-justify mb-0"><strong>Course Purpose Bangla:</strong></p>
                        <p class="text-justify mt-0"><span id="details_course_purpose_bn"></span> </p>
                        <p class="text-justify mb-0"><strong>Course Purpose English:</strong></p>
                        <p class="text-justify mt-0"><span id="details_course_purpose_en"></span> </p>
                        <p class="text-justify mb-0"><strong>Course Method Bangla:</strong></p>
                        <p class="text-justify mt-0"><span id="details_course_method_bn"></span> </p>
                        <p class="text-justify mb-0"><strong>Course Method English:</strong></p>
                        <p class="text-justify mt-0"><span id="details_course_method_en"></span> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
@push('scripts')
<script src="{{asset("admin/vendors")}}/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset("admin/vendors")}}/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function(){
        datatable();
        function datatable() {
            $('#datatable').dataTable({
                "info":false,
                "autoWidth": false
            });
        }
        $("#datatable").on("click",'.details',function(){
            var id=$(this).data("id");
            $.ajax({
                url:"{{route('admin.coursedetails')}}",
                type:"get",
                dataType:"json",
                data:{"id":id},
                success:function(data){
                    $("#details_course_name_bn").text(data.course.name_bn);
                    $("#details_course_name_en").text(data.course.name_en);
                    $("#details_course_purpose_bn").text(data.course.purpose_bn);
                    $("#details_course_purpose_en").text(data.course.purpose_en);
                    $("#details_course_method_bn").text(data.course.method_en);
                    $("#details_course_method_en").text(data.course.method_bn);
                    $('#details_course_picture').attr('src', data.course.picture);
                }
            });
        });
    });
</script>
@endpush
@endsection
