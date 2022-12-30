@extends('layouts.pdf-layout')
@section('html')
    <h2 class="text-center heading-title-center">
         តារាងកាលវិភាគសងប្រាក់សងប្រាក់
    </h2>

    <div class="row">
        <table style="width: 100%; font-size:10px; margin-top:20px" class="table-non-border td-border-non line-height-2">
            <tr>
                <td>កូដអតិថិជន</td>
                <td>{{$loan->client->code}}</td>
                <td>ភ្នាក់ងារ</td>
                <td> {{$loan->staff->name_kh??''}} </td>
            </tr>
            <tr>
                <td>កូដសាខា</td>
                <td>{{$loan->branch->code??''}}</td>
                <td>ឈ្មោះសាខា</td>
                <td> {{$loan->branch->name??''}}</td>
            </tr>
            <tr>
                <td>លេខកូដកិច្ចសន្យា</td>
                <td>{{$loan->code}}</td>

                <td>លេខទំនាក់ទំនងភ្នាក់ងារ</td>
                <td>{{$loan->staff->phone_number??''}} </td>
            </tr>
            <tr>
                <td >ឈ្មោះអតិថិជន</td>
                <td>{{$loan->client->name_kh}}</td>

                <td>ប្រភេទកម្ចី</td>
                <td>{{$loan->interest->name??''}} </td>
            </tr>
            <tr>
                <td>អាស័យដ្ឋាន</td>
                <td>{{$loan->client->address}}</td>

                <td>ចំនួនកាលវិភាគ</td>
                <td>{{count($loan->payments)}} </td>
            </tr>
            <tr>
                <td>លេខទំនាក់ទំនង</td>
                <td>{{$loan->client->phone_number}}</td>

                <td>ចំនួនទឹកប្រាក់</td>
                <td>{{ number_format($loan->principal_amount) }}</td>
            </tr>
            <tr>
                <td>ជំហាន</td>
                <td>{{$loan->client->loans->count()}}</td>
                <td>រូបិយប័ណ្ណ</td>
                <td>រៀល </td>
            </tr>
            <tr>
                <td>ថ្ងៃសងដំបូង</td>
                <td>{{$loan->started_payment_date}}</td>

                <td>ថ្ងៃផុតកំណត់</td>
                <td>{{$loan->last_payment_date}} </td>
            </tr>
        </table>
    </div>

    <div class="text-right">
        <small class="print-date"><i>printed at {{ \Carbon\Carbon::now() }}</i></small>
    </div>


    <div class="report" id="report">
        <table class="th-color">
            <tr>
                <th style="width: 10%; font-size: smaller; padding: 4px;">ល.រ</th>
                <th colspan="2" style="width: 30%; font-size: smaller; padding: 4px;">កាលបរិច្ឆេទសងប្រាក់</th>
                <th style="width: 10%; font-size: smaller; padding: 4px;">ទឹកប្រាក់ត្រូវបង់</th>
                <th style="width: 220px; font-size: smaller; padding: 4px;">សម្គាល់ផ្សេងៗ</th>
            </tr>
            @foreach ($loan->payments as $payment)
                <tr>
                    <td style="font-size: smaller; padding: 4px" class="text-center text-nowrap">{{ $loop->index + 1 }}</td>
                    <td style="font-size: smaller; padding: 4px" class="text-center" >{{ $payment->payment_date??''}} </td>
                    <td style="font-size: smaller; padding: 4px" class="text-center" nowrap="nowrap">{{ convertDaytoKhmer(date('D',strtotime($payment->getRawOriginal('payment_date')))) }}</td>
                    <td style="font-size: smaller; padding: 4px" class="text-right text-nowrap">{{ number_format(roundCurrency($payment->total_amount)) }}</td>
                    <td style="font-size: smaller; padding: 4px" class="text-right text-nowrap"></td>
                </tr>
            @endforeach

        </table>
    </div>
    <p style="text-indent: 10px; font-size:12px">ក្រោយពីបានពិនិត្យកិច្ចសន្យានិងតារាងបង់ប្រាក់ខាងលើ ខ្ញុំបាទ/នាងខ្ញុំបានយល់ព្រមបង់សងប្រាក់បងស្ថាប័នវិញទាំងប្រាក់ដើមនិងការប្រាក់ទៅតាមតារាងបង់ប្រាក់តាមការកំណត់ខាងលើជាកំហិត។</p>

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
