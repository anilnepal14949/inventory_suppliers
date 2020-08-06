@extends('layouts/main')

@section('mainContent')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 authDiv" data-appear-animation="fadeInDown" data-appear-delay="500">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">सामान्य डाटा राख्नुहोस</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/set-data') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="arthikbarsa"> आर्थिक वर्ष </label>
                                <div class="col-md-6">
                                    <select name="arthikbarsa" id="arthikbarsa" class="form-control" required="required">
                                        <option value="०६०/०६१"> ०६०/०६१ </option>
                                        <option value="०६१/०६२"> ०६१/०६२ </option>
                                        <option value="०६२/०६३"> ०६२/०६३ </option>
                                        <option value="०६३/०६४"> ०६३/०६४ </option>
                                        <option value="०६४/०६५"> ०६४/०६५ </option>
                                        <option value="०६५/०६६"> ०६५/०६६ </option>
                                        <option value="०६६/०६७"> ०६६/०६७ </option>
                                        <option value="०६७/०६८"> ०६७/०६८ </option>
                                        <option value="०६८/०६९"> ०६८/०६९ </option>
                                        <option value="०६९/०७०"> ०६९/०७० </option>
                                        <option value="०७०/०७१"> ०७०/०७१ </option>
                                        <option value="०७१/०७२"> ०७१/०७२ </option>
                                        <option value="०७२/०७३"> ०७२/०७३ </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="name">कार्यालय</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="karyalaya" id="karyalaya" value="{{ old('karyalaya') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="name">(उ.प.)न.पा./गा.वि.स.</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="gabisa" id="gabisa" value="{{ old('gabisa') }}">
                                </div>
                            </div>

                            <div class="form-group pro_checkbox">
                                <div class="col-md-6 col-md-offset-4">
									<input type="checkbox" name="skip" id="skip" class="third_color" @if(old('skip')) @else checked="checked" @endif />
									<label for="skip">Skip?</label>
									
									<button type="submit" class="btn btn-primary pull-right">पठाउनुहोस</button>
                                </div>
                            </div>
							
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footerContent')
    <script type="text/javascript">
        $(document).ready(function(e){
            $('#name').focus();
        });
    </script>
@stop
