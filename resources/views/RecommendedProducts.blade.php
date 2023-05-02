@extends('layouts.app')

@section ('content')

<h2 class="pt-4">YOU MAY LIKE THIS PRODUCTS TOO</h2>
 <div class="row d-flex justify-content-center">
  
  @for($i=0 ; $i< count($recommedMatrixObject) ; $i++)
  @foreach($recommedMatrixObject[$i] as $product)
      <div class="col-lg-3 col-md-6 col-sm-6 col-6 pt-3">
        <div class="card">
          <a href="{{ route('product.show',['product'=>$product->id]) }}">
            <div class="card-body ">
              <div class="product-info">
                <div class="info-1"><img src="{{asset('photo/'.$product->image)}}" alt=""></div>
                <div class="info-4"><h5>{{ $product->brand }}</h5></div>
                <div class="info-2"><a href="product/{{ $product->id }}"><h4>{{ $product->name }}</h4></a></div>
                <div class="info-3"><h5>RM {{ $product->price }}</h5></div>
              </div>
            </div>
          </a>
        </div>
      </div>
    @endforeach
@endfor
      

    
    </div>
 
    @endsection