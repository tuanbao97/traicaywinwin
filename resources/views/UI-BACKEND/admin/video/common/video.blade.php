<?php
// Random uuid1
$uuid1 = 'section_' . Str::random(6);
?>
<style>
  .bien-the-video {
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

<div id="{{ $uuid1 }}_SECTION_CHI_TIET_VIDEO">
  <div class="row block-chi-tiet-video">
    <p class="card-description">Thông tin video</p>

    <div class="section-block col-lg-12 col-md-12">
      <div class="form-group">
        <label for="{{ $uuid1 }}_EDIT_TIEU_DE_VIDEO">
          Tiêu đề video<code>*</code>
        </label>
        <input type="text" class="form-control" id="{{ $uuid1 }}_EDIT_TIEU_DE_VIDEO" placeholder="">
        <span class="error-message"></span>
      </div>
    </div>

    <div class="section-block col-lg-12 col-md-12">
      <div class="form-group">
        <label for="{{ $uuid1 }}_EDIT_TOM_TAT_VIDEO">
          Tóm tắt video<code>*</code>
        </label>
        <textarea rows="2" class="form-control" id="{{ $uuid1 }}_EDIT_TOM_TAT_VIDEO" placeholder=""></textarea>
        <span class="error-message"></span>
      </div>
    </div>

    <div class="section-block col-lg-12 col-md-12">
      <div class="form-group">
        <label for="{{ $uuid1 }}_EDIT_NOI_DUNG_VIDEO">Nội dung video<code>*</code></label>
        <textarea rows="5" class="form-control" id="{{ $uuid1 }}_EDIT_NOI_DUNG_VIDEO" placeholder=""></textarea>
        <span class="error-message"></span>
      </div>
    </div>

    <div class="section-block col-lg-12 col-md-12">
      <div class="form-group">
        <label for="{{ $uuid1 }}_EDIT_META_SEO_KEYWORDS">Meta SEO Keywords</label>
        <input type="text" class="form-control" id="{{ $uuid1 }}_EDIT_META_SEO_KEYWORDS" placeholder="Từ khóa SEO">
        <span class="error-message"></span>
      </div>
    </div>

    <div class="section-block col-lg-12 col-md-12">
      <div class="form-group">
        <label for="{{ $uuid1 }}_EDIT_META_SEO_DESCRIPTION">Meta SEO Description</label>
        <textarea rows="2" class="form-control" id="{{ $uuid1 }}_EDIT_META_SEO_DESCRIPTION" placeholder="Mô tả SEO"></textarea>
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
      <label for="{{ $uuid1 }}_EDIT_VIDEO_NOI_BAT">Video nổi bật<code>*</code></label>
      <div>
        <label class="switch">
          <input type="checkbox" class="primary" id="{{ $uuid1 }}_EDIT_VIDEO_NOI_BAT">
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
  'elementTinyMceId' => $uuid1 . '_' . 'EDIT_NOI_DUNG_VIDEO'
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
        window.location = '{{ url('/admin/video/danh-sach') }}';
    });

    $(`[name='{{ $uuid1 }}_BTN_SAVE']`).on('click', function(e) {
      {{ $uuid1 }}_saveVideo();
    });

    $(`[name='{{ $uuid1 }}_BTN_DELETE']`).on('click', function(e) {
      {{ $uuid1 }}_deleteVideo();
    });

    /* Set thông tin video */
    {{ $uuid1 }}_setInfoVideo = function() {
        @if (isset($duLieu) && isset($duLieu["ID"]) && !blank($duLieu["ID"])) { // Case chi tiết - chỉnh sửa
          $('#{{ $uuid1 }}_SECTION_CHI_TIET_VIDEO').show();
        
          // Tiêu đề video
          let tieuDeVideo = @json($duLieu['TIEU_DE_VIDEO'] ?? null);
          $('#{{ $uuid1 }}_EDIT_TIEU_DE_VIDEO').val(tieuDeVideo);

          // Tóm tắt video
          let tomTatVideo = @json($duLieu['TOM_TAT_VIDEO'] ?? null);
          $('#{{ $uuid1 }}_EDIT_TOM_TAT_VIDEO').val(tomTatVideo);

          // Meta SEO Keywords
          let metaSeoKeywords = @json($duLieu['META_SEO_KEYWORDS'] ?? null);
          $('#{{ $uuid1 }}_EDIT_META_SEO_KEYWORDS').val(metaSeoKeywords);

          // Meta SEO Description
          let metaSeoDescription = @json($duLieu['META_SEO_DESCRIPTION'] ?? null);
          $('#{{ $uuid1 }}_EDIT_META_SEO_DESCRIPTION').val(metaSeoDescription);

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

          // Video nổi bật
          let videoNoiBat = @json($duLieu['VIDEO_NOI_BAT' ?? null]);
          videoNoiBat = videoNoiBat !== null ? videoNoiBat : false;
          $('#{{ $uuid1 }}_EDIT_VIDEO_NOI_BAT').prop('checked', videoNoiBat);


      }
      @else // Case thêm mới
          $('#{{ $uuid1 }}_SECTION_CHI_TIET_VIDEO').show();
      @endif
    }
    {{ $uuid1 }}_setInfoVideo();

    function {{ $uuid1 }}_saveVideo() {
      // Reset all msg
      resetAllMsgVideo();
      
      // Create object data
      var data = {
          ID :  !isEmpty($('#EDIT_ID').val()) ? $('#EDIT_ID').val() : null
        , TIEU_DE_VIDEO: $("#{{ $uuid1 }}_EDIT_TIEU_DE_VIDEO").val()
        , TOM_TAT_VIDEO: $("#{{ $uuid1 }}_EDIT_TOM_TAT_VIDEO").val()
        , NOI_DUNG_VIDEO: getEditorContent("{{ $uuid1 }}_EDIT_NOI_DUNG_VIDEO")
        , NOI_DUNG_VIDEO_ONLY_TEXT: getEditorContentOnlyText("{{ $uuid1 }}_EDIT_NOI_DUNG_VIDEO")
        , META_SEO_KEYWORDS: $("#{{ $uuid1 }}_EDIT_META_SEO_KEYWORDS").val()
        , META_SEO_DESCRIPTION: $("#{{ $uuid1 }}_EDIT_META_SEO_DESCRIPTION").val()
        , VIDEO_NOI_BAT: $('#{{ $uuid1 }}_EDIT_VIDEO_NOI_BAT').is(':checked') ? true : false
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

       // Không xử lý danh sách hình ảnh và video theo yêu cầu

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
          url: '{{ url("/api/video/save") }}', 
          contentType: "application/json",
          showLoading: true,
          data: JSON.stringify(data), 
          success: function(data, textStatus, request) {
              showToastSuccess('top-right', data.STATUS_DETAIL);
              $('#EDIT_ID').val(data.DATAS.VIDEO.ID);
              {{ $uuid1 }}_updUrlVideoId(data.DATAS.VIDEO.ID, data.DATAS.VIDEO.TIEU_DE_VIDEO_SLUG);
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
                        case 'TIEU_DE_VIDEO':
                          $('#{{ $uuid1 }}' + '_EDIT_TIEU_DE_VIDEO').closest('.form-group').find('.error-message').text(errorMsg);
                          break;
                        case 'TOM_TAT_VIDEO':
                          $('#{{ $uuid1 }}' + '_EDIT_TOM_TAT_VIDEO').closest('.form-group').find('.error-message').text(errorMsg);
                          break;
                        case 'NOI_DUNG_VIDEO':
                          $('#{{ $uuid1 }}' + '_EDIT_NOI_DUNG_VIDEO').closest('.form-group').find('.error-message').text(errorMsg);
                          break;
                        case 'NOI_DUNG_VIDEO_ONLY_TEXT':
                          $('#{{ $uuid1 }}' + '_EDIT_NOI_DUNG_VIDEO').closest('.form-group').find('.error-message').text(errorMsg);
                          break;
                        case 'VIDEO_NOI_BAT':
                            $('#{{ $uuid1 }}' + '_EDIT_VIDEO_NOI_BAT').closest('.form-group').find('.error-message').text(errorMsg);
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
          scrollSpanMsgInSection($('#CHI_TIET_VIDEO'));
        }
          
        },
        complete: function() {
        }
    });
	}

    function resetAllMsgVideo() {
      // Reset all error messages for video form
      $('#{{ $uuid1 }}_EDIT_TIEU_DE_VIDEO').closest('.form-group').find('.error-message').text('');
      $('#{{ $uuid1 }}_EDIT_TOM_TAT_VIDEO').closest('.form-group').find('.error-message').text('');
      $('#{{ $uuid1 }}_EDIT_NOI_DUNG_VIDEO').closest('.form-group').find('.error-message').text('');
      $('#{{ $uuid1 }}_EDIT_VIDEO_NOI_BAT').closest('.form-group').find('.error-message').text('');
      $('#{{ $uuid1 }}_EDIT_TRANG_THAI_HOAT_DONG').closest('.form-group').find('.error-message').text('');
      $('#MSG_ANH_DAI_DIEN').text('');
    }

    function {{ $uuid1 }}_deleteVideo() {
      let videoId = $('#EDIT_ID').val();
      if (isEmpty(videoId)) {
        showToastFailure('top-right', 'Không tìm thấy ID video');
        return;
      }

      showSwalWarningPopup(function callback(result) {
        if (result.isConfirmed === true) {
          $.ajax({
            type: "DELETE",
            url: '{{ url("/api/video/delete") }}' + '/' + videoId,
            contentType: "application/json",
            showLoading: true,
            success: function(data, textStatus, request) {
              showToastSuccess('top-right', data.STATUS_DETAIL);
              setTimeout(() => {
                window.location = '{{ url('/admin/video/danh-sach') }}';
              }, 1500);
            },
            error: function(request, textStatus, errorThrown) {
              if (request.status === 401 || request.status === 403) {
                return;
              }
              try {
                request.responseJSON = request.responseText ? JSON.parse(request.responseText) : null;
                showToastFailure('top-right', request.responseJSON && !isEmpty(request.responseJSON.STATUS_DETAIL) ? request.responseJSON.STATUS_DETAIL : 'Internal server');
              } catch(err) {
                showToastFailure('top-right', 'Internal server');
              }
            }
          });
        }
      }, 'Bạn có chắc chắn muốn xóa video này?');
    }

  {{ $uuid1 }}_updUrlVideoId = function(videoId, videoTitleSlug) {
        let url = '{{ url("/admin/video/chi-tiet") }}';
        if (isEmpty(videoId)) return updUrlWithoutReloadPage(url);
        if (!isEmpty(videoTitleSlug)) {
          url += '/' + videoTitleSlug + "-" + videoId;
        } else {
          url += '/' + videoId;
        }
        return updUrlWithoutReloadPage(url);
  }

  {{$uuid1}}_{{$uuid1}}_EDIT_NOI_DUNG_VIDEO_callBackTinyMCEAfterInit = function(editor) {
    let noiDungChiTiet = @json($duLieu['NOI_DUNG_VIDEO'] ?? '');
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
