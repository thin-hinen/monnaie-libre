<?php

namespace Ml\TransactionBundle\Exception;

class TransactionException extends Exception {
    public function __construct($message=null, $code=0) {
        parent::__construct($message,$code);
    }
}

class RefusedTransactionException extends Exception {
    public function __construct($message=null, $code=0) {
        parent::__construct("Transaction refused : ".$message,$code);
    }
}


