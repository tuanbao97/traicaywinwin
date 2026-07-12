<?php

namespace App\Enum;

enum PermissionEnum : string
{
    case QL_BAI_VIET = 'QL_BAI_VIET';
    case QL_BAI_VIET_CHI_TIET = 'QL_BAI_VIET_CHI_TIET';
    case QL_BAI_VIET_CHINH_SUA = 'QL_BAI_VIET_CHINH_SUA';
    case QL_BAI_VIET_DANH_SACH = 'QL_BAI_VIET_DANH_SACH';
    case QL_BAI_VIET_THEM_MOI = 'QL_BAI_VIET_THEM_MOI';
    case QL_BAI_VIET_XOA = 'QL_BAI_VIET_XOA';

    case QL_DANH_MUC_BAI_VIET = 'QL_DANH_MUC_BAI_VIET';
    case QL_DANH_MUC_BAI_VIET_CHI_TIET = 'QL_DANH_MUC_BAI_VIET_CHI_TIET';
    case QL_DANH_MUC_BAI_VIET_CHINH_SUA = 'QL_DANH_MUC_BAI_VIET_CHINH_SUA';
    case QL_DANH_MUC_BAI_VIET_DANH_SACH = 'QL_DANH_MUC_BAI_VIET_DANH_SACH';
    case QL_DANH_MUC_BAI_VIET_THEM_MOI = 'QL_DANH_MUC_BAI_VIET_THEM_MOI';
    case QL_DANH_MUC_BAI_VIET_XOA = 'QL_DANH_MUC_BAI_VIET_XOA';

    case QL_DANH_MUC_SAN_PHAM = 'QL_DANH_MUC_SAN_PHAM';
    case QL_DANH_MUC_SAN_PHAM_CHI_TIET = 'QL_DANH_MUC_SAN_PHAM_CHI_TIET';
    case QL_DANH_MUC_SAN_PHAM_CHINH_SUA = 'QL_DANH_MUC_SAN_PHAM_CHINH_SUA';
    case QL_DANH_MUC_SAN_PHAM_DANH_SACH = 'QL_DANH_MUC_SAN_PHAM_DANH_SACH';
    case QL_DANH_MUC_SAN_PHAM_THEM_MOI = 'QL_DANH_MUC_SAN_PHAM_THEM_MOI';
    case QL_DANH_MUC_SAN_PHAM_XOA = 'QL_DANH_MUC_SAN_PHAM_XOA';

    case QL_SAN_PHAM = 'QL_SAN_PHAM';
    case QL_SAN_PHAM_CHI_TIET = 'QL_SAN_PHAM_CHI_TIET';
    case QL_SAN_PHAM_CHINH_SUA = 'QL_SAN_PHAM_CHINH_SUA';
    case QL_SAN_PHAM_DANH_SACH = 'QL_SAN_PHAM_DANH_SACH';
    case QL_SAN_PHAM_THEM_MOI = 'QL_SAN_PHAM_THEM_MOI';
    case QL_SAN_PHAM_XOA = 'QL_SAN_PHAM_XOA';

    case QL_TIN_TUC = 'QL_TIN_TUC';
    case QL_TIN_TUC_CHI_TIET = 'QL_TIN_TUC_CHI_TIET';
    case QL_TIN_TUC_CHINH_SUA = 'QL_TIN_TUC_CHINH_SUA';
    case QL_TIN_TUC_DANH_SACH = 'QL_TIN_TUC_DANH_SACH';
    case QL_TIN_TUC_THEM_MOI = 'QL_TIN_TUC_THEM_MOI';
    case QL_TIN_TUC_XOA = 'QL_TIN_TUC_XOA';

    case QL_DANH_MUC_TIN_TUC = 'QL_DANH_MUC_TIN_TUC';
    case QL_DANH_MUC_TIN_TUC_CHI_TIET = 'QL_DANH_MUC_TIN_TUC_CHI_TIET';
    case QL_DANH_MUC_TIN_TUC_CHINH_SUA = 'QL_DANH_MUC_TIN_TUC_CHINH_SUA';
    case QL_DANH_MUC_TIN_TUC_DANH_SACH = 'QL_DANH_MUC_TIN_TUC_DANH_SACH';
    case QL_DANH_MUC_TIN_TUC_THEM_MOI = 'QL_DANH_MUC_TIN_TUC_THEM_MOI';
    case QL_DANH_MUC_TIN_TUC_XOA = 'QL_DANH_MUC_TIN_TUC_XOA';

