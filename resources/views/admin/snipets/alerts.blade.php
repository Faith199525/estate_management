@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif @if (session('errors'))
<div class="alert alert-danger" role="alert">
    Your form contains errors
</div>
@endif @if (session('error'))
<div class="alert alert-danger" role="alert">
    {{session('error')}}
</div>
@endif
@if (session('message'))
<div class="alert alert-success" role="alert">
    {{session('message')}}
</div>
@endif