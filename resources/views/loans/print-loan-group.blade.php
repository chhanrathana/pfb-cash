@extends('layouts.pdf-layout')
@section('html')
    <h2 class="text-center heading-title-center">
         តារាងកាលវិភាគសងប្រាក់សងប្រាក់
    </h2>
    <div class="row" style="padding-top: 20px;">
        <table style="width: 100%; font-size:10px" class="table-non-border td-border-non line-height-2">
            <tr>
                <td>ឈ្មោះមេក្រុម</td>
                <td><strong>{{$loan->client->name_kh}}</strong></td>
                <td>សមាជិកទី០១</td>
                <td><strong>{{($loan->members[0])->name_kh??'......'}}</strong></td>
                <td>សមាជិកទី០៣</td>
                <td><strong>{{($loan->members[2])->name_kh??'......'}}</strong></td>
            </tr>
            <tr>
                <td>លេខទូរស័ព្ទ</td>
                <td><strong>{{$loan->client->phone_number ?? '......'}}</strong></td>
                <td>សមាជិកទី០២</td>
                <td><strong>{{($loan->members[1])->name_kh??'......'}}</strong></td>
                <td>សមាជិកទី០៤</td>
                <td><strong>{{($loan->members[3])->name_kh??'......'}}</strong></td>
            </tr>
            <tr>
                <td>លេខកូដកម្ចី</td>
                <td><strong>{{$loan->code}}</strong></td>
                <td>សមាជិកទី០៥</td>
                <td><strong>{{($loan->members[4])->name_kh??'......'}}</strong></td>

                <td>អាសយដ្ឋាន</td>
                <td><strong>{{$loan->client->address ??'......'}}</strong></td>
            </tr>
        </table>
        <hr>
        <table style="width: 100%; font-size:10px" class="table-non-border td-border-non line-height-2">
            <tr>
                <td>ចំនួនទឹកប្រាក់ខ្ចី</td>
                <td><strong>{{number_format($loan->principal_amount)}} ៛</strong></td>
                <td >ទឹកប្រាក់ជាអក្សរ</td>
                <td><strong>{{ $loan -> principal_amount_as_word() }}រៀល</strong></td>
                <td>ប្រភេទប្រាក់កម្ចី</td>
                <td><strong>{{$loan-> type -> name_kh}}</strong></td>
            </tr>
            <tr>
                <td >រយះពេលខ្ចី</td>
                <td><strong>{{$loan->term}} ដង</strong></td>
                <td >កាលបរិច្ឆេទខ្ចី</td>
                <td><strong>{{$loan->registration_date}}</strong></td>
                <td >កាលបរិច្ឆេទសងលើកដំបូង</td>
                <td><strong>{{$loan->started_payment_date}}</strong></td>
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
                <th style="width: 10%; font-size: smaller; padding: 4px;">{{ $loan -> client -> name_kh ?? '- - -' }}</th>
                @foreach($loan -> members as $member)
                    <th style="width: 10%; font-size: smaller; padding: 4px;">{{ $member -> name_kh ?? '- - -' }}</th>
                @endforeach
                <th style="width: 10%; font-size: smaller; padding: 4px;">សម្គាល់ផ្សេងៗ</th>
            </tr>

            @foreach ($loan->payments as $payment)
                <tr>
                    <td style="font-size: smaller; padding: 4px" class="text-center text-nowrap">{{ $loop->index + 1 }}</td>
                    <td style="font-size: smaller; padding: 4px" class="text-center" >{{ $payment->payment_date??''}} </td>
                    <td style="font-size: smaller; padding: 4px" class="text-center" nowrap="nowrap">{{ convertDaytoKhmer(date('D',strtotime($payment->getRawOriginal('payment_date')))) }}</td>
                    <td style="font-size: smaller; padding: 4px" class="text-right text-nowrap">{{ number_format($payment->total_amount/($loan -> totalMembers())) }}</td>
                    @for($i=1; $i<5; $i++)
                        @if($i > count($loan -> validMembers()))
                            <td style="font-size: smaller; padding: 4px" class="text-right text-nowrap">0</td>
                        @else
                            <td style="font-size: smaller; padding: 4px" class="text-right text-nowrap">{{ number_format($payment->total_amount/4) }}</td>
                        @endif
                    @endfor
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
