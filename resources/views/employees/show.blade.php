<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('messages.show-employee')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{__('messages.show-employee')}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">{{Auth::user()->email}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/change-language">{{__('messages.change-language')}}</a>
            </li>
        </ul>
        <form class="d-flex" role="search" method="POST" action="{{route('logout')}}">
            @csrf
            <button class="btn btn-outline-danger" type="submit">{{__('messages.logout')}}</button>
        </form>
        </div>
    </div>
    </nav>

    <form action="#" method="POST" style="margin: 20px" enctype="multipart/form-data">
    @csrf
        <label>{{__('messages.first-name')}}</label>
        <input type="text" class="form-control" name="name" value="{{$employee->first_name}}" disabled>
        <label>{{__('messages.last-name')}}</label>
        <input type="text" class="form-control" name="email" value="{{$employee->last_name}}" disabled>
        <label>{{__('messages.company')}}</label>
        @php
            $company = \App\Models\Company::where('id', $employee->company)->first();
        @endphp
        <input type="text" class="form-control" name="email" value="{{$company->name}}" disabled>
        <label>{{__('messages.email')}}</label>
        <input type="email" class="form-control" name="email" value="{{$employee->email}}" disabled>
        <label>{{__('messages.phone')}}</label>
        <input type="text" class="form-control" name="email" value="{{$employee->phone}}" disabled>


    </form>
</body>
</html>
