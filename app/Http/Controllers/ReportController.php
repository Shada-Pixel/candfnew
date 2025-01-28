<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankAccount;
use App\Models\BankTransaction;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    public function financialMonth(Request $request){
        $targatedMonth = now()->month;


        if ($request->targatedMonth) {
            $targatedMonth = $request->targatedMonth;
        }


        if ($request->ajax()) {

            $bankTransactions = BankTransaction::with('bankAccount')->whereMonth('transaction_date', $targatedMonth)->orderBy('transaction_date', 'DESC');
            return Datatables::of($bankTransactions)->make(true);
        }


        $bankAccounts = BankAccount::all();
        return view('admin.reports.financialmonthly',['bankAccounts' => $bankAccounts,'thisMonth' => $targatedMonth]);
    }
}
