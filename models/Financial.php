<?php
class Financial extends model
{

	public function getBillsList($limit, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM fn_paid_bills WHERE id_company = :id_company ORDER BY id DESC LIMIT $limit");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function filteredFinancial($param1, $param2, $period1, $period2, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM fn_paid_bills WHERE id_company = $id_company AND account_type BETWEEN '$param1' AND '$param2'  AND payday BETWEEN 
            '$period1' AND '$period2' ORDER BY id desc");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

	public function getBillsCount($id_company)
	{
		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) as pd FROM fn_paid_bills WHERE id_company = :id_company");
		$sql->bindValue('id_company', $id_company);
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['pd'];



		return $r;
	}

	public function addBills($description, $bill_amount, $account_type, $account_category, $supplier, $doc_number, $carrier, $aditional_info, $id_company)
	{

		$sql = $this->db->prepare("INSERT INTO fn_paid_bills SET description = :description, bill_amount = :bill_amount, amount_paid = :bill_amount, account_type = :account_type, account_category = :account_category, payday = NOW(), supplier = :supplier, doc_number = :doc_number, carrier = :carrier,  aditional_info = :aditional_info, id_company = :id_company");

		$sql->bindValue(":description", $description);
		$sql->bindValue(":bill_amount", $bill_amount);
		$sql->bindValue(":account_type", $account_type);
		$sql->bindValue(":account_category", $account_category);
		$sql->bindValue(":amount_paid", $bill_amount);
		$sql->bindValue(":supplier", $supplier);
		$sql->bindValue(":doc_number", $doc_number);
		$sql->bindValue(":carrier", $carrier);
		$sql->bindValue(":aditional_info", $aditional_info);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		$id_bill = $this->db->lastInsertId();
		$date = date("Ymd");

		$sql = $this->db->prepare("UPDATE fn_paid_bills SET id_transaction = concat($date, '3', $id_bill) WHERE id = $id_bill");
		$sql->execute();




	}
	/* PAYMENT METHODS */
	public function getPaymentMethodsList($id_company){
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM payment_methods WHERE id_company = :id_company");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

		return $array;

  }
  
  public function getPaymentMethodsInfo($id, $id_company){
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM payment_methods WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue("id_company", $id_company);
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}