    case QL_VIDEO = 'QL_VIDEO';
    case QL_VIDEO_CHI_TIET = 'QL_VIDEO_CHI_TIET';
    case QL_VIDEO_CHINH_SUA = 'QL_VIDEO_CHINH_SUA';
    case QL_VIDEO_DANH_SACH = 'QL_VIDEO_DANH_SACH';
    case QL_VIDEO_THEM_MOI = 'QL_VIDEO_THEM_MOI';
    case QL_VIDEO_XOA = 'QL_VIDEO_XOA';
    case QL_VIDEO_XEM = 'QL_VIDEO_XEM';

    case QL_DON_HANG = 'QL_DON_HANG';
    case QL_DON_HANG_DANH_SACH = 'QL_DON_HANG_DANH_SACH';
    case QL_DON_HANG_CHI_TIET = 'QL_DON_HANG_CHI_TIET';
    case QL_DON_HANG_CHINH_SUA = 'QL_DON_HANG_CHINH_SUA';
    case QL_DON_HANG_XEM = 'QL_DON_HANG_XEM';

    case QL_THONG_TIN_CA_NHAN = 'QL_THONG_TIN_CA_NHAN';
    case QL_THONG_TIN_CA_NHAN_CHI_TIET = 'QL_THONG_TIN_CA_NHAN_CHI_TIET';
    case QL_THONG_TIN_CA_NHAN_CHINH_SUA = 'QL_THONG_TIN_CA_NHAN_CHINH_SUA';

    case QL_NGUOI_DUNG = 'QL_NGUOI_DUNG';
    case QL_NGUOI_DUNG_CHI_TIET = 'QL_NGUOI_DUNG_CHI_TIET';
    case QL_NGUOI_DUNG_CHINH_SUA = 'QL_NGUOI_DUNG_CHINH_SUA';
    case QL_NGUOI_DUNG_DANH_SACH = 'QL_NGUOI_DUNG_DANH_SACH';
    case QL_NGUOI_DUNG_THEM_MOI = 'QL_NGUOI_DUNG_THEM_MOI';
    case QL_NGUOI_DUNG_XOA = 'QL_NGUOI_DUNG_XOA';

    case QL_CAI_DAT = 'QL_CAI_DAT';
    case QL_CAI_DAT_CHI_TIET = 'QL_CAI_DAT_CHI_TIET';
    case QL_CAI_DAT_CHINH_SUA = 'QL_CAI_DAT_CHINH_SUA';
    case QL_CAI_DAT_DANH_SACH = 'QL_CAI_DAT_DANH_SACH';
    case QL_CAI_DAT_THEM_MOI = 'QL_CAI_DAT_THEM_MOI';
    case QL_CAI_DAT_XOA = 'QL_CAI_DAT_XOA';

