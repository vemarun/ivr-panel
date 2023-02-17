@if(Auth::user()->client_type!='client')
{{ header('Location: /logout'); }}
@endif