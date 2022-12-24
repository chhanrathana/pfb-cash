@extends('layouts.app')
@section('title' , 'ប្រវតិ្តបង់ផ្ដាច់')

@section('content')
    @include('includes.alert-info')
    
    @include('payments.history.search')
    @include('payments.history.list')
    @include('payments.history.confirm')
@endsection

@section('script')
    <script>
       function handleClickReverse(route){
           $('#staticBackdrop').modal('show');
           $('#staticBackdrop form').prop('action',route);
       }
    </script>
@endsection
