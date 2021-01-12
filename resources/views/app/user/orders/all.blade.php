@extends('layouts.app')

@section('title')
    <title>Chekout | Past Orders</title>
@endsection

@section('content')
    <div class="most-popular section-padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 offset-1 browse-cat border-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-header-left">
                                <h3 class="text-light-black header-title title-2">Past Orders</h3>
                            </div>
                        </div>
                        @if(count($orders) > 0)
                            <div class="col-12">
                                @foreach($orders as $order)
                                     <div class="product-list-view">
                                        <div class="product-right-col">
                                            <p>
                                                Order #<b><a href="{{ route('app.user.order.show', ['id' => $order['order_id']]) }}" class = "text text-primary">{{ $order['order_id'] }}</a></b>
                                            </p>
                                            <p class="product-list-details">
                                                <b>Total Cost: ${{ isset($order['taxes_and_fees']) && isset($order['subtotal']) && is_numeric($order['taxes_and_fees']) && is_numeric($order['subtotal'])? number_format($order['taxes_and_fees'] + $order['subtotal'], 2) : number_format(0, 2) }}</b>
                                                <span>
                                                @foreach($order['products'] as $product)
                                                {{ $product['quantity'] }} X {{ $product['name'] }} <br>
                                                @endforeach
                                                </span>
                                                <a href="{{ route('app.user.order.show', ['id' => $order['order_id']]) }}" class="badge @if($order['status'] == 'Order Placed') badge-success @else badge-warning @endif" style="font-size: 14px">{{ $order['status']?? "Pending" }}</a>
                                            </p>
                                            <div class="product-list-details">
                                                <span>Ordered Date: {{ $order['created_at']->toFormattedDateString() ?? '00:00' }} at {{ $order['created_at_time'] ?? '00:00' }} ET</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="col-12">
                                <div class="alert alert-info">
                                    You haven't ordered anything yet!
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Browse by category -->

@endsection
