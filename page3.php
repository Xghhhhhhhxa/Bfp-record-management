<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fire Safety Inspection Checklist</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Set page size and margins to simulate bond paper (A4 or Letter size) */
        @page {
            size: A4;
            margin: 1in; /* 1-inch margin */
        }

        /* Add shadow to the entire page */
        body {
            background: #f4f4f4; /* Light background color */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Shadow effect on the body */
        }

        /* Sidebar Styles */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px; /* Sidebar hidden initially */
            background-color: #333;
            color: white;
            padding-top: 20px;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.2); /* Shadow on sidebar */
            transition: left 0.3s ease;
        }

        .sidebar a {
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .sidebar-toggle {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1000;
            font-size: 30px;
            cursor: pointer;
            color: #343a40;
        }

        .sidebar.open {
            left: 0; /* Sidebar shown */
        }
        .sidebar .dropdown-menu {
    background-color: #007bff; /* Set your desired background color */
}

.sidebar .dropdown-item {
    color: white; /* Set the text color */
}

.sidebar .dropdown-item:hover {
    background-color: #0056b3; /* Set the hover background color */
    color: white; /* Ensure text stays white on hover */
}

        .content {
            margin-left: 0;
            padding: 20px;
            transition: margin-left 0.3s ease;
            max-width: 100%; /* Ensure content stays within the page */
            background-color: white; /* White background for content */
            border-radius: 8px; /* Optional: Rounded corners */
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1); /* Shadow on the content */
        }

        .content.open {
            margin-left: 250px; /* Shift content to the right when sidebar is open */
        }

        .section-title {
            font-weight: bold;
            margin-top: 20px;
        }

        /* Styling for logo and header */
        .header-logo img {
            width: 50px; /* Adjust logo size */
            height: auto;
        }

        .header-text {
            text-align: center;
        }

        /* Styling for text and inputs */
        .form-label {
            font-weight: bold;
        }

        /* Add margins to the form sections */
        .mb-3 {
            margin-bottom: 1rem;
        }
       
    </style>
</head>
<body class="container my-4">

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h3 class="text-center text-white">BFP System</h3>

        <div class="dropdown">
            <a href="checklist.php" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="icon">&#128202;</i> CHECK LIST
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="checklist.php">NEW</a></li>
                <li><a class="dropdown-item" href="#">OLD</a></li>
            </ul>
        </div>
        <a href="dshbrdins.php"><i class="icon">&#128202;</i>HOME</a>
        <a href="logout.php" class="btn btn-danger">Log Out</a> <!-- Log Out icon -->
    </div>

    <!-- Toggle Button -->
    <span class="sidebar-toggle" id="toggleSidebar">&#9776;</span> <!-- Hamburger icon -->

    <!-- Main Content -->
    <div class="content" id="content">
        <div class="row justify-content-between">
            <!-- Left Logo -->
            <div class="col-2 header-logo">
                <!-- Left Logo Placeholder (Replace with actual logo URL) -->
                <img src="left-logo.png" alt="Left Logo">
            </div>
            
            <!-- Header Text in the Center -->
            <div class="col-8 header-text">
                <h1>Republic of the Philippines</h1>
                <h3>Department of the Interior and Local Government<br>Bureau of Fire Protection<br>Hinigaran Fire Station</h3>
                <h3>Fire Safety Inspection Checklist</h3>
                <h4>For the RENEWAL of FSIC</h4>
            </div>

            <!-- Right Logo -->
            <div class="col-2 header-logo">
                <!-- Right Logo Placeholder (Replace with actual logo URL) -->
                <img src="right-logo.png" alt="Right Logo">
            </div>
        </div>

     

        <!-- Fire Safety Measures Assessment Section -->
        <div id="assessment" class="section-title">V. Fire Safety Measures Assessment</div>

