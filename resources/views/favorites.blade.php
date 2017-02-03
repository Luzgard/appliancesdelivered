@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('partials.table', ['products' => $favorites, 'class' => 'favorites-products'])
        </div>
    </div>
@endsection