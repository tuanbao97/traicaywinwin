<!-- 
    Component Popup Địa Chỉ Mới
    Sử dụng chung cho nhiều blade
    Tham khảo từ san-pham.blade.php
-->

<!-- Modal Địa Chỉ -->
<div class="modal fade" id="{{ $sectionId }}_MODAL_CHON_DIA_CHI" tabindex="-1" role="dialog" 
     aria-labelledby="{{ $sectionId }}_MODAL_CHON_DIA_CHI_LABEL" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="{{ $sectionId }}_MODAL_CHON_DIA_CHI_LABEL">Chọn địa chỉ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="{{ $sectionId }}_SELECT_TINH_THANH">Tỉnh/Thành phố <span class="text-danger">*</span></label>
              <select class="form-control form-select form-control-default border-radius-2px border-top-left-radius-0px border-bottom-left-radius-0px" 
                      id="{{ $sectionId }}_SELECT_TINH_THANH" required>
                <option value="">Chọn tỉnh/thành phố...</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="{{ $sectionId }}_SELECT_QUAN_HUYEN">Quận/Huyện <span class="text-danger">*</span></label>
              <select class="form-control form-select form-control-default border-radius-2px border-top-left-radius-0px border-bottom-left-radius-0px" 
                      id="{{ $sectionId }}_SELECT_QUAN_HUYEN" disabled required>
                <option value="">Chọn quận/huyện...</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="{{ $sectionId }}_SELECT_PHUONG_XA">Phường/Xã <span class="text-danger">*</span></label>
              <select class="form-control form-select form-control-default border-radius-2px border-top-left-radius-0px border-bottom-left-radius-0px" 
                      id="{{ $sectionId }}_SELECT_PHUONG_XA" disabled required>
                <option value="">Chọn phường/xã...</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-4">
            <div class="form-group">
              <label for="{{ $sectionId }}_POPUP_SO_NHA">Số nhà</label>
              <input type="text" class="form-control" id="{{ $sectionId }}_POPUP_SO_NHA" placeholder="">
            </div>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <label for="{{ $sectionId }}_POPUP_TEN_DUONG">Tên đường <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="{{ $sectionId }}_POPUP_TEN_DUONG" placeholder="">
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <div class="form-group">
              <label>Địa chỉ đầy đủ:</label>
              <div class="alert alert-info" id="{{ $sectionId }}_DIA_CHI_DAY_DU">
                Vui lòng chọn địa chỉ...
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="button" class="btn btn-info" id="{{ $sectionId }}_BTN_XAC_NHAN_DIA_CHI">Xác nhận</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    
    // Khởi tạo popup địa chỉ (lazy API). Chỉ bind events, KHÔNG gọi API ở đây
    window['{{ $sectionId }}_initPopupDiaChi'] = function() {
        console.log('Khởi tạo popup địa chỉ (lazy) cho section: {{ $sectionId }}');
        window['{{ $sectionId }}_bindEvents']();
    }

    // Bind các sự kiện
    window['{{ $sectionId }}_bindEvents'] = function() {
        // Xử lý khi chọn tỉnh thành
        $('#{{ $sectionId }}_SELECT_TINH_THANH').on('change', function() {
            const provinceCode = $(this).val();
            if (provinceCode) {
                window['{{ $sectionId }}_loadDistricts'](provinceCode);
                $('#{{ $sectionId }}_SELECT_QUAN_HUYEN').prop('disabled', false);
                $('#{{ $sectionId }}_SELECT_PHUONG_XA').prop('disabled', true);
                $('#{{ $sectionId }}_SELECT_PHUONG_XA').html('<option value="">Chọn phường/xã...</option>');
            } else {
                $('#{{ $sectionId }}_SELECT_QUAN_HUYEN').prop('disabled', true);
                $('#{{ $sectionId }}_SELECT_PHUONG_XA').prop('disabled', true);
                $('#{{ $sectionId }}_SELECT_QUAN_HUYEN').html('<option value="">Chọn quận/huyện...</option>');
                $('#{{ $sectionId }}_SELECT_PHUONG_XA').html('<option value="">Chọn phường/xã...</option>');
            }
            window['{{ $sectionId }}_updateFullAddress']();
        });

        // Xử lý khi chọn quận huyện
        $('#{{ $sectionId }}_SELECT_QUAN_HUYEN').on('change', function() {
            const districtCode = $(this).val();
            if (districtCode) {
                window['{{ $sectionId }}_loadWards'](districtCode);
                $('#{{ $sectionId }}_SELECT_PHUONG_XA').prop('disabled', false);
            } else {
                $('#{{ $sectionId }}_SELECT_PHUONG_XA').prop('disabled', true);
                $('#{{ $sectionId }}_SELECT_PHUONG_XA').html('<option value="">Chọn phường/xã...</option>');
            }
            window['{{ $sectionId }}_updateFullAddress']();
        });

        // Xử lý khi chọn phường xã
        $('#{{ $sectionId }}_SELECT_PHUONG_XA').on('change', function() {
            window['{{ $sectionId }}_updateFullAddress']();
        });

        // Xử lý khi nhập số nhà hoặc tên đường: chỉ cập nhật hiển thị trong popup
        $('#{{ $sectionId }}_POPUP_SO_NHA, #{{ $sectionId }}_POPUP_TEN_DUONG').on('input', function() {
            console.log('Input thay đổi trong popup');
            window['{{ $sectionId }}_updateFullAddress']();
        });

        // Xử lý button xác nhận
        $('#{{ $sectionId }}_BTN_XAC_NHAN_DIA_CHI').on('click', function() {
            window['{{ $sectionId }}_confirmAddress']();
        });
    }

    // Load danh sách tỉnh thành (trả về Promise và cho phép chọn sẵn)
    window['{{ $sectionId }}_loadProvinces'] = function(preselectProvinceCode) {
        return new Promise(function(resolve, reject) {
            $.ajax({
                url: '{{ url("/api/province/list") }}',
                method: 'GET',
                success: function(response) {
                    console.log('Province API response:', response);
                    if ((response.STATUS && response.DATAS && response.DATAS.Province) || (response.success && response.data)) {
                        const list = response.DATAS ? response.DATAS.Province : response.data;
                        let options = '<option value="">Chọn tỉnh/thành phố...</option>';
                        list.forEach(function(province) {
                            options += `<option value="${province.CODE}">${province.TEN_TINH_THANH}</option>`;
                        });
                        $('#{{ $sectionId }}_SELECT_TINH_THANH').html(options);
                        if (preselectProvinceCode) {
                            $('#{{ $sectionId }}_SELECT_TINH_THANH').val(preselectProvinceCode);
                        }
                        window['{{ $sectionId }}_updateFullAddress']();
                        resolve();
                    } else {
                        console.error('Unexpected province API response structure:', response);
                        $('#{{ $sectionId }}_SELECT_TINH_THANH').html('<option value="">Lỗi tải dữ liệu</option>');
                        reject(new Error('Bad province response'));
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading provinces:', error);
                    $('#{{ $sectionId }}_SELECT_TINH_THANH').html('<option value="">Lỗi tải dữ liệu</option>');
                    reject(error);
                }
            });
        });
    }

    // Load danh sách quận huyện (trả về Promise và cho phép chọn sẵn)
    window['{{ $sectionId }}_loadDistricts'] = function(provinceCode, preselectDistrictCode) {
        return new Promise(function(resolve, reject) {
            $.ajax({
                url: '{{ url("/api/district/list") }}',
                method: 'GET',
                data: { PROVINCE_CODE: provinceCode },
                success: function(response) {
                    if ((response.STATUS && response.DATAS && response.DATAS.District) || (response.success && response.data)) {
                        const list = response.DATAS ? response.DATAS.District : response.data;
                        let options = '<option value="">Chọn quận/huyện...</option>';
                        list.forEach(function(district) {
                            options += `<option value="${district.CODE}">${district.TEN_QUAN_HUYEN}</option>`;
                        });
                        $('#{{ $sectionId }}_SELECT_QUAN_HUYEN').html(options);
                        $('#{{ $sectionId }}_SELECT_QUAN_HUYEN').prop('disabled', false);
                        if (preselectDistrictCode) {
                            $('#{{ $sectionId }}_SELECT_QUAN_HUYEN').val(preselectDistrictCode);
                        }
                        window['{{ $sectionId }}_updateFullAddress']();
                        resolve();
                    } else {
                        console.error('Unexpected district API response structure:', response);
                        $('#{{ $sectionId }}_SELECT_QUAN_HUYEN').html('<option value="">Lỗi tải dữ liệu</option>');
                        reject(new Error('Bad district response'));
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading districts:', error);
                    $('#{{ $sectionId }}_SELECT_QUAN_HUYEN').html('<option value="">Lỗi tải dữ liệu</option>');
                    reject(error);
                }
            });
        });
    }

    // Load danh sách phường xã (trả về Promise và cho phép chọn sẵn)
    window['{{ $sectionId }}_loadWards'] = function(districtCode, preselectWardCode) {
        return new Promise(function(resolve, reject) {
            $.ajax({
                url: '{{ url("/api/ward/list") }}',
                method: 'GET',
                data: { DISTRICT_CODE: districtCode },
                success: function(response) {
                    if ((response.STATUS && response.DATAS && response.DATAS.Ward) || (response.success && response.data)) {
                        const list = response.DATAS ? response.DATAS.Ward : response.data;
                        let options = '<option value="">Chọn phường/xã...</option>';
                        list.forEach(function(ward) {
                            options += `<option value="${ward.CODE}">${ward.TEN_PHUONG_XA_THI_TRAN}</option>`;
                        });
                        $('#{{ $sectionId }}_SELECT_PHUONG_XA').html(options);
                        $('#{{ $sectionId }}_SELECT_PHUONG_XA').prop('disabled', false);
                        if (preselectWardCode) {
                            $('#{{ $sectionId }}_SELECT_PHUONG_XA').val(preselectWardCode);
                        }
                        window['{{ $sectionId }}_updateFullAddress']();
                        resolve();
                    } else {
                        console.error('Unexpected ward API response structure:', response);
                        $('#{{ $sectionId }}_SELECT_PHUONG_XA').html('<option value="">Lỗi tải dữ liệu</option>');
                        reject(new Error('Bad ward response'));
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading wards:', error);
                    $('#{{ $sectionId }}_SELECT_PHUONG_XA').html('<option value="">Lỗi tải dữ liệu</option>');
                    reject(error);
                }
            });
        });
    }

    // Cập nhật địa chỉ đầy đủ
    window['{{ $sectionId }}_updateFullAddress'] = function() {
        let soNha = $('#{{ $sectionId }}_POPUP_SO_NHA').val();
        let tenDuong = $('#{{ $sectionId }}_POPUP_TEN_DUONG').val();
        let phuongXa = $('#{{ $sectionId }}_SELECT_PHUONG_XA option:selected').text();
        let quanHuyen = $('#{{ $sectionId }}_SELECT_QUAN_HUYEN option:selected').text();
        let tinhThanh = $('#{{ $sectionId }}_SELECT_TINH_THANH option:selected').text();

        console.log('UpdateFullAddress - Dữ liệu:', { soNha, tenDuong, phuongXa, quanHuyen, tinhThanh });

        let diaChiDayDu = '';
        if (soNha) diaChiDayDu += soNha + ', ';
        if (tenDuong) diaChiDayDu += tenDuong + ', ';
        if (phuongXa && phuongXa !== 'Chọn phường/xã...') diaChiDayDu += phuongXa + ', ';
        if (quanHuyen && quanHuyen !== 'Chọn quận/huyện...') diaChiDayDu += quanHuyen + ', ';
        if (tinhThanh && tinhThanh !== 'Chọn tỉnh/thành phố...') diaChiDayDu += tinhThanh;

        if (diaChiDayDu.endsWith(', ')) {
            diaChiDayDu = diaChiDayDu.slice(0, -2);
        }

        console.log('Địa chỉ đầy đủ được tạo:', diaChiDayDu);

        if (diaChiDayDu) {
            $('#{{ $sectionId }}_DIA_CHI_DAY_DU').text(diaChiDayDu).removeClass('alert-info').addClass('alert-success');
        } else {
            $('#{{ $sectionId }}_DIA_CHI_DAY_DU').text('Vui lòng chọn địa chỉ...').removeClass('alert-success').addClass('alert-info');
        }
    }

    // Xác nhận địa chỉ
    window['{{ $sectionId }}_confirmAddress'] = function() {
        let tinhThanh = $('#{{ $sectionId }}_SELECT_TINH_THANH').val();
        let quanHuyen = $('#{{ $sectionId }}_SELECT_QUAN_HUYEN').val();
        let phuongXa = $('#{{ $sectionId }}_SELECT_PHUONG_XA').val();
        let soNha = $('#{{ $sectionId }}_POPUP_SO_NHA').val();
        let tenDuong = $('#{{ $sectionId }}_POPUP_TEN_DUONG').val();

        if (!tinhThanh) {
            showToastFailure('top-right', 'Vui lòng chọn tỉnh/thành phố');
            return;
        }

        if (!quanHuyen) {
            showToastFailure('top-right', 'Vui lòng chọn quận/huyện');
            return;
        }

        if (!phuongXa) {
            showToastFailure('top-right', 'Vui lòng chọn phường/xã');
            return;
        }

        if (!tenDuong) {
            showToastFailure('top-right', 'Vui lòng nhập tên đường');
            return;
        }

        // Lấy text hiển thị
        const provinceText = $('#{{ $sectionId }}_SELECT_TINH_THANH option:selected').text();
        const districtText = $('#{{ $sectionId }}_SELECT_QUAN_HUYEN option:selected').text();
        const wardText = $('#{{ $sectionId }}_SELECT_PHUONG_XA option:selected').text();

        // Tạo địa chỉ đầy đủ
        let fullAddress = '';
        if (soNha) {
            fullAddress += soNha + ', ';
        }
        fullAddress += tenDuong + ', ' + wardText + ', ' + districtText + ', ' + provinceText;

        // Gọi callback function nếu có (lúc này mới ghi nhận chính thức ra ngoài)
        if (typeof window['{{ $sectionId }}_callBackDiaChi'] === 'function') {
            window['{{ $sectionId }}_callBackDiaChi']({
                provinceCode: tinhThanh,
                districtCode: quanHuyen,
                wardCode: phuongXa,
                soNha: soNha,
                tenDuong: tenDuong,
                provinceText: provinceText,
                districtText: districtText,
                wardText: wardText,
                fullAddress: fullAddress
            });
        }

        // Đóng modal
        $('#{{ $sectionId }}_MODAL_CHON_DIA_CHI').modal('hide');
    }

    // Function mở popup với dữ liệu có sẵn
    window['{{ $sectionId }}_openPopupWithData'] = function(provinceCode, districtCode, wardCode, soNha, tenDuong) {
        console.log('Mở popup với dữ liệu:', { provinceCode, districtCode, wardCode, soNha, tenDuong });
        
        // Reset form (nhưng KHÔNG reset số nhà và tên đường)
        $('#{{ $sectionId }}_SELECT_TINH_THANH').val('');
        $('#{{ $sectionId }}_SELECT_QUAN_HUYEN').html('<option value="">Chọn quận/huyện...</option>').prop('disabled', true);
        $('#{{ $sectionId }}_SELECT_PHUONG_XA').html('<option value="">Chọn phường/xã...</option>').prop('disabled', true);
        $('#{{ $sectionId }}_DIA_CHI_DAY_DU').text('Vui lòng chọn địa chỉ...');

        // Mở modal trước
        console.log('Đang mở modal với ID: {{ $sectionId }}_MODAL_CHON_DIA_CHI');
        let modal = $('#{{ $sectionId }}_MODAL_CHON_DIA_CHI');
        console.log('Modal được tìm thấy:', modal.length > 0);
        
        if (modal.length > 0) {
            modal.modal('show');
            console.log('Modal đã được mở');
            
            // Debug: Kiểm tra input có trong modal không
            setTimeout(function() {
                let soNhaInputInModal = modal.find('input[id*="EDIT_SO_NHA"]');
                let tenDuongInputInModal = modal.find('input[id*="EDIT_TEN_DUONG"]');
                
                console.log('Input số nhà trong modal:', soNhaInputInModal.length);
                console.log('Input tên đường trong modal:', tenDuongInputInModal.length);
                
                if (soNhaInputInModal.length > 0) {
                    console.log('Input số nhà trong modal ID:', soNhaInputInModal.attr('id'));
                }
                if (tenDuongInputInModal.length > 0) {
                    console.log('Input tên đường trong modal ID:', tenDuongInputInModal.attr('id'));
                }
            }, 100);
        } else {
            console.error('KHÔNG TÌM THẤY modal với ID: {{ $sectionId }}_MODAL_CHON_DIA_CHI');
        }

        // Lần đầu mở popup mới load danh sách tỉnh thành
        if (!$('#{{ $sectionId }}_SELECT_TINH_THANH').children('option[value!=""]').length) {
            window['{{ $sectionId }}_loadProvinces']().then(function(){
                window['{{ $sectionId }}_loadAndSetAddress'](provinceCode, districtCode, wardCode, soNha, tenDuong);
            });
        } else {
            window['{{ $sectionId }}_loadAndSetAddress'](provinceCode, districtCode, wardCode, soNha, tenDuong);
        }
    }

    // Function load và set địa chỉ - chờ tuần tự để chọn đúng các giá trị
    window['{{ $sectionId }}_loadAndSetAddress'] = async function(provinceCode, districtCode, wardCode, soNha, tenDuong) {
        console.log('LoadAndSetAddress được gọi với:', { provinceCode, districtCode, wardCode, soNha, tenDuong });
        
        // Set số nhà và tên đường ngay lập tức vào input của popup
        if (soNha) {
            console.log('Đang set số nhà vào input popup:', soNha);
            
            // Debug: Kiểm tra input có tồn tại không
            let soNhaInput = $('#{{ $sectionId }}_POPUP_SO_NHA');
            console.log('Input số nhà được tìm thấy:', soNhaInput.length > 0);
            console.log('Input số nhà ID:', soNhaInput.attr('id'));
            
            if (soNhaInput.length > 0) {
                soNhaInput.val(soNha);
                console.log('Số nhà sau khi set trong popup:', soNhaInput.val());
                
                // Debug: Kiểm tra DOM
                console.log('Input số nhà HTML:', soNhaInput[0].outerHTML);
            } else {
                console.error('KHÔNG TÌM THẤY input số nhà với ID: {{ $sectionId }}_POPUP_SO_NHA');
                // Tìm tất cả input có chứa EDIT_SO_NHA
                let allSoNhaInputs = $('input[id*="EDIT_SO_NHA"]');
                console.log('Tất cả input số nhà tìm thấy:', allSoNhaInputs.length);
                allSoNhaInputs.each(function(index) {
                    console.log('Input số nhà ' + index + ':', $(this).attr('id'));
                });
            }
        }
        if (tenDuong) {
            console.log('Đang set tên đường vào input popup:', tenDuong);
            
            // Debug: Kiểm tra input có tồn tại không
            let tenDuongInput = $('#{{ $sectionId }}_POPUP_TEN_DUONG');
            console.log('Input tên đường được tìm thấy:', tenDuongInput.length > 0);
            console.log('Input tên đường ID:', tenDuongInput.attr('id'));
            
            if (tenDuongInput.length > 0) {
                tenDuongInput.val(tenDuong);
                console.log('Tên đường sau khi set trong popup:', tenDuongInput.val());
                
                // Debug: Kiểm tra DOM
                console.log('Input tên đường HTML:', tenDuongInput[0].outerHTML);
            } else {
                console.error('KHÔNG TÌM THẤY input tên đường với ID: {{ $sectionId }}_POPUP_TEN_DUONG');
                // Tìm tất cả input có chứa EDIT_TEN_DUONG
                let allTenDuongInputs = $('input[id*="EDIT_TEN_DUONG"]');
                console.log('Tất cả input tên đường tìm thấy:', allTenDuongInputs.length);
                allTenDuongInputs.each(function(index) {
                    console.log('Input tên đường ' + index + ':', $(this).attr('id'));
                });
            }
        }
        
        // Cập nhật địa chỉ đầy đủ ngay lập tức
        window['{{ $sectionId }}_updateFullAddress']();

        try {
            if (provinceCode) {
                await window['{{ $sectionId }}_loadProvinces'](provinceCode);
                $('#{{ $sectionId }}_SELECT_TINH_THANH').val(provinceCode);
                console.log('Đã set tỉnh thành:', provinceCode);
            } else {
                await window['{{ $sectionId }}_loadProvinces']();
            }

            if (districtCode) {
                await window['{{ $sectionId }}_loadDistricts'](provinceCode, districtCode);
                $('#{{ $sectionId }}_SELECT_QUAN_HUYEN').val(districtCode).prop('disabled', false);
                console.log('Đã set quận huyện:', districtCode);
            }

            if (wardCode) {
                await window['{{ $sectionId }}_loadWards'](districtCode, wardCode);
                $('#{{ $sectionId }}_SELECT_PHUONG_XA').val(wardCode).prop('disabled', false);
                console.log('Đã set phường xã:', wardCode);
            }

            window['{{ $sectionId }}_updateFullAddress']();
        } catch (e) {
            console.error('Lỗi khi load dữ liệu địa chỉ:', e);
        }
    }

    // Khởi tạo popup khi document ready
    window['{{ $sectionId }}_initPopupDiaChi']();

});
</script>
