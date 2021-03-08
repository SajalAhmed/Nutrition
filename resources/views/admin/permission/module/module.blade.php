@extends('admin.layout.default')
@section('title_area')
Module
@endsection
@section('main_section')
<div class="content">
    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get("class")}} mt-4">{{Session::get("message")}}</div>
        @endif
        @if(hasPermission("module",ADD))
            <div class="row">
                @isset($add)
                    <div class="col-sm-4">
                        <div class="card mt-4">
                            <div class="card-header bg-primary">
                                <h3 class="card-title text-white">Root Module</h3>
                            </div>
                            <div class="card-body">
                                <form id="parent_module">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Root Module Name</label><small class="req"> *</small>
                                        <input required name="name" type="text" class="form-control" id="name" placeholder="Enter Top Menu Name">
                                    </div>
                                    <div class="form-group">
                                    <input type="submit" class=" btn btn-primary pull-right" value="Save" name="submit" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- col -->
                @endisset
                @isset($edit_parent)
                <div class="col-sm-4">
                    <div class="card mt-4">
                        <div class="card-header bg-primary">
                            <h3 class="card-title text-white">Root Module</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['url' => "module/edit/$single->id/$cat_id/parent"]) !!}
                            @method("post")
                                <div class="form-group">
                                    <label for="name">Root Module Name</label><small class="req"> *</small>
                                    <input required name="name" value="{{ $single->name }}" type="text" class="form-control" id="name" placeholder="Enter Top Menu Name">
                                </div>
                                <div class="form-group">
                                <input type="submit" class=" btn btn-primary pull-right" value="Save" name="submit" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- col -->
                @endisset
                @isset($add)
                <div class="col-sm-8">
                    <div class="card mt-4">
                        <div class="card-header bg-primary">
                            <h3 class="card-title text-white">Sub Module</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['url' => 'module/add']) !!}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="parent">Select Root Module</label><small class="req"> *</small>
                                            <select name="parent" required class="form-control selectpicker"  data-live-search="true" id="parent">
                                                <option value="">--Select--</option>
                                                @if(!empty($parent_modules))
                                                    @foreach($parent_modules as $value)
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Sub Module / Child Module</label><small class="req"> *</small>
                                            <input required name="name" type="text" class="form-control" id="name" placeholder="Enter  Menu Name">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group m-t-22">
                                        <input type="submit" class=" btn btn-primary pull-right" value="Save" name="submit" />
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div> <!-- col -->
                @endisset
                @isset($edit_submenu)
                    <div class="col-sm-8">
                        <div class="card mt-4">
                            <div class="card-header bg-primary">
                                <h3 class="card-title text-white">Sub Module</h3>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['url' => 'module/edit/'.$single->id]) !!}

                                @method("post")
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="parent">Select Root Module</label><small class="req"> *</small>
                                            <select name="parent" required class="form-control selectpicker"  data-live-search="true" id="parent">
                                                <option value="">--Select--</option>
                                                @if(!empty($parent_modules))
                                                    @foreach($parent_modules as $value)
                                                        <option {{$value->id==$single->permission_group_id?"selected":""}} value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                    @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Sub Module / Child Module</label><small class="req"> *</small>
                                            <input required value="{{$single->name}}" name="name" type="text" class="form-control" id="name" placeholder="Enter  Menu Name">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group m-t-22 m-l-15">
                                        <input type="submit" class=" btn btn-primary pull-right"  value="Save"/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- col -->
                @endisset
            </div> <!-- End row -->
       @endif
        @isset($all_module)
            @if(hasPermission("module",VIEW))
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card mt-4">
                            <div class="card-header bg-primary">
                                <h3 class="card-title text-white">Module Control</h3>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['url' => 'module/moduleUpdate']) !!}
                                 @method("POST")
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Module Name</th>
                                                    <th>Is Active</th>
                                                    <th>C.Module Name</th>
                                                    <th>Enable View</th>
                                                    <th>Enable Add</th>
                                                    <th>Enable Edit</th>
                                                    <th>Enable Delete</th>
                                                    <th>Enable Publish</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($all_module)&&count($all_module)>0)
                                                    @foreach($all_module as $key=>$value)
                                                        <tr>
                                                            <th>
                                                                <input type="hidden" name="group_id[]" value="{{$value['group_id']}}" />
                                                                {{$value['group_name']}}<br />
                                                                <span class="m-l-15"><input value="{{$value['group_id']}}" class="group" type="checkbox"></span>
                                                            </th>
                                                            <td>
                                                            <label class="switch">
                                                                <input class="inputswitch" type="checkbox" {{$value['is_active']=="1"?"checked":""}}  value="{{$value['group_id']}}"  name="onof" data-plugin="switchery" data-color="#3db9dc" />
                                                            </label>
                                                            </td>
                                                            @if (!empty($value['category']))
                                                                    <td>
                                                                        <input type="hidden" name="cat_id[]" value="{{$value['category'][0]->cat_id}}" />
                                                                        {{$value['category'][0]->category_name}}
                                                                    </td>
                                                                    <td>
                                                                        <label class="">
                                                                            <input type="checkbox" class="group_{{$value['group_id']}}" name="{{"enable_view-cat_".$value['category'][0]->cat_id}}" value="{{$value['category'][0]->cat_id}}" {{$value['category'][0]->enable_view==1?"checked":""}} />
                                                                        </label>
                                                                    </td>

                                                                    <td>
                                                                        <label class="">
                                                                        <input type="checkbox" class="group_{{$value['group_id']}}" name="{{"enable_add-cat_" . $value['category'][0]->cat_id}}" value="{{ $value['category'][0]->cat_id}}" {{$value['category'][0]->enable_add==1?"checked":""}} />
                                                                        </label>

                                                                    </td>

                                                                    <td>
                                                                        <label class="">
                                                                        <input type="checkbox" class="group_{{$value['group_id']}}" name="{{"enable_edit-cat_" . $value['category'][0]->cat_id}}" value="{{$value['category'][0]->cat_id}}" {{$value['category'][0]->enable_edit==1?"checked":""}} />
                                                                        </label>
                                                                    </td>

                                                                    <td>
                                                                        <label class="">
                                                                        <input type="checkbox" class="group_{{$value['group_id']}}" name="{{"enable_delete-cat_" . $value['category'][0]->cat_id}}" value="{{$value['category'][0]->cat_id}}" {{$value['category'][0]->enable_delete == 1?"checked":""}} />
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <label class="">
                                                                        <input type="checkbox" class="group_{{$value['group_id']}}" name="{{"enable_publish-cat_" . $value['category'][0]->cat_id}}" value="{{$value['category'][0]->cat_id}}" {{$value['category'][0]->enable_publish == 1?"checked":""}} />
                                                                        </label>
                                                                    </td>
                                                                    <td class="text-center">
                                                                    @if($value['category'][0]->short_code==$value['short_code'])
                                                                        <a  class="btn btn-primary btn-xs " href="{{url("module/edit/". $value['group_id'].'/'.$value['category'][0]->cat_id."/parent")}}"><i class="fa fa-edit"></i></a>
                                                                        <a onclick="return confirm('Are Your sure want to delete this?');" class="btn btn-danger btn-xs " href="{{url("module/delete/". $value['group_id'].'/'.$value['category'][0]->cat_id."/parent")}}"><i class="fa fa-trash"></i></a>
                                                                    @else
                                                                        <a  class="btn btn-primary btn-xs " href="{{url("module/edit/".$value['category'][0]->cat_id)}}"><i class="fa fa-edit"></i></a>
                                                                        <a onclick="return confirm('Are Your sure want to delete this?');" class="btn btn-danger btn-xs " href="{{url("module/delete/".$value['category'][0]->cat_id)}}"><i class="fa fa-trash"></i></a>
                                                                    @endif
                                                                    </td>
                                                                @else
                                                                <td colspan="7"></td>
                                                                @endif
                                                        </tr>
                                                        @if(!empty($value["category"])&& count($value["category"]) > 1)
                                                            @unset($value["category"][0])
                                                            @foreach($value["category"] as $new_feature_key => $new_feature_value)
                                                                <tr>
                                                                    <td>
                                                                    </td>
                                                                    <td>
                                                                    </td>
                                                                    <td>
                                                                        <input type="hidden" name="cat_id[]" value="{{$new_feature_value->cat_id}}" />
                                                                        {{$new_feature_value->category_name}}
                                                                    </td>
                                                                    <td>
                                                                        <label class="">
                                                                            <input type="checkbox" class="group_{{$value['group_id']}}" name="{{"enable_view-cat_" . $new_feature_value->cat_id}}" value="{{$new_feature_value->cat_id}}" {{$new_feature_value->enable_view == 1?"checked":""}} />
                                                                        </label>
                                                                    </td>

                                                                    <td>
                                                                        <label class="">
                                                                        <input type="checkbox" class="group_{{$value['group_id']}}" name="{{"enable_add-cat_" . $new_feature_value->cat_id}}" value="{{$new_feature_value->cat_id}}" {{$new_feature_value->enable_add == 1?"checked":""}} />
                                                                        </label>

                                                                    </td>

                                                                    <td>
                                                                        <label class="">
                                                                        <input type="checkbox" class="group_{{$value['group_id']}}" name="{{"enable_edit-cat_" . $new_feature_value->cat_id}}" value="{{$new_feature_value->cat_id}}" {{$new_feature_value->enable_edit == 1?"checked":""}} />
                                                                        </label>
                                                                    </td>

                                                                    <td>
                                                                        <label class="">
                                                                        <input type="checkbox" class="group_{{$value['group_id']}}" name="{{"enable_delete-cat_" . $new_feature_value->cat_id}}" value="{{$new_feature_value->cat_id}}" {{$new_feature_value->enable_delete == 1?"checked":""}} />
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <label class="">
                                                                        <input type="checkbox" class="group_{{$value['group_id']}}" name="{{"enable_publish-cat_" . $new_feature_value->cat_id}}" value="{{$new_feature_value->cat_id}}" {{$new_feature_value->enable_publish == 1?"checked":""}} />
                                                                        </label>
                                                                    </td>
                                                                    <td class="text-center">
                                                                    @if($new_feature_value->short_code==$value['short_code'])
                                                                        <a  class="btn btn-primary btn-xs " href="{{url("module/edit/". $value['group_id'].'/'.$new_feature_value->cat_id."/parent")}}"><i class="fa fa-edit"></i></a>
                                                                        <a onclick="return confirm('Are Your sure want to delete this?');" class="btn btn-danger btn-xs " href="{{url("module/delete/". $value['group_id'].'/'.$new_feature_value->cat_id."/parent")}}"><i class="fa fa-trash"></i></a>
                                                                    @else
                                                                        <a  class="btn btn-primary btn-xs " href="{{url("module/edit/".$new_feature_value->cat_id)}}"><i class="fa fa-edit"></i></a>
                                                                        <a onclick="return confirm('Are Your sure want to delete this?');" class="btn btn-danger btn-xs " href="{{url("module/delete/".$new_feature_value->cat_id)}}"><i class="fa fa-trash"></i></a>
                                                                    @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn btn-primary" value="Save" name="submit" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- col -->
                </div> <!-- End row -->
            @endif
        @endisset

    </div> <!-- container fluid-->

