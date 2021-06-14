@extends('layouts.app')

@section('content')
<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('user.index')}}">User List</a></li>
            <li class="breadcrumb-item active">User Detail</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">User Detail</h1>
            <p class="mb-0">Show general information about user and user activity log</p>
        </div>
    </div>
</div>
<div class="card mb-5">
    <div class="card-body">
        <h5 class="h5 mb-4">General information</h5>
        <div class="mb-4">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" placeholder="fullname" value="{{$user->name}}" readonly>
        </div>
        <div class="mb-4">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" placeholder="example@gmail.com" value="{{$user->email}}" readonly>
        </div>
        <div class="mb-4">
            <label for="">Status</label>
            <div class="form-check">
                <label class="form-check-label">Verified</label>
                <input class="form-check-input" type="checkbox" @if($user->email_verified_at) checked @endif disabled>
            </div>
        </div>
        <div class="mb-4">
            <a href="mailto:{{$user->email}}" class="btn btn-primary">Contact</a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h5 class="h5 mb-4">User Activity Log</h5>
        <div class="table-responsive py-4">
            <table class="table table-hover" id="datatable">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Description</th>
                        <th>Datetime</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$log->description}}</td>
                        <td>{{$log->created_at->format('M d, Y H:i')}} <span class="badge bg-primary">{{$log->created_at->diffForHumans()}}</span></td>
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