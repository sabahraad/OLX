@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('OLX') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container ">
       
                    <div class="card-body">
                        <h2>Product</h2>
                        <form class="row g-3 " action= "/pay" method="post">
                        @csrf
                        <div class="col-12 ">
                            <label for="inputAddress2" class="form-label">Buy a product</label>
                           </div>
                        <div class="row g-3">
                        <label for="inputamount" class="from-label" value="">price -789</label>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="sd" value="submit" class="btn btn-primary">Pay</button>
                           
                        </div>
                        </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
