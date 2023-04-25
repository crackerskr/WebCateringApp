<link rel="stylesheet" href="{{asset('style/style.css')}}">

<x-navbar/>

<div class="container">
    <div class="header-container">
        <h2><a href="/order" class="color-a"><i class="fa-solid fa-arrow-left"></i></a>Customer Order</h2>

        @if($order->status == 2)
        <div class="icon-container">    
            <form id="complete" action="{{ url('order/' . $order->id . '/complete') }}" method="POST" style="display:inline">
                @csrf
                @method('PUT')
                <div style="border:none; font-size:30px; cursor:pointer" onclick="completeOrder()"><i class="fa-solid fa-clipboard-check icon-complete" ></i></div>
            </form>

            <form id="cancel" action="{{ url('order/' . $order->id . '/cancel') }}" method="POST" style="display:inline">
                @csrf
                @method('PUT')
                <div style="border:none; font-size:30px; cursor:pointer" onclick="cancelOrder()"><i class="fa-solid fa-ban icon-cancel"></i></div>
            </form>
        </div>
        @endif
    </div>
    <div class="details-card">
        
        <div class="menuContent">
            <div class="menuLabel">
                <h3>Name</h3>
            </div>
            <div class="menuInput">
                <h3>: {{$order->billing_name}}</h3>            
            </div>
        </div>

        <div class="menuContent">
            <div class="menuLabel">
                <h3>Delivery Date</h3>
            </div>
            <div class="menuInput">
                <h3>: {{date('d-m-Y', strtotime($order->delivery_date));}}</h3>            
            </div>
        </div>

        <div class="menuContent">
            <div class="menuLabel">
                <h3>Contact No.</h3>
            </div>
            <div class="menuInput">
                <h3>: {{$order->contact_no}}</h3>            
            </div>
        </div>

        <div class="menuContent">
            <div class="menuLabel">
                <h3>Menu Ordered</h3>
            </div>
            <div class="menuInput">  
            @foreach($menuData as $menu)
                @if($order->menu_id == $menu->id)
                    <h3>: {{$menu->category}} - {{$menu->name}}</h3>  
                @endif
            @endforeach          
            </div>
        </div>

        
        <div class="menuContent">
            <div class="menuLabel">
                <h3>Address</h3>
            </div>
            <div class="menuInput">
                <h3>: {{$order->address}}</h3>            
            </div>
        </div>

        <div class="menuContent">
            <div class="menuLabel">
                <h3>Status</h3>
            </div>
            <div class="menuInput">
                @if($order->status == 1)
                <h3>: Completed <i class="fa-solid fa-circle-check icon-complete"></i></h3> 
                @elseif($order->status ==2)           
                <h3>: Pending <i class="fa-solid fa-spinner icon-pending"></i></h3>
                @else
                <h3>: Cancelled <i class="fa-solid fa-circle-xmark icon-cancel"></i></h3>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function completeOrder(){
    let yesNo = confirm('Are you sure you want to complete this order?');
    if (yesNo){
        document.getElementById('complete').submit();
    }
    }
    function cancelOrder(){
        let yesNo = confirm('Are you sure you want to cancel this order?');
        if (yesNo){
            document.getElementById('cancel').submit();
        }
    }
</script>