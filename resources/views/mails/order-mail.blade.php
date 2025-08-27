<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ยืนยันคำสั่งซื้อ</title>
</head>
<body>
    <p>สวัสดีค่ะคุณ <b>{{$order->firstname}} {{$order->lastname}}</b></p>
    <p>ทางเราได้รับคำสั่งซื้อสินค้าของคุณเรียบร้อยแล้ว</p>
    <br>

    <table style="width: 600px;">
        <thead>
            <tr>
                <th align="center">ชื่อสินค้า</th>
                <th align="center" style="padding-right:30px;">จำนวน</th>
                <th>ราคา</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
            <tr>
                <td align="left">{{$item->product->name}}</td>
                <td align="center" style="padding-right:30px;">{{$item->qty}}</td>
                <td align="right" style="padding-right:10px;">{{number_format(($item->price * $item->qty), 2)}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2" style="border-top: 1px solid #ccc;" align="right">ราคารวม :</td>
                <td align="right" style="font-size: 16px; font-weight: blod; border-top: 1px solid #ccc; padding-right:10px;">฿{{number_format(($order->subtotal), 2)}}</td>
            </tr>
            <tr>
                <td colspan="2" align="right">ภาษี(7%) :</td>
                <td align="right" style="font-size: 16px; font-weight: blod; padding-right:10px;">฿{{number_format(($order->tax), 2)}}</td>
            </tr>
            <tr>
                <td colspan="2" align="right">ค่าขนส่ง :</td>
                <td align="right" style="font-size: 16px; font-weight: blod; padding-right:10px;">จัดส่งฟรี</td>
            </tr>
            <tr>
                <td colspan="2" align="right">ราคาสุทธิ :</td>
                <td align="right" style="font-size: 16px; font-weight: blod; padding-right:10px;">฿{{number_format(($order->total), 2)}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
