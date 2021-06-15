@extends('layouts.app')

@section('content')
<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">User List</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">User List</h1>
            <p class="mb-0">Show all user that registered on system</p>
        </div>
    </div>
</div>
@include('layouts.alert')
<div class="card">
    <div class="card-body">
        <div class="table-responsive py-4">
            <table class="table table-hover" id="datatable">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$user->name}}</td>
                        <td><span class="badge bg-primary">{{$user->getRoleNames()->first()}}</span></td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if($user->email_verified_at)
                            <span class="badge bg-success">Verified</span>
                            @else
                            <span class="badge bg-primary">Not Verified</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{route('user.destroy', [$user])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-primary">Delete</button>
                                <a href="{{route('user.show', [$user])}}" class="btn btn-sm btn-primary">Detail</a>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('customCSS')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />
@endsection

@section('customJS')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
@endsection