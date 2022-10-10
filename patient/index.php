<?php

//index.php

include('../class/Appointment.php');
$object = new Appointment;

if(isset($_SESSION['patient_id']))
{
	header('location:dashboard.php');
}

include('header.php');

?>

<section id="Symptoms">
    <header class="bg-primary bg-gradient text-white" style="padding-top: 50px; padding-bottom: 50px;">
        <div class="container px-4 text-center"><br>
            <h1 class="fw-bolder">Welcome to I.D.R.A.S.</h1>
            <P>(Intelligent Doctor Recommender and Appointment System)</P>
            <p class="lead">I.D.R.A.S. can recommend you a doctor through the symptoms checker.<br> SYMPTOMS CHECKER has
                ability to select symptoms by body location. <br>We hope this makes it easier for you to identify your
                symptoms and possible conditions.</p>
            <!-- Button -->
            <a href="../sampleavatar" class="btn btn-lg btn-light">SYMPTOMS CHECKER</a>
        </div>
    </header>
</section>

<section id="Book" style="padding-top: 100px; padding-bottom: 100px;">
    <!-- <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4>Doctor Schedule List</h4>
            </div> -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-sm-6">
                    <h6 class="m-0 font-weight-bold text-danger">Appointment List</h6>
                </div>
                <div class="col-sm-6" align="right">
                    <div class="row">
                        <div class="col-md-10">
                        </div>
                        <div class="col-md-1">
                            <div class="row">
                                <button type="button" name="refresh" id="refresh" class="btn btn-secondary btn-sm"><i
                                        class="fas fa-sync-alt"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="appointment_list_table">
                    <thead>
                        <tr>
                            <th>Doctor Name</th>
                            <th>Clinic Name</th>
                            <th>Specialization</th>
                            <th>Appointment Date</th>
                            <th>Appointment Day</th>
                            <th>Available Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</section>

<?php

include('footer.php');

?>

<script>
$(document).ready(function() {
// fetch datatable
    var dataTable = $('#appointment_list_table').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "action.php",
            type: "POST",
            data: {
                action: 'fetch_schedule'
            }
        },
        "columnDefs": [{
            "targets": [6],
            "orderable": false,
        }, ],
    });

// check login user
    $(document).on('click', '.get_appointment', function() {
        var action = 'check_login';
        var doctor_schedule_id = $(this).data('id');
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                action: action,
                doctor_schedule_id: doctor_schedule_id
            },
            success: function(data) {
                window.location.href = data;
            }
        })
    });

// Refresh
    $('#refresh').click(function() {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                action: 'refresh'
            },
            success: function(data) {
                window.location.href = data;
            }
        })
    });
});
</script>