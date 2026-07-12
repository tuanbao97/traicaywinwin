<?php
	$uuid1 = 'section' . Str::random(6);
?>

@extends('UI-BACKEND.admin.common.layout.master')

@section('plugin-css-for-this-page')
@stop 

@section('custom-css')
<style>
	@media (min-width: 1500px) {
		#CHI_TIET_THONG_TIN_CA_NHAN .section.col-lg-4-custom {
			flex: 0 0 auto;
			width: 350px;
		}
		#CHI_TIET_THONG_TIN_CA_NHAN .section.col-lg-8-custom {
			flex: 0 0 auto;
			width: calc(100% - 350px);
		}
	}
	@media (min-width: 1250px) and (max-width: 1500px) {
		#CHI_TIET_THONG_TIN_CA_NHAN .section.col-lg-4-custom {
			flex: 0 0 auto;
			width: 300px;
		}
		#CHI_TIET_THONG_TIN_CA_NHAN .section.col-lg-8-custom {
			flex: 0 0 auto;
			width: calc(100% - 300px);
		}
	}
	@media (max-width: 1600px) {
		.{{ 'section_' . $uuid1 }}.box-upload-one-img {
			margin: 0 auto;
		}
	}
 
	.section-main {
        display: none;
    }
</style>
@stop 

@section('nav-item')
<li class="nav-item">
	<div class="d-flex align-items-baseline">
		<p class="mb-0">Admin</p>
		<i class="typcn typcn-chevron-right"></i>
		<p class="mb-0">Thông tin cá nhân</p>
	</div>
</li>
@stop

