const prevBtns = document.querySelectorAll(".btn-prev");
const nextBtns = document.querySelectorAll(".btn-next");
const progress = document.getElementById("progress");
const formSteps = document.querySelectorAll(".form-step");
const progressSteps = document.querySelectorAll(".progress-step");

let formStepsNum = 0;

nextBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    formStepsNum++;
    updateFormSteps();
    updateProgressbar();
  });
});

prevBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    formStepsNum--;
    updateFormSteps();
    updateProgressbar();
  });
});

function updateFormSteps() {
  formSteps.forEach((formStep) => {
    formStep.classList.contains("form-step-active") &&
      formStep.classList.remove("form-step-active");
  });

  formSteps[formStepsNum].classList.add("form-step-active");
}

function updateProgressbar() {
    progressSteps.forEach((progressStep, idx) => {
        if (idx < formStepsNum + 1) {
        progressStep.classList.add("progress-step-active");
        } else {
        progressStep.classList.remove("progress-step-active");
        }
    });

    const progressActive = document.querySelectorAll(".progress-step-active");

    progress.style.width = ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
}

document.addEventListener('DOMContentLoaded', function () {
    const dateInput = document.getElementById('birthdate-input');
    dateInput.placeholder = 'Date of Birth';
});

document.addEventListener("DOMContentLoaded", function () {
    var nav = document.querySelector(".navbar");
    window.addEventListener("scroll", function() {
        if (window.scrollY > 0) {
            nav.classList.add("scrolled");
        } else {
            nav.classList.remove("scrolled");
        }
    });
});

// Ensure the DOM is fully loaded before executing the script
document.addEventListener('DOMContentLoaded', function () {
    // Get references to the select elements
    const specialistSelect = document.getElementById('specialist');
    const doctorSelect = document.getElementById('doctor');

    // Function to filter doctors based on the selected specialist
    function filterDoctors() {
        const selectedSpecialist = specialistSelect.value;
        const doctorOptions = doctorSelect.querySelectorAll('option');

        // Hide all doctor options
        doctorOptions.forEach(option => {
            option.style.display = 'none';
        });

        // Show only the doctors matching the selected specialist
        doctorOptions.forEach(option => {
            if (option.getAttribute('data-specialist') === selectedSpecialist || selectedSpecialist === 'all') {
                option.style.display = 'block';
            }
        });

        // Reset the doctor select to "Select a Doctor"
        doctorSelect.value = 'Select a Doctor';
    }

    // Add a change event listener to the specialist select element
    specialistSelect.addEventListener('change', filterDoctors);

    // Initial filtering when the page loads
    filterDoctors();
});

// ---------- Progress Bar ------------
// JavaScript to handle progress bar and form steps
document.addEventListener("DOMContentLoaded", function () {

    const prevBtns = document.querySelectorAll(".btn-prev");
const nextBtns = document.querySelectorAll(".btn-next");
const progress = document.getElementById("progress");
const progressSteps = document.querySelectorAll(".progress-step");

let formStepsNum = 0;

nextBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    formStepsNum++;
    updateProgressbar();
  });
});

prevBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    formStepsNum--;
    updateProgressbar();
  });
});

function updateProgressbar() {
  progressSteps.forEach((progressStep, idx) => {
    if (idx < formStepsNum) {
      progressStep.classList.add("progress-step-active");
    } else {
      progressStep.classList.remove("progress-step-active");
    }
  });

  progress.style.width = (formStepsNum / (progressSteps.length - 1)) * 100 + "%";
}

    
});


// --------- Donation script ---------
function makeEnquiry() {
    window.location.href = "Make-appointment.html";
}


