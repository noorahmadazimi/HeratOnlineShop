@extends('layouts.app')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>

    @elseif (session('status2'))
    <div class="alert alert-danger">
        {{ session('status2') }}
    </div>
@endif


@section ('content')

<div class="container p-0 show">
   <div class="row sixtyvh">
       <div class="col-lg-8 col-sm-12 mb-3 show-picture">
            <img src="{{asset('photo/'.$product->image)}}" alt="">

       </div>
       <div class="col-lg-4 col-sm-12 pl-5 pr-5">
        <h6><strong>{{ $product->brand }}</strong></h6>
        <h5>{{ $product->name }}</h5>
        <div class="rating">
            <span> {{$productRate->count()}} Rating</span>
            @php $starNum = number_format($ratingValue) @endphp

            @for($i=1 ; $i<= $starNum ; $i++)
            <i class="fa fa-star checked"></i>
            @endfor

            @for($j=$starNum+1 ; $j<= 5 ; $j++)
            <i class="fa fa-star"></i>
            @endfor

        </div>
         

            <!-- Modal -->
<div class="modal fade" id="rateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{url('/addRating')}}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{$product->id}}">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">RATE {{$product->name}}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="rating-css">
    <div class="star-icon">
        <input type="radio" value="1" name="product_rating" checked id="rating1">
        <label for="rating1" class="fa fa-star"></label>
        <input type="radio" value="2" name="product_rating" id="rating2">
        <label for="rating2" class="fa fa-star"></label>
        <input type="radio" value="3" name="product_rating" id="rating3">
        <label for="rating3" class="fa fa-star"></label>
        <input type="radio" value="4" name="product_rating" id="rating4">
        <label for="rating4" class="fa fa-star"></label>
        <input type="radio" value="5" name="product_rating" id="rating5">
        <label for="rating5" class="fa fa-star"></label>
    </div>
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>


       
            <div class="card">
                <div class="card-body">
                    <div class="show-info">
                        <div class="info-1">
                            <h6>BUY NEW</h6>
                        </div>
                        <div class="info-2">
                            <select id="size-dropdown">
                                <option selected="true" value="nothing" disabled hidden>Choose size</option>
                                @foreach($sizes as $size)
                                    @if($size->quantity > 0)
                                        <option value="{{ $size->name }}">{{ $size->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="info-3">
                            <p>This product is pre-verified, and will be ready to ship instantly. Expedited shipping options will be available in checkout.
                            </p>
                        </div>
                        <a href="{{ route('cart.add',['product'=>$product->id]) }}" id="add-to-cart" class="add-to-cart disabled">
                            <div class="info-4">
                                ADD TO CART
                            </div>
                        </a>
                        <button type="button" class="btn info-4 mt-2" data-toggle="modal" data-target="#rateModal">
                                RATE THIS PRODUCT
                        </button>

                    </div>
                </div>
            </div>
        </div>
   </div>
</div>


@endsection


