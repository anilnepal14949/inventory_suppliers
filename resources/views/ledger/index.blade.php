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
            <li><span class="glyphicon glyphicon-book"></span> Ledger </li>
        </ol>
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-md-12 col-lg-12" data-appear-animation="fadeIn" data-appear-delay="1400">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-left"><span class="glyphicon glyphicon-book"></span>  Ledger </h3>
                        </div>
						<div class="panel-body">
							<form action="{{route('generate')}}" method="post" target="_blank">	
								{!! csrf_field() !!}
								<div class="form-group col-md-4 col-lg-4">
									{!!Form::label('customer_id','Choose Customer')!!}
									<select id="customer_id" name="customer_id" class="form-control" required>
										<option value="0" selected disabled> Select Customer to view ledger </option>
										@foreach($customers as $c)
											<option value="{{$c->id}}"> {{$c->customer_name}} </option>
										@endforeach
									</select>
								</div>
								
								<!-- start date -->
								<div class="form-group col-md-4 col-lg-4 @if($errors->has('start_date')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
									<div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('start_date')) title="{!!$errors->first('start_date')!!}" @endif>
										{!!Form::label('start_date','Ledger From')!!}
										{!!Form::text('start_date', null, ['class'=>'form-control nepali-date','required'=>'required','placeholder'=>'Start Date...'])!!}
										@if($errors->has('start_date'))
											<span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
											<span id="startDateStatus" class="sr-only">(error)</span>
										@elseif(count($errors->all())>0)
											<span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
											<span id="startDateStatus" class="sr-only">(success)</span>
										@endif
									</div>
								</div>
								
								<!-- end date -->
								<div class="form-group col-md-4 col-lg-4 @if($errors->has('end_date')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
									<div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('end_date')) title="{!!$errors->first('end_date')!!}" @endif>
										{!!Form::label('end_date','Ledger To')!!}
										{!!Form::text('end_date', null, ['class'=>'form-control nepali-date','placeholder'=>'End Date...'])!!}
										@if($errors->has('end_date'))
											<span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
											<span id="endDateStatus" class="sr-only">(error)</span>
										@elseif(count($errors->all())>0)
											<span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
											<span id="endDateStatus" class="sr-only">(success)</span>
										@endif
									</div>
								</div>
								<div class="col-md-4 col-lg-4 form-group">
									<button class="btn btn-success" data-loading-text="Generating..." autocomplete="off">Generate Ledger</button>
								</div>				
							</form>	
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