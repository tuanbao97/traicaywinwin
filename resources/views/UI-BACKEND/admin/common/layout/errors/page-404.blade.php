@extends('UI-BACKEND.admin.common.layout.master')

@section('plugin-css-for-this-page')
@stop 

@section('custom-css')
<style>
    .section-error-404 .img-404 {
    	width: 100%;
	    padding-left: 7%;
        padding-right: 7%;
    }

    .section-error-404 .text-error-404 {
	    background: linear-gradient(to right, #10bcff 0%, #367d8d 100%);
        background-clip: text;
        color: transparent;
        text-align: center;
        padding-top: 35px;
        height: 65px;
    }
</style>
@stop 

@section('nav-item')
@stop

@section('content')
<div class="col-lg-12 grid-margin stretch-card" id="SECTION_ERROR_404">
	<div class="card">
		<div class="card-body section-error-404">
			<div class="col-lg-12">
				<img class="img-404" src="{{ asset('image/UI-BACKEND/404_not_found.png') }}"
					alt="image">
			</div>
			<div class="col-lg-12 error-page-divider">
				<h4 class="font-weight-light text-error-404">Không tìm thấy trang</h4>
			</div>
				
		</div>
	</div>
</div>
@stop

@section('plugin-js-for-this-page')
@stop

@section('custom-js-for-this-page')
<script>
	showToastFailure('top-right', 'Không tìm thấy trang!');
</script>
@stop
