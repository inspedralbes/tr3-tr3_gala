<x-mail::message>
# Receipt for Your Purchase

Thank you for your purchase. Here are the details:

Session ID: {{ $data['session'] }}

Seats:
@foreach ($data['seats'] as $seat)
- Seat ID: {{ $seat['id'] }}, Price: {{ $seat['price'] }}
@endforeach

Total Price: {{ $data['totalPrice'] }}

<x-mail::button :url="''">
View Purchase
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>