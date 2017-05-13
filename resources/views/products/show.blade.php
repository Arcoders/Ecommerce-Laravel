@extends('layouts.app')

@section('title', 'Productos Arcoders')

@section('content')
	<div class="container text-center">
		@include('products.product', ['product' => $product]);
	</div>
@endsection
