<style>
	
</style>

<!-- Modal starts -->
<div class="modal fade" id="MODAL_UPLOAD_MULTIPLE_HINH_ANH" tabindex="-1"
	role="dialog" aria-labelledby="MODAL_UPLOAD_MULTIPLE_HINH_ANH_LABEL" aria-hidden="true"
	data-bs-keyboard="true" 
	data-bs-backdrop="static">
	<div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document" style="max-width: 600px;">
		<div class="modal-content">
			<div class="modal-header">
				<div class="section-go-back">
				</div>

				<h5 class="modal-title" id="MODAL_UPLOAD_MULTIPLE_HINH_ANH_LABEL">Danh sách hình ảnh</h5>
				
				<!-- Thêm attr này vào btn để có thể đóng popup tự động data-bs-dismiss="modal" -->
				<button type="button"
					id="MODAL_UPLOAD_MULTIPLE_HINH_ANH_CLOSE"
					class="close btn rounded-circle" 
					aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
                	<div class="col-xl-12 col-item">
                    	 <div class="form-group">
							<label for="THANH_PHO">Chọn thành phố<code>*</code></label>

							<select class="form-control input-select2" id="THANH_PHO" data-placeholder="Vui lòng chọn"></select>

							<span class="error-message" id="MSG_THANH_PHO"></span>
						</div>
                    </div>
                    
				</div>
			</div>
			<div class="modal-footer">
				<button id="BTN_DONE" type="button" class="btn btn-info width-100-percent">XONG</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal Ends -->

<script>
$(document).ready(function() {
	
	/* Xử lý logic khi open popup */
	handleOpenPopupUploadMultipleHinhAnh = function() {
		console.log('handleOpenPopupUploadMultipleHinhAnh');
	}

	/* Button close đóng popup */
	$('#MODAL_UPLOAD_MULTIPLE_HINH_ANH_CLOSE').on('click', function(e) {
		// Đóng modal popup
		$('#MODAL_UPLOAD_MULTIPLE_HINH_ANH').modal('toggle');
	});

	/* Xử lý sự kiện khi nhấn phím trên modal */
	$('#MODAL_UPLOAD_MULTIPLE_HINH_ANH').keyup(function(event) {
		if (event.keyCode === 13) { // Nhấn phím ENTER
			$('#BTN_DONE').trigger('click');
		}
	});

	/* Xử lý sự kiện khi modal ĐANG MỞ */
	$('#MODAL_UPLOAD_MULTIPLE_HINH_ANH').on('show.bs.modal', function (e) {
		// Xử lý sự kiện khi modal bắt đầu mở. Đang chuyển cảnh...
		console.log('Modal đang mở!');
		$('#MODAL_UPLOAD_MULTIPLE_HINH_ANH .modal-footer').removeClass('disable-events').addClass('disable-events');
	});

	/* Xử lý sự kiện khi modal ĐÃ MỞ */
	$('#MODAL_UPLOAD_MULTIPLE_HINH_ANH').on('shown.bs.modal', function (e) {
		// Xử lý sự kiện khi modal đã mở. Hoàn tất chuyển cảnh
		console.log('Modal đã mở!');
		$('#MODAL_UPLOAD_MULTIPLE_HINH_ANH .modal-footer').removeClass('disable-events');
	});
	
	var mustClosePopup = false;
	/* Xử lý sự kiện khi modal ĐANG ĐÓNG */
	$('#MODAL_UPLOAD_MULTIPLE_HINH_ANH').on('hide.bs.modal', function (e) {
		// Xử lý sự kiện khi modal đang đóng. Đang chuyển cảnh...
		console.log('Modal đang đóng!');

		if (mustClosePopup === true) {
			mustClosePopup = false;
			return;
		}
		// Kiểm tra xem dữ liệu có đang bị thay đổi so với ban đầu không ?
		let isDataChanged = true;
		if (isDataChanged === true ) {
			e.preventDefault(); // Ngăn modal không bị đóng. Ngăn hành động mặc định (trong trường hợp này là đóng modal) xảy ra.

			showSwalWarningPopup(function callback(result) {
				if (result.isConfirmed === true) {
					// Đóng modal popup
					mustClosePopup = true;
					$('#MODAL_UPLOAD_MULTIPLE_HINH_ANH').modal('toggle');
				} else if (result.isDismissed === true) {

				} else if (result.isDenied === true) {

				}
			}, "Có dữ liệu thay đổi.<span style=\"display: inline-block;\"> Bạn có muốn đóng popup không?</span>");
		}
	});

	/* Xử lý sự kiện sau khi MODAL ĐÃ ĐÓNG */
	$('#MODAL_UPLOAD_MULTIPLE_HINH_ANH').on('hidden.bs.modal', function (e) {
		// Xử lý sự kiện sau khi modal đã đóng. Hoàn tất chuyển cảnh.
		console.log('Modal đã được đóng!');
	});

	/* Xử lý ngăn người dùng đóng modal bằng click vào backdrop */
	$('#MODAL_UPLOAD_MULTIPLE_HINH_ANH').on('hidePrevented.bs.modal', function (e) {
		// Ngăn modal focus lại khi click vào backdrop
		e.preventDefault();
	});
});
</script>