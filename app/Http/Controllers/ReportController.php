<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankAccount;
use App\Models\BankTransaction;
use App\Models\Agent;
use App\Models\File_data;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

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
        // Get all agents for the dropdown
        $agents = Agent::select('id', 'name', 'ain_no')->orderBy('name', 'asc')->get();
        
        if ($request->ajax()) {
            $file_datas = File_data::with('agent')
                ->with('ie_data');

            if (!empty($request->from_date)) {
                $startdate = $request->from_date;
                $enddate = $request->to_date;
                $query = 'date(created_at) between "' . $startdate . '" AND "' . $enddate . '"';
                
            }else {
                $query = 'date(created_at) = "' . now()->format('Y-m-d') . '"';
            }

            $file_datas->whereRaw($query);

            if (!empty($request->agent_id)) {
                $file_datas->where('agent_id', $request->agent_id);
            }

            return DataTables::of($file_datas)->make(true);
        }

        return view('admin.reports.receiver', ['agents' => $agents]);
    }

    // Deliver report
    public function deliver_report(Request $request)
    {
        $agents = Agent::select('id', 'name', 'ain_no')
            ->orderBy('name', 'asc')
            ->get();

        if ($request->ajax()) {
            $query = File_data::query()
                ->with(['agent:id,name,ain_no', 'ie_data:id,name'])
                ->select('file_datas.*')
                ->where('status', 'Printed');

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $query->whereBetween('created_at', [
                    $request->from_date . ' 00:00:00',
                    $request->to_date . ' 23:59:59'
                ]);
            }else {
                $query->whereDate('created_at', now());
            }

            if ($request->filled('agent_id')) {
                $query->where('agent_id', $request->agent_id);
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('lodgement_date', function($row) {
                    return $row->lodgement_date ? date('d M Y', strtotime($row->lodgement_date)) : '';
                })
                ->editColumn('status', function($row) {
                    return '<span class="px-2 py-1 text-xs font-semibold rounded-full ' . 
                           ($row->status === 'Printed' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') . 
                           '">' . $row->status . '</span>';
                })
                ->rawColumns(['status'])
                ->make(true);
        }

        return view('admin.reports.deliverer', ['agents' => $agents]);
    }

    // Operator report
    public function operator_report(Request $request)
    {
        $users = User::role('operator')->get();
        
        if ($request->ajax()) {
            $query = File_data::query()
                ->select([
                    'deliverer_id',
                    DB::raw('COUNT(*) as total_files')
                ])
                ->whereNotNull('deliverer_id')
                ->with('deliverer:id,name');

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $query->whereBetween(DB::raw('DATE(created_at)'), [
                    $request->from_date,
                    $request->to_date
                ]);
            }else {
                $query->whereDate('created_at', now());
            }

            if ($request->filled('deliverer_id')) {
                $query->where('deliverer_id', $request->deliverer_id);
            }

            $query->groupBy('deliverer_id');

            return DataTables::of($query)
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.reports.operator', ['users' => $users]);
    }
}
