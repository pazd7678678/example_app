@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
{{--                @foreach($products as $product)--}}
{{--                    --}}
{{--                @endforeach--}}
                @foreach($products->chunk(4) as $row)
                    <div class="row">
                        @foreach($row as $product)
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-image">
                                       
                                             <img src="{{url('images').'/'.$product->image}}" width="280px" height="200px" alt=""/>
                                        </div>
                                        <h5 class="card-title ">{{ $product->title }}</h5>
                                        <p class="card-text">{{ $product->description }}</p>
                                        <div class="d-flex justify-content-between">
                                        <a href="/products/{{ $product->id }}" class="btn btn-primary">جزئیات محصول</a>
                                        @foreach($product->discountplans()->pluck('name') as $discountplan)
                                        <span class="btn-sm btn btn-success">{{$discountplan}}</span>

                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
