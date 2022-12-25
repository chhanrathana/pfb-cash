@extends('layouts.app')
@section('title','ភ្នាក់ងារ-ស្ថិតិ')
@section('content')

    @include('report-staffs.statistics.search')
    
    @include('report-staffs.statistics.list') 
@endsection