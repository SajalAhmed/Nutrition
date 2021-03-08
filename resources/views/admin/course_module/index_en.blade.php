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
                                                <div class="col-sm-4">
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
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="minute_en">Total Time English(Minute)</label><small class="req"> *</small>
                                                        <input type="text" name="minute_en" placeholder="Total Time English (Minute)" class="form-control {{ $errors->has('minute_en') ? ' is-invalid' : '' }}" required id="minute_en" >
                                                        @if ($errors->has('minute_en'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('minute_en') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="minute_bn">Total Time Bangla(Minute)</label><small class="req"> *</small>
                                                        <input type="text" name="minute_bn" placeholder="Total Time Bangla (Minute)" class="form-control {{ $errors->has('minute_bn') ? ' is-invalid' : '' }}" required id="minute_bn" >
                                                        @if ($errors->has('minute_bn'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('minute_bn') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="" id="session_part">
                                                        <div class="col-sm-6" style="float: left">
                                                            <div class="form-group">
                                                                <label for="session_title_en">Session Title English</label>
                                                                <input type="text" name="session_title_en[]" placeholder="Session Title English" class="form-control {{ $errors->has('session_title_en.*') ? ' is-invalid' : '' }}" id="session_title" >
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 " style="float: left">
                                                            <div class="form-group">
                                                                <label for="session_title_bn">Session Title Bangla</label>
                                                                <div class="input-group">
                                                                    <input type="text" name="session_title_bn[]" placeholder="Session Title Bangla" class="form-control {{ $errors->has('session_title_bn.*') ? ' is-invalid' : '' }}" id="session_title" >
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
                                                        <button name="" type="submit" class="btn btn-primary add"><i class="md md-add m-r-5"></i>Add</button>
                                                        <button name="" type="button" style="display: none" class="btn btn-info processing"><i class="mdi mdi-spin mdi-loading"></i> Saving</button>
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
                                <form id="moduleEdit" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="name">Course Name</label><small class="req"> *</small>
                                                <select name="course_id" id="course_id" data-live-search="true" class="selectpicker form-control">
                                                    <option value="">--Select--</option>
                                                    @if($courses)
                                                        @foreach ($courses as $value)
                                                            <option {{$single->course_id==$value->id?"selected":""}} value="{{$value->id}}">{{$value->name_en}}</option>
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
                                                <input type="text" name="title_bn" value="{{$single->title_bn}}" placeholder="Course Module Title Bangla" class="form-control {{ $errors->has('title_bn') ? ' is-invalid' : '' }}" required id="title_bn" >
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
                                                <input type="text" name="title_en" value="{{$single->title_en}}" placeholder="Course Module Title English" class="form-control {{ $errors->has('title_en') ? ' is-invalid' : '' }}" required id="title_en" >
                                                <input type="hidden" name="id" value="{{$single->id}}" required >
                                                @if ($errors->has('title_en'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title_en') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="zip_file_name">Module File</label><code>(ZIP MAX SIZE 50MB)</code>
                                                <input type="file" data-max-file-size="50M" data-allowed-file-extensions="zip" name="zip_file_name" class="form-control {{ $errors->has('zip_file_name') ? ' is-invalid' : '' }}"  id="picture" >
                                                @if ($errors->has('zip_file_name'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('zip_file_name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="minute_en">Total Time English(Minute)</label><small class="req"> *</small>
                                                <input type="text" name="minute_en" placeholder="Total Time English (Minute)" value="{{$single->minute_en}}" class="form-control {{ $errors->has('minute_en') ? ' is-invalid' : '' }}" required id="minute_en" >
                                                @if ($errors->has('minute_en'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('minute_en') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="minute_bn">Total Time Bangla(Minute)</label><small class="req"> *</small>
                                                <input type="text" name="minute_bn" value="{{$single->minute_bn}}" placeholder="Total Time Bangla (Minute)" class="form-control {{ $errors->has('minute_bn') ? ' is-invalid' : '' }}" required id="minute_bn" >
                                                @if ($errors->has('minute_bn'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('minute_bn') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="" id="session_part">
                                                @if(count($single->sessions)>0)
                                                    @foreach ($single->sessions as $key=>$value)
                                                        <div class="session_append">
                                                            <div class="col-sm-6" style="float: left">
                                                                <div class="form-group">
                                                                    <label for="session_title_en">Session Title English</label>
                                                                    <input type="text" value="{{$value->title_en}}" name="session_title_en[]" placeholder="Session Title English" class="form-control {{ $errors->has('session_title_en.*') ? ' is-invalid' : '' }}" id="session_title" >
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 " style="float: left">
                                                                <div class="form-group">
                                                                    <label for="session_title_bn">Session Title Bangla</label>
                                                                    <div class="input-group">
                                                                        <input type="text" value="{{$value->title_bn}}" name="session_title_bn[]" placeholder="Session Title Bangla" class="form-control {{ $errors->has('session_title_bn.*') ? ' is-invalid' : '' }}" id="session_title" >
                                                                        <div class="input-group-btn">
                                                                            @if($key==0)
                                                                            <button class="btn btn-info" id="session_add_button" type="button">
                                                                                <i class="fas fa-plus"></i>
                                                                            </button>
                                                                            @else
                                                                            <button class="btn btn-danger" id="remove_button" type="button">
                                                                                <i class="fas fa-minus"></i>
                                                                            </button>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                <div class="col-sm-6" style="float: left">
                                                    <div class="form-group">
                                                        <label for="session_title_en">Session Title English</label>
                                                        <input type="text" name="session_title_en[]" placeholder="Session Title English" class="form-control {{ $errors->has('session_title_en.*') ? ' is-invalid' : '' }}" id="session_title" >
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 " style="float: left">
                                                    <div class="form-group">
                                                        <label for="session_title_bn">Session Title Bangla</label>
                                                        <div class="input-group">
                                                            <input type="text" name="session_title_bn[]" placeholder="Session Title Bangla" class="form-control {{ $errors->has('session_title_bn.*') ? ' is-invalid' : '' }}" id="session_title" >
                                                            <div class="input-group-btn">
                                                                <button class="btn btn-info" id="session_add_button" type="button">
                                                                    <i class=" fas fa-plus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group pull-left mt-4">
                                                <button name="" type="submit" class="btn btn-primary add"><i class="md md-add m-r-5"></i>Update</button>
                                                <button name="" type="button" style="display: none" class="btn btn-info processing"><i class="mdi mdi-spin mdi-loading"></i> Updating</button>
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
                        <h3 class="card-title text-white">View Course Modules</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">SL.</th>
                                            <th class="text-center">Course Name English</th>
                                            <th class="text-center">Course Module Name English</th>
                                            <th class="text-center">Total Time English</th>
                                            <th class="text-center">Details</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                    <h5 class="modal-title">Course Module Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="show_details">

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
            var t=$("#datatable").DataTable({
                lengthMenu: [ 10, 25, 50, 75, 100,500],
                responsive: true,
                autoWidth :false,
                processing:true,
                serverSide:true,
                ordering:false,
                ajax:{
                    url:"{{route('admin.courseModuleView')}}"
                },
                columns:[
                        { "data": null,orderable : false },
                        { "data": "course_id" },
                        { "data": "title_en" },
                        { "data": "minute_en" },
                        { "data": "details",orderable:false },
                        { "data": "action",orderable:false },
                ]
                });
                t.on( 'draw.dt', function () {
                    var PageInfo = $('#datatable').DataTable().page.info();

                    t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                        cell.innerHTML = i + 1 + PageInfo.start;
                    });
                });
        }

        $("#datatable").on("click",'.details',function(){
            var id=$(this).data("id");
            $.ajax({
                url:"{{route('admin.courseModuledetails')}}",
                type:"get",
                dataType:"json",
                data:{"id":id},
                success:function(data){
                    $("#show_details").html(data.html);
                }
            });
        });

            function course_module(url,module)
            {
                $.ajax({
					url: url,
					type: "post",
					data: new FormData(module),
					dataType: 'json',
					contentType: false,
					cache: false,
					processData: false,
					beforeSend: function() {
						$(".processing").fadeIn(300);
						$(".add").hide();
					},
					success: function(data) {
						location.reload();
					},
					error:function (e) {
                         var responseMsg = JSON.parse(e.responseText);
                        $.each( responseMsg.errors, function( key, value) {
                            $.Notification.autoHideNotify('error', 'top right',value[0]);
                        });
                        $(".processing").hide();
						$(".add").show();
                    }
				});
            }
            $("#moduleAdd").on("submit", function(e) {
				e.preventDefault();
				var url = "{{route('admin.courseModule')}}";
                course_module(url,this);
			});
            $("#moduleEdit").on("submit", function(e) {
				e.preventDefault();
				var url = "{{route('admin.courseModuleUpdate')}}";
                course_module(url,this);
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
             row += '<div class="col-sm-6" style="float: left">';
                 row += '<div class="form-group">';
                     row += '<label for="session_title_en">Session Title English</label><span class="req">*</span>';
                     row += '<input type="text" required name="session_title_en[]" placeholder="Session Title English" class="form-control" id="session_title_en" >';
                 row += '</div>';
             row += '</div>';
             row += '<div class="col-sm-6" style="float: left">';
                 row += '<div class="form-group">';
                     row += '<label for="session_title_bn">Session Title Bangla</label><span class="req">*</span>';
                     row += '<div class="input-group">';
                         row += '<input type="text" required name="session_title_bn[]" placeholder="Session Title Bangla" class="form-control" id="session_title_bn" >';
                         row += '<div class="input-group-btn">';
                             row += '<button class="btn btn-danger remove_button" id="session_add_button" type="button">';
                                 row += '<i class=" fas fa-minus"></i>';
                             row += '</button>';
                         row += '</div>';
                     row += '</div>';
                 row += '</div>';
             row += '</div>';
        row += '</div>';
        @if(isset($edit))
            @if($single->sessions!=null)
        	    var x = {{count($single->sessions)}}; //Initial field counter is 1
                @else
                var x=1
    		 @endif
		 @else
        	var x = 1; //Initial field counter is 1
		 @endif

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
