@extends('layouts.app')

@section('script')
    <script>
        function changeQuantity(event, id , cartName = null) {
            //
            $.ajaxSetup({
                headers : {
                    'X-CSRF-TOKEN' : document.head.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type' : 'application/json'
                }
            })

            //
            $.ajax({
                type : 'POST',
                url : '/cart/quantity/change',
                data : JSON.stringify({
                    id : id ,
                    quantity : event.target.value,
                    cart : cartName,
                    _method : 'patch'
                }),
                success : function(res) {
                    location.reload();
                }
            });
        }

    </script>
@endsection

@section('content')
    <div class="container px-3 my-5 clearfix">
        <!-- Shopping cart table -->
        <div class="card">
            <div class="card-header">
                <h2>سبد خرید</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered m-0">
                        <thead>
                        <tr>
                            <!-- Set columns width -->
                            <th class="text-center py-3 px-4" style="min-width: 400px;">نام محصول</th>
                            <th class="text-center py-3 px-4" style="min-width: 400px;">نام طرح تخفیفی</th>
                            <th class="text-right py-3 px-4" style="width: 150px;">قیمت واحد</th>
                            <th class="text-center py-3 px-4" style="width: 120px;">تعداد</th>
                            <th class="text-right py-3 px-4" style="width: 150px;">قیمت نهایی</th>
                            <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                        </tr>
                        </thead>
                        <tbody>
               
                        @foreach(\Cart::all() as $cart)
                        
                            @if(isset($cart['product']))
                                @php
                                    $product = $cart['product'];
                                @endphp
                                <tr>
                                <td class="p-4">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <a href="#" class="d-block text-dark">{{ $product->title }}</a>
                                            
                                        </div>
                                       
                                    </div>
                                </td>
                               
                                 <td class="p-4 ">
                                 <form action="{{url('discountplans/discountplans/check')}}" method="POST" class="mt-4 d-flex justify-content-between">
                                     @csrf
                                    <input type="hidden"name="productId"  value="{{$product->id}}">
                                     <select name="discountplan">
                                      @foreach($product->discountplans as $discountplan)

                                              <option  value="{{ $discountplan->id }}"
                                              {{$cart['product']->discountplans->pluck('id')->toArray()== $discountplan->id ?'selected':''}}
                                              >{{ $discountplan->name}}</option>
                                           
                                       @endforeach
                                    </select>
                               
                                    <button type="submit" class="btn btn-success mt-3 btn-sm">اعمال تخفیف</button>
                                 </form>
                                </td>
                           
                                <td class="text-right font-weight-semibold align-middle p-4">{{ $product->price  }} تومان</td>
                                <td class="align-middle p-4">
                                    <select onchange="changeQuantity(event, '{{ $cart['id'] }}','mycart')" class="form-control text-center">
                                        @foreach(range(1 , $product->inventory) as $item)
                                            <option value="{{ $item }}" {{  $cart['quantity'] == $item ? 'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </td>
                          
                                <td class="text-right font-weight-semibold align-middle p-4" >
                              تومان {{ 
                                $discountplan->payment_type == "cash"
                                 ?
                                  ($product['price'] * $cart['quantity'] *(1- $cart['discount_percent']))
                                  :
                                  ($product['price'] * $cart['quantity']*(1+$cart['discount_percent'])) 

                                   }}
                                    </td>
                               
                                <td class="text-center align-middle px-0">
                                    <form action="{{ route('cart.destroy' , $cart['id']) }}" id="delete-cart-{{ $product->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <a href="#" onclick="event.preventDefault();document.getElementById('delete-cart-{{ $product->id }}').submit()" class="shop-tooltip close float-none text-danger">×</a>
                                </td>
                            </tr>
                            @endif
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- / Shopping cart table -->
                <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                    
                    <button  type="submit" class="btn btn-lg btn-primary mt-2">پرداخت</button>
                    <div class="d-flex">
{{--                        <div class="text-right mt-4 mr-5">--}}
{{--                            <label class="text-muted font-weight-normal m-0">Discount</label>--}}
{{--                            <div class="text-large"><strong>$20</strong></div>--}}
{{--                        </div>--}}
                        <div class="text-right mt-4">
                            <label class="text-muted font-weight-normal m-0">قیمت کل</label>
                          

                            @php
                                $totalPrice = Cart::all()->sum(function($cart) {
                                    return $cart['product']->price * $cart['quantity'];
                                });
                            @endphp
                            <div class="text-large"><strong>{{ $totalPrice }} تومان</strong></div>
                        </div>
                    </div>
                </div>

               

            </div>
        </div>
    </div>
@endsection