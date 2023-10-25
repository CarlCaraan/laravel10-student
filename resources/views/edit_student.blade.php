<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Student
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <strong>
                        <h4>Edit Students</h4>
                        <form method="POST" action="{{ route('student.update', $user->id) }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Student ID</label>
                                <input type="text" class="form-control" name="student_id" id="student_id" value="{{ $user->student_id }}">
                                @error('student_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input class="form-control" type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input class="form-control" type="text" class="form-control" name="address" id="address" value="{{ $user->address }}">
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Birthday</label>
                                <input class="form-control" type="date" class="form-control" name="dob" id="dob" value="{{ $user->dob }}">
                                @error('dob')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input class="form-control" type="text" class="form-control" name="username" id="username" value="{{ $user->username }}">
                                @error('username')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Add Sibling -->
                            <hr>
                            <h2 class="my-2">Edit Sibling</h2>

                            <div class="add_item">
                                @forelse($sibling as $sn)
                                <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label class="form-label">Sibling Name</label>
                                            <input value="{{ $sn->sibling_name }}" class="form-control" type="text" class="form-control" name="sibling_name[]" required>
                                            @error('sibling')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-3" style="padding-top: 29px;">
                                            <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                                            <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <p>No siblings found.</p>
                                @endforelse
                            </div>

                            <button class="mt-4 px-4 py-3 border-2" type="submit">Update</button>
                        </form>
                    </strong>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Start Hidden Row Javascript -->
<div style="visibility: hidden;">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">

            <div class="form-group row">
                <div class="form-group col-6">
                    <label class="form-label">Sibling Name</label>
                    <input class="form-control" type="text" class="form-control" name="sibling_name[]" required>
                    @error('sibling')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-6" style="padding-top: 29px;">
                    <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                    <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var counter = 0;
        $(document).on("click", ".addeventmore", function() {
            var whole_extra_item_add = $('#whole_extra_item_add').html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
        });
        $(document).on("click", ".removeeventmore", function(event) {
            $(this).closest(".delete_whole_extra_item_add").remove();
            counter -= 1;
        });
    });
</script>