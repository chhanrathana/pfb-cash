@extends('layouts.pdf-layout')
@section('html')
    <h2 class="text-center heading-title-center">
         តារាងកាលវិភាគសងប្រាក់សងប្រាក់
    </h2>
    <div class="row">
        <table style="width: 100%; font-size:10px" class="table-non-border td-border-non line-height-2">
            <tr>
                <td>ឈ្មោះមេក្រុម</td>
                <td>{{$loan->client->code}}</td>
                <td>សមាជិកទី០១</td>
                <td> {{$loan->staff->name_kh??''}} </td>
                <td>សមាជិកទី០៣</td>
                <td> {{$loan->staff->name_kh??''}} </td>
            </tr>
            <tr>
                <td>លេខទូរស័ព្ទ</td>
                <td>{{$loan->branch->code??''}}</td>
                <td>សមាជិកទី០២</td>
                <td>..........</td>
                <td>សមាជិកទី០៤</td>
                <td> {{$loan->branch->name??''}}</td>
            </tr>
            <tr>
                <td>លេខកូដកម្ចី</td>
                <td>{{$loan->code}}</td>
                <td>សមាជិកទី០៥</td>
                <td>{{$loan->code}}</td>

                <td>អាសយដ្ឋាន</td>
                <td>{{$loan->staff->phone_number??''}} </td>
            </tr>
        </table>
        <hr>
        <table style="width: 100%; font-size:10px" class="table-non-border td-border-non line-height-2">
            <tr>
                <td>ចំនួនទឹកប្រាក់ខ្ចី</td>
                <td>{{$loan->client->name_kh}}</td>
                <td >ទឹកប្រាក់ជាអក្សរ</td>
                <td>{{$loan->client->name_kh}}</td>
                <td>ប្រភេទប្រាក់កម្ចី</td>
                <td>{{$loan->client->name_kh}}</td>
            </tr>
            <tr>
                <td >រយះពេលខ្ចី</td>
                <td>{{$loan->client->name_kh}}</td>
                <td >កាលបរិច្ឆេទខ្ចី</td>
                <td>{{$loan->client->name_kh}}</td>
                <td >កាលបរិច្ឆេទសងលើកដំបូង</td>
                <td>{{$loan->client->name_kh}}</td>
            </tr>
        </table>
    </div>

    <div class="text-right">
        <small class="print-date"><i>printed at {{ \Carbon\Carbon::now() }}</i></small>
    </div>
    <div class="report" id="report">

        <table class="th-color">
            <tr>
                <th style="width: 5%; font-size: smaller; padding: 4px;">ល.រ</th>
                <th colspan="2" style="width: 15%; font-size: smaller; padding: 4px;">កាលបរិច្ឆេទសងប្រាក់</th>
                <th style="width: 10%; font-size: smaller; padding: 4px;">អាង អាត់</th>
                <th style="width: 10%; font-size: smaller; padding: 4px;">អាង អាត់</th>
                <th style="width: 10%; font-size: smaller; padding: 4px;">អាង អាត់</th>
                <th style="width: 10%; font-size: smaller; padding: 4px;">អាង អាត់</th>
                <th style="width: 10%; font-size: smaller; padding: 4px;">អាង អាត់</th>
                <th style="width: 10%; font-size: smaller; padding: 4px;">សម្គាល់ផ្សេងៗ</th>
            </tr>

            @foreach ($loan->payments as $payment)
                <tr>
                    <td style="font-size: smaller; padding: 4px" class="text-center text-nowrap">{{ $loop->index + 1 }}</td>
                    <td style="font-size: smaller; padding: 4px" class="text-center" >{{ $payment->payment_date??''}} </td>
                    <td style="font-size: smaller; padding: 4px" class="text-center" nowrap="nowrap">{{ convertDaytoKhmer(date('D',strtotime($payment->getRawOriginal('payment_date')))) }}</td>
                    <td style="font-size: smaller; padding: 4px" class="text-right text-nowrap"></td>
                    <td style="font-size: smaller; padding: 4px" class="text-right text-nowrap"></td>
                    <td style="font-size: smaller; padding: 4px" class="text-right text-nowrap"></td>
                    <td style="font-size: smaller; padding: 4px" class="text-right text-nowrap"></td>
                    <td style="font-size: smaller; padding: 4px" class="text-right text-nowrap"></td>
                    <td style="font-size: smaller; padding: 4px" class="text-right text-nowrap"></td>
                </tr>
            @endforeach
        </table>
        <p style="  text-indent: 30px; font-size:12px">ក្រោយពីបានពិនិត្យកិច្ចសន្យានិងតារាងបង់ប្រាក់ខាងលើ ខ្ញុំបាទ/នាងខ្ញុំបានយល់ព្រមបង់សងប្រាក់បងស្ថាប័នវិញទាំងប្រាក់ដើមនិងការប្រាក់ទៅតាមតារាងបង់ប្រាក់តាមការកំណត់ខាងលើជាកំហិត។</p>
    </div>
    <table style="width: 100%; font-size:10px" class="table-non-border td-border-non line-height-2">
        <tr>
            <td>ហត្ថលេខាបុគ្គលិក</td>
            <td>ស្នាមមេដៃអ្នករួមធានា</td>
            <td>ស្នាមមេដៃអ្នកធានា</td>
            <td>ស្នាមមេដៃអ្នករួមខ្ចី</td>
            <td>ស្នាមមេដៃអ្នកខ្ចី</td>
        </tr>
    </table>
@stop
