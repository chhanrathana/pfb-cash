@extends('layouts.app')
@section('title' , 'តារាង-បង់ការប្រាក់')

@section('content')

    @include('payments.interest.search')
    @include('payments.interest.list')
    @include('includes.confirm-delete')
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#table').on('click', '.btn-delete', function(){
                var url = '/loan/list/'+$(this).attr("data-id");;
                $('#frmDelete').attr('action', url);
                console.log('console....' + url);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection
