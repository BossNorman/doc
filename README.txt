# I.D.R.A.S
(Intelligent Doctor Recommender and Appointment System)

This system is Online Health Care System which similar to [zocdoc](https://zocdoc.com), [practo](https://practo.com) in some extent. But it has a feature of symptoms checker.

## Symptoms Checker
Has the ability to select symptoms by body location. Then predict the possible disease. The symptoms checker was from [apimedic](https://apimedic.com).

## Doctor Appointment
The appointment has 4 user type: Guest, Registered User/ Patient, Doctor, Admin

* GUEST 
     -Symptoms Checker
     -View Available Appointment

* PATIENT/REGISTERED USER (patient1@gmail.com 12345)
    -Symptoms Checker
    -View Available Appointment 
    -Book Appointment
    -Appointment History
    -Edit Profile

* DOCTOR (johndoe@gmail.com password)
    -Manage own Appointment
    -Manage own Schedule
    -Edit Profile

* ADMIN (admin@admin.com password)
    -Manage Doctor
    -Add Doctor
    -View Registered User/ User



## Installation
Before running the code, signup [apimedic](https://apimedic.com) to get Sandbox Password.

Go to "doc/SampleAvatar/index.php" and change the following:

```
//change "YOUR_EMAIL" and "YOUR_PASSWORD" from apimedic.com
$tokenGenerator = new TokenGenerator (("YOUR_EMAIL","YOUR_PASSWORD","https://sandbox-authservice.priaid.ch/login");
```
