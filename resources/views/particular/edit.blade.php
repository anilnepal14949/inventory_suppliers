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
            <li><span class="glyphicon glyphicon-th-list"></span> Particular </li>
        </ol>
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-md-12 col-lg-12" data-appear-animation="fadeIn" data-appear-delay="1400">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="glyphicon glyphicon-th-list"></span>  Edit <u>{{ $part->particular_name }}</u></h3>
                        </div>
                        {!!Form::model($particular,['route'=>['particular.add-particular.update',$part->id],'method'=>'put','class'=>'scrollIfExcess showSavingOnSubmit','files'=>true])!!}
                        <div class="panel-body">
                            <!-- particular name -->
                            <div class="form-group col-md-4 col-lg-4 @if($errors->has('customer_name')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('particular_name')) title="{!!$errors->first('particular_name')!!}" @endif>
                                    {!!Form::label('particular_name','Particular\'s Name')!!}
                                    {!!Form::text('particular_name', $part->particular_name, ['class'=>'form-control','required'=>'required','placeholder'=>'Particular\'s Name...'])!!}
                                    @if($errors->has('particular_name'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="particularNameStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="particularNameStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>

                            <!-- description -->
                            <div class="form-group col-md-4 col-lg-4 @if($errors->has('description')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('description')) title="{!!$errors->first('description')!!}" @endif>
                                    {!!Form::label('description','Description')!!}
                                    {!!Form::textarea('description', $part->description, ['class'=>'form-control','placeholder'=>'Description if any..'])!!}
                                    @if($errors->has('description'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="descriptionStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="descriptionStatus" class="sr-only">(success)</span>
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
@stop