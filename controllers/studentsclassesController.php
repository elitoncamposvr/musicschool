<?php
class studentsclassesController extends controller
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
		$classes = new StudentsClasses();
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

		$data['students_classes_list'] = $classes->getList($offset, $u->getSchool());
		$data['students_classes_count'] = $classes->getCount($u->getSchool());
		$data['p_count'] = ceil($data['students_classes_count'] / 15);


		$this->loadTemplate('students_classes', $data);
	}

	public function create()
	{
		$data = array();
		$u = new Users();
		$classes = new StudentsClasses();
		$series = new Series();
		$u->setLoggedUser();
		$company = new Companies($u->getSchool());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();


		if (isset($_POST['name_class_students']) && !empty($_POST['name_class_students'])) {
			$name_class_students = addslashes($_POST['name_class_students']);
			$series_id = addslashes($_POST['series_id']);

			$classes->create($name_class_students, $series_id, $u->getSchool());
			header("Location: " . BASE_URL . "studentsclasses");
		}

		$data['series_list'] = $series->getListAll($u->getSchool());
		$this->loadTemplate('students_classes_create', $data);
	}

	public function update($id)
	{
		$data = array();
		$u = new Users();
		$classes = new StudentsClasses();
		$series = new Series();
		$u->setLoggedUser();
		$company = new Companies($u->getSchool());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();


		if (isset($_POST['name_class_students']) && !empty($_POST['name_class_students'])) {
			$name_class_students = addslashes($_POST['name_class_students']);
			$series_id = addslashes($_POST['series_id']);

			$classes->update($id, $u->getSchool(), $name_class_students, $series_id);
			header("Location: " . BASE_URL . "studentsclasses");
		}

		$data['classes_info'] = $classes->getInfo($id, $u->getSchool());
		$data['series_list'] = $series->getListAll($u->getSchool());

		$this->loadTemplate('students_classes_update', $data);
	}

	public function destroy($id)
	{
		$data = array();
		$u = new Users();
		$classes = new StudentsClasses();
		$u->setLoggedUser();
		$company = new Companies($u->getSchool());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		$classes->destroy($id, $u->getSchool());
		header("Location: " . BASE_URL . "studentsclasses");

		$this->loadTemplate('studentsclasses', $data);
	}

	public function search()
	{
		$data = array();
		$u = new Users();
		$classes = new StudentsClasses();
		$u->setLoggedUser();
		$company = new Companies($u->getSchool());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		$sp = addslashes($_GET['sp']);

		$data['classes_list'] = $classes->searchClasses($sp, $u->getSchool());
		$this->loadTemplate('students_classes_search', $data);
	}

	public function students($id)
	{
		$data = array();
		$u = new Users();
		$students = new Students();
		$u->setLoggedUser();
		$company = new Companies($u->getSchool());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		$data['classes_students'] = $students->getListStudentsClass($id, $u->getSchool());
		$this->loadTemplate('students_classes_students', $data);
	}
}