</div>
@push('scripts')
<script src="{{asset("admin")}}/vendors/switchery/switchery.min.js"></script>
<script>
     !(function (o) {
    "use strict";
    var t = function () {};
        (t.prototype.initSwitchery = function () {
            o('[data-plugin="switchery"]').each(function (t, e) {
                new Switchery(o(this)[0], o(this).data());
            });
        }),
        (t.prototype.init = function () {
            this.initSwitchery();
        }),
        (o.Components = new t()),
        (o.Components.Constructor = t);
    })(window.jQuery),
        (function (t) {
            "use strict";
            window.jQuery.Components.init();
        })();

</script>
    <script>
        $(document).ready(function(){
            $('#parent_module').on('submit',function(e){
                e.preventDefault();
                var url="{{url("module/add_parent")}}";
                $.ajax({
                    url:url,
                    type:"post",
                    dataType:"json",
                    data:$("#parent_module").serialize(),
                    success:function(data){
                        $.Notification.autoHideNotify('success', 'top right', 'Top Menu Add Successfully');
                        $("#name").val('');
                        $("#parent_module #position").val('');
                        if(data.status=true){
                            $("#parent").find('option').remove();
                            $("#parent").append('<option value="">--Select--</option>')
                            $.each(data.value,function(key,value){
                                $("#parent").append('<option value="'+ value.id +'">'+ value.name +'</option>')
                            });
                            $("#parent").selectpicker('render').selectpicker('refresh');
                        }
                    }
                });
            });
            $(".inputswitch").on("click",function(){
                var value=0;
                var id='';
                var url="{{url("module/control")}}";
                if($(this).is(":checked"))
                {
                    value=1;
                    id=$(this).val();
                }
                else{
                    value=0;
                    id=$(this).val();
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: url,
                    data: {'module_id': id,"value":value},
                    dataType: "json",
                    success: function (data) {
                    }
                });
            });
            $("#parent").on("change",function(){
                var parent_id=$(this).val();
                $.ajax({
                    type: "get",
                    url: "{{url("module/get_subparent")}}",
                    data: {'parent_id': parent_id},
                    dataType: "json",
                    success: function (data) {
                        $("#subparent").find('option').remove();
                        $("#subparent").selectpicker("refresh");
                        if(data!=''){
                            $("#subparent").append('<option value="">--Select--</option>')
                            $.each(data,function(key,value){
                                $("#subparent").append('<option value="'+ value.id +'">'+ value.name +'</option>')
                            });
                            $("#subparent").selectpicker('render').selectpicker('refresh');
                        }
                    }
                });
            });
        });
    </script>
    <script>
        $(".group").on("click",function(){
        var group_id=$(this).val();
            $('.group_'+group_id).not(this).prop('checked', this.checked);

        });
    </script>
@endpush
@endsection