<div class="row">
<div class="col order-first">
            <label class="form-check-label">1.Building Construction</label>
            <select name="" id="" class="form-select">
                <option value="Wall/Ceiling Interior Finish">Wall/Ceiling Interior Finish</option>
                <option value="Floor Interior Finishs">Floor Interior Finishs</option>
            </select>

    </div>
    <div class="col">
            <div class="col">Compliant</div>
            <div class="row">
                <div class="col">
                <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" value="Yes">
                <label class="form-check-label">Yes</label>
            </div>
                </div>
            </div>
        
    </div>
    <div class="col order-last">
             <div class="col">Compliant</div>
            <select name="" id="" class="form-select">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="No changes from previous inspection">No changes from previous inspection</option>
                <option value="With Changes">With Changes</option>
                <option value="Renovation">Renovation</option>
                <option value="Repair">Repair</option>
                <option value="Additional">Additional</option>
                
            </select>   
    </div>
</div>

<div class="row">
<div class="col order-first">
            <label class="form-check-label">2. Sectional Occupancy</label>
    </div>
    <div class="col">
            <div class="col">Compliant</div>
            <div class="row">
                <div class="col">
                <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" value="Yes">
                <label class="form-check-label">Yes</label>
             
            </div>
            <div>
            <label class="form-check-label">State the no. of floors based on the previous inspection</label>
            <input Text="" class="form-control">
            </div>
                </div>
            </div>
        
    </div>
    <div class="col order-last">
             <div class="col">Compliant</div>
            <select name="" id="" class="form-select">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="No changes from previous inspection">No changes from previous inspection</option>
                <option value="With Changes">With Changes</option>
                <option value="Renovation">Renovation</option>
                <option value="Repair">Repair</option>
                <option value="Additional">Additional</option>
                <option value="State Particular Floor">State Particular Floor</option>
                
            </select>   
    </div>
</div>
<div class="row">
<div class="col order-first">
            <label class="form-check-label">3. General Occupancy Specification  </label>
    </div>
    <div class="col">
            <div class="col">Compliant</div>
            <div class="row">
                <div class="col">
                <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" value="Yes">
                <label class="form-check-label">Yes</label>
              
            </div>
            <div>
            <label class="form-check-label">State the previous type of occupancy.</label>
            <input Text="" class="form-control">
            </div>
                </div>
            </div>
        
    </div>
    <div class="col order-last">
             <div class="col">Compliant</div>
            <select name="" id="" class="form-select">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="No changes from previous inspection">No changes from previous inspection</option>
                <option value="With Changes">Change of Occupancy</option>

            </select>   
    </div>
</div>

<div class="row">
<div class="col order-first">
            <label class="form-check-label">4. Means of Egress<</label>
    </div>
    <div class="col">
            <div class="col">Compliant</div>
            <div class="row">
                <div class="col">
                <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" value="Yes">
                <label class="form-check-label">Yes</label>
            
            </div>
                </div>
            </div>
        
    </div>
    <div class="col order-last">
             <div class="col">Compliant</div>
            <select name="" id="" class="form-select">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="No changes from previous inspection">No changes from previous inspection</option>
                <option value="With Changes">With Changes</option>
                <option value="Renovation">Renovation</option>
                <option value="Repair">Repair</option>
                <option value="Additional">Additional</option>
                <option value="State Particular Floor">State Particular Floor</option>
                
            </select>   
    </div>
</div>
<div class="row">
<div class="col order-first">
            <label class="form-check-label">5. Exits </label>
    </div>
    <div class="col">
            <div class="col">Compliant</div>
            <div class="row">
                <div class="col">
                <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" value="Yes">
                <label class="form-check-label">Yes</label>
             
            </div>

                </div>
            </div>
        
    </div>
    <div class="col order-last">
             <div class="col">Compliant</div>
            <select name="" id="" class="form-select">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="No changes from previous inspection">No changes from previous inspection</option>
                <option value="With Changes">With Changes</option>
                <option value="Renovation">Renovation</option>
                <option value="Repair">Repair</option>
                <option value="Additional">Additional</option>
                <option value="State Particular Floor">State Particular Floor</option>
                
            </select>   
    </div>
