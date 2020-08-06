@extends('layouts/main')

@section('mainContent')
<style>
	@media print{
		form#changeInitialBal{
			display:none;
		}
	}
</style>
	<div class="container" style="font-family:Arial;">
		@if($customer_id!='' && $start_date!='' && $end_date == 0)
			<h4 class="pull-left"> Customer Name : <u> {{App\Customer::where('status',0)->whereId($customer_id)->first()->customer_name}}</u></h4>
			<h4 class="pull-right"> Initial Balance : <u> Rs. {{App\Customer::where('status',0)->whereId($customer_id)->first()->initial_balance}}</u></h4> 
			<table class="table table-responsive table-bordered">
				<thead>
					<tr>
						<th> Date </th>
						<th> Particulars </th>
						<th> Debit Amount </th>
						<th> Credit Amount </th>
						<th> Total </th>
					</tr>
				</thead>
				<tbody>
					<?php $dates = App\Dates::where('purchased_from',$customer_id)->orWhere('sales_to',$customer_id)->where('date','>=',$start_date)->orderBy('date')->get(); 
					$data = DB::raw('SELECT * FROM `uni_dates_data` WHERE (purchased_from=3 or sales_to=3) and (date>="2072-11-01" and date<="2072-11-30") ORDER BY `date` ASC');	
					dd($data);
					$totalDr = 0;
					?>
					@foreach($dates as $d)
						<tr>
							<td> {{$d->date}} </td>
							<td> @if($d->purchase!=0){{App\Particular::where('id',$d->purchase)->first()->particular_name}} @else {{App\Particular::where('id',$d->sales)->first()->particular_name}} @endif</td>
							<td> {{$d->sales_quantity*$d->sales_rate}} </td>
							<td> {{$d->purchase_quantity*$d->purchase_rate}} </td>
							<td>
							<?php $totalDr += ($d->sales_quantity*$d->sales_rate)-($d->purchase_quantity*$d->purchase_rate) ?> 
							{{($d->sales_quantity*$d->sales_rate)-($d->purchase_quantity*$d->purchase_rate)}} </td>
						</tr>
					@endforeach
					<tr>
						<th colspan="4" class="text-center"> Total </th>
						<td> {{$totalDr}} </td>
					</tr>
				</tbody>
			</table>
		@elseif($customer_id!='' && $start_date!='' && $end_date!='')
			<h4 class="pull-left"> Customer Name : <u> {{App\Customer::where('status',0)->whereId($customer_id)->first()->customer_name}}</u></h4>
			<h4 class="pull-right"> Initial Balance : <u> Rs.<?php $initialBal = App\Customer::where('status',0)->whereId($customer_id)->first()->initial_balance ?> {{$initialBal}}</u></h4> 
			<table class="table table-responsive table-bordered">
				<thead>
					<tr>
						<th> Date </th>
						<th> Particulars </th>
						<th> Debit Amount </th>
						<th> Credit Amount </th>
						<th> Total </th>
					</tr>
				</thead>
				<tbody>
					<?php $dates = DB::select(DB::raw("select * from uni_dates_data where (purchased_from = '$customer_id' or sales_to ='$customer_id') and date between '$start_date' and '$end_date' order by date")); 
					$totalDr = 0;
					$totalCr = 0;
					$total = 0;
					?>
					@foreach($dates as $d)
						<tr>
							<td> {{$d->date}} </td>
							<td> 
							@if($d->purchase!=0)<?php $particular = App\Particular::where('id',$d->purchase)->first()->particular_name; ?> @else <?php $particular = App\Particular::where('id',$d->sales)->first()->particular_name; ?> @endif	
							@if($particular == 'Egg') {{$particular}} @if($d->sales_quantity == 0)<?php $eggTotal = $d->purchase_quantity*7*$d->purchase_rate; echo " (".$d->purchase_quantity." * 7 * ".$d->purchase_rate." = ".$eggTotal.")"; ?> @else <?php $eggTotal = $d->sales_quantity*$d->sales_rate; echo " (".$d->sales_quantity." * 7 * ".$d->sales_rate." = ".$eggTotal.")"; ?> @endif
							@else 
								{{$particular}}@if($d->sales_quantity == 0)<?php $eggTotal = $d->purchase_quantity*$d->purchase_rate; echo " (".$d->purchase_quantity." * ".$d->purchase_rate." = ".$eggTotal.")"; ?> @else <?php $eggTotal = $d->sales_quantity*$d->sales_rate; echo " (".$d->sales_quantity." * ".$d->sales_rate." = ".$eggTotal.")"; ?> @endif
							@endif
							</td>
							<td> @if($particular=='Egg'){{$d->sales_quantity*7*$d->sales_rate}} @else {{$d->sales_quantity*$d->sales_rate}} @endif </td>
							<td> @if($particular=='Egg'){{$d->purchase_quantity*7*$d->purchase_rate}} @else {{$d->purchase_quantity*$d->purchase_rate}} @endif </td>
							<td>
							<?php 
								if($particular == 'Egg'){
									$totalDr += $d->sales_quantity*7*$d->sales_rate;
									$totalCr += $d->purchase_quantity*7*$d->purchase_rate;	
								}else{
									$totalDr += $d->sales_quantity*$d->sales_rate;
									$totalCr += $d->purchase_quantity*$d->purchase_rate;
								}
							?> 
							@if($particular == 'Egg'){{($d->sales_quantity*7*$d->sales_rate)-($d->purchase_quantity*7*$d->purchase_rate)}} @else {{($d->sales_quantity*$d->sales_rate)-($d->purchase_quantity*$d->purchase_rate)}} @endif  </td> </td>
						</tr>
					@endforeach
					<?php $total = $totalDr - $totalCr; ?>
					<tr>
						<th colspan="2" class="text-center"> Total </th>
						<td> {{$totalDr}} </td>
						<td> {{$totalCr}} </td>
						<td> {{$total}} </td>
					</tr>
					<tr>
						<th colspan="4" class="text-center"> Remaining </th>
						<td> {{$total + $initialBal}} </td>
					</tr>
				</tbody>
			</table>
			<form action="{{route('changeInitialBal')}}" method="post" id="changeInitialBal"> 
				{!! csrf_field() !!}
				<input type="hidden" value="{{$customer_id}}" name="customer_id" />
				<input type="hidden" value="{{$total}}" name="total" />
				<button type="submit" class="btn btn-primary"> Change Initial Balance </button>
			</form>	
		@endif
	</div>
@stop