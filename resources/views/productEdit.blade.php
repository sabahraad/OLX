@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header">product Edit Page</div>
  <div class="card-body">
      
      <form action="{{ route('update') }}" method="post">
        {!! csrf_field() !!}
        <input type="hidden" name="id" id="id" value="{{$input->id}}" id="id" />
        <label>Name</label></br>
        <input type="text" name="product_name" id="name" value="{{$input->product_name}}" class="form-control"></br>
        <label>Price</label></br>
        <input type="text" name="price" id="address" value="{{$input->price}}" class="form-control"></br>
        <label>sellerName</label></br>
        <input type="text" name="sellerName" id="mobile" value="{{$input->sellerName}}" class="form-control"></br>
        <input type="submit" value="Update" class="btn btn-success"></br>
    </form>
   
  </div>
</div>
 
@stop