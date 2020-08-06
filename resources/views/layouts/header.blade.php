<script>
    $('.dropdown-toggle').dropdown();
</script>
<style>
	ul.nav li a{
		color:#ccc !important;
		transition:all 0.4s ease;
	}
	ul.nav li:hover a{
		color:#000 !important;
	}
	.nav-tabs>li.active>a{
		color:#000 !important;
	}
</style>
<?php
	use Illuminate\Support\Facades\Auth;
	$users_type = App\User::where('id',Auth::id())->first()->users_type_id;
?>

<header data-appear-animation="slideInDown" data-appear-delay="300">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
                <h4><a href="{{route('dashboard')}}" id="brand">  Inventory Management System   </a></h4>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
			
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
				<div class="dropdown">
					<button class="btn btn-default dropdown-toggle" type="button" id="logout" data-toggle="dropdown" aria-expanded="false">
						@if(Auth::id()) {{ ' '.ucfirst(Auth::user()->name) }} @else Login @endif
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" aria-labelledby="logout" style="position:absolute; left:255px; top:105%">
						<li class="text-left">@if(Auth::id())<a href="{{url('auth/logout')}}" title="Log Out"><span class="glyphicon glyphicon-log-out" style="color:#000; font-size:12px"> </span> Logout </a>@else<a href="{{url('login')}}" title="Login"><span class="glyphicon glyphicon-login" style="color:#000; font-size:12px"> </span> Login </a>@endif</li>
					</ul>
				</div>
			</div>
		</div>		
    </div>
</header>

<div class="container-fluid pro_tabs_container">
    <div class="row">
        <div class="col-md-12" data-appear-animation="fadeInUp" data-appear-delay="400">
            <ul class="nav nav-tabs">
                <li role="presentation" @if($activeMenu == 'home') class="active" @endif><a href="{{route('dashboard')}}" title="Dashboard"><span class="glyphicon glyphicon-home faa-pulse animated-hover"></span></a></li>
				<li role="presentation" @if($activeMenu == 'company') class="active" @endif><a href="{{route('company')}}" title="Company Information"><span class="glyphicon glyphicon-calendar faa-pulse animated-hover"></span> Company Info </a></li>
				<li role="presentation" @if($activeMenu == 'customer') class="active" @endif><a href="{{route('customer')}}" title="Customer Information"><span class="glyphicon glyphicon-user faa-pulse animated-hover"></span> Customer Info </a></li>
				<li role="presentation" @if($activeMenu == 'particular') class="active" @endif><a href="{{route('particular')}}" title="Particular Information"><span class="glyphicon glyphicon-th-list faa-pulse animated-hover"></span> Particulars Info </a></li>
				<li role="presentation" @if($activeMenu == 'purchase') class="active" @endif><a href="{{route('purchase')}}" title="Purchase Info"><span class="glyphicon glyphicon-import faa-pulse animated-hover"></span> Purchase Info </a></li>
				<li role="presentation" @if($activeMenu == 'sales') class="active" @endif><a href="{{route('sales')}}" title="Sales Info"><span class="glyphicon glyphicon-export faa-pulse animated-hover"></span> Sales Info </a></li>
				<li role="presentation" @if($activeMenu == 'stock') class="active" @endif><a href="{{route('stock')}}" title="Stock"><span class="glyphicon glyphicon-transfer faa-pulse animated-hover"></span> Stock Info </a></li>
				<li role="presentation" @if($activeMenu == 'ledger') class="active" @endif><a href="{{route('ledger')}}" title="Ledger Entries"><span class="glyphicon glyphicon-book faa-pulse animated-hover"></span> Ledger Entries </a></li>
				<li role="presentation" @if($activeMenu == 'backup') class="active" @endif><a href="{{route('backup')}}" title="Backup Database"><span class="fa fa-database faa-pulse animated-hover"></span> Backup Database </a></li>
            </ul>
        </div>
    </div>
</div>


