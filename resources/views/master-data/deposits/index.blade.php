@extends('layouts.app')
@section('title','តារាង-ភាគហ៊ុន')
    
@section('content')
    @include('master-data.deposits.search')
    @include('master-data.deposits.list')
    @include('includes.confirm-delete')
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#table').on('click', '.btn-delete', function(){
                var url = '/master-data/deposit/'+$(this).attr("data-id");
                $('#frmDelete').attr('action', url);
                console.log('console....' + url);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection

