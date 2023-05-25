@extends('layouts.master')
@section('css')
@section('title')
Kullanıcılar listesi
@stop
@endsection
@section('page-header')

@endsection
@section('content')


				</div>
				<!-- /row -->
			</div><!-- container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--- Internal Check-all-mail js -->
<script src="{{URL::asset('assets/js/check-all-mail.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
@endsection
