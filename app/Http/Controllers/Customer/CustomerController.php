<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Session\Store as Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Pagination\LenghtAwarePaginator;

use App\Customer;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{
	protected $uni_data;
    protected $session;
    protected $customer;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct(Session $session, Customer $customer)
    {
		$this->middleware('auth');
		
        $this->session = $session;
        $this->customer = $customer;
		
		$this->uni_data['activeMenu'] = 'customer';
		
		//$session->clear();
		
        // set session for pop up message.
        $session->has('store_success_info')?$this->uni_data['store_success_info'] = $session->pull('store_success_info'):'';
        $session->has('update_success_info')?$this->uni_data['update_success_info'] = $session->pull('update_success_info'):'';
        $session->has('delete_success_info')?$this->uni_data['delete_success_info'] = $session->pull('delete_success_info'):'';
		$session->has('redirect_to')?$this->uni_data['redirect_to'] = $session->pull('redirect_to'):'';
        $session->has('page_linker')?$this->uni_data['page_linker'] = $session->pull('page_linker'):'';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$this->uni_data['customers'] = Customer::where('status',0)->get();
		$this->uni_data['count'] = Customer::where('status',0)->get()->count();
		
        return view('customer.index',$this->uni_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.new',$this->uni_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        ($request->get('status') == "on")?$status=0:$status=1;
		
		$fileName = '';
        if($request->file('photo')){
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $this->uploadImage('customer',$fileName,$request->file('photo'));
        }
		
		Customer::create([
			'customer_type' => $request->get('customer_type'),
			'initial_balance' => $request->get('initial_balance'),
			'customer_name' => $request->get('customer_name'),
			'address' => $request->get('address'),
			'contact_no' => $request->get('contact_no'),
			'photo' => $fileName,
			'status' => $status,
		]);
		
		$this->session->flash('store_success_info','"'.$request->get('customer_name').' customer"');
        return redirect()->route('add.customer.index');
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
    public function edit(Customer $customer, $id)
    {
        $this->uni_data['custom'] = Customer::whereId($id)->whereStatus('0')->first();

        $this->uni_data['customer'] = $customer;

        return view('customer.edit',$this->uni_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        $update = Customer::whereId($id)->whereStatus('0')->first();
		$photo = $oldPhoto = $update->photo;
		if($request->file('photo')){
			$photo = time().$request->file('photo')->getClientOriginalName();
			$this->uploadImage('customer',$photo,$request->file('photo'));
		}else{
			$photo = $oldPhoto;
		}
		($request->get('status') == "on")?$status=0:$status=1;
		
		$update->fill([
			'customer_type' => $request->get('customer_type'),
			'initial_balance' => $request->get('initial_balance'),
			'customer_name' => $request->get('customer_name'),
			'address' => $request->get('address'),
			'contact_no' => $request->get('contact_no'),
			'photo' => $photo,
			'status' => $status,
		])->save();
		
		$this->session->flash('update_success_info','"'.$request->get('customer_name').' customer"');
        return redirect()->route('add.customer.index');
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer, $id)
    {
        $customerName = $customer->customer_name;
        $delete = Customer::whereId($id)->first();
		
		

        $delete->delete();
        $this->session->flash('delete_success_info','"'.$customerName.' customero');
        return redirect()->route('add.customer.index');
    }
}
