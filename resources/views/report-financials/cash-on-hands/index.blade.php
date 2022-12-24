@extends('layouts.app')
@section('title','របាយការណ៍បិទបញ្ជី-ប្រាក់ដើម')

@section('content')
<div class="card">
    <div class="card-body">
        {{-- <form action="{{ route('report-financial.revenue-admin-fee') }}" method="GET">
            @csrf
            <div class="form-row">
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <select class="form-control select2" name="branch_id" >
                        <option value="" disabled selected>[-- សាខា --]</option>
                        <option value="all" {{ request('branch_id') == 'all'?'selected':'' }}>ទាំងអស់</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id?'selected':'' }}>{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input
                        type="text"
                        maxlength="10"
                        data-inputmask-alias="dd/mm/yyyy"
                        data-val="true"
                        data-val-required="Required"
                        class="form-control"
                        name="from_date"
                        value="{{ request('from_date')??$fromDate }}"
                        placeholder="ចាប់ពីថ្ងៃបង់ប្រាក់">
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input
                        type="text"
                        maxlength="10"
                        data-inputmask-alias="dd/mm/yyyy"
                        data-val="true"
                        data-val-required="Required"
                        class="form-control"
                        name="to_date"
                        value="{{ request('to_date')??$toDate }}"
                        placeholder="ដល់ថ្ងៃបង់ប្រាក់">
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <button type="submit" class="btn btn-primary mb-2">ស្វែងរក</button>
                    <a href="{{route('report-financial.revenue-admin-fee')}}" class="btn btn-warning mb-2">សំអាត</a>                    
                </div>
            </div>
        </form> --}}

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        {{-- <th class="text-center text-nowrap align-middle" rowspan="2">ល.រ</th> --}}
                        <th class="text-center text-nowrap align-middle" rowspan="2">ដើមទុនសរុប</th>
                        <th class="text-center text-nowrap align-middle" colspan="5">កម្ចីបានបញ្ចេញ</th>
                        <th class="text-center text-nowrap align-middle" colspan="3">ប្រាក់ប្រមូលបាន</th>                        
                        <th class="text-center text-nowrap align-middle text-success" rowspan="2">ចំនូលសរុប</th>
                        {{-- <th class="text-center text-nowrap">ការការសរុប</th> --}}
                    </tr>

                    <tr>
                        {{-- <th class="text-center text-nowrap">ល.រ</th> --}}
                        {{-- <th class="text-center text-nowrap">ដើមទុនសរុប</th> --}}
                        {{-- <th class="text-center text-nowrap">បញ្ចេញកម្ចីសរុប</th> --}}
                        <th class="text-center text-nowrap text-warning">ចំនួនកម្ចី</th>
                        <th class="text-center text-nowrap text-warning">ប្រាក់ដើម</th>
                        <th class="text-center text-nowrap text-success">រដ្ឋបាល</th>
                        <th class="text-center text-nowrap text-primary">ប្រាក់ការ</th>
                        <th class="text-center text-nowrap text-primary">ប្រាក់ប្រតិបត្តិការ</th>
                        

                        <th class="text-center text-nowrap text-warning">ប្រាក់ដើម</th>                        
                        <th class="text-center text-nowrap text-success">ប្រាក់ការ</th>
                        <th class="text-center text-nowrap text-success">ប្រាក់ប្រតិបត្តិការ</th>
                        {{-- <th class="text-center text-nowrap">ការការសរុប</th> --}}
                    </tr>
                </thead>
                {{-- <tbody>
                    @php
                        $totalTransaction = 0;
                        $totalPrincipalAmount = 0;
                        $totalAdminAmount = 0;
                        $totalInterestAmount = 0;
                    @endphp
                    
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($loans as $loan)
                    @php
                        $totalTransaction = $totalTransaction + $loan->transaction;
                        $totalPrincipalAmount = $totalPrincipalAmount + $loan->total_principal_amount;
                        $totalAdminAmount = $totalAdminAmount + $loan->total_admin_amount;
                    @endphp
                    <tr>           
                                  
                        <td class="text-right text-nowrap">{{ $i++ }}</td>
                        <td class="text-center text-nowrap">{{ $loan->registration_date }}</td>
                        <td class="text-right text-nowrap">{{ number_format($loan->transaction)}}</td>
                        <td class="text-right text-nowrap">{{ number_format($loan->total_principal_amount)}}</td>
                        <td class="text-right text-nowrap">{{ number_format($loan->total_admin_amount)}}</td>                        
                    </tr>
                    @endforeach

                    <tr>
                        <td colspan="2" class="text-right text-nowrap">សរុប</td>
                        <td class="text-right text-font-bold"><strong>{{ number_format($totalTransaction)}}</strong> </td>
                        <td class="text-right text-font-bold"><strong>{{ number_format($totalPrincipalAmount)}}</strong> </td>
                        <td class="text-right text-font-bold"><strong>{{ number_format($totalAdminAmount)}}</strong></td>
                    </tr>                    
                </tbody> --}}
            </table>
        </div>
    </div> 
</div>
@stop
