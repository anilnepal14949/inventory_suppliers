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
            <li><span class="glyphicon glyphicon-import"></span> Purchase </li>
        </ol>
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-md-12 col-lg-12" data-appear-animation="fadeIn" data-appear-delay="1400">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-left"><span class="glyphicon glyphicon-import"></span>  All Purchases <span class="badge"> {{$count}} </span></h3>
							<a href="{{route('purchase.add-purchase.create')}}" class="btn btn-primary pull-right showToolTip" title="Add New Purchase" data-placement="left" style="margin-top:-30px;"><span class="glyphicon glyphicon-plus"></span></a>
                        </div>
						<div class="panel-body">		
							<table class="table table-striped bootstrap-datatable datatable responsive">
								<thead>
									<tr>
										<th> S.No </th>
										<th> Date </th>
										<th> Particular's Name </th>
										<th> Purchased From </th>
										<th> Quantity </th>
										<th> Rate </th>
										<th> Total </th>
										<th> Actions </th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									@foreach($purchases as $purchase)
										<tr>
											<td> {{ $i }} </td>
											<td> <a href="{{route('purchase.add-purchase.edit',$purchase->id)}}" title="{{$purchase->date}}"> {{ $purchase->date }} </a> </td>
											<td> <?php $particular = App\Particular::where('id',$purchase->particular_id)->first()->particular_name; echo $particular; ?> </td>
											<td> <?php echo App\Customer::where('id',$purchase->purchased_from)->first()->customer_name; ?> </td>
											<td> @if ($particular=='Egg'){{ $purchase->quantity }} <?php $totalEggQ = $purchase->quantity*7; echo "(".$purchase->quantity." * 7 = ".$totalEggQ.")"; ?> @else {{$purchase->quantity}} @endif </td>
											<td> Rs. {{ $purchase->rate }} </td>
											<td> Rs. @if ($particular=='Egg') {{ $purchase->quantity*7*$purchase->rate }} @else {{ $purchase->quantity*$purchase->rate }} @endif </td>
											<td>  
												<a href="{{route('purchase.add-purchase.edit',$purchase->id)}}" class="btn btn-info btn-xs showToolTip" title="Edit Purchase" data-placement="top"><span class="glyphicon glyphicon-pencil"></span></a>
												
												<!-- <a href="{{route('customer.add-customer.show',$purchase->id)}}" class="btn btn-primary btn-xs showToolTip" title="View Customer Profile" data-placement="top"><span class="glyphicon glyphicon-zoom-in"></span></a> -->

												<a href="#" class="btn btn-danger btn-xs showToolTip confirmButton" title="Delete Purchase" data-placement="top" data-form-id="mero_form{{$i}}"><span class="glyphicon glyphicon-trash"></span></a>

												{!! delete_form(['purchase.add-purchase.destroy',$purchase->id], 'mero_form'.$i++) !!}
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