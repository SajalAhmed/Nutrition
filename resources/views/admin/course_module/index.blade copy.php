@extends('admin.layout.default')
@section('title_area')
Manage Course Module
@endsection
@section('main_section')
<div class="content">
    <div class="container-fulid">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get("class")}} mt-4">{{Session::get("message")}}</div>
        @endif
        @if(hasPermission("course_module",ADD))
            @isset($add)
                <div class="row">
                    <div class="col-sm-12">
                        <div class="custom-accordion" id="accordionbg">
                            <div class="card mb-1 shadow-none border mt-4">
                                <a href="" class="text-dark collapsed" data-toggle="collapse" data-target="#customborder_collapseOne" aria-expanded="true" aria-controls="customborder_collapseOne">
                                    <div class="card-header bg-primary" id="customborder_headingOne">
                                        <h5 class="card-title text-white m-0">
                                            Manage Course Module
                                            <i class="mdi mdi-minus-circle-outline float-right accor-plus-icon"></i>
                                        </h5>
                                    </div>
                                </a>

                                <div id="customborder_collapseOne" class="collapse" aria-labelledby="customborder_headingOne" data-parent="#accordionbg">
                                    <div class="card-body">
                                        <form id="moduleAdd" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="name">Course Name</label><small class="req"> *</small>
                                                        <select name="course_id" id="course_id" data-live-search="true" class="selectpicker form-control">
                                                            <option value="">--Select--</option>
                                                            @if($courses)
                                                                @foreach ($courses as $value)
                                                                    <option value="{{$value->id}}">{{$value->name_en}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @if ($errors->has('course_id'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('course_id') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="title_bn">Course Module Title Bangla</label><small class="req"> *</small>
                                                        <input type="text" name="title_bn" placeholder="Course Module Title Bangla" class="form-control {{ $errors->has('title_bn') ? ' is-invalid' : '' }}" required id="title_bn" >
                                                        @if ($errors->has('title_bn'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('title_bn') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="title_en">Course Module Title English</label><small class="req"> *</small>
                                                        <input type="text" name="title_en" placeholder="Course Module Title English" class="form-control {{ $errors->has('title_en') ? ' is-invalid' : '' }}" required id="title_en" >
                                                        @if ($errors->has('title_en'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('title_en') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="zip_file_name">Module File</label><small class="req"> *</small><code>(ZIP MAX SIZE 50MB)</code>
                                                        <input type="file" data-max-file-size="50M" data-allowed-file-extensions="zip" name="zip_file_name" class="form-control {{ $errors->has('zip_file_name') ? ' is-invalid' : '' }}" required id="picture" >
                                                        @if ($errors->has('zip_file_name'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('zip_file_name') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="minute">Total Time(Minute)</label><small class="req"> *</small>
                                                        <input type="text" name="minute" placeholder="Total Time (Minute)" class="form-control {{ $errors->has('minute') ? ' is-invalid' : '' }}" required id="minute" >
                                                        @if ($errors->has('minute'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('minute') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div id="session_part">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="session_title">Session Title</label>
                                                                <div class="input-group">
                                                                    <input type="text" name="session_title[]" placeholder="Session Title" class="form-control {{ $errors->has('session_title.*') ? ' is-invalid' : '' }}" id="session_title" >
                                                                    <div class="input-group-btn">
                                                                        <button class="btn btn-info" id="session_add_button" type="button">
                                                                            <i class=" fas fa-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
        @if(hasPermission("course_module",EDIT))
        @isset($edit)
            <div class="row">
                <div class="col-sm-12">
                    <div class="custom-accordion" id="accordionbg">
                        <div class="card mb-1 shadow-none border mt-4">
                            <a href="" class="text-dark" data-toggle="collapse" data-target="#customborder_collapseOne" aria-expanded="true" aria-controls="customborder_collapseOne">
                                <div class="card-header bg-primary" id="customborder_headingOne">
                                    <h5 class="card-title text-white m-0">
                                        Manage Course Module
                                        <i class="mdi mdi-minus-circle-outline float-right accor-plus-icon"></i>
                                    </h5>
                                </div>
                            </a>

                            <div id="customborder_collapseOne" class="collapse show" aria-labelledby="customborder_headingOne" data-parent="#accordionbg">
                                <div class="card-body">
                                    {!! Form::open(['route' =>['admin.courseModuleUpdate', 'course_id'=>$single->id],'files' => true]) !!}
                                     @method("PUT")
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="name">Course Name</label><small class="req"> *</small>
                                                    <input type="text" value="{{$single->name}}" name="name" placeholder="Course Name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" required id="name" >
                                                    <input type="hidden" value="{{$single->id}}" name="id"required id="id" >
                                                    @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
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
                                                    <label for="purpose">Course Purpose</label><small class="req"> *</small>
                                                <textarea required name="purpose" id="purpose" class="form-control {{ $errors->has('purpose') ? ' is-invalid' : '' }}" placeholder="Course Purpose" cols="30" rows="10">{{$single->purpose}}</textarea>
                                                    @if ($errors->has('purpose'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('purpose') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="method">Course Method</label><small class="req"> *</small>
                                                    <textarea required name="method" id="method" class="form-control {{ $errors->has('method') ? ' is-invalid' : '' }}" placeholder="Course Method" cols="30" rows="10">{{$single->purpose}}</textarea>
                                                    @if ($errors->has('method'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('method') }}</strong>
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
                                            <th class="text-center">Course Name</th>
                                            <th class="text-center">Details</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($courses as $key=>$value)
                                            <tr id="{{$value->id}}">
                                                <td class="text-center">{{++$key}}</td>
                                                <td class="text-center">{{$value->name}}</td>
                                                <td class="text-center">
                                                    <p class="d-none">
                                                        <span id="picture">{{asset("storage/".$value->picture)}}</span>
                                                        <span id="name">{{$value->name}}</span>
                                                        <span id="purpose">{{$value->purpose}}</span>
                                                        <span id="method">{{$value->method}}</span>
                                                    </p>
                                                    <button class="btn btn-primary waves-effect waves-light details" data-toggle="modal" data-id="{{$value->id}}" data-target="#con-close-modal"><i class="mdi mdi-format-list-bulleted-triangle"></i></button>
                                                </td>
                                                <td class="text-center" >
                                                    <a  href="{{route("admin.courseModuleEdit",['course_id'=>$value->id])}}"  class="text-white btn btn-primary btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit" id=""><i class="fa fa-edit"></i></a>
                                                    <a onclick="retrn confirm('Are You Sure?')" href="{{route("admin.courseModuleControl",['course_id'=>$value->id])}}" title="{{($value->status==1)?"Enable":"Disable"}}" class="btn btn-{{($value->status==1)?"success":"danger"}}   btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View" id=""><i class="fa fa-check-circle"></i></a>
                                                    @if(is_super_admin())
                                                    <a onclick="return confirm('Are You Sure?')" href="{{route("admin.courseModuleDelete",['course_id'=>$value->id])}}" title="Delete" class="btn btn-danger  btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View" id=""><i class="fa fa-trash"></i></a>
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
                        <p class="text-justify"><strong>Course Name:</strong> <span id="details_course_name"></span> </p>
                        <p class="text-justify mb-2"><strong>Cover Picture:</strong></p>
                        <p class="text-justify mt-0"><img id="details_course_picture" style="height: auto;width:100%"> </p>
                        <p class="text-justify mb-0"><strong>Course Purpose:</strong></p>
                        <p class="text-justify mt-0"><span id="details_course_purpose"></span> </p>
                        <p class="text-justify mb-0"><strong>Course Method:</strong></p>
                        <p class="text-justify mt-0"><span id="details_course_method"></span> </p>
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

        $(".details").on("click",function(){
            var id=$(this).data("id");
            $("#details_course_name").text($("#"+id+" #name").text());
            $("#details_course_purpose").text($("#"+id+" #purpose").text());
            $("#details_course_method").text($("#"+id+" #method").text());
            $('#details_course_picture').attr('src', $("#"+id+" #picture").text());
        });


        $("#moduleAdd").on("submit", function(e) {
				e.preventDefault();
				var url = "{{route('admin.courseModule')}}";
				$.ajax({
					url: url,
					type: "post",
					data: new FormData(this),
					dataType: 'json',
					contentType: false,
					cache: false,
					processData: false,
					beforeSend: function() {
						$("#overlay").fadeIn(300);
					},
					success: function(data) {
                        console.log(data);
						if (data.msg == "success") {
							$.Notification.autoHideNotify('success', 'top right', data.success);
							$("input[type=text]").val('');

							$('.dropify-clear').click();
						} else {
							$.Notification.autoHideNotify('error', 'top right', data.msg);
						}
						$("#overlay").fadeOut(300);
					},
					error:function (e) {
                         var responseMsg = JSON.parse(e.responseText);
                        $.each( responseMsg.errors, function( key, value) {
                            $.Notification.autoHideNotify('error', 'top right',value[0]);
                        });
                    }
				});
			});
    });
</script>
<script>
    $(document).ready(function() {
        var maxField = 10; //Input fields increment limitation
        var addButton = $('#session_add_button'); //Add button selector
        var wrapper = $('#session_part'); //Input field wrapper
        var row = "";
        row += '<div class="session_append">';
             row += '<div class="col-sm-6">';
                 row += '<div class="form-group">';
                     row += '<label for="session_title">Session Title</label>';
                     row += '<div class="input-group">';
                         row += '<input type="text" name="session_title[]" placeholder="Session Title" class="form-control" id="session_title" >';
                         row += '<div class="input-group-btn">';
                             row += '<button class="btn btn-danger remove_button" id="session_add_button" type="button">';
                                 row += '<i class=" fas fa-minus"></i>';
                             row += '</button>';
                         row += '</div>';
                     row += '</div>';
                 row += '</div>';
             row += '</div>';
        row += '</div>';
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function() {
            //Check maximum number of input fields
            if (x < maxField) {
                x++; //Increment field counter
                $(wrapper).append(row); //Add field html
            }

            $(".selectpicker").selectpicker('render').selectpicker('refresh');
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).closest('.session_append').remove(); //Remove field html
            $(".selectpicker").selectpicker('render').selectpicker('refresh');
            x--; //Decrement field counter
        });
    });
</script>
@endpush
@endsection
