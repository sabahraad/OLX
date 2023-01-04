@extends('layouts.app')

@section('content')
<body>
<div class="container ">
        <div class="row">
            <div class="col-md-9 ">
                <div class="card">
                    <div class="card-body">

                                    <h1>Payment Successful</h1>

                                    <p>Go Back To The Home Page</p>

                                    <a class="btn btn-success" href="{{ route('product') }}" role="button">Home</a>
</div>
</div>
</div>
</div>
</div>
</body>
@endsection