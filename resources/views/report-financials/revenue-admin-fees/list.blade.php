<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>ចំនូលសេវារដ្ឋបាលប្រចាំថ្ងៃ</strong></div>            
        </div>
    </div>
    <div class="card-body">        
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap">ល.រ</th>
                        <th class="text-center text-nowrap">សាខា</th>
                        <th class="text-center text-nowrap">ថ្ងៃខ្ចី</th>
                        <th class="text-center text-nowrap">ប្រតិបត្តិការ</th>
                        <th class="text-center text-nowrap">ប្រាក់ដើម</th>
                        <th class="text-center text-nowrap">សេវារដ្ឋបាល</th>                        
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalTransaction = 0;
                        $totalPrincipalAmount = 0;
                        $totalAdminAmount = 0;
                        $totalInterestAmount = 0;
                    @endphp
                    
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($loans as $loan)
                    @php
                        $totalTransaction = $totalTransaction + $loan->transaction;
                        $totalPrincipalAmount = $totalPrincipalAmount + $loan->total_principal_amount;
                        $totalAdminAmount = $totalAdminAmount + $loan->total_admin_amount;
                    @endphp
                    <tr>           
                                  
                        <td class="text-right text-nowrap">{{ $i++ }}</td>
                        <td class="text-center text-nowrap">{{ $loan->branch->name??'' }}</td>
                        <td class="text-center text-nowrap">{{ $loan->registration_date }}</td>
                        <td class="text-right text-nowrap">{{ number_format($loan->transaction)}}</td>
                        <td class="text-right text-nowrap">{{ number_format($loan->total_principal_amount)}}</td>
                        <td class="text-right text-nowrap">{{ number_format($loan->total_admin_amount)}}</td>                        
                    </tr>
                    @endforeach

                    <tr>
                        <td colspan="3" class="text-right text-nowrap">សរុប</td>
                        <td class="text-right text-font-bold"><strong>{{ number_format($totalTransaction)}}</strong> </td>
                        <td class="text-right text-font-bold"><strong>{{ number_format($totalPrincipalAmount)}}</strong> </td>
                        <td class="text-right text-font-bold"><strong>{{ number_format($totalAdminAmount)}}</strong></td>
                    </tr>                    
                </tbody>
            </table>
        </div>
    </div>
</div>