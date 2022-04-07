@component('mail::message')
# Introduction

we have recieved a request for reset password.

@component('mail::button', ['url' => url('http://recipes.dev/password/reset/'.$data['token'])])
Click here to reset password Now
@endcomponent

Thanks,<br>
Recipes-online
@endcomponent