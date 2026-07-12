
<style>
</style>

<select class="form-control select2-padding-custom" id="{{ $elemSelect2Id }}" data-placeholder="Vui lòng chọn">
</select>
									
<script>
var loadDataListStatusActive; // Function fetch data danh sách trạng thái hoạt động

$(document).ready(function(){
	/* Init combobox select2 trạng thái hoạt động */
    // Function init select2 trạng thái hoạt động
    function initSelectStatusActive(results, isDefaultGetAll) {
    	// Init multiple Select2
    	$('#{{ $elemSelect2Id }}').empty().trigger('change');
    
    	if (isDefaultGetAll === true) {
    		/* Tạo select2 tất cả default value cho combobox này (Nếu không dùng thì xóa đi) */
        	$('#{{ $elemSelect2Id }}').append('<option value="all">Tất cả</option>');
        	$('#{{ $elemSelect2Id }}').val('all').trigger('change');
    	}
    	
    	$('#{{ $elemSelect2Id }}').select2({
    		/* [Quan trọng] Nếu có sử dụng popup để hiện thị select2 thì thêm id của popup vào dropdownParent để không bị lỗi hiển thị css. Còn không dùng popup thì xóa dropdownParent này đi */
    		dropdownParent: null,
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
    		allowClear: false,
    		maximumSelectionLength: 100,
    		/* Cho phép chọn nhiều item - multiple item*/
    		multiple: false,
    		/* Set thông tin message cho select2 */
    		language: {
                noResults: function() {
                    return "Không tìm thấy kết quả";
                }
            }
    	});
    
    	
    }
    // Event select2 nên để bên ngoài function init để tránh trường hợp duplicate call event
    $('#{{ $elemSelect2Id }}').on('select2:select', function (e) {
        
    }).on('change', function (e) {
        
    }).on('select2:open', function() {
		// Ngăn bàn phím mở tự động khi dropdown được mở
		preventOpenKeyboardSelect2();
	});
    
    loadDataListStatusActive = function() {
		let defered = $.Deferred();
  
		// Create object data
        var data = {
        	
        };
        $.ajax({
        	type : "GET",
        	url : '{{ url("/api/status-active/list") }}',
        	contentType : "application/json",
			showLoading: false,
        	traditional: true,
        	data : data,
        	success: function(data, textStatus, request) {
				let url = this.url; // lấy URL từ `this`
				console.log(url);
    
				data = data.DATAS;
        		// Create array results for select2
        		let results = [];
        		// Looping json repsonse
        		for (var i = 0; i < data.StatusActiveDto.length; i++) {
        			// Create object result
        			let result = {
        				"id": data.StatusActiveDto[i].VALUE,
        				"text": data.StatusActiveDto[i].NAME
        			}
        			results.push(result);
        		}
        		// [Quan trọng] init select2 select type
        		initSelectStatusActive(results, {{ $isDefaultGetAll }});

				defered.resolve(data, textStatus, request);
				
        	},
        	error: function(request, textStatus, errorThrown) {
				if (request.status !== 401 && request.status !== 403) {
					request.responseJSON = request.responseText ? JSON.parse(request.responseText) : null;
					showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
				}
				defered.reject(request, textStatus, errorThrown);
        	},
        	complete : function() {
        	}
        });

		return defered.promise();
    }
});
</script>