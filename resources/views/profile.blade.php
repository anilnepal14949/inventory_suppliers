@extends('dashboard')
<?php
    use App\User;
	$users = User::all();
?>
@section('dashboardContent')
<style>
	.panel-body td{
		font-family:Tahoma;
	}
</style>
    <div class="main_div">
        <ol class="breadcrumb">
            <li><a href="{{url('home')}}" title="Home"><span class="glyphicon glyphicon-home"></span></a></li>
			<li><a href="{{url('settings')}}" title="Home"><span class="glyphicon glyphicon-cog"></span> सेटिङ्गहरु </a></li>
            <li><span class="glyphicon glyphicon-user"></span> संचालन व्यवस्थापन  </li>
        </ol>
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-md-12 col-lg-12" data-appear-animation="fadeIn" data-appear-delay="1400">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> प्रणाली संचालन गर्ने व्यक्तिहरु  </h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-responsive">
                                <tr>
                                    <th> नं. </th>
                                    <th> नाम </th>
                                    <th> ई-मेल	</th>
                                    <th> Admin/User? </th>
                                    <th> कार्यहरु </th>
                                </tr>
                                @if($users)
                                    <?php $i = 1; ?>
                                    @foreach($users as $u)
                                        <tr>
                                            <td>
                                                {!! $i !!}
                                            </td>
                                            <td>
                                                {!!	$u->name !!}
                                            </td>
                                            <td>
												{!!	$u->email !!}
                                            </td>
                                            <td>
												<?php $type = DB::table('users_type')->where('id',$u->users_type_id)->first()->type_name; ?>
												{!!	$type !!}
                                            </td>                                            
                                            <td>
												<a href="{{route('profile.add-profile.edit',$u->id)}}" class="btn btn-info btn-xs showToolTip" title="सच्याउनुहोस" data-placement="top"><span class="glyphicon glyphicon-pencil"></span></a>
                                                <a href="#" class="btn btn-danger btn-xs showToolTip confirmButton" title="हटाउनुहोस" data-placement="top" data-form-id="mero_form{{$i}}"><span class="glyphicon glyphicon-trash"></span></a>

                                                {!! delete_form(['profile.add-profile.destroy',$u->id], 'mero_form'.$i++) !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">
                                            <div class="alert alert-info" role="alert"> कुनै पनि डाटा छैन| </div>
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop