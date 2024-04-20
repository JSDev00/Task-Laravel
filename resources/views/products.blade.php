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
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="container mt-5">
        <div class="row">
            <div>
                <form action="{{ route('search') }}" method="GET">
                    <div class="col-4">

                        <input class="form-control" type="text" name="search" placeholder="search for product"/>
                    </div>
                    <div class="col-6">

                    <button class="btn btn-primary" type="submit">search</button>
                </div>
                </form>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ trans('product.Name') }}</th>
                    <th scope="col">{{ trans('product.Desc') }}</th>
                    <th scope="col">{{ trans('product.Price') }}</th>
                    <th scope="col">{{ trans('product.Quantity') }}</th>
                    <th scope="col">Image</th>
                    <th scope="col">{{ trans('product.Category') }}</th>
                    <th scope="col">{{ trans('product.Actions') }}</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($products as $product)

                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>$ {{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td><img src="{{ asset($product->image) }}" style='width:70px;height:70px;border-radius:50%' alt=""></td>
                        <td>{{  $product->category->name  }}</td>
                        <td>
                            {{-- <a href=""> --}}
                            <button class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#{{ $product->id }}">{{ trans('trans.delete') }}</button>
                            {{-- </a> --}}
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#edit{{ $product->id }}">{{ trans('trans.edit') }}</button>
                            <button class="btn btn-success">
                                <a class="text-white" href="{{ route('print_pdf',$product->id) }}">PDF</a>
                            </button>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">
                                        {{ trans('trans.productDelete') }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ $product->name }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <form action="{{ route('deleteProduct', $product->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-danger">Delete</button>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Update Product Modal --}}

                    <div class="modal fade" id="edit{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Product</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('updateProduct',$product->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                      <div class="row">
                                        <div lass="col-6">
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Product En:</label>
                                                <input required name="product_en" type="text" class="form-control" value="{{ $product->getTranslation('name','en') }}">
                                            </div>

                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Product Ar:</label>
                                                <input required name="product_ar" type="text" class="form-control" value="{{ $product->getTranslation('name','ar')  }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">description En:</label>
                                                <input required name="description_en" type="text" class="form-control" value="{{ $product->getTranslation('description','en') }}">
                                            </div>

                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">description Ar:</label>
                                                <input required name="description_ar" type="text" class="form-control" value="{{ $product->getTranslation('description','ar')  }}">
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Price:</label>
                                                <input required name="product_price" type="text" class="form-control" value="{{ $product->price  }}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Quantity:</label>
                                                <input required name="product_qunatity" type="text" class="form-control" value="{{ $product->quantity  }}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="Category">Category</label>
                                                <select required name="category_id" class="form-control">
                                                    <option value="{{ $product->category->id  }}">{{ $product->category->name  }}</option>
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
                                      </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update Data</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>


        </table>
        @if (count($products) == 0)
            <h1 class="text-center mt-6">No Products</h1>
        @endif
    </div>
    {{ $products->links() }}



</body>

</html>