// ----------- Make appointment script ---------
// choose-specialist-doctors.php
function populate(s1, s2) {
    var specialty = document.getElementById(s1);
    var doc = document.getElementById(s2);

    var select = document.getElementById(s2).options.length;
    for (var i = select; i > 0; i--) {
        document.getElementById(s2).options.remove(i);
        console.log(i);
    }
    document.getElementById('select').selected = 'selected';
    var optionArray = [];
    if (specialty.value == "Anesthesiology") {
        optionArray = ["dr. tan wei ling|Dr. Tan Wei Ling - Anesthesiologist", "dr. lim chee meng|Dr. Lim Chee Meng - Anesthesiologist", "dr. lee ming hui|Dr. Lee Ming Hui - Anesthesiologist"];
    } else if (specialty.value == "Cardiology") {
        optionArray = ["dr. lim chee meng|Dr. Lim Chee Meng - Cardiologist", "dr. mohamed faizal bin abdullah|Dr. Mohamed Faizal bin Abdullah - Cardiologist", "dr. genesis lever|Dr. Genesis Lever - Cardiologist"];
    } else if (specialty.value == "Dermatology") {
        optionArray = ["dr. siti aisyah abdul rahman|Dr. Siti Aisyah Abdul Rahman - Dermatologist", "dr. mohamed faizal bin abdullah|Dr. Mohamed Faizal bin Abdullah - Dermatologist", "dr. lim chee meng|Dr. Lim Chee Meng - Dermatologist"];
    } else if (specialty.value == "Emergency Medicine") {
        optionArray = ["dr. mohamed faizal bin abdullah|Dr. Mohamed Faizal bin Abdullah - Emergency Physician", "dr. lim kah wei|Dr. Lim Kah Wei - Emergency Physician", "dr. liew mei ling|Dr. Liew Mei Ling - Emergency Physician"];
    } else if (specialty.value == "Endocrinology") {
        optionArray = ["dr. liew mei ling|Dr. Liew Mei Ling - Endocrinologist", "dr. ahmad bin hassan|Dr. Ahmad bin Hassan - Endocrinologist", "dr. lim chee meng|Dr. Lim Chee Meng - Endocrinologist"];
    } else if (specialty.value == "Gastroenterology") {
        optionArray = ["dr. lim kah wei|Dr. Lim Kah Wei - Gastroenterologist", "dr. chong mei ling|Dr. Chong Mei Ling - Gastroenterologist", "dr. ng li hua|Dr. Ng Li Hua - Gastroenterologist"];
    } else if (specialty.value == "General Surgery") {
        optionArray = ["dr. ng li hua|Dr. Ng Li Hua - General Surgeon", "dr. raj kumar a/l subramaniam|Dr. Raj Kumar a/l Subramaniam - General Surgeon", "dr. tan mei yen|Dr. Tan Mei Yen - General Surgeon"];
    } else if (specialty.value == "Hematology") {
        optionArray = ["dr. raj kumar a/l subramaniam|Dr. Raj Kumar a/l Subramaniam - Hematologist", "dr. tan mei yen|Dr. Tan Mei Yen - Hematologist"];
    } else if (specialty.value == "Neurology") {
        optionArray = ["dr. tan mei yen|Dr. Tan Mei Yen - Neurologist", "dr. raju a/l muthu|Dr. Raju a/l Muthu - Neurologist", "dr. wong mei kwan|Dr. Wong Mei Kwan - Neurologist"];
    } else if (specialty.value == "Pulmonology") {
        optionArray = ["dr. raju a/l muthu|Dr. Raju a/l Muthu - Pulmonologist", "dr. wong mei kwan|Dr. Wong Mei Kwan - Pulmonologist", "dr. lee ming hui|Dr. Lee Ming Hui - Pulmonologist"];
    } else if (specialty.value == "Radiology") {
        optionArray = ["dr. cecilia halpert|Dr. Cecilia Halpert - Radiologist", "dr. lee ming hui|Dr. Lee Ming Hui - Radiologist", "dr. wong mei kwan|Dr. Wong Mei Kwan - Radiologist"];
    } else if (specialty.value == "Urology") {
        optionArray = ["dr. lee ming hui|Dr. Lee Ming Hui - Urologist", "dr. tan mei yen|Dr. Tan Mei Yen - Urologist", "dr. raju a/l muthu|Dr. Raju a/l Muthu - Urologist"];
    }

    for (var option in optionArray) {
        var pair = optionArray[option].split("|");
        var newOption = document.createElement("option");
        newOption.value = pair[0];
        newOption.innerHTML = pair[1];
        doc.options.add(newOption);
    }
}

// Rest of the JavaScript code remains unchanged

document.getElementById('btnCallURL').onclick = function() { 
    var specialtyObj = document.getElementById('specialty');
    var docObj = document.getElementById('doc');

    var specialtyValue = specialtyObj.options[specialtyObj.selectedIndex].value;
    var docValue = docObj.options[docObj.selectedIndex].value;

    jsCallUrl(specialtyValue, docValue);
}

