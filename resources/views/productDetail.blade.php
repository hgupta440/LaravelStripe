@extends('layout')
@section('content') 
	@if (session()->has('message'))
		<div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
	@endif
	@if (session()->has('error'))
		<div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
	@endif
    <h3>{{ $product->name }}</h3>
    <p>{{ $product->description }}</p>
    <p>Price ${{ number_format($product->price, 2, '.', ',') }}</p>
   
    <form method="POST" action="{{ route('purchase', $product->id) }}" class="card-form mt-3 mb-3">
	    @csrf
	    <input type="hidden" name="payment_method" class="payment-method">
	    <div class="col-lg-4 col-md-6">
	    	<label class="mb-3">Card Details</label>
	        <div id="card-element"></div>
	    </div>
	    <div id="card-errors" role="alert"></div>
	    <div class="form-group mt-3">
	        <button type="submit" class="btn btn-primary pay">
	            Purchase
	        </button>

	        <a href="{{ route('product') }}" class="btn">Back</a>
	    </div>
	</form>
@endsection


@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    let stripe = Stripe("{{ env('STRIPE_KEY') }}")
    let elements = stripe.elements();
    let card = elements.create('card', {hidePostalCode: true})
    card.mount('#card-element')
    let paymentMethod = null;
    $(document).ready(function(){
	    $('.card-form').on('submit', function (e) {
	        $('button.pay').attr('disabled', true)
	        if (paymentMethod) {
	            return true
	        }
	        stripe.confirmCardSetup(
	            "{{ $intent->client_secret }}",
	            {
	                payment_method: {
	                    card: card
	                }
	            }
	        ).then(function (result) {
	            if (result.error) {
	                $('#card-errors').text(result.error.message)
	                $('button.pay').removeAttr('disabled')
	            } else {
	                paymentMethod = result.setupIntent.payment_method
	                $('.payment-method').val(paymentMethod)
	                $('.card-form').submit()
	            }
	        })
	        return false
	    });
    })
</script>
@endsection
