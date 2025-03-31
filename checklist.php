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
                <h2>Department of the Interior and Local Government<br>Bureau of Fire Protection<br>Hinigaran Fire Station</h2>
                <h2>Fire Safety Inspection Checklist</h2>
                <h3>For the RENEWAL of FSIC</h3>
            </div>

            <!-- Right Logo -->
            <div class="col-2 header-logo">
                <!-- Right Logo Placeholder (Replace with actual logo URL) -->
                <img src="right-logo.png" alt="Right Logo">
            </div>
        </div>

        <!-- Reference Section -->
        <div id="reference" class="section-title">I. Reference</div>
        <div class="mb-3">
            <label for="inspectionOrderNo" class="form-label">Inspection Order No. (IO):</label>
            <input type="text" class="form-control" id="inspectionOrderNo">
        </div>
        <div class="mb-3">
            <label for="dateIssued" class="form-label">Date Issued:</label>
            <input type="date" class="form-control" id="dateIssued">
        </div>
        <div class="mb-3">
            <label for="dateInspected" class="form-label">Date Inspected:</label>
            <input type="date" class="form-control" id="dateInspected">
        </div>

        <!-- Nature of Inspection Section -->
        <div id="inspection" class="section-title">II. Nature of Inspection Conducted</div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="fsicForBusinessPermit">
            <label class="form-check-label" for="fsicForBusinessPermit">FSIC for Business Permit</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="fsicForCertificateOfAnnualInspection">
            <label class="form-check-label" for="fsicForCertificateOfAnnualInspection">FSIC for Certificate of Annual Inspection (PEZA)</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="others">
            <label class="form-check-label" for="others">Others</label>
            <input type="text" class="form-control mt-2" id="otherSpecification">
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="NTC">
            <label class="form-check-label" for="NTC">NTC</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="NTC">
            <label class="form-check-label" for="NTC">NTCV</label>
        </div>

        <!-- Requirement Section -->
        <div id="requirement" class="section-title">III. Requirement</div>
        <div class="mb-3">
            <label class="form-label">Fire Safety Maintenance Report (FSMR):</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fsmr" id="fsmrYes" value="Yes">
                <label class="form-check-label" for="fsmrYes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fsmr" id="fsmrNo" value="No">
                <label class="form-check-label" for="fsmrNo">No</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fsmr" id="fsmrNA" value="N/A">
                <label class="form-check-label" for="fsmrNA">N/A</label>
            </div>
        </div>

        <!-- General Information Section -->
        <div id="information" class="section-title">IV. General Information</div>
        <div class="mb-3">
            <label for="nameOfBuilding" class="form-label">Name of Building:</label>
            <input type="text" class="form-control" id="nameOfBuilding">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <input type="text" class="form-control" id="address">
        </div>
        <div class="mb-3">
            <label for="natureOfBusiness" class="form-label">Nature of Business:</label>
            <input type="text" class="form-control" id="natureOfBusiness">
        </div>
        <div class="mb-3">
            <label for="ownerName" class="form-label">Name of Owner/Representative:</label>
            <input type="text" class="form-control" id="ownerName">
        </div>
        <div class="mb-3">
            <label for="contactNo" class="form-label">Contact No.:</label>
            <input type="text" class="form-control" id="contactNo">
        </div>

        <!-- Fire Safety Measures Assessment Section -->
        <div id="assessment" class="section-title">V. Fire Safety Measures Assessment</div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Building Construction</th>
                    <th>Previous After Inspection Report</th>
                    <th>Present/Actual Inspection</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="wallsCeilingFinish">
                            <label class="form-check-label" for="wallsCeilingFinish">Walls/Ceiling Interior Finish</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="floorInteriorFinish">
                            <label class="form-check-label" for="floorInteriorFinish">Floor Interior Finish</label>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <label for="compliantFsicNo" class="form-label">Compliant FSIC No. (Latest):</label>
                            <input type="text" class="form-control" id="compliantFsicNo">
                        </div>
                        <div class="mb-3">
                            <label for="inspectionDate" class="form-label">Dated:</label>
                            <input type="date" class="form-control" id="inspectionDate">
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="compliant" id="compliantYes" value="Yes">
                            <label class="form-check-label" for="compliantYes">Compliant: Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="compliant" id="compliantNo" value="No">
                            <label class="form-check-label" for="compliantNo">Compliant: No</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="noChangesFromPrevious">
                            <label class="form-check-label" for="noChangesFromPrevious">No changes from previous inspection</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="withChanges">
                            <label class="form-check-label" for="withChanges">With Changes</label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Deficiencies Section -->
        <div id="deficiencies" class="section-title">VI. Defects/Deficiencies</div>
<div class="mb-3">
    <textarea rows="4" class="form-control" id="deficienciesText"></textarea>
</div>


<h4 class="mt-3"> Fire Safety Inspection Checklist</h4>
<div class="row">
    <label class="col-md-4 col-form-label">Requirements</label>
    <label class="col-md-4 col-form-label">Previous</label>

    <label class="col-md-4 col-form-label">Present</label>
</div>

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
            <label class="form-check-label">10.Fire Protection </label>
            <select name="" id="" class="form-select">
                <option value=" Automatic Fire Protection"> Automatic Fire Protection</option>
                <option value="Wet Standpipe/Fire Hose Cabinet">Wet Standpipe/Fire Hose Cabinet</option>
                <option value=" Fire Pump "> Fire Pump  </option>
                <option value=" Fire Detection and Alarm Comunication System "> Fire Detection and Alarm Comunication System  </option>
                <option value=" Fire Alarm Facilities"> Fire Alarm Facilities </option>
                <option value=" Location"> Location </option>
                <option value=" Alarm Panel">  Alarm Panel </option>
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
                <option value="State Particular Violation:">State Particular Violation:</option>
               
            </select>   
    </div>
    
</div>
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
</body>
</html>
