@component('mail::message')
# Your post was liked!

{{$liker->username}} has liked one of your posts!

@component('mail::button', ['url' => route('show_post', $post)])
View Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
