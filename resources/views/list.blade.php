@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2" id="list">
            <h3>
                {{ $title }}
                <small class="text-muted">List</small>
            </h3>
            @include('partials.table', ['products' => $products, 'class' => 'products'])
        </div>
    </div>
@endsection