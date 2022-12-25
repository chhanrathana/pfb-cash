<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>បញ្ជីបង់ការប្រាក់</strong></div>
        </div>
        <div class="col">            
            <a
                role="button"
                href="{{ route('payment.export').currentParamter() }}"
                class="btn btn-sm btn-info float-right mb-2">
                <span class="material-icons-outlined">file_download</span>
            </a>
            <a class="btn btn-sm btn-warning float-right mb-2"
                style="margin-right: 5px;"
                target="_blank"            
                href="{{ route('payment.download').currentParamter() }}"
                >
                <span class="material-icons-outlined">print</span>
            </a>    
        </div>
    </div>

    <div class="card-body">
        
        @if(request('staff_id') && request('staff_id') != "all")
        <h6 class="text-font-bold">ភ្នាក់ងារ <strong>{{ $defaultStaff->name_kh }}</strong></h6>
        @endif
        <div class="table-responsive">

            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap">ល.រ</th>
                        {{-- <th class="text-center text-nowrap">សភាព</th> --}}
                        <th class="text-center text-nowrap">សាខា</th>
                        <th class="text-center text-nowrap">ថ្ងៃត្រូវបង់</th>
                        <th class="text-center text-nowrap">ប្រភេទ</th>
                        <th class="text-center text-nowrap">ប្រាក់បានខ្ចី</th>
                        <th class="text-center text-nowrap">កូដ</th>
                        <th class="text-center text-nowrap">អតិថិជន</th>
                        <th class="text-center text-nowrap">ទំនាក់ទំនង</th>
                        <th class="text-center text-nowrap">យឺត</th>                        
                        <th class="text-center text-nowrap">ដើមនៅសល់</th>
                        <th class="text-center text-nowrap">ត្រូវបង់សរុប</th>
                        <th class="text-center text-nowrap">បានបង់សរុប</th>
                        <th class="text-center text-nowrap">បង់ទី</th>
                        <th class="text-center text-nowrap">អាសយដ្ឋាន</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalPending = 0;
                        $totalAmount = 0;
                        $totalPaidAmount = 0;
                        $totalUnPaidAmount = 0;
                        $i = 1;
                    @endphp
                    @foreach ($early as $payment)
                        @php
                            $totalPending +=  $payment->loan->pending_amount??0;
                            $totalAmount +=  $payment->total_amount;
                            $totalPaidAmount +=$payment->total_paid_amount;
                            $unPaidAmount = $payment->total_amount - $payment->total_paid_amount;
                            $totalUnPaidAmount += $unPaidAmount;
                        @endphp
                        <tr>
                            <td class="text-right text-nowrap">{{ $i++ }}</td>
                            {{-- <td class="text-center text-nowrap"><span class="{{ $payment->_status->css??'' }}">{{ $payment->_status->name??'' }}</span></td> --}}
                            <td class="text-left text-nowrap">{{ $payment->loan->branch->name??''}}</td>
                            <td class="text-center text-nowrap">{{ $payment->payment_date??''}}</td>
                            <td class="text-left text-nowrap">{{ $payment->loan->interest->name??''}}</td>
                            <td class="text-right text-nowrap">{{ number_format(($payment->loan->principal_amount??0)) }}</td>
                            <td class="text-left text-nowrap">{{ $payment->loan->client->code??''}}</td>
                            <td class="text-left text-nowrap">{{ $payment->loan->client->name_kh??''}}</td>
                            <td class="text-left text-nowrap">{{ $payment->loan->client->phone_number??''}}</td>
                            <td class="text-right text-nowrap">{{ $payment->countLateDay() }}</td>
                            <td class="text-right text-nowrap">{{ number_format($payment->loan->pending_amount??0) }}</td>
                            <td class="text-right text-nowrap">{{ number_format($payment->getTotalUnPaidAmount()??0)}}</td>
                            <td class="text-right text-nowrap">{{ number_format($payment->total_paid_amount??0)}}</td>
                            <td class="text-center text-nowrap">​{{ number_format($payment->sort) .'/'.($payment->loan->term?? '') }}</td>
                            <td class="text-left text-nowrap">{{ $payment->loan->client->address??''}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="text-right" colspan="9"><strong>សរុប</strong></td>
                        <td class="text-right text-nowrap">{{ number_format($totalPending) }}</td>
                        <td class="text-right text-nowrap">{{ number_format($totalAmount) }}</td>
                        <td class="text-right text-nowrap">{{ number_format($totalPaidAmount) }}</td>
                        <td class="text-right" colspan="3">PAR : {{ $totalPending <= 0? 'N/A' : sprintf("%.2f%%", ($totalAmount / $totalPending) * 100) }}</td>
                    </tr>
                    <tr>
                        <td class="text-left" colspan="14">យឺត</td>
                    </tr>
                    @php
                        $totalLatePending = 0;
                        $totalLateAmount = 0;
                        $totalLatePaidAmount = 0;
                        $totalLateUnPaidAmount = 0;
                        $i = 1;
                    @endphp
                    @foreach ($late as $payment)
                        @php
                            $totalLatePending += $payment->loan->pending_amount??0;
                            $totalLateAmount += $payment->getTotalUnPaidAmount();
                            $totalLatePaidAmount += $payment->total_paid_amount;
                            $unPaidLateAmount = $payment->total_amount - $payment->total_paid_amount;
                            $totalLateUnPaidAmount += $unPaidLateAmount;
                        @endphp
                        <tr>
                            <td class="text-right text-nowrap">{{ $i++ }}</td>
                            {{-- <td class="text-center text-nowrap"><span class="{{ $payment->_status->css??'' }}">{{ $payment->_status->name??'' }}</span></td> --}}
                            <td class="text-left text-nowrap">{{ $payment->loan->branch->name??''}}</td>
                            <td class="text-center text-nowrap">{{ $payment->payment_date??''}}</td>
                            <td class="text-left text-nowrap">{{ $payment->loan->interest->name??''}}</td>
                            <td class="text-right text-nowrap">{{ number_format(($payment->loan->principal_amount??0)) }}</td>
                            <td class="text-left text-nowrap">{{ $payment->loan->client->code??''}}</td>
                            <td class="text-left text-nowrap">{{ $payment->loan->client->name_kh??''}}</td>
                            <td class="text-left text-nowrap">{{ $payment->loan->client->phone_number??''}}</td>
                            <td class="text-right text-nowrap">{{ $payment->countLateDay() }}</td>
                            <td class="text-right text-nowrap">{{ number_format($payment->loan->pending_amount??0) }}</td>
                            <td class="text-right text-nowrap">{{ number_format($payment->getTotalUnPaidAmount()??0)}}</td>
                            <td class="text-right text-nowrap">{{ number_format($payment->total_paid_amount??0)}}</td>
                            <td class="text-center text-nowrap">​{{ number_format($payment->sort).'/'.($payment->loan->term ?? '') }}</td>
                            <td class="text-left text-nowrap">{{ $payment->loan->client->address??''}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="text-right" colspan="9"><strong>សរុបយឺត</strong></td>
                        <td class="text-right text-nowrap">{{ number_format($totalLatePending) }}</td>
                        <td class="text-right text-nowrap">{{ number_format($totalLateAmount) }}</td>
                        <td class="text-right text-nowrap">{{ number_format($totalLatePaidAmount) }}</td>
                        <td class="text-right" colspan="3">PAR : {{ $totalLatePending <= 0? 'N/A' : sprintf("%.2f%%", ($totalLateAmount / $totalLatePending) * 100) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>        
    </div>
</div>