		return $array;

	}

  public function addPaymentMethods($method, $type_method, $id_company)
  {

    $sql = $this->db->prepare("INSERT INTO payment_methods SET method = :method, type_method = :type_method, id_company = :id_company");

    $sql->bindValue(":method", $method);
	$sql->bindValue(":type_method", $type_method);
    $sql->bindValue(":id_company", $id_company);
    $sql->execute();
  }

  public function editPaymentMethods($id, $method, $type_method, $id_company) {

		$sql = $this->db->prepare("UPDATE payment_methods SET method = :method, type_method = :type_method WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":method", $method);
		$sql->bindValue(":type_method", $type_method);
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":id", $id);
		$sql->execute();

	}

  public function deletePaymentMethods($id, $id_company){
		$sql = $this->db->prepare("DELETE FROM payment_methods WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

  }
	/* CARRIER */
	public function getCarrierList($id_company)
	{
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM fn_carrier WHERE id_company = :id_company ORDER BY carrier_title ASC");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getCarrierInfo($id, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM fn_carrier WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue("id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function addCarrier($carrier_title, $id_company)
	{

		$sql = $this->db->prepare("INSERT INTO fn_carrier SET carrier_title = :carrier_title, id_company = :id_company");

		$sql->bindValue(":carrier_title", $carrier_title);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
	}

	public function editCarrier($id, $carrier_title, $id_company)
	{
		$sql = $this->db->prepare("UPDATE fn_carrier SET carrier_title = :carrier_title WHERE id = :id AND id_company = :id_company");

		$sql->bindValue(":id", $id);
		$sql->bindValue(":carrier_title", $carrier_title);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
	}

	public function deleteCarrier($id, $id_company)
	{
		$sql = $this->db->prepare("DELETE FROM fn_carrier WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
	}
	/* BANKCHECK */
	public function getBankCheckList($offset, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM bank_check WHERE in_box = '1' AND id_company = :id_company ORDER BY id DESC LIMIT $offset, 10");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getBankCheckListAll($offset, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM bank_check WHERE id_company = :id_company ORDER BY in_box ASC, id DESC LIMIT $offset, 10");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getBankCheckInfo($id, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM bank_check WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue("id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function getBankCheckCount($id_company)
	{
		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) as pd FROM bank_check WHERE in_box = '1' AND id_company = :id_company");
		$sql->bindValue('id_company', $id_company);
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['pd'];



		return $r;
	}

	public function getBankCheckCountAll($id_company)
	{
		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) as pd FROM bank_check WHERE id_company = :id_company");
		$sql->bindValue('id_company', $id_company);
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['pd'];



		return $r;
	}

	public function addBankCheck($name_check, $issuance_date, $due_date, $bank, $agency, $account_number, $check_number, $value_check, $in_box, $regarding, $aditional_info, $id_company)
	{

		$sql = $this->db->prepare("INSERT INTO bank_check SET name_check = :name_check, issuance_date = :issuance_date, due_date = :due_date, bank = :bank, agency = :agency, account_number = :account_number, check_number = :check_number, value_check = :value_check, in_box = :in_box, regarding = :regarding, aditional_info = :aditional_info, id_company = :id_company");

		$sql->bindValue(":name_check", $name_check);
		$sql->bindValue(":issuance_date", $issuance_date);
		$sql->bindValue(":due_date", $due_date);
		$sql->bindValue(":bank", $bank);
		$sql->bindValue(":agency", $agency);
		$sql->bindValue(":account_number", $account_number);
		$sql->bindValue(":check_number", $check_number);
		$sql->bindValue(":value_check", $value_check);
		$sql->bindValue(":in_box", $in_box);
		$sql->bindValue(":regarding", $regarding);
		$sql->bindValue(":aditional_info", $aditional_info);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
	}

	public function editBankCheck($id, $name_check, $issuance_date, $due_date, $bank, $agency, $account_number, $check_number, $value_check, $regarding, $aditional_info, $id_company)
	{

		$sql = $this->db->prepare("UPDATE bank_check SET name_check = :name_check, issuance_date = :issuance_date, due_date = :due_date, bank = :bank, agency = :agency, account_number = :account_number, check_number = :check_number, value_check = :value_check, regarding = :regarding, aditional_info = :aditional_info WHERE id = :id AND id_company = :id_company");

		$sql->bindValue(":name_check", $name_check);
		$sql->bindValue(":issuance_date", $issuance_date);
		$sql->bindValue(":due_date", $due_date);
		$sql->bindValue(":bank", $bank);
		$sql->bindValue(":agency", $agency);
		$sql->bindValue(":account_number", $account_number);
		$sql->bindValue(":check_number", $check_number);
		$sql->bindValue(":value_check", $value_check);
		$sql->bindValue(":regarding", $regarding);
		$sql->bindValue(":aditional_info", $aditional_info);
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	public function deleteBankCheck($id, $id_company)
	{
		$sql = $this->db->prepare("DELETE FROM bank_check WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
	}

	public function searchBankCheck($sp, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM bank_check WHERE name_check LIKE '%$sp%' OR check_number LIKE '%$sp%' ORDER BY in_box ASC, name_check ASC");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		return $array;
	}

	public function getBankCheckIssuedList($offset, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("
        SELECT 
            bank_check_issued.id,
            bank_check_issued.issued_to,
            bank_check_issued.issuance_date,
            bank_check_issued.due_date,
            bank_check_issued.value_check,
            bank_check_issued.cleared_check,
            fn_carrier.carrier_title
        FROM bank_check_issued 
        LEFT JOIN 
            fn_carrier ON bank_check_issued.id_bank = fn_carrier.id 
        WHERE
			bank_check_issued.cleared_check = '1' AND
			bank_check_issued.id_company = :id_company
            LIMIT $offset, 10");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getBankCheckIssuedListAll($offset, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("
        SELECT 
            bank_check_issued.id,
            bank_check_issued.issued_to,
            bank_check_issued.issuance_date,
            bank_check_issued.due_date,
            bank_check_issued.value_check,
            bank_check_issued.cleared_check,
            bank_check_issued.check_number,
            fn_carrier.carrier_title
        FROM bank_check_issued 
        LEFT JOIN 
            fn_carrier ON bank_check_issued.id_bank = fn_carrier.id 
        WHERE
			bank_check_issued.id_company = :id_company
		ORDER BY 
			bank_check_issued.cleared_check ASC,
			fn_carrier.carrier_title ASC
            LIMIT $offset, 10");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getBankCheckIssuedInfo($id, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("
		SELECT 
			bank_check_issued.id,
			bank_check_issued.issued_to,
			bank_check_issued.issuance_date,
			bank_check_issued.due_date,
			bank_check_issued.value_check,
			bank_check_issued.cleared_check,
			bank_check_issued.check_number,
			bank_check_issued.regarding,
			bank_check_issued.aditional_info,
			fn_carrier.carrier_title 
		FROM
			bank_check_issued
		LEFT JOIN
			fn_carrier ON bank_check_issued.id_bank = fn_carrier.id 
		WHERE 
			bank_check_issued.id = :id AND 
			bank_check_issued.id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue("id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function getBankCheckIssuedCount($id_company)
	{
		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) as pd FROM bank_check_issued WHERE cleared_check = '1' AND id_company = :id_company");
		$sql->bindValue('id_company', $id_company);
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['pd'];



		return $r;
	}

	public function getBankCheckIssuedCountAll($id_company)
	{
		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) as pd FROM bank_check_issued WHERE id_company = :id_company");
		$sql->bindValue('id_company', $id_company);
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['pd'];



		return $r;
	}

	public function addBankCheckIssued($issued_to, $id_bank, $issuance_date, $due_date, $value_check, $cleared_check, $check_number, $regarding, $aditional_info, $id_company)
	{

		$sql = $this->db->prepare("INSERT INTO bank_check_issued SET issued_to = :issued_to, id_bank = :id_bank, issuance_date = :issuance_date, due_date = :due_date, value_check = :value_check, cleared_check = :cleared_check, check_number = :check_number, regarding = :regarding, aditional_info = :aditional_info, id_company = :id_company");

		$sql->bindValue(":issued_to", $issued_to);
		$sql->bindValue(":id_bank", $id_bank);
		$sql->bindValue(":issuance_date", $issuance_date);
		$sql->bindValue(":due_date", $due_date);
		$sql->bindValue(":value_check", $value_check);
		$sql->bindValue(":cleared_check", $cleared_check);
		$sql->bindValue(":check_number", $check_number);
		$sql->bindValue(":regarding", $regarding);
		$sql->bindValue(":aditional_info", $aditional_info);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
	}

	public function editBankCheckIssued($id, $issued_to, $id_bank, $issuance_date, $due_date, $value_check, $check_number, $regarding, $aditional_info, $id_company)
	{

		$sql = $this->db->prepare("UPDATE bank_check_issued SET issued_to = :issued_to, id_bank = :id_bank, issuance_date = :issuance_date, due_date = :due_date, value_check = :value_check, check_number = :check_number, regarding = :regarding, aditional_info = :aditional_info WHERE id = :id AND id_company = :id_company");

		$sql->bindValue(":issued_to", $issued_to);
		$sql->bindValue(":id_bank", $id_bank);
		$sql->bindValue(":issuance_date", $issuance_date);
		$sql->bindValue(":due_date", $due_date);
		$sql->bindValue(":value_check", $value_check);
		$sql->bindValue(":check_number", $check_number);
		$sql->bindValue(":regarding", $regarding);
		$sql->bindValue(":aditional_info", $aditional_info);
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	public function deleteBankCheckIssued($id, $id_company)
	{
		$sql = $this->db->prepare("DELETE FROM bank_check_issued WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
	}

	public function changeStatusIssued($id, $clearing_date, $cleared_check, $id_company)
	{

		$sql = $this->db->prepare("UPDATE bank_check_issued SET clearing_date = :clearing_date, cleared_check = :cleared_check WHERE id = :id AND id_company = :id_company");

		$sql->bindValue(":id", $id);
		$sql->bindValue(":clearing_date", $clearing_date);
		$sql->bindValue(":cleared_check", $cleared_check);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
	}

	public function searchBankCheckIssued($sp, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("
        SELECT 
            bank_check_issued.id,
			bank_check_issued.id_bank,
            bank_check_issued.issued_to,
            bank_check_issued.issuance_date,
            bank_check_issued.due_date,
            bank_check_issued.value_check,
            bank_check_issued.cleared_check,
            bank_check_issued.check_number,
            fn_carrier.carrier_title
        FROM bank_check_issued 
        LEFT JOIN 
            fn_carrier ON fn_carrier.id = bank_check_issued.id_bank
        WHERE
			bank_check_issued.issued_to LIKE '%$sp%' OR
			bank_check_issued.check_number LIKE '%$sp%'
		ORDER BY 
			bank_check_issued.cleared_check ASC,
			fn_carrier.carrier_title ASC");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		return $array;
	}

	/* SINGLE RECEIPT */
	public function getListSingleReceipt($offset, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM single_receipt WHERE id_company = :id_company ORDER BY id DESC LIMIT $offset, 10");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getCountSingleReceipt($id_company)
	{
		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) as sr FROM single_receipt WHERE id_company = :id_company");
		$sql->bindValue('id_company', $id_company);
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['sr'];



		return $r;
	}

	public function getInfoSingleReceipt($id, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM single_receipt WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function addSingleReceipt($name, $receipt_amount, $regarding, $cpf, $identity, $id_company)
	{

		$sql = $this->db->prepare("INSERT INTO single_receipt SET name = :name, receipt_amount = :receipt_amount, regarding = :regarding, date_receipt = NOW(), cpf = :cpf, identity = :identity, id_company = :id_company");

		$sql->bindValue(":name", $name);
		$sql->bindValue(":receipt_amount", $receipt_amount);
		$sql->bindValue(":regarding", $regarding);
		$sql->bindValue(":cpf", $cpf);
		$sql->bindValue(":identity", $identity);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
	}

	public function editSingleReceipt($id, $name, $receipt_amount, $regarding, $cpf, $identity, $id_company)
	{
		$sql = $this->db->prepare("UPDATE single_receipt SET name = :name, receipt_amount = :receipt_amount, regarding = :regarding, cpf = :cpf, identity = :identity WHERE id = :id AND id_company = :id_company");

		$sql->bindValue(":id", $id);
		$sql->bindValue(":name", $name);
		$sql->bindValue(":receipt_amount", $receipt_amount);
		$sql->bindValue(":regarding", $regarding);
		$sql->bindValue(":cpf", $cpf);
		$sql->bindValue(":identity", $identity);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
	}


	public function deleteSingleReceipt($id, $id_company)
	{
		$sql = $this->db->prepare("DELETE FROM single_receipt WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
	}

	public function searchSingleReceipt($sp, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("SELECT name, receipt_amount, date_receipt, id FROM single_receipt WHERE name LIKE '%$sp%' ORDER BY name ASC");
		$sql->bindValue(":name", $sp . '%');
		$sql->bindValue(":receipt_amount", $sp . '%');
		$sql->bindValue(":date_receipt", $sp . '%');
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		return $array;
	}

	/* ACCOUNTS PAYABLE */
	public function getAccountsPayableInfo($id, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM fn_accounts_payable WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue("id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function getListAccountsPayable($offset, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM fn_accounts_payable WHERE id_company = :id_company AND payment_status = '1' ORDER BY id DESC LIMIT $offset, 10");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getListAccountsPayableAll($offset, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM fn_accounts_payable WHERE id_company = :id_company ORDER BY id DESC LIMIT $offset, 10");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getCountAccountsPayable($id_company)
	{
		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) as sr FROM fn_accounts_payable WHERE id_company = :id_company");
		$sql->bindValue('id_company', $id_company);
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['sr'];



		return $r;
	}

	public function addAccountsPayable($description, $bill_amount, $account_category, $release_date_of, $due_date, $supplier, $doc_number, $aditional_info, $id_company)
	{

		$sql = $this->db->prepare("INSERT INTO fn_accounts_payable SET description = :description, bill_amount = :bill_amount, account_category = :account_category, release_date_of = :release_date_of, due_date = :due_date, supplier = :supplier, doc_number = :doc_number, payment_status = '1', aditional_info = :aditional_info, id_company = :id_company");

		$sql->bindValue(":description", $description);
		$sql->bindValue(":bill_amount", $bill_amount);
		$sql->bindValue(":account_category", $account_category);
		$sql->bindValue(":release_date_of", $release_date_of);
		$sql->bindValue(":due_date", $due_date);
		$sql->bindValue(":supplier", $supplier);
		$sql->bindValue(":doc_number", $doc_number);
		$sql->bindValue(":aditional_info", $aditional_info);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
	}

	public function editAccountsPayable($id, $description, $bill_amount, $account_category, $release_date_of, $due_date, $supplier, $doc_number, $aditional_info, $id_company)
	{
		$sql = $this->db->prepare("UPDATE fn_accounts_payable SET description = :description, bill_amount = :bill_amount, account_category = :account_category, release_date_of = :release_date_of, due_date = :due_date, supplier = :supplier, doc_number = :doc_number, aditional_info = :aditional_info WHERE id = :id AND id_company = :id_company");

		$sql->bindValue(":id", $id);
		$sql->bindValue(":description", $description);
		$sql->bindValue(":bill_amount", $bill_amount);
		$sql->bindValue(":account_category", $account_category);
		$sql->bindValue(":release_date_of", $release_date_of);
		$sql->bindValue(":due_date", $due_date);
		$sql->bindValue(":supplier", $supplier);
		$sql->bindValue(":doc_number", $doc_number);
		$sql->bindValue(":aditional_info", $aditional_info);
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
	}

	public function deleteAccountsPayable($id, $id_company)
	{
		$sql = $this->db->prepare("DELETE FROM fn_accounts_payable WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
	}

	public function getViewAccountsPayable($id, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("
		SELECT 
              fn_accounts_payable.id, 
              fn_accounts_payable.supplier, 
              fn_accounts_payable.description, 
              fn_accounts_payable.bill_amount, 
              fn_accounts_payable.doc_number, 
			  fn_accounts_payable.payday,
              fn_accounts_payable.release_date_of, 
              fn_accounts_payable.due_date, 
              fn_accounts_payable.account_category, 
              fn_accounts_payable.id_transaction,
			  fn_accounts_payable.payment_status, 
              fn_accounts_payable.aditional_info, 
              provider.name_provider
        FROM fn_accounts_payable
        LEFT JOIN provider ON fn_accounts_payable.supplier = provider.id
        WHERE
			fn_accounts_payable.id = :id AND
			fn_accounts_payable.id_company = :id_company
        ");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function topayoffAccountsPayable($id, $amount_paid, $payday, $carrier, $id_company)
	{

		$date = date("Ymd");
		$sql = $this->db->prepare("UPDATE fn_accounts_payable SET amount_paid = :amount_paid, payday = :payday, payment_status = '2', id_transaction = concat($date, '1', $id) WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":amount_paid", $amount_paid);
		$sql->bindValue(":payday", $payday);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		$sql = $this->db->prepare("INSERT INTO fn_paid_bills (description, bill_amount, amount_paid, account_type, account_category, payday, supplier, doc_number, carrier, id_transaction, id_company)
		SELECT description, bill_amount, amount_paid, 2, account_category, payday, supplier, doc_number, $carrier, id_transaction, id_company FROM fn_accounts_payable WHERE id = '$id'");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":amount_paid", $amount_paid);
		$sql->bindValue(":payday", $payday);
		$sql->bindValue(":carrier", $carrier);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
	}

	/* ACCOUNTS RECEIVABLE */
	public function getAccountsReceivableInfo($id, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM fn_accounts_receivable WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue("id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function getListAccountsReceivable($offset, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM fn_accounts_receivable WHERE id_company = :id_company AND payment_status = '1' ORDER BY id DESC LIMIT $offset, 10");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getListAccountsReceivableAll($offset, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM fn_accounts_receivable WHERE id_company = :id_company ORDER BY id DESC LIMIT $offset, 10");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getCountAccountsReceivable($id_company)
	{
		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) as sr FROM fn_accounts_receivable WHERE id_company = :id_company");
		$sql->bindValue('id_company', $id_company);
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['sr'];



		return $r;
	}

	public function addAccountsReceivable($description, $bill_amount, $account_category, $release_date_of, $due_date, $client_name, $doc_number, $aditional_info, $id_company)
	{

		$sql = $this->db->prepare("INSERT INTO fn_accounts_receivable SET description = :description, bill_amount = :bill_amount, account_category = :account_category, release_date_of = :release_date_of, due_date = :due_date, client_name = :client_name, doc_number = :doc_number, payment_status = '1',aditional_info = :aditional_info, id_company = :id_company");

		$sql->bindValue(":description", $description);
		$sql->bindValue(":bill_amount", $bill_amount);
		$sql->bindValue(":account_category", $account_category);
		$sql->bindValue(":release_date_of", $release_date_of);
		$sql->bindValue(":due_date", $due_date);
		$sql->bindValue(":client_name", $client_name);
		$sql->bindValue(":doc_number", $doc_number);
		$sql->bindValue(":aditional_info", $aditional_info);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
	}

	public function editAccountsReceivable($id, $description, $bill_amount, $account_category, $release_date_of, $due_date, $client_name, $doc_number, $aditional_info, $id_company)
	{
		$sql = $this->db->prepare("UPDATE fn_accounts_receivable SET description = :description, bill_amount = :bill_amount, account_category = :account_category, release_date_of = :release_date_of, due_date = :due_date, client_name = :client_name, doc_number = :doc_number, aditional_info = :aditional_info WHERE id = :id AND id_company = :id_company");

		$sql->bindValue(":id", $id);
		$sql->bindValue(":description", $description);
		$sql->bindValue(":bill_amount", $bill_amount);
		$sql->bindValue(":account_category", $account_category);
		$sql->bindValue(":release_date_of", $release_date_of);
		$sql->bindValue(":due_date", $due_date);
		$sql->bindValue(":client_name", $client_name);
		$sql->bindValue(":doc_number", $doc_number);
		$sql->bindValue(":aditional_info", $aditional_info);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
	}

	public function deleteAccountsReceivable($id, $id_company)
	{
		$sql = $this->db->prepare("DELETE FROM fn_accounts_receivable WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
	}

	public function getViewAccountsReceivable($id, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("
		SELECT 
			fn_accounts_receivable.id, 
			fn_accounts_receivable.client_name, 
			fn_accounts_receivable.description, 
			fn_accounts_receivable.bill_amount, 
			fn_accounts_receivable.doc_number, 
			fn_accounts_receivable.release_date_of, 
			fn_accounts_receivable.due_date, 
			fn_accounts_receivable.account_category, 
			fn_accounts_receivable.id_transaction, 
			fn_accounts_receivable.payment_status, 
			fn_accounts_receivable.aditional_info, 
            clients.client_name
        FROM fn_accounts_receivable
        	LEFT JOIN clients ON fn_accounts_receivable.client_name = clients.id
        WHERE
			fn_accounts_receivable.id = :id AND
			fn_accounts_receivable.id_company = :id_company
        ");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function topayoffAccountsReceivable($id, $amount_paid, $payday, $id_company)
	{

		$date = date("Ymd");
		$sql = $this->db->prepare("UPDATE fn_accounts_receivable SET amount_paid = :amount_paid, payday = :payday, payment_status = '2', id_transaction = concat($date, '1', $id) WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":amount_paid", $amount_paid);
		$sql->bindValue(":payday", $payday);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		$sql = $this->db->prepare("INSERT INTO fn_paid_bills (description, bill_amount, amount_paid, account_type, account_category, payday, id_transaction, id_company)
		SELECT description, bill_amount, amount_paid, 1, account_category, payday, id_transaction, id_company FROM fn_accounts_receivable WHERE id = '$id'");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":amount_paid", $amount_paid);
		$sql->bindValue(":payday", $payday);
		// $sql->bindValue(":carrier", $carrier);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();	
	}

	/* COMISSIONS */
	public function getListComissions($offset, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("
		SELECT 
			fn_comissions.id, 
			fn_comissions.schedule_number, 
			fn_comissions.bill_amount, 
			fn_comissions.supplier, 
			fn_comissions.accounts_payable_number,
            provider.name_provider,
			fn_accounts_payable.payment_status,
			fn_accounts_payable.id
        FROM fn_comissions
        LEFT JOIN 
			provider ON fn_comissions.supplier = provider.id
        LEFT JOIN 
			fn_accounts_payable ON fn_comissions.accounts_payable_number = fn_accounts_payable.id
        WHERE
			fn_accounts_payable.payment_status = 1 AND
			fn_comissions.id_company = :id_company
		LIMIT $offset, 10
        ");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getListComissionsAll($id_company)
	{
		$array = array();

		$sql = $this->db->prepare("
		SELECT 
			fn_comissions.id, 
			fn_comissions.schedule_number, 
			fn_comissions.bill_amount, 
			fn_comissions.supplier, 
			fn_comissions.accounts_payable_number,
            provider.name_provider,
			fn_accounts_payable.payment_status,
			fn_accounts_payable.id
        FROM fn_comissions
        LEFT JOIN 
			provider ON fn_comissions.supplier = provider.id
        LEFT JOIN 
			fn_accounts_payable ON fn_comissions.accounts_payable_number = fn_accounts_payable.id
        WHERE
			fn_comissions.id_company = :id_company
        ");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getComissionsFiltered($period1, $period2, $where_provider, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("
        SELECT 
            fn_comissions.id,
            fn_comissions.schedule_number,
            fn_comissions.bill_amount,
            fn_comissions.supplier,
            fn_comissions.accounts_payable_number,
			fn_comissions.date_comission,
            provider.name_provider
        FROM 
            fn_comissions 
        LEFT JOIN 
            provider ON fn_comissions.supplier = provider.id 
        WHERE 
			$where_provider
            fn_comissions.id_company = :id_company 
		AND fn_comissions.date_comission BETWEEN '$period1' 
                AND '$period2' 
        ORDER BY 
			fn_comissions.id desc
        ");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

	public function getCountComissions($id_company)
	{
		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) as pd FROM fn_comissions WHERE id_company = :id_company");
		$sql->bindValue('id_company', $id_company);
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['pd'];



		return $r;
	}
}
