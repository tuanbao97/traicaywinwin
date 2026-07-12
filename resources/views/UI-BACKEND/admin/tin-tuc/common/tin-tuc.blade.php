<?php
// Random uuid1
$uuid1 = 'section_' . Str::random(6);
?>
<style>
  .bien-the-tin-tuc {
    border: 1px solid #ddd;
    padding: 15px;
    margin-bottom: 10px;
    position: relative;
  }
  .action-button {
    position: absolute;
    top: 10px;
    right: 10px;
  }
</style>

<div id="{{ $uuid1 }}_SECTION_CHI_TIET_TIN_TUC">
  <div class="row block-chi-tiet-tin-tuc">
    <p class="card-description">Thông tin tin tức</p>

    <div class="section-block col-lg-12 col-md-12">
      <div class="form-group">
        <label for="{{ $uuid1 }}_EDIT_TIEU_DE_TIN_TUC">
          Tiêu đề tin tức<code>*</code>
        </label>
        <input type="text" class="form-control" id="{{ $uuid1 }}_EDIT_TIEU_DE_TIN_TUC" placeholder="">
        <span class="error-message"></span>
      </div>
    </div>

    <div class="section-block col-lg-12 col-md-12">
      <div class="form-group">
        <label for="{{ $uuid1 }}_EDIT_TOM_TAT_TIN_TUC">
          Tóm tắt tin tức<code>*</code>
        </label>
        <textarea rows="2" class="form-control" id="{{ $uuid1 }}_EDIT_TOM_TAT_TIN_TUC" placeholder=""></textarea>
        <span class="error-message"></span>
      </div>
    </div>

    <div class="section-block col-lg-12 col-md-12">
      <div class="form-group">
        <label for="{{ $uuid1 }}_EDIT_NOI_DUNG_TIN_TUC">Nội dung tin tức<code>*</code></label>
        <textarea rows="5" class="form-control" id="{{ $uuid1 }}_EDIT_NOI_DUNG_TIN_TUC" placeholder=""></textarea>
        <span class="error-message"></span>
      </div>
    </div>

    <div class="section-block form-group col-md-12 col-sm-12">
			<label for="{{ $uuid1 }}_EDIT_FILE_DINH_KEM">File đính kèm</label>
			<div class="form-group">
				<button id="{{ $uuid1 }}_BTN_DANH_SACH_HINH_FILE_DINH_KEM" type="button" class="btn btn-outline-info btn-fw btn-icon-text me-2">
					<i class="icon-paper-clip btn-icon-prepend"></i>File đính kèm (<span id="{{ $uuid1 }}_SO_LUONG_FILE_DINH_KEM">0</span>)
				</button>
				<span class="error-message"></span>
			</div>
		</div>

    <div class="section-block form-group col-md-12 col-sm-12">
      <label for="{{ $uuid1 }}_EDIT_TIN_TUC_NOI_BAT">Tin tức nổi bật<code>*</code></label>
      <div>
        <label class="switch">
          <input type="checkbox" class="primary" id="{{ $uuid1 }}_EDIT_TIN_TUC_NOI_BAT">
          <span class="slider"></span>
        </label>
        <span class="error-message"></span>
      </div>
    </div>

    <div class="section-block form-group col-md-12 col-sm-12">
      <label for="{{ $uuid1 }}_EDIT_TRANG_THAI_HOAT_DONG">Trạng thái hoạt động<code>*</code></label>
      <div>
        <label class="switch">
          <input type="checkbox" class="primary" id="{{ $uuid1 }}_EDIT_TRANG_THAI_HOAT_DONG" checked>
          <span class="slider"></span>
        </label>
        <span class="error-message"></span>
      </div>
    </div>

  </div>

  <div class="col-12 d-flex justify-content-end margin-top-15px">
	<div class="action-web">
		<button type="button"
			class="btn btn-action btn-light btn-icon-text me-1"
			name="{{ $uuid1 }}_BTN_GO_BACK">
			<i class="fa fa-caret-left btn-icon-prepend"></i>Quay về
		</button>
		<button type="button"
			class="btn btn-danger btn-fw btn-icon-text me-1"
			name="{{ $uuid1 }}_BTN_DELETE">
			<i class="fa fa-trash-o btn-icon-prepend"></i>Xóa
		</button>
		<button type="button"
			class="btn btn-action btn-info btn-icon-text"
			name="{{ $uuid1 }}_BTN_SAVE">
			<i class="fa fa-save btn-icon-prepend"></i>Lưu
		</button>
	</div>
	<div class="action-mobile">
		<div class="dropdown inline-block">
			<button type="button" class="btn btn-light dropdown-toggle"
				id="dropdownMenuIconButton4" data-bs-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false">Chức năng</button>
			<div class="dropdown-menu"
				aria-labelledby="dropdownMenuIconButton4">
				<button type="button" class="dropdown-item" name="{{ $uuid1 }}_BTN_DELETE">
					<i class="icon-trash icon-action-mobile"></i>Xóa
				</button>
				<div class="dropdown-divider"></div>
				<button type="button" class="dropdown-item" name="{{ $uuid1 }}_BTN_GO_BACK">
					<i class="icon-action-undo icon-action-mobile"></i>Quay về
				</button>
			</div>
		</div>
		<button type="button"
			class="btn btn-action btn-info btn-icon-text"
			name="{{ $uuid1 }}_BTN_SAVE">
			<i class="fa fa-save btn-icon-prepend"></i>Lưu
		</button>
	</div>
