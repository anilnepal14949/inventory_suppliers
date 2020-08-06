@extends('dashboard')

@section('dashboardContent')
<style>
	.dataTables_filter{
		float:right;
	}
</style>
    <div class="main_div">
        <ol class="breadcrumb" data-appear-animation="fadeInRight" data-appear-delay="1400">
            <li><a href="{{url('home')}}" title="Home"><span class="glyphicon glyphicon-home"></span></a></li>
            <li><span class="glyphicon glyphicon-th-list"></span> Particular </li>
        </ol>
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-md-12 col-lg-12" data-appear-animation="fadeIn" data-appear-delay="1400">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-left"><span class="glyphicon glyphicon-th-list"></span>  All Particulars <span class="badge"> {{$count}} </span></h3>
							<a href="{{route('particular.add-particular.create')}}" class="btn btn-primary pull-right showToolTip" title="Add New Particular" data-placement="left" style="margin-top:-30px;"><span class="glyphicon glyphicon-plus"></span></a>
                        </div>
						<div class="panel-body">		
							<table class="table table-striped bootstrap-datatable datatable responsive">
								<thead>
									<tr>
										<th> S.No </th>
										<th> Particular's Name </th>
										<th> Description </th>
										<th> Actions </th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									@foreach($particulars as $particular)
										<tr>
											<td> {{ $i }} </td>
											<td> <a href="{{route('particular.add-particular.edit',$particular->id)}}" title="{{$particular->particular_name}}">{{ $particular->particular_name }} </td>
											<td> {{ $particular->description }} </td>
											<td>  
												<a href="{{route('particular.add-particular.edit',$particular->id)}}" class="btn btn-info btn-xs showToolTip" title="Edit Customer" data-placement="top"><span class="glyphicon glyphicon-pencil"></span></a>
												
												<!-- <a href="{{route('customer.add-customer.show',$particular->id)}}" class="btn btn-primary btn-xs showToolTip" title="View Customer Profile" data-placement="top"><span class="glyphicon glyphicon-zoom-in"></span></a> -->

												<a href="#" class="btn btn-danger btn-xs showToolTip confirmButton" title="Delete Customer" data-placement="top" data-form-id="mero_form{{$i}}"><span class="glyphicon glyphicon-trash"></span></a>

												{!! delete_form(['particular.add-particular.destroy',$particular->id], 'mero_form'.$i++) !!}
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('dashboardFooter')
@stop