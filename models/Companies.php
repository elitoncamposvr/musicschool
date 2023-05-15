<?php
class Companies extends model{

	private $companyInfo;

	public function __construct($id){
		parent::__construct();

		$sql = $this->db->prepare("SELECT * FROM companies WHERE id = :id");
		$sql->bindValue(':id', $id);
		$sql->execute();

		if($sql->rowCount() > 0){
			$this->companyInfo = $sql->fetch();
		}
	}

	public function getName(){
		if(isset($this->companyInfo['name'])){
			return $this->companyInfo['name'];
		} else {
			return '0';
		}
	}

	public function getInfo(){
		$array = $this->companyInfo;	
		return $array;
	}

	public function edit($name, $social_reason, $cnpj, $state_registration, $email, $site, $phone, $address_zipcode, $address, $address2, $address_number, $address_neighb, $address_city, $address_state, $id) {

		$sql = $this->db->prepare("UPDATE companies SET name = :name, social_reason = :social_reason, cnpj = :cnpj, state_registration = :state_registration, email = :email, site = :site, phone = :phone, address_zipcode = :address_zipcode, address = :address, address2 = :address2, address_number = :address_number, address_neighb = :address_neighb, address_city = :address_city, address_state = :address_state WHERE id = :id");
		$sql->bindValue(":name", $name);
		$sql->bindValue(":social_reason", $social_reason);
		$sql->bindValue(":cnpj", $cnpj);
		$sql->bindValue(":state_registration", $state_registration);
		$sql->bindValue(":email", $email);
		$sql->bindValue(":site", $site);
		$sql->bindValue(":phone", $phone);
		$sql->bindValue(":address_zipcode", $address_zipcode);
		$sql->bindValue(":address", $address);
		$sql->bindValue(":address2", $address2);
		$sql->bindValue(":address_number", $address_number);
		$sql->bindValue(":address_neighb", $address_neighb);
		$sql->bindValue(":address_city", $address_city);
		$sql->bindValue(":address_state", $address_state);
		$sql->bindValue(":id", $id);
		$sql->execute();

	}

}