@extends('layouts.app')
@section('body-id', 'dashboard')
@section('content')
    <?php $init_amount = $company->initial_payment_balance; $paid_amount = 0; ?>
    <div class="flex flex-wrap justify-center mt-5">
        <div class="heading w-10/12 p-5 mx-auto">
            <h1>{{ $company->company_name }}</h1>
        </div>
        <div class="w-10/12 p-5 mx-auto bg-white flex flex-wrap">
            <div class="w-6/12 mb-5">
                <strong>Company reference number:</strong> <br>
                {{ $company->company_reference }}
            </div>

            <div class="w-6/12 mb-5">
                <strong>Company registration number:</strong> <br>
                {{ $company->company_registration_number }}
            </div>

            <div class="w-6/12 mb-5">
                <strong>Company owner:</strong> <br>
                {{ $company->clients->client_name }}
            </div>

            <div class="w-6/12 mb-5">
                <strong>Company renewal date:</strong> <br>
                {{ $company->company_renewal }}
            </div>

            <div class="w-6/12 mb-5">
                <strong>Company details capture on:</strong> <br>
                {{ $company->created_at }}
            </div>

            <div class="w-6/12 mb-5">
                <strong>Company details modified at:</strong> <br>
                {{ $company->updated_at }}
            </div>
        </div>
        <div class="w-10/12 p-5 mx-auto bg-primary-fade rounded flex flex-wrap">

            <div class="w-full mb-5">
                <h2>Payments</h2>
                <table class="w-full bg-white">
                    <tr class="text-left">
                        <th class="p-3 border border-red-800">Invoice number</th>
                        <th class="p-3 border border-red-800">Payment for</th>
                        <th class="p-3 border border-red-800">Payment amount</th>
                        <th class="p-3 border border-red-800">Payment date</th>
                        <th class="p-3 border border-red-800">Total amount paid</th>
                        <th class="p-3 border border-red-800">Total amount outstanding</th>
                        <th class="p-3 border border-red-800">Action</th>
                    </tr>
                    @foreach($company->payments as $payment)
                        <?php
                        $init_amount = $init_amount - $payment->payment_amount;
                        $paid_amount = $paid_amount + $payment->payment_amount;
                        ?>
                        <tr>
                            <td class="p-3 border border-red-800">{{ $payment->invoice_number }}</td>
                            <td class="p-3 border border-red-800">{{ $payment->payment_for }}</td>
                            <td class="p-3 border border-red-800">{{ $payment->payment_amount }}</td>
                            <td class="p-3 border border-red-800">{{ $payment->payment_date }}</td>
                            <td class="p-3 border border-red-800">{{ $paid_amount }}</td>
                            <td class="p-3 border border-red-800">{{ $init_amount }}</td>
                            <td class="p-3 border border-red-800">
                                <form action="{{ route('payments.destroy', $payment) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete"> <i class="icon icon-delete" style="background-image: url({{ asset('img/bin.png') }})"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
