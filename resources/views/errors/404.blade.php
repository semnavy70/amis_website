@extends('master')
@section('content')
	<div class="container text-center">
		<h2 class="text-danger">{{ $exception->getMessage() }}</h2>
		<h2 class="text-danger">404 Not Found</h2>
		<a href="http://cms.mptc.gov.kh/"><h1 class="text-danger">Return to Home</h1></a>
	</div>


@endsection