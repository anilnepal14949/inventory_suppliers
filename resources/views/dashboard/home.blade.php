@extends('dashboard')

@section('dashboardContent')
<style>
	center h3,center h4{
		color:#ccc;
	}
	center h3{
		animation:move 5s ease infinite;
	}
	@keyframes move{
		0%{
			margin-left:-5px;
		}
		20%{
			margin-left:-2px;
		}
		40%{
			margin-left:0px;
		}
		70%{
			margin-left:2px;
		}
		100%{
			margin-left:5px;
		}
	}
</style>
    <div class="main_div">
        <ol class="breadcrumb">
            <li><a href="" title="Home"><span class="glyphicon glyphicon-home"></span></a></li>
            <li><span class="glyphicon glyphicon-dashboard"></span> Dashboard </li>
        </ol>
        <div class="col-md-12 col-lg-12">
			<center>
				<img src="{{asset('public/images/company/'.$company->photo)}}" width="200">
				<h3> {{$company->company_name}} </h3>
				<h4> {{$company->address}} </h4>
				<h4> {{$company->contact_no}} </h4>
			</center>	
        </div>
    </div>
@stop

	
