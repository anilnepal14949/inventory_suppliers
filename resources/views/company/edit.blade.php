@extends('dashboard')

@section('dashboardContent')
<style>
	#file_preview {
		max-height: 250px;
		max-width: 250px;
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
                            <h3 class="panel-title"><span class="glyphicon glyphicon-calendar"></span>  Edit <u> {{$custom->company_name}} </u></h3>
                        </div>
                        {!!Form::model($company,['route'=>['company.add-company.update',$custom->id],'method'=>'put','class'=>'scrollIfExcess showSavingOnSubmit','files'=>true])!!}
                        <div class="panel-body">
                            <!-- company name -->
                            <div class="form-group col-md-4 col-lg-4 @if($errors->has('company_name')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('company_name')) title="{!!$errors->first('company_name')!!}" @endif>
                                    {!!Form::label('company_name','Company\'s Name')!!}
                                    {!!Form::text('company_name', $custom->company_name, ['class'=>'form-control','required'=>'required','placeholder'=>'Company\'s Name...'])!!}
                                    @if($errors->has('company_name'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="companyNameStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="companyNameStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>

                            <!-- address -->
                            <div class="form-group col-md-4 col-lg-4 @if($errors->has('address')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('address')) title="{!!$errors->first('address')!!}" @endif>
                                    {!!Form::label('address','Address')!!}
                                    {!!Form::text('address', $custom->address, ['class'=>'form-control','placeholder'=>'Address..'])!!}
                                    @if($errors->has('address'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="addressStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="addressStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>
							
							<!-- contact_no -->
                            <div class="form-group col-md-4 col-lg-4 @if($errors->has('contact_no')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('contact_no')) title="{!!$errors->first('contact_no')!!}" @endif>
                                    {!!Form::label('contact_no','Contact Information')!!}
                                    {!!Form::text('contact_no', $custom->contact_no, ['class'=>'form-control','placeholder'=>'Contact Information..'])!!}
                                    @if($errors->has('contact_no'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="contactNoStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="contactNoStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>
								
							<div class="form-group col-md-4 col-lg-4 @if($errors->has('photo')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('photo')) title="{!!$errors->first('photo')!!}" @endif>
									{!!Form::label('photo','Company Photo')!!}
									{!!Form::file('photo', null, ['class'=>'form-control'])!!}
									@if($errors->has('photo'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="photoStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="photoStatus" class="sr-only">(success)</span>
                                    @endif
								</div>	
							</div>
							
							<div class="col-md-4 col-lg-4">
								<h5><strong> Preview: </strong></h5>
								<img src="{{asset('public/images/company/'.$custom->photo)}}" width="200" class="img-thumbnail" />
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
@stop