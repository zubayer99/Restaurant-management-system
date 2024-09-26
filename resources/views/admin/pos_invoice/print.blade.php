<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        p{
            margin: 0 0 3px;
        }
        #print-wrapper{
            text-align: center;
            width: 400px;
            padding: 10px;
            margin: 0 auto;
            border: 1px solid #000;
        }

        #print-wrapper .header{
            padding: 15px;
            margin: 0 0 10px;
            border: 1px solid #000;
        }

        #print-wrapper .header h4{
            font-size: 23px;
            margin: 0 0 10px;
        }   
        table{
            text-align: left;
            width: 100%;
            margin: 0 0 20px;
            border: 1px solid #000;
        }
        table thead{
            color: #fff;
            background-color: #000;
            /* padding:; */
        }
        th, td{
            padding: 10px;
        }
    </style>
    <script src="{{asset('public/assets/js/jquery.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            window.print();
            
        })
        window.onafterprint = function(){
            history.back(); 
        }
    </script>
</head>
<body>
    <div id="print-wrapper">
        <div class="header">
            @if($siteInfo->logo != '')
            <img src="{{asset('public/site-imges/'.$siteInfo->logo)}}" style="width:100px;margin:0 auto;">
            @endif
            <h4>{{$siteInfo->store_name}}</h4>
            <p>{{$siteInfo->address}}</p>
            <p>{{$siteInfo->email}}</p>
            <p>{{$siteInfo->phone}}</p>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th colspan="3">Order Invoice</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Order No</td>
                    <td>Table No.</td>
                    <td>Date</td>
                </tr>
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->table}}</td>
                    <td>{{date('d M, Y',strtotime($order->created_at))}}</td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <th>Particukars</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order_items as $row)
                <tr>
                    <td>{{$row->food_name}}</td>
                    <td>{{$row->qty}}</td>
                    <td>{{$row->amount/$row->qty}}</td>
                    <td>{{$row->amount}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table>
        @php $g_total = 0; @endphp
            <tr>
                <td>Grand Total:</td>
                <td>{{$order->amount}}</td>
            </tr>
            <tr>
                <td>Tax({{$siteInfo->tax_percent}}%):</td>
                <td>{{$order->tax_amount}}</td>
            </tr>
            <tr>
                <td><b>Net Total</b></td>
                <td><b>{{$order->net_amount}}</b></td>
            </tr>
        </table>
        <p>Powered By {{$siteInfo->store_name}}</p>
    </div>
</body>
</html>