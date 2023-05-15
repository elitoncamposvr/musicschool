<?php
class companiesController extends controller
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
        $data['companies_info'] = $company->getInfo();


        if ($u->hasPermission('companies')) {
            if (isset($_POST['name']) && !empty($_POST['name'])) {

                header("Location: " . BASE_URL . "companies");
            }

            $data['edit_permission'] = $u->hasPermission('companies_edit');

            $this->loadTemplate('companies', $data);
        } else {
            header("Location: " . BASE_URL . "home/unauthorized");
        }
    }

    public function edit() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();
        $data['companies_info'] = $company->getInfo();

        if($u->hasPermission('companies_edit')) {

            if(isset($_POST['name']) && !empty($_POST['name'])) {                   
                $name = addslashes($_POST['name']);
                $social_reason = addslashes($_POST['social_reason']);
                $cnpj = addslashes($_POST['cnpj']);
                $state_registration = addslashes($_POST['state_registration']);
                $email = addslashes($_POST['email']);
                $site = addslashes($_POST['site']);
                $phone = addslashes($_POST['phone']);
                $address_zipcode = addslashes($_POST['address_zipcode']);
                $address = addslashes($_POST['address']);
                $address_number = addslashes($_POST['address_number']);
                $address2 = addslashes($_POST['address2']);
                $address_neighb = addslashes($_POST['address_neighb']);
                $address_city = addslashes($_POST['address_city']);
                $address_state = addslashes($_POST['address_state']);

                $company->edit($name, $social_reason, $cnpj, $state_registration, $email, $site, $phone, $address_zipcode, $address, $address2, $address_number, $address_neighb, $address_city, $address_state, $u->getCompany());
                header("Location: ".BASE_URL."companies");
            }
            $this->loadTemplate('companies_edit', $data);
        }
    }
}