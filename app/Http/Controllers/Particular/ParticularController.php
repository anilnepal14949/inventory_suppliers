<?php

namespace App\Http\Controllers\Particular;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Session\Store as Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Pagination\LenghtAwarePaginator;

use App\Particular;
use App\Http\Requests\ParticularRequest;

class ParticularController extends Controller
{
	protected $uni_data;
    protected $session;
    protected $particular;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct(Session $session, Particular $particular)
    {
		$this->middleware('auth');
		
        $this->session = $session;
        $this->particular = $particular;
		
		$this->uni_data['activeMenu'] = 'particular';
		
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
		$this->uni_data['particulars'] = Particular::where('status',0)->get();
		$this->uni_data['count'] = Particular::where('status',0)->get()->count();
		
        return view('particular.index',$this->uni_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('particular.new',$this->uni_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParticularRequest $request)
    {
        ($request->get('status') == "on")?$status=0:$status=1;
		
		Particular::create([
			'particular_name' => $request->get('particular_name'),
			'description' => $request->get('description'),
			'status' => $status,
		]);
		
		$this->session->flash('store_success_info','"'.$request->get('particular_name').' particular"');
        return redirect()->route('add.particular.index');
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
    public function edit(Particular $particular, $id)
    {
        $this->uni_data['part'] = Particular::whereId($id)->whereStatus('0')->first();

        $this->uni_data['particular'] = $particular;

        return view('particular.edit',$this->uni_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParticularRequest $request, $id)
    {
        $update = Particular::whereId($id)->whereStatus('0')->first();
		($request->get('status') == "on")?$status=0:$status=1;
		
		$update->fill([
			'particular_name' => $request->get('particular_name'),
			'description' => $request->get('description'),
			'status' => $status,
		])->save();
		
		$this->session->flash('update_success_info','"'.$request->get('particular_name').' particular"');
        return redirect()->route('add.particular.index');
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Particular $particular, $id)
    {
        $particularName = $particular->customer_name;
        $delete = Particular::whereId($id)->first();

        $delete->delete();
        $this->session->flash('delete_success_info','"'.$particularName.' particular');
        return redirect()->route('add.particular.index');
    }
}
