@extends('dashboard')

@section('dashboardContent')
<style>
	#file_preview {
		max-height: 250px;
		max-width: 250px;
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
                            <h3 class="panel-title"><span class="glyphicon glyphicon-export"></span>  Add Sales Information  </h3>
                        </div>
                        {!!Form::open(['route'=>'sales.add-sales.store','method'=>'post','class'=>'scrollIfExcess showSavingOnSubmit','files'=> true])!!}
                        <div class="panel-body">
							<!-- sales date -->
                            <div class="form-group col-md-4 col-lg-4 @if($errors->has('sales_date')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('sales_date')) title="{!!$errors->first('sales_date')!!}" @endif>
                                    {!!Form::label('sales_date','Date')!!}
                                    {!!Form::text('sales_date', null, ['class'=>'form-control nepali-date','required'=>'required','placeholder'=>'Sales Date...'])!!}
                                    @if($errors->has('sales_date'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="salesDateStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="salesDateStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>
							
							<!-- sales to -->
                            <div class="form-group col-md-4 col-lg-4 @if($errors->has('sales_to')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('sales_to')) title="{!!$errors->first('sales_to')!!}" @endif>
                                    {!!Form::label('sales_to','Sales To')!!}
                                    <select name="sales_to" id="sales_to" required class="form-control">
										<option value="0" selected disabled> Select Customer </option>
										@foreach($customers as $customer)	
											<option value="{{$customer->id}}"> {{$customer->customer_name}}</option>
										@endforeach
									</select>
                                    @if($errors->has('sales_to'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="salesToStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="salesToStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>
							
                            <!-- particular name -->
                            <div class="form-group col-md-4 col-lg-4 @if($errors->has('particular_id')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('particular_id')) title="{!!$errors->first('particular_id')!!}" @endif>
                                    {!!Form::label('particular_id','Choose Particular')!!}
                                    <select name="particular_id" id="particular_id" class="form-control" required>
										<option value="0" selected> Select Particular </option>
										<?php $particulars = App\Particular::where('status',0)->get(); ?>
										@foreach($particulars as $particular)
											<option value="{{$particular->id}}"> {{ $particular->particular_name }} </option>
										@endforeach
									</select>
                                    @if($errors->has('particular_id'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="particularIdStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="particularIdStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>
							
							<!-- quantity -->
                            <div class="form-group col-md-4 col-lg-4 @if($errors->has('quantity')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('quantity')) title="{!!$errors->first('quantity')!!}" @endif>
                                    {!!Form::label('quantity','Quantity')!!}
                                    {!!Form::text('quantity', null, ['class'=>'form-control','required'=>'required','placeholder'=>'Quantity...'])!!}
                                    @if($errors->has('quantity'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="quantityStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="quantityStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>

							<!-- rate -->
                            <div class="form-group col-md-4 col-lg-4 @if($errors->has('rate')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('rate')) title="{!!$errors->first('rate')!!}" @endif>
                                    {!!Form::label('rate','Rate')!!}
                                    {!!Form::text('rate', null, ['class'=>'form-control','required'=>'required','placeholder'=>'Rate...'])!!}
                                    @if($errors->has('rate'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="rateStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="rateStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>		

                            <!-- status -->
                            <div class="form-group col-md-12 col-lg-12 pro_checkbox">
                                <input type="checkbox" name="status" id="status" class="fourth_color" @if(old('status')) @else checked="checked" @endif />
                                <label for="status">Is Active?</label>
                            </div>

                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-success" data-loading-text="Saving..." autocomplete="off">Save</button>
                            <button class="btn btn-default" type="reset">Reset</button>
                        </div>
                        {!!Form::close()!!}
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