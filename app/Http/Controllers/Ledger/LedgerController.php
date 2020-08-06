<?php

namespace App\Http\Controllers\Ledger;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\LedgerRequest;

use App\Http\Controllers\Controller;
use Illuminate\Session\Store as Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Pagination\LenghtAwarePaginator;

use App\Particular;
use App\Purchase;
use App\Dates;
use App\Sales;
use App\Stock;
use App\Ledger;
use App\Customer;
use App\Http\Requests\StockRequest;

class LedgerController extends Controller
{
	protected $uni_data;
    protected $session;
    protected $stock;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct(Session $session, Ledger $ledger)
    {
		$this->middleware('auth');
		
        $this->session = $session;
        $this->ledger = $ledger;
		
		$this->uni_data['activeMenu'] = 'ledger';
		
		//$session->clear();
		
        // set session for pop up message.
        $session->has('store_success_info')?$this->uni_data['store_success_info'] = $session->pull('store_success_info'):'';
        $session->has('update_success_info')?$this->uni_data['update_success_info'] = $session->pull('update_success_info'):'';
        $session->has('delete_success_info')?$this->uni_data['delete_success_info'] = $session->pull('delete_success_info'):'';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$this->uni_data['customers'] = Customer::where('status',0)->get();
		$this->uni_data['customer_id'] = 0;
		$this->uni_data['start_date'] = 0;
		$this->uni_data['end_date'] = 0;
		
        return view('ledger.index',$this->uni_data);
    }
	
	public function generate(Request $request){
		$this->uni_data['customers'] = Customer::where('status',0)->get();
		$this->uni_data['customer_id'] = $request->get('customer_id');
		$this->uni_data['start_date'] = $request->get('start_date');
		$this->uni_data['end_date'] = $request->get('end_date');
		
		return view('ledger.generate',$this->uni_data);
	}
	
	public function changeInitialBal(Request $request){		
	
		$id = $request->get('customer_id');
		$total = $request->get('total');
		
		$update = Customer::whereId($id)->whereStatus('0')->first();
		$iniBal = $update->initial_balance;
		
		$update->initial_balance = $total+$iniBal;
		
		$update->save();
		
		return redirect()->route('ledger');
	}
}
