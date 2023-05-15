<?php
class Schedule extends model
{

    public function getList($id_company)
    {
        $array = array();

        $sql = $this->db->prepare("
        SELECT 
            schedule.*,
            clients.client_name
        FROM schedule 
        LEFT JOIN 
            clients ON schedule.client_id = clients.id 
        WHERE
            schedule.situation = '1'  OR schedule.situation = '4' AND
            schedule.id_company = :id_company
            ORDER BY schedule.id DESC
            ");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getListAll($offset, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("
        SELECT 
            schedule.id,
            schedule.client_id,
            schedule.schedule_date,
            schedule.schedule_time,
            schedule.situation,
            schedule.provider_id,
            clients.client_name,
            provider.name_provider
        FROM schedule 
        LEFT JOIN
            clients ON schedule.client_id = clients.id 
        LEFT JOIN 
            provider ON schedule.provider_id = provider.id 
        WHERE
            schedule.id_company = :id_company
            ORDER BY schedule.id DESC 
            LIMIT $offset, 10
            ");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getCount($id_company)
    {
        $r = 0;

        $sql = $this->db->prepare("SELECT COUNT(*) as sch FROM schedule WHERE id_company = :id_company");
        $sql->bindValue('id_company', $id_company);
        $sql->execute();
        $row = $sql->fetch();

        $r = $row['sch'];



        return $r;
    }

    public function getCountActive($id_company)
    {
        $r = 0;

        $sql = $this->db->prepare("SELECT COUNT(*) as sch FROM schedule WHERE situation = 1 AND id_company = :id_company");
        $sql->bindValue('id_company', $id_company);
        $sql->execute();
        $row = $sql->fetch();

        $r = $row['sch'];



        return $r;
    }

    public function getInfo($id, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("
                SELECT 
                schedule.id as id_sh,
                schedule.client_id,
                schedule.schedule_date,
                schedule.schedule_time,
                schedule.provider_id,
                schedule.situation,
                schedule.discount,
                schedule.aditional_info,
                clients.*,
                provider.name_provider,
                payment_methods.method
            FROM schedule 
            LEFT JOIN 
                clients ON schedule.client_id = clients.id 
            LEFT JOIN 
                provider ON schedule.provider_id = provider.id 
            LEFT JOIN 
                payment_methods ON schedule.payment = payment_methods.id 
            WHERE 
                schedule.id = :id AND
                schedule.id_company = :id_company
        ");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function setLog($id_schedule, $id_company, $id_user, $action)
    {
        $sql = $this->db->prepare("INSERT INTO schedule_history SET id_company = :id_company, id_schedule = :id_schedule, id_user = :id_user, action = :action, time_action = NOW()");
        $sql->bindValue(":id_schedule", $id_schedule);
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":id_user", $id_user);
        $sql->bindValue(":action", $action);
        $sql->execute();
    }

    public function add($client_id, $id_user, $id_company)
    {
        $sql = $this->db->prepare("INSERT INTO schedule SET client_id = :client_id, schedule_date = NOW(), id_user = :id_user, situation = 1, discount = 0, id_company = :id_company");

        $sql->bindValue(":client_id", $client_id);
        $sql->bindValue(":id_user", $id_user);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $id_schedule = $this->db->lastInsertId();
        $this->setLog($id_schedule, $id_company, $id_user, 'criou reserva');

        header("Location: " . BASE_URL . "schedule/view/" . $id_schedule);
    }

    public function edit($id, $client_name, $id_company)
    {

        $sql = $this->db->prepare("UPDATE schedule SET client_name = :client_name WHERE id = :id AND id_company = :id_company");

        $sql->bindValue(":id", $id);
        $sql->bindValue(":client_name", $client_name);
        $sql->execute();
    }

    public function delete($id, $id_company)
    {
        $sql = $this->db->prepare("DELETE FROM schedule WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $sql = $this->db->prepare("DELETE FROM schedule_services WHERE schedule_id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $sql = $this->db->prepare("DELETE FROM fn_comissions WHERE schedule_number = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $sql = $this->db->prepare("DELETE FROM schedule_history WHERE id_schedule = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $sql = $this->db->prepare("DELETE FROM schedule_voucher WHERE schedule_id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
    }

    public function getView($id, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("
            SELECT 
                schedule.*,
                clients.client_name,
                clients.phone,
                clients.cellphone,
                clients.whatsapp,
                clients.cpf,
                clients.identity,
                clients.address,
                clients.address2,
                clients.address_number,
                clients.address_neighb,
                clients.address_city,
                clients.address_state,
                provider.name_provider
            FROM schedule 
            LEFT JOIN 
                clients ON schedule.client_id = clients.id 
            LEFT JOIN 
                provider ON schedule.provider_id = provider.id 
            WHERE 
                schedule.id = :id AND
                schedule.id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function searchSchedule($sp, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("
            SELECT 
                schedule.*,
                clients.client_name
            FROM 
                schedule 
            LEFT JOIN 
                clients ON schedule.client_id = clients.id 
            WHERE 
                clients.client_name
            LIKE '%$sp%' 
            ORDER BY schedule.client_id ASC
        ");
        $sql->bindValue(":client_id", $sp . '%');
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function getPendingServicesList($id_company)
    {
        $array = array();

        $sql = $this->db->prepare("
        SELECT 
            schedule_services.*,
            services.name_service,
            provider.name_provider,
            clients.client_name
        FROM schedule_services 
        LEFT JOIN 
            services ON schedule_services.service_id = services.id 
        LEFT JOIN 
            provider ON schedule_services.provider_id = provider.id 
        LEFT JOIN 
            schedule ON schedule_services.schedule_id = schedule.id 
        LEFT JOIN 
            clients ON schedule_services.client_id = clients.id 
        WHERE
            schedule_services.aproved = 2 AND 
            schedule_services.status = 1 AND
            schedule_services.id_company = :id_company
        ORDER BY 
            schedule_services.date_service ASC
        ");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function setServicesPending()
    {

        $array = array();

        $sql = $this->db->prepare("SELECT * FROM schedule WHERE schedule_date < NOW() AND situation = 4");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        foreach ($array as $item) {
            $sql = $this->db->prepare("UPDATE schedule_services SET status = 2 WHERE schedule_id = $item[id]");
            $sql->execute();

            $sql = $this->db->prepare("UPDATE schedule SET situation = 2 WHERE id  = $item[id]");
            $sql->execute();

            $due_date = date('Y-m-d', strtotime('+1 month'));

            $sql = $this->db->prepare("INSERT INTO fn_accounts_payable (description, bill_amount, account_category, release_date_of, due_date, supplier,  payment_status, id_company)
		SELECT 'Serviços referente a reserva nº $item[id]', total_cost, 'Serviços de Terceiros', NOW(), '$due_date', provider_id, '1', id_company FROM schedule WHERE id = $item[id]");
            $sql->execute();

            $id_accounts_payable = $this->db->lastInsertId();

            $sql = $this->db->prepare("INSERT INTO fn_comissions (schedule_number, bill_amount, accounts_payable_number, date_comission, id_company)
		SELECT $item[id], total_cost, '$id_accounts_payable', NOW(), id_company FROM schedule WHERE id = $item[id]");
            $sql->bindValue(":accounts_payable_number", $id_accounts_payable);
            $sql->execute();

        }
    }

    public function getCountServices($id, $id_company)
    {
        $r = 0;

        $sql = $this->db->prepare("SELECT SUM(total_sale) as sv FROM schedule_services WHERE status <> 3 AND schedule_id = :id AND id_company = :id_company");
        $sql->bindValue('id', $id);
        $sql->bindValue('id_company', $id_company);
        $sql->execute();
        $row = $sql->fetch();

        $r = $row['sv'];



        return $r;
    }

    public function getDateSchedule($id, $id_company)
    {
        $r = 0;

        $sql = $this->db->prepare("SELECT MAX(date_service) as sv FROM schedule_services WHERE status <> 3 AND schedule_id = :id AND id_company = :id_company");
        $sql->bindValue('id', $id);
        $sql->bindValue('id_company', $id_company);
        $sql->execute();
        $row = $sql->fetch();

        $r = $row['sv'];



        return $r;
    }

    public function getCountStandardValueServices($id, $id_company)
    {
        $r = 0;

        $sql = $this->db->prepare("SELECT SUM(total_cost) as sv FROM schedule_services WHERE status <> 3 AND schedule_id = :id AND id_company = :id_company");
        $sql->bindValue('id', $id);
        $sql->bindValue('id_company', $id_company);
        $sql->execute();
        $row = $sql->fetch();

        $r = $row['sv'];



        return $r;
    }


    public function getSchedulesServicesList($id, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("
        SELECT 
            schedule_services.*,
            services.name_service,
            provider.name_provider
        FROM schedule_services 
        LEFT JOIN 
            services ON schedule_services.service_id = services.id 
        LEFT JOIN 
            provider ON schedule_services.provider_id = provider.id 
        WHERE
            schedule_services.schedule_id = :id AND
            schedule_services.id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getServicesFiltered($period1, $period2, $where_provider, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("
        SELECT 
            schedule_services.id,
            schedule_services.service_id,
            schedule_services.schedule_id,
            schedule_services.sale_value,
            schedule_services.date_service,
            schedule_services.time_service,
            schedule_services.status,
            schedule_services.id_user,
            services.name_service,
            users.name_user,
            provider.name_provider
        FROM 
            schedule_services 
        LEFT JOIN 
            services ON schedule_services.service_id = services.id 
        LEFT JOIN 
            users ON schedule_services.id_user = users.id 
        LEFT JOIN 
            provider ON schedule_services.provider_id = provider.id 
        WHERE 
            $where_provider
            schedule_services.id_company = :id_company
        AND 
            schedule_services.date_service BETWEEN '$period1' 
        AND 
            '$period2' 
        ORDER BY 
            schedule_services.id desc
        ");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function addService($service_id, $schedule_id, $date_service, $status, $provider_id, $passengers, $departure, $arrival, $total_sale, $total_cost, $client_id, $id_user, $id_company)
    {
        $sql = $this->db->prepare("INSERT INTO schedule_services (schedule_id, service_id, sale_value, standard_value, date_service, status, provider_id, passengers, departure, arrival, total_sale, total_cost, client_id, id_user, id_company)
		SELECT '$schedule_id', '$service_id', sale_value, standard_value, '$date_service', '$status', '$provider_id', '$passengers', '$departure', '$arrival', '$total_sale', '$total_cost', '$client_id', '$id_user', id_company FROM services WHERE id = '$service_id'");
        $sql->bindValue(":service_id", $service_id);
        $sql->bindValue(":schedule_id", $schedule_id);
        $sql->bindValue(":date_service", $date_service);
        $sql->bindValue(":status", $status);
        $sql->bindValue(":provider_id", $provider_id);
        $sql->bindValue(":passengers", $passengers);
        $sql->bindValue(":departure", $departure);
        $sql->bindValue(":arrival", $arrival);
        $sql->bindValue(":total_sale", $total_sale);
        $sql->bindValue(":total_cost", $total_cost);
        $sql->bindValue(":client_id", $client_id);
        $sql->bindValue(":id_user", $id_user);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $this->setLog($schedule_id, $id_company, $id_user, 'adicionou serviço');
    }

    public function changeStatus($id, $msg, $situation, $id_user, $id_company)
    {

        $sql = $this->db->prepare("UPDATE schedule SET situation = :situation WHERE id = :id AND id_company = :id_company");

        $sql->bindValue(":id", $id);
        $sql->bindValue(":situation", $situation);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $this->setLog($id, $id_company, $id_user, $msg);
    }

    public function setAproved($id, $payment, $total_schedule, $discount, $total_cost, $id_user, $id_company)
    {

        $sql = $this->db->prepare("UPDATE schedule SET situation = 4, payment = :payment, total_schedule = :total_schedule, total_with_discount = :total_schedule - discount, total_cost = :total_cost WHERE id = :id AND id_company = :id_company");

        $sql->bindValue(":id", $id);
        $sql->bindValue(":payment", $payment);
        $sql->bindValue(":total_schedule", $total_schedule);
        $sql->bindValue(":total_cost", $total_cost);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $sql = $this->db->prepare("UPDATE schedule_services SET aproved = 2 WHERE schedule_id = $id AND id_company = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $this->setLog($id, $id_company, $id_user, 'aprovou reserva');
    }

    public function addDiscount($id, $discount, $id_user, $id_company)
    {

        $sql = $this->db->prepare("UPDATE schedule SET discount = :discount WHERE id = :id AND id_company = :id_company");

        $sql->bindValue(":id", $id);
        $sql->bindValue(":discount", $discount);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $this->setLog($id, $id_company, $id_user, 'alterou desconto');
    }

    public function addAditionalInfo($id_schedule, $info_text, $id_user, $id_company)
    {

        $sql = $this->db->prepare("INSERT INTO schedule_info SET id_schedule = :id_schedule, info_text = :info_text, date_info = NOW(), id_user = :id_user, id_company = :id_company");

        $sql->bindValue(":id_schedule", $id_schedule);
        $sql->bindValue(":info_text", $info_text);
        $sql->bindValue(":id_user", $id_user);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $this->setLog($id_schedule, $id_company, $id_user, 'adicionou informações adicionais');
    }

    public function changeStatusService($id, $status, $msg, $id_user, $id_company)
    {

        $sql = $this->db->prepare("UPDATE schedule_services SET status = :status WHERE id = :id AND id_company = :id_company");

        $sql->bindValue(":id", $id);
        $sql->bindValue(":status", $status);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $this->setLog($id, $id_company, $id_user, $msg);
    }

    public function deleteService($id, $id_user, $id_company)
    {
        $sql = $this->db->prepare("INSERT INTO schedule_history (action, id_schedule, time_action, id_user, id_company)
		SELECT 'excluiu serviço', schedule_id, NOW(), id_user, id_company FROM schedule_services WHERE id = $id");
        $sql->bindValue(":id_user", $id_user);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $sql = $this->db->prepare("DELETE FROM schedule_services WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
    }

    public function getVoucherList($id, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("
        SELECT 
            schedule_voucher.*,
            users.name_user,
            payment_methods.method
        FROM schedule_voucher 
        LEFT JOIN 
            users ON schedule_voucher.id_user = users.id 
        LEFT JOIN 
            payment_methods ON schedule_voucher.payment = payment_methods.id 
        WHERE
            schedule_voucher.schedule_id = $id AND
            schedule_voucher.id_company = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getInfoList($id, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("
        SELECT 
            schedule_info.*,
            users.name_user
        FROM schedule_info 
        LEFT JOIN 
            users ON schedule_info.id_user = users.id 
        WHERE
            schedule_info.id_schedule = $id AND
            schedule_info.id_company = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }


    public function getHistoryList($id, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("
        SELECT 
            schedule_history.*,
            users.name_user
        FROM schedule_history 
        LEFT JOIN 
            users ON schedule_history.id_user = users.id 
        WHERE
            schedule_history.id_schedule = $id AND
            schedule_history.id_company = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function addVoucher($schedule_id, $voucher_name, $voucher_value, $payment, $id_user, $id_company)
    {
        $sql = $this->db->prepare("INSERT INTO schedule_voucher SET schedule_id = :schedule_id, voucher_name = :voucher_name, voucher_value = :voucher_value, payment = :payment, id_user = :id_user, id_company = :id_company");

        $sql->bindValue(":schedule_id", $schedule_id);
        $sql->bindValue(":voucher_name", $voucher_name);
        $sql->bindValue(":voucher_value", $voucher_value);
        $sql->bindValue(":payment", $payment);
        $sql->bindValue(":id_user", $id_user);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $this->setLog($schedule_id, $id_company, $id_user, 'adicionou comprovante');
    }

    public function finalizeSchedule($id, $total_schedule, $discount, $total_cost_amount, $id_user, $id_company)
    {
        $schedule_id = $id_company;

        $sql = $this->db->prepare("UPDATE schedule SET situation = 2, schedule_date = NOW(), total_schedule = :total_schedule, total_with_discount = :total_schedule - discount, total_cost = '$total_cost_amount' WHERE id = :id AND id_company = :id_company");

        $sql->bindValue(":id", $id);
        $sql->bindValue(":total_schedule", $total_schedule);
        $sql->bindValue(":total_with_discount", $total_schedule - $discount);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $sql = $this->db->prepare("UPDATE schedule_services SET status = 2 WHERE status = 1 AND schedule_id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $due_date = date('Y-m-d', strtotime('+1 month'));

        $sql = $this->db->prepare("INSERT INTO fn_accounts_payable (description, bill_amount, account_category, release_date_of, due_date, supplier,  payment_status, id_company)
		SELECT 'Serviços referente a reserva nº $id', '$total_cost_amount', 'Serviços de Terceiros', NOW(), '$due_date', provider_id, '1', id_company FROM schedule WHERE id = $id");
        $sql->bindValue(":bill_amount", $total_cost_amount);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $id_accounts_payable = $this->db->lastInsertId();

        $sql = $this->db->prepare("INSERT INTO fn_comissions (schedule_number, bill_amount, supplier, accounts_payable_number, date_comission, id_company)
		SELECT '$id', '$total_cost_amount', provider_id, '$id_accounts_payable', NOW(), id_company FROM schedule WHERE id = $id");
        $sql->bindValue(":bill_amount", $total_cost_amount);
        $sql->bindValue(":accounts_payable_number", $id_accounts_payable);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $this->setLog($schedule_id, $id_company, $id_user, 'finalizou reserva');
    }

    public function getTotalFiltered($period1, $period2, $where_user, $where_provider, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("
            SELECT 
                schedule.client_id,
                schedule.schedule_date,
                schedule.schedule_time,
                schedule.provider_id,
                schedule.client_id,
                schedule.id_user,
                schedule.situation,
                clients.client_name,
                provider.name_provider,
                users.name_user
            FROM 
                schedule
            LEFT JOIN 
                clients ON schedule.client_id = clients.id 
            LEFT JOIN 
                provider ON schedule.provider_id = provider.id 
            LEFT JOIN 
                users ON schedule.id_user = users.id 
            WHERE 
                $where_user
                $where_provider
                schedule.id_company = $id_company 
                AND schedule.schedule_date BETWEEN '$period1' 
                AND '$period2' 
                ORDER BY schedule.id desc");
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":period1", $period1);
        $sql->bindValue(":period2", $period2);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function getAverageCost($where_provider, $period1, $period2, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("
            SELECT 
                schedule.id,
                schedule.client_id,
                schedule.schedule_date,
                schedule.schedule_time,
                schedule.provider_id,
                schedule.client_id,
                schedule.id_user,
                schedule.total_with_discount,
                schedule.total_cost,
                provider.name_provider
            FROM 
                schedule
            LEFT JOIN 
                provider ON schedule.provider_id = provider.id 
            WHERE 
                $where_provider
                schedule.id_company = $id_company 
                AND schedule.schedule_date BETWEEN '$period1' 
                AND '$period2' 
                ORDER BY schedule.id desc");
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":period1", $period1);
        $sql->bindValue(":period2", $period2);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
}
