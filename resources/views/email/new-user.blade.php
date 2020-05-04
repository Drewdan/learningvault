@component('mail::message')
# Dear {{ $user->name }}

Thank you for signing up for an account. You can now view our full library of learning resources and contribute your own lessons.

# Support Us

This is an open source project, which means no funding, and everything is available for free, even the source code that makes the website work.
You can help us by contributing learning material, reporting issues and bugs, if you are a developer, you could write code to improve the website, or you could make a donation towards the running costs of the website.

For more information on how you can help, please get in touch with our team.

@component('mail::button', ['url' => config('app.url')])
Start Learning Today
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
