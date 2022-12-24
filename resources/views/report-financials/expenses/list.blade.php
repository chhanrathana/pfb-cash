<div class="card">
    
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>តារាង-ចំណាយ</strong></div>           
        </div>
    </div>    
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap">ល.រ</th>
                        <th class="text-center text-nowrap">ប្រភេទចំណាយ</th>
                        <th class="text-center text-nowrap">ទឹកប្រាក់ចំណាយ</th>
                        <th class="text-center text-nowrap">ថ្ងៃចំណាយ</th>
                        <th class="text-center text-nowrap">ពណ៍នាចំណាយ</th>                        
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalExpense = 0;
                    @endphp
                    @foreach($expenses as $expense)
                    @php
                        $totalExpense = $totalExpense + $expense->expense_amount;
                    @endphp
                    <tr>                        
                        <td class="text-right">{{ $loop->index + 1 }}</td>
                        <td>{{$expense->type->name_kh??''}}</td>            
                        <td class="text-right text-nowrap">{{ number_format($expense->expense_amount) }}</td>
                        <td>{{$expense->expense_datetime}}</td>
                        <td>{{$expense->description}}</td>                        
                    </tr>
                    @endforeach
                    <tr>
                        <td class="text-right text-nowrap" colspan="2" >សរុប</td>
                        <td class="text-center text-font-bold" colspan="3"><strong>{{ number_format($totalExpense)}}</strong> </td>                        
                    </tr>   
                </tbody>
            </table>
        </div>
    </div>
</div>