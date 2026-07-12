<?php

namespace App\Repository\impl;

use App\Enum\AppConstant;
use App\Models\CategoryP;
use App\Repository\BaseRepository;
use App\Repository\CategoryPRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryPRepositoyImpl extends BaseRepository implements CategoryPRepository
{
    public function getModel()
    {
        return CategoryP::class;
    }

    public function getSortOrder() : int
    {
        return $this->model
        ->where([
            ['STATUS', '=', AppConstant::STATUS_USING]
        ])
        ->max('SORT_ORDER') ?? 0;
    }

    public function getListDanhMucSanPhamWithChilds(?bool $isApiPublic, int $page, int $perPage)  : LengthAwarePaginator
    {
        $query = CategoryP::query()
        ->with([
            'childrens' => function($q) use ($isApiPublic){
                if ($isApiPublic === true) {
                    $q->where([
                        ['IS_ACTIVE', true]
                    ]);
                }
            }
        ])
        ->with('avatars')
        ->whereNull('PARENT_ID')
        ->where([
            ['STATUS', '=', AppConstant::STATUS_USING]
        ]);

        if ($isApiPublic === true) {
            $query->where([
                ['IS_ACTIVE', true]
            ]);
        }

        $query->orderByRaw('
            CASE
                WHEN SORT_ORDER IS NOT NULL THEN SORT_ORDER
                ELSE 999999999
            END ASC
            , NAME ASC
        ')
        ->orderBy('CRT_DT', 'desc');
        
        /* Phân trang */
        $result = $query->paginate($perPage, ['*'], 'page', $page);
        
        /* Đổi url khi click tag a paging */
        $result->withPath('/categoryp/list/tree');

        // Đệ quy loại bỏ node con không active nếu còn sót
        if ($isApiPublic === true) {
            $result->getCollection()->transform(function($item) {
                return $this->removeInactiveChildren($item);
            });
        }
        
        return $result;
    }

    // Hàm đệ quy loại bỏ node con không active
    private function removeInactiveChildren($item) {
        if (isset($item->childrens) && is_iterable($item->childrens)) {
            $item->childrens = $item->childrens->filter(function($child) {
                return $child->IS_ACTIVE == true;
            })->map(function($child) {
                return $this->removeInactiveChildren($child);
            })->values();
        }
        return $item;
    }

    public function getListDanhMucSanPham(?bool $isGetAllParentAndChilds,?int $parentId, ?bool $trangThaiHoatDong, ?string $tuKhoa
        , ?bool $isApiPublic
        , int $page, int $perPage) : LengthAwarePaginator
    {
        $query = CategoryP::with('avatars')
        // With count để tạo 1 flag kiểm tra row hiện tại có childrens hay không
        ->withCount([
            'childrenNotRecursive as COUNT_CHILDREN' => function($query) use ($parentId, $trangThaiHoatDong) {
                $query->where(
                    [
                          ['STATUS', '=', AppConstant::STATUS_USING]
                    ]
                );

                if (!is_null($trangThaiHoatDong)) {
                    $query->where([
                        ['IS_ACTIVE', '=', $trangThaiHoatDong]
                    ]);
                }
            }
        ])
        ->where([
            ['STATUS', '=', AppConstant::STATUS_USING]
        ]);

        if ($isGetAllParentAndChilds != true) {
            // Nếu không truyền parentId thì get parent root. Ngược lại thì các item con theo parentId
            if (!is_null($parentId)) {
                $query->where([
                    ['PARENT_ID', '=', $parentId]
                ]);
            }  else {
                $query->whereNull('PARENT_ID');
            }
        }

        // Tìm kiếm theo từ khóa
        // Tạo thành 1 block where theo điều kiện này
        if (!blank($tuKhoa)) {
            $query->where(
                function($query) use ($tuKhoa) {
                    $query->where([
                        ['NAME', 'like', '%' . $tuKhoa . '%']
                    ])
                    ->orWhere([
                        ['NAME', 'like', '%' . $tuKhoa . '%']
                    ]);
                }
            );
            
        }

        if (!is_null($trangThaiHoatDong)) {
            $query->where([
                ['IS_ACTIVE', '=', $trangThaiHoatDong]
            ]);
        }
        
        if ($isApiPublic === true) {
            $query->where([
                ['IS_ACTIVE', true]
            ]);
        }
        
        $query->orderByRaw('
                CASE
                    WHEN SORT_ORDER IS NOT NULL THEN SORT_ORDER
                    ELSE 999999999
                END ASC
                , NAME ASC
            ')
            ->orderBy('CRT_DT', 'desc');
        $query = $query->paginate($perPage, ['*'], 'page', $page);
        return $query;
    }

    public function getDetailDanhMucSanPham(int $id)
    {
        return CategoryP::query()->where([
            ['STATUS', '=', AppConstant::STATUS_USING],
            ['ID', '=', $id]
        ])->first();
    }

    public function updateParentIdToNullById(int $id) {
        $query = CategoryP::where([
            ['PARENT_ID', '=', $id]
        ])->update(
            ['PARENT_ID' => null]
        );
    }
}
