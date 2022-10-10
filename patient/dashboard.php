<?php
include('../class/Appointment.php');

$object = new Appointment;

include('header.php');

?>
<section id="Symptoms">
    <header class="bg-primary bg-gradient text-white" style="padding-top: 100px; padding-bottom: 100px;">
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

<div id="appointmentModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="appointment_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Make Appointment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="appointment_detail"></div>
                    <div class="form-group">
                        <label><b>Reason for Appointment</b></label>
                        <textarea name="reason_for_appointment" id="reason_for_appointment" class="form-control"
                            required rows="5"></textarea>
                    </div>
                    <span id="form_message"></span>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="hidden_doctor_id" id="hidden_doctor_id" />
                    <input type="hidden" name="hidden_doctor_schedule_id" id="hidden_doctor_schedule_id" />
                    <input type="hidden" name="action" id="action" value="book_appointment" />
                    <input type="submit" name="submit" id="submit_button" class="btn btn-success" value="Book" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
$(document).ready(function() {

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
            "targets": [2, 6],
            "orderable": false,
        }, ],
    });

    $(document).on('click', '.get_appointment', function() {

        var doctor_schedule_id = $(this).data('doctor_schedule_id');
        var doctor_id = $(this).data('doctor_id');

        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                action: 'make_appointment',
                doctor_schedule_id: doctor_schedule_id
            },
            success: function(data) {
                $('#appointmentModal').modal('show');
                $('#hidden_doctor_id').val(doctor_id);
                $('#hidden_doctor_schedule_id').val(doctor_schedule_id);
                $('#appointment_detail').html(data);
            }
        });

    });

    $('#appointment_form').parsley();

    $('#appointment_form').on('submit', function(event) {

        event.preventDefault();

        if ($('#appointment_form').parsley().isValid()) {

            $.ajax({
                url: "action.php",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('#submit_button').attr('disabled', 'disabled');
                    $('#submit_button').val('wait...');
                },
                success: function(data) {
                    $('#submit_button').attr('disabled', false);
                    $('#submit_button').val('Book');
                    if (data.error != '') {
                        $('#form_message').html(data.error);
                    } else {
                        window.location.href = "appointment.php";
                    }
                }
            })

        }

    })

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