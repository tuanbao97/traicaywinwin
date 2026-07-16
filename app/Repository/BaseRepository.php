<?php

namespace App\Repository;

use App\Enum\AppConstant;

abstract class BaseRepository implements RepositoryInterface
{
    //model muốn tương tác
    protected $model;

    //khởi tạo
    public function __construct()
    {
        $this->setModel();
    }

    public function setModel() {
        $this->model = app()->make(
            $this->getModel()    
        );
    }

    //lấy model tương ứng
    abstract public function getModel();

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes, $primaryKey = 'ID')
    {
        $result = $this->find($id, $primaryKey);
        if (!$result) {
            return null;
        }
        $result->update($attributes);
        return $result;
        
    }

    public function find($id, $primaryKey = 'ID')
    {
        return $this->model->whereIn('STATUS', [
                AppConstant::STATUS_USING,
                AppConstant::STATUS_SOLD
            ])->where($primaryKey, '=', $id)
            ->first();
    }

    public function save(array $attributes, $primaryKey = 'ID')
    {
        if (! array_key_exists($primaryKey, $attributes) || is_null($attributes[$primaryKey])) {
            return $this->create($attributes);
        }

        $id = $attributes[$primaryKey];
        $result = $this->update($id, $attributes, $primaryKey);
        if ($result === null) {
            return null;
        }

        // update() có thể trả về model; đảm bảo luôn trả entity sau khi lưu
        if ($result instanceof \Illuminate\Database\Eloquent\Model) {
            return $result;
        }

        return $this->find($id, $primaryKey);
    }


}
