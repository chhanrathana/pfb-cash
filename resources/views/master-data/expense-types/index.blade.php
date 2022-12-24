@extends('layouts.app')
@section('title','តារាង-ប្រភេទចំណាយ')
    
@section('content')
    @include('master-data.expense-types.list')
    @include('includes.confirm-delete')
@endsection


@section('script')
    <script>
        $(document).ready( function () {
            $('#table').on('click', '.btn-delete', function(){
                var url = '/master-data/expense-type/'+$(this).attr("data-id");
                $('#frmDelete').attr('action', url);
                console.log('console....' + url);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection

