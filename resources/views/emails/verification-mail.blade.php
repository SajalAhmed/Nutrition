@component('mail::message')
# Introduction

Your code is: {{$user->verify_code}}

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
