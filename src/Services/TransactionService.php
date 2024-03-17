<?php

namespace Jalao\Services;

class TransactionService extends AbstractService
{
    public function charge($params, $options = [])
    {
        return $this->request('POST', '/transactions/charge', $params, $options);
    }
}