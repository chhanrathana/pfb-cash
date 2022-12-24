@extends('layouts.app')
@section('title','តារាង-ចំណាយ')
    
@section('content')
    @include('expenses.expense-items.search')
    @include('expenses.expense-items.list')
    @include('includes.confirm-delete')
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#table').on('click', '.btn-delete', function(){
                var url = '/expense/item/'+$(this).attr("data-id");
                $('#frmDelete').attr('action', url);
                console.log('console....' + url);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection

