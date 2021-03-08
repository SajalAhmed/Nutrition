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
        <div class="row">
            <div class="col-sm-12">
                <div class="card mt-4">
                    <div class="card-header bg-primary">
                        <h3 class="card-title text-white">View Register User</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="">
                                    <div class="col-sm-3" style="float:left">
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
                                    <div class="col-sm-3" style="float:left">
                                        <div class="form-group">
                                            <label for="name">District</label>
                                            <select name="district_id" id="district_id" data-live-search="true" class="selectpicker form-control">
                                                <option value="">--Select--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3" style="float:left">
                                        <div class="form-group">
                                            <label for="name">Upazila</label>
                                            <select name="upazilla_id" id="upazilla_id" data-live-search="true" class="selectpicker form-control">
                                                <option value="">--Select--</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                                    <div class="col-sm-3" style="float:left">
                                        <div class="form-group m-t-30">
                                            <a href="{{ route("admin.registerUser")}}" class="btn btn-danger">Reset</a>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">SL.</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Registration Date</th>
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
<script src="{{asset("admin/vendors")}}/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset("admin/vendors")}}/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function(){
        var t="";
        datatable();
        function datatable() {
            var division_id=$("#division_id").val();
            var district_id=$("#district_id").val();
            var upazilla_id=$("#upazilla_id").val();
             t=$("#datatable").DataTable({
                lengthMenu: [ 10, 25, 50, 75, 100,500],
                responsive: true,
                autoWidth :false,
                processing:true,
                serverSide:true,
                ordering:false,
                ajax: "{{url('')}}/admin/register-user/view?division_id="+division_id+"&district_id="+district_id+"&upazilla_id="+upazilla_id,
                columns:[
                        { "data": null,orderable : false },
                        { "data": "name" },
                        { "data": "phone_number"},
                        { "data": "email" },
                        { "data": "created_at" },
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
                url:"{{route('admin.registerUserDetails')}}",
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
        $("#upazilla_id").on("change",function(){
            t.destroy();
            datatable();
        });
    });
</script>
@endpush
@endsection
