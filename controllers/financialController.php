<?php
class financialController extends controller
{
	public function __construct()
	{

		$u = new Users();
		if ($u->isLogged() == false) {
			header("Location: " . BASE_URL . "login");
			exit;
		}
	}

	public function index()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_view')) {
			$fn = new Financial();
			$pd = new Provider();

			$limit = 30;

			$data['bills_list'] = $fn->getBillsList($limit, $u->getCompany());


			$this->loadTemplate('fn_financial', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function bills_add()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_add')) {
			$fn = new Financial();
			$pd = new Provider();

			if (isset($_POST['description']) && !empty($_POST['description'])) {


				$description = addslashes($_POST['description']);
				$bill_amount = addslashes($_POST['bill_amount']);
				$account_type = addslashes($_POST['account_type']);
				$account_category = addslashes($_POST['account_category']);
				$supplier = addslashes($_POST['supplier']);
				$doc_number = addslashes($_POST['doc_number']);
				$carrier = addslashes($_POST['carrier']);
				$aditional_info = addslashes($_POST['aditional_info']);

				$bill_amount = str_replace('.', '', $bill_amount);
				$bill_amount = str_replace(',', '.', $bill_amount);

				$fn->addBills($description, $bill_amount, $account_type, $account_category, $supplier, $doc_number, $carrier, $aditional_info, $u->getCompany());

				header("Location: " . BASE_URL . "financial");
			}

			$data['provider_list'] = $pd->getListProvider($u->getCompany());
			$data['carrier_list'] = $fn->getCarrierList($u->getCompany());
			$this->loadTemplate('fn_bills_add', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function financial_filter()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_view')) {
			$fn = new Financial();

			$account_type = addslashes($_GET['account_type']);
			$period1 = addslashes($_GET['period1']);
			$period2 = addslashes($_GET['period2']);

			if ($account_type == '1') {
				$param1 = 1;
				$param2 = 1;
			}
			elseif ($account_type == '2') {
				$param1 = 2;
				$param2 = 2;
			} else {
				$param1 = 1;
				$param2 = 2;
			}


			$data['edit_permission'] = $u->hasPermission('worthemployee_edit');
			$data['filter_list'] = $fn->filteredFinancial($param1, $param2, $period1, $period2, $u->getCompany());

			$this->loadTemplate('fn_financial_filter', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function settings()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_settings')) {
			$fn = new Financial();


			$this->loadTemplate('fn_settings', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function settings_edit()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_settings')) {
			$fn = new Financial();


			$this->loadTemplate('fn_settings_edit', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	/* PAYMENT METHODS */
	public function paymentmethods()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('payment_methods')) {
			$fn = new Financial();

			$data['payment_method_list'] = $fn->getPaymentMethodsList($u->getCompany());

			$this->loadTemplate('fn_payment_methods', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function add_payment_methods()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('payment_methods')) {

			if (isset($_POST['method']) && !empty($_POST['method'])) {
				$fn = new Financial();

				$method = addslashes($_POST['method']);
				$type_method = addslashes($_POST['type_method']);

				$fn->addPaymentMethods($method, $type_method, $u->getCompany());

				header("Location: " . BASE_URL . "financial/paymentmethods");
			}

			$this->loadTemplate('fn_payment_methods_add', $data);
		}
	}

	public function edit_payment_methods($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('payment_methods')) {
			$fn = new Financial();

			if (isset($_POST['method']) && !empty($_POST['method'])) {
				$method = addslashes($_POST['method']);
				$type_method = addslashes($_POST['type_method']);

				$fn->editPaymentMethods($id, $method, $type_method, $u->getCompany());

				header("Location: " . BASE_URL . "financial/paymentmethods");
			}

			$data['payment_method_info'] = $fn->getPaymentMethodsInfo($id, $u->getCompany());


			$this->loadTemplate('fn_payment_methods_edit', $data);
		}
	}

	public function delete_payment_methods($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('payment_methods')) {
			$fn = new Financial();

			$fn->deletePaymentMethods($id, $u->getCompany());
			header("Location: " . BASE_URL . "financial/paymentmethods");


			$this->loadTemplate('fn_paymentmethods', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}
	/* CARRIER */

	public function settingscarrier()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_settings')) {
			$fn = new Financial();

			$data['carrier_list'] = $fn->getCarrierList($u->getCompany());
			$this->loadTemplate('fn_settings_carrier', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function carrieradd()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_settings')) {
			$fn = new Financial();

			if (isset($_POST['carrier_title']) && !empty($_POST['carrier_title'])) {

				$carrier_title = addslashes($_POST['carrier_title']);

				$fn->addCarrier($carrier_title, $u->getCompany());

				header("Location: " . BASE_URL . "financial/settingscarrier");
			}


			$this->loadTemplate('fn_carrier_add', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function carrieredit($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_settings')) {
			$fn = new Financial();

			if (isset($_POST['carrier_title']) && !empty($_POST['carrier_title'])) {

				$carrier_title = addslashes($_POST['carrier_title']);

				$fn->editCarrier($id, $carrier_title, $u->getCompany());

				header("Location: " . BASE_URL . "financial/settingscarrier");
			}
			$data['carrier_info'] = $fn->getCarrierInfo($id, $u->getCompany());

			$this->loadTemplate('fn_carrier_edit', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function carrierdelete($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_settings')) {
			$fn = new Financial();

			$fn->deleteCarrier($id, $u->getCompany());
			header("Location: " . BASE_URL . "financial/settingscarrier");


			$this->loadTemplate('financial/settingscarrier', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function bankcheck()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('bank_check_view')) {
			$fn = new Financial();
			$offset =  0;

			$data['p'] = 1;
			if (isset($_GET['p']) && !empty($_GET['p'])) {
				$data['p'] = intval($_GET['p']);
				if ($data['p'] == 0) {
					$data['p'] = 1;
				}
			}

			$offset = (10 * ($data['p'] - 1));

			$data['check_list'] = $fn->getBankCheckList($offset, $u->getCompany());
			$data['check_count'] = $fn->getBankCheckCount($u->getCompany());
			$data['p_count'] = ceil($data['check_count'] / 10);

			$this->loadTemplate('fn_bank_check', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function bankcheck_list()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('bank_check_view')) {
			$fn = new Financial();
			$offset =  0;

			$data['p'] = 1;
			if (isset($_GET['p']) && !empty($_GET['p'])) {
				$data['p'] = intval($_GET['p']);
				if ($data['p'] == 0) {
					$data['p'] = 1;
				}
			}

			$offset = (10 * ($data['p'] - 1));

			$data['check_list'] = $fn->getBankCheckListAll($offset, $u->getCompany());
			$data['check_count'] = $fn->getBankCheckCountAll($u->getCompany());
			$data['p_count'] = ceil($data['check_count'] / 10);

			$this->loadTemplate('fn_bank_check_list', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function bankcheck_add()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('bank_check_edit')) {

			if (isset($_POST['name_check']) && !empty($_POST['name_check'])) {
				$fn = new Financial();

				$name_check = addslashes($_POST['name_check']);
				$issuance_date = addslashes($_POST['issuance_date']);
				$due_date = addslashes($_POST['due_date']);
				$bank = addslashes($_POST['bank']);
				$agency = addslashes($_POST['agency']);
				$account_number = addslashes($_POST['account_number']);
				$check_number = addslashes($_POST['check_number']);
				$value_check = addslashes($_POST['value_check']);
				$regarding = addslashes($_POST['regarding']);
				$aditional_info = addslashes($_POST['aditional_info']);
				$in_box = '1';

				$issuance_date = implode("-", array_reverse(explode("/", $issuance_date)));
				$due_date = implode("-", array_reverse(explode("/", $due_date)));

				$value_check = str_replace('.', '', $value_check);
				$value_check = str_replace(',', '.', $value_check);

				$fn->addBankCheck($name_check, $issuance_date, $due_date, $bank, $agency, $account_number, $check_number, $value_check, $in_box, $regarding, $aditional_info, $u->getCompany());

				header("Location: " . BASE_URL . "financial/bankcheck");
			}

			$this->loadTemplate('fn_bank_check_add', $data);
		}
	}

	public function bankcheck_edit($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('bank_check_edit')) {
			$fn = new Financial();

			if (isset($_POST['name_check']) && !empty($_POST['name_check'])) {
				$name_check = addslashes($_POST['name_check']);
				$issuance_date = addslashes($_POST['issuance_date']);
				$due_date = addslashes($_POST['due_date']);
				$bank = addslashes($_POST['bank']);
				$agency = addslashes($_POST['agency']);
				$account_number = addslashes($_POST['account_number']);
				$check_number = addslashes($_POST['check_number']);
				$value_check = addslashes($_POST['value_check']);
				$regarding = addslashes($_POST['regarding']);
				$aditional_info = addslashes($_POST['aditional_info']);

				$value_check = str_replace('.', '', $value_check);
				$value_check = str_replace(',', '.', $value_check);

				$fn->editBankCheck($id, $name_check, $issuance_date, $due_date, $bank, $agency, $account_number, $check_number, $value_check, $regarding, $aditional_info, $u->getCompany());

				header("Location: " . BASE_URL . "financial/bankcheck");
			}

			$data['check_info'] = $fn->getBankCheckInfo($id, $u->getCompany());


			$this->loadTemplate('fn_bank_check_edit', $data);
		}
	}

	public function bankcheck_delete($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('bank_check_edit')) {
			$fn = new Financial();

			$fn->deleteBankCheck($id, $u->getCompany());
			header("Location: " . BASE_URL . "financial/bankcheck");


			$this->loadTemplate('bankcheck', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function bankcheck_view($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('bank_check_view')) {
			$fn = new Financial();

			$data['check_info'] = $fn->getBankCheckInfo($id, $u->getCompany());
			$data['edit_permission'] = $u->hasPermission('bank_check_edit');

			$this->loadTemplate('fn_bank_check_view', $data);
		}
	}

	public function bankcheck_search()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('bank_check_view')) {
			$fn = new Financial();

			$sp = addslashes($_GET['sp']);


			$data['check_list'] = $fn->searchBanKCheck($sp, $u->getCompany());
			$data['edit_permission'] = $u->hasPermission('bank_check_edit');
			$this->loadTemplate('fn_bank_check_search', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function bankcheck_issued()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('bank_check_view')) {
			$fn = new Financial();
			$offset =  0;

			$data['p'] = 1;
			if (isset($_GET['p']) && !empty($_GET['p'])) {
				$data['p'] = intval($_GET['p']);
				if ($data['p'] == 0) {
					$data['p'] = 1;
				}
			}

			$offset = (10 * ($data['p'] - 1));

			$data['check_list'] = $fn->getBankCheckIssuedList($offset, $u->getCompany());
			$data['check_count'] = $fn->getBankCheckIssuedCount($u->getCompany());
			$data['p_count'] = ceil($data['check_count'] / 10);

			$this->loadTemplate('fn_bank_check_issued', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function bankcheck_issuedlist()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('bank_check_view')) {
			$fn = new Financial();
			$offset =  0;

			$data['p'] = 1;
			if (isset($_GET['p']) && !empty($_GET['p'])) {
				$data['p'] = intval($_GET['p']);
				if ($data['p'] == 0) {
					$data['p'] = 1;
				}
			}

			$offset = (10 * ($data['p'] - 1));

			$data['check_list'] = $fn->getBankCheckIssuedListAll($offset, $u->getCompany());
			$data['check_count'] = $fn->getBankCheckIssuedCountAll($u->getCompany());
			$data['p_count'] = ceil($data['check_count'] / 10);

			$this->loadTemplate('fn_bank_check_issued_list', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function bankcheck_issuedadd()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('bank_check_edit')) {
			$fn = new Financial();

			if (isset($_POST['issued_to']) && !empty($_POST['issued_to'])) {
				$issued_to = addslashes($_POST['issued_to']);
				$id_bank = addslashes($_POST['id_bank']);
				$issuance_date = addslashes($_POST['issuance_date']);
				$due_date = addslashes($_POST['due_date']);
				$value_check = addslashes($_POST['value_check']);
				$check_number = addslashes($_POST['check_number']);
				$regarding = addslashes($_POST['regarding']);
				$aditional_info = addslashes($_POST['aditional_info']);
				$cleared_check = '1';

				$value_check = str_replace('.', '', $value_check);
				$value_check = str_replace(',', '.', $value_check);

				$fn->addBankCheckIssued($issued_to, $id_bank, $issuance_date, $due_date, $value_check, $cleared_check, $check_number, $regarding, $aditional_info, $u->getCompany());

				header("Location: " . BASE_URL . "financial/bankcheck_issued");
			}

			$data['carrier_list'] = $fn->getCarrierList($u->getCompany());
			$this->loadTemplate('fn_bank_check_issued_add', $data);
		}
	}

	public function bankcheck_issuededit($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('bank_check_edit')) {
			$fn = new Financial();

			if (isset($_POST['issued_to']) && !empty($_POST['issued_to'])) {
				$issued_to = addslashes($_POST['issued_to']);
				$id_bank = addslashes($_POST['id_bank']);
				$issuance_date = addslashes($_POST['issuance_date']);
				$due_date = addslashes($_POST['due_date']);
				$value_check = addslashes($_POST['value_check']);
				$check_number = addslashes($_POST['check_number']);
				$regarding = addslashes($_POST['regarding']);
				$aditional_info = addslashes($_POST['aditional_info']);

				$value_check = str_replace('.', '', $value_check);
				$value_check = str_replace(',', '.', $value_check);

				$fn->editBankCheckIssued($id, $issued_to, $id_bank, $issuance_date, $due_date, $value_check, $check_number, $regarding, $aditional_info, $u->getCompany());

				header("Location: " . BASE_URL . "financial/bankcheck_issued");
			}

			$data['issued_info'] = $fn->getBankCheckIssuedInfo($id, $u->getCompany());
			$data['carrier_list'] = $fn->getCarrierList($u->getCompany());


			$this->loadTemplate('fn_bank_check_issued_edit', $data);
		}
	}

	public function bankcheck_issuedview($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('bank_check_view')) {
			$fn = new Financial();

			$data['check_info'] = $fn->getBankCheckIssuedInfo($id, $u->getCompany());
			$data['edit_permission'] = $u->hasPermission('bank_check_edit');

			$this->loadTemplate('fn_bank_check_issued_view', $data);
		}
	}


	public function bankcheck_issueddelete($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('bank_check_edit')) {
			$fn = new Financial();

			$fn->deleteBankCheckIssued($id, $u->getCompany());
			header("Location: " . BASE_URL . "financial/bankcheck_issued");


			$this->loadTemplate('bankcheck', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function bankcheck_issueddeposit($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('bank_check_edit')) {
			$fn = new Financial();

			if (isset($_POST['clearing_date']) && !empty($_POST['clearing_date'])) {
				$clearing_date = addslashes($_POST['clearing_date']);
				$cleared_check = '2';

				$fn->changeStatusIssued($id, $clearing_date, $cleared_check, $u->getCompany());

				header("Location: " . BASE_URL . "financial/bankcheck_issued");
			}

			$data['issued_info'] = $fn->getBankCheckIssuedInfo($id, $u->getCompany());
			$data['carrier_list'] = $fn->getCarrierList($u->getCompany());


			$this->loadTemplate('fn_bank_check_issued', $data);
		}
	}

	public function bankissued_search()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('bank_check_view')) {
			$fn = new Financial();

			$sp = addslashes($_GET['sp']);


			$data['check_list'] = $fn->searchBanKCheckIssued($sp, $u->getCompany());
			$data['edit_permission'] = $u->hasPermission('bank_check_edit');
			$this->loadTemplate('fn_bank_check_issued_search', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	/* SINGLE RECEIPT */
	public function singlereceipt()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('singlereceipt_view')) {
			$fn = new Financial();
			$offset =  0;

			$data['p'] = 1;
			if (isset($_GET['p']) && !empty($_GET['p'])) {
				$data['p'] = intval($_GET['p']);
				if ($data['p'] == 0) {
					$data['p'] = 1;
				}
			}

			$data['single_receipt_list'] = $fn->getListSingleReceipt($offset, $u->getCompany());
			$data['single_receipt_count'] = $fn->getCountSingleReceipt($u->getCompany());
			$data['p_count'] = ceil($data['single_receipt_count'] / 10);
			$data['edit_permission'] = $u->hasPermission('singlereceipt_edit');

			$this->loadTemplate('fn_single_receipt', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function singlereceipt_add()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('singlereceipt_view')) {
			$fn = new Financial();

			if (isset($_POST['name']) && !empty($_POST['name'])) {

				$name = addslashes($_POST['name']);
				$receipt_amount = addslashes($_POST['receipt_amount']);
				$regarding = addslashes($_POST['regarding']);
				$cpf = addslashes($_POST['cpf']);
				$identity = addslashes($_POST['identity']);

				$receipt_amount = str_replace('.', '', $receipt_amount);
				$receipt_amount = str_replace(',', '.', $receipt_amount);


				$fn->addSingleReceipt($name, $receipt_amount, $regarding, $cpf, $identity, $u->getCompany());

				header("Location: " . BASE_URL . "financial/singlereceipt");
			}
			$this->loadTemplate('fn_single_receipt_add', $data);
		}
	}

	public function singlereceipt_edit($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('singlereceipt_edit')) {
			$fn = new Financial();

			if (isset($_POST['name']) && !empty($_POST['name'])) {
				$name = addslashes($_POST['name']);
				$receipt_amount = addslashes($_POST['receipt_amount']);
				$regarding = addslashes($_POST['regarding']);
				$cpf = addslashes($_POST['cpf']);
				$identity = addslashes($_POST['identity']);

				$receipt_amount = str_replace('.', '', $receipt_amount);
				$receipt_amount = str_replace(',', '.', $receipt_amount);


				$fn->editSingleReceipt($id, $name, $receipt_amount, $regarding, $cpf, $identity, $u->getCompany());

				header("Location: " . BASE_URL . "financial/singlereceipt");
			}

			$data['singlereceipt_info'] = $fn->getInfoSingleReceipt($id, $u->getCompany());


			$this->loadTemplate('fn_single_receipt_edit', $data);
		}
	}

	public function singlereceipt_delete($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('singlereceipt_edit')) {
			$fn = new Financial();

			$fn->deleteSingleReceipt($id, $u->getCompany());
			header("Location: " . BASE_URL . "financial/singlereceipt");


			$this->loadTemplate('fn_singlereceipt', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function singlereceipt_view($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('singlereceipt_view')) {
			$fn = new Financial();

			$data['singlereceipt_info'] = $fn->getInfoSingleReceipt($id, $u->getCompany());

			$this->loadTemplate('fn_single_receipt_view', $data);
		}
	}

	public function singlereceipt_search()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('human_resources_view')) {
			$fn = new Financial();

			$sp = addslashes($_GET['sp']);


			$data['single_receipt_list'] = $fn->searchSingleReceipt($sp, $u->getCompany());
			$data['edit_permission'] = $u->hasPermission('human_resources_edit');
			$this->loadTemplate('fn_single_receipt_search', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	/* ACCOUNTS PAYABLE */
	public function accountspayable()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_view')) {
			$fn = new Financial();
			$offset =  0;

			$data['p'] = 1;
			if (isset($_GET['p']) && !empty($_GET['p'])) {
				$data['p'] = intval($_GET['p']);
				if ($data['p'] == 0) {
					$data['p'] = 1;
				}
			}

			$data['accounts_payable_list'] = $fn->getListAccountsPayable($offset, $u->getCompany());
			$data['accounts_payable_count'] = $fn->getCountAccountsPayable($u->getCompany());
			$data['p_count'] = ceil($data['accounts_payable_count'] / 10);
			$data['edit_permission'] = $u->hasPermission('singlereceipt_edit');

			$this->loadTemplate('fn_accounts_payable', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function accountspayable_listall()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_view')) {
			$fn = new Financial();
			$offset =  0;

			$data['p'] = 1;
			if (isset($_GET['p']) && !empty($_GET['p'])) {
				$data['p'] = intval($_GET['p']);
				if ($data['p'] == 0) {
					$data['p'] = 1;
				}
			}

			$data['accounts_payable_list'] = $fn->getListAccountsPayableAll($offset, $u->getCompany());
			$data['accounts_payable_count'] = $fn->getCountAccountsPayable($u->getCompany());
			$data['p_count'] = ceil($data['accounts_payable_count'] / 10);
			$data['edit_permission'] = $u->hasPermission('singlereceipt_edit');

			$this->loadTemplate('fn_accounts_payable_listall', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function accountspayable_add()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_add')) {
			$fn = new Financial();
			$pd = new Provider();

			if (isset($_POST['description']) && !empty($_POST['description'])) {
				$description = addslashes($_POST['description']);
				$bill_amount = addslashes($_POST['bill_amount']);
				$account_category = addslashes($_POST['account_category']);
				$release_date_of = addslashes($_POST['release_date_of']);
				$due_date = addslashes($_POST['due_date']);
				$supplier = addslashes($_POST['supplier']);
				$doc_number = addslashes($_POST['doc_number']);
				$aditional_info = addslashes($_POST['aditional_info']);

				$bill_amount = str_replace('.', '', $bill_amount);
				$bill_amount = str_replace(',', '.', $bill_amount);

				$fn->addAccountsPayable($description, $bill_amount, $account_category, $release_date_of, $due_date,  $supplier, $doc_number, $aditional_info, $u->getCompany());

				header("Location: " . BASE_URL . "financial/accountspayable");
			}

			$data['provider_list'] = $pd->getListProvider($u->getCompany());
			$data['carrier_list'] = $fn->getCarrierList($u->getCompany());
			$this->loadTemplate('fn_accounts_payable_add', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function accountspayable_edit($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_settings')) {
			$fn = new Financial();
			$pd = new Provider();

			if (isset($_POST['description']) && !empty($_POST['description'])) {
				$description = addslashes($_POST['description']);
				$amount_paid = addslashes($_POST['bill_amount']);
				$account_category = addslashes($_POST['account_category']);
				$release_date_of = addslashes($_POST['release_date_of']);
				$due_date = addslashes($_POST['due_date']);
				$supplier = addslashes($_POST['supplier']);
				$doc_number = addslashes($_POST['doc_number']);
				$aditional_info = addslashes($_POST['aditional_info']);

				$amount_paid = str_replace('.', '', $amount_paid);
				$amount_paid = str_replace(',', '.', $amount_paid);

				$fn->editAccountsPayable($id, $description, $amount_paid, $account_category, $release_date_of, $due_date,  $supplier, $doc_number, $aditional_info, $u->getCompany());

				header("Location: " . BASE_URL . "financial/accountspayable");
			}

			$data['accounts_payable_info'] = $fn->getAccountsPayableInfo($id, $u->getCompany());
			$data['provider_list'] = $pd->getListProvider($u->getCompany());

			$this->loadTemplate('fn_accounts_payable_edit', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function accountspayable_delete($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_settings')) {
			$fn = new Financial();

			$fn->deleteAccountsPayable($id, $u->getCompany());
			header("Location: " . BASE_URL . "financial/accountspayable");


			$this->loadTemplate('financial/accountspayable', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function accountspayable_view($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('singlereceipt_view')) {
			$fn = new Financial();
			$pd = new  Provider();

			$data['accounts_payable_info'] = $fn->getViewAccountsPayable($id, $u->getCompany());

			$this->loadTemplate('fn_accounts_payable_view', $data);
		}
	}

	public function accountspayable_topayoff($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_settings')) {
			$fn = new Financial();
			$pd = new Provider();

			if (isset($_POST['bill_amount']) && !empty($_POST['bill_amount'])) {
				$bill_amount = addslashes($_POST['bill_amount']);
				$bill_amount = str_replace('.', '', $bill_amount);
				$bill_amount = str_replace(',', '.', $bill_amount);
				$payday = addslashes($_POST['payday']);
				$carrier = addslashes($_POST['carrier']);

				$fn->topayoffAccountsPayable($id, $bill_amount, $payday, $carrier, $u->getCompany());

				header("Location: " . BASE_URL . "financial/accountspayable");
			}

			$data['accounts_payable_info'] = $fn->getViewAccountsPayable($id, $u->getCompany());
			$data['provider_list'] = $pd->getListProvider($u->getCompany());
			$data['carrier_list'] = $fn->getCarrierList($u->getCompany());

			$this->loadTemplate('fn_accounts_payable_topayoff', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	/* ACCOUNTS RECEIVABLE */
	public function accountsreceivable()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_view')) {
			$fn = new Financial();
			$offset =  0;

			$data['p'] = 1;
			if (isset($_GET['p']) && !empty($_GET['p'])) {
				$data['p'] = intval($_GET['p']);
				if ($data['p'] == 0) {
					$data['p'] = 1;
				}
			}

			$data['accounts_receivable_list'] = $fn->getListAccountsReceivable($offset, $u->getCompany());
			$data['accounts_receivable_count'] = $fn->getCountAccountsReceivable($u->getCompany());
			$data['p_count'] = ceil($data['accounts_receivable_count'] / 10);
			$data['edit_permission'] = $u->hasPermission('financial_edit');

			$this->loadTemplate('fn_accounts_receivable', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function accountsreceivable_listall()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_view')) {
			$fn = new Financial();
			$offset =  0;

			$data['p'] = 1;
			if (isset($_GET['p']) && !empty($_GET['p'])) {
				$data['p'] = intval($_GET['p']);
				if ($data['p'] == 0) {
					$data['p'] = 1;
				}
			}

			$data['accounts_receivable_list'] = $fn->getListAccountsReceivableAll($offset, $u->getCompany());
			$data['accounts_receivable_count'] = $fn->getCountAccountsReceivable($u->getCompany());
			$data['p_count'] = ceil($data['accounts_receivable_count'] / 10);
			$data['edit_permission'] = $u->hasPermission('financial_edit');

			$this->loadTemplate('fn_accounts_receivable_listall', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function accountsreceivable_add()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_add')) {
			$fn = new Financial();
			$c = new Clients();

			if (isset($_POST['description']) && !empty($_POST['description'])) {
				$description = addslashes($_POST['description']);
				$bill_amount = addslashes($_POST['bill_amount']);
				$account_category = addslashes($_POST['account_category']);
				$release_date_of = addslashes($_POST['release_date_of']);
				$due_date = addslashes($_POST['due_date']);
				$client_name = addslashes($_POST['client_name']);
				$doc_number = addslashes($_POST['doc_number']);
				$aditional_info = addslashes($_POST['aditional_info']);

				$bill_amount = str_replace('.', '', $bill_amount);
				$bill_amount = str_replace(',', '.', $bill_amount);

				$fn->addAccountsReceivable($description, $bill_amount, $account_category, $release_date_of, $due_date,  $client_name, $doc_number, $aditional_info, $u->getCompany());

				header("Location: " . BASE_URL . "financial/accountsreceivable");
			}

			$data['client_list'] = $c->getListAll($u->getCompany());
			$this->loadTemplate('fn_accounts_receivable_add', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function accountsreceivable_edit($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_settings')) {
			$fn = new Financial();
			$c = new Clients();

			if (isset($_POST['description']) && !empty($_POST['description'])) {
				$description = addslashes($_POST['description']);
				$bill_amount = addslashes($_POST['bill_amount']);
				$account_category = addslashes($_POST['account_category']);
				$release_date_of = addslashes($_POST['release_date_of']);
				$due_date = addslashes($_POST['due_date']);
				$client_name = addslashes($_POST['client_name']);
				$doc_number = addslashes($_POST['doc_number']);
				$aditional_info = addslashes($_POST['aditional_info']);

				$bill_amount = str_replace('.', '', $bill_amount);
				$bill_amount = str_replace(',', '.', $bill_amount);

				$fn->editAccountsReceivable($id, $description, $bill_amount, $account_category, $release_date_of, $due_date,  $client_name, $doc_number, $aditional_info, $u->getCompany());

				header("Location: " . BASE_URL . "financial/accountsreceivable");
			}

			$data['accounts_receivable_info'] = $fn->getAccountsReceivableInfo($id, $u->getCompany());
			$data['clients_list'] = $c->getListAll($u->getCompany());

			$this->loadTemplate('fn_accounts_receivable_edit', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function accountsreceivable_delete($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_settings')) {
			$fn = new Financial();

			$fn->deleteAccountsReceivable($id, $u->getCompany());
			header("Location: " . BASE_URL . "financial/accountsreceivable");


			$this->loadTemplate('financial/accountsreceivable', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function accountsreceivable_view($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_view')) {
			$fn = new Financial();
			$pd = new Clients();

			$data['accounts_receivable_info'] = $fn->getViewAccountsReceivable($id, $u->getCompany());

			$this->loadTemplate('fn_accounts_receivable_view', $data);
		}
	}

	public function accountsreceivable_topayoff($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_settings')) {
			$fn = new Financial();
			$pd = new Provider();

			if (isset($_POST['bill_amount']) && !empty($_POST['bill_amount'])) {
				$amount_paid = addslashes($_POST['bill_amount']);
				$amount_paid = str_replace('.', '', $amount_paid);
				$amount_paid = str_replace(',', '.', $amount_paid);
				$payday = addslashes($_POST['payday']);


				$carrier = addslashes($_POST['carrier']);

				$fn->topayoffAccountsReceivable($id, $amount_paid, $payday, $u->getCompany());

				header("Location: " . BASE_URL . "financial/accountsreceivable");
			}

			$data['accounts_receivable_info'] = $fn->getViewAccountsReceivable($id, $u->getCompany());
			$data['carrier_list'] = $fn->getCarrierList($u->getCompany());

			$this->loadTemplate('fn_accounts_receivable_topayoff', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	/* COMISSIONS */
	public function comissions()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_view')) {
			$fn = new Financial();
			$offset =  0;

			$data['p'] = 1;
			if (isset($_GET['p']) && !empty($_GET['p'])) {
				$data['p'] = intval($_GET['p']);
				if ($data['p'] == 0) {
					$data['p'] = 1;
				}
			}

			$data['comissions_list'] = $fn->getListComissions($offset, $u->getCompany());
			$data['comissions_count'] = $fn->getCountComissions($u->getCompany());
			$data['p_count'] = ceil($data['comissions_count'] / 10);
			$data['edit_permission'] = $u->hasPermission('financial_edit');

			$this->loadTemplate('fn_comissions', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function comissions_listall()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('financial_view')) {
			$fn = new Financial();
			$offset =  0;

			$data['p'] = 1;
			if (isset($_GET['p']) && !empty($_GET['p'])) {
				$data['p'] = intval($_GET['p']);
				if ($data['p'] == 0) {
					$data['p'] = 1;
				}
			}

			$data['comissions_list'] = $fn->getListComissionsAll($u->getCompany());
			$data['comissions_count'] = $fn->getCountComissions($u->getCompany());
			$data['p_count'] = ceil($data['comissions_count'] / 10);
			$data['edit_permission'] = $u->hasPermission('financial_edit');

			$this->loadTemplate('fn_comissions_listall', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

}
