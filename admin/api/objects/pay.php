<?php
class Pay {
    private $con;
    private $table_name = "pay";

    public $pay_id;
    public $bill_id;
    public $pay_date;
    public $total;
    public $paystatus;

    public function __construct($db) {
        $this->con = $db;
    }
    
    function delete(){
        $query_bill = "DELETE FROM bill WHERE bill_id= ?";
        $stmt_bill = $this->con->prepare($query_bill);
        $stmt_bill->bind_param('i', $this->bill_id);
    
        $query_billdes = "DELETE FROM billdes WHERE bill_id= ?";
        $stmt_billdes = $this->con->prepare($query_billdes);
        $stmt_billdes->bind_param('i', $this->bill_id);
    
        $this->con->begin_transaction();
        $bill_deleted = $stmt_bill->execute();
        $billdes_deleted = $stmt_billdes->execute();
    
        if ($bill_deleted && $billdes_deleted) {
            $this->con->commit();
            return true;
        } else {
            $this->con->rollback();
            return false;
        }
    }

    function pay_bill($pay_id){
        $query = "UPDATE ". $this->table_name ." SET paystatus = 'Paid' WHERE pay_id = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('i', $pay_id);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