@section('content')
<div class="row section-main" id="SECTION_MAIN">

	<div class="col-lg-12 grid-margin stretch-card" id="CHI_TIET_THONG_TIN_CA_NHAN">
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-between">
					<div class="col-md-12 col-sm-12">
						<h4 class="card-title">
							CHI TIẾT <span class="one-line">THÔNG TIN CÁ NHÂN</span>
						</h4>
					</div>
				</div>

				<div>
					<div class="row">
						<div class="form-group d-none">
							<label for="ID">Id danh mục sản phẩm</label> 
							<input type="text"
								class="form-control" id="EDIT_ID" placeholder="">
							<span class="error-message" id="MSG_EDIT_ID"></span>
						</div>
						
						<div class="section col-lg-4-custom col-md-12">
							<div class="form-group">
								<!-- START Include box upload 1 file vào -->
								@include('UI-BACKEND.admin.common.component.upload-file.box-upload-1-file'
									, [
										'sectionId' => 'section_' . $uuid1
										, 'aspectRatio' => '1x1'
										, 'ratio' => '1/1'
										, 'maxWidth' => '250px'
									]
								)
								<!-- END Include box upload 1 file vào -->
								<span class="error-message" id="MSG_EDIT_ANH_DAI_DIEN"></span>
							</div>
						</div>
						<div class="row section col-lg-8-custom col-md-12" style="margin-right: unset; padding-left: unset; padding-right: unset; margin-left: unset;">
                            <div class="form-group col-md-6 col-sm-12">
    							<label for="EDIT_EMAIL">Email</label> 
    							<input type="text" readonly
    								class="form-control" id="EDIT_EMAIL" placeholder="">
    							<span class="error-message" id="EDIT_EMAIL"></span>
    						</div>

							<div class="form-group col-md-6 col-sm-12">
    							<label for="EDIT_VAI_TRO">Vai trò</label> 
    							<input type="text" readonly
    								class="form-control" id="EDIT_VAI_TRO" placeholder="">
    							<span class="error-message" id="MSG_EDIT_VAI_TRO"></span>
    						</div>

							<div class="form-group col-md-6 col-sm-12">
    							<label for="EDIT_FULL_NAME">Họ và tên<code>*</code></label> 
    							<input type="text"
    								class="form-control" id="EDIT_FULL_NAME" placeholder="">
    							<span class="error-message" id="MSG_EDIT_FULL_NAME"></span>
    						</div>
    						
							<div class="form-group col-md-6 col-sm-12">
    							<label for="EDIT_SO_DIEN_THOAI">Số điện thoại<code>*</code></label> 
    							<input type="text"
    								class="form-control" id="EDIT_SO_DIEN_THOAI" placeholder="">
    							<span class="error-message" id="MSG_EDIT_SO_DIEN_THOAI"></span>
    						</div>

                            <div class="form-group col-md-12 col-sm-12">
    							<label for="EDIT_DIA_CHI">Địa chỉ</label> 
    							<input type="text"
    								class="form-control" id="EDIT_DIA_CHI" placeholder="">
    							<span class="error-message" id="MSG_EDIT_DIA_CHI"></span>
    						</div>

                            <div class="form-group col-md-12 col-sm-12">
    							<label for="EDIT_DUONG_DAN_FACEBOOK">Đường dẫn Facebook</label> 
    							<input type="text"
    								class="form-control" id="EDIT_DUONG_DAN_FACEBOOK" placeholder="">
    							<span class="error-message" id="MSG_EDIT_DUONG_DAN_FACEBOOK"></span>
    						</div>

                            <div class="form-group col-md-12 col-sm-12">
    							<label for="EDIT_DUONG_DAN_ZALO">Đường dẫn Zalo</label> 
    							<input type="text"
    								class="form-control" id="EDIT_DUONG_DAN_ZALO" placeholder="">
    							<span class="error-message" id="MSG_EDIT_DUONG_DAN_ZALO"></span>
    						</div>

						</div>

						<div class="col-12 d-flex justify-content-end">
							<div class="action-web">
								<button type="button" class="btn btn-action btn-light btn-icon-text me-1" name="BTN_GO_BACK">
        							<i class="fa fa-caret-left btn-icon-prepend"></i>Quay về
        						</button>
    
        						<button type="button" class="btn btn-action btn-info btn-icon-text" name="BTN_SAVE">
        							<i class="fa fa-save btn-icon-prepend"></i>Lưu
        						</button>
							</div>
							
							<div class="action-mobile">
								<div class="dropdown inline-block">
                                  <button type="button" class="btn btn-light dropdown-toggle" id="dropdownMenuIconButton4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  	Chức năng
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton4">
                                    <button type="button" class="dropdown-item" name="BTN_GO_BACK"><i class="icon-action-undo icon-action-mobile"></i>Quay về</button>
                                  </div>
                                </div>

                                <button type="button" class="btn btn-action btn-info btn-icon-text" name="BTN_SAVE">
        							<i class="fa fa-save btn-icon-prepend"></i>Lưu
        						</button>
							</div>
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

	// Create object data to check
	var data = {
	};
	
	$.ajax({
		type : "GET",
		url : '{{ url("/api/auth/my-info") }}',
		contentType : "application/json",
		showLoading: true,
		traditional: true,
		data : data,
		success : function(data, textStatus, request) {
			data = data.DATAS.USER;
			// Looping dynamic key data
			for (const [index, [key, value]] of Object.entries(data).entries()) {
				$('#EDIT_' + key.toUpperCase()).val(value);
			}

			// Vai trò
			if (!isEmpty(data.CHUC_DANH)) {
				$('#EDIT_VAI_TRO').val(data.CHUC_DANH.ROLE_NAME);
			}
			
			// Set trạng thái hoạt động
			$('#EDIT_TRANG_THAI_HOAT_DONG').prop('checked', data['TRANG_THAI_HOAT_DONG']);

			// Set image thumnail avatar hình đại diện
			let objAvatarUpload = data['HINH_ANH_DAI_DIEN'];
			if (!isEmpty(objAvatarUpload)) {

				// Hình ảnh đại diện
					{{ "section_" . $uuid1 }}_setThumbnailBoxOneImg(
							$("#{{'section_' . $uuid1 }}_divDropZone")[0]
							, !isEmpty(objAvatarUpload.NAME) ? objAvatarUpload.NAME : ''
							, !isEmpty(objAvatarUpload.DIRECTORY) ? objAvatarUpload.DIRECTORY : ''
					);

					/* Chi tiết hình ảnh */
					{{ "section_" . $uuid1 }}_chiTietHinhAnh(objAvatarUpload);

					// Append input danh sách hình ảnh đại diện
					{{ "section_" . $uuid1 }}_appendInputUploadHinhAnhDaiDien(objAvatarUpload);
			}
			

			// Show section main
			handleShowMainSection();
		},
		error : function(request, textStatus, errorThrown) {
			request.responseJSON = request.responseText ? JSON.parse(request.responseText) : null;
			// showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');

			// Show section error 404
			// redirectErrorPage(404);
		},
		complete : function() {
		}
	});

	

	/* Xử lý hiển thị section main */
	function handleShowMainSection() {
		$('#SECTION_MAIN').show();
	} 
	
	/* START Handle upload box 1 ảnh  */
	/* Set dafault text bên trong box upload 1 ảnh */
	{{"section_" . $uuid1 }}_setDefaultTextBoxUplOneImg('Upload ảnh đại diện');

	/* Xử lý get danh sách upload hình ảnh đại diện */
	getDanhSachUploadHinhAnhDaiDien = function() {
		return {{ "section_" . $uuid1 }}_getDanhSachUploadHinhAnhDaiDien();
	}
	/* END Handle upload box 1 ảnh */

 	/* Xử lý event lưu */
	$('button[name="BTN_SAVE"]').on('click', function() {
		// Reset all error msg
    	resetAllErrorMsg();

    	let data = setInputData();
    	$.ajax({
    		type: "POST", 
    		url: '{{ url("/api/auth/my-info/update") }}', 
    		contentType: "application/json",
			showLoading: true,
    		data: JSON.stringify(data), 
    		success: function(data, textStatus, request) {
    			// Ajax call completed successfully 
    			showToastSuccess('top-right', data.STATUS_DETAIL);
				data = data.DATAS.USER;
				// Set image thumnail avatar hình đại diện
				changeAvatarUser(data);
				$('span[name="USER_FULL_NAME"]').text(data.FULL_NAME);
    		}, 
    		error: function(request, textStatus, errorThrown) {
				if (request.status === 401 || request.status === 403) {
					return;
				}
				try {
					request.responseJSON = request.responseText ? JSON.parse(request.responseText) : null;
					showToastFailure('top-right', request.responseJSON && !isEmpty(request.responseJSON.STATUS_DETAIL) ? request.responseJSON.STATUS_DETAIL : 'Internal server');

					// Set error msg
					setErrorMsg(request, 'EDIT');
					
					// Set error msg
					var errors = request.responseJSON != null ? request.responseJSON.ERRORS : null;
					// Looping các key của error messages
					for (let key in errors) {
						if(errors.hasOwnProperty(key)){
							// Lopping danh sách lỗi
							let keyVals = errors[key];
							let errorMsg = '';
							for(var i in keyVals) {
								let keyVal = keyVals[i];
								errorMsg += keyVal;
								if (i < keyVals.length - 1) errorMsg += ' ';
							}

							// Set error message
							$('#MSG_' + key.replaceAll('.', '\\.')).text(errorMsg);
							switch (key) {
								case 'DANH_SACH_HINH_ANH_DAI_DIEN':
									$('#MSG_EDIT_ANH_DAI_DIEN').text(errorMsg);
									break;
								default:
									break;
							}
						}
					}
				}
				catch(err) {
					// Block of code to handle errors
					showToastFailure('top-right', 'Internal server');
				}
				finally {
					// Khối mã sẽ được thực thi bất kể kết quả thành công hay lỗi
					// Scroll đến msg lỗi
					scrollMsgInSection($('#CHI_TIET_THONG_TIN_CA_NHAN'));
				}
    		},
    		complete: function() {
    		}
    	});

    });

 	/* Xử lý set input data để lưu */
	function setInputData() {
    	// Create object data
    	var data = {
    	    FULL_NAME : $('#EDIT_FULL_NAME').val() != null ? $('#EDIT_FULL_NAME').val() : null,
			SO_DIEN_THOAI : sanitizePhoneNumberFromString($("#EDIT_SO_DIEN_THOAI").val()) || null,
   			DIA_CHI : $('#EDIT_DIA_CHI').val() || null,
   			DUONG_DAN_FACEBOOK : $('#EDIT_DUONG_DAN_FACEBOOK').val() || null,
			DUONG_DAN_ZALO : $('#EDIT_DUONG_DAN_ZALO').val() || null
    	};

    	// Array document storage file upload
		let hinhAnhDaiDien = null;
		let arrDanhSachHinhAnhDaiDien = Object.entries(getDanhSachUploadHinhAnhDaiDien());
		for (let [index, [key, value]] of arrDanhSachHinhAnhDaiDien.entries()) {
			if (key === 'DANH_SACH_HINH_ANH_DAI_DIEN') {
				for (let key in value) {
					hinhAnhDaiDien = value[key];
				}
			}
		}
    	data['HINH_ANH_DAI_DIEN'] = hinhAnhDaiDien;
  
		return data;
    }

	/* Xử lý event click btn go back danh sách */
    $('button[name="BTN_GO_BACK"]').on('click', function() {
    	window.location = '{{ url('/admin/san-pham') }}';
	});

});
</script>
@stop
