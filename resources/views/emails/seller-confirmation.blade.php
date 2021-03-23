@component('mail::message')
    # Hello Dear {{$order->full_name}}, <br>
    {{$order->full_name}} Confirmed Your Order. {{$order->name}} <br>
    Confirmation Date {{$order->updated_at}} <br>
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
