@component('mail::message')
Someoen liked your post

{{ $liker->name }} liked your post.

@component('mail::button', ['url' => route('users.posts', $liker)])
    view profile
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
