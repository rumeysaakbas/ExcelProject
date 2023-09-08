<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    <div class="container">
        <form enctype="multipart/form-data" action="{{ route('import') }}" method="post">
            @csrf
            <div class="mb-3 mt-5">
                <input name="excel_file" class="form-control" type="file">
            </div>

            <button type="submit" class="btn btn-dark">Ekle</button>
        </form>
        
        @if(session('error'))
        <div class="alert alert-danger mt-5">
            {{ session('error') }}
        </div>
        @endif
        @if(session()->has('success'))
        <div class="alert alert-success mt-5">
            {{ session()->get('success') }}
        </div>
        @endif

        @if (isset($errors) && $errors->any())
            <ol>
                @foreach ($errors->all() as $error )
                    <li>{{ $error }}</li>
                @endforeach
            </ol>
        @endif
        @if (session()->has('failures'))
            @foreach (session()->has('failures') as $error)
                {{ $error->row() }}
                {{ $error->attribute() }}
            @endforeach
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>