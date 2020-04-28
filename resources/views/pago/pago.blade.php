@extends('layouts.app',['pageSlug'=>'profile'])
@section('content')
<div class="container text-center mt-4">
    <h1>Ingreso de Saldo</h1>
    <h3>{{ $cantidad=$_REQUEST['cantidad'] }} €</h3>
    <form action="{{route('pago.update',auth()->user())}}" method="POST">
        @csrf
        @method('POST')
        <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{ config('services.stripe.key') }}"
            data-amount="{{$cantidad*100}}"
            data-name="Saldo"
            data-description="Ingresar Saldo"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto"
            data-currency="eur">
        </script>
        <input type="hidden" name="balance" value="{{$_REQUEST['cantidad']}}">
    </form>
</div>
@endsection