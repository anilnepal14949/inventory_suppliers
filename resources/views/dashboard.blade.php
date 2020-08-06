@extends('home')

@section('dynamicHeader')
   @yield('dashboardHeader')
@endsection


@section('dynamicContent')

   <div class="container-fluid" data-appear-animation="blur" data-appear-delay="1400">
      <div class="row">
         <div class="col-md-12 col-lg-12">

            @yield('dashboardContent')

         </div>
      </div>
   </div>
@endsection


@section('dynamicFooter')
   @yield('dashboardFooter')
@endsection