<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
   <div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row">
        <div class="col-6">
            <div class="mt-3">
                <form action="{{ route('Addcategory') }}" method="POST">
                    @csrf
                    @method('POST')
                   <div class="mb-3">
                    <input required class="form-control" type="text" placeholder="Category In English" name="name_en">
                   </div>
                   <div class="mb-3">
                    <input required class="form-control" type="text" placeholder="Category In Arabic" name="name_ar">
                   </div>
                   <button class="btn btn-info btn-block" type="submit">submit</button>
                </form>
            </div>
        </div>
    </div>
   </div>
</body>
</html>
