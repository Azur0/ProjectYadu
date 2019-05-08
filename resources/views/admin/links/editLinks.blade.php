@extends('layouts/admin/app')

@section('content')

<h1>Edit Links</h1>
<form action="/admin" method="post">
    @csrf
    <div class="inputFields">
   
    </div>
    <input type="submit" value="submit" class="btn btn-primary submit-edit">
</form>

@endsection