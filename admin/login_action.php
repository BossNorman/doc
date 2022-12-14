<?php

//login_action.php

include('../class/Appointment.php');

$object = new Appointment;

if (isset($_POST["admin_email_address"])) {
	sleep(2);
	$error = '';
	$url = '';
	$data = array(
		':admin_email_address'	=>	$_POST["admin_email_address"]
	);

	$object->query = "
		SELECT * FROM admin_table 
		WHERE admin_email_address = :admin_email_address
	";

	$object->execute($data);

	$total_row = $object->row_count();
	$result = $object->statement_result();

	foreach ($result as $row) {
		if ($_POST["admin_password"] == $row["admin_password"]) {
			$_SESSION['admin_id'] = $row['admin_id'];
			$_SESSION['type'] = 'Admin';
			$url = $object->base_url . 'admin/dashboard.php';
		} else {
			$error = '<div class="alert alert-danger">Wrong Password</div>';
		}
	}

	$output = array(
		'error'		=>	$error,
		'url'		=>	$url
	);

	echo json_encode($output);
}
