@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $plan->name }}</div>

                    <div class="panel-body">
                        <form action="{{ route('subscription.create') }}" method="post">
                            <div id="dropin-container"></div>
                            <hr>
                            <button type="submit" class="btn btn-default hidden" id="payment-button">Pay</button>
                            <input type="hidden" name="plan" value="{{ $plan->id }}">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://js.braintreegateway.com/js/braintree-2.26.0.min.js"></script>

    <script>
        $.ajax({
            url: '{{ route('braintree.token') }}'
        }).success(function (response) {
            braintree.setup(response.data.token, 'dropin', {
                container: 'dropin-container',
                onReady: function () {
                    $('#payment-button').removeClass('hidden');
                }
            });
        });
    </script>
@endsection
