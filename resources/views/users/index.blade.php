<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>First Part</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create User</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <form method="get">
    <input
        type="search"
        class="form-control"
        placeholder="Find user here"
        name="search"
        value="{{ request('search') }}">
    <br>
    <input type="submit">
    <br>
    </form>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Date of Birth / y.o</th>
            <th>Sex</th>
            <th>City</th>
            <th width="280px">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->surname }}</td>
                <td>{{ $user->datebirth }} / @php $birthday_timestamp = strtotime($user->datebirth);
                                                  $age = date('Y') - date('Y', $birthday_timestamp);
                                                    if (date('md', $birthday_timestamp) > date('md')) {
                                                        $age--; }
                                                    echo "$age years"; @endphp
                </td>
                <td>@php if($user->sex == 0) echo "Мужской"; else echo "Женский"; @endphp</td>
                <td>{{ $user->city }}</td>
                <td>
                    <form action="{{ route('users.destroy',$user->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
