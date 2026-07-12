<?php
	$uuid1 = 'section' . Str::random(6);
?>

@extends('UI-BACKEND.admin.common.layout.master')

@section('plugin-css-for-this-page')
@stop 

@section('custom-css')
<style>
	@media (min-width: 1500px) {
		#CHI_TIET_DOI_MAT_KHAU .section.col-lg-4-custom {
			flex: 0 0 auto;
			width: 350px;
		}
		#CHI_TIET_DOI_MAT_KHAU .section.col-lg-8-custom {
			flex: 0 0 auto;
			width: calc(100% - 350px);
		}
	}
	@media (min-width: 1250px) and (max-width: 1500px) {
		#CHI_TIET_DOI_MAT_KHAU .section.col-lg-4-custom {
			flex: 0 0 auto;
			width: 300px;
		}
		#CHI_TIET_DOI_MAT_KHAU .section.col-lg-8-custom {
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
		<p class="mb-0">Đổi mật khẩu</p>
	</div>
</li>
@stop

@section('content')
<div class="row section-main" id="SECTION_MAIN">

	<div class="col-lg-12 grid-margin stretch-card" id="CHI_TIET_DOI_MAT_KHAU">
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-between">
					<div class="col-md-12 col-sm-12">
						<h4 class="card-title">
							<span class="one-line">ĐỔI MẬT KHẨU</span>
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
						
						<div class="row section col-lg-12 col-md-12" style="margin-right: unset; padding-left: unset; padding-right: unset; margin-left: unset;">
                            <div class="form-group col-md-6 col-sm-12">
    							<label for="NAME">Email</label> 
    							<input type="text" readonly
    								class="form-control" id="EDIT_EMAIL" placeholder="">
    							<span class="error-message" id="EDIT_EMAIL"></span>
    						</div>


                            <div class="form-group col-md-6 col-sm-12">
    							<label for="NAME">Mật khẩu cũ</label> 
    							<input type="password" autocomplete="new-password"
    								class="form-control" id="EDIT_OLD_PASSWORD" placeholder="">
    							<span class="error-message" id="MSG_EDIT_OLD_PASSWORD"></span>
    						</div>

                            <div class="form-group col-md-6 col-sm-12">
    							<label for="NAME">Mật khẩu mới</label> 
    							<input type="password" autocomplete="new-password"
    								class="form-control" id="EDIT_NEW_PASSWORD" placeholder="">
    							<span class="error-message" id="MSG_EDIT_NEW_PASSWORD"></span>
    						</div>

							<div class="form-group col-md-6 col-sm-12">
    							<label for="NAME">Nhập lại mật khẩu</label> 
    							<input type="password" autocomplete="new-password"
    								class="form-control" id="EDIT_CONFIRM_NEW_PASSWORD" placeholder="">
    							<span class="error-message" id="MSG_EDIT_CONFIRM_NEW_PASSWORD"></span>
    						</div>

						</div>

						<div class="col-12 d-flex justify-content-end">
							<div class="action-web">
								<button type="button" class="btn btn-action btn-light btn-icon-text me-1" name="BTN_GO_BACK">
        							<i class="fa fa-caret-left btn-icon-prepend"></i>Quay về
        						</button>
    
        						<button type="button" class="btn btn-action btn-info btn-icon-text" name="BTN_SAVE">
        							<i class="fa fa-save btn-icon-prepend"></i>Đổi mật khẩu
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
        							<i class="fa fa-save btn-icon-prepend"></i>Đổi mật khẩu
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

			// Set trạng thái hoạt động
			$('#EDIT_TRANG_THAI_HOAT_DONG').prop('checked', data['TRANG_THAI_HOAT_DONG']);

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
	
 	/* Xử lý event lưu */
	$('button[name="BTN_SAVE"]').on('click', function() {
		// Reset all error msg
    	resetAllErrorMsg();

    	let data = setInputData();
    	$.ajax({
    		type: "POST", 
    		url: '{{ url("/api/auth/my-info/update-password") }}', 
    		contentType: "application/json",
			showLoading: true,
    		data: JSON.stringify(data), 
    		success: function(data, textStatus, request) {
    			// Ajax call completed successfully 
    			showToastSuccess('top-right', data.STATUS_DETAIL);
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
					scrollMsgInSection($('#CHI_TIET_DOI_MAT_KHAU'));
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
    	    OLD_PASSWORD : $("#EDIT_OLD_PASSWORD").val() || null,
			NEW_PASSWORD : $("#EDIT_NEW_PASSWORD").val() || null,
			CONFIRM_NEW_PASSWORD : $('#EDIT_CONFIRM_NEW_PASSWORD').val() || null
    	};

		return data;
    }

	/* Xử lý event click btn go back danh sách */
    $('button[name="BTN_GO_BACK"]').on('click', function() {
    	window.location = '{{ url('/admin/san-pham') }}';
	});

});
</script>
@stop
