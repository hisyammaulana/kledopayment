@extends('payments')
@section('content')
<div class="text-center">
    <a href="{{route('payment.create')}}" class="btn btn-success text-center">Tambah Data</a>
</div>
<br>
<table class="table table-bordered table-stripped table-hover mt-4 text-center">
    <thead style="font-weight: bold; background: #9e9e9e">
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>Delete</td>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @forelse ($payments as $payment)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $payment->name }}</td>
                <td>

                    <input type="checkbox" name="" id="checkbox-delete" data-id="{{ $payment->id }}">

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" style="text-align: center">Tidak ada data</td>
            </tr>
        @endforelse
    </tbody>
</table>
<button class="btn btn-danger btn-delete">Delete</button>
@endsection