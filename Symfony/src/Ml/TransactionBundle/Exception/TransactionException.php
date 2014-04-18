<?php

namespace Ml\TransactionBundle\Exception;

interface TransactionExceptionInterface {}

class TransactionException extends \Exception implements TransactionExceptionInterface {
    public function __construct($message=null, $code=0) {
        parent::__construct($message,$code);
    }
}

