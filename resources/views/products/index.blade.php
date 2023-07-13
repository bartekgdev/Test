<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>
    <style>
        .alert-success {
            color: green;
        }

        .alert-error {
            color: red;
        }
    </style>
</head>
<body>
<h1>Current Products</h1>

@if ($status)
    <div class="alert-success">
        {{ $status }}
    </div>
@endif

<ul>
    @foreach ($products as $product)
        <li>
            {{ $product->name }}
            <form action="/products/delete" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}"/>
                <button type="submit">delete</button>
            </form>
        </li>
    @endforeach
</ul>

@if ($notification)
    <h2>New Product Notification</h2>
    <div class="alert-success">
        {{ $notification }}
    </div>
@endif

<h2>New product</h2>
<form action="/products/new" method="POST">
    @csrf
    <input type="text" name="name" placeholder="name" value="{{ old('name') }}"/><br />
    <textarea type="text" name="description" placeholder="description">{{ old('description') }}</textarea><br />
    <input type="text" name="tags" placeholder="tags separated by ','" value="{{ old('tags') }}"/><br />
    <button type="submit">Submit</button>
</form>

</body>
</html>
