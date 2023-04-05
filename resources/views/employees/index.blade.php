<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('messages.employees-index')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{__('messages.employees-index')}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">{{Auth::user()->email}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/change-language">{{App::getLocale() == 'en'?'ar':'en'}}</a>
            </li>
        </ul>
        <form class="d-flex" role="search" method="POST" action="{{route('logout')}}">
            @csrf
            <button class="btn btn-outline-danger" type="submit">{{__('messages.logout')}}</button>
        </form>
        </div>
    </div>
    </nav>
    <a class="btn btn-success" href="{{route('employees.create')}}">{{__('messages.add-employee')}}</a>
    <table class="table table-striped">
        <th>
            <td>{{__('messages.first-name')}}</td>
            <td>{{__('messages.last-name')}}</td>
            <td>{{__('messages.company')}}</td>
            <td>{{__('messages.email')}}</td>
            <td>{{__('messages.phone')}}</td>
            <td>{{__('messages.actions')}}</td>
        </th>
        @foreach($employees as $employee)
        <tr>
            <td>{{$employee->id}}</td>
            <td>{{$employee->first_name}}</td>
            <td>{{$employee->last_name}}</td>
            @php
                $company = \App\Models\Company::where('id', $employee->company)->first();
            @endphp
            <td>{{$company->name}}</td>
            <td>{{$employee->email}}</td>
            <td>{{$employee->phone}}</td>
            <td>
                <a href="{{route('employees.edit', $employee->id)}}" class="btn btn-primary">{{__('messages.update')}}</a>
                <a href="{{route('employees.show', $employee->id)}}" class="btn btn-primary">{{__('messages.show')}}</a>
                <form method="POST" action="{{route('employees.destroy', $employee->id)}}" style="display: inline-block;">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">{{__('messages.delete')}}</button>
                </form>

            </td>
        </tr>
        @endforeach
    </table>
    {{$employees->links()}}
</body>
</html>
