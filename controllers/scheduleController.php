<?php
class scheduleController extends controller
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
		$sh = new Schedule();
		$u->setLoggedUser();
		// $sh->setServicesPending();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('schedule')) {
			
			$data['schedule_list'] = $sh->getList($u->getCompany());
			$data['edit_permission'] = $u->hasPermission('schedule_edit');
			$this->loadTemplate('schedule', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function listall()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('schedule')) {
			$sh = new Schedule();
			$pd = new Provider();
			$offset = 0;

			$data['p'] = 1;
			if (isset($_GET['p']) && !empty($_GET['p'])) {
				$data['p'] = intval($_GET['p']);
				if ($data['p'] == 0) {
					$data['p'] = 1;
				}
			}

			$offset = (10 * ($data['p'] - 1));

			$data['schedule_list'] = $sh->getListAll($offset, $u->getCompany());
			$data['schedule_count'] = $sh->getCount($u->getCompany());
			$data['p_count'] = ceil($data['schedule_count'] / 10);
			$data['users_list'] = $u->getListAll($u->getCompany());
			$data['provider_list'] = $pd->getListProvider($u->getCompany());
			$data['edit_permission'] = $u->hasPermission('schedule_edit');
			$this->loadTemplate('schedule_list_all', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function filter()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('schedule')) {
			$sch = new Schedule();
			$pd = new Provider();

			$period1 = addslashes($_GET['period1']);
			$period2 = addslashes($_GET['period2']);
			$id_user = addslashes($_GET['id_user']);
			$provider_id = addslashes($_GET['provider_id']);

			if ($id_user != 0) {
				$where_user = "schedule.id_user = $id_user AND";
			} else {
				$where_user = "";
			}

			if ($provider_id != 0) {
				$where_provider = "schedule.provider_id = $provider_id AND";
			} else {
				$where_provider = "";
			}

			$data['schedule_list'] = $sch->getTotalFiltered($period1, $period2, $where_user, $where_provider, $u->getCompany());
			$data['users_list'] = $u->getListAll($u->getCompany());
			$data['provider_list'] = $pd->getListProvider($u->getCompany());
			$data['edit_permission'] = $u->hasPermission('schedule_edit');
			$this->loadTemplate('schedule_filter', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function search()
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermission('schedule')) {
            $sh = new Schedule();

            $sp = addslashes($_GET['sp']);


            $data['schedule_list'] = $sh->searchSchedule($sp, $u->getCompany());
            $this->loadTemplate('schedule_search', $data);
        } else {
            header("Location: " . BASE_URL . "home/unauthorized");
        }
    }


	public function add()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('schedule_edit')) {
			$sh = new Schedule();
			$c = new Clients();

			if (isset($_POST['client_id']) && !empty($_POST['client_id'])) {

				$client_id = addslashes($_POST['client_id']);

				$sh->add($client_id, $u->getId(), $u->getCompany());
			}
			$data['client_list'] = $c->getListAll($u->getCompany());
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}


	public function select_client()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('schedule_edit')) {
			$c = new Clients();

			$data['client_list'] = $c->getListAll($u->getCompany());
			$this->loadTemplate('schedule_select_client', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function pendingservices($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('schedule_edit')) {
			$sh = new Schedule();
			$c = new Clients();
			$pd = new Provider();

			if (isset($_POST['client_name']) && !empty($_POST['client_name'])) {

				$client_name = addslashes($_POST['client_name']);

				$sh->edit($id, $client_name, $u->getCompany());

				header("Location: " . BASE_URL . "schedule");
			}

			$data['schedule_info'] = $sh->getInfo($id, $u->getCompany());
			$data['client_list'] = $c->getListAll($u->getCompany());
			$data['provider_list'] = $pd->getListProvider($u->getCompany());
			$this->loadTemplate('schedule_edit', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function view($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();
		$sh = new Schedule();
		$srv = new Services();
		$fn = new Financial();
		$pd = new Provider();

		if ($u->hasPermission('schedule')) {

			if (isset($_POST['service_id']) && !empty($_POST['service_id'])) {

				$service_id = addslashes($_POST['service_id']);
				$date = addslashes($_POST['date_service']);
				$time_service = addslashes($_POST['time_service']);
				$schedule_id = $id;
				$status = 1;
				$provider_id = addslashes($_POST['provider_id']);
				$passengers = addslashes($_POST['passengers']);
				$departure = addslashes($_POST['departure']);
				$arrival = addslashes($_POST['arrival']);
				$total_sale = addslashes($_POST['total_sale']);
				$total_cost = addslashes($_POST['total_cost']);
				$client_id = addslashes($_POST['client_id']);
				$date_service = $date.' '.$time_service;

				$sh->addService($service_id, $schedule_id, $date_service, $status, $provider_id, $passengers, $departure, $arrival, $total_sale, $total_cost, $client_id, $u->getId(), $u->getCompany());
			}

			$data['schedule_view'] = $sh->getView($id, $u->getCompany());
			$data['services_list'] = $srv->getListAll($u->getCompany());
			$data['provider_list'] = $pd->getListProvider($u->getCompany());
			$data['services_total'] = $sh->getCountServices($id, $u->getCompany());
			$data['services_total_cost'] = $sh->getCountStandardValueServices($id, $u->getCompany());
			$data['schedules_services'] = $sh->getSchedulesServicesList($id, $u->getCompany());
			$data['payment_method_list'] = $fn->getPaymentMethodsList($u->getCompany());
			$data['voucher_list'] = $sh->getVoucherList($id, $u->getCompany());
			$data['info_list'] = $sh->getInfoList($id, $u->getCompany());
			$data['history_list'] = $sh->getHistoryList($id, $u->getCompany());
			$data['date_schedule'] = $sh->getDateSchedule($id, $u->getCompany());
			$data['edit_permission'] = $u->hasPermission('schedule_edit');

			$this->loadTemplate('schedule_view', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function cart($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();
		$sh = new Schedule();
		$srv = new Services();
		$fn = new Financial();

		if ($u->hasPermission('schedule')) {

			if (isset($_POST['total_schedule']) && !empty($_POST['total_schedule'])) {

				$total_schedule = addslashes($_POST['total_schedule']);
				$discount = addslashes($_POST['discount']);
				$total_cost_amount = addslashes($_POST['total_cost_amount']);


				$sh->finalizeSchedule($id, $total_schedule, $discount, $total_cost_amount, $u->getId(), $u->getCompany());
			}

			$data['schedule_info'] = $sh->getInfo($id, $u->getCompany());
			$data['schedules_services'] = $sh->getSchedulesServicesList($id, $u->getCompany());
			$data['services_total'] = $sh->getCountServices($id, $u->getCompany());
			$data['payment_list'] = $fn->getPaymentMethodsList($u->getCompany());
			$data['voucher_list'] = $sh->getVoucherList($id, $u->getCompany());
			$data['info_list'] = $sh->getInfoList($id, $u->getCompany());
			$data['history_list'] = $sh->getHistoryList($id, $u->getCompany());
			$data['edit_permission'] = $u->hasPermission('schedule_delete');

			$this->loadTemplate('schedule_cart', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function aditionalinfo()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('schedule')) {
			$sh = new Schedule();

			if (isset($_POST['info_text']) && !empty($_POST['info_text'])) {
				$id_schedule = addslashes($_POST['id_schedule']);
				$info_text = addslashes($_POST['info_text']);

				$sh->addAditionalInfo($id_schedule, $info_text, $u->getId(), $u->getCompany());

				header("Location: " . BASE_URL . "schedule/view/".$id_schedule);
			}
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function voucher()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();
		$sh = new Schedule();

		if (isset($_POST['form_voucher']) && !empty($_POST['form_voucher'])) {
			$schedule_id = addslashes($_POST['voucher_id']);
			$payment = addslashes($_POST['payment']);
			$voucher_value = addslashes($_POST['voucher_value']);

			$allowedFormats = array("png", "jpg", "jpeg", "gif", "pdf", "txt");
			$extension = pathinfo($_FILES['img_voucher']['name'], PATHINFO_EXTENSION);

			if (in_array($extension, $allowedFormats)) :
				$dir = "images/voucher/";
				$tempFile = $_FILES['img_voucher']['tmp_name'];
				$voucher_name = uniqid() . ".$extension";

				if (move_uploaded_file($tempFile, $dir . $voucher_name)) :
					$mensagem = "Upload feito com sucesso";
				else :
					$mensagem = "Erro! Não foi possivel fazer o upload";
				endif;
			else :
				echo "Formato inválido";

			endif;

			$sh->addVoucher($schedule_id, $voucher_name, $voucher_value, $payment, $u->getId(), $u->getCompany());

			header("Location: " . BASE_URL . "schedule/view/".$schedule_id);
		}
	}

	public function discount()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('schedule_edit')) {
			$sh = new Schedule();

			if (isset($_POST['discount']) && !empty($_POST['discount'])) {
				$id = addslashes($_POST['id']);
				$discount = addslashes($_POST['discount']);

				$discount = str_replace('.', '', $discount);
				$discount = str_replace(',', '.', $discount);

				$sh->addDiscount($id, $discount, $u->getId(), $u->getCompany());

				header("Location: " . BASE_URL . "schedule/view/" . $id);
			}
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function pendingservicesall()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('schedule')) {
			$sh = new Schedule();

			$data['services_list'] = $sh->getPendingServicesList($u->getCompany());
			$this->loadTemplate('schedule_pending_services', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}


	public function cancel($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('schedule_cancel')) {
			$sh = new Schedule();

			$situation = '3'; //Status = Cancelado (Cancel)
			$msg = "cancelou reserva";

			$sh->changeStatus($id, $msg, $situation, $u->getId(), $u->getCompany());
			header("Location: " . BASE_URL . "schedule/view/".$id);


			$this->loadTemplate('schedule', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function aprove($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('schedule_cancel')) {
			$sh = new Schedule();

			$payment = addslashes($_POST['payment']);
			$total_schedule = addslashes($_POST['total_schedule']);
			$discount = addslashes($_POST['discount']);
			$total_cost = addslashes($_POST['total_cost']);

			

			$sh->setAproved($id, $payment, $total_schedule, $discount, $total_cost, $u->getId(), $u->getCompany());
			header("Location: " . BASE_URL . "schedule/view/".$id);


			$this->loadTemplate('schedule', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function delete($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('schedule_cancel')) {
			$sh = new Schedule();

			$sh->delete($id, $u->getCompany());
			header("Location: " . BASE_URL . "schedule");


			$this->loadTemplate('schedule', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function confirmedService($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('schedule_edit')) {
			$sh = new Schedule();

			$status = '2'; //Status = Confirmed
			$msg = "confirmou serviço";
			$url = $_SERVER['HTTP_REFERER'];

			$sh->changeStatusService($id, $status, $msg, $u->getId(), $u->getCompany());

			header("Location: " . $url);


			$this->loadTemplate('schedule', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function cancelService($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('schedule_cancel')) {
			$sh = new Schedule();

			$status = '3'; //Status = Cancelado (Cancel)
			$msg = "cancelou serviço";
			$url = $_SERVER['HTTP_REFERER'];

			$sh->changeStatusService($id, $status, $msg, $u->getId(), $u->getCompany());

			header("Location: " . $url);


			$this->loadTemplate('schedule', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function deleteService($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('schedule_cancel')) {
			$sh = new Schedule();

			$url = $_SERVER['HTTP_REFERER'];

			$sh->deleteService($id, $u->getId(), $u->getCompany());

			header("Location: " . $url);


			$this->loadTemplate('schedule', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}
}
