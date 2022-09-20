<div>
    @foreach($product->attributeValues->unique('product_attribute_id') as $item)
        <div class="row" style="margin-top: 20px">
            <div class="col-xs-2">
                <p>{{$item->productAttributes->name}}</p>
            </div>
            <div class="col-xs-10">
                <select class="form-control" style="width: 200px"
                        wire:model="attributes.{{$item->productAttributes->name}}">
                    <option value="">Choose One</option>
                    @foreach($item->productAttributes->attributeValues->where('product_id' , $product->id) as $value)
                        <option value="{{$value->value}}">{{$value->value}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endforeach
    <div class="quantity" style="margin-top: 10px">
        <span>Quantity:</span>
        <div class="quantity-input">
            <input type="text" name="product-quatity" value="1" data-max="120" pattern="[0-9]*" wire:model="qty">
            <a class="btn btn-reduce" href="#" wire:click.prevent="decreaseQuantity"></a>
            <a class="btn btn-increase" href="#" wire:click.prevent="increaseQuantity"></a>
        </div>
    </div>
    <div class="wrap-butons">
        @if ($product->sale_price !== null && $sale->status == 1 && $sale->sale_date > \Carbon\Carbon::now())
            <a href="#" class="btn add-to-cart"
               wire:click.prevent="store({{ $product->id }} ,'{{ $product->name }}' , {{ $product->sale_price }})">Add
                To Cart</a>
        @else
            <a href="#" class="btn add-to-cart"
               wire:click.prevent="store({{ $product->id }} ,'{{ $product->name }}' , {{ $product->regular_price }})">Add
                To Cart</a>
        @endif
        <div class="wrap-btn">
            <a href="#" class="btn btn-compare">Add Compare</a>
            <a href="#" class="btn btn-wishlist">Add Wishlist</a>
        </div>
    </div>
</div>