</div>
<div class="row">
<div class="col order-first">
            <label class="form-check-label">6. Signs, Lighting and Exit Signage</label>
            <select name="" id="" class="form-select">
                <option value=" Marking of Means of Egress"> Marking of Means of Egress</option>
                <option value="Marking of Means of Egress (Emergency Evacuation Plan) ">Marking of Means of Egress (Emergency Evacuation Plan) </option>
            </select>

    </div>
    <div class="col">
            <div class="col">Compliant</div>
            <div class="row">
                <div class="col">
                <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" value="Yes">
                <label class="form-check-label">Yes</label>
            </div>
                </div>
            </div>
        
    </div>
    <div class="col order-last">
             <div class="col">Compliant</div>
            <select name="" id="" class="form-select">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="No changes from previous inspection">No changes from previous inspection</option>
                <option value="State Particular Violation:">State Particular Violation:</option>
               
            </select>   
    </div>
    
</div>
<div class="row">
<div class="col order-first">
            <label class="form-check-label">7. Illumination of Means of Egress  </label>
    </div>
    <div class="col">
            <div class="col">Compliant</div>
            <div class="row">
                <div class="col">
                <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" value="Yes">
                <label class="form-check-label">Yes</label>
             
            </div>

                </div>
            </div>
        
    </div>
    <div class="col order-last">
             <div class="col">Compliant</div>
            <select name="" id="" class="form-select">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="No changes from previous inspection">No changes from previous inspection</option>
                <option value="State Particular Floor">State Particular Floor</option>
          
            </select>   
    </div>
</div>
<div class="row">
<div class="col order-first">
            <label class="form-check-label">8. Hazard Contents </label>
            <select name="" id="" class="form-select">
                <option value=" Hazard Classification"> Hazard Classification</option>
                <option value=" Other Flammable Liquids "> Other Flammable Liquids</option>
                <option value=" Miscellaneous Hazard (Mechanical Equipment Room, Storage, Supply Room)"> Miscellaneous Hazard (Mechanical Equipment Room, Storage, Supply Room)</option>
                <option value=" No Smoking Signages "> No Smoking Signages</option>
                <option value=" Storage of Gasoline/Diesel Storage in Proper Place  ">Storage of Gasoline/Diesel Storage in Proper Place </option>
            </select>

    </div>
    <div class="col">
            <div class="col">Compliant</div>
            <div class="row">
                <div class="col">
                <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" value="Yes">
                <label class="form-check-label">Yes</label>
            </div>
                </div>
            </div>
        
    </div>
    <div class="col order-last">
             <div class="col">Compliant</div>
            <select name="" id="" class="form-select">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="No changes from previous inspection">No changes from previous inspection</option>
                <option value="Maximum Allowable Quantity">Maximum Allowable Quantity"</option>
                <option value="No Additional Fire Protection">No Additional Fire Protection</option>
                <option value="No MSDS">No MSDS</option>
                <option value="No Proper Storage">No Proper Storage</option>
            </select>   
    </div>
    
</div>
<div class="row">
<div class="col order-first">
            <label class="form-check-label">9.Housekeeping</label>
            <select name="" id="" class="form-select">
                <option value=" Maintenance"> Maintenance</option>
                <option value="Storage ">Storage </option>
                <option value=" Waste Disposal "> Waste Disposal  </option>
            </select>

    </div>
    <div class="col">
            <div class="col">Compliant</div>
            <div class="row">
                <div class="col">
                <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" value="Yes">
                <label class="form-check-label">Yes</label>
            </div>
                </div>
            </div>
        
    </div>
    <div class="col order-last">
             <div class="col">Compliant</div>
            <select name="" id="" class="form-select">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="No changes from previous inspection">No changes from previous inspection</option>
                <option value="State Particular Violation:">State Particular Violation:</option>
               
            </select>   
    </div>
    
</div>

