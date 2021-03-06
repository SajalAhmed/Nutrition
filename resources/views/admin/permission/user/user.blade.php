@extends('admin.layout.default')
@section('title_area')
Manage User
@endsection
@section('main_section')
<div class="content">
    <div class="container-fulid">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get("class")}} mt-4">{{Session::get("message")}}</div>
        @endif
        @if(hasPermission("manage_user",ADD))
            @isset($add)
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card mt-4">
                            <div class="card-header bg-primary">
                                <h3 class="card-title text-white">Manage User</h3>
                            </div>
                            <div class="card-body">
                                <form id="user_add">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="name">Name</label><small class="req"> *</small>
                                                <input type="text" name="name" placeholder="Full Name..." class="form-control" required id="name" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="phone">Phone</label><small class="req"> *</small>
                                                <input type="text" name="phone" placeholder="Phone Number" class="form-control" data-mask="(+88) 999-9999-9999" required id="phone" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label for="role_id">Role</label><small class="req"> *</small>
                                                <select id="role_id" required name="role_id" class="form-control selectpicker" data-live-search="true">
                                                    <option value="">--Select--</option>
                                                    <?php if(count($roles)>0): ?>
                                                        <?php foreach($roles as $value):?>
                                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                                        <?php endforeach;?>
                                                    <?php endif;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="username">User Email</label><small class="req"> *</small>
                                                <input type="email" name="email" placeholder="User Email..." class="form-control" required id="username" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="password">Password</label><small class="req"> *</small>
                                                <input type="password" name="password" placeholder="Password..." class="form-control" required id="password" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group pull-left mt-4">
                                                <button name="add_user" type="submit" class="btn btn-primary"><i class="md md-add m-r-5"></i>Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- col -->
                </div> <!-- End row -->
            @endisset
        @endif
        @if(hasPermission("manage_user",EDIT))
            @isset($edit)
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card mt-4">
                            <div class="card-header bg-primary">
                                <h3 class="card-title text-white">Manage User</h3>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['url' => 'user/edit/'.$single->id]) !!}
                                @method("POST")
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="name">Name</label><small class="req"> *</small>
                                                <input type="text" value="{{$single->name}}" name="name" placeholder="Full Name..." class="form-control" required id="name" >
                                                <input type="hidden" value="{{$single->id}}" name="id" class="form-control" required id="id" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="phone">Phone</label><small class="req"> *</small>
                                                <input type="text" value="{{$single->phone}}" name="phone" placeholder="Phone Number" class="form-control" data-mask="(+88) 999-9999-9999" required id="phone" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label for="role_id">Role</label><small class="req"> *</small>
                                                <select id="role_id" required name="role_id" class="form-control selectpicker" data-live-search="true">
                                                    <option value="">--Select--</option>
                                                    @if(count($roles)>0)
                                                        @foreach($roles as $value)
                                                            <option {{$single->role_id==$value->id?"selected":""}} value="{{$value->id}}">{{$value->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="username">User Email</label><small class="req"> *</small>
                                                <input type="email" value="{{$single->email}}" name="email" placeholder="User Email..." class="form-control" required id="username" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" placeholder="Password..." class="form-control"  id="password" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group pull-left mt-4 ">
                                                <button name="edit_user" type="submit" class="btn btn-primary"><i class="md md-add m-r-5"></i>Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
                        <h3 class="card-title text-white">View Users</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">SL.</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Role Name</th>
                                            <th class="text-center">User Email</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Status</th>
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
@push('scripts')
<script src="{{asset("admin/vendors")}}/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset("admin/vendors")}}/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function(){
        $("#user_add").on("submit",function(e){
            e.preventDefault();
            var url="{{url("users")}}";
            $.ajax({
                url:url,
                type:"post",
                dataType:"json",
                data:$(this).serialize(),
                success:function(data){
                    $.Notification.autoHideNotify('success', 'top right',"User Add Successfully");
                    $("input").val('');
                    get_view();
                },
                error:function (e) {
                     var responseMsg = JSON.parse(e.responseText);
                        $.each( responseMsg, function( key, value) {
                            if(value.hasOwnProperty("email"))
                                $.Notification.autoHideNotify('error', 'top right',value.email);
                            if(value.hasOwnProperty("password"))
                                $.Notification.autoHideNotify('error', 'top right',value.password);
                        });
                }
            });
        });
        datatable();
        function datatable() {
            $('#datatable').dataTable({
                "info":false,
                "autoWidth": false
            });

        }
            get_view();
        function get_view()
        {
            $.ajax({
                url:"{{url("users/view")}}",
                type:"get",
                dataType:"json",
                data:{"user":"s"},
                success:function(data){
                    $('#datatable').DataTable().destroy();
                   $("#datatable tbody").html(data.html);
                   datatable();
                }
            });
        }
    });
</script>
@endpush
@endsection
