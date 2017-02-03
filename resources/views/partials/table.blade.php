<div class="table-responsive">
    <table id="{{ $class }}" class="table table-hover">
        <thead>
        <tr>
            <th>Product</th>
            <th>Name</th>
            <th>Price</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td><img src="/images/{{ $product->image }}" class="img-responsive" alt="{{ $product->name }}"></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->amount }}</td>
                <td>
                    <a href="{{ route('favorite', ['id' => $product->id]) }}" type="button" name="favorite-icon" class="btn btn-default">
                        <span class="glyphicon {{ $product->favoriteClass }}" aria-hidden="true"></span>
                    </a>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>