<div class="row">
<div class="col order-first">
            <label class="form-check-label">11.Fire Aid Fire Fire Protection</label>
            </select>

    </div>
    <div class="col">
            <div class="col">Compliant</div>
            <div class="row">
                <div class="col">
                <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" value="Yes">
                <label class="form-check-label">Yes</label>
            </div>
                </div>
            </div>
        
    </div>
    <div class="col order-last">
             <div class="col">Compliant</div>
            <select name="" id="" class="form-select">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="No changes from previous inspection">No changes from previous inspection</option>
                <option value="Good and Operational:">Good and Operational</option>
                <option value="Need additional Fire Extinguisher">Need additional Fire Extinguisher</option>
                <option value="Location">Location</option>
                <option value="No. of Fire Extinguisher">No. of Fire Extinguisher</option>
               
            </select>   
    </div>
    
    
</div>
<div class="row">
<div class="col order-first">
            <label class="form-check-label">12.Fire Protection </label>
            <select name="" id="" class="form-select">
                <option value="Utilities"> Utilities</option>
                <option value="Smoke Control System/Smoke Management">Smoke Control System/Smoke Management</option>
                <option value=" Fire Pump "> Fire Pump  </option>
                <option value="  Rubbish Chutes/Laundry Chutes/Flue-Fed Incinerators"> Rubbish Chutes/Laundry Chutes/Flue-Fed Incinerators </option>
            </select>

    </div>
    <div class="col">
            <div class="col">Compliant</div>
            <div class="row">
                <div class="col">
                <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" value="Yes">
                <label class="form-check-label">Yes</label>
            </div>
                </div>
            </div>
        
    </div>
    <div class="col order-last">
             <div class="col">Compliant</div>
            <select name="" id="" class="form-select">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="No changes from previous inspection">No changes from previous inspection</option>
                <option value="State Particular Violation:">State Particular Violation:</option>
               
            </select>   
    </div>
        
</div>
<div class="row">
<div class="col order-first">
            <label class="form-check-label">13.Fire Safety Maintenance Report(FSMR)</label>
            <label class="form-check-label">Passive Fire Protection </label>
            <select name="" id="" class="form-select">
                <option value=" Maintenance"> Fire Door</option>
                <option value="Storage ">Fire Walls </option>
                <option value=" Waste Disposal "> Compartmentation </option>
                <option value=" Maintenance"> Horizontal Exits</option>
                <option value="Storage ">Stairs</option>
                <option value=" Waste Disposal ">Ramps</option>
                <option value=" Waste Disposal ">Exit Passageways</option>
            </select>
            <label class="form-check-label">Active Fire Protection </label>
            <select name="" id="" class="form-select">
                <option value=" Maintenance"> Automatic Fire Suppressionn</option>
                <option value="Storage ">Fire Detection Alarm & Communication </option>
                <option value=" Waste Disposal "> Wet Standpipe </option>
                <option value=" Maintenance"> Smoke Control System/Pressurization</option>
            </select>

    </div>
    <div class="col">
            <div class="col">Compliant</div>
            <div class="row">
                <div class="col">
                <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" value="Yes">
                <label class="form-check-label">Yes</label>
            </div>
                </div>
            </div>
        
    </div>
    <div class="col order-last">
             <div class="col">Compliant</div>
            <select name="" id="" class="form-select">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>   
            <div class="col">Compliant</div>
    </div>
    
</div>

<div class="d-flex justify-content-center mt-4">
            <button id="prevBtn" onclick="previousPage()" class="btn btn-primary" style="margin-right: 20px;">PREV</button>
            <button id="nextBtn" onclick="nextPage()" class="btn btn-primary" style="margin-left: 20px;">Next</button>
        </div>
</div>
    
    


      

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript to Toggle Sidebar -->
    <script>
        // Get elements
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const toggleButton = document.getElementById('toggleSidebar');

        // Toggle sidebar
        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            content.classList.toggle('open');
        });
    </script>
        <script>
        function nextPage() {
            // You can define what the "Next" button does here, for example:
            window.location.href = "page3.php";  // Redirects to a new page
            // or
            // alert("Next button clicked!"); // Displays a message
        }
    </script>
    <script>
        function previousPage() {
            // You can define what the "Previous" button does here, for example:
            window.location.href = "page2.php";  // Redirects to a previous page
            // or
            // alert("Previous button clicked!"); // Displays a message
        }
    </script>
    </script>
    </div>
</body>
</html>
