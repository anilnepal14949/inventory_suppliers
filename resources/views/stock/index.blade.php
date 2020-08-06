@extends('dashboard')

@section('dashboardContent')
<?php use Illuminate\Support\Facades\DB; ?>
<style>
	.dataTables_filter{
		float:right;
	}
</style>
    <div class="main_div">
        <ol class="breadcrumb" data-appear-animation="fadeInRight" data-appear-delay="1400">
            <li><a href="{{url('home')}}" title="Home"><span class="glyphicon glyphicon-home"></span></a></li>
            <li><span class="glyphicon glyphicon-transfer"></span> Stock </li>
        </ol>
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-md-12 col-lg-12" data-appear-animation="fadeIn" data-appear-delay="1400">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-left"><span class="glyphicon glyphicon-transfer"></span>  Stocks Remaining </h3>
							<a href="#stockRemaining" class="btn btn-primary pull-right" style="margin-top:-27px;"> View Stocks Remaining </a>
                        </div>
						<div class="panel-body">		
							<table class="table table-striped bootstrap-datatable datatable responsive" id="stockTable">
								<thead>
									<tr>
										<th> S.No </th>
										<th> Date </th>
										<th> Particular's Name </th>
										<th> Purchased Quantity </th>
										<th> Purchase Rate </th>
										<th> Sales Quantity </th>
										<th> Sales Rate </th>
										<th> Stock Remaining </th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; $totalPurchase = 0; $totalSales = 0; ?>
									@foreach($dates as $date)
									<tr>
										<td> {{$i}} </td>
										<td>{{$date->date}}</td>
										
										<?php $particular = App\Particular::where('id',$date->purchase)->orWhere('id',$date->sales)->first()->particular_name; ?>
										<td> {{$particular}} </td>
										<td> {{$date->purchase_quantity}} </td>
										<td> @if($date->purchase_rate>0) {{$date->purchase_rate}} @else 0 @endif</td>
										<td> {{$date->sales_quantity}} </td>
										<td> @if($date->sales_rate>0) {{$date->sales_rate}} @else 0 @endif </td>
										<td> {{$date->purchase_quantity-$date->sales_quantity}} </td>
									</tr>	
									<?php $i++; ?>	
									@endforeach
								</tbody>
							</table>
							<a name="stockRemaining"></a>
							@foreach($particulars as $particular)
								<hr />
								<?php $dates=App\Dates::where('purchase',$particular->id)->orWhere('sales',$particular->id)->orderBy('date','desc')->get(); ?>
								<table class="table table-striped bootstrap-datatable datatable responsive" style="margin-top:15px;">
									<caption> {{$particular->particular_name}}'s Stock Remaining </caption>
									<thead>
										<tr>
											<th> S.No </th>
											<th> Date </th>
											<th> Particular's Name </th>
											<th> Purchased Quantity </th>
											<th> Purchase Rate </th>
											<th> Sales Quantity </th>
											<th> Sales Rate </th>
											<th> Stock Remaining </th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1; $totalStock=0; $totalPurchase = 0; $totalSales = 0; ?>
										@foreach($dates as $date)
										<tr>
											<td> {{$i}} </td>
											<td>{{$date->date}}</td>
											
											<?php $particular = App\Particular::where('id',$date->purchase)->orWhere('id',$date->sales)->first()->particular_name; ?>
											<td> {{$particular}} </td>
											<td> {{$date->purchase_quantity}} </td>
											<td> @if($date->purchase_rate>0) {{$date->purchase_rate}} @else 0 @endif</td>
											<td> {{$date->sales_quantity}} </td>
											<td> @if($date->sales_rate>0) {{$date->sales_rate}} @else 0 @endif </td>
											<td> {{$date->purchase_quantity-$date->sales_quantity}} </td>
											<?php $totalStock += ($date->purchase_quantity-$date->sales_quantity); ?>
										</tr>
										<?php $i++; ?>	
										@endforeach
										<tr>
											<th colspan="7" class="text-center"> Total Stocks </th>
											<td> {{ $totalStock }} </td>
										</tr>
									</tbody>
								</table>
							@endforeach
                        </div>						
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('dashboardFooter')
<script>
	$('.nepali-date').nepaliDatePicker();	
</script>
@stop