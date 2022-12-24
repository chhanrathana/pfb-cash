
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/css/style.css" rel="stylesheet">
    <table>
        <thead>
            <tr>
                <th class="text-center text-nowrap">បង់លើកទី</th>
                <th class="text-center text-nowrap">សភាព</th>
                <th class="text-center text-nowrap">ថ្ងៃបង់ប្រាក់</th>
                <th class="text-center text-nowrap">ប្រាក់ដើម</th>
                <th class="text-center text-nowrap">ការប្រាក់</th>
                <th class="text-center text-nowrap">សេវាប្រតិបត្តិការ</th>
                <th class="text-center text-nowrap">ប្រាក់ត្រូវបង់សរុប</th>
                <th class="text-center text-nowrap">ប្រាក់ដើមនៅសល់</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loan->payments as $payment)
            <tr>
                <td class="text-right text-nowrap">{{ $payment->sort }}</td>
                <td class="text-center text-nowrap"><span class="{{ $payment->_status->css }}">{{ $payment->_status->name }}</span></td>
                <td>{{ convertDaytoKhmer(date('D',strtotime($payment->getRawOriginal('payment_date')))).' '.$payment->payment_date }}</td>
                <td class="text-right text-nowrap">{{ number_format($payment->deduct_amount) }}</td>
                <td class="text-right text-nowrap">{{ number_format($payment->interest_amount) }} </td>
                <td class="text-right text-nowrap">{{ number_format($payment->commission_amount) }} </td>
                <td class="text-right text-nowrap">{{ number_format($payment->total_amount) }} </td>
                <td class="text-right text-nowrap">{{ number_format($payment->pending_amount) }} </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</html>
