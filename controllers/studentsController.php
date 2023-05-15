<?php
class studentsController extends controller
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

		$data['students_list'] = $students->getList($offset, $u->getSchool());
		$data['students_count'] = $students->getCount();
		$data['p_count'] = ceil($data['students_count'] / 15);
		$data['counter'] = $data['students_count'];

		$this->loadTemplate('students', $data);
	}

	public function create()
	{
		$data = array();
		$u = new Users();
		$students = new Students();
		$classes = new StudentsClasses();
		$series = new Series();
		$u->setLoggedUser();
		$company = new Companies($u->getSchool());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();


		if (isset($_POST['student_name']) && !empty($_POST['student_name'])) {
			$student_name = addslashes($_POST['student_name']);
			$series_id = addslashes($_POST['series_id']);

			$students->create($u->getSchool(), $student_name, $series_id);
			// header("Location: " . BASE_URL . "students");
		}
		$data['students_classes_list'] = $classes->getListAll($u->getSchool());
		$data['series_list'] = $series->getListAll($u->getSchool());
		$this->loadTemplate('students_create', $data);
	}

	public function selectclasses($id)
	{
		$data = array();
		$u = new Users();
		$students = new Students();
		$classes = new StudentsClasses();
		$series = new Series();
		$u->setLoggedUser();
		$company = new Companies($u->getSchool());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();


		if (isset($_POST['student_class_id']) && !empty($_POST['student_class_id'])) {
			$student_class_id = addslashes($_POST['student_class_id']);

			$students->updateClasses($id, $u->getSchool(), $student_class_id);
			header("Location: " . BASE_URL . "students");
		}

		$data['students_info'] = $students->getInfo($id, $u->getSchool());
		$data['series_list'] = $students->getListSeries($id, $u->getSchool());
		$data['students_classes_list'] = $classes->getListAll($u->getSchool());

		$this->loadTemplate('students_select_classes', $data);
	}

	public function update($id)
	{
		$data = array();
		$u = new Users();
		$students = new Students();
		$classes = new StudentsClasses();
		$series = new Series();
		$u->setLoggedUser();
		$company = new Companies($u->getSchool());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();


		if (isset($_POST['student_name']) && !empty($_POST['student_name'])) {
			$student_name = addslashes($_POST['student_name']);
			$series_id = addslashes($_POST['series_id']);

			$students->update($id, $u->getSchool(), $student_name, $series_id);
			// header("Location: " . BASE_URL . "students");
		}

		$data['students_info'] = $students->getInfo($id, $u->getSchool());
		$data['series_list'] = $series->getListAll($u->getSchool());
		$data['students_classes_list'] = $classes->getListAll($u->getSchool());

		$this->loadTemplate('students_update', $data);
	}

	public function destroy($id)
	{
		$data = array();
		$u = new Users();
		$students = new Students();
		$u->setLoggedUser();
		$company = new Companies($u->getSchool());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();


		$students->destroy($id, $u->getSchool());
		header("Location: " . BASE_URL . "students");

		$this->loadTemplate('students', $data);
	}

	public function search()
	{
		$data = array();
		$u = new Users();
		$students = new Students();
		$u->setLoggedUser();
		$company = new Companies($u->getSchool());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		$sp = addslashes($_GET['sp']);

		$data['students'] = $students->searchStudent($sp, $u->getSchool());
		$this->loadTemplate('students_search', $data);
	}

	public function evaluation($id)
	{
		$data = array();
		$u = new Users();
		$students = new Students();
		$u->setLoggedUser();
		$company = new Companies($u->getSchool());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if (isset($_POST['stage']) && !empty($_POST['stage'])) {
			$stage = addslashes($_POST['stage']);
			$student_class = addslashes($_POST['student_class']);
			$series_id = addslashes($_POST['series_id']);
			$answers = $_POST;
			$answers_list = array_slice($answers, 3);

			$students->answers($id, $u->getSchool(), $stage, $student_class, $series_id, $answers_list);
			header("Location: " . BASE_URL . "students/evaluation/" . $id);
		}

		$data['students_info'] = $students->getInfo($id, $u->getSchool());
		$this->loadTemplate('students_evaluation', $data);
	}

	public function answers($id)
	{
		$data = array();
		$u = new Users();
		$students = new Students();
		$u->setLoggedUser();
		$company = new Companies($u->getSchool());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();


		$answers = $_POST;
		$answer = array_shift($answers);
		var_dump($answers);

		$this->loadTemplate('students_evaluation_stage_2', $data);
	}
}
