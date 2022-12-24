@extends('layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <form action="{{ route('dashboard') }}" class="mt-2" id="frmSearch" method="GET">
                <div class="form-row">
                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                        <select class="form-control select2" name="branch_id">
                            <option value="" disabled selected>[-- សាខា --]</option>
                            <option value="all" {{ request('branch_id') == 'all'?'selected':'' }}>ទាំងអស់</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id?'selected':'' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                        <button type="submit" class="btn btn-primary mb-2">ស្វែងរក</button>
                        <a href="{{route('dashboard')}}" class="btn btn-warning mb-2">សំអាត</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <table class="table table-hover">
            <thead class="bg-custom">
            <tr>
                <th scope="col">ប្រភេទកម្ចី</th>
                <th scope="col">ចំនួនទឹកប្រាក់</th>
                <th scope="col">អតិថិជន</th>
            </tr>
            </thead>
            <tbody>

            @php
                $totalClients = 0;
                $totalPrincipal = 0;
            @endphp
            @foreach ($interests as $interest)
                @php
                    $totalClients = $totalClients + $interest->count;
                    $totalPrincipal = $totalPrincipal + $interest->principal_amount;
                @endphp
                <tr>
                    <td>{{ $interest->name }}</td>
                    <td>{{ number_format($interest->principal_amount) }} រៀល</td>
                    <td>{{ number_format($interest->count) }} នាក់</td>
                </tr>
            @endforeach
            <tr>
                <td><strong>សរុបកម្ចីទាំងអស់</strong></td>
                <td><strong>{{ number_format($totalPrincipal)  }} រៀល</strong></td>
                <td><strong>{{ number_format($totalClients) }} នាក់</strong></td>
            </tr>
            </tbody>
        </table>
    </div>
@stop
