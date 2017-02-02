<div class="col-md-5 col-md-offset-1">
    <div class="table-responsive">
        <table id="{{ $class }}" class="table table-hover">
            <thead>
            <tr>
                <th>Image</th>
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
                        <a type="button" class="btn btn-default">
                            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                        </a>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>