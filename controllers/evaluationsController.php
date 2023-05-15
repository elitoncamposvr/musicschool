<?php
class evaluationsController extends controller
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
		$students = new Students();
		$u->setLoggedUser();
		$company = new Companies($u->getSchool());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		$offset =  0;
		$data['p'] = 1;
		if (isset($_GET['p']) && !empty($_GET['p'])) {
			$data['p'] = intval($_GET['p']);
			if ($data['p'] == 0) {
				$data['p'] = 1;
			}
		}

		$offset = (15 * ($data['p'] - 1));

		$data['students_list'] = $students->getListEvaluations($offset, $u->getSchool());
		$data['students_count'] = $students->getCount();
		$data['p_count'] = ceil($data['students_count'] / 15);
		$data['counter'] = $data['students_count'];

		$this->loadTemplate('evaluations', $data);
	}
}
