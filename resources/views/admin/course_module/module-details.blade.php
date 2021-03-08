<div class="row">
    <div class="col-md-12">
      <p class="text-justify"><strong>Course Name:</strong> <span id="details_course_name">{{$single->course->name_bn}}</span> </p>
        <p class="text-justify"><strong>Course Module Name:</strong> <span id="details_course_name">{{$single->title_bn}}</span> </p>
        @if($single->sessions)
        <p class="text-justify"><strong>Course Module Session:</strong></p>
        <table class="table table-bordered table-striped">
            <tr>
                <td>Session Title </td>
            </tr>
                @foreach ($single->sessions as $value)
                <tr>
                    <td>{{$value->title_bn}}</td>
                </tr>
                @endforeach
            </table>
        @endif
        <p class="text-justify"><strong>Course Module File:</strong></p>
        <iframe src="{{asset("storage/".$single->zip_file_name."/index.html")}}" style="height:300px;width:100%;border:none;"title="Iframe Example"></iframe>
    </div>
</div>
