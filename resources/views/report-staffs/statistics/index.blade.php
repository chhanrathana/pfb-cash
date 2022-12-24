@extends('layouts.app')
@section('title','មន្ដ្រីឥណទាន-ស្ថិតិ')
@section('content')

    @include('report-staffs.statistics.search')
    
    @include('report-staffs.statistics.list') 
@endsection