@extends('admin.layout.default')
@section('title_area')
Course Complete Report
@endsection
@section('main_section')
<div class="content">
    <div class="container-fulid">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get("class")}} mt-4">{{Session::get("message")}}</div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card mt-4">
                    <div class="card-header bg-primary">
                        <h3 class="card-title text-white">Course Complete Report</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="">
                                    <div class="col-sm-2" style="float:left">
                                        <div class="form-group">
                                            <label for="name">Division</label>
                                            <select name="division_id" id="division_id" data-live-search="true" class="selectpicker form-control">
                                                <option value="">--Select--</option>
                                                @if($divisions)
                                                    @foreach ($divisions as $value)
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2" style="float:left">
                                        <div class="form-group">
                                            <label for="name">District</label>
                                            <select name="district_id" id="district_id" data-live-search="true" class="selectpicker form-control">
                                                <option value="">--Select--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2" style="float:left">
                                        <div class="form-group">
                                            <label for="name">Upazila</label>
                                            <select name="upazilla_id" id="upazilla_id" data-live-search="true" class="selectpicker form-control">
                                                <option value="">--Select--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2" style="float:left">
                                        <div class="form-group">
                                            <label for="name">Designation</label>
                                            <select name="designation_id" id="designation_id" data-live-search="true" class="selectpicker form-control">
                                                <option value="">--Select--</option>
                                                @if($designations)
                                                    @foreach ($designations as $value)
                                                        <option value="{{$value->id}}">{{$value->name_en}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2" style="float:left">
                                        <div class="form-group">
                                            <label for="month">Month</label>
                                            <select name="month" id="month" data-live-search="true" class="selectpicker form-control">
                                                <option value="">--Select--</option>
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2" style="float:left">
                                        <div class="form-group">
                                            <label for="year">Year</label>
                                            <select name="year" id="year" class="selectpicker form-control">
                                                <option value="">--Select--</option>
                                                @for($i=date('Y');$i>=2020;$i--)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2" style="float:left">
                                        <div class="form-group">
                                            <label for="from_date">From</label>
                                            <input type="text" autocomplete="off" name="from_date" id="from_date" placeholder="Select Date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-2" style="float:left">
                                        <div class="form-group">
                                            <label for="to_date">To</label>
                                            <input type="text" autocomplete="off"  name="to_date" id="to_date" placeholder="Select Date" class="form-control">
                                        </div>
                                    </div>
                                </form>
                                    <div class="col-sm-2" style="float:left">
                                        <div class="form-group m-t-30">
                                            <a href="{{ route("admin.courseComplete")}}" class="btn btn-danger">Reset</a>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">SL.</th>
                                                <th class="text-center">Registration Date</th>
                                                <th class="text-center">Course Start Date</th>
                                                <th class="text-center">Completion Date</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Mobile No</th>
                                                <th class="text-center">Age</th>
                                                <th class="text-center">Designation</th>
                                                <th class="text-center">Organization</th>
                                                <th class="text-center">Division</th>
                                                <th class="text-center">District</th>
                                                <th class="text-center">Upzilla</th>
                                                <th class="text-center">Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
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
                    <h5 class="modal-title">User Details</h5>
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


<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
<script src="{{asset("admin/vendors")}}/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset("admin/vendors")}}/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<link href="{{asset("admin")}}/vendors/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet">
<script src="{{asset("admin")}}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<script>
    $(document).ready(function(){
          $('#from_date,#to_date').datepicker({
            format: 'dd-mm-yyyy',
            todayBtn: true,
			todayHighlight: true,
			autoclose: true
        });
        var t="";
        datatable();
        function datatable() {
            var division_id=$("#division_id").val();
            var district_id=$("#district_id").val();
            var upazilla_id=$("#upazilla_id").val();
            var designation_id=$("#designation_id").val();
            var from_date=$("#from_date").val();
            var to_date=$("#to_date").val();
            var month=$("#month").val();
            var year=$("#year").val();
             t=$("#datatable").DataTable({
                dom: 'Bfrtip',
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                ],
                buttons: [
                    'pageLength',
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i> Excel',
                        titleAttr: 'Export to Excel',
                        title: 'Course Participate Report',
                        exportOptions: {
                        columns: ':not(:last-child)',
                        }
                    }
                ],
                responsive: true,
                autoWidth :false,
                processing:true,
                serverSide:true,
                ordering:true,
                ajax: "{{url('')}}/admin/course-complete/view?division_id="+division_id+"&district_id="+district_id+"&upazilla_id="+upazilla_id+"&month="+month+"&year="+year+"&designation_id="+designation_id+"&from_date="+from_date+"&to_date="+to_date,
                columns:[
                       { "data": 'DT_RowIndex',orderable: false},
                        { "data": "registration_date",orderable: true },
                        { "data": "start_date",orderable: true },
                        { "data": "course_complete_date",orderable: true },
                        { "data": "name",orderable: true },
                        { "data": "email" },
                        { "data": "phone_number",orderable: true},
                        { "data": "age",orderable: true},
                        { "data": "designation",orderable: true},
                        { "data": "organization",orderable: true},
                        { "data": "division_name",orderable: true },
                        { "data": "district_name",orderable: true },
                        { "data": "upazilla_name",orderable: true },
                        { "data": "details",orderable:false }
                ]
                });
        }
        $("#datatable").on("click",'.details',function(){
            var id=$(this).data("id");
            $.ajax({
                url:"{{route('admin.completeRegisterUserDetails')}}",
                type:"get",
                dataType:"json",
                data:{"id":id},
                success:function(data){
                    $("#show_details").html(data.html);
                }
            });
        });
        $("#division_id").on("change",function(){
            var division_id=$(this).val();
            $.ajax({
                url:"{{route('admin.districtById')}}",
                type:"get",
                dataType:"json",
                data:{"division_id":division_id},
                success:function(data){
                    $("#district_id").find('option').remove();
                    $("#upazilla_id").find('option').remove();
                    $("#district_id").append('<option value="">--Select--</option>');
                    $.each(data, function(key, value) {
                        $("#district_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    $(".selectpicker").selectpicker('render').selectpicker('refresh');
                }
            });

            t.destroy();
            datatable();
        });
        $("#district_id").on("change",function(){
            var district_id=$(this).val();
            $.ajax({
                url:"{{route('admin.upzillaById')}}",
                type:"get",
                dataType:"json",
                data:{"district_id":district_id},
                success:function(data){
                    $("#upazilla_id").find('option').remove();
                    $("#upazilla_id").append('<option value="">--Select--</option>');
                    $.each(data, function(key, value) {
                        $("#upazilla_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    $(".selectpicker").selectpicker('render').selectpicker('refresh');
                }
            });
            t.destroy();
            datatable();
        });
        $("#upazilla_id,#month,#year,#designation_id,#from_date,#to_date").on("change",function(){
            t.destroy();
            datatable();
        });
    });
</script>
@endpush
@endsection
