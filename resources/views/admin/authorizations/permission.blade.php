@extends('admin.dashboard')
@section('title', 'Assign permission')
@section('content')
    <form action="{{ route('admin.authorizations.assign_permission') }}" method="POST">
        @csrf
        <div class="form-floating mb-3">
            <select class="form-select target" aria-label="Default select example" id="role" name="role">
                <option value="" disabled selected>Select role to assign</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            <label for="role">Role</label>
        </div>
        @error('role')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="table-wrapper-scroll-y my-custom-scrollbar mt-3">
            <table class="table table-bordered table-striped mb-0">
                <thead>
                    <tr>
                        <th>Check</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody id="render">
                </tbody>
            </table>
        </div>

        <button type="submit" class="btn btn-primary rounded-pill mt-3">Assign</button>
    </form>
    <script>
        $("#role").on("change", function() {
            var role = $(this).find(":selected").val();

            $.ajax({
                url: '{{ route('admin.get_all_permissions') }}',
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    role: role,
                },
                success: function(data) {
                    var html = "";

                    for (let i = 0; i < data.permissions.length; i++) {
                        checked = data.check.includes(data.permissions[i]['id']) ? 'checked' : '';

                        html += '<tr><td><div class="form-check">';
                        html +=
                            '<input class="form-check-input" type="checkbox" name="list_check[]" value="' +
                            data.permissions[i]['id'] + '"' + checked + '>';
                        html += '</div></td>';
                        html += '<td>' + data.permissions[i]['name'] + '</td>';
                    }

                    $("#render").html(html);
                },
            });
        });
    </script>
    <style>
        .my-custom-scrollbar {
            position: relative;
            height: 300px;
            border-style: double;
            overflow: auto;
        }

        .table-wrapper-scroll-y {
            display: block;
        }
    </style>
@endsection
