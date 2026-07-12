<style>
	@media (max-width : 575px) {
		
	}
</style>

<!-- Modal starts -->
<div class="modal fade" id="{{ $sectionId }}_MODAL_DIA_CHI" tabindex="-1"
	role="dialog" aria-labelledby="{{ $sectionId }}_MODAL_DIA_CHI_LABEL" aria-hidden="true"
	data-bs-keyboard="true" 
	data-bs-backdrop="static">
	<div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document" style="max-width: {{ $width }};">
		<div class="modal-content">
			<div class="modal-header">
				<div class="section-go-back">
				</div>

				<h5 class="modal-title" id="{{ $sectionId }}_MODAL_DIA_CHI_LABEL">{{ $title }}</h5>
				
				<!-- Thêm attr này vào btn để có thể đóng popup tự động data-bs-dismiss="modal" -->
				<button type="button"
					id="{{ $sectionId }}_MODAL_DIA_CHI_CLOSE"
					class="close btn rounded-circle" 
					aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
                	<div class="col-xl-12 col-item">
                    	 <div class="form-group">
							<label for="{{ $sectionId }}_THANH_PHO">Chọn thành phố<code>*</code></label>

							<select class="form-control input-select2" id="{{ $sectionId }}_THANH_PHO" data-placeholder="Vui lòng chọn"></select>

							<span class="error-message" id="MSG_{{ $sectionId }}_THANH_PHO"></span>
						</div>
                    </div>
                    <div class="col-xl-12 col-item">
                    	 <div class="form-group">
							<label for="{{ $sectionId }}_QUAN_HUYEN_THI_XA">Chọn quận, huyện, thị xã<code>*</code></label>

							<select class="form-control input-select2" id="{{ $sectionId }}_QUAN_HUYEN_THI_XA" data-placeholder="Vui lòng chọn"></select>

							<span class="error-message" id="MSG_{{ $sectionId }}_QUAN_HUYEN_THI_XA"></span>
						</div>
                    </div>
                    <div class="col-xl-12 col-item">
                    	 <div class="form-group">
							<label for="{{ $sectionId }}_PHUONG_XA_THI_TRAN">Chọn phường, xã, thị trấn<code>*</code></label>

							<select class="form-control input-select2" id="{{ $sectionId }}_PHUONG_XA_THI_TRAN" data-placeholder="Vui lòng chọn"></select>

							<span class="error-message" id="MSG_{{ $sectionId }}_PHUONG_XA_THI_TRAN"></span>
						</div>
                    </div>
                    <div class="col-xl-12 col-item">
                    	 <div class="form-group">
							<label for="{{ $sectionId }}_TEN_DUONG">Tên đường<code>*</code></label>

							<input type="text" class="form-control" id="{{ $sectionId }}_TEN_DUONG" placeholder=""> 

							<span class="error-message" id="MSG_{{ $sectionId }}_TEN_DUONG"></span>
						</div>
                    </div>
                    <div class="col-xl-12 col-item">
                    	 <div class="form-group">
							<label for="{{ $sectionId }}_SO_NHA">Số nhà</label>

							<input type="text" class="form-control" id="{{ $sectionId }}_SO_NHA" placeholder=""> 

							<span class="error-message" id="MSG_{{ $sectionId }}_SO_NHA"></span>
						</div>
                    </div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="{{ $sectionId }}_BTN_DONE" type="button" class="btn btn-info width-100-percent">XONG</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal Ends -->

