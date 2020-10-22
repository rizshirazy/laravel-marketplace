<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $customer = User::where('roles', 'USER')->count();
        $revenue = Transaction::where('transaction_status', 'SUCCESS')->sum('total_price');
        $transaction = Transaction::count();

        return view('pages.admin.dashboard', [
            'customer'      => $customer,
            'revenue'       => $revenue,
            'transaction'   => $transaction
        ]);
    }
}
