<?php
	// Random 1 lần uuid để làm id duy nhất
	$uuid1 = 'section' . Str::random(6);
	$uuid2 = 'section' . Str::random(6);
	$uuid3 = 'section' . Str::random(6);
	$uuid4 = 'section' . Str::random(6);
	$uuid5 = 'section' . Str::random(6);
?>

@extends('UI-BACKEND.admin.common.layout.master')

@section('plugin-css-for-this-page') @stop @section('custom-css')
<style>
	@media (min-width: 1500px) {
		#CHI_TIET_TIN_TUC .section.col-lg-4-custom {
			flex: 0 0 auto;
			width: 350px;
		}
		#CHI_TIET_TIN_TUC .section.col-lg-8-custom {
			flex: 0 0 auto;
			width: calc(100% - 350px);
		}
	}
	@media (min-width: 1250px) and (max-width: 1500px) {
		#CHI_TIET_TIN_TUC .section.col-lg-4-custom {
			flex: 0 0 auto;
			width: 300px;
		}
		#CHI_TIET_TIN_TUC .section.col-lg-8-custom {
			flex: 0 0 auto;
			width: calc(100% - 300px);
		}
	}
	@media (max-width: 1600px) {
		.{{ 'section_' . $uuid2 }}.box-upload-one-img {
			margin: 0 auto;
		}
	}
	.block-chi-tiet-tin-tuc .card-description {
    	font-size: 1.035rem;
    }
    .block-chi-tiet-tin-tuc {
    	margin-top: 15px;
    }
    .list-group-flush {
        margin-left: 0px;
        margin-right: 0px;
    }
    .list-group .list-group-item {
        padding-left: 0px;
        padding-right: 0px;
    }
    .list-group-flush > .list-group-item:last-child {
        border-bottom-width: 1px;
    }
    .div-chi-tiet-tin-tuc .div-vui-long-chon img{
        margin-top: 50px !important;
        border-radius: 20px;
        width: 150px;
        margin: auto;
        display: block;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
    }
    .div-chi-tiet-tin-tuc .div-vui-long-chon label {
        text-align: center;
        display: block;
        margin-top: 25px;
        font-size: 18px;
        font-weight: 600;
    }
    .div-chi-tiet-tin-tuc .div-vui-long-chon-dmtt code {
        display: block;
        text-align: center;
    }
	.div-chi-tiet-tin-tuc .div-vui-long-chon-dmtt img{
        margin-top: 50px !important;
        border-radius: 20px;
        width: 250px;
        margin: auto;
        display: block;
    }
    .div-chi-tiet-tin-tuc .div-vui-long-chon-dmtt label {
        text-align: center;
        display: block;
        margin-top: 25px;
        font-size: 18px;
        font-weight: 600;
    }
    .div-chi-tiet-tin-tuc .div-vui-long-chon code {
        display: block;
        text-align: center;
    }
	@media (max-width: 992px) {
	}
</style>
@stop @section('nav-item')
<li class="nav-item">
	<div class="d-flex align-items-baseline">
		<p class="mb-0">Admin</p>
		<i class="typcn typcn-chevron-right"></i>
		<p class="mb-0">Quản lý tin tức</p>
	</div>