<script>
$(document).ready(function(){

	var {{ $sectionId }}_dataInitialPopupDiaChiDat = {
		key: null,
		type_key: null,
		value: null
	}
	var {{ $sectionId }}_arrDataInitialPopupDiaChiDat = [];
	
	/* Xử lý logic khi open popup */
	{{ $sectionId }}_handleOpenPopupDiaChiDat = function(thanhPhoCode, quanHuyenCode, phuongXaCode, tenDuong, soNha) {
		let countColItem = $('#{{ $sectionId }}_MODAL_DIA_CHI .modal-body').find('.col-item').length;

		// Set default value
		{{ $sectionId }}_initDefaultDataPopupDiaChiDat(thanhPhoCode, quanHuyenCode, phuongXaCode, tenDuong, soNha);
	}

	/* Button close đóng popup */
	$('#{{ $sectionId }}_MODAL_DIA_CHI_CLOSE').on('click', function(e) {
		// Đóng modal popup
		$('#{{ $sectionId }}_MODAL_DIA_CHI').modal('toggle');
	});

	/* Xử lý sự kiện khi nhấn phím trên modal */
	$('#{{ $sectionId }}_MODAL_DIA_CHI').keyup(function(event) {
		if (event.keyCode === 13) { // Nhấn phím ENTER
			$('#{{ $sectionId }}_BTN_DONE').trigger('click');
		}
	});

	/* Xử lý sự kiện khi modal ĐANG MỞ */
	$('#{{ $sectionId }}_MODAL_DIA_CHI').on('show.bs.modal', function (e) {
		// Xử lý sự kiện khi modal bắt đầu mở. Đang chuyển cảnh...
		console.log('Modal đang mở!');
		$('#{{ $sectionId }}_MODAL_DIA_CHI .modal-footer').removeClass('disable-events').addClass('disable-events');
	});

	/* Xử lý sự kiện khi modal ĐÃ MỞ */
	$('#{{ $sectionId }}_MODAL_DIA_CHI').on('shown.bs.modal', function (e) {
		// Xử lý sự kiện khi modal đã mở. Hoàn tất chuyển cảnh
		console.log('Modal đã mở!');
		$('#{{ $sectionId }}_MODAL_DIA_CHI .modal-footer').removeClass('disable-events');
	});
	
	var {{ $sectionId }}_mustClosePopup = false;
	/* Xử lý sự kiện khi modal ĐANG ĐÓNG */
	$('#{{ $sectionId }}_MODAL_DIA_CHI').on('hide.bs.modal', function (e) {
		// Xử lý sự kiện khi modal đang đóng. Đang chuyển cảnh...
		console.log('Modal đang đóng!');

		if ({{ $sectionId }}_mustClosePopup === true) {
			{{ $sectionId }}_mustClosePopup = false;
			return;
		}
		// Kiểm tra xem dữ liệu có đang bị thay đổi so với ban đầu không ?
		let isDataChanged = {{ $sectionId }}_isDataChangedBdsDatComboboxDiaChi();
		if (isDataChanged === true ) {
			e.preventDefault(); // Ngăn modal không bị đóng. Ngăn hành động mặc định (trong trường hợp này là đóng modal) xảy ra.

			showSwalWarningPopup(function callback(result) {
				if (result.isConfirmed === true) {
					// Đóng modal popup
					{{ $sectionId }}_mustClosePopup = true;
					$('#{{ $sectionId }}_MODAL_DIA_CHI').modal('toggle');
				} else if (result.isDismissed === true) {

				} else if (result.isDenied === true) {

				}
			}, "Có dữ liệu thay đổi.<span style=\"display: inline-block;\"> Bạn có muốn đóng popup không?</span>");
		}
	});

	/* Xử lý sự kiện sau khi MODAL ĐÃ ĐÓNG */
	$('#{{ $sectionId }}_MODAL_DIA_CHI').on('hidden.bs.modal', function (e) {
		// Xử lý sự kiện sau khi modal đã đóng. Hoàn tất chuyển cảnh.
		console.log('Modal đã được đóng!');
	});

	/* Xử lý ngăn người dùng đóng modal bằng click vào backdrop */
	$('#{{ $sectionId }}_MODAL_DIA_CHI').on('hidePrevented.bs.modal', function (e) {
		// Ngăn modal focus lại khi click vào backdrop
		e.preventDefault();
	});
	
	/* Kiểm tra data thay đổi */
	function {{ $sectionId }}_isDataChangedBdsDatComboboxDiaChi() {
		let isDataChanged = false;

		// Get datas từ FORM UI
		let {
			arrData
		} = {{ $sectionId }}_getDatasFormUIComboboxDiaChi();

		// Get detail datas từ FORM UI
		for (let dataFormUI of arrData) {
			for (let dataInitial of {{ $sectionId }}_arrDataInitialPopupDiaChiDat) {
				let dataFormVal = isEmpty(dataFormUI.value) ? '' : dataFormUI.value;
				let dataInitVal = isEmpty(dataInitial.value) ? '' : dataInitial.value;

				if (!isEmpty(dataFormUI.key) && !isEmpty(dataInitial.key)
					&& dataFormUI.key == dataInitial.key
					&& dataFormVal != dataInitVal
				) {
					isDataChanged = true;
					return isDataChanged;
				}
			}
		}

		return isDataChanged;
	}

	/* Xử lý set data initial ban đầu. Phục vụ cho việc check thay đổi dữ liệu sau này */
	function {{ $sectionId }}_setDataInitialPopupDiaChiDat(thanhPhoCode, quanHuyenCode, phuongXaCode, tenDuong, soNha) {
		// Reset array data initial
		{{ $sectionId }}_arrDataInitialPopupDiaChiDat = [];

		// Thành phố
		{{ $sectionId }}_dataInitialPopupDiaChiDat = {}; // Tạo đối tượng mới
		{{ $sectionId }}_dataInitialPopupDiaChiDat.key = "{{ $sectionId }}_THANH_PHO";
		{{ $sectionId }}_dataInitialPopupDiaChiDat.type_key = "ID";
		{{ $sectionId }}_dataInitialPopupDiaChiDat.value = thanhPhoCode;
		{{ $sectionId }}_arrDataInitialPopupDiaChiDat.push({{ $sectionId }}_dataInitialPopupDiaChiDat); // Push to array

		// Quận huyện
		{{ $sectionId }}_dataInitialPopupDiaChiDat = {}; // Tạo đối tượng mới
		{{ $sectionId }}_dataInitialPopupDiaChiDat.key = "{{ $sectionId }}_QUAN_HUYEN_THI_XA";
		{{ $sectionId }}_dataInitialPopupDiaChiDat.type_key = "ID";
		{{ $sectionId }}_dataInitialPopupDiaChiDat.value = quanHuyenCode;
		{{ $sectionId }}_arrDataInitialPopupDiaChiDat.push({{ $sectionId }}_dataInitialPopupDiaChiDat); // Push to array

		// Phường xã
		{{ $sectionId }}_dataInitialPopupDiaChiDat = {}; // Tạo đối tượng mới
		{{ $sectionId }}_dataInitialPopupDiaChiDat.key = "{{ $sectionId }}_PHUONG_XA_THI_TRAN";
		{{ $sectionId }}_dataInitialPopupDiaChiDat.type_key = "ID";
		{{ $sectionId }}_dataInitialPopupDiaChiDat.value = phuongXaCode;
		{{ $sectionId }}_arrDataInitialPopupDiaChiDat.push({{ $sectionId }}_dataInitialPopupDiaChiDat); // Push to array

		// Tên đường
		{{ $sectionId }}_dataInitialPopupDiaChiDat = {}; // Tạo đối tượng mới
		{{ $sectionId }}_dataInitialPopupDiaChiDat.key = "{{ $sectionId }}_TEN_DUONG";
		{{ $sectionId }}_dataInitialPopupDiaChiDat.type_key = "ID";
		{{ $sectionId }}_dataInitialPopupDiaChiDat.value = tenDuong;
		{{ $sectionId }}_arrDataInitialPopupDiaChiDat.push({{ $sectionId }}_dataInitialPopupDiaChiDat); // Push to array

		// Số nhà
		{{ $sectionId }}_dataInitialPopupDiaChiDat = {}; // Tạo đối tượng mới
		{{ $sectionId }}_dataInitialPopupDiaChiDat.key = "{{ $sectionId }}_SO_NHA";
		{{ $sectionId }}_dataInitialPopupDiaChiDat.type_key = "ID";
		{{ $sectionId }}_dataInitialPopupDiaChiDat.value = soNha;
		{{ $sectionId }}_arrDataInitialPopupDiaChiDat.push({{ $sectionId }}_dataInitialPopupDiaChiDat); // Push to array

		return {{ $sectionId }}_arrDataInitialPopupDiaChiDat;
	}

	/* Set default data popup đia chỉ đất */
	function {{ $sectionId }}_initDefaultDataPopupDiaChiDat(thanhPhoCode, quanHuyenCode, phuongXaCode, tenDuong, soNha) {
		// Set data initial
		{{ $sectionId }}_setDataInitialPopupDiaChiDat(thanhPhoCode, quanHuyenCode, phuongXaCode, tenDuong, soNha);
		console.log("Datas initail : ");
		console.log({{ $sectionId }}_arrDataInitialPopupDiaChiDat);

		{{ $sectionId }}_resetMsgComboboxDiaChi();

		// Clear data select2 và Khởi tạo UI cho các select2 để nó không lỗi hiển thị, input bị nhỏ sau đó mới bung to ra khi load select2
		{{ $sectionId }}_initSelectComboboxThanhPho([]);
		{{ $sectionId }}_initSelectComboboxQuanHuyen([]);
		{{ $sectionId }}_initSelectComboboxPhuongXa([]);

		// Load data và khởi tạo select2 thành phố
		{{ $sectionId }}_loadSelectComboboxThanhPho(thanhPhoCode);

		// Select2 quận huyện thị xã
		if (thanhPhoCode === undefined) {
			enableDisableSelect2($('#{{ $sectionId }}_QUAN_HUYEN_THI_XA'), false);
		} else {
			{{ $sectionId }}_loadSelectBdsDatComboboxQuanHuyen(thanhPhoCode, quanHuyenCode);
		}

		// Select2 phường xã thị trấn
		if (quanHuyenCode === undefined) {
			enableDisableSelect2($('#{{ $sectionId }}_PHUONG_XA_THI_TRAN'), false);
		} else {
			{{ $sectionId }}_loadSelectComboboxPhuongXa(quanHuyenCode, phuongXaCode);
		}

		// Tên đường
		if (tenDuong === undefined) {
			$('#{{ $sectionId }}_TEN_DUONG').val('');
		} else {
			$('#{{ $sectionId }}_TEN_DUONG').val(tenDuong);
		}

		// Số nhà
		if (soNha === undefined) {
			$('#{{ $sectionId }}_SO_NHA').val('');
		} else {
			$('#{{ $sectionId }}_SO_NHA').val(soNha);
		}
	}

	/* START select2 combobox thành phố */
	function {{ $sectionId }}_emptySelectComboboxThanhPho() {
		// Empty select2
		$('#{{ $sectionId }}_THANH_PHO').empty();
		// Append thêm option rỗng để không chọn default value. Hiển thị placeholder
		$('#{{ $sectionId }}_THANH_PHO').append('<option></option>');
	}

	// Function init select2 BDS_DAT_COMBOBOX_{{ $sectionId }}_THANH_PHO
	function {{ $sectionId }}_initSelectComboboxThanhPho(results, isDefaultGetAll, defaultValue) {
		// Empty select2
		{{ $sectionId }}_emptySelectComboboxThanhPho();

		if (isDefaultGetAll === true) {
    		/* Tạo select2 tất cả default value cho combobox này (Nếu không dùng thì xóa đi) */
        	$('#{{ $sectionId }}_THANH_PHO').append('<option value="all">Tất cả</option>');
        	$('#{{ $sectionId }}_THANH_PHO').val('all').trigger('change');
    	}

		$('#{{ $sectionId }}_THANH_PHO').select2({
			/* [Quan trọng] Nếu có sử dụng popup để hiện thị select2 thì thêm id của popup vào dropdownParent để không bị lỗi hiển thị css. Còn không dùng popup thì xóa dropdownParent này đi */
			dropdownParent: $("#{{ $sectionId }}_MODAL_DIA_CHI"),
			placeholder: $( this ).data( 'placeholder' ),
			/* [Quan trọng] object results set dữ liệu vào select2. Với định dạng: */
				/* [
				{
					"id": "id indentity",
					"text": "label select2"
				},
				{
					"id": "id indentity",
					"text": "label select2"
				}
			] */
			data: results,
			width: "100%",
			closeOnSelect: true,
			allowClear: true,
			maximumSelectionLength: 100
		});

		// Optional set defaultValue
		if (typeof(defaultValue) != 'undefined') setValueSelect2($('#{{ $sectionId }}_THANH_PHO'), defaultValue);
	}
	// Events select2
	$('#{{ $sectionId }}_THANH_PHO').on('select2:select', function (e) {
		let selectedValue = e.params.data.id; // Lấy giá trị của tùy chọn đã chọn
    	let selectedText = e.params.data.text; // Lấy văn bản của tùy chọn đã chọn

		let thanhPhoCode = selectedValue;
		// Load select2 quận huyện theo thành phố
		{{ $sectionId }}_loadSelectBdsDatComboboxQuanHuyen(thanhPhoCode);

		// Clear select2 phường xã
		enableDisableSelect2($('#{{ $sectionId }}_PHUONG_XA_THI_TRAN'), false);
		{{ $sectionId }}_initSelectComboboxPhuongXa([]);
	}).on('change', function (e) {
		// Nó sẽ chạy lần đầu init select2
		let selectedValue = $(this).val(); // Lấy giá trị đang chọn
        let selectedText = $(this).find('option:selected').text(); // Lấy văn bản của tùy chọn đang chọn
		
		if (typeof(selectedValue) == "undefined" || selectedValue == null || selectedValue.length == 0) { // Delete chose item select childrens khi thay đổi giá trị ở parent select2
			// Select2 quận huyện
			enableDisableSelect2($('#{{ $sectionId }}_QUAN_HUYEN_THI_XA'), false);
			{{ $sectionId }}_initSelectComboboxQuanHuyen([]);

			// Select2 phường xã
			enableDisableSelect2($('#{{ $sectionId }}_PHUONG_XA_THI_TRAN'), false);
			{{ $sectionId }}_initSelectComboboxPhuongXa([]);
		}
	}).on('select2:open', function() {
		// Ngăn bàn phím mở tự động khi dropdown được mở
		preventOpenKeyboardSelect2();
	});

	// Load data cho select2
	function {{ $sectionId }}_loadSelectComboboxThanhPho(defaultValue) {
		
		// Create object data to get list column model parent
		var data = {};
		$.ajax({
			type : "GET",
			url : '{{ url("/api/province/list") }}',
			contentType : "application/json",
			showLoading: false,
			traditional: true,
			data : data,
			success: function(data, textStatus, request) {
				console.log(data);
				// Create array results for select2
				let results = [];
				// Looping json repsonse
				let arrResult = data.DATAS.Province;
				for (var i = 0; i < arrResult.length; i++) {
					// Create object result
					let result = {
						"id": arrResult[i].CODE,
						"text": arrResult[i].TEN_TINH_THANH
					}
					results.push(result);
				}
				// init select2 bds dat combobox thanh pho
				{{ $sectionId }}_initSelectComboboxThanhPho(results, false, defaultValue);
			},
			error: function(request, textStatus, errorThrown) {
				if (request.status !== 401 && request.status !== 403) {
					request.responseJSON = request.responseText ? JSON.parse(request.responseText) : null;
					showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
				}
			},
			complete : function() {

			}
		});
	}
	/* END select2 combobox thành phố */


	/* START select2 combobox quận huyện */
	function {{ $sectionId }}_emptySelectComboboxQuanHuyen() {
		// Empty select2
		$('#{{ $sectionId }}_QUAN_HUYEN_THI_XA').empty();
		// Append thêm option rỗng để không chọn default value. Hiển thị placeholder
		$('#{{ $sectionId }}_QUAN_HUYEN_THI_XA').append('<option></option>');
	}

	// Function init select2 quận huyện
	function {{ $sectionId }}_initSelectComboboxQuanHuyen(results, isDefaultGetAll, defaultValue) {
		// Empty select2
		{{ $sectionId }}_emptySelectComboboxQuanHuyen();

		if (isDefaultGetAll === true) {
    		/* Tạo select2 tất cả default value cho combobox này (Nếu không dùng thì xóa đi) */
        	$('#{{ $sectionId }}_QUAN_HUYEN_THI_XA').append('<option value="all">Tất cả</option>');
        	$('#{{ $sectionId }}_QUAN_HUYEN_THI_XA').val('all').trigger('change');
    	}

		$('#{{ $sectionId }}_QUAN_HUYEN_THI_XA').select2({
			/* [Quan trọng] Nếu có sử dụng popup để hiện thị select2 thì thêm id của popup vào dropdownParent để không bị lỗi hiển thị css. Còn không dùng popup thì xóa dropdownParent này đi */
			dropdownParent: $("#{{ $sectionId }}_MODAL_DIA_CHI"),
			placeholder: $( this ).data( 'placeholder' ),
			/* [Quan trọng] object results set dữ liệu vào select2. Với định dạng: */
				/* [
				{
					"id": "id indentity",
					"text": "label select2"
				},
				{
					"id": "id indentity",
					"text": "label select2"
				}
			] */
			data: results,
			width: "100%",
			closeOnSelect: true,
			allowClear: true,
			maximumSelectionLength: 100
		});

		// Optional set defaultValue
		if (typeof(defaultValue) != 'undefined') setValueSelect2($('#{{ $sectionId }}_QUAN_HUYEN_THI_XA'), defaultValue);
	}
	// Events select2
	$('#{{ $sectionId }}_QUAN_HUYEN_THI_XA').on('select2:select', function (e) {
		let selectedValue = e.params.data.id; // Lấy giá trị của tùy chọn đã chọn
    	let selectedText = e.params.data.text; // Lấy văn bản của tùy chọn đã chọn
		
		let quanHuyenCode = selectedValue;
		// Load select2 phường xã theo quận huyện
		{{ $sectionId }}_loadSelectComboboxPhuongXa(quanHuyenCode);
	}).on('change', function (e) {
		// Nó sẽ chạy lần đầu init select2
		let selectedValue = $(this).val(); // Lấy giá trị đang chọn
        let selectedText = $(this).find('option:selected').text(); // Lấy văn bản của tùy chọn đang chọn

		if (typeof(selectedValue) == "undefined" || selectedValue == null || selectedValue.length == 0) { // Delete chose item select childrens khi thay đổi giá trị ở parent select2
			// Select2 phường xã
			enableDisableSelect2($('#{{ $sectionId }}_PHUONG_XA_THI_TRAN'), false);
			{{ $sectionId }}_initSelectComboboxPhuongXa([]);
		}
	}).on('select2:open', function() {
		// Ngăn bàn phím mở tự động khi dropdown được mở
		preventOpenKeyboardSelect2();
	});

	function {{ $sectionId }}_loadSelectBdsDatComboboxQuanHuyen(thanhPhoCode, defaultValue) {
		enableDisableSelect2($('#{{ $sectionId }}_QUAN_HUYEN_THI_XA'), false);
		// Create object data to get list column model parent
		var data = {
			'PROVINCE_CODE': thanhPhoCode
		};
		$.ajax({
			type : "GET",
			url : '{{ url("/api/district/list") }}',
			contentType : "application/json",
			showLoading: false,
			traditional: true,
			data : data,
			success: function(data, textStatus, request) {
				console.log(data);
				// Create array results for select2
				let results = [];
				// Looping json repsonse
				let arrResult = data.DATAS.District;
				for (var i = 0; i < arrResult.length; i++) {
					// Create object result
					let result = {
						"id": arrResult[i].CODE,
						"text": arrResult[i].TEN_QUAN_HUYEN
					}
					results.push(result);
				}
				// init select2 bds dat combobox quận huyện
				{{ $sectionId }}_initSelectComboboxQuanHuyen(results, false, defaultValue);
				// Enable select 2
				enableDisableSelect2($('#{{ $sectionId }}_QUAN_HUYEN_THI_XA'), true);

			},
			error: function(request, textStatus, errorThrown) {
				if (request.status !== 401 && request.status !== 403) {
					request.responseJSON = request.responseText ? JSON.parse(request.responseText) : null;
					showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
				}
			},
			complete : function() {

			}
		});
	}
	/* END select2 combobox quận huyện */


	/* START select2 combobox phường xã */
	function {{ $sectionId }}_emptySelectComboboxPhuongXa() {
		// Empty select2
		$('#{{ $sectionId }}_PHUONG_XA_THI_TRAN').empty();
		// Append thêm option rỗng để không chọn default value. Hiển thị placeholder
		$('#{{ $sectionId }}_PHUONG_XA_THI_TRAN').append('<option></option>');
	}

	// Function init select2 quận huyện
	function {{ $sectionId }}_initSelectComboboxPhuongXa(results, isDefaultGetAll, defaultValue) {
		// Empty select2
		{{ $sectionId }}_emptySelectComboboxPhuongXa();

		if (isDefaultGetAll === true) {
    		/* Tạo select2 tất cả default value cho combobox này (Nếu không dùng thì xóa đi) */
        	$('#{{ $sectionId }}_PHUONG_XA_THI_TRAN').append('<option value="all">Tất cả</option>');
        	$('#{{ $sectionId }}_PHUONG_XA_THI_TRAN').val('all').trigger('change');
    	}

		$('#{{ $sectionId }}_PHUONG_XA_THI_TRAN').select2({
			/* [Quan trọng] Nếu có sử dụng popup để hiện thị select2 thì thêm id của popup vào dropdownParent để không bị lỗi hiển thị css. Còn không dùng popup thì xóa dropdownParent này đi */
			dropdownParent: $("#{{ $sectionId }}_MODAL_DIA_CHI"),
			placeholder: $( this ).data( 'placeholder' ),
			/* [Quan trọng] object results set dữ liệu vào select2. Với định dạng: */
				/* [
				{
					"id": "id indentity",
					"text": "label select2"
				},
				{
					"id": "id indentity",
					"text": "label select2"
				}
			] */
			data: results,
			width: "100%",
			closeOnSelect: true,
			allowClear: true,
			maximumSelectionLength: 100
		});

		// Optional set defaultValue
		if (typeof(defaultValue) != 'undefined') setValueSelect2($('#{{ $sectionId }}_PHUONG_XA_THI_TRAN'), defaultValue);
	}
	// Events select2
	$('#{{ $sectionId }}_PHUONG_XA_THI_TRAN').on('select2:select', function (e) {
		let selectedValue = e.params.data.id; // Lấy giá trị của tùy chọn đã chọn
    	let selectedText = e.params.data.text; // Lấy văn bản của tùy chọn đã chọn
	}).on('change', function (e) {
		// Nó sẽ chạy lần đầu init select2
		let selectedValue = $(this).val(); // Lấy giá trị đang chọn
        let selectedText = $(this).find('option:selected').text(); // Lấy văn bản của tùy chọn đang chọn

		if (typeof(selectedValue) == "undefined" || selectedValue == null || selectedValue.length == 0) { // Delete chose item select childrens khi thay đổi giá trị ở parent select2
			
		}
	}).on('select2:open', function() {
		// Ngăn bàn phím mở tự động khi dropdown được mở
		preventOpenKeyboardSelect2();
	});

	function {{ $sectionId }}_loadSelectComboboxPhuongXa(quanHuyenCode, defaultValue) {
		enableDisableSelect2($('#{{ $sectionId }}_PHUONG_XA_THI_TRAN'), false);
		// Create object data to get list column model parent
		var data = {
			'DISTRICT_CODE': quanHuyenCode
		};
		$.ajax({
			type : "GET",
			url : '{{ url("/api/ward/list") }}',
			contentType : "application/json",
			showLoading: false,
			traditional: true,
			data : data,
			success: function(data, textStatus, request) {
				console.log(data);
				// Create array results for select2
				let results = [];
				// Looping json repsonse
				let arrResult = data.DATAS.Ward;
				for (var i = 0; i < arrResult.length; i++) {
					// Create object result
					let result = {
						"id": arrResult[i].CODE,
						"text": arrResult[i].TEN_PHUONG_XA_THI_TRAN
					}
					results.push(result);
				}
				// init select2 bds dat combobox thanh pho
				{{ $sectionId }}_initSelectComboboxPhuongXa(results, false, defaultValue);
				// Enable select 2
				enableDisableSelect2($('#{{ $sectionId }}_PHUONG_XA_THI_TRAN'), true);
			},
			error: function(request, textStatus, errorThrown) {
				if (request.status !== 401 && request.status !== 403) {
					request.responseJSON = request.responseText ? JSON.parse(request.responseText) : null;
					showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
				}
			},
			complete : function() {

			}
		});
	}
	/* END select2 combobox phường xã */

	/* Get data từ FORM UI */
	function {{ $sectionId }}_getDatasFormUIComboboxDiaChi() {
		let arrData = [];
		
		// Thành phố
		let data = {key : null, type_key : null, value : null};
		data.key = "{{ $sectionId }}_THANH_PHO";
		data.type_key = "ID";
		data.value = !isEmpty($('#{{ $sectionId }}_THANH_PHO').val()) ? $('#{{ $sectionId }}_THANH_PHO').val() : '';
		arrData.push(data); // Push data into array

		// Thành phố label
		data = {};
		data.key = "{{ $sectionId }}_THANH_PHO_LBL";
		data.type_key = "ID";
		data.value = !isEmpty($('#{{ $sectionId }}_THANH_PHO').select2('data')[0].text) ? $('#{{ $sectionId }}_THANH_PHO').select2('data')[0].text : '';
		arrData.push(data); // Push data into array

		// Quận huyện
		data = {};
		data.key = "{{ $sectionId }}_QUAN_HUYEN_THI_XA";
		data.type_key = "ID";
		data.value = !isEmpty($('#{{ $sectionId }}_QUAN_HUYEN_THI_XA').val()) ? $('#{{ $sectionId }}_QUAN_HUYEN_THI_XA').val() : '';
		arrData.push(data); // Push data into array

		// Quận huyện label
		data = {};
		data.key = "{{ $sectionId }}_QUAN_HUYEN_THI_XA_LBL";
		data.type_key = "ID";
		data.value = !isEmpty($('#{{ $sectionId }}_QUAN_HUYEN_THI_XA').select2('data')[0].text) ? $('#{{ $sectionId }}_QUAN_HUYEN_THI_XA').select2('data')[0].text : '';
		arrData.push(data); // Push data into array

		// Phường xã
		data = {};
		data.key = "{{ $sectionId }}_PHUONG_XA_THI_TRAN";
		data.type_key = "ID";
		data.value = !isEmpty($('#{{ $sectionId }}_PHUONG_XA_THI_TRAN').val()) ? $('#{{ $sectionId }}_PHUONG_XA_THI_TRAN').val() : '';
		arrData.push(data); // Push data into array

		// Phường xã label
		data = {};
		data.key = "{{ $sectionId }}_PHUONG_XA_THI_TRAN_LBL";
		data.type_key = "ID";
		data.value = !isEmpty($('#{{ $sectionId }}_PHUONG_XA_THI_TRAN').select2('data')[0].text) ? $('#{{ $sectionId }}_PHUONG_XA_THI_TRAN').select2('data')[0].text : '';
		arrData.push(data); // Push data into array

		// Tên đường
		data = {};
		data.key = "{{ $sectionId }}_TEN_DUONG";
		data.type_key = "ID";
		data.value = !isEmpty($('#{{ $sectionId }}_TEN_DUONG').val()) ? $('#{{ $sectionId }}_TEN_DUONG').val() : '';
		arrData.push(data); // Push data into array

		// Số nhà
		data = {};
		data.key = "{{ $sectionId }}_SO_NHA";
		data.type_key = "ID";
		data.value = !isEmpty($('#{{ $sectionId }}_SO_NHA').val()) ? $('#{{ $sectionId }}_SO_NHA').val() : '';
		arrData.push(data); // Push data into array

		return {
			arrData
		}
	}

	/* Get detail data */
	function {{ $sectionId }}_getDtlDataComboboxDiaChi(arrData) {
		let thanhPhoLbl, thanhPhoVal = null;
		let quanHuyenLbl, quanHuyenVal = null;
		let phuongXaLbl, phuongXaVal = null;
		let tenDuong, soNha = null;
		
		for (let data of arrData) {
			if (isEmpty(data) || isEmpty(data.key)) continue;

			switch (data.key) {
				case "{{ $sectionId }}_THANH_PHO":
					thanhPhoVal = data.value;
					break;
				case "{{ $sectionId }}_THANH_PHO_LBL":
					thanhPhoLbl = data.value;
					break;
				case "{{ $sectionId }}_QUAN_HUYEN_THI_XA":
					quanHuyenVal = data.value;
					break;
				case "{{ $sectionId }}_QUAN_HUYEN_THI_XA_LBL":
					quanHuyenLbl = data.value;
					break;
				case "{{ $sectionId }}_PHUONG_XA_THI_TRAN":
					phuongXaVal = data.value;
					break;
				case "{{ $sectionId }}_PHUONG_XA_THI_TRAN_LBL":
					phuongXaLbl = data.value;
					break;
				case "{{ $sectionId }}_TEN_DUONG":
					tenDuong = data.value;
					break;
				case "{{ $sectionId }}_SO_NHA":
					soNha = data.value;
					break;
				default:
					break;
			}
		}
		return {
			thanhPhoLbl, thanhPhoVal
			, quanHuyenLbl, quanHuyenVal
			, phuongXaLbl, phuongXaVal
			, tenDuong, soNha
		}
	}

	/* Reset tất cả msg */
	function {{ $sectionId }}_resetMsgComboboxDiaChi() {
		$('#{{ $sectionId }}_MODAL_DIA_CHI').find($('[id^="MSG_"]')).each(function(i, obj) {
			$(this).text('');
		});
	}

	/* Validate form */
	function {{ $sectionId }}_validateComboboxDiaChi(thanhPhoCd, quanHuyenCd, phuongXaCd, tenDuong, soNha) {
		let isValid = true;
		{{ $sectionId }}_resetMsgComboboxDiaChi(); // Reset all msg bên trong modal này

		if (isEmpty(thanhPhoCd)) {
			isValid = false;
			$('#MSG_{{ $sectionId }}_THANH_PHO').text('Thành phố không được để trống.');
		}
		if (isEmpty(quanHuyenCd)) {
			isValid = false;
			$('#MSG_{{ $sectionId }}_QUAN_HUYEN_THI_XA').text('Quận huyện thị xã không được để trống.');
		}
		if (isEmpty(phuongXaCd)) {
			isValid = false;
			$('#MSG_{{ $sectionId }}_PHUONG_XA_THI_TRAN').text('Phường xã thị trấn không được để trống.');
		}
		if (isEmpty(tenDuong)) {
			isValid = false;
			$('#MSG_{{ $sectionId }}_TEN_DUONG').text('Tên đường không được để trống.');
		}

		return isValid;
	}

	$('#{{ $sectionId }}_BTN_DONE').on('click', function() {
		// Get datas từ FORM UI
		let {
			arrData
		} = {{ $sectionId }}_getDatasFormUIComboboxDiaChi();

		// Get detail datas từ FORM UI
		let {
			thanhPhoLbl, thanhPhoVal
			, quanHuyenLbl, quanHuyenVal
			, phuongXaLbl, phuongXaVal
			, tenDuong, soNha
		} = {{ $sectionId }}_getDtlDataComboboxDiaChi(arrData);
		
		// Validate
		if ({{ $sectionId }}_validateComboboxDiaChi(thanhPhoVal, quanHuyenVal, phuongXaVal, tenDuong, soNha) == false) {
			// Scroll message lỗi
			scrollMsgInSection($('#{{ $sectionId }}_MODAL_DIA_CHI .modal-body'), true);
			return false;
		}
		let dataLalel = '';
		if (!isEmpty(soNha)) dataLalel += soNha + ', ';
		dataLalel += tenDuong.trim() + ', ' + phuongXaLbl + ', ' + quanHuyenLbl + ', ' + thanhPhoLbl;

		// Đóng modal popup
		{{ $sectionId }}_mustClosePopup = true;
		$('#{{ $sectionId }}_MODAL_DIA_CHI').modal('toggle');
		{{ $sectionId }}_callBack_comboboxSelect2DiaChi(dataLalel, thanhPhoVal, quanHuyenVal, phuongXaVal, tenDuong, soNha);
	});

});
</script>