@props(['company' => $company, 'days' => $days, 'dateDiff' => $dateDiff, 'payments' => $payments])
<?php $init_amount = $company->initial_payment_balance; ?>
<tr id="{{ $company->id }}" class="@if($days < 90 && $days > 6) warning-bg @elseif($days < 5) danger-bg @elseif($days > 356) good-bg @endif">

    <td class="p-3 border border-red-800"><a href="{{ route('companies.company', $company->id ) }}">{{ $company->company_name }}</a></td>
    <td class="">{{ $company->clients->client_name }}</td>
    <td class="">{{ $company->company_reference }}</td>
    <td class="">{{ $company->company_registration_number }}</td>
    <td class="">{{ $company->company_renewal }}</td>
    <td class="">{{ $dateDiff->format("%R%a") }}</td>
    <td class="">
        @foreach($company->payments as $payment)
            <?php $init_amount = $init_amount - $payment->payment_amount; ?>
        @endforeach
        {{ $init_amount }}
    </td>
    <td class="p-3 border border-red-800">
        <form action="{{ route('companies.destroy', $company) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete"> <i class="icon icon-delete" style="background-image: url({{ asset('img/bin.png') }})"></i> Delete</button>
        </form>
    </td>
    <td class="p-3 border border-red-800">
        <form action="">
            <a href="{{ url('companies/edit', $company->id) }}" class="btn btn-edit"><i class="icon icon-edit" style="background-image: url({{ asset('img/edit.png') }})"></i> Edit</a>
        </form>
    </td>
</tr>