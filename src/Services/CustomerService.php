<?php

namespace Jalao\Services;

class CustomerService extends AbstractService
{
    public function create($params, $options = [])
    {
        return $this->request('POST', '/customers', $params, $options);
    }
}