function jsCallUrl(specialtyValue, docValue){

    var pageUrl = "";

    switch (specialtyValue){
        case "Anesthesiology":
            switch (docValue){
            case "dr. catherine sanderford":
                pageUrl = "#";
                break;
            case "dr. laila buote":
                pageUrl = "#";
                break;
            case "dr. verna lonn":
                pageUrl = "#";
                break;         
            }
            break;
        case "Cardiology":
            switch (docValue){
            case "dr. genesis lever":
                pageUrl = "#";
                break;
            case "dr. tristen muhs":
                pageUrl = "#";
                break;
            }
            break;
        case "Dermatology":
            switch (docValue){
            case "dr. herbert jodha":
                pageUrl = "#"; 
                break;
            case "dr. mackenzie vasey":
                pageUrl = "#";
                break;
            case "dr. timothy eggleston":
                pageUrl = "#";
                break;
            case "dr. willie goudy":
                pageUrl = "#";         
            }
            break;
        case "Emergency Medicine":
            switch (docValue){
            case "dr. damian toohey":
                pageUrl = "#"; 
                break;
            case "dr. dora kerkel":
                pageUrl = "#";
                break;
            case "dr. ella serenil":
                pageUrl = "#";
                break; 
            case "dr. kenneth trumper":
                pageUrl = "#";
                break;  
            case "dr. lith verhen":
                pageUrl = "#";
                break;     
            }
            break;
        case "Endocrinology":
            switch (docValue){
            case "dr. blakely betenbaugh":
                pageUrl = "#";
                break;
            case "dr. clyde guhl":
                pageUrl = "#";
                break;
            case "dr. rodrigo prezioso":
                pageUrl = "#";
                break; 
            }
            break;
        case "General Surgery":
            switch (docValue){
            case "dr. beverly lulewicz":
                pageUrl = "#";
                break;
            case "dr. briana rav":
                pageUrl = "#";
                break;
            case "dr. chris hosteller":
                pageUrl = "#";
                break;
            case "dr. cohen lieder":
                pageUrl = "#";
                break;
            case "dr. destiny nicks":
                pageUrl = "#";
                break;
            case "dr. giovanni melcher":
                pageUrl = "#";
                break;
            case "dr. jessie gelvin":
                pageUrl = "#";
                break;
            case "dr. lauren shute":
                pageUrl = "#";
                break;
            }
            break;
        case "Gastroenterology":
            switch (docValue){
            case "dr. benjamin thompson":
                pageUrl = "gastroenterology.html#benjamin";
                break;
            case "dr. samantha collins":
                pageUrl = "gastroenterology.html#samantha";
            break;            
            }
            break;
        case "Hematology":
            switch (docValue){
            case "dr. edwin ligler":
                pageUrl = "#";
                break;
            case "dr. geraldine buttrick":
                pageUrl = "#";
                break;
            }
            break;
        case "Neurology":
            switch (docValue){
            case "dr. alaina silman":
                pageUrl = "#";
                break;
            case "dr. john connerstone":
                pageUrl = "#";
                break;
            case "dr. juliette mccartha":
                pageUrl = "#";
                break;
            }
            break;
        case "Plumonology":
            switch (docValue){
            case "dr. elmer illas":
                pageUrl = "#";
                break;
            case "dr. jace morden":
                pageUrl = "#";
                break;
            case "dr. juliette mccartha":
                pageUrl = "#";
                break;
            case "dr. phillip mcglothin":
                pageUrl = "#";
                break;
            case "dr. stephanie frandeen":
                pageUrl = "#";
                break;
            }
            break;
        case "Radiology":
            switch (docValue){
            case "dr. cecilia halpert":
                pageUrl = "#";
                break;
            case "dr. mirim distar":
                pageUrl = "#";
                break;
            case "dr. skylar strawser":
                pageUrl = "#";
                break;
            case "dr. summer vasile":
                pageUrl = "#";
                break;
            case "dr. ty mangieri":
                pageUrl = "#";
                break;
            }
            break;
        case "Urology":
            switch (docValue){
            case "dr. corbin fongvongsa":
                pageUrl = "#";
                break;
            case "dr. declan decaen":
                pageUrl = "#";
                break;
            case "dr. helen sheedy":
                pageUrl = "#";
                break;
            case "dr. johnnie safer":
                pageUrl = "#";
                break;
            case "dr. rodrigo prezioso":
                pageUrl = "#";
                break;
            }
            break;
    }

    if (pageUrl != ""){
        location.href =  pageUrl;
    }
}



// --------- Book Appointment Script---------
function confirmEnquiry() {
window.location.href = "Confirm-appointment.html";
}

 // Function to pass the selected date and time to the Confirm-appointment page
 function appointmentEnquiry() {
    const selectedDate = document.getElementById("dob").value;
    const selectedTime = document.getElementById("time").value;

    if (selectedDate === "" || selectedTime === "") {
        alert("Please select both date and time before proceeding.");
    } else {
        const url = `Confirm-appointment.html?date=${selectedDate}&time=${selectedTime}`;
        window.location.href = url;
    }
}


// --------- Donation-detail script -------------
// JavaScript to handle button selection and form submission

// Get all donation buttons
const donationButtons = document.querySelectorAll('.donation-button');
donationButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Remove the 'selected' class from all buttons
        donationButtons.forEach(btn => btn.classList.remove('selected'));
        // Add the 'selected' class to the clicked button
        button.classList.add('selected');
        // Set the selected donation amount in the hidden input field
        document.getElementById('otherAmount').value = button.getAttribute('data-value');
    });
});

// Get all payment buttons
const paymentButtons = document.querySelectorAll('.payment-btn');
paymentButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Remove the 'selected' class from all payment buttons
        paymentButtons.forEach(btn => btn.classList.remove('selected'));
        // Add the 'selected' class to the clicked payment button
        button.classList.add('selected');
        // Set the selected payment method in the hidden input field
        document.getElementById('paymentMethod').value = button.getAttribute('data-method');
    });
});

// Validate form before submitting
document.getElementById('donateButton').addEventListener('click', () => {
    const name = document.getElementById('name').value;
    const phone = document.getElementById('phone').value;
    const donationAmount = document.getElementById('otherAmount').value;

    // Get the selected payment method
    const selectedPaymentMethod = document.querySelector('.payment-btn.selected');

    if (name === '' || phone === '' || donationAmount === '') {
        alert('Please fill in all required details.');
    } else if (!selectedPaymentMethod) {
        alert('Please select a payment method.');
    } else {
        document.getElementById('donationForm').submit();
    }
});