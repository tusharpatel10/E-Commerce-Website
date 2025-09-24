@extends('admin.admin_layout')
@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Users</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    <a href="{{ route('admin-user-profile-register') }}" class="btn btn-outline-primary sm float-end"> + Add-User</a>
                </div>
                @include('flash_data')
                <div class="card-body">
                    <div class="table-responsive justify-center">
                        <table class="table table-primary text-start" id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th scope="col">Sr.</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->FullName }}</td>
                                        <td>{{ $user->role_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->contact }}</td>
                                        <td>{{ $user->gender }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->countryData->name }}</td>
                                        <td>
                                            <a href="{{ route('admin-user-edit', ['id' => $user->id]) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <a href="#" class="btn btn-sm btn-danger">Deactivate</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>

    </main>
    <script>
        let table = new DataTable('#datatablesSimple');
    </script>
@endsection
