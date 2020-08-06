<?php

namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Session\Store as Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Pagination\LenghtAwarePaginator;

use App\Purchase;
use App\Customer;
use App\Dates;
use App\InitialBalance;
use App\Http\Requests\PurchaseRequest;

class PurchaseController extends Controller
{
	protected $uni_data;
    protected $session;
    protected $purchase;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct(Session $session, Purchase $purchase)
    {
		$this->middleware('auth');
		
        $this->session = $session;
        $this->purchase = $purchase;
		
		$this->uni_data['activeMenu'] = 'purchase';
		$this->uni_data['customers'] = Customer::where('status',0)->get();	
		
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
		$this->uni_data['purchases'] = Purchase::where('status',0)->orderBy('date','desc')->get();
		$this->uni_data['count'] = Purchase::where('status',0)->get()->count();
		
        return view('purchase.index',$this->uni_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchase.new',$this->uni_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequest $request)
    {
        ($request->get('status') == "on")?$status=0:$status=1;
		$purchase_id = "purchase".$request->get('purchased_date').$request->get('purchased_from').$request->get('particular_id');
		
		Purchase::create([
			'purchase_id' => $purchase_id,
			'date' => $request->get('purchased_date'),
			'purchased_from' => $request->get('purchased_from'),
			'particular_id' => $request->get('particular_id'),
			'quantity' => $request->get('quantity'),
			'rate' => $request->get('rate'),
			'status' => $status,
		]);
		
		Dates::create([
			'date' => $request->get('purchased_date'),
			'purchase_id' => $purchase_id,
			'purchase' => $request->get('particular_id'),
			'purchased_from' => $request->get('purchased_from'),
			'purchase_quantity' => $request->get('quantity'),
			'purchase_rate' => $request->get('rate'),
			'sales_id' => 0,
			'sales' => 0,
			'sales_quantity' => 0,
			'sales_rate' => 0,
		]);
		
		$this->session->flash('store_success_info','" purchase on '.$request->get('purchased_date').'"');
        return redirect()->route('add.purchase.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase, $id)
    {
        $this->uni_data['pur'] = Purchase::whereId($id)->whereStatus('0')->first();

        $this->uni_data['purchase'] = $purchase;

        return view('purchase.edit',$this->uni_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseRequest $request, $id)
    {
        $update = Purchase::whereId($id)->whereStatus('0')->first();
		
		$old_purchase_id = "purchase".$update->date.$update->purchased_from.$update->particular_id;
		
		$new_purchase_id = "purchase".$request->get('purchased_date').$request->get('purchased_from').$request->get('particular_id');
		
		$date = Dates::where('purchase_id',$old_purchase_id)->first();
		
		($request->get('status') == "on")?$status=0:$status=1;
		
		$update->fill([
			'date' => $request->get('purchased_date'),
			'purchase_id' => $new_purchase_id,
			'purchased_from' => $request->get('purchased_from'),
			'particular_id' => $request->get('particular_id'),
			'quantity' => $request->get('quantity'),
			'rate' => $request->get('rate'),
			'status' => $status,
		])->save();
		
		$date->fill([
			'date' => $request->get('purchased_date'),
			'purchase_id' => $new_purchase_id,
 			'purchase' => $request->get('particular_id'),
			'purchased_from' => $request->get('purchased_from'),
			'purchase_quantity' => $request->get('quantity'),
			'purchase_rate' => $request->get('rate'),
			'sales_id' => 0,
			'sales' => 0,
			'sales_quantity' => 0,
			'sales_rate' => 0,
		])->save();
		
		$this->session->flash('update_success_info','" purchase on '.$request->get('purchased_date').'"');
        return redirect()->route('add.purchase.index');
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase, $id)
    {
        $purchaseName = $purchase->customer_name;
        $delete = Purchase::whereId($id)->first();
		
		$old_purchase_id = "purchase".$delete->date.$delete->purchased_from.$delete->particular_id;
		$date = Dates::where('purchase_id',$old_purchase_id)->first();

        $delete->delete();
		$date->delete();
        $this->session->flash('delete_success_info','"'.$purchaseName.' purchase');
        return redirect()->route('add.purchase.index');
    }
}
