<div class="restaurent-product-list">
    <div class="restaurent-product-detail" data-detail="{{ json_encode($product->data())}}">
        <div class="restaurent-product-left">
            <div class="restaurent-product-title-box">
                <div class="restaurent-product-box">
                    <div class="restaurent-product-title">
                        <h5 class="mb-2" data-toggle="modal" data-target="#restaurent-popup">
                            <a href="javascript:void(0)"
                                class="text-light-black fw-600">{{ $product->data()['name'] ?? ''}}</a>
                        </h5>
                    </div>
                    <div class="restaurent-product-label"></div>
                </div>
                <div class="restaurent-product-rating"></div>
            </div>
            <div class="restaurent-product-caption-box text-light-white limit-line-3 w-100">
                {{ $product->data()['description'] ?? '' }}
            </div>
            @if(!( $product->data()['price']))
                @if(! ($product->data()['sizeWithPrice']))
                    @if(! ($product->data()['extraOption']))
                        <p class="font-weight-bold m-0 mt-2 product-price"></p>
                    @else
                        <?php
                        $min = $max = 0;
                        $extraOption = $product->data()['extraOption'];
                        $firstOption_data = $extraOption[0]['data'];
                        
                        if (isset($firstOption_data[0])) {
                            $min = $firstOption_data[0]['price'];
                            $max = $firstOption_data[0]['price'];
                            
                            for($i = 0; $i < count($firstOption_data); $i ++){
                                if($min > $firstOption_data[$i]['price'])
                                    $min = $firstOption_data[$i]['price'];
                                if($max < $firstOption_data[$i]['price'])
                                    $max = $firstOption_data[$i]['price'];
                            }
                        }


                        if($extraOption[0]['type'] == "checkbox"){
                            $max = 0;
                            for($i = 0; $i < count($firstOption_data); $i ++){
                                $max += $firstOption_data[$i]['price'];
                            }
                        }

                        ?>
                        <p class="font-weight-bold m-0 mt-2 product-price">Price: &nbsp;&nbsp;${{$min}}</p>
                        
                    @endif
                    
                @else
                    <?php $price = $product->data()['sizeWithPrice'][0]['price']; $price_size = $product->data()['sizeWithPrice'][0]['size'];?>
                    @foreach($product->data()['sizeWithPrice'] as $sizeWithPrice)
                        @if($price > $sizeWithPrice['price'])
                            <?php
                                $price = $sizeWithPrice['price'];
                                $price_size = $sizeWithPrice['size'];
                            ?>
                        @endif
                    @endforeach
                    <p class="font-weight-bold m-0 mt-2 product-price">{{$price_size}}: &nbsp;&nbsp;${{$price}}</p>
                @endif
            @elseif(is_numeric( $product->data()['price'] ))
                <?php
                    $price = $product->data()['price'];
                    // if($product->data()['extraOption']) {
                    //     if($product->data()['extraOption'][0]){
                    //         if($product->data()['extraOption'][0]['type'] == 'radio') {
                    //             $price += floatval($product->data()['extraOption'][0]['data'][0]['price']??0);
                    //         }
                    //     }
                    // }
                ?>
                <p class="font-weight-bold m-0 mt-2 product-price">${{$price}}</p>
            @else
                <?php 
                    $price = floatval(str_replace('$', '', $product->data()['price']));
                    // if($product->data()['extraOption']) {
                    //     if($product->data()['extraOption'][0]){
                    //         if($product->data()['extraOption'][0]['type'] == 'radio') {
                    //             $price += floatval($product->data()['extraOption'][0]['data'][0]['price']??0);
                    //         }
                    //     }
                    // }
                ?>
                <p class="font-weight-bold m-0 mt-2 product-price">${{ $price ?? 0 }}</p>
            @endif
            <form
                action="{{ route('app.cart.add-item', ['restaurantId' => $restaurant->id, 'id' => $product->data()['id']]) }}"
                class="add-to-cart-form" method="post">
                @csrf
                <input type="hidden" name="item" value="{{$product->data()['id']}}">
            </form>
            <div
                class="restaurent-product-price">
            </div>
            <div class="restaurent-tags-price">
                <div class="restaurent-tags">
                </div>
                <?php
                    $isFavorite = false;
                    foreach($favorites as $fav) {
                        if($fav['data']->id == $product->data()['id']){
                            $isFavorite = true;
                            break;
                        }
                    }
                ?>

                <span class = "fa fa-heart favorite-icon fav-icon @if($isFavorite) active @endif"></span>
            </div>
        </div>
        <div
            class="restaurent-product-img">
            @if(isset($product->data()['photo']))
                <img
                    src="{{ $product->data()['photo']}}"
                    class="img-fluid"
                    alt="#">
            @endif
        </div>
    </div>
</div>
