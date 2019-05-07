<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Products</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link rel="stylesheet" href="./css/app.css">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

    </style>
</head>
<body>

<div class="container mt-5">
    <h2>New Product</h2>

    <form action="{{ route('products.store') }}" method="post">
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" name="name" class="form-control" id="product_name">
        </div>
        <div class="form-group">
            <label for="quantity">Quantity in stock</label>
            <input type="number" name="quantity" class="form-control" id="quantity">
        </div>
        <div class="form-group">
            <label for="price">Price per item</label>
            <input type="number" name="price" class="form-control" id="price">
        </div>
        <button type="submit" class="btn btn-primary btn-submit">Add</button>
    </form>

    <hr>
    <h2>Products</h2>
    <table class="table table-striped products">
        <tr>
            <th>Product name</th>
            <th>Quantity in stock</th>
            <th>Price per item</th>
            <th>Datetime submitted</th>
            <th>Total value number</th>
        </tr>
        <tbody id="tbody">
        @foreach($products as $product)
            <tr>
                <td>{{ $product['Product Name'] }}</td>
                <td>{{ $product['Quantity in stock'] }}</td>
                <td>${{ number_format($product['Price per item']) }}</td>
                <td>{{ $product['Datetime submitted'] }}</td>
                <td>${{ number_format($product['Total value number']) }}</td>
            </tr>
        @endforeach
        @if(! count($products))
            <tr class="text-center bg-light">
                <td colspan="5">No Product Yet!</td>
            </tr>
        @endif
        </tbody>
        <tr>
            <td colspan="5" class="text-right"><strong>Total: ${{ number_format($total) }}</strong></td>
        </tr>
    </table>
</div>

<script src="./js/app.js"></script>
</body>
</html>
