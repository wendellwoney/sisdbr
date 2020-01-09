<?php

namespace Application\Model;

interface IModel
{
    public function getList();
    public function get($id);
    public function create($object);
    public function update($object);
    public function delete($id);
}