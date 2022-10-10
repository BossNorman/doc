<?php
include('../class/Appointment.php');

$object = new Appointment;
$object->query = "
SELECT * FROM patient_table
INNER JOIN appointment_table
ON appointment_table.patient_id = patient_table.patient_id 
INNER JOIN doctor_table 
ON doctor_table.doctor_id = appointment_table.doctor_id 
INNER JOIN doctor_schedule_table 
ON doctor_schedule_table.doctor_schedule_id = appointment_table.doctor_schedule_id
WHERE appointment_id = '".$_GET["id"]."';
";
$result = $object->get_result();

include('header.php');
?>

<div style="padding-top: 5px; padding-bottom: 10px;"></div>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="../css/invoice.css">
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="../images/logo.png" style="width:100%; max-width:300px;">
                            </td>

                            <td>
                                Created: <?php echo date("d-m-Y");?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
<?php foreach($result as $row){?>
                        <tr>
                            <td>
                            <?php foreach($result as $row){?>
                                <?php echo $row["patient_address"];?>
                            <?php }?>
                            </td>

                            <td>
                                <?php echo $row['patient_first_name'];?>
                                <?php echo $row['patient_last_name'];?><br>
                                <?php echo $row['patient_email_address'];?><br>
                                <?php echo $row['patient_phone_no'];?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Appointment Details
                </td>

                <td>
                    #
                </td>
            </tr>

            <tr class="item">
                <td>
                    Appointment ID
                </td>

                <td>
                    <?php echo $row['appointment_id'];?>
                </td>
            </tr>

            <tr class="item">
                <td>
                    Appointment Day
                </td>

                <td>
                    <?php echo $row['doctor_schedule_day'];?>
                </td>
            </tr>


            <tr class="item">
                <td>
                    Appointment Date
                </td>

                <td>
                    <?php echo $row['doctor_schedule_date'];?>
                </td>
            </tr>

            <tr class="item">
                <td>
                    Appointment Time
                </td>

                <td>
                    <?php echo $row['doctor_schedule_start_time'];?> untill
                    <?php echo $row['doctor_schedule_start_time'];?>
                </td>
            </tr>

            <tr class="item">
                <td>
                    Reason to Appointment
                </td>

                <td>
                    <?php echo $row['reason_for_appointment'];?>
                </td>
            </tr>
            <tr class="item">
                <td>
                    Doctor Diagnosis
                </td>

                <td>
                    <?php echo $row['doctor_comment'];?>
                </td>
            </tr>
        </table>
<?php }?>
    </div>
    <div class="print">
        <button onclick="myFunction()">Print this page</button>
    </div>
    <script>
    function myFunction() {
        window.print();
    }
    </script>
</body>

</html>