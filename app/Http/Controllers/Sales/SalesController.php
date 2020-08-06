<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Session\Store as Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Pagination\LenghtAwarePaginator;

use App\Sales;
use App\Customer;
use App\Dates;
use App\Http\Requests\SalesRequest;

class SalesController extends Controller
{
	protected $uni_data;
    protected $session;
    protected $sales;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct(Session $session, Sales $sales)
    {
		$this->middleware('auth');
		
        $this->session = $session;
        $this->sales = $sales;
		
		$this->uni_data['activeMenu'] = 'sales';
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
		$this->uni_data['sales'] = Sales::where('status',0)->orderBy('date','desc')->get();
		$this->uni_data['count'] = Sales::where('status',0)->get()->count();
		
        return view('sales.index',$this->uni_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.new',$this->uni_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalesRequest $request)
    {
        ($request->get('status') == "on")?$status=0:$status=1;
		$sales_id = "sales".$request->get('sales_date').$request->get('sales_to').$request->get('particular_id');
		
		Sales::create([
			'sales_id' => $sales_id,
			'date' => $request->get('sales_date'),
			'sales_to' => $request->get('sales_to'),
			'particular_id' => $request->get('particular_id'),
			'quantity' => $request->get('quantity'),
			'rate' => $request->get('rate'),
			'status' => $status,
		]);
		
		Dates::create([
			'date' => $request->get('sales_date'),
			'purchase_id' => 0,
			'purchase' => 0,
			'purchase_quantity' => 0,
			'purchase_rate' => 0,
			'sales_id' => $sales_id,
			'sales' => $request->get('particular_id'),
			'sales_to' => $request->get('sales_to'),
			'sales_quantity' => $request->get('quantity'),
			'sales_rate' => $request->get('rate'),
		]);
		
		$this->session->flash('store_success_info','" sales on '.$request->get('sales_date').'"');
        return redirect()->route('add.sales.index');
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
    public function edit(Sales $sales, $id)
    {
        $this->uni_data['sal'] = Sales::whereId($id)->whereStatus('0')->first();

        $this->uni_data['sales'] = $sales;

        return view('sales.edit',$this->uni_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SalesRequest $request, $id)
    {
        $update = Sales::whereId($id)->whereStatus('0')->first();
		
		$old_sales_id = "sales".$update->date.$update->sales_to.$update->particular_id;
		
		$new_sales_id = "sales".$request->get('sales_date').$request->get('sales_to').$request->get('particular_id');
		
		$date = Dates::where('sales_id',$old_sales_id)->first();
		($request->get('status') == "on")?$status=0:$status=1;
		
		$update->fill([
			'sales_id' => $new_sales_id,
			'date' => $request->get('sales_date'),
			'sales_to' => $request->get('sales_to'),
			'particular_id' => $request->get('particular_id'),
			'quantity' => $request->get('quantity'),
			'rate' => $request->get('rate'),
			'status' => $status,
		])->save();
		
		$date->fill([
			'date' => $request->get('sales_date'),
			'purchase_id' => 0,
			'purchase' => 0,
			'purchase_quantity' => 0,
			'purchase_rate' => 0,
			'sales_id' => $new_sales_id,
			'sales' => $request->get('particular_id'),
			'sales_to' => $request->get('sales_to'),
			'sales_quantity' => $request->get('quantity'),
			'sales_rate' => $request->get('rate'),
		])->save();
		
		$this->session->flash('update_success_info','" sales on '.$request->get('sales_date').'"');
        return redirect()->route('add.sales.index');
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sales $sales, $id)
    {
        $salesName = $sales->customer_name;
        $delete = Sales::whereId($id)->first();
		
		$old_sales_id = "sales".$delete->date.$delete->sales_to.$delete->particular_id;
		$date = Dates::where('sales_id',$old_sales_id)->first();

        $delete->delete();
		$date->delete();
		
        $this->session->flash('delete_success_info','"'.$salesName.' sales');
        return redirect()->route('add.sales.index');
    }
}
