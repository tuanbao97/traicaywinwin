<script>
$(document).ready(function () {
	getEditorContent = function(editorId) {
		const content = tinymce.get(editorId)?.getContent() || '';
		if (isEmpty(content)) return null;
		return replaceBlackHeartWithRed(preserveEditorLineBreaks(content));
	}

	getEditorContentOnlyText = function(editorId) {
		const editor = tinymce.get(editorId);
		const contentOnlyText = editor?.getContent({ format: 'text' }) || '';

		return isEmpty(contentOnlyText) ? null : contentOnlyText.trim();
	}

	/** Giữ xuống dòng khi lưu HTML từ TinyMCE (paste text / forced_root_block) */
	preserveEditorLineBreaks = function(html) {
		if (!html) return html;
		// Chuẩn hóa xuống dòng còn sót trong text thành <br>
		// (không đụng khoảng trắng indent giữa các thẻ HTML)
		return html
			.replace(/(>)(\r\n|\r|\n)+([^<])/g, '$1<br>$3')
			.replace(/([^>])(\r\n|\r|\n)+(<)/g, '$1<br>$3')
			.replace(/([^>])(\r\n|\r|\n)+([^<])/g, function (_, a, _nl, b) {
				return a + '<br>' + b;
			});
	}

	/** Paste plain text: \n → <br> / đoạn trống → <br><br> */
	convertPlainTextPasteToHtml = function(text) {
		return String(text || '')
			.replace(/\r\n/g, '\n')
			.replace(/\r/g, '\n')
			.split('\n')
			.map(function (line) {
				return line === '' ? '' : line;
			})
			.join('<br>');
	}

	replaceBlackHeartWithRed = function(content) {
		return content.replace(/❤(?!️)/g, '❤️');
	}

	replaceBlackHeartInNodeWithCaret = function(node, range) {
		if (!node) return;

		let walker = document.createTreeWalker(node, NodeFilter.SHOW_TEXT, null, false);

		while (walker.nextNode()) {
			let textNode = walker.currentNode;
			let oldValue = textNode.nodeValue;
			if (oldValue.includes('❤')) {
				// Tính vị trí con trỏ trong textNode nếu con trỏ đang ở node này
				let caretOffset = 0;
				if (range.startContainer === textNode) {
					caretOffset = range.startOffset;
				}

				// Thay thế trái tim đen bằng đỏ
				let newValue = oldValue.replace(/❤(?!️)/g, '❤️');

				// Cập nhật lại textNode
				textNode.nodeValue = newValue;

				// Tính lại offset con trỏ sau thay thế (mỗi ❤ thành ❤️ thêm 1 ký tự)
				if (range.startContainer === textNode) {
					let diff = newValue.length - oldValue.length;
					range.setStart(textNode, caretOffset + diff);
					range.setEnd(textNode, caretOffset + diff);
				}
			}
		}
	}

	{{ $sectionId }}_initTinyMce = function(content) {
		tinymce.init({
			selector: 'textarea#{{ $elementTinyMceId }}',
			// Dùng div để Enter tạo khối mới — giữ break line khi gõ / paste
			forced_root_block: 'div',
			force_br_newlines: false,
			remove_trailing_brs: false,
			plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table paste codesample",
				"emoticons",
			],
			contextmenu: false, // Tắt menu chuột phải để Android/iOS hiện menu hệ thống
			paste_data_images: true, // Cho phép paste hình ảnh từ clipboard
			paste_as_text: false,
			paste_preprocess: function (_plugin, args) {
				var content = args.content || '';
				var looksLikeHtml = /<[a-z][\s\S]*>/i.test(content);
				if (!looksLikeHtml && /[\r\n]/.test(content)) {
					args.content = convertPlainTextPasteToHtml(content);
					return;
				}
				// HTML paste: giữ <br>, không để newline thuần bị mất
				if (looksLikeHtml && /[\r\n]/.test(content) && content.indexOf('<br') === -1) {
					args.content = content.replace(/\r\n|\r|\n/g, '<br>');
				}
			},
			toolbar:"emoticons | undo redo | link image media | fontselect styleselect fontsizeselect | bold italic underline | forecolor backcolor removeformat | alignleft aligncenter alignright alignjustify lineheight | bullist numlist outdent indent | codesample action section button",
			font_formats: "Segoe UI=Segoe UI,sans-serif;" +
					"Arial=arial,helvetica,sans-serif;" +
					"Verdana=verdana,geneva,sans-serif;" +
					"Tahoma=tahoma,arial,helvetica,sans-serif;" +
					"Times New Roman=times new roman,times,serif;" +
					"Roboto=Roboto,sans-serif;" +
					"Open Sans=Open Sans,sans-serif;" +
					"Lato=Lato,sans-serif;" +
					"Montserrat=Montserrat,sans-serif;" +
					"Poppins=Poppins,sans-serif;",
			fontsize_formats: "default=;8px 9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 22px 24px 26px 28px 30px 32px 34px 36px 38px 40px 42px 44px 46px 48px 50px 52px 54px 56px 58px 60px 62px 64px 66px 68px 70px 72px 74px 76px 78px 80px 82px 84px 86px 88px 90px 92px 94px 96px",
    		lineheight_formats: "default=;1 1.1 1.2 1.3 1.4 1.5 1.6 1.75 2 2.5 3",
			mobile: {
				menubar: true,
				plugins: [
					"advlist autolink lists link image charmap print preview anchor",
					"searchreplace visualblocks code fullscreen",
					"insertdatetime media table paste codesample",
					"emoticons"
				],
				toolbar: 'emoticons | undo redo | link image | bold italic underline | forecolor backcolor removeformat | fontselect styleselect fontsizeselect | alignleft aligncenter alignright alignjustify lineheight | bullist numlist outdent indent | codesample action section button'
			},
			
			height: 600,
			/* START Cấu hình upload file từ local */
			relative_urls: true,
			document_base_url: '{{ asset('/') }}',
			image_title: true,
			automatic_uploads: true,
			file_picker_types: 'image media',
			file_picker_callback: async function (callback, value, meta) { // Xử lý callback upload file
				var input = document.createElement('input');
				input.setAttribute('type', 'file');
				if (meta.filetype == "image") {
					input.setAttribute('accept', 'image/*');

					input.onchange = async function () {
						var file = this.files[0];
						if (!file) {
							alert("No file selected!");
							return;
						}

						var formData = new FormData();
						// List of files to add to form data
						formData.append('FILES[]', file);
						formData.append('DANH_SACH_KICH_THUOC_HINH_ANH[]', '1x1');
						// formData.append('DANH_SACH_KICH_THUOC_HINH_ANH[]', '3x2');
					
						// Call api upload multiple files
						$.ajax({
							type: "POST",
							enctype: 'multipart/form-data',
							url: '{{ url("/api/document-storage/upload-multiples-hinh-anh") }}',
							data: formData,
							showLoading: true,
					
							// prevent jQuery from automatically transforming the data into a query string
							processData: false,
							contentType: false,
							cache: false,
							timeout: 1000000,
							success: function(data, textStatus, jqXHR) {
								// Ajax call completed successfully 
								showToastSuccess('top-right', data.STATUS_DETAIL);

								// Gán hình ảnh
								let documentStorage = data.DATAS.DocumentStorage[0];
								callback('{{ asset("/") }}' + documentStorage.DIRECTORY + '/' + documentStorage.NAME, { title: file.name, alt: file.name});
							},
							error: function(request, textStatus, errorThrown) {
								if (request.status !== 401 && request.status !== 403) {
									// Some error in ajax call 
									if (request && request.responseJSON && request.responseJSON.STATUS_DETAIL)
										showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
								}
							},
							complete : function() {

							}
						});
					};
				}

				else if (meta.filetype == "media") {
					input.setAttribute('accept', 'media/*');

					input.onchange = async function () {
						var file = this.files[0];
						if (!file) {
							alert("No file selected!");
							return;
						}

						// Get form
						var formData = new FormData();
						// List of files to add to form data
						formData.append('VIDEOS[]', file);
						formData.append('KICH_THUOC_HINH_ANH_DAI_DIEN', '1x1');

						// Call api upload multiple files
						$.ajax({
							type: "POST",
							enctype: 'multipart/form-data',
							url: '{{ url("/api/document-storage/upload-multiples-video") }}',
							data: formData,
							showLoading: true,

							// Ngăn jQuery tự động chuyển đổi data thành chuỗi query
							processData: false,
							contentType: false,
							cache: false,
							timeout: 1000000,
							success: function(data, textStatus, jqXHR) {
								// Ajax call completed successfully 
								showToastSuccess('top-right', data.STATUS_DETAIL);

								// Gán hình ảnh
								let documentStorage = data.DATAS.DocumentStorage[0];
								let videoUrl = '{{asset('') }}' + documentStorage.PATH;
								let imageThumnail = '{{asset('') }}'+ documentStorage.DIRECTORY + '/' + documentStorage.IMAGE_THUMNAIL;
								console.log(`${videoUrl}`);
								
								callback(videoUrl
									, { 
										poster: imageThumnail
										, id: documentStorage.ID
										, title: documentStorage.ORIGINAL_NAME
									}
								);
							},
							error: function(request, textStatus, errorThrown) {
								if (request.status !== 401 && request.status !== 403) {
									// Some error in ajax call
									if (request && request.responseJSON && request.responseJSON.STATUS_DETAIL)
										showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
								}
								
							},
							complete: function() {

							}
						});
					};
				}
				
				/*
				// Xử lý upload hình ảnh và resize hình ảnh. Base64 sẽ encode hình ảnh img="blob:base64"
				if (meta.filetype == "image") {
					input.setAttribute('accept', 'image/*');

					input.onchange = async function () {
						var file = this.files[0];
						if (!file) {
							alert("No file selected!");
							return;
						}
						try {
							// Đọc file thành DataURL
							const base64Data = await readFileAsDataURLTinyMCE(file);

							// Tải ảnh từ DataURL
							const img = await loadImageTinyMCE(base64Data);

							// Resize và nén ảnh
							const maxWidth = 800;
							const maxHeight = 800;
							const resizedBase64 = resizeImageTinyMCE(img, file.type, maxWidth, maxHeight);

							// Tạo Blob từ Base64
							const blob = dataURLtoBlobTinyMCE(resizedBase64);

							// Gửi Blob tới TinyMCE
							let base64 = resizedBase64.split(',')[1];
							const id = 'blobid' + (new Date()).getTime();
							const blobCache = tinymce.activeEditor.editorUpload.blobCache;
							const blobInfo = blobCache.create(id, file, base64);
							blobCache.add(blobInfo);

							callback(blobInfo.blobUri(), { title: file.name });

							// In ra Base64 nếu cần
							console.log('Base64 Image:', base64);
						} catch (error) {
							console.error('Error processing image:', error);
						}
					};
				}
				*/

				/*
				// Xử lý upload video local tuy nhiên nó rất nặng. Base64. Không nên sử dụng
				else if (meta.filetype == "media") {
					input.setAttribute('accept', 'media/*');
					input.onchange = function () {
						var file = this.files[0];
						if (!file) {
							alert("Không có hình ảnh nào được chọn!");
							return;
						}
						
						var reader = new FileReader();

						reader.onload = function () {
							var id = 'blobid' + (new Date()).getTime();
							var blobCache = tinymce.activeEditor.editorUpload.blobCache;
							var base64 = reader.result.split(',')[1];
							var blobInfo = blobCache.create(id, file, base64);
							blobCache.add(blobInfo);
							callback(blobInfo.blobUri(), {title: file.name});
						};
						reader.readAsDataURL(file);
					};
				}
				*/
				input.click();
			},
			setup: function (editor) {
				editor.on('init', function(args) {
					console.log('Hoàn thành init.');
					editor.setContent(content);
					
					const maxImgWidth = 800; // Max width của ảnh
					editor = args.target;
					editor.on('NodeChange', function(e) {
						if (e && e.element.nodeName.toLowerCase() == 'img') {
							width = e.element.width;
							height = e.element.height;
							if (width > maxImgWidth) {
								height = height / (width / maxImgWidth);
								width = maxImgWidth;
							}
							tinyMCE.DOM.setAttribs(e.element, {'width': width, 'height': height});
						}
					});

					// Tùy chỉnh menu fontsizeselect
					editor.ui.registry.addMenuButton('fontsizeselect', {
						text: 'Kích thước chữ',
						fetch: function (callback) {
							const sizes = editor.getParam('fontsize_formats').split(' ');
							const items = sizes.map(function (size) {
								const [text, value] = size.split('=');
								return {
									type: 'menuitem',
									text: text === 'default' ? 'Không chọn' : text,
									onAction: function () {
										if (value !== '') {
											editor.execCommand('FontSize', false, value || text);
										} else {
											editor.formatter.remove('fontsize');
										}
									}
								};
							});
							callback(items);
						}
					});

					// Tùy chỉnh menu lineheight
					editor.ui.registry.addMenuButton('lineheight', {
						text: 'Chiều cao dòng',
						fetch: function (callback) {
							const heights = editor.getParam('lineheight_formats').split(' ');
							const items = heights.map(function (height) {
								const [text, value] = height.split('=');
								return {
									type: 'menuitem',
									text: text === 'default' ? 'Không chọn' : text,
									onAction: function () {
										if (value !== '') {
											editor.execCommand('LineHeight', false, value || text);
										} else {
											editor.formatter.remove('lineheight');
										}
									}
								};
							});
							callback(items);
						}
					});
				});

				editor.on('ResizeEditor', (e) => {
					console.log('Editor was resized.');
				});

				editor.on('ExecCommand', (e) => {
					console.log(`The ${e.command} command was fired.`);
				});

				// 💡 Replace emoji đặc biệt (vd trái tim đỏ trên đth -> nhưng hiển thị lại trái tim đen) mỗi khi người dùng nhập liệu
				editor.on('input', function() {
					const sel = editor.selection;
					const rng = sel.getRng(); // Lưu range con trỏ hiện tại

					let node = editor.selection.getNode();
					if (!node) return;

					// Replace nội dung trong node, đồng thời tính offset mới của con trỏ
					replaceBlackHeartInNodeWithCaret(node, rng);

					// Đặt lại con trỏ
					sel.setRng(rng);
				});
			},
			/* END Cấu hình upload file từ local */
			// Xử lý callback sau khi tinyMCE editor đã khởi tạo hoàn tất
			init_instance_callback: "{{ $sectionId }}_{{ $elementTinyMceId }}_callBackTinyMCEAfterInit"
		});
	}

});
</script>