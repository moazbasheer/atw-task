<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('messages.add-employee')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{__('messages.main-page')}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">{{Auth::user()->email}}</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/change-language">{{__('messages.change-language')}} ({{session()->get('locale') == 'ar'?'en': 'ar'}})</a>
            </li>
        </ul>
        <form class="d-flex" role="search" method="POST" action="{{route('logout')}}">
            @csrf
            <button class="btn btn-outline-danger" type="submit">{{__('messages.logout')}}</button>
        </form>
        </div>
    </div>
    </nav>
    <a href="{{route('employees.index')}}" class="btn btn-success">{{__('messages.employees-index')}}</a>
    <a href="{{route('companies.index')}}" class="btn btn-success">{{__('messages.companies-index')}}</a>
</body>
</html>
