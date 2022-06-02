<?php

namespace App\Services;

abstract class BaseService
{
    protected $repo;

    public function __construct()
    {
        $this->setRepository();
    }

    abstract public function getRepository();

    public function setRepository()
    {
        $this->repo = app()->make(
            $this->getRepository()
        );
    }

    public function get()
    {
        return $this->repo->get();
    }

    public function create($request)
    {
        return $this->repo->store($request->all());
    }

    public function validateParams($params)
    {
        (!preg_match($params, '/[0-9]*$/')) ? false : true;
    }

    public function find($id)
    {
        if ($this->validateParams($id)) {
            return $this->repo->find($id);
        }

        return response()->json(['message' => 'The param format is invalid.']);
    }

    public function update($id, $request)
    {
        return $this->repo->update($id, $request->all());
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
