<?php

//patient.php

include('../class/Appointment.php');

$object = new Appointment;

include('header.php');

?>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Patient Management</h1>

                    <!-- DataTales Example -->
                    <span id="message"></span>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        	<div class="row">
                            	<div class="col">
                            		<h6 class="m-0 font-weight-bold text-danger">Patient List</h6>
                            	</div>
                            	<div class="col" align="right">
                            	</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="patient_table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email Address</th>
                                            <th>Contact No.</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                <?php
                include('footer.php');
                ?>

<div id="viewModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_title">View Patient Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="patient_details">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){

	var dataTable = $('#patient_table').DataTable({
		"processing" : true,
		"serverSide" : true,
		"order" : [],
		"ajax" : {
			url:"patient_action.php",
			type:"POST",
			data:{action:'fetch'}
		},
		"columnDefs":[
			{
				"targets":[4],
				"orderable":false,
			},
		],
	});

    $(document).on('click', '.view_button', function(){

        var patient_id = $(this).data('id');

        $.ajax({

            url:"patient_action.php",

            method:"POST",

            data:{patient_id:patient_id, action:'fetch_single'},

            dataType:'JSON',

            success:function(data)
            {
                var html = '<div class="table-responsive">';

                html += '<table class="table">';

                html += '<tr><th width="40%" class="text-right">Email Address</th><td width="60%">'+data.patient_email_address+'</td></tr>';

                html += '<tr><th width="40%" class="text-right">Password</th><td width="60%">'+data.patient_password+'</td></tr>';

                html += '<tr><th width="40%" class="text-right">Patient Name</th><td width="60%">'+data.patient_first_name+' '+data.patient_last_name+'</td></tr>';

                html += '<tr><th width="40%" class="text-right">Contact No.</th><td width="60%">'+data.patient_phone_no+'</td></tr>';

                html += '</table></div>';

                $('#viewModal').modal('show');

                $('#patient_details').html(html);

            }

        })
    });
});
</script>