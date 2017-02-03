@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-md-5 col-md-offset-1">
                @include('partials.table', ['products' => $cheapest, 'class' => 'cheapest-products'])
            </div>
            <div class="col-md-5 col-md-offset-1">
                @include('partials.table', ['products' => $expensive, 'class' => 'expensive-products'])
            </div>
        </div>
@endsection
