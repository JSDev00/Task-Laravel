<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>{{ $product->getTranslation('name','en')}}</h1>
    <h3>{{ $product->getTranslation('description','en') }}</h3>
    <h3>{{ $product->price }}</h3>
    <h3>{{ $product->quantity }}</h3>
    <h3>{{ $product->category->name }}</h3>


</body>
</html>