</div>

<!-- Include popups -->
@include('UI-BACKEND.admin.common.component.popup.upload-file.popup-upload-multiple-file-dinh-kem', [
  'sectionId' => $uuid1
])
<!-- Include setup tinyMCE -->
@include('UI-BACKEND.admin.common.component.editor.editor-noi-dung', [
  'sectionId' => $uuid1,
  'elementTinyMceId' => $uuid1 . '_' . 'EDIT_NOI_DUNG_TIN_TUC'
])

<script>
$(document).ready(function () {
    {{ $uuid1 }}_initTinyMce('');

    /* START FILE ĐÍNH KÈM */
    getDanhSachUploadMultipleFileDinhKem = function() {
        return {{ $uuid1 }}_getDanhSachUploadMultipleFileDinhKem();
    }

    $('#{{$uuid1}}_BTN_DANH_SACH_HINH_FILE_DINH_KEM').on('click', function() {
        {{$uuid1}}_handleOpenPopupUploadMultipleFileDinhKem();
        $('#{{$uuid1}}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM').modal('show');
    });

    // Call back
    {{$uuid1 }}_callBackUploadMultipleFileDinhKem = function(data) {
      $("#{{$uuid1 }}_SO_LUONG_FILE_DINH_KEM").text(data.length);
    }
    /* END FILE ĐÍNH KÈM */

    $(`[name='{{ $uuid1 }}_BTN_GO_BACK']`).on('click', function(e) {
        window.location = '{{ url('/admin/tin-tuc/danh-sach') }}';
    });

    $(`[name='{{ $uuid1 }}_BTN_SAVE']`).on('click', function(e) {
      {{ $uuid1 }}_saveTinTuc();
    });

    /* Set thông tin tin tức */
    {{ $uuid1 }}_setInfoTinTuc = function() {
        @if (isset($duLieu) && isset($duLieu["ID"]) && !blank($duLieu["ID"])) { // Case chi tiết - chỉnh sửa
          $('#{{ $uuid1 }}_SECTION_CHI_TIET_TIN_TUC').show();
        
          // Tiêu đề tin tức
          let tieuDeTinTuc = @json($duLieu['TIEU_DE_TIN_TUC'] ?? null);
          $('#{{ $uuid1 }}_EDIT_TIEU_DE_TIN_TUC').val(tieuDeTinTuc);

          // Tóm tắt tin tức
          let tomTatTinTuc = @json($duLieu['TOM_TAT_TIN_TUC'] ?? null);
          $('#{{ $uuid1 }}_EDIT_TOM_TAT_TIN_TUC').val(tomTatTinTuc);

          // Set danh sách file đính kèm
          let danhSachFileDinhKem = @json($duLieu['DANH_SACH_FILE_DINH_KEM'] ?? null);
          // Remove all append input upload multiple file đính kèm
          {{ $uuid1 }}_removeAllAppendInputUploadMultipleFileDinhKem();
          if (!isEmpty(danhSachFileDinhKem)) {
            // Xử lý append input danh sách file đính kèm
            {{ $uuid1 }}_appendInputUploadMultipleFileDinhKem(danhSachFileDinhKem);
            $("#{{ $uuid1 }}_SO_LUONG_FILE_DINH_KEM").text(danhSachFileDinhKem.length);
          }

          // Trạng thái hoạt động
          let trangThaiHoatDong = @json($duLieu['TRANG_THAI_HOAT_DONG' ?? null]);
          trangThaiHoatDong = trangThaiHoatDong !== null ? trangThaiHoatDong : false;
          $('#{{ $uuid1 }}_EDIT_TRANG_THAI_HOAT_DONG').prop('checked', trangThaiHoatDong);

          // Tin tức nổi bật
          let tinTucNoiBat = @json($duLieu['TIN_TUC_NOI_BAT' ?? null]);
          tinTucNoiBat = tinTucNoiBat !== null ? tinTucNoiBat : false;
          $('#{{ $uuid1 }}_EDIT_TIN_TUC_NOI_BAT').prop('checked', tinTucNoiBat);


      }
      @else // Case thêm mới
          $('#{{ $uuid1 }}_SECTION_CHI_TIET_TIN_TUC').show();
      @endif
    }
    {{ $uuid1 }}_setInfoTinTuc();

    function {{ $uuid1 }}_saveTinTuc() {
      // Reset all msg
      resetAllMsgTinTuc();
      
      // Danh mục tin tức
      let objDanhMucTinTuc = {
        ID: !isEmpty($('#EDIT_DANH_MUC_TIN_TUC_ID').val()) ? $('#EDIT_DANH_MUC_TIN_TUC_ID').val() : null
      };

      // Create object data
      var data = {
          ID :  !isEmpty($('#EDIT_ID').val()) ? $('#EDIT_ID').val() : null
        , DANH_MUC_TIN_TUC: objDanhMucTinTuc
        , TIEU_DE_TIN_TUC: $("#{{ $uuid1 }}_EDIT_TIEU_DE_TIN_TUC").val()
        , TOM_TAT_TIN_TUC: $("#{{ $uuid1 }}_EDIT_TOM_TAT_TIN_TUC").val()
        , NOI_DUNG_TIN_TUC: getEditorContent("{{ $uuid1 }}_EDIT_NOI_DUNG_TIN_TUC")
        , NOI_DUNG_TIN_TUC_ONLY_TEXT: getEditorContentOnlyText("{{ $uuid1 }}_EDIT_NOI_DUNG_TIN_TUC")
        , TIN_TUC_NOI_BAT: $('#{{ $uuid1 }}_EDIT_TIN_TUC_NOI_BAT').is(':checked') ? true : false
        , TRANG_THAI_HOAT_DONG: $('#{{ $uuid1 }}_EDIT_TRANG_THAI_HOAT_DONG').is(':checked') ? true : false
      };

       // Danh sách hình ảnh đại diện
       let danhSachHinhAnhDaiDien = [];
      for (let [index, [key, value]] of Object.entries(getDanhSachUploadHinhAnhDaiDien()).entries()) {
        if (key === 'DANH_SACH_HINH_ANH_DAI_DIEN') {
          for (let key in value) {
            danhSachHinhAnhDaiDien.push(value[key]);
          }
        }
      }
      data['DANH_SACH_HINH_ANH_DAI_DIEN'] = danhSachHinhAnhDaiDien;

      // Danh sách hình ảnh
      let danhSachHinhAnh = [];
      for (let [index, [key, value]] of Object.entries(getDanhSachUploadMultipleHinhAnh()).entries()) {
        if (key === 'DANH_SACH_HINH_ANH') {
          for (let key in value) {
            danhSachHinhAnh.push(value[key]);
          }
        }
      }
      data['DANH_SACH_HINH_ANH'] = danhSachHinhAnh;

      // Danh sách video
      let danhSachVideo = [];
      for (let [index, [key, value]] of Object.entries(getDanhSachUploadMultipleVideo()).entries()) {
        if (key === 'DANH_SACH_VIDEO') {
          for (let key in value) {
            danhSachVideo.push(value[key]);
          }
        }
      }
      data['DANH_SACH_VIDEO'] = danhSachVideo;

      // Danh sách file đính kèm
      let danhSachFileDinhKem = [];
      for (let [index, [key, value]] of Object.entries(getDanhSachUploadMultipleFileDinhKem()).entries()) {
        if (key === 'DANH_SACH_FILE_DINH_KEM') {
          for (let key in value) {
            danhSachFileDinhKem.push(value[key]);
          }
        }
      }
      data['DANH_SACH_FILE_DINH_KEM'] = danhSachFileDinhKem;

      $.ajax({
          type: "POST", 
          url: '{{ url("/api/news/save") }}', 
          contentType: "application/json",
          showLoading: true,
          data: JSON.stringify(data), 
          success: function(data, textStatus, request) {
              showToastSuccess('top-right', data.STATUS_DETAIL);
              $('#EDIT_ID').val(data.DATAS.NEWS.ID);
              {{ $uuid1 }}_updUrlNewsId(data.DATAS.NEWS.ID, data.DATAS.NEWS.TIEU_DE_TIN_TUC_SLUG);
          },
          error: function(request, textStatus, errorThrown) {
          if (request.status === 401 || request.status === 403) {
            return;
          }
          try {
            request.responseJSON = request.responseText ? JSON.parse(request.responseText) : null;
            showToastFailure('top-right', request.responseJSON && !isEmpty(request.responseJSON.STATUS_DETAIL) ? request.responseJSON.STATUS_DETAIL : 'Internal server');
            var errors = request.responseJSON != null ? request.responseJSON.ERRORS : null;
            
            for (let key in errors) {
                if (errors.hasOwnProperty(key)) {
                    let keyVals = errors[key];
                    let errorMsg = keyVals.join(' ');
                    switch (key) {
                       case 'DANH_SACH_HINH_ANH_DAI_DIEN':
                          $('#MSG_ANH_DAI_DIEN').text(errorMsg);
                          break;
                        case 'DANH_MUC_TIN_TUC':
                          $('#MSG_EDIT_DANH_MUC_TIN_TUC').text(errorMsg);
                          break;
                        case 'TIEU_DE_TIN_TUC':
                          $('#{{ $uuid1 }}' + '_EDIT_TIEU_DE_TIN_TUC').closest('.form-group').find('.error-message').text(errorMsg);
                          break;
                        case 'TOM_TAT_TIN_TUC':
                          $('#{{ $uuid1 }}' + '_EDIT_TOM_TAT_TIN_TUC').closest('.form-group').find('.error-message').text(errorMsg);
                          break;
                        case 'NOI_DUNG_TIN_TUC':
                          $('#{{ $uuid1 }}' + '_EDIT_NOI_DUNG_TIN_TUC').closest('.form-group').find('.error-message').text(errorMsg);
                          break;
                        case 'TIN_TUC_NOI_BAT':
                            $('#{{ $uuid1 }}' + '_EDIT_TIN_TUC_NOI_BAT').closest('.form-group').find('.error-message').text(errorMsg);
                            break
                        case 'TRANG_THAI_HOAT_DONG':
                            $('#{{ $uuid1 }}' + '_EDIT_TRANG_THAI_HOAT_DONG').closest('.form-group').find('.error-message').text(errorMsg);
                            break
                        default:
                          break;
                    }
                }
            }
        } catch(err) {
            showToastFailure('top-right', 'Internal server');
        }
        finally {
          scrollSpanMsgInSection($('#CHI_TIET_TIN_TUC'));
        }
          
        },
        complete: function() {
        }
    });
	}

  {{ $uuid1 }}_updUrlNewsId = function(newsId, newsTitleSlug) {
        let url = '{{ url("/admin/tin-tuc/chi-tiet") }}';
        if (isEmpty(newsId)) return updUrlWithoutReloadPage(url);
        if (!isEmpty(newsTitleSlug)) {
          url += '/' + newsTitleSlug + "-" + newsId;
        } else {
          url += '/' + newsId;
        }
        return updUrlWithoutReloadPage(url);
  }

  {{$uuid1}}_{{$uuid1}}_EDIT_NOI_DUNG_TIN_TUC_callBackTinyMCEAfterInit = function(editor) {
    let noiDungChiTiet = @json($duLieu['NOI_DUNG_TIN_TUC'] ?? '');
    editor.setContent(noiDungChiTiet);
  }

  /* Xử lý switch active hoạt động */
  $('#{{ $uuid1 }}_EDIT_TRANG_THAI_HOAT_DONG').on('click', function(e) {
      e.preventDefault(); // Ngăn không cho active hoặc unactive hoạt động đến khi confirm

      let isActived = $('#{{ $uuid1 }}_EDIT_TRANG_THAI_HOAT_DONG').is(':checked');
      showSwalWarningPopup(function callback(result) {
        if (result.isConfirmed === true) {
          $('#{{ $uuid1 }}_EDIT_TRANG_THAI_HOAT_DONG').prop('checked', isActived);
            } else if (result.isDismissed === true) {
              /* Xử lý trả lại dữ liệu switch hoạt động trước đó */
              $('#{{ $uuid1 }}_EDIT_TRANG_THAI_HOAT_DONG').prop('checked', !isActived);
              } else if (result.isDenied === true) {

        }
      }, 'Bạn có muốn thay đổi <span style="display: inline-block;">trạng thái hoạt động?</span>');
	});
 
});
</script> 