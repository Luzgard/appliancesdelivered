@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-md-5">
                <h3>
                    Most expensive products
                    <small class="text-muted">Top 10</small>
                </h3>
                @include('partials.table', ['products' => $expensive, 'class' => 'cheapest-products'])
            </div>
            <div class="col-md-5 col-md-offset-2">
                <h3>
                    Cheapest products
                    <small class="text-muted">Top 10</small>
                </h3>
                @include('partials.table', ['products' => $cheapest, 'class' => 'expensive-products'])
            </div>
        </div>
@endsection