    // Nếu bạn cần mô tả, bạn có thể định nghĩa phương thức `description()`
    public function description(): string
    {
        return match ($this) {
            self::QL_BAI_VIET => 'Quyền truy cập menu Bài viết',
            self::QL_BAI_VIET_CHI_TIET => 'Quyền xem chi tiết Bài viết',
            self::QL_BAI_VIET_CHINH_SUA => 'Quyền chỉnh sửa Bài viết',
            self::QL_BAI_VIET_DANH_SACH => 'Quyền xem danh sách Bài viết',
            self::QL_BAI_VIET_THEM_MOI => 'Quyền thêm mới Bài viết',
            self::QL_BAI_VIET_XOA => 'Quyền xóa Bài viết',

            self::QL_DANH_MUC_BAI_VIET => 'Quyền truy cập menu Danh mục bài viết',
            self::QL_DANH_MUC_BAI_VIET_CHI_TIET => 'Quyền xem chi tiết Danh mục bài viết',
            self::QL_DANH_MUC_BAI_VIET_CHINH_SUA => 'Quyền chỉnh sửa Danh mục bài viết',
            self::QL_DANH_MUC_BAI_VIET_DANH_SACH => 'Quyền xem danh sách Danh mục bài viết',
            self::QL_DANH_MUC_BAI_VIET_THEM_MOI => 'Quyền thêm mới Danh mục bài viết',
            self::QL_DANH_MUC_BAI_VIET_XOA => 'Quyền xóa Danh mục bài viết',

            self::QL_DANH_MUC_SAN_PHAM => 'Quyền truy cập menu Danh mục sản phẩm',
            self::QL_DANH_MUC_SAN_PHAM_CHI_TIET => 'Quyền xem chi tiết Danh mục sản phẩm',
            self::QL_DANH_MUC_SAN_PHAM_CHINH_SUA => 'Quyền chỉnh sửa Danh mục sản phẩm',
            self::QL_DANH_MUC_SAN_PHAM_DANH_SACH => 'Quyền xem danh sách Danh mục sản phẩm',
            self::QL_DANH_MUC_SAN_PHAM_THEM_MOI => 'Quyền thêm mới Danh mục sản phẩm',
            self::QL_DANH_MUC_SAN_PHAM_XOA => 'Quyền xóa Danh mục sản phẩm',

            self::QL_SAN_PHAM => 'Quyền truy cập menu Sản phẩm',
            self::QL_SAN_PHAM_CHI_TIET => 'Quyền xem chi tiết Sản phẩm',
            self::QL_SAN_PHAM_CHINH_SUA => 'Quyền chỉnh sửa Sản phẩm',
            self::QL_SAN_PHAM_DANH_SACH => 'Quyền xem danh sách Sản phẩm',
            self::QL_SAN_PHAM_THEM_MOI => 'Quyền thêm mới Sản phẩm',
            self::QL_SAN_PHAM_XOA => 'Quyền xóa Sản phẩm',

            self::QL_TIN_TUC => 'Quyền truy cập menu Tin tức',
            self::QL_TIN_TUC_CHI_TIET => 'Quyền xem chi tiết Tin tức',
            self::QL_TIN_TUC_CHINH_SUA => 'Quyền chỉnh sửa Tin tức',
            self::QL_TIN_TUC_DANH_SACH => 'Quyền xem danh sách Tin tức',
            self::QL_TIN_TUC_THEM_MOI => 'Quyền thêm mới Tin tức',
            self::QL_TIN_TUC_XOA => 'Quyền xóa Tin tức',

            self::QL_DANH_MUC_TIN_TUC => 'Quyền truy cập menu Danh mục tin tức',
            self::QL_DANH_MUC_TIN_TUC_CHI_TIET => 'Quyền xem chi tiết Danh mục tin tức',
            self::QL_DANH_MUC_TIN_TUC_CHINH_SUA => 'Quyền chỉnh sửa Danh mục tin tức',
            self::QL_DANH_MUC_TIN_TUC_DANH_SACH => 'Quyền xem danh sách Danh mục tin tức',
            self::QL_DANH_MUC_TIN_TUC_THEM_MOI => 'Quyền thêm mới Danh mục tin tức',
            self::QL_DANH_MUC_TIN_TUC_XOA => 'Quyền xóa Danh mục tin tức',

            self::QL_VIDEO => 'Quyền truy cập menu Video',
            self::QL_VIDEO_CHI_TIET => 'Quyền xem chi tiết Video',
            self::QL_VIDEO_CHINH_SUA => 'Quyền chỉnh sửa Video',
            self::QL_VIDEO_DANH_SACH => 'Quyền xem danh sách Video',
            self::QL_VIDEO_THEM_MOI => 'Quyền thêm mới Video',
            self::QL_VIDEO_XOA => 'Quyền xóa Video',
            self::QL_VIDEO_XEM => 'Quyền xem Video',

            self::QL_DON_HANG => 'Quyền truy cập menu Đơn hàng',
            self::QL_DON_HANG_DANH_SACH => 'Quyền xem danh sách Đơn hàng',
            self::QL_DON_HANG_CHI_TIET => 'Quyền xem chi tiết Đơn hàng',
            self::QL_DON_HANG_CHINH_SUA => 'Quyền chỉnh sửa Đơn hàng',
            self::QL_DON_HANG_XEM => 'Quyền xem Đơn hàng',

            self::QL_THONG_TIN_CA_NHAN => 'Quyền truy cập menu Thông tin cá nhân',
            self::QL_THONG_TIN_CA_NHAN_CHI_TIET => 'Quyền xem chi tiết Thông tin cá nhân',
            self::QL_THONG_TIN_CA_NHAN_CHINH_SUA => 'Quyền chỉnh sửa Thông tin cá nhân',

            self::QL_NGUOI_DUNG => 'Quyền truy cập menu Người dùng',
            self::QL_NGUOI_DUNG_CHI_TIET => 'Quyền xem chi tiết Người dùng',
            self::QL_NGUOI_DUNG_CHINH_SUA => 'Quyền chỉnh sửa Người dùng',
            self::QL_NGUOI_DUNG_DANH_SACH => 'Quyền xem danh sách Người dùng',
            self::QL_NGUOI_DUNG_THEM_MOI => 'Quyền thêm mới Người dùng',
            self::QL_NGUOI_DUNG_XOA => 'Quyền xóa Người dùng',

            self::QL_CAI_DAT => 'Quyền truy cập menu Cài đặt',
            self::QL_CAI_DAT_CHI_TIET => 'Quyền xem chi tiết Cài đặt',
            self::QL_CAI_DAT_CHINH_SUA => 'Quyền chỉnh sửa Cài đặt',
            self::QL_CAI_DAT_DANH_SACH => 'Quyền xem danh sách Cài đặt',
            self::QL_CAI_DAT_THEM_MOI => 'Quyền thêm mới Cài đặt',
            self::QL_CAI_DAT_XOA => 'Quyền xóa Cài đặt',
        };
    }
    
}
