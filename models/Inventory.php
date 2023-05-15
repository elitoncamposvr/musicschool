<?php
class Inventory extends model {

	public function getList($offset, $id_company) {
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM inventory WHERE id_company = :id_company  ORDER BY name_product ASC LIMIT $offset, 20");
		$sql->bindValue(":id_company", $id_company);

		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getCount($id_company){
		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) as i FROM inventory WHERE id_company = :id_company");
		$sql->bindValue('id_company', $id_company);
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['i'];



		return $r;
	}

	public function getBrandList($offset, $id_company) {
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM product_brand WHERE id_company = :id_company ORDER BY name_product ASC LIMIT $offset, 10");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getBrandList2($id_company) {
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM product_brand WHERE id_company = :id_company ORDER BY name_product ASC");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}


	public function getInfo($id, $id_company) {
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM inventory WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function getBrandCount($id_company){
		$r = 0;
	
		$sql = $this->db->prepare("SELECT COUNT(*) as i FROM product_brand WHERE id_company = :id_company");
		$sql->bindValue('id_company', $id_company);
		$sql->execute();
		$row = $sql->fetch();
	
		$r = $row['i'];
	
	
	
		return $r;
	  }

	public function getBrandInfo($id, $id_company) {
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM product_brand WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function setLog($id_product, $id_company, $id_user, $action) {
		$sql = $this->db->prepare("INSERT INTO inventory_history SET id_company = :id_company, id_product = :id_product, id_user = :id_user, action = :action, date_action = NOW()");
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":id_product", $id_product);
		$sql->bindValue(":id_user", $id_user);
		$sql->bindValue(":action", $action);
		$sql->execute();
	}

	public function add($name_product, $product_code, $original_code, $id_brand, $id_provider, $purchase_price, $profit, $price, $min_price, $quant, $ideal_quant, $min_quant, $location, $drawer, $bar_code, $product_info, $unity, $id_company, $id_user) {

		$sql = $this->db->prepare("INSERT INTO inventory SET name_product = :name_product, product_code = :product_code, original_code = :original_code, id_brand = :id_brand, id_provider = :id_provider, purchase_price = :purchase_price, profit = :profit, price = :price, min_price = :min_price, quant = :quant, ideal_quant = :ideal_quant, min_quant = :min_quant, location = :location, drawer = :drawer, bar_code = :bar_code, product_info = :product_info, unity = :unity, id_company = :id_company");
		$sql->bindValue(":name_product", $name_product);
		$sql->bindValue(":product_code", $product_code);
		$sql->bindValue(":original_code", $original_code);
		$sql->bindValue(":id_brand", $id_brand);
		$sql->bindValue(":id_provider", $id_provider);
		$sql->bindValue(":purchase_price", $purchase_price);
		$sql->bindValue(":profit", $profit);
		$sql->bindValue(":price", $price);
		$sql->bindValue(":min_price", $min_price);
		$sql->bindValue(":quant", $quant);
		$sql->bindValue(":ideal_quant", $ideal_quant);
		$sql->bindValue(":min_quant", $min_quant);
		$sql->bindValue(":location", $location);
		$sql->bindValue(":drawer", $drawer);
		$sql->bindValue(":bar_code", $bar_code);
		$sql->bindValue(":product_info", $product_info);
		$sql->bindValue(":unity", $unity);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		$id_product = $this->db->lastInsertId();
		$this->setLog($id_product, $id_company, $id_user, 'add');
	}

	public function addBrand($name_product, $id_company) {

		$sql = $this->db->prepare("INSERT INTO product_brand SET name_product = :name_product, id_company = :id_company");
		$sql->bindValue(":name_product", $name_product);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

	}

	public function edit($id, $name_product, $product_code, $original_code, $id_brand, $id_provider, $purchase_price, $profit, $price, $min_price, $quant, $ideal_quant, $min_quant, $location, $drawer, $bar_code, $product_info, $unity, $id_company, $id_user) {

		$sql = $this->db->prepare("UPDATE inventory SET name_product = :name_product, product_code = :product_code, original_code = :original_code, id_brand = :id_brand, id_provider = :id_provider, purchase_price = :purchase_price, profit = :profit, price = :price, min_price = :min_price, quant = :quant, ideal_quant = :ideal_quant, min_quant = :min_quant, location = :location, drawer = :drawer, bar_code = :bar_code, product_info = :product_info, unity = :unity WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":name_product", $name_product);
		$sql->bindValue(":product_code", $product_code);
		$sql->bindValue(":original_code", $original_code);
		$sql->bindValue(":id_brand", $id_brand);
		$sql->bindValue(":id_provider", $id_provider);
		$sql->bindValue(":purchase_price", $purchase_price);
		$sql->bindValue(":profit", $profit);
		$sql->bindValue(":price", $price);
		$sql->bindValue(":min_price", $min_price);
		$sql->bindValue(":quant", $quant);
		$sql->bindValue(":ideal_quant", $ideal_quant);
		$sql->bindValue(":min_quant", $min_quant);
		$sql->bindValue(":location", $location);
		$sql->bindValue(":drawer", $drawer);
		$sql->bindValue(":bar_code", $bar_code);
		$sql->bindValue(":product_info", $product_info);
		$sql->bindValue(":unity", $unity);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		$this->setLog($id, $id_company, $id_user, 'edt');
	}

	public function editBrand($id, $name_product, $id_company) {

		$sql = $this->db->prepare("UPDATE product_brand SET name_product = :name_product WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":name_product", $name_product);
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":id", $id);
		$sql->execute();

	}

	public function delete($id, $id_company, $id_user) {
		$sql = $this->db->prepare("DELETE FROM inventory WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		$this->setLog($id, $id_company, $id_user, 'del');
	}

	public function deleteBrand($id, $id_company) {
		$sql = $this->db->prepare("DELETE FROM product_brand WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

	}

	public function searchProductsByName($name, $id_company) {
		$array = array();

		$sql = $this->db->prepare("SELECT name_product, price, id FROM inventory WHERE name_product LIKE :name_product AND id_company = :id_company LIMIT 10");
		$sql->bindValue(':name_product', '%'.$name.'%');
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function decrease($id_prod, $id_company, $quant_prod, $id_user) {
		$sql = $this->db->prepare("UPDATE inventory SET quant = quant - $quant_prod WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id_prod);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		$this->setLog($id_prod, $id_company, $id_user, 'dwn');
	}

	public function getInventoryFiltered($id_company) {
		$array = array();

		$sql = $this->db->prepare("SELECT *, (min_quant-quant) as dif FROM inventory WHERE quant <= min_quant AND id_company = :id_company ORDER BY dif DESC");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function searchProducts($sp, $id_company){
		$array = array();

		$sql = $this->db->prepare("SELECT name_product, price, drawer, quant, min_quant, product_code, original_code, id FROM inventory WHERE name_product LIKE '%$sp%' OR product_code LIKE '%$sp%' OR original_code LIKE '%$sp%' ORDER BY name_product ASC");
		$sql->bindValue(":name_product", $sp.'%');
		$sql->bindValue(":product_code", $sp.'%');
		$sql->bindValue(":original_code", $sp.'%');
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		return $array;
	}

}







