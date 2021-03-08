@extends('admin.layout.default')
@section('title_area')
    Dashboard
@endsection
@section('main_section')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xl-12 mt-4">
                <div class="card-box">
                    <div class="media">
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
                    <div class="col-sm-3" style="float:left">
                        <div class="form-group m-t-30">
                            <a href="{{ route("dashboard")}}" class="btn btn-danger">Reset</a>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- end card-box-->
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-xl-4">
                <div class="card-box">
                    <div class="media">
                        <div class="avatar-md bg-info rounded-circle mr-2">
                            <i class="ion-md-contacts avatar-title font-26 text-white"></i>
                        </div>
                        <div class="media-body align-self-center">
                            <div class="text-right">
                                <h4 class="font-20 my-0 font-weight-bold"><span data-plugin="counterup" id="register_user">0</span></h4>
                                <p class="mb-0 mt-1 text-truncate">Total Registered User</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-box-->
            </div>
            <div class="col-md-4 col-xl-4">
                <div class="card-box">
                    <div class="media">
                        <div class="avatar-md bg-purple rounded-circle mr-2">
                            <i class="ion-md-contacts avatar-title font-26 text-white"></i>
                        </div>
                        <div class="media-body align-self-center">
                            <div class="text-right">
                                <h4 class="font-20 my-0 font-weight-bold"><span data-plugin="counterup" id="trained_user">0</span></h4>
                                <p class="mb-0 mt-1 text-truncate">Total Attended  User</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-box-->
            </div>
            <div class="col-md-4 col-xl-4">
                <div class="card-box">
                    <div class="media">
                        <div class="avatar-md bg-success rounded-circle mr-2">
                            <i class=" mdi mdi-chart-areaspline-variant avatar-title font-26 text-white"></i>
                        </div>
                        <div class="media-body align-self-center">
                            <div class="text-right">
                                <h4 class="font-20 my-0 font-weight-bold"><span data-plugin="counterup" id="pass_user">0</span></h4>
                                <p class="mb-0 mt-1 text-truncate">Total Passed</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-box-->
            </div>
            <div class="col-md-4 col-xl-4">
                <div class="card-box">
                    <div class="media">
                        <div class="avatar-md bg-primary rounded-circle mr-2">
                            <i class="ion ion-ios-paper avatar-title font-26 text-white"></i>
                        </div>
                        <div class="media-body align-self-center">
                            <div class="text-right">
                                <h4 class="font-20 my-0 font-weight-bold"><span data-plugin="counterup" id="certificate_user">0</span></h4>
                                <p class="mb-0 mt-1 text-truncate">Total Downloaded <br>Certificates</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-box-->
            </div>
        </div>
        <!-- end page title -->
    </div>
    <!-- end container-fluid -->
</div>
<!-- end content -->
@push('scripts')
<script src="{{asset("admin/vendors")}}/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset("admin/vendors")}}/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function(){
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
            getReport();
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

            getReport();
        });
        $("#upazilla_id").on("change",function(){
            getReport();
        });
        getReport();
        function getReport()
        {
            var division_id=$("#division_id").val();
            var district_id=$("#district_id").val();
            var upazilla_id=$("#upazilla_id").val();
            $.ajax({
                url:"{{route('getAnalytics')}}",
                type:"get",
                dataType:"json",
                data:{"division_id":division_id,"district_id":district_id,"upazilla_id":upazilla_id},
                success:function(data){
                    $("#register_user").text(data.getRegisterUser);
                    $("#trained_user").text(data.getTrainedUser);
                    $("#pass_user").text(data.quizTestPassUser);
                    $("#certificate_user").text(data.certificateDownloadUser);
                }
            });
        }
    });
</script>
@endpush
@endsection
