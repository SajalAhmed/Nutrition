<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{asset("admin/images/logo.png")}}" class="logo" alt="Laravel Logo">
@else
{{-- {{ $slot }} --}}
<img src="{{asset("admin/images/logo.png")}}" class="logo" alt="{{config('app.name')}}">
@endif
</a>
</td>
</tr>
