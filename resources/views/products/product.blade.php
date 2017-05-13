<div class="card product text-left">

@if(Auth::user() && $product->user_id == Auth::user()->id)
<div class="float-right actions">
  <a href="{{ url('/products/'.$product->id.'/edit') }}">Editar</a>
  @include('products.delete', ['product' => $product])
</div>
@endif

  <h1>{{ $product->title }}</h1>
  <div class="row">

    <div class="col-sm-6 col-xs-12">
      @if($product->extension)
        <img src="{{ url("/products/images/$product->id.$product->extension") }}"
             alt="{{ $product->title }}"
             class="product-avatar">
      @endif
    </div>

    <div class="col-sm-6 col-xs-12">
      <p><strong>Descripción</strong></p>
      <p>{{ $product->description }}</p>
      @include('in_shopping_carts.form', ['product' => $product])
    </div>

  </div>
</div>
