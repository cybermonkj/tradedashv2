@extends('layouts.atlantis.layout')
@section('content')
    <div class="container">
        <div class="p-2 shadow card">
            <form action="{{ route('coupon.deposit') }}" method="POST">
                @csrf
                <div class="mb-3 input-group">
                    <span class="input-group-text" id="basic-addon">$</span>
                    <input type="number" class="form-control" placeholder="30" name="amount" aria-label="amount" aria-describedby="basic-amount">
                </div>
                <div class="mb-3 input-group">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-secret"></i></span>
                    <input type="text" class="form-control" placeholder="Deposit" name="deposit_code" aria-label="code" aria-describedby="basic-code">
                </div>
    
                <div class="py-4">
                    <input type="submit" value="Validate" class="btn btn-info">
                </div>
            </form>
        </div>
    </div>
@endsection