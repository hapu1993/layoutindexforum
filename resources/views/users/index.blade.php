@extends('layouts.master')

@section('content')

<div class="container pb-5 pt-5" style="height: 100%">
<table id="myTable" class="display">
    <thead>
        <tr>
        	<th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>	


</div>

@include('users.edit')
@endsection

