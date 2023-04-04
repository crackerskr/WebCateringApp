<link rel="stylesheet" href="{{asset('style/style.css')}}">

<x-navbar/>
<div class="container">
    <div class="header-container">
        <h2>Customer Order</h2>
        <div class="icon-container">
            <i class="fa-solid fa-circle-check icon-complete"></i>
            <h3>Completed</h3>
            <i class="fa-solid fa-spinner icon-pending"></i>
            <h3>Pending</h3>
            <i class="fa-solid fa-circle-xmark icon-cancel"></i>
            <h3>Cancelled</h3>

        </div>
    </div>

    @foreach($orders as $order)
    <a class="color-a" href="{{ url('order/'. $order->id) }}">
        <div class="card">
            <div class="order-card-left">
                <h3>{{$order->billing_name}} {{date('d-m-Y', strtotime($order->delivery_date));}}</h3>
                @foreach($menuData as $menu)
                    @if($order->menu_id == $menu->id)
                        <h4>{{$menu->category}} - {{$menu->name}}</h4>
                    @endif
                @endforeach

            </div>
            <div class="order-card-right">
                @if($order->status == 1)
                    <i class="fa-solid fa-circle-check icon-complete"></i>
                @elseif($order->status == 2)
                    <i class="fa-solid fa-spinner icon-pending"></i>
                @else
                    <i class="fa-solid fa-circle-xmark icon-cancel"></i>
                @endif
            </div>
        </div>
    </a>
    @endforeach
    @if($orders->total() > 3)
        <div style="margin-top:10px; font-size:20px; text-align:end">
        @if($orders->previousPageUrl() != '')
            <a class="color-a" style="text-decoration:none" href="{{$orders->previousPageUrl()}}"><i class="fa-solid fa-arrow-left"></i><span style="margin-right:5px"> Previous </span></a>
        @endif
        @if($orders->nextPageUrl() != '')
            <a class="color-a" style="text-decoration:none" href="{{$orders->nextPageUrl()}}"><span style="margin-left:5px"> Next <i class="fa-solid fa-arrow-right"></i></span></a>
        @endif
        </div>
    @endif
</div>