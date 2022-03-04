@extends('layouts.frontend')

@section('content')
    <style>
        table {
            width: 100%;
        }
        .table {
            width: 50%;
            margin-left: 23%
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>

    <div class="row">
        <h3 class="text-2xl font-medium text-gray-700" style="margin-bottom: 20px; margin-top: -20px; text-align: center">Dynamic Table</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Company's Name</th>
                    <th>Branch's Name</th>
                    <th>Staff's Name</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tableData as $company) 
                    <tr>
                        <th rowspan="{{ count($company["branches"]) }}">{{ $company["title"] }}</th>
                        <th>{{ $company["branches"][0]["title"] }}</th>
                        <td>
                            <table class="staff">
                                @foreach($company["branches"][0]["staffs"] as $staff)
                                    <tr><td>{{ $staff }}</td></tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>

                    @foreach($company["branches"] as $branch)
                        @if($loop->index > 0)
                            <tr>
                                <th>{{ $branch["title"] }}</th>
                                <td>
                                    <table class="staff">
                                        @foreach($branch["staffs"] as $staff)
                                            <tr><td>{{ $staff }}</td></tr>
                                        @endforeach
                                    </table>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endsection