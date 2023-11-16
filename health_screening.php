<?php
include('navigation-login.php'); // Include the navigation bar
include('floating-menu.php'); // Include the floating menu
include('header.php');
include('connection.php');
?>

    <body>
        <div class="banner-make-appointment">
            <div class="breadcrumb-div">
                <p>
                    <a href="index.html">HOME</a> &nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;&nbsp; <a href="doctor_appointment.html">MAKE APPOINTMENT</a> &nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;&nbsp; <span class="selected-page">Health-Screening Appointment</span>
                </p>
            </div>
            <div class="banner-text">
                <p class="page-title">HEALTH-SCREENING<br> APPOINTMENT</p>
                <p class="page-text">Your health is our priority. Book an <br> appointment or enquire with us today.</p>
            </div>
        </div>

        <br>
        <br>

        <div class="container border rounded p-4 mt-5 container-color">
            <!-- Form Section -->
            <div class="container-form">
                <form action="confirm-health-screening.php" method="post" id="appointment-form">
                    <div class="formBox20210318 formBox20210318SZ" v-show="step2 == 1">
                        <label for="patientDetails">Patient's Details</label>
                        <ul class="list-unstyled">
                            <li class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <ion-icon name="person-circle-outline"></ion-icon>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="name" id="name" value="<?php echo isset($_SESSION['health_screening']['patient']['PatientName']) ? $_SESSION['health_screening']['patient']['PatientName'] : ''; ?>" placeholder="Name">

                                    &nbsp;&nbsp;&nbsp;
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <ion-icon name="medkit-outline"></ion-icon>
                                        </span>
                                    </div>
                                    <select v-model="patient.TheTypeOfPatient" class="form-control" name="package" id="package">
                                        <option value="">Health Package</option>
                                        <option value='1'>Women's Health Screening</option>
                                        <option value='0'>Men's Health Screening</option>
                                        <option value='2'>Wellness Screening</option>
                                        <option value='3'>Blood Screening</option>
                                        <option value='4'>Stroke Screening</option>
                                    </select>
                                </div>
                            </li>
                            <li class="form-group">
                                <div class="input-group dob">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <ion-icon name="transgender-outline"></ion-icon>
                                        </span>
                                    </div>
                                    <select v-model="patient.userGender" class="form-control" name="gender" id="gender">
                                        <option value="">Gender</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                    &nbsp;&nbsp;&nbsp;
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <ion-icon name="calendar-outline"></ion-icon>
                                        </span>
                                    </div>
                                    <input class="form-control" type="text" v-model="patient.Birthday" name ="birthdate" id="birthdate" placeholder="Date of Birth" onfocus="(this.type='date')" onblur="(this.type='text')">
                                </div>
                            </li>

                            <li class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <ion-icon name="finger-print-outline"></ion-icon>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" v-model="patient.PatientName" name="nric" id="nric" placeholder="NRIC / Passport No.">
                                    &nbsp;&nbsp;&nbsp;
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <ion-icon name="call-outline"></ion-icon>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" v-model="patient.PhoneNumbers"  name="phonenumber" id="phonenumber" placeholder="Phone Number">
                                </div>
                            </li>

                            <li class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <ion-icon name="home-outline"></ion-icon>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" v-model="patient.Patientaddress"  name="patientaddress" id="patientaddress" placeholder="Address">
                                </div>
                            </li>

                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="appointmentDate">Appointment Date</label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">
                                                <ion-icon name="calendar-outline"></ion-icon>
                                            </span>
                                        </span>
                                        <input type="text" class="form-control"  name="appointmentDate" id="appointmentDate" v-model="patient.appointmentDate" placeholder="Date of Appointment" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="appointmentTime">Appointment Time</label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">
                                                <ion-icon name="time-outline"></ion-icon>
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" name="appointmentTime" id="appointmentTime" v-model="patient.appointmentTime" placeholder="Time of Appointment" onfocus="(this.type='time')" onblur="(this.type='text')">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <li class="form-group">
                                <label for="location">Location</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">
                                            <ion-icon name="location-outline"></ion-icon>
                                        </span>
                                    </span>
                                    <select class="form-control" name="location" id="location" v-model="patient.location">
                                        <option value="">Select Location</option>
                                        <option value="Location 1">Location 1</option>
                                        <option value="Location 2">Location 2</option>
                                        <option value="Location 3">Location 3</option>
                                    </select>
                                </div>
                            </li>


                            <li class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <ion-icon name="create-outline"></ion-icon>
                                        </span>
                                    </div>
                                    <textarea class="form-control" v-model="patient.issue" name="description" id="description" placeholder="Describe the issue you are facing" rows="4"></textarea>
                                </div>
                            </li>
                        </ul>
                        <div class="form-check">
                            <input name="staPopCheck1" type="checkbox" class="form-check-input" @click="checkBtn1">
                            <label class="form-check-label">
                                I have read and agreed to the 'Personal Information Protection Policy'.
                            </label>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-3">
                    <a href="make-appointment.php">
                        <button class="btn btn-light custom-btn-done next-button" style="width: 150px;">Previous</button>
                    </a>

                    <button type="submit" class="btn btn-sprimary custom-btn prev-button" style="width: 150px;">Next</button>
                </div>
            </form>
        </div>
    </body>

<?php
    include('footer.php');
?>