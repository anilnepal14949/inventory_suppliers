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
            <li><span class="glyphicon glyphicon-export"></span> Sales </li>
        </ol>
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-md-12 col-lg-12" data-appear-animation="fadeIn" data-appear-delay="1400">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-left"><span class="glyphicon glyphicon-export"></span>  All Sales <span class="badge"> {{$count}} </span></h3>
							<a href="{{route('sales.add-sales.create')}}" class="btn btn-primary pull-right showToolTip" title="Add New Sales" data-placement="left" style="margin-top:-30px;"><span class="glyphicon glyphicon-plus"></span></a>
                        </div>
						<div class="panel-body">		
							<table class="table table-striped bootstrap-datatable datatable responsive">
								<thead>
									<tr>
										<th> S.No </th>
										<th> Date </th>
										<th> Particular's Name </th>
										<th> Sales To </th>
										<th> Quantity </th>
										<th> Rate </th>
										<th> Total </th>
										<th> Actions </th>
									</tr>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									@foreach($sales as $sale)
										<tr>
											<td> {{ $i }} </td>
											<td> <a href="{{route('sales.add-sales.edit',$sale->id)}}" title="{{$sale->date}}"> {{ $sale->date }} </a> </td>
											<td> <?php $particular = App\Particular::where('id',$sale->particular_id)->first()->particular_name; echo $particular; ?> </td>
											<td> <?php echo App\Customer::where('id',$sale->sales_to)->first()->customer_name; ?> </td>
											<td> @if ($particular=='Egg'){{ $sale->quantity }} <?php $totalEggQ = $sale->quantity*7; echo "(".$sale->quantity." * 7 = ".$totalEggQ.")"; ?> @else {{$sale->quantity}} @endif </td>
											<td> Rs. {{ $sale->rate }} </td>
											<td> Rs. {{$sale->quantity*$sale->rate}} </td>
											<td>  
												<a href="{{route('sales.add-sales.edit',$sale->id)}}" class="btn btn-info btn-xs showToolTip" title="Edit Sales" data-placement="top"><span class="glyphicon glyphicon-pencil"></span></a>
												
												<!-- <a href="{{route('customer.add-customer.show',$sale->id)}}" class="btn btn-primary btn-xs showToolTip" title="View Customer Profile" data-placement="top"><span class="glyphicon glyphicon-zoom-in"></span></a> -->

												<a href="#" class="btn btn-danger btn-xs showToolTip confirmButton" title="Delete Sales" data-placement="top" data-form-id="mero_form{{$i}}"><span class="glyphicon glyphicon-trash"></span></a>

												{!! delete_form(['sales.add-sales.destroy',$sale->id], 'mero_form'.$i++) !!}
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