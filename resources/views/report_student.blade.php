<!DOCTYPE html>
<html>

<head>
    <title>Student Profile Report</title>
</head>

<body>
    <h1>Student Name: {{ $user->name }}</h1>
    <h2>Student Id: {{ $user->student_id }}</h2>
    <p>Email: {{ $user->email }} </p>
    <p>Username: {{ $user->username }} </p>
    <table border="1">
        <thead>
            <tr>
                <th>Address</th>
                <th>Age</th>
                <th>Birthday</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $user->address}}</td>
                <td>{{ \Carbon\Carbon::parse($user->dob)->age }}</td>
                <td>{{ $user->dob}}</td>
            </tr>
        </tbody>
    </table>
    <br />
    <table border="1">
        <thead>
            <tr>
                <th>SL NO</th>
                <th>Sibling Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sibling as $key => $sn)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $sn->sibling_name}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>