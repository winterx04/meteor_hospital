<?php
include('navigation-login.php'); // Include the navigation bar
include('floating-menu.php'); // Include the floating menu
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
    <body>
        <div class="banner-make-appointment">
            <div class="breadcrumb-div">
                <p>
                    <a href="index.html">HOME</a> &nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;&nbsp; <a href="doctor_appointment.html">MAKE APPOINTMENT</a> &nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;&nbsp; <span class="selected-page">Doctor's Appointment</span>
                </p>
            </div>
            <div class="banner-text">
                <p class="page-title">APPOINTMENT /<br> ENQUIRY</p>
                <p class="page-text">Your health is our priority. Book an <br> appointment or enquire with us today.</p>
            </div>
        </div>
        
        <br>
        <br>

        <div class="button-container">
            <a href="consultation_appointment.php">
                <button class="btn btn-white custom-btn-done prev-button" href="consultation_appointment.php">Previous</button>
            </a>
        </div>

        <div class="container border rounded p-4 mt-5 container-color form-step" id="step2">
            <!-- Form Section -->
            <div class="container-form">
                <div class="formBox20210318 formBox20210318SZ" v-show="step2 == 1">
                    <ul class="list-unstyled">
                        <li class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <ion-icon name="person-circle-outline"></ion-icon>
                                    </span>
                                </div>
                                <input type="text" class="form-control" v-model="patient.PatientName" placeholder="Name">
                                &nbsp;&nbsp;&nbsp;
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <ion-icon name="card-outline"></ion-icon>
                                    </span>
                                </div>
                                <select v-model="patient.TheTypeOfPatient" class="form-control">
                                    <option value="">Payment Method</option>
                                    <option value='1'>Medical Insurance</option>
                                    <option value='0'>Self-Payment</option>
                                    <option value='2'>Medical Insurance (Out-of-Pocket)</option>
                                    <option value='3'>Medical Insurance (Special Cases)</option>
                                    <option value='4'>Public Healthcare</option>
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
                                <select v-model="patient.userGender" class="form-control">
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
                                <input class="form-control" type="text" v-model="patient.Birthday" id="birthdate-input" placeholder="Date of Birth" onfocus="(this.type='date')" onblur="(this.type='text')">
                            </div>
                        </li>

                        <li class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <ion-icon name="finger-print-outline"></ion-icon>
                                    </span>
                                </div>
                                <input type="text" class="form-control" v-model="patient.PatientName" placeholder="NRIC / Passport No.">
                                &nbsp;&nbsp;&nbsp;
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <ion-icon name="call-outline"></ion-icon>
                                    </span>
                                </div>
                                <input type="text" class="form-control" v-model="patient.PhoneNumbers" placeholder="Phone Number">
                            </div>
                        </li>

                        <li class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <ion-icon name="home-outline"></ion-icon>
                                    </span>
                                </div>
                                <input type="text" class="form-control" v-model="patient.Patientaddress" placeholder="Address">
                            </div>
                        </li>

                        <li class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </span>
                                </div>
                                <textarea class="form-control" v-model="patient.issue" placeholder="Describe the issue you are facing" rows="4"></textarea>
                            </div>
                        </li>
                    </ul>

                    <br>

                    <div class="form-group telemedicine-form-group date-time row" id="step3">
                        <label class="label-telemedicine" for="doctor-choice"><strong>Select Specialist and Doctor</strong></label>
                        <div class="col-md-6 col-12">
                            <select onChange="populate('specialty','doc');" class="form-select homepage-dropdown w-100" id="specialty">
                                <option selected value="">Select Specialist (Optional)</option>
                                <option value="Anesthesiology">Anesthesiology</option>
                                <option value="Cardiology">Cardiology</option>
                                <option value="Dermatology">Dermatology</option>
                                <option value="Emergency Medicine">Emergency Medicine</option>
                                <option value="Endocrinology">Endocrinology</option>
                                <option value="Gastroenterology">Gastroenterology</option>
                                <option value="General Surgery">General Surgery</option>
                                <option value="Hematology">Hematology</option>
                                <option value="Neurology">Neurology</option>
                                <option value="Pulmonology">Pulmonology</option>
                                <option value="Radiology">Radiology</option>
                                <option value="Urology">Urology</option>
                            </select>
                        </div>

                        <div class="col-md-6 col-12">
                            <select class="form-select homepage-dropdown w-100" id="doc">
                                <option id="select" selected>Select Preferred Doctor</option>
                                <option value="Dr. Tan Wei Ling">Dr. Tan Wei Ling - Anesthesiologist</option>
                                <option value="Dr. Lim Chee Meng">Dr. Lim Chee Meng - Cardiologist</option>
                                <option value="Dr. Siti Aisyah Abdul Rahman">Dr. Siti Aisyah Abdul Rahman - Dermatologist</option>
                                <option value="Dr. Mohamed Faizal bin Abdullah">Dr. Mohamed Faizal bin Abdullah - Emergency Physician</option>
                                <option value="Dr. Liew Mei Ling">Dr. Liew Mei Ling - Endocrinologist</option>
                                <option value="Dr. Ahmad bin Hassan">Dr. Ahmad bin Hassan - Gastroenterologist</option>
                                <option value="Dr. Lim Kah Wei">Dr. Lim Kah Wei - Gastroenterologist</option>
                                <option value="Dr. Chong Mei Ling">Dr. Chong Mei Ling - Gastroenterologist</option>
                                <option value="Dr. Ng Li Hua">Dr. Ng Li Hua - General Surgeon</option>
                                <option value="Dr. Raj Kumar a/l Subramaniam">Dr. Raj Kumar a/l Subramaniam - Hematologist</option>
                                <option value="Dr. Tan Mei Yen">Dr. Tan Mei Yen - Neurologist</option>
                                <option value="Dr. Raju a/l Muthu">Dr. Raju a/l Muthu - Pulmonologist</option>
                                <option value="Dr. Wong Mei Kwan">Dr. Wong Mei Kwan - Radiologist</option>
                                <option value="Dr. Lee Ming Hui">Dr. Lee Ming Hui - Anesthesiologist</option>
                                <option value="Dr. Tan Mei Yen">Dr. Tan Mei Yen - Urologist</option>
                            </select>
                        </div>
                    </div>

                    <!-- Appointment Date -->
                    <div class="form-group telemedicine-form-group date-time">
                        <label class="label-telemedicine" for="datetime"><strong>Select Date & Time:</strong></label>
                        <div class="row">
                            <div class="col">
                                <input class="form-control" type="text" name="date" id="date" placeholder="Select Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="time" id="time" placeholder="Select Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                            </div>
                        </div>
                    </div>
                    
                    <br>
                    <br>
                    
                    <div class="form-check">
                        <input name="staPopCheck1" type="checkbox" class="form-check-input" @click="checkBtn1">
                        <label class="form-check-label">
                            I have read and agreed to the 'Personal Information Protection Policy'.
                        </label>
                    </div>
                </div>
            </div>

            <div class="text-center mt-3">
                <a href="confirm-appointment.php">
                    <button class="make-appointment-button btn btn-primary mx-auto">Make Appointment</button>
                </a>
            </div>
        </div>

        <br><br><br><br><br>
    </body>
</html>

<?php
include('footer.php');
?>