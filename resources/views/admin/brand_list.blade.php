@extends('admin.admin_layout')
@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">All Brands</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    <a href="{{ route('brand.create') }}" class="btn btn-outline-primary sm float-end"> +
                        Add-Brand</a>
                </div>
                @include('flash_data')
                <div class="card-body">
                    <div class="table-responsive justify-center">
                        <table class="table table-primary text-start" id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th scope="col">Sr.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->desciription }}</td>
                                        <td>{{ $user->image }}</td>
                                        <td>
                                            <a href="{{ route('admin-user-edit', ['id' => $user->id]) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <a href="{{ route('admin-change-user-status', ['id' => $user->id, 'status' => $user->is_active == \App\enum\User_Status::user_active ? 0 : 1]) }}"
                                                class="btn btn-sm my-2 btn-{{ $user->is_active == \App\enum\User_Status::user_active ? 'danger' : 'success' }}">{{ $user->is_active == \App\enum\User_Status::user_active ? 'Deactivate' : 'Activate' }}</a>
                                        </td>
                                    </tr>
                                @endforeach --}}
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
