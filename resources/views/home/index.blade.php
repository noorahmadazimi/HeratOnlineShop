@extends('layouts.app')

@section ('content')

<div class="container p-0">
  @if(Session::has('success'))
  <div class="row">
    <div class="col-12">
      <div id="charge-message" class="alert alert-success">
        {{ Session::get('success') }}
      </div>
    </div>
  </div>
  @endif
  <h2 class="pt-4">NEW RECOMMENDED PRODUCTS</h2>
<div id="demo" class="carousel slide" data-ride="carousel">

<!-- Indicators -->
<ul class="carousel-indicators">
  <li data-target="#demo" data-slide-to="0" class="active"></li>
  <li data-target="#demo" data-slide-to="1"></li>
  <li data-target="#demo" data-slide-to="2"></li>
</ul>

<!-- The slideshow -->
<div class="carousel-inner">
  
@for($j = 0 ; $j< count($productss) ; $j++)
        @foreach($productss[$j] as $product)

  <div class="carousel-item {{$product['id'] ==1 ? 'active' : ''}}">
  <div class="row d-flex justify-content-center">
  
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
            
       


    </div>
  </div>

  @endforeach
  @endfor
</div>

<!-- Left and right controls -->
<a class="carousel-control-prev bg-info" href="#demo" data-slide="prev">
  <span class="carousel-control-prev-icon"></span>
</a>
<a class="carousel-control-next bg-info" href="#demo" data-slide="next">
  <span class="carousel-control-next-icon"></span>
</a>

</div>



        <!-- CATEGORY [S]-->
        <div class="row m-0 pt-4">
          <div class="col-lg-4 col-sm-12 d-flex flex-column align-items-center categorywrapper">
            <a href="{{ route('product.index') }}">
              <div class="category">
                <img class="" height="200px" src="{{ asset('photo/shoes.png') }}" alt="">
                <h5 class="pt-2">MEN</h5>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-12 d-flex flex-column align-items-center categorywrapper">
            <a href="{{ route('product.index') }}">
              <div class="category">
                <img class="" height="200px" src="{{ asset('photo/shirt.png') }}" alt="">
                <h5 class="pt-2">CLOTHING</h5>
            </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-12 d-flex flex-column align-items-center categorywrapper">
            <a href="{{ route('product.index') }}">
              <div class="category">
                <img class="" height="200px" src="{{ asset('photo/bag.png') }}" alt="">
                <h5 class="pt-2">ACCESORIES</h5>
              </div>
            </a>
          </div>
        </div>
        <!-- CATEGORY [E]-->

    <!-- FEATURED SHOES [S]-->
    <h2 class="pt-4">NEW ADDED PRODUCTS</h2>
    <div class="row d-flex justify-content-center">
      

  @foreach ($products as $product)    
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

    </div>
    <!-- FEATURED SHOES [E]-->

    <!-- ADVANTAGE [S]-->
    <h2 class="pt-4">OUR PROMISE'S</h2>
    <div class="row m-0 pt-4">
    <a href="/facModel">
    <div class="col-lg-4 col-sm-12 d-flex flex-column align-items-center advantagewrapper">
        <img class="" height="80px" src="{{ asset('photo/delivery2.svg') }}" alt="">
          <h4>RECOMMENDED PRODUCTS</h4>
      </div>
    </a>
      <div class="col-lg-4 col-sm-12 d-flex flex-column align-items-center advantagewrapper">
        <img class="" height="80px" src="{{ asset('photo/guarantee.svg') }}" alt="">
          <h4>PREMIUM AND ORIGINAL</h4>
      </div>
      <div class="col-lg-4 col-sm-12 d-flex flex-column align-items-center advantagewrapper">
        <img class="" height="80px" src="{{ asset('photo/support.svg') }}" alt="">
          <h4>24/7 CUSTOMER SUPPORT</h4>
      </div>
    </div>
    <!-- ADVANTAGE [E]-->

</div>

@endsection