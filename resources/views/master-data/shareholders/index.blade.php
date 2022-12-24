@extends('layouts.app')
@section('title','ម្ចាស់ភាគហ៊ុន')
    
@section('content')
    <div class="card">
        <div class="card-header">
            <strong>សាខា</strong>

    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover" id ="table">
            <thead>
                <tr>
                    <th></th>
                    <th class="text-center text-nowrap">ល.រ</th>
                    <th class="text-center text-nowrap">ឈ្មោះខ្មែរ</th>
                    <th class="text-center text-nowrap">ឈ្មោះឡាតាំង</th>
                    <th>ដើមទុនសរុប</th>                    
                </tr>
            </thead>
            <tbody>
                @php
                    $totalDeposit = 0;
                @endphp

                @foreach($shareholders as $shareholder)
                @php
                    $totalDeposit = $totalDeposit + $shareholder->deposit->deposit_amount;
                @endphp
                <tr>
                    <td class="text-center text-nowrap">
                        <a class="btn btn-sm btn-primary" href="{{ route('shareholder.edit',['id' => $shareholder->id]) }}" type="button">
                            <span class="material-icons-outlined">edit</span>
                        </a>

                        <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $shareholder->id }}">
                            <span class="material-icons-outlined">delete_outline</span>
                        </button>
                    </td>
                    <td class="text-right text-nowrap">{{ $loop->index + 1 }}</td>
                    <td>{{$shareholder->name_kh??''}}</td>
                    <td>{{$shareholder->name_en??''}}</td>
                    <td class="text-right text-nowrap">{{ number_format($shareholder->deposit->deposit_amount)}}</td>
                </tr>
                @endforeach
                <tr>
                    <td class="text-right" colspan="4"><strong>សរុប</strong></td>
                    <td class="text-right text-nowrap">{{ number_format($totalDeposit) }}</td>                    
                </tr>
            </tbody>
        </table>
    </div>
</div>
@include('includes.confirm-delete')
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#table').on('click', '.btn-delete', function(){
                var url = '/master-data/shareholder/'+$(this).attr("data-id");
                $('#frmDelete').attr('action', url);
                console.log('console....' + url);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection

