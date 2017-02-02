@extends('layouts.app')

@section('content')
        <div class="row">
            @include('partials.table', ['products' => $cheapest, 'class' => 'cheapest-products'])
            @include('partials.table', ['products' => $expensive, 'class' => 'expensive-products'])
        </div>
@endsection
