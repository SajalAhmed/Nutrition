<div class="row">
    <div class="col-md-12">
      <p class="text-justify"><strong>Registration Date:</strong> <span id="details_course_name">{{date('d-m-Y',strtotime($single->created_at))}}</span> </p>
      <p class="text-justify"><strong>Completion Date:</strong> <span id="details_course_name">{{date('d-m-Y',strtotime($single->quiz->created_at))}}</span> </p>
      <p class="text-justify"><strong>Name:</strong> <span id="details_course_name">{{$single->name}}</span> </p>
        <p class="text-justify"><strong>Email:</strong> <span id="details_course_name">{{$single->email}}</span> </p>
        <p class="text-justify"><strong>Phone:</strong> <span id="details_course_name">{{$single->phone_number}}</span> </p>
        <p class="text-justify"><strong>Affiliated:</strong> <span id="details_course_name">{{$single->affiliated?$single->affiliated->name_en:"N/A"}}</span> </p>
        <p class="text-justify"><strong>Gender:</strong> <span id="details_course_name">{{genderDAE($single->gender)}}</span> </p>
        <p class="text-justify"><strong>Designation:</strong> <span id="details_course_name">{{$single->designation?$single->designation->name_en=="Other"?$single->designation_other:$single->designation->name_en:"N/A"}}</span> </p>
        <p class="text-justify"><strong>Organization:</strong> <span id="details_course_name">{{$single->organization}}</span> </p>
        <p class="text-justify"><strong>Age:</strong> <span id="details_course_name">{{$single->age}}</span> </p>
        <p class="text-justify"><strong>Division:</strong> <span id="details_course_name">{{$single->upazilla->district->division->name}}</span> </p>
        <p class="text-justify"><strong>District:</strong> <span id="details_course_name">{{$single->upazilla->district->name}}</span> </p>
        <p class="text-justify"><strong>Upazila:</strong> <span id="details_course_name">{{$single->upazilla->name}}</span> </p>

    </div>
</div>
