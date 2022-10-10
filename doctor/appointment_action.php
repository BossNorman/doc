<?php

//appointment_action.php

include('../class/Appointment.php');

$object = new Appointment;

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'fetch')
	{
			$output = array();
			$order_column = array('patient_table.patient_first_name', 'doctor_schedule_table.doctor_schedule_date', 'doctor_schedule_table.doctor_schedule_day', 'appointment_table.status');

			$main_query = "
			SELECT * FROM appointment_table 
			INNER JOIN doctor_schedule_table 
			ON doctor_schedule_table.doctor_schedule_id = appointment_table.doctor_schedule_id 
			INNER JOIN patient_table 
			ON patient_table.patient_id = appointment_table.patient_id 
			";

			$search_query = '
			WHERE appointment_table.doctor_id = "'.$_SESSION["doctor_id"].'" 
			';

			if($_POST["is_date_search"] == "yes")
			{
			 	$search_query .= 'AND doctor_schedule_table.doctor_schedule_date BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" ';
			}
			else
			{
				$search_query .= '';
			}

			if(isset($_POST["search"]["value"]))
			{
				//$search_query .= 'AND (appointment_table.appointment_number LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'AND (patient_table.patient_first_name LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR patient_table.patient_last_name LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR doctor_schedule_table.doctor_schedule_date LIKE "%'.$_POST["search"]["value"].'%" ';
				// $search_query .= 'OR appointment_table.appointment_time LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR doctor_schedule_table.doctor_schedule_day LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR appointment_table.status LIKE "%'.$_POST["search"]["value"].'%") ';
			}

		if(isset($_POST["order"]))
		{
			$order_query = 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$order_query = 'ORDER BY appointment_table.appointment_id DESC ';
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

		$object->query = $main_query . $search_query;

		$object->execute();

		$total_rows = $object->row_count();

		$data = array();

		foreach($result as $row)
		{
			$sub_array = array();

			// $sub_array[] = $row["appointment_number"];

			$sub_array[] = $row["patient_first_name"] . ' ' . $row["patient_last_name"];

			$sub_array[] = $row["doctor_schedule_date"];

			// $sub_array[] = $row["appointment_time"];

			$sub_array[] = $row["doctor_schedule_day"];

			$status = '';

			if($row["status"] == 'Booked')
			{
				$status = '<span class="badge badge-warning">' . $row["status"] . '</span>';
			}

			if($row["status"] == 'Reject' OR $row["status"] == 'Cancel')
			{
				$status = '<span class="badge badge-danger">' . $row["status"] . '</span>';
			}

			if($row["status"] == 'Completed')
			{
				$status = '<span class="badge badge-success">' . $row["status"] . '</span>';
			}

			if($row["status"] == 'Accept')
			{
				$status = '<span class="badge badge-primary">' . $row["status"] . '</span>';
			}

			$sub_array[] = $status;

			$action = '';
			if($row["status"] == 'Booked' OR $row["status"] == 'Reject' OR $row["status"] == 'Accept')
			{
				$action ='
				<div align="center">
				<button type="button" name="view_button" class="btn btn-info btn-circle btn-sm view_button" data-id="'.$row["appointment_id"].'"><i class="fas fa-eye"></i></button>
				<button type="button" name="status_button" class="btn btn-primary btn-circle btn-sm status_button" data-id="'.$row["appointment_id"].'" data-status="'.$row["status"].'"><i class="fas fa-sync-alt"></i></button>
				</div>
				';
			}
			else{
				$action ='
				<div align="center">
				<button type="button" name="view_button" class="btn btn-info btn-circle btn-sm view_button" data-id="'.$row["appointment_id"].'"><i class="fas fa-eye"></i></button>
				</div>
				';
			}
			$sub_array[] = $action;


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
		SELECT * FROM appointment_table 
		WHERE appointment_id = '".$_POST["appointment_id"]."'
		";

		$appointment_data = $object->get_result();

		foreach($appointment_data as $appointment_row)
		{

			$object->query = "
			SELECT * FROM patient_table 
			WHERE patient_id = '".$appointment_row["patient_id"]."'
			";

			$patient_data = $object->get_result();

			$object->query = "
			SELECT * FROM doctor_schedule_table 
			INNER JOIN doctor_table 
			ON doctor_table.doctor_id = doctor_schedule_table.doctor_id 
			WHERE doctor_schedule_table.doctor_schedule_id = '".$appointment_row["doctor_schedule_id"]."'
			";

			$doctor_schedule_data = $object->get_result();

			$html = '
			<h4 class="text-center">Patient Details</h4>
			<table class="table">
			';

			foreach($patient_data as $patient_row)
			{
				$html .= '
				<tr>
					<th width="40%" class="text-right">Patient Name</th>
					<td>'.$patient_row["patient_first_name"].' '.$patient_row["patient_last_name"].'</td>
				</tr>
				<tr>
					<th width="40%" class="text-right">Contact No.</th>
					<td>'.$patient_row["patient_phone_no"].'</td>
				</tr>
				<tr>
					<th width="40%" class="text-right">Address</th>
					<td>'.$patient_row["patient_address"].'</td>
				</tr>
				';
			}

			$html .= '
			</table>
			<hr />
			<h4 class="text-center">Appointment Details</h4>
			<table class="table">
				
			';
			foreach($doctor_schedule_data as $doctor_schedule_row)
			{
				$html .= '
				<tr>
					<th width="40%" class="text-right">Doctor Name</th>
					<td>'.$doctor_schedule_row["doctor_name"].'</td>
				</tr>
				<tr>
					<th width="40%" class="text-right">Appointment Date</th>
					<td>'.$doctor_schedule_row["doctor_schedule_date"].'</td>
				</tr>
				<tr>
					<th width="40%" class="text-right">Appointment Day</th>
					<td>'.$doctor_schedule_row["doctor_schedule_day"].'</td>
				</tr>
				<tr>
					<th width="40%" class="text-right">Appointment Time</th>
					<td>'.$doctor_schedule_row["doctor_schedule_start_time"].'-'.$doctor_schedule_row["doctor_schedule_end_time"].'</td>
				</tr>
				
				';
			}

			$html .= '
				<tr>
					<th width="40%" class="text-right">Reason for Appointment</th>
					<td>'.$appointment_row["reason_for_appointment"].'</td>
				</tr>
			';

			if($appointment_row["status"] != 'Cancel')
			{
						if($appointment_row["status"] == 'Completed')
						{
							$html .= '
								<tr>
									<th width="40%" class="text-right">Doctor Comment</th>
									<td>
										<textarea name="doctor_comment" id="doctor_comment" class="form-control" rows="8" required>'.$appointment_row["doctor_comment"].'</textarea>
									</td>
								</tr
							';
						}
						else
						{
							$html .= '
								<tr>
									<th width="40%" class="text-right">Doctor Comment</th>
									<td>
										<textarea name="doctor_comment" id="doctor_comment" class="form-control" rows="8" required></textarea>
									</td>
								</tr
							';
						}
			}

			$html .= '
			</table>
			';
		}

		echo $html;
	}

	if($_POST["action"] == 'change_status')
	{
		$data = array(
			':status'		=>	$_POST['next_status']
		);
		$object->query = "
		UPDATE appointment_table 
		SET status = :status 
		WHERE appointment_id = '".$_POST["id"]."'
		";
		$object->execute($data);
		echo '<div class="alert alert-success">Doctor Schedule Status change to '.$_POST['next_status'].'</div>';
	}

	if($_POST['action'] == 'change_appointment_status')
	{
			if(isset($_POST['doctor_comment']))
			{
				$data = array(
					':status'							=>	'Completed',
					':doctor_comment'					=>	$_POST['doctor_comment'],
					':appointment_id'					=>	$_POST['hidden_appointment_id']
				);

				$object->query = "
				UPDATE appointment_table 
				SET status = :status, 
				doctor_comment = :doctor_comment 
				WHERE appointment_id = :appointment_id
				";

				$object->execute($data);

				echo '<div class="alert alert-success">Appointment Completed</div>';
			}
	}
}

?>