</li>
@stop @section('content')
<div class="row section-main">
	<div class="col-lg-12">
		@include('UI-BACKEND.admin.common.component.popup.danh-muc-tin-tuc.popup-list-card-danh-muc-tin-tuc',
			[
				'sectionId' => 'section_' . $uuid1
				, 'aspectRatio' => '1x1'
			]
		)
	</div>
	<div class="col-lg-12 grid-margin stretch-card div-chi-tiet-tin-tuc" id="CHI_TIET_TIN_TUC">
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-between">
					<div class="col-md-12 col-sm-12">
						<h4 class="card-title">
							CHI TIẾT <span class="one-line">TIN TỨC</span>
						</h4>
					</div>
				</div>
				<div>
					<div class="row">
						<div class="form-group d-none">
							<label for="ID">Id tin tức</label> <input type="text"
								class="form-control" id="EDIT_ID" placeholder=""> <span
								class="error-message" id="MSG_EDIT_ID"></span>
						</div>
						<div class="section col-lg-4-custom col-md-12">
							<div class="row">
								<div class="col-12 form-group form-box-upload-anh">
									@include('UI-BACKEND.admin.common.component.upload-file.box-upload-1-file'
										, [
											'sectionId' => 'section_' . $uuid2
											, 'aspectRatio' => '1x1'
											, 'ratio' => '1/1'
											, 'maxWidth' => '350px'
										]
									)
									<span class="error-message text-center"
										id="MSG_ANH_DAI_DIEN"></span>
								</div>
								<div class="col-12">
									<div class="form-group text-center">
										<button id="BTN_DANH_SACH_HINH_ANH" type="button" class="btn btn-outline-info btn-fw btn-icon-text me-2">
											<i class="icon-picture btn-icon-prepend"></i>Hình ảnh (<span id="SO_LUONG_DANH_SACH_HINH_ANH">0</span>)
										</button>
										<button id="BTN_DANH_SACH_HINH_VIDEO" type="button" class="btn btn-outline-info btn-fw btn-icon-text">
											<i class="icon-film btn-icon-prepend"></i>Video (<span id="SO_LUONG_DANH_SACH_VIDEO">0</span>)
										</button>
									</div>
								</div>
							</div>
						</div>
						<div class="section col-lg-8-custom col-md-12">
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<label for="NAME">Danh mục tin tức<code>*</code></label>
									<div class="dropdown">
										<input id="EDIT_DANH_MUC_TIN_TUC_ID" type="hidden">
										<button class="btn btn-combobox dropdown-toggle" type="button" id="EDIT_DANH_MUC_TIN_TUC" aria-haspopup="true" aria-expanded="true">
											<span id="EDIT_DANH_MUC_TIN_TUC_LBL" title=""></span>
										</button>
									</div>
									<span class="error-message" id="MSG_EDIT_DANH_MUC_TIN_TUC"></span>
								</div>
							</div>
							<div class="col-12 div-vui-long-chon-dmtt" id="SECTION_VUI_LONG_CHON_DMTT" style="display: none;">
								<img src="{{ asset('image/UI-BACKEND/vector-news.jpg') }}">
								<label>Chọn danh mục tin tức</label>
								<code>để tiếp tục</code>
							</div>
							<div id="DIV_CHI_TIET_TIN_TUC"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('UI-BACKEND.admin.common.component.popup.upload-file.popup-upload-multiple-hinh-anh',
	[
		'sectionId' => 'section_' . $uuid4
		, 'aspectRatio' => '1x1'
		, 'ratio' => '1/1'
	]
)
@include('UI-BACKEND.admin.common.component.popup.upload-file.popup-upload-multiple-video',
	[
		'sectionId' => 'section_' . $uuid5
		, 'aspectRatio' => '1x1'
		, 'ratio' => '1/1'
	]
)
@stop
@section('plugin-js-for-this-page')
@stop
@section('custom-js-for-this-page')
<script>
$(document).ready(function () {
	var currDanhMucTinTucId = null; // Id danh mục tin tức hiện tại
	var isFirstDanhMucTinTucSelected = false;
	@if (isset($newsId))
		isFirstDanhMucTinTucSelected = true;
	@endif
	{{"section_" . $uuid2 }}_setDefaultTextBoxUplOneImg('Upload ảnh bìa');
	getDanhSachUploadHinhAnhDaiDien = function() {
		return {{ "section_" . $uuid2 }}_getDanhSachUploadHinhAnhDaiDien();
	}
	getDanhSachUploadMultipleHinhAnh = function() {
		return {{ "section_" . $uuid4 }}_getDanhSachUploadMultipleHinhAnh();
	}
	$('#BTN_DANH_SACH_HINH_ANH').on('click', function() {
		{{"section_" . $uuid4 }}_handleOpenPopupUploadMultipleHinhAnh();
		$('#{{"section_" . $uuid4 }}_MODAL_UPLOAD_MULTIPLE_HINH_ANH').modal('show');
	});
	{{"section_" . $uuid4 }}_callBackUploadMultipleHinhAnh = function(data) {
		$("#SO_LUONG_DANH_SACH_HINH_ANH").text(data.length);
	}
	getDanhSachUploadMultipleVideo = function() {
		return {{ "section_" . $uuid5 }}_getDanhSachUploadMultipleVideo();
	}
	$('#BTN_DANH_SACH_HINH_VIDEO').on('click', function() {
		{{"section_" . $uuid5 }}_handleOpenPopupUploadMultipleVideo();
		$('#{{"section_" . $uuid5 }}_MODAL_UPLOAD_MULTIPLE_VIDEO').modal('show');
	});
	{{"section_" . $uuid5 }}_callBackUploadMultipleVideo = function(data) {
		$("#SO_LUONG_DANH_SACH_VIDEO").text(data.length);
	}
	loadViewLoaiTinTuc = function(duLieu, newsId, pathView) {
		let uuid = generateRandomString(6);
		var inputData = {
			pathView : pathView
			, newsId: newsId
			, duLieu: duLieu
			, uuid: uuid
		};
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type : "POST",
			url : '{{ url("/news/view") }}',
			contentType : "application/json",
			traditional: true,
			showLoading: true,
			data : JSON.stringify(inputData),
			success : function(data, textStatus, request) {
				$('#SECTION_VUI_LONG_CHON_DMTT').hide();
				$('#DIV_CHI_TIET_TIN_TUC').html(data);
			},
			error : function(request, textStatus, errorThrown) {
				showToastFailure('top-right', 'Internal server');
				$('#SECTION_VUI_LONG_CHON_DMTT').show();
				$('#DIV_CHI_TIET_TIN_TUC').html(null);
			},
			complete : function() {}
		});
	}
	@if (isset($newsId)) {
		$('#SECTION_VUI_LONG_CHON_DMTT').hide();
		var newsId = '{{ isset($newsId) ? $newsId : null }}';
		var inputData = {};
		$.ajax({
			type : "GET",
			url: '{{ url("/api/news/detail") }}' + "/" + newsId, 
			contentType : "application/json",
			traditional: true,
			showLoading: true,
			data : inputData,
			success : function(data, textStatus, request) {
				data = data.DATAS.NEWS;
				$('#EDIT_ID').val(data.ID);
				let objAvatarUpload = data['DANH_SACH_HINH_ANH_DAI_DIEN'];
				if (!isEmpty(objAvatarUpload)) {
					let $objAvatarThumnail = $(objAvatarUpload).filter(function(idx) {
						return objAvatarUpload[idx].IS_THUMNAIL === true;
					});
					if ($objAvatarThumnail.length > 0) {
						{{ "section_" . $uuid2 }}_setThumbnailBoxOneImg(
							$("#{{'section_' . $uuid2 }}_divDropZone")[0]
							, !isEmpty($objAvatarThumnail[0].NAME) ? $objAvatarThumnail[0].NAME : ''
							, !isEmpty($objAvatarThumnail[0].DIRECTORY) ? $objAvatarThumnail[0].DIRECTORY : ''
						);
						{{ "section_" . $uuid2 }}_chiTietHinhAnh($objAvatarThumnail[0]);
						{{ "section_" . $uuid2 }}_appendInputUploadHinhAnhDaiDien($objAvatarThumnail[0]);
					}
				}
				let danhSachHinhAnh = data['DANH_SACH_HINH_ANH'];
				if (!isEmpty(danhSachHinhAnh)) {
					{{ "section_" . $uuid4 }}_removeAllAppendInputUploadMultipleHinhAnh();
					{{ "section_" . $uuid4 }}_appendInputUploadMultipleHinhAnh(danhSachHinhAnh);
					$("#SO_LUONG_DANH_SACH_HINH_ANH").text(danhSachHinhAnh.length);
				}
				let danhSachVideo = data['DANH_SACH_VIDEO'];
				if (!isEmpty(danhSachVideo)) {
					{{ "section_" . $uuid5 }}_removeAllAppendInputUploadMultipleVideo();
					{{ "section_" . $uuid5 }}_appendInputUploadMultipleVideo(danhSachVideo);
					$("#SO_LUONG_DANH_SACH_VIDEO").text(danhSachVideo.length);
				}
				let objDanhMucTinTuc = data['DANH_MUC_TIN_TUC'];
				if (!isEmpty(objDanhMucTinTuc)) {
					$('#EDIT_DANH_MUC_TIN_TUC_LBL').text(!isEmpty(objDanhMucTinTuc.TEN_DANH_MUC_TIN_TUC) ? objDanhMucTinTuc.TEN_DANH_MUC_TIN_TUC : null);
					$('#EDIT_DANH_MUC_TIN_TUC_ID').val(objDanhMucTinTuc?.ID);
					currDanhMucTinTucId = objDanhMucTinTuc.ID;
				}
				let pathView = data['PATH_VIEW'];
				pathView = 'UI-BACKEND/admin/tin-tuc/common/tin-tuc';
				loadViewLoaiTinTuc(data, newsId, pathView);
			},
			error : function(request, textStatus, errorThrown) {
				request.responseJSON = request.responseText ? JSON.parse(request.responseText) : null;
				showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
				setTimeout(() => {
					uriDanhSachTinTuc = '{{ url("/admin/tin-tuc") }}';
					window.location.href = uriDanhSachTinTuc;
				}, 1500);
			},
			complete : function() {}
		});
	}
	@else
		$('#SECTION_VUI_LONG_CHON_DMTT').show();
	@endif
	$('#EDIT_DANH_MUC_TIN_TUC').on('click', function() {
		{{"section_" . $uuid1 }}_handleOpenPopupTinTuc();
		$('#{{"section_" . $uuid1 }}_MODAL-LIST-DANH-MUC-TIN-TUC').modal('show');
	});
	{{"section_" . $uuid1 }}_callBack_danhMucTinTuc = function(dataLabel, dataId, pathView) {
		// Luôn cập nhật label, id
		$('#EDIT_DANH_MUC_TIN_TUC_LBL').text(dataLabel);
		$('#EDIT_DANH_MUC_TIN_TUC_LBL').attr('title', dataLabel);
		$('#EDIT_DANH_MUC_TIN_TUC_ID').val(dataId);
		currDanhMucTinTucId = dataId;
		// Chỉ gọi API reset bên dưới đúng 1 lần đầu khi thêm mới
		if (!isFirstDanhMucTinTucSelected) {
			@if (!isset($newsId))
				let newsId = null;
				pathView = 'UI-BACKEND/admin/tin-tuc/common/tin-tuc';
				loadViewLoaiTinTuc(null, newsId, pathView);
			@endif
			isFirstDanhMucTinTucSelected = true;
		}
	}
	resetAllMsgTinTuc = function() {
		$('#CHI_TIET_TIN_TUC').find($('span[class*="error-message"]')).not('[type="radio"], [type="checkbox"]').each(function(i, obj) {
			$(this).text('');
		});
	}
	resetAllHinhAnhVaVideo = function() {
		{{ "section_" . $uuid4 }}_removeAllAppendInputUploadMultipleHinhAnh();
		$("#SO_LUONG_DANH_SACH_HINH_ANH").text('0');
		{{ "section_" . $uuid5 }}_removeAllAppendInputUploadMultipleVideo();
		$("#SO_LUONG_DANH_SACH_VIDEO").text('0');
	}
	deleteContentBoxOneImgUpload = function() {
		{{"section_" . $uuid2 }}_deleteContentBoxOneImgUpload();
	}
	resetDanhMucTinTuc = function() {
		currDanhMucTinTucId = null;
		$('#EDIT_DANH_MUC_TIN_TUC_ID').val(null);
		$('#EDIT_DANH_MUC_TIN_TUC_LBL').text(null);
		$('#DIV_CHI_TIET_TIN_TUC').html(null);
		$('#SECTION_VUI_LONG_CHON_DMTT').show();
	}
});
</script>
@stop 