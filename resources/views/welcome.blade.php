<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
   <div class="container mt-5">
   <div class="row">
    <div class="col-6">
        <ul>
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li>
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                </li>
            @endforeach
        </ul>


    </div>
    <div class="col-6">
        <a href="{{ route('Allproducts') }}" class="btn btn-primary mt-6">{{ trans('trans.Show') }}</a>
        <a href="{{ route('category') }}" class="btn btn-primary mt-6">{{ trans('product.cate') }}</a>
    </div>
   </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



       <form action="{{ route('products') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
   <div class="row">
    {{-- Product En --}}

    <div class="col-6">
        <div class="mb-3">
            <label for="En">{{ trans('trans.productEn') }}</label>
            <input required name="product_en"   type="text" class="form-control" id="En" placeholder="Product Name En">
          </div>

    </div>
    {{-- Product Ar --}}
    <div class="col-6">
        <div class="mb-3">
            <label for="Ar">{{ trans('trans.productAr') }}</label>
            <input required name="product_ar"  type="text" class="form-control" id="Ar" placeholder="Product Name Ar">
          </div>

    </div>
    {{-- Description En --}}
    <div class="col-6">
        <div class="mb-3">
            <label for="En">{{ trans('trans.DescEn') }}</label>
            <input required name="desc_en"  type="text" class="form-control" id="En" placeholder="Description Name En">
          </div>

    </div>
    {{-- Description Ar --}}
    <div class="col-6">
        <div class="mb-3">
            <label for="Ar">{{ trans('trans.DescAr') }}</label>
            <input required name="desc_ar"  type="text" class="form-control" id="Ar" placeholder="Description Name Ar">
          </div>

    </div>
    {{-- Price --}}
    <div class="col-3">
        <div class="mb-3">
            <label for="Price">{{ trans('trans.Price') }}</label>
            <input required name="price"  type="number" min="1" class="form-control" id="Price" placeholder="Price">
          </div>


    </div>
    {{-- Quantity  --}}
    <div class="col-3">
        <div class="mb-3">
            <label for="Quantity">{{ trans('trans.Quantity') }}</label>
            <input required name="quantity"  type="number" min="1" class="form-control" id="Quantity" placeholder="Quantity">
          </div>


    </div>

    {{-- Category  --}}
    <div class="col-3">
        <div class="mb-3">
            <label for="Category">{{ trans('trans.Category') }}</label>
            <select required  class="form-control" name="category" id="Category">
                <option value="" disabled>Category</option>
                @foreach ($categories as $category)

                <option value="{{ $category->id }}" >{{ $category->name }}</option>
                @endforeach
            </select>
        </div>


    </div>
    {{-- Image --}}
    <div class="col-3">
        <div class="mb-3">
            <label for="image">{{ trans('product.Upload') }}</label>
            <input type="file" name="image" class="form-control">
        </div>
    </div>
    <button class="btn btn-info" type="submit">{{ trans('trans.Save') }}</button>



</div>
</form>

</div>

</body>
</html>
