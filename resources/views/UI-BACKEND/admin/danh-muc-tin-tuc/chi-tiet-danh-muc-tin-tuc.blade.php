<?php
	$uuid1 = 'section' . Str::random(6);
?>

@extends('UI-BACKEND.admin.common.layout.master')

@section('plugin-css-for-this-page')
@stop 

@section('custom-css')
<style>
	@media (min-width: 1500px) {
		#CHI_TIET_DANH_MUC_TIN_TUC .section.col-lg-4-custom {
			flex: 0 0 auto;
			width: 350px;
		}
		#CHI_TIET_DANH_MUC_TIN_TUC .section.col-lg-8-custom {
			flex: 0 0 auto;
			width: calc(100% - 350px);
		}
	}
	@media (min-width: 1250px) and (max-width: 1500px) {
		#CHI_TIET_DANH_MUC_TIN_TUC .section.col-lg-4-custom {
			flex: 0 0 auto;
			width: 300px;
		}
		#CHI_TIET_DANH_MUC_TIN_TUC .section.col-lg-8-custom {
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
		<p class="mb-0">Quản lý danh mục tin tức</p>
	</div>
</li>
@stop

@section('content')
<div class="row section-main" id="SECTION_MAIN">

	<div class="col-lg-12 grid-margin stretch-card" id="CHI_TIET_DANH_MUC_TIN_TUC">
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-between">
					<div class="col-md-12 col-sm-12">
						<h4 class="card-title">
							CHI TIẾT <span class="one-line">DANH MỤC TIN TỨC</span>
						</h4>
					</div>
				</div>

				<div>
					<div class="row">
						<div class="form-group d-none">
							<label for="ID">Id danh mục tin tức</label> 
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
										, 'maxWidth' => '350px'
									]
								)
								<!-- END Include box upload 1 file vào -->
								<span class="error-message" id="MSG_EDIT_ANH_DAI_DIEN" style="text-align: center;"></span>
							</div>
						</div>
						<div class="section col-lg-8-custom col-md-12">
							<div class="form-group col-md-12 col-sm-12">
    							<label for="NAME">Tên danh mục tin tức<code>*</code></label> 
    							<input type="text"
    								class="form-control" id="EDIT_TEN_DANH_MUC_TIN_TUC" placeholder="">
    							<span class="error-message" id="MSG_EDIT_TEN_DANH_MUC_TIN_TUC"></span>
    						</div>
    						<div class="form-group col-md-12 col-sm-12">
    							<label for="PARENT_ID">Danh mục cha</label>
    							<select class="form-control select2-padding-custom" id="EDIT_PARENT_ID" data-placeholder=""></select>
    
    							<span class="error-message" id="MSG_EDIT_PARENT_ID"></span>
    						</div>

							<div class="form-group col-md-12 col-sm-12">
    							<label for="NAME">Số thứ tự<code>*</code></label> 
    							<input type="number"
    								class="form-control" id="EDIT_SORT_ORDER" placeholder="">
    							<span class="error-message" id="MSG_EDIT_SORT_ORDER"></span>
    						</div>

							<div class="form-group col-md-12 col-sm-12">
    							<label for="NAME">Tree level<code>*</code></label> 
    							<input type="number"
    								class="form-control" id="EDIT_TREE_LEVEL" placeholder="">
    							<span class="error-message" id="MSG_EDIT_TREE_LEVEL"></span>
    						</div>

    						<div class="form-group col-md-12 col-sm-12">
    							<label for="DESCRIPTION">Mô tả</label>
    							<textarea class="form-control" id="EDIT_MO_TA" rows="5"></textarea>
    							<span class="error-message" id="MSG_EDIT_MO_TA"></span>
    						</div>

    						<div class="form-group col-md-12 col-sm-12">
    							<label for="EDIT_TRANG_THAI_HOAT_DONG">Trạng thái hoạt động<code>*</code></label>
    							<div>
    								<label class="switch">
    									<input type="checkbox" class="primary" id="EDIT_TRANG_THAI_HOAT_DONG" checked>
    									<span class="slider"></span>
    								</label>
    								<span class="error-message" id="MSG_EDIT_TRANG_THAI_HOAT_DONG"></span>
    
    							</div>
    						</div>
						</div>

						<div class="col-12 d-flex justify-content-end">
							<div class="action-web">
								<button type="button" class="btn btn-action btn-light btn-icon-text me-1" name="BTN_GO_BACK">
        							<i class="fa fa-caret-left btn-icon-prepend"></i>Quay về
        						</button>
    							
    							<button type="button" class="btn btn-outline-info btn-fw btn-icon-text me-1" name="BTN_REFRESH">
    								<i class="fa fa-refresh btn-icon-prepend"></i>Làm mới
    							</button>
    
    							<button type="button" class="btn btn-danger btn-fw btn-icon-text me-1" name="BTN_DELETE">
    								<i class="fa fa-trash-o btn-icon-prepend"></i>Xóa
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
                                  	<button type="button" class="dropdown-item" name="BTN_DELETE"><i class="icon-trash icon-action-mobile"></i>Xóa</button>
                                  	<div class="dropdown-divider"></div>

                                    <button type="button" class="dropdown-item" name="BTN_REFRESH"><i class="icon-refresh icon-action-mobile"></i>Làm mới</button>
                                    <div class="dropdown-divider"></div>

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
	@if (isset($categoryNId))
		/* Xử lý get chi tiết category product */
		var categoryNId = '{{ isset($categoryNId) ? $categoryNId : null }}';

		// Create object data to check
		var data = {
		};
		
		$.ajax({
			type : "GET",
			url: '{{ url("/api/categoryn/detail") }}' + "/" + categoryNId, 
			contentType : "application/json",
			showLoading: true,
			traditional: true,
			data : data,
			success : function(data, textStatus, request) {
				data = data.DATAS.CATEGORY_N;
				// Looping dynamic key data
				for (const [index, [key, value]] of Object.entries(data).entries()) {
					$('#EDIT_' + key.toUpperCase()).val(value);
				}

				// Set trạng thái hoạt động
				$('#EDIT_TRANG_THAI_HOAT_DONG').prop('checked', data['TRANG_THAI_HOAT_DONG']);

				// Set selected value
				getListDanhMucTinTucTree(data['PARENT_ID']);

				// Set image thumnail avatar hình đại diện
				let objAvatarUpload = data['DANH_SACH_HINH_ANH_DAI_DIEN'];
				if (!isEmpty(objAvatarUpload)) {

					// Hình ảnh đại diện
					let $objAvatarThumnail = $(objAvatarUpload).filter(function(idx) {
						return objAvatarUpload[idx].IS_THUMNAIL === true; // Filter là ảnh thumnail
					});
					if ($objAvatarThumnail.length > 0) {
						{{ "section_" . $uuid1 }}_setThumbnailBoxOneImg(
								$("#{{'section_' . $uuid1 }}_divDropZone")[0]
            					, !isEmpty($objAvatarThumnail[0].NAME) ? $objAvatarThumnail[0].NAME : ''
            					, !isEmpty($objAvatarThumnail[0].DIRECTORY) ? $objAvatarThumnail[0].DIRECTORY : ''
            			);

						/* Chi tiết hình ảnh */
						{{ "section_" . $uuid1 }}_chiTietHinhAnh($objAvatarThumnail[0]);

						// Append input danh sách hình ảnh đại diện
						{{ "section_" . $uuid1 }}_appendInputUploadHinhAnhDaiDien($objAvatarThumnail[0]);
					}
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

	/* Xử lý get chi tiết category product */
	@else
		// Show section main
		handleShowMainSection();

		getListDanhMucTinTucTree();
	@endif

	/* Xử lý hiển thị section main */
	function handleShowMainSection() {
		$('#SECTION_MAIN').show();
	} 
	
	/* START Handle upload box 1 ảnh  */
	/* Set dafault text bên trong box upload 1 ảnh */
	{{"section_" . $uuid1 }}_setDefaultTextBoxUplOneImg('Upload ảnh bìa');

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
    		url: '{{ url("/api/categoryn/save") }}', 
    		contentType: "application/json",
			showLoading: true,
    		data: JSON.stringify(data), 
    		success: function(data, textStatus, request) {
    			// Ajax call completed successfully 
    			showToastSuccess('top-right', data.STATUS_DETAIL);

    			// Set id khi lưu thành công
    			$('#EDIT_ID').val(data.DATAS.CategoryN.ID);

    			// Reload danh sách catetory parent
    			getListDanhMucTinTucTree(data.DATAS.CategoryN.PARENT_ID);

    			// Cập nhật id vừa save
    			updUrlCategoryId(data.DATAS.CategoryN.ID);
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
					scrollMsgInSection($('#CHI_TIET_DANH_MUC_TIN_TUC'));
				}
    		},
    		complete: function() {
    		}
    	});

    });

 	function updUrlCategoryId(categoryNId) {
 	 	let url = '{{ url("/admin/danh-muc-tin-tuc/chi-tiet") }}'
 	 	if (categoryNId !== null) {
 	 		url= url + "/" + categoryNId;
 	 	}
 		updUrlWithoutReloadPage(url);
 	}

 	/* Xử lý set input data để lưu */
	function setInputData() {
    	// Create object data
    	var data = {
    	    ID : $('#EDIT_ID').val() != null ? $('#EDIT_ID').val() : null,
			PARENT_ID : $("#EDIT_PARENT_ID").val() || null,
   			TEN_DANH_MUC_TIN_TUC : $('#EDIT_TEN_DANH_MUC_TIN_TUC').val() || null,
			SORT_ORDER : !isEmpty($('#EDIT_SORT_ORDER').val()) ? $('#EDIT_SORT_ORDER').val() : null,
			TREE_LEVEL : !isEmpty($('#EDIT_TREE_LEVEL').val()) ? $('#EDIT_TREE_LEVEL').val() : null,
   			MO_TA : $('#EDIT_MO_TA').val() || null,
   			TRANG_THAI_HOAT_DONG: $('#EDIT_TRANG_THAI_HOAT_DONG').is(':checked') ? true : false
    	};

    	// Array document storage file upload
		let danhSachHinhAnhDaiDien = [];
		let arrDanhSachHinhAnhDaiDien = Object.entries(getDanhSachUploadHinhAnhDaiDien());
		for (let [index, [key, value]] of arrDanhSachHinhAnhDaiDien.entries()) {
			if (key === 'DANH_SACH_HINH_ANH_DAI_DIEN') {
				for (let key in value) {
					danhSachHinhAnhDaiDien.push(value[key]);
				}
			}
		}
    	data['DANH_SACH_HINH_ANH_DAI_DIEN'] = danhSachHinhAnhDaiDien;
  
		return data;
    }

	/* Xử lý reset all input data */
    function resetAllInputData() {
    	$('[id^="EDIT_"]').not('[type="radio"], [type="checkbox"]').each(function(i, obj) {
			$(this).val(null).trigger('change');
		});
    	$('#EDIT_TRANG_THAI_HOAT_DONG').prop('checked', true);
    	$('#EDIT_PARENT_ID').val(null).trigger('change');
    }

	/* Xử lý event click btn refresh data */
    $('button[name="BTN_REFRESH"]').on('click', function() {
    	handleBtnRefresh();
	});

	function handleBtnRefresh() {
		// Cập nhật reset url id
		updUrlCategoryId(null);

		resetAllInputData();
    	resetAllErrorMsg();
    	deleteContentBoxOneImgUpload();
	}

	/* Xử lý event click btn go back danh sách */
    $('button[name="BTN_GO_BACK"]').on('click', function() {
    	window.location = '{{ url('/admin/danh-muc-tin-tuc') }}';
	});

	
	// Init Select2 tree nodes
	function initSelect2Tree(arrayData, selectedVal) {
		// Empty dữ liệu và destroy select2 trước đó
		if($("#EDIT_PARENT_ID").data('select2')) $("#EDIT_PARENT_ID").empty().select2('destroy');
		$("#EDIT_PARENT_ID").prepend('<option selected></option>').select2ToTree(
			{
				/* [Quan trọng] Phần khởi tạo input select2 tree */
				treeData: {
					/* Một mảng chứa dữ liệu */
					dataArr: arrayData, 
					/* id của select2 sẽ mapping với field nào trong arrayData */
					valFld: "ID",
					/* Tên label của select2 sẽ mapping với field nào trong arrayData */
					labelFld: "TEN_DANH_MUC_TIN_TUC",
					/* Tên object chứa array children */
					incFld: "DANH_SACH_CHILDREN",
					/* Có đươc expand hay collapse */
					expandAll: true
				}, 
				maximumSelectionLength: 3,
				width: "100%",
				closeOnSelect: true,
				placeholder: $( this ).data( 'placeholder' ),
				allowClear: true,
				multiple: false,
				/* Set thông tin message cho select2 */
	    		language: {
	                noResults: function() {
	                    return "Không tìm thấy kết quả";
	                }
	            }
			}
		);

		// Set selected value
		$("#EDIT_PARENT_ID").val(selectedVal).trigger('change');
	}
	
	function getListDanhMucTinTucTree(selectedVal) {
		$.ajax({
			type : "GET",
			url : '{{ url("/api/categoryn/list/tree") }}',
			contentType : "application/json",
			traditional: true,
			showLoading: false,
			data : function() { // IIFE 
				let dataInput = {};

				dataInput.IS_GET_ALL_ELEMENTS = true;

				return dataInput; // Trả về object input data
			}(),
			success : function(data, textStatus, request) {
				/* [Quan trọng] đây là phần build data cho select2 tree */
				let arrResult = [];
				var result = data.DATAS.CATEGORY_N;
				if (result && result.DATA) {
					arrResult = result.DATA;
				}

				// Init select2 tree
				initSelect2Tree(arrResult, selectedVal || null);
			},
			error : function(request, textStatus, errorThrown) {
				request.responseJSON = request.responseText ? JSON.parse(request.responseText) : null;
				showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
			},
			complete : function() {
			}
		});
	}

	/* Xử lý event xóa */
	$('button[name="BTN_DELETE"]').on('click', function() {
		let categoryNId = $('#EDIT_ID').val() != null ? $('#EDIT_ID').val() : '';

		if (categoryNId === '') {
			showToastFailure('top-right', 'Không thể xóa. Vì dữ liệu chưa được tạo.');
			return;
		}
		showSwalWarningPopup(function callback(result) {
			if (result.isConfirmed === true) {
				// Create object data to save parameters
				var data = {
				}

				$.ajax({
					type: "DELETE", 
					url: '{{ url("/api/categoryn/delete") }}' + "/" + categoryNId, 
					contentType: "application/json",
					showLoading: true,
					data: JSON.stringify(data), 
					success: function(data, textStatus, request) {
						// Ajax call completed successfully 
    					showToastSuccess('top-right', data.STATUS_DETAIL);
    					// Fetch lại dữ liệu danh mục cha
    					getListDanhMucTinTucTree();
    					// Refresh input
    					handleBtnRefresh();
					}, 
					error: function(request, textStatus, errorThrown) {
						if (request.status !== 401 && request.status !== 403) {
							request.responseJSON = request.responseText ? JSON.parse(request.responseText) : null;
							showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
						}
					},
					complete: function(){
					}
				});
  		    } else if (result.isDismissed === true) {

      	    } else if (result.isDenied === true) {

			}
		});
	});

	/* Xử lý switch active hoạt động */
    $('#EDIT_TRANG_THAI_HOAT_DONG').on('click', function(e) {
		e.preventDefault(); // Ngăn không cho active hoặc unactive hoạt động đến khi confirm

		let isActived = $('#EDIT_TRANG_THAI_HOAT_DONG').is(':checked');
		showSwalWarningPopup(function callback(result) {
			if (result.isConfirmed === true) {
				$('#EDIT_TRANG_THAI_HOAT_DONG').prop('checked', isActived);
  		    } else if (result.isDismissed === true) {
  		    	/* Xử lý trả lại dữ liệu switch hoạt động trước đó */
  		    	$('#EDIT_TRANG_THAI_HOAT_DONG').prop('checked', !isActived);
      	    } else if (result.isDenied === true) {

			}
		}, 'Bạn có muốn thay đổi <span style="display: inline-block;">trạng thái hoạt động?</span>');
	});
});
</script>
@stop
