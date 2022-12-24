@extends('layouts.app')
@section('title','ប្រតិបត្តិការកម្ចី')

@section('content')
    @include('report-operations.loans.search')
    @include('report-operations.loans.list')
@stop
