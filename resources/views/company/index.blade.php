@extends('dashboard')

@section('dashboardContent')
<style>
	.dataTables_filter{
		float:right;
	}
</style>
    <div class="main_div">
        <ol class="breadcrumb" data-appear-animation="slideInRight" data-appear-delay="400">
            <li><a href="{{url('home')}}" title="Home"><span class="glyphicon glyphicon-home"></span></a></li>
            <li><span class="glyphicon glyphicon-calendar"></span> Company </li>
        </ol>
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-md-12 col-lg-12" data-appear-animation="fadeIn" data-appear-delay="1400">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-left"><span class="glyphicon glyphicon-user"></span>  All Companies <span class="badge"> {{$count}} </span></h3>
							<a href="{{route('company.add-company.create')}}" class="btn btn-primary pull-right showToolTip" title="Add New Company" data-placement="left" style="margin-top:-30px;"><span class="glyphicon glyphicon-plus"></span></a>
                        </div>
						<div class="panel-body">		
							<table class="table table-striped bootstrap-datatable datatable responsive">
								<thead>
									<tr>
										<th> S.No </th>
										<th> Company Name </th>
										<th> Address </th>
										<th> Contact Number </th>
										<th> Photo </th>
										<th> Actions </th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									@foreach($companies as $com)
										<tr>
											<td> {{ $i }} </td>
											<td> <a href="{{route('company.add-company.edit',$com->id)}}" title="{{$com->company_name}}">{{ $com->company_name }} </td>
											<td> {{ $com->address }} </td>
											<td> {{ $com->contact_no }} </td>
											<td> <img src="{{asset('public/images/company/'.$com->photo)}}" title="{{$com->company_name}}" width="100" height="100" /> </td>
											<td>  
												<a href="{{route('company.add-company.edit',$com->id)}}" class="btn btn-info btn-xs showToolTip" title="Edit Company" data-placement="top"><span class="glyphicon glyphicon-pencil"></span></a>
												
												<!-- <a href="{{route('company.add-company.show',$com->id)}}" class="btn btn-primary btn-xs showToolTip" title="View Company Profile" data-placement="top"><span class="glyphicon glyphicon-zoom-in"></span></a> -->

												<a href="#" class="btn btn-danger btn-xs showToolTip confirmButton" title="Delete Company" data-placement="top" data-form-id="mero_form{{$i}}"><span class="glyphicon glyphicon-trash"></span></a>

												{!! delete_form(['company.add-company.destroy',$com->id], 'mero_form'.$i++) !!}
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
                        </div>
						@if($companies != '')	
                        <div class="panel-footer">
							{{ $companies->render() }}
                        </div>
						@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('dashboardFooter')
@stop