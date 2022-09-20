<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
</head>
<body>
<p>Hi {{$order->first_name}} {{$order->last_name}}</p>
<p>Your Order has been successfully placed</p>
<br>
<table style="width: 600px; text-align: right">
    <thead>
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->orderItems as $item)
        <tr>
            <th><img src="{{$item->product->image}}" width="100"></th>
            <th>{{$item->product->name}}</th>
            <th>{{$item->quantity}}</th>
            <th>{{$item->price * $item->quantity}}</th>
        </tr>
    @endforeach
        <tr>
            <td colspan="3" style="border-top: 1px solid #ccc;"></td>
            <th style="font-size: 15px;font-weight: bold;">Subtotal : ${{$order->subtotal}}</th>
        </tr>
        <tr>
            <td colspan="3" style="border-top: 1px solid #ccc;"></td>
            <th style="font-size: 15px;font-weight: bold;">Tax : ${{$order->tax}}</th>
        </tr>
        <tr>
            <td colspan="3" style="border-top: 1px solid #ccc;"></td>
            <th style="font-size: 15px;font-weight: bold;">Shipping : Free Shipping</th>
        </tr>
        <tr>
            <td colspan="3" style="border-top: 1px solid #ccc;"></td>
            <th style="font-size: 15px;font-weight: bold;">Total : ${{$order->total}}</th>
        </tr>
    </tbody>
</table>
</body>
</html>
