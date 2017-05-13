@extends('layouts.app')

@section('title', 'Productos Arcoders')

@section('content')
	<div class="container text-center products-container">

		<div class="row">
			@foreach ($products as $product)
				<div class="col-xs-10 col-sm-6">
					@include('products.product', ['product' => $product])
				</div>
			@endforeach
		</div>

		<div>{{ $products->links() }}</div>

	</div>
@endsection
