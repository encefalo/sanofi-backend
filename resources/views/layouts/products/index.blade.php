@extends('layouts.mainlayout')
@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <h1><i class="far fa-newspaper"></i>Producto</h1>
            @forelse($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <div class="card-body">
                            <i class="glyphicon glyphicon-calendar"></i> {{ $product->createdtime }}
                            <p class="card-text">{{ $product->productname }}</p>
                            <p class="card-text">{{ $product->cf_1231 }} - {{ $product->cf_1558 }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a type="button" href="{{route('products.edit', ['id'=>$product->id])}}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    No products
                </div>
            @endforelse
        </div>
    </div>
@endsection
