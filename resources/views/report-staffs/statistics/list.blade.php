<div class="card">    
    <div class="card-header"><strong>ភ្នាក់ងារ-ស្ថិតិ</strong></div>
    <div class="card-body">        
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap align-middle" rowspan="2"></th>
                        <th class="text-center text-nowrap align-middle" rowspan="2">ល.រ</th>
                        <th class="text-center text-nowrap align-middle" rowspan="2">សាខា</th>
                        <th class="text-center text-nowrap align-middle" rowspan="2">ភ្នាក់ងារ</th>
                        <th class="text-center text-nowrap align-middle" colspan="2">បញ្ចេញ</th>                        
                        <th class="text-center text-nowrap align-middle" colspan="2">អតិថិជន</th>                                                
                        <th class="text-center text-nowrap align-middle" rowspan="2">បញ្ចេញថ្មី</th>
                        <th class="text-center text-nowrap align-middle" rowspan="2">សកម្ម</th>
                        <th class="text-center text-nowrap align-middle" rowspan="2">ផ្តាច់</th>
                        <th class="text-center text-nowrap" colspan="3">ប្រាក់ដើម</th>                        
                        <th class="text-center text-nowrap align-middle" rowspan="2">PAR</th>   
                    </tr>
                    <tr>                        
                        <th class="text-center text-nowrap">ចំនួន</th>
                        <th class="text-center text-nowrap">ទឹកប្រាក់</th>
                        <th class="text-center text-nowrap">ថ្មី</th>                        
                        <th class="text-center text-nowrap">ចាស់</th>
                        <th class="text-center text-nowrap">ក្នុងដៃអតិថិជន</th>
                        <th class="text-center text-nowrap">យឺត</th>
                        <th class="text-center text-nowrap">ទឹកប្រាក់យឺត</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $key => $item)
                        <tr>                           
                            <td class="text-center text-nowrap">
                                <a href="{{ route('report-staff.revenue-interest-export',['id' => $item['staff_id']]) }}" class="btn btn-sm btn-info">
                                    <span class="material-icons">file_download</span>
                                </a>
                            </td>
                            <td class="text-right text-nowrap">{{ $key +1 }}</td>
                            <td class="text-left text-nowrap">{{ $item['branch_name'] }}</td>
                            <td class="text-left text-nowrap">{{ $item['staff_name'] }}</td>
                            <td class="text-right text-nowrap">{{ $item['total_loan'] }}</td>
                            <td class="text-right text-nowrap">{{ number_format($item['principal_amount'])}}</td>
                            <td class="text-right text-nowrap">{{ number_format($item['new_loan'])}}</td>
                            <td class="text-right text-nowrap">{{ number_format($item['old_loan'])}}</td>
                            <td class="text-right text-nowrap">{{ number_format($item['loan_for_new_client'])}}</td>
                            <td class="text-right text-nowrap">{{ number_format($item['active_loan'])}}</td>
                            <td class="text-right text-nowrap">{{ number_format($item['inactive_loan'])}}</td>
                            <td class="text-right text-nowrap">{{ number_format($item['sum_total_pending_deduction'] - $item['sum_late_deduction'])}}</td>
                            <td class="text-right text-nowrap">{{ number_format($item['count_late'])}}</td>
                            <td class="text-right text-nowrap">{{ number_format($item['sum_late_deduction'])}}</td>
                            <td class="text-right text-nowrap">{{ $item['par']}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-right">សរុប</td>
                        <td class="text-right font-weight-bold">{{ number_format(array_sum(array_column($items,'total_loan'))) }}</td>
                        <td class="text-right font-weight-bold">{{ number_format(array_sum(array_column($items,'principal_amount')))}}</td>
                        <td class="text-right font-weight-bold">{{ number_format(array_sum(array_column($items,'new_loan')))}}</td>
                        <td class="text-right font-weight-bold">{{ number_format(array_sum(array_column($items,'old_loan')))}}</td>
                        <td class="text-right font-weight-bold">{{ number_format(array_sum(array_column($items,'loan_for_new_client')))}}</td>
                        <td class="text-right font-weight-bold">{{ number_format(array_sum(array_column($items,'active_loan')))}}</td>
                        <td class="text-right font-weight-bold">{{ number_format(array_sum(array_column($items,'inactive_loan')))}}</td>
                        <td class="text-right font-weight-bold">{{ number_format(array_sum(array_column($items,'sum_total_pending_deduction')) - array_sum(array_column($items,'sum_late_deduction')))}}</td>
                        <td class="text-right font-weight-bold">{{ number_format(array_sum(array_column($items,'count_late')))}}</td>
                        <td class="text-right font-weight-bold">{{ number_format(array_sum(array_column($items,'sum_late_deduction')))}}</td>                        
                    </tr>
                </tbody>
            </table>
        </div>  
    </div>
</div>
 