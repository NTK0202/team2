<?php

namespace App\Repositories;

abstract class BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function get()
    {
        return $this->model->get();
    }

    public function store($value = [])
    {
        $this->model->fill($value);

        return $this->model->save();
    }

    public function find($id, $required = null)
    {
        if ($this->model->find($id)) {
            return $this->model->find($id);
        }

        return response()->json(['message'=>'This worksheet does not exist !']);
    }

    public function update($id, $value)
    {
        $result = $this->model->find($id);
        $result->fill($value);

        return $result->save();
    }

    public function delete($id)
    {
        if ($this->model->find($id)) {
            $this->model->find($id)->delete();

            return response()->json(["message" => "Delete permission successfully !"]);
        }

        return response()->json(["message" => "This permission does not exist"]);
    }
}
