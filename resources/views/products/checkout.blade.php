@extends('layouts.app')

@section('content')
<div id="page-content" class="page-content">
    <div class="banner">
        <div class="jumbotron jumbotron-bg text-center rounded-0" style="margin-top: -25px; background-image: url('{{asset('assets/img/header2.png')}}');">
            <div class="container">
                <h1 class="pt-5">
                    Checkout
                </h1>
                <p class="lead">
                    Be gamer with us
                </p>
            </div>
        </div>
    </div>

    <section id="checkout">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7">
                    <h5 class="mb-3">BILLING DETAILS</h5>
                    <!-- Bill Detail of the Page -->
                    <form action="{{route('products.proccess.checkout')}}" method="POST" class="bill-detail">
                        <fieldset>
                            @csrf
                            <div class="form-group row">
                                <div class="col">
                                    <input class="form-control" name='name' placeholder="Name" type="text">
                                </div>
                                <div class="col">
                                    <input class="form-control"  name='last_name' placeholder="Last Name" type="text">
                                </div>
                            </div>
                            {{--<div class="form-group">
                                <input class="form-control" placeholder="Company Name" type="text">
                            </div>--}}
                            <div class="form-group">
                                <textarea class="form-control"  name='address' placeholder="Address"></textarea>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name='regions' placeholder="regions" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name='city' placeholder="city" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control"  name='code_postal' placeholder="code postal" type="text">
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <input class="form-control"  name='email' placeholder="Email Address" type="email">
                                </div>
                                <div class="col">
                                    <input class="form-control"  name='phone' placeholder="Phone Number" type="tel">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <input class="form-control" name='user_id' value="{{Auth::user()->id}}"  type="hidden" placeholder="user_id" type="text">
                                </div>
                                <div class="col">
                                    <input class="form-control" name='price' value="{{ $checkoutSubtotal + 59}}" type="hidden">
                                </div>
                            </div>
                          
                            <div class="form-group">
                                <textarea class="form-control" name='order_notes' placeholder="Order Notes"></textarea>
                            </div>

                            
                        </fieldset>
                        <div class="form-group">
                            <button class="btn btn-primary" style="width: 80px; hight: 40px;" name='submit' type="submit" >submit</button>
                        </div>
                    </form>
                    <!-- Bill Detail of the Page end -->
                </div>
                <div class="col-xs-12 col-sm-5">
                    <div class="holder">
                        <h5 class="mb-3">YOUR ORDER</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Products</th>
                                        <th class="text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $product)
                                        <tr>
                                            <td>
                                                {{ $product->name }} x {{ $product->qty }}
                                            </td>
                                            <td class="text-right">
                                                USD {{ $product->subtotal }}
                                            </td>
                                        </tr>
                                    @endforeach
                               
                                  
                                </tbody>
                                <tfooter>
                                    <tr>
                                        <td>
                                            <strong>Cart Subtotal</strong>
                                        </td>
                                        <td class="text-right">
                                            USD {{ $checkoutSubtotal }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Shipping</strong>
                                        </td>
                                        <td class="text-right">
                                            USD 59
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>ORDER TOTAL</strong>
                                        </td>
                                        <td class="text-right">
                                            <strong>USD {{ $checkoutSubtotal + 59 }}</strong>
                                        </td>
                                    </tr>
                                </tfooter>
                            </table>
                        </div>

                     
                    </div>
                    <p class="text-right mt-3">
                        <input checked="" type="checkbox"> I’ve read &amp; accept the <a href="#">terms &amp; conditions</a>
                    </p>
                    <a href="#" class="btn btn-primary float-right">PROCEED TO CHECKOUT <i class="fa fa-check"></i></a>
                    <div class="clearfix">
                </div>
            </div>
        </div>
    </section>
</div>

@endsection