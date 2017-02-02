<div class="col-md-5 col-md-offset-1">
    <div class="table-responsive">
        <table id="{{ $class }}" class="table table-hover">
            <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Wish list</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td><img src="{{ $product->image }}" class="img-responsive" alt="{{ $product->name }}"></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td><a class="button button-primary" href="/add">Add to wish list</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>