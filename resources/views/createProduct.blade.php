@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header">Create Page</div>
  <div class="card-body">
      
      <form action="{{ route('add') }}" method="post">
        {!! csrf_field() !!}
        <label>Name</label></br>
        <input type="text" name="product_name" id="name" class="form-control"></br>
        <label>Price</label></br>
        <input type="text" name="price" id="address" class="form-control"></br>
        <label>seller Name</label></br>
        <input type="text" name="sellerName" id="mobile" class="form-control"></br>
        <input type="submit" value="Save" class="btn btn-success"></br>
    </form>
   
  </div>
</div>
 
@stop