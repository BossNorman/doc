<?php

//doctor_action.php

include('../class/Appointment.php');

$object = new Appointment;

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'fetch')
	{
		$order_column = array('patient_first_name', 'patient_last_name', 'patient_email_address', 'patient_phone_no');

		$output = array();

		$main_query = "
		SELECT * FROM patient_table ";

		$search_query = '';

		if(isset($_POST["search"]["value"]))
		{
			$search_query .= 'WHERE patient_first_name LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR patient_last_name LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR patient_email_address LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR patient_phone_no LIKE "%'.$_POST["search"]["value"].'%" ';
		}

		if(isset($_POST["order"]))
		{
			$order_query = 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$order_query = 'ORDER BY patient_id DESC ';
		}

		$limit_query = '';

		if($_POST["length"] != -1)
		{
			$limit_query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$object->query = $main_query . $search_query . $order_query;

		$object->execute();

		$filtered_rows = $object->row_count();

		$object->query .= $limit_query;

		$result = $object->get_result();

		$object->query = $main_query;

		$object->execute();

		$total_rows = $object->row_count();

		$data = array();

		foreach($result as $row)
		{
			$sub_array = array();
			$sub_array[] = $row["patient_first_name"];
			$sub_array[] = $row["patient_last_name"];
			$sub_array[] = $row["patient_email_address"];
			$sub_array[] = $row["patient_phone_no"];
			$sub_array[] = '
			<div align="center">
			<button type="button" name="view_button" class="btn btn-info btn-circle btn-sm view_button" data-id="'.$row["patient_id"].'"><i class="fas fa-eye"></i></button>
			</div>
			';
			$data[] = $sub_array;
		}

		$output = array(
			"draw"    			=> 	intval($_POST["draw"]),
			"recordsTotal"  	=>  $total_rows,
			"recordsFiltered" 	=> 	$filtered_rows,
			"data"    			=> 	$data
		);
			
		echo json_encode($output);

	}

	if($_POST["action"] == 'fetch_single')
	{
		$object->query = "
		SELECT * FROM patient_table 
		WHERE patient_id = '".$_POST["patient_id"]."'
		";

		$result = $object->get_result();

		$data = array();

		foreach($result as $row)
		{
			$data['patient_email_address'] = $row['patient_email_address'];
			$data['patient_password'] = $row['patient_password'];
			$data['patient_first_name'] = $row['patient_first_name'];
			$data['patient_last_name'] = $row['patient_last_name'];
			$data['patient_phone_no'] = $row['patient_phone_no'];
		}

		echo json_encode($data);
	}
}

?>