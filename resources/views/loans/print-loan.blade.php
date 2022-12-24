@extends('layouts.pdf-layout')
@select('Models.Branch')


@section('html')
    <div class="text-center heading-title-center khmer-moul">
         កាលវិភាគសងប្រាក់
    </div>
    <br>
    <br>
    
    <div class="row">
        <table style="width: 100%; font-size:10px" class="table-non-border td-border-non line-height-2">
            <tr>
                <td>កូដអតិថិជន</td>
                <td>{{$loan->client->code}}</td>
                <td>ភ្នាក់ងារ</td>
                <td> {{$loan->staff->name_kh??''}} </td>
            </tr>
            <tr>
                <td>កូដសាខា</td>
                <td>{{$loan->branch->id??''}}</td>
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
                <th style="width: 50px;">ល.រ</th>
                <th colspan="2" style="width: 180px;">ថ្ងៃ</th>
                <th style="width: 100px;">ប្រាក់ដេីម</th>
                <th style="width: 80px;">ការប្រាក់</th>
                <th style="width: 120px;">សេវាប្រតិបត្តិការ</th>
                <th style="width: 80px;">សរុប</th>
                <th style="width: 120px;">ប្រាក់ដេីមនៅសល់</th>
                <th style="width: 120px;">ពិន័យបងផ្តាច់</th>
                <th style="width: 60px;">ផ្សេងៗ</th>
            </tr>

            @foreach ($loan->payments as $payment)                
                <tr>
                    <td class="text-right text-nowrap">{{ $loop->index + 1 }}</td>
                    <td class="text-center" >{{ $payment->payment_date??''}} </td>
                    <td class="text-center" nowrap="nowrap">{{ convertDaytoKhmer(date('D',strtotime($payment->getRawOriginal('payment_date')))) }}</td>
                    <td class="text-right text-nowrap">{{ number_format($payment->deduct_amount) }}</td>
                    <td class="text-right" >{{ number_format($payment->interest_amount) }} </td>
                    <td class="text-right text-nowrap">{{ number_format($payment->commission_amount) }} </td>
                    <td class="text-right text-nowrap">{{ number_format($payment->total_amount) }} </td>
                    <td class="text-right text-nowrap">{{ number_format($payment->pending_amount) }} </td>
                    <td class="text-right text-nowrap">{{ number_format($payment->penalty_amount) }}</td>
                    <td class="text-right text-nowrap"></td>
                </tr>
            @endforeach
        </table>
            
    </div>

    <table style="width:100%; line-height: 3; border: 0px solid rgba(255, 255, 255, 0) !important;">
        <tr style="border: 0px solid rgba(255, 255, 255, 0) !important;">
            <th style="text-align:center; border: 0px solid rgba(255, 255, 255, 0) !important;">
                <div class="caption-left">
                <div class="text-center">
                    <br>
                    <div class="text-left">
                        <p class="p">ថ្ងៃ............. ខែ............. ឆ្នាំ {{ \Carbon\Carbon::now()->format('Y') }}</p>
                    </div>
                    <div class="khmer-moul" style="pandding-left:20px;">ហត្ថលេខា និងត្រាភាគីអោយខ្ចី </div>
                    <br>
                    <br>
                    <div class="text-left">
                        <div style="margin-left:100px;" >
                            ឈ្មោះ :...............................
                        </div>
                    </div>
                </div>
                </div>
            </th>

            <th style="width: 250px; border: 0px solid rgba(255, 255, 255, 0) !important;">

            </th>

            <th style="text-align: center; border: 0px solid rgba(255, 255, 255, 0) !important;">
                <div class="caption-right">
                    <div class="text-right">
                    <br>
                        <div class="text-left">
                            <p class="p">ថ្ងៃ............. ខែ............. ឆ្នាំ {{ \Carbon\Carbon::now()->format('Y') }}</p>
                        </div>
                        <div class="khmer-moul" style="pandding-left:20px;">ស្នាមមេដៃ ស្តាំកូនបំណុល</div>
                        <br>
                        <br>
                        <div class="text-right">
                            <div style="margin-left:100px;" >
                                ឈ្មោះ :...............................
                            </div>
                        </div>
                    </div>
                </div>
            </th>
        </tr>
    </table>    
@stop
