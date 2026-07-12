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
		#CHI_TIET_VIDEO .section.col-lg-4-custom {
			flex: 0 0 auto;
			width: 350px;
		}
		#CHI_TIET_VIDEO .section.col-lg-8-custom {
			flex: 0 0 auto;
			width: calc(100% - 350px);
		}
	}
	@media (min-width: 1250px) and (max-width: 1500px) {
		#CHI_TIET_VIDEO .section.col-lg-4-custom {
			flex: 0 0 auto;
			width: 300px;
		}
		#CHI_TIET_VIDEO .section.col-lg-8-custom {
			flex: 0 0 auto;
			width: calc(100% - 300px);
		}
	}
	@media (max-width: 1600px) {
		.{{ 'section_' . $uuid2 }}.box-upload-one-img {
			margin: 0 auto;
		}
	}
	.block-chi-tiet-video .card-description {
    	font-size: 1.035rem;
    }
    .block-chi-tiet-video {
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
    .div-chi-tiet-video .div-vui-long-chon img{
        margin-top: 50px !important;
        border-radius: 20px;
        width: 150px;
        margin: auto;
        display: block;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
    }
    .div-chi-tiet-video .div-vui-long-chon label {
        text-align: center;
        display: block;
        margin-top: 25px;
        font-size: 18px;
        font-weight: 600;
    }
    .div-chi-tiet-video .div-vui-long-chon code {
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
		<p class="mb-0">Quản lý video</p>
	</div>
</li>
@stop @section('content')
<div class="row section-main">
	<div class="col-lg-12">
	</div>
	<div class="col-lg-12 grid-margin stretch-card div-chi-tiet-video" id="CHI_TIET_VIDEO">
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-between">
					<div class="col-md-12 col-sm-12">
						<h4 class="card-title">
							CHI TIẾT <span class="one-line">VIDEO</span>
						</h4>
					</div>
				</div>
				<div>
					<div class="row">
						<div class="form-group d-none">
							<label for="ID">Id video</label> <input type="text"
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
							</div>
						</div>
						<div class="section col-lg-8-custom col-md-12">
							<div id="DIV_CHI_TIET_VIDEO"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@section('plugin-js-for-this-page')
@stop
@section('custom-js-for-this-page')
<script>
$(document).ready(function () {
	@if (isset($videoId))
		var videoId = '{{ isset($videoId) ? $videoId : null }}';
		var inputData = {};
		$.ajax({
			type : "GET",
			url: '{{ url("/api/video/detail") }}' + "/" + videoId, 
			contentType : "application/json",
			traditional: true,
			showLoading: true,
			data : inputData,
			success : function(data, textStatus, request) {
				data = data.DATAS.VIDEO;
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
				let pathView = 'UI-BACKEND/admin/video/common/video';
				loadViewLoaiVideo(data, videoId, pathView);
			},
			error : function(request, textStatus, errorThrown) {
				request.responseJSON = request.responseText ? JSON.parse(request.responseText) : null;
				showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
				setTimeout(() => {
					uriDanhSachVideo = '{{ url("/admin/video") }}';
					window.location.href = uriDanhSachVideo;
				}, 1500);
			},
			complete : function() {}
		});
	@else
		// Load form video mặc định khi thêm mới
		let videoId = null;
		let pathView = 'UI-BACKEND/admin/video/common/video';
	@endif

	{{"section_" . $uuid2 }}_setDefaultTextBoxUplOneImg('Upload ảnh bìa');
	getDanhSachUploadHinhAnhDaiDien = function() {
		return {{ "section_" . $uuid2 }}_getDanhSachUploadHinhAnhDaiDien();
	}
	loadViewLoaiVideo = function(duLieu, videoId, pathView) {
		let uuid = generateRandomString(6);
		var inputData = {
			pathView : pathView
			, videoId: videoId
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
			url : '{{ url("/video/view") }}',
			contentType : "application/json",
			traditional: true,
			showLoading: true,
			data : JSON.stringify(inputData),
			success : function(data, textStatus, request) {
				$('#SECTION_VUI_LONG_CHON_VIDEO').hide();
				$('#DIV_CHI_TIET_VIDEO').html(data);
			},
			error : function(request, textStatus, errorThrown) {
				showToastFailure('top-right', 'Internal server');
				$('#SECTION_VUI_LONG_CHON_VIDEO').show();
				$('#DIV_CHI_TIET_VIDEO').html(null);
			},
			complete : function() {}
		});
	}
	
	resetAllMsgVideo = function() {
		$('#CHI_TIET_VIDEO').find($('span[class*="error-message"]')).not('[type="radio"], [type="checkbox"]').each(function(i, obj) {
			$(this).text('');
		});
	}
	resetAllHinhAnhVaVideo = function() {
		// Không cần reset vì không sử dụng danh sách hình ảnh và video
	}
	deleteContentBoxOneImgUpload = function() {
		{{"section_" . $uuid2 }}_deleteContentBoxOneImgUpload();
	}
	
	// Gọi loadViewLoaiVideo sau khi đã định nghĩa hàm
	@if (!isset($videoId))
		loadViewLoaiVideo(null, null, 'UI-BACKEND/admin/video/common/video');
	@endif
});
</script>
@stop
