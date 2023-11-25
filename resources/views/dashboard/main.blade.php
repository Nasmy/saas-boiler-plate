@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row bg-light rounded-3">
            <div class="col-8">
                <div class="p-1 ">
                    <div class="container-fluid py-5">
                        <h5 class="fw-lighter">CitizenBox - Admin Portal</h5>
                        <h1 class="display-6 fw-bold">Create new application</h1>
                        <p class="col-md-8 fs-6">You need to provide name, email, mobile... in order to create new
                            account. Once created, account will be accessible instantly. </p>
                        <a class="btn btn-dark btn-lg " href="{{ route('user-create') }}">
                            <i class="bi bi-person-plus-fill"></i>
                            Create application </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <img class="img-fluid my-5" src="{{ asset('img/monitor.svg') }}">
            </div>
        </div>


        <h1 class="display-6 fw-bold border-bottom">Search account</h1>
        <div class="form-area p-2">
            <form action="{{route('dashboard')}}" name="tenant_search" method="GET" role="search">
                @csrf
                <div class="row p-2">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="First name" name="first_name">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Last name" name="last_name">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Organisation" name="organization">
                    </div>

                </div>
                <div class="row p-2">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Domaine" name="domain">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Mobile" name="mobile">
                    </div>
                </div>
                <div class="col-1 p-2">
                    <button class="btn btn-dark btn-lg" type="submit">Search</button>
                </div>
            </form>
        </div>

    </div>

    <h1 class="display-6 fw-bold border-bottom pt-3">Result</h1>

    <div class="table-responsive pt-3">
        <table class="table table-striped table-hover  ">
            <thead>
            <tr>
                <th scope="col">Manage</th>
                <th scope="col">Domaine</th>
                <th scope="col">Organisation</th>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Email</th>
                <th scope="col">Mobile</th>
                <th scope="col">Created</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tenants as $tenant)
                <tr>
                    <th scope="row">
                        <a href="{{ route('user-edit',$tenant->user_id) }}"><i class="bi bi-pencil-fill"></i></a>
                        <form action="{{ route('user-destroy', $tenant->user_id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <input class="btn btn-danger" type="submit" value="Delete"/>
                        </form>
                    </th>
                    <td>{{ $tenant->domain }}</td>
                    <td>{{ $tenant->organization }}</td>
                    <td>{{ $tenant->first_name }}</td>
                    <td>{{ $tenant->last_name }}</td>
                    <td>{{ $tenant->email }}</td>
                    <td>{{ $tenant->mobile }}</td>
                    <td>{{ $tenant->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('footer')
@endsection
