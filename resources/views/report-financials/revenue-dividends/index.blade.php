@extends('layouts.app')
@section('title','របាយការណ៍-ចែងភាគលាភ')

@section('content')
    @include('report-financials.revenue-dividends.search')
    @include('report-financials.revenue-dividends.dividend-info')
    @include('report-financials.revenue-dividends.list')
@stop
