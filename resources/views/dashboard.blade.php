<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <strong>
                        <h4>All Students</h4>
                        <a class="btn btn-primary float-end mb-4" href="{{ route('student.add') }}">Add Student</a>
                        <!-- Table -->
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL NO</th>
                                    <th scope="col">Student ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Birthday</th>
                                    <th scope="col">Age</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allData as $key => $user)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->student_id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->dob }}</td>
                                    <td>{{ \Carbon\Carbon::parse($user->dob)->age }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td scope="col">
                                        <a href="{{ route('student.edit', $user->id) }}" class="btn btn-primary text-white">Edit</a>
                                        <a href="{{ route('generate.pdf', $user->id) }}" class="btn btn-secondary text-white" id="delete">PDF</a>
                                        <a href="{{ route('student.delete', $user->id) }}" class="btn btn-danger text-white" id="delete">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </strong>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>