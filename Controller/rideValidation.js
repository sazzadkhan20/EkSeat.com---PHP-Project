document.getElementById("schedule").addEventListener("change", function() {
    let schedule = this.value;
    
    if (schedule === "later") {
        document.getElementById("time-label").style.display = "block";
        document.getElementById("time").style.display = "block";
    } else {
       document.getElementById("time-label").style.display = "none";
        document.getElementById("time").style.display = "none";
    }
});
document.getElementById("passenger").addEventListener("change", function(){
    let passenger=this.value;
    if(passenger=="SomeOneElse")
    {
        document.getElementById("NewName").style.display="block";
        document.getElementById("NewPhone").style.display="block";

        
    }
    else if(passenger=="MySelf")
    {
        document.getElementById("NewName").style.display="none";
        document.getElementById("NewPhone").style.display="none";
    }

    
})

function validateSearchRide() {
    let pickup = document.getElementById("pickup").value.trim();
    let drop = document.getElementById("dropoff").value.trim();
    let schedule = document.getElementById("schedule").value;
    let passenger = document.getElementById("passenger").value;
    let error = document.getElementById("error-message");
    

    error.innerText = "";

    if (pickup === "") {
        error.innerText = "Please set pickup location";
        document.getElementById("pickup").focus();
        return false;
    }
    else if (drop === "") {
        error.innerText = "Please set dropoff location";
        document.getElementById("dropoff").focus();
        return false;
    }
    else if (schedule === "") {
        error.innerText = "Please set schedule date and time";
        document.getElementById("schedule").focus();
        return false;
    }
    else if (schedule === "later" && document.getElementById("time").value === "") {
        error.innerText = "Please set the date and time";
        document.getElementById("time").focus();
        return false;
    }
    else if (passenger === "") {
        error.innerText = "Please set passenger information";
        document.getElementById("passenger").focus();
        return false;
    }
    if (passenger === "SomeOneElse" && !validateElseUser()) {
        return false;
    }
    else
    {
        return true;
    }
}

function validateElseUser(){
    let NewName=document.getElementById("NewName").value.trim();
    let NewPhone=document.getElementById("NewPhone").value;
    let error = document.getElementById("error-message");
    
    if(NewName==="")
        {
        error.innerText="Please set the Passenger Name";
        document.getElementById("NewName").focus();
        return false;
        }
    else if(!NewName.match(/^[A-Za-z]{2,}(?:\s[A-Za-z]{2,})+$/))
    {
        error.innerText="Please Give me A valid Passenger Name";
        document.getElementById("NewName").focus();
        return false      
    }
    else if(NewPhone==="")
        {
            error.innerText="Please set the Passenger Phone number";
            document.getElementById("NewPhone").focus();
            return false;
        }
    else if(!NewPhone.match(/^[0][1][3-9][0-9]{8}/))
        {
            error.innerText="Please Give me A valid Phone Number";
            document.getElementById("NewPhone").focus();
            return false
        }
    return true;
        
}

function validateHomePageRequest() {
    let pickup = document.getElementById("pickup").value.trim();
    let drop = document.getElementById("dropOff").value.trim();
    let error = document.getElementById("error-message");

    error.innerText = ""; // Clear previous error message

    // Check if the pickup location is empty
    if (pickup === "") {
        error.innerText = "Please set pickup location";
        document.getElementById("pickup").focus();
        return false;  // Prevent form submission
    }
    // Check if the drop-off location is empty
    else if (drop === "") {
        error.innerText = "Please set dropoff location";
        document.getElementById("dropOff").focus();  // Corrected the ID here
        return false;  // Prevent form submission
    }
    
    return true;  // Allow form submission if validation passes
}
