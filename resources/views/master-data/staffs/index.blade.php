@extends('layouts.app')
@section('title','តារាង-មន្ដ្រីឥណទាន')
@section('content')
    @include('master-data.staffs.search')
    @include('master-data.staffs.list')
    @include('includes.confirm-delete')
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#table').on('click', '.btn-delete', function(){
                var url = '/master-data/staff/'+$(this).attr("data-id");;
                $('#frmDelete').attr('action', url);
                console.log('console....' + url);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection
