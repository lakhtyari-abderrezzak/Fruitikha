<x-mail::message>
# {{$data['subject']}}

<h3>Name: {{$data['name']}}</h3>
<h3>Email: {{$data['email']}}</h3>
<h3>Phone: {{$data['phone']}}</h3>
<h3>Message: {{$data['contentMessage']}}</h3>

<x-mail::button :url="$url">
New Products
</x-mail::button>

Thanks,<br>
Fruitikha @Support_team
</x-mail::message>
