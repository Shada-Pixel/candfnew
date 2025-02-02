<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankAccount;
use App\Models\BankTransaction;
use App\Models\Agent;
use App\Models\File_data;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    // Financial report Monthly
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

    // Receiver report
    public function receiver_report(Request $request)
    {
        $i = 0;
        $agents = Agent::pluck('name', 'id');
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $startdate = $request->from_date;
                $enddate = $request->to_date;
                $query = 'date(lodgement_date) between "' . $startdate . '" AND "' . $enddate . '"';
                $file_datas = File_data::whereRaw($query)->with('agent')->with('ie_data')->get();
            } else {
                $djloldate = 'date(lodgement_date) between "2023-01-01" AND "2023-12-31"';
                $file_datas = File_data::whereRaw($djloldate)->with('agent')->with('ie_data')->limit(2000)->get();
            }
            return DataTables::of($file_datas)->make(true);
        }
        return view('admin.reports.receiver');
    }

    // Deliver report
    public function deliver_report(Request $request)
    {
        $i = 0;
        $agents = Agent::pluck('name', 'id');
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $startdate = $request->from_date;
                $enddate = $request->to_date;
                $agent_id = $request->agent_id;

                $query = 'date(created_at) between "' . $startdate . '" AND "' . $enddate . '"';
                if ($agent_id == '') {
                    $file_datas = File_data::whereRaw($query)->where('status', 'Delivered')->with('agent')->with('ie_data')->get();
                } else {
                    $file_datas = File_data::whereRaw($query)->where('status', 'Delivered')->where('agent_id', $request->agent_id)->with('agent')->with('ie_data')->get();
                }
            } else {
                $file_datas = File_data::where('status', 'Delivered')->with('agent')->with('ie_data')->get();
            }
            return DataTables::of($file_datas)->make(true);
        }
        return view('admin.reports.deliverer',['agents' => $agents,'i' => $i]);
    }


}
