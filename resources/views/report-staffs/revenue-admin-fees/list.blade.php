<div class="card">
    <div class="card-header">
        <strong>ភ្នាក់ងារ-ចំណេញសេវារដ្ឋបាល</strong>            
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap">ល.រ</th>
                        <th class="text-center text-nowrap">សាខា</th>
                        <th class="text-center text-nowrap">ភ្នាក់ងារ</th>
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
                    @foreach ($staffs as $staff)
                    @php
                        $totalTransaction = $totalTransaction + $staff->transaction;
                        $totalPrincipalAmount = $totalPrincipalAmount + $staff->total_principal_amount;
                        $totalAdminAmount = $totalAdminAmount + $staff->total_admin_amount;
                    @endphp
                    <tr> 
                        <td class="text-right text-nowrap">{{ $i++ }}</td>
                        <td class="text-center text-nowrap">{{ $staff->branch->name??'' }}</td>
                        <td class="text-left text-nowrap">{{ $staff->name_kh??''}}</td>
                        <td class="text-right text-nowrap">{{ number_format($staff->transaction)}}</td>
                        <td class="text-right text-nowrap">{{ number_format($staff->total_principal_amount)}}</td>
                        <td class="text-right text-nowrap">{{ number_format($staff->total_admin_amount)}}</td>                        
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