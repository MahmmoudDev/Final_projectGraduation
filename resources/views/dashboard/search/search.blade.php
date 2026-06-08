@extends('dashboard.master')

@section('title', 'Search')

@section('Main-content', 'Search')
@section('breadcrumb-main', 'Dashboard')
@section('breadcrumb-sub', 'Search')

@section('content')

    <table class="table table-bordered table-hover">

        <thead>

            <tr>

                <th>#</th>

                <th>Name</th>

                <th>Email</th>

                <th>Mobile</th>

                <th>Type</th>

            </tr>

        </thead>

        <tbody>

            @forelse($results as $item)
                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->name }}</td>

                    <td>{{ $item->email }}</td>

                    <td>{{ $item->mobile }}</td>

                    <td>

                        @if ($item->type == 'Doctor')
                            <span class="badge bg-success">
                                Doctor
                            </span>
                        @elseif($item->type == 'Lawyer')
                            <span class="badge bg-warning">
                                Lawyer
                            </span>
                        @else
                            <span class="badge bg-info">
                                User
                            </span>
                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" class="text-center">
                        No Results Found
                    </td>

                </tr>
            @endforelse

        </tbody>

    </table>

@endsection
