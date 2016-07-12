@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Plans</div>

                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach ($plans as $plan)
                                <li class="list-group-item clearfix">
                                    <div class="pull-left">
                                        <h4>{{ $plan->name }}</h4>
                                        <h4>£{{ number_format($plan->cost, 2) }} monthly</h4>
                                        @if ($plan->description)
                                            <p>{{ $plan->description }}</p>
                                        @endif
                                    </div>

                                    @if (!Auth::user()->subscribedToPlan($plan->braintree_plan, 'main'))
                                        <a href="{{ route('plans.show', $plan->slug) }}" class="btn btn-default pull-right">Choose</a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
