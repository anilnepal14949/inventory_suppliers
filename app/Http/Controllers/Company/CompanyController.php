<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Session\Store as Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Pagination\LenghtAwarePaginator;

use App\Company;
use App\Http\Requests\CompanyRequest;

class CompanyController extends Controller
{
	protected $uni_data;
    protected $session;
    protected $company;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct(Session $session, Company $company)
    {
		$this->middleware('auth');
		
        $this->session = $session;
        $this->company = $company;
		
		$this->uni_data['activeMenu'] = 'company';
		
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
		$this->uni_data['companies'] = Company::where('status',0)->paginate(10);
		$this->uni_data['count'] = Company::where('status',0)->get()->count();
		
        return view('Company.index',$this->uni_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Company.new',$this->uni_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        ($request->get('status') == "on")?$status=0:$status=1;
		
		$fileName = '';
        if($request->file('photo')){
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $this->uploadImage('company',$fileName,$request->file('photo'));
        }
		
		Company::create([
			'company_name' => $request->get('company_name'),
			'address' => $request->get('address'),
			'contact_no' => $request->get('contact_no'),
			'photo' => $fileName,
			'status' => $status,
		]);
		
		$this->session->flash('store_success_info','"'.$request->get('company_name').' company"');
        return redirect()->route('add.company.index');
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
    public function edit(Company $company, $id)
    {
        $this->uni_data['custom'] = Company::whereId($id)->whereStatus('0')->first();

        $this->uni_data['company'] = $company;

        return view('company.edit',$this->uni_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $update = Company::whereId($id)->whereStatus('0')->first();
		$photo = $oldPhoto = $update->photo;
		if($request->file('photo')){
			$photo = time().$request->file('photo')->getClientOriginalName();
			$this->uploadImage('company',$photo,$request->file('photo'));
		}else{
			$photo = $oldPhoto;
		}
		($request->get('status') == "on")?$status=0:$status=1;
		
		$update->fill([
			'company_name' => $request->get('company_name'),
			'address' => $request->get('address'),
			'contact_no' => $request->get('contact_no'),
			'photo' => $photo,
			'status' => $status,
		])->save();
		
		$this->session->flash('update_success_info','"'.$request->get('company_name').' company"');
        return redirect()->route('add.company.index');
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company, $id)
    {
        $companyName = $company->company_name;
        $delete = Company::whereId($id)->first();

        $delete->delete();
        $this->session->flash('delete_success_info','"'.$companyName.' company');
        return redirect()->route('add.company.index');
    }
}
