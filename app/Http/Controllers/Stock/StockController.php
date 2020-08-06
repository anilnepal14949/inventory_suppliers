<?php

namespace App\Http\Controllers\Stock;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Session\Store as Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Pagination\LenghtAwarePaginator;

use App\Particular;
use App\Purchase;
use App\Dates;
use App\Sales;
use App\Stock;
use App\Http\Requests\StockRequest;

class StockController extends Controller
{
	protected $uni_data;
    protected $session;
    protected $stock;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct(Session $session, Stock $stock)
    {
		$this->middleware('auth');
		
        $this->session = $session;
        $this->stock = $stock;
		
		$this->uni_data['activeMenu'] = 'stock';
		
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
		$this->uni_data['dates'] = Dates::orderBy('date','desc')->get();
		$this->uni_data['particulars'] = Particular::where('status',0)->get();
		
        return view('stock.index',$this->uni_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stock.new',$this->uni_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StockRequest $request)
    {
        ($request->get('status') == "on")?$status=0:$status=1;
		
		Stock::create([
			'stock_name' => $request->get('stock_name'),
			'description' => $request->get('description'),
			'status' => $status,
		]);
		
		$this->session->flash('store_success_info',"'.$request->get('stock_name').' stock");
        return redirect()->route('add.stock.index');
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
    public function edit(Stock $stock, $id)
    {
        $this->uni_data['part'] = Stock::whereId($id)->whereStatus('0')->first();

        $this->uni_data['stock'] = $stock;

        return view('stock.edit',$this->uni_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StockRequest $request, $id)
    {
        $update = Stock::whereId($id)->whereStatus('0')->first();
		($request->get('status') == "on")?$status=0:$status=1;
		
		$update->fill([
			'stock_name' => $request->get('stock_name'),
			'description' => $request->get('description'),
			'status' => $status,
		])->save();
		
		$this->session->flash('update_success_info','"'.$request->get('stock_name').' customer"');
        return redirect()->route('add.stock.index');
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock, $id)
    {
        $stockName = $stock->customer_name;
        $delete = Stock::whereId($id)->first();

        $delete->delete();
        $this->session->flash('delete_success_info','"'.$stockName.' stock');
        return redirect()->route('add.Stock.index');
    }
}
