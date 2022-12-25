<div class="card">
    <div class="card-header"><strong>ភ្នាក់ងារ-ចំណេញ</strong></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm">
                <thead>
                <tr>
                    <th class="text-center text-nowrap">ល.រ</th>
                    <th class="text-center text-nowrap">សាខា</th>
                    <th class="text-center text-nowrap">ភ្នាក់ងារ</th>
                    {{-- <th class="text-center text-nowrap">ប្រាក់ដើមសរុប</th> --}}
                    <th class="text-center text-nowrap">ប្រាក់ការសរុប</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $totalPrincipal = 0;
                        $totalRevenue = 0;
                        $i = 0;
                    @endphp
                    @foreach ($staffs as $staff)
                    @php                            
                        // $totalPrincipal = $totalPrincipal + $principal;
                        $totalRevenue = $totalRevenue + $staff->total_revenue_amount;
                        
                    @endphp
                    <tr>
                        <td class="text-right text-nowrap">{{ ++$i }}</td>
                        <td class="text-center text-nowrap">{{ $staff->branch->name??'' }}</td>
                        <td class="text-left text-nowrap">{{ $staff->name_kh??''}}</td>

                        {{-- <td class="text-right text-nowrap">{{ number_format($staff->total_revenue??0)}}</td> --}}
                        <td class="text-right text-nowrap">{{ number_format($staff->total_revenue_amount??0)}}</td>                
                    </tr>
                    @endforeach                       
                <tr>
                    <td colspan="3" class="text-right">សរុប</td>
                    {{-- <td class="text-right font-weight-bold">{{ number_format($totalPrincipal) }}</td> --}}
                    <td class="text-right font-weight-bold">{{number_format( $totalRevenue ) }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>