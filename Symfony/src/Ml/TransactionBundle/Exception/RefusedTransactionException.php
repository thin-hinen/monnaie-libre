<?php

namespace Ml\TransactionBundle\Exception;

class RefusedTransactionException extends TransactionException implements TransactionExceptionInterface {
    public function __construct($message=null, $code=0) {
        parent::__construct("Transaction refused : ".$message,$code);
    }
}


