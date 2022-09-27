@extends('layout.master');
@section('content')
    <table border="1" width="100%">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Image</th>
            <th>Description</th>
            <th>Price</th>
            <th>Vote</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->image }}</td>
                <td>{{ $student->description }}</td>
                <td>{{ $student->price }}</td>
                <td>{{ $student->vote }}</td>
            </tr>
        @endforeach
    </table>
@endsection
