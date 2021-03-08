
@section('flash_message')
    @if(Session::has('message'))
        <div class="alert alert-{{Session::get("class")}} mt-4">{{Session::get("message")}}</div>
    @endif
@endsection