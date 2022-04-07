@component('mail::message')

Dear, Customer <br>
This is a mail with updates of new added recipe into our website  <br>
Recipe name: {{$content['name']}} <br>
Added by: {{$content['user_name']}}<br>
Method: {{$content['method']}}<br>
@component('mail::button', ['url' => url('http://recipes.dev/recipe/details/'.$content['recipe_id'])])
for more details
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent

