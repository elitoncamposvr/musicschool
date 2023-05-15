<?php
class seriesController extends controller
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
		$series = new Series();
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

		$data['series_list'] = $series->getList($offset, $u->getSchool());
		$data['series_count'] = $series->getCount($u->getSchool());
		$data['p_count'] = ceil($data['series_count'] / 15);

		$this->loadTemplate('series', $data);
	}

	public function create()
	{
		$data = array();
		$u = new Users();
		$series = new Series();
		$u->setLoggedUser();
		$company = new Companies($u->getSchool());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();


		if (isset($_POST['series_name']) && !empty($_POST['series_name'])) {
			$series_name = addslashes($_POST['series_name']);

			$series->create($u->getSchool(), $series_name);
			header("Location: " . BASE_URL . "series");
		}

		$this->loadTemplate('series_create', $data);
	}

	public function update($id)
	{
		$data = array();
		$u = new Users();
		$series = new Series();
		$u->setLoggedUser();
		$company = new Companies($u->getSchool());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();


		if (isset($_POST['series_name']) && !empty($_POST['series_name'])) {
			$series_name = addslashes($_POST['series_name']);

			$series->update($id, $u->getSchool(), $series_name);
			header("Location: " . BASE_URL . "series");
		}

		$data['series_info'] = $series->getInfo($id, $u->getSchool());

		$this->loadTemplate('series_update', $data);
	}

	public function destroy($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getSchool());

		$series = new Series();

		$series->destroy($id, $u->getSchool());
		header("Location: " . BASE_URL . "series");
	}
}
