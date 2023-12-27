@extends('admin.dashboard')
@section('content')
    <form action="{{ route('admin.notifications.store') }}" method="POST">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="message" name="message" value="{{ old('message') }}">
            <label for="message">Message</label>
        </div>
        @error('message')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-floating mb-3">
            <select class="form-select target" aria-label="Default select example" id="role" name="role">
                <option value="" disabled selected>Select role to send</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
                <option value="all">all</option>
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
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody id="render">
                </tbody>
            </table>
        </div>

        <button type="submit" class="btn btn-primary rounded-pill mt-3">Send</button>
    </form>
    <script>
        $("#role").on("change", function() {
            var role = $(this).find(":selected").val();

            $.ajax({
                url: '{{ route('admin.get_users_by_role') }}',
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    role: role,
                },
                success: function(data) {
                    var html = "";

                    for (let i = 0; i < data.users.length; i++) {
                        html += '<tr><td><div class="form-check">';
                        html +=
                            '<input class="form-check-input" type="checkbox" name="list_check[]" value="' +
                            data.users[i]['id'] + '">';
                        html += '</div></td>';
                        html += '<td>' + data.users[i]['name'] + '</td>';
                        html += '<td>' + data.users[i]['email'] + '</td>';
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
