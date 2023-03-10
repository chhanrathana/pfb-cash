
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>ចំនូលការប្រាក់ប្រចាំថ្ងៃ</strong></div>            
        </div>
    </div>

    <div class="card-body">        
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap align-middle"></th>
                        <th class="text-center text-nowrap">ល.រ</th>
                        <th class="text-center text-nowrap">សាខា</th>
                        <th class="text-center text-nowrap">ថ្ងៃបង់ប្រាក់</th>
                        <th class="text-center text-nowrap">ប្រតិបត្តិការ</th>
                        <th class="text-center text-nowrap">ប្រាក់បានបង់</th>
                        <th class="text-center text-nowrap">ប្រាក់ដើម</th>
                        <th class="text-center text-nowrap">ប្រាក់ការសរុប</th>                        
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalTransaction = 0;
                        $totalPaidAmount = 0;
                        $totalDeductionAmount = 0;
                        $totalInterestAmount = 0;
                    @endphp
                    
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($payments as $payment)
                    @php
                        $totalTransaction = $totalTransaction + $payment->count_transaction;
                        $totalPaidAmount = $totalPaidAmount + $payment->total_transaction_amount;
                        $totalDeductionAmount = $totalDeductionAmount + $payment->total_deduct_amount;
                        $totalInterestAmount = $totalInterestAmount + $payment->total_revenue_amount;
                    @endphp
                    <tr>           
                        <td class="text-center text-nowrap">
                            <a href="{{ route('report-financial.revenue-interest-export',['branch_id' => $payment->branch_id, 'transaction_date' => $payment->transaction_date])}}" class="btn btn-sm btn-info">
                                <span class="material-icons">file_download</span>
                            </a>
                        </td>
                        <td class="text-right text-nowrap">{{ $i++ }}</td>
                        <td class="text-center text-nowrap">{{ $payment->branch->name??'' }}</td>
                        <td class="text-center text-nowrap">{{ $payment->transaction_date }}</td>
                        <td class="text-right text-nowrap">{{ number_format($payment->count_transaction)}}</td>
                        <td class="text-right text-nowrap">{{ number_format($payment->total_transaction_amount)}}</td>
                        <td class="text-right text-nowrap">{{ number_format($payment->total_deduct_amount)}}</td>
                        <td class="text-right text-nowrap">{{ number_format($payment->total_revenue_amount)}}</td>                        
                    </tr>
                    @endforeach

                    <tr>
                        <td colspan="4" class="text-right text-nowrap">សរុប</td>
                        <td class="text-right text-font-bold"><strong>{{ number_format($totalTransaction)}}</strong> </td>
                        <td class="text-right text-font-bold"><strong>{{ number_format($totalPaidAmount)}}</strong> </td>
                        <td class="text-right text-font-bold"><strong>{{ number_format($totalDeductionAmount)}}</strong></td>
                        <td class="text-right text-font-bold"><strong>{{ number_format($totalInterestAmount)}}</strong></td>                             
                    </tr>                    
                </tbody>
            </table>
        </div>
    </div>
</div>