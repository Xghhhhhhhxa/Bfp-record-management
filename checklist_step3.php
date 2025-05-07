<?php
session_start();

// Ensure step 2 is done
if (!isset($_SESSION['checklist_step2'])) {
    header("Location: checklist_step2.php");
    exit();
}

$inspector_id = $_SESSION['checklist']['inspector_id'];
$barangay = $_SESSION['checklist']['barangay_assigned'];

// On form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['checklist_step3'] = $_POST;
    // Proceed to the final page or wherever needed
    header("Location: final_page.php"); // or wherever step 4 is
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Step 3: Fire Safety Inspection - Part 3</title>
    <style>
        label { font-weight: bold; margin-top: 15px; display: block; }
        input, textarea, select { margin: 5px 0 15px 0; width: 100%; max-width: 400px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td, th { border: 1px solid #999; padding: 5px; }
        h3 { margin-top: 30px; }
        button { margin-top: 20px; padding: 10px 15px; }
    </style>
</head>
<body>
    <h2>Step 3: Fire Safety Inspection Checklist (Part 3)</h2>

    <form method="POST">

    <input type="hidden" name="inspector_id" value="<?= $inspector_id ?>">
    <input type="hidden" name="barangay_assigned" value="<?= $barangay ?>">

        <!-- VII. HAZARD -->
        <h3>VII. Hazard</h3>
        <label>Hazard Classification:</label>
        <select name="hazard_classification">
            <option value="Low">Low</option>
            <option value="Ordinary">Ordinary</option>
            <option value="High">High</option>
        </select>

        <label>Storage Clearance Required?</label>
        <select name="storage_clearance">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>

        <label>Fire Safety Clearance for Storage</label>
        <select name="fire_safety_clearance">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>

        <label>Date Issued:</label>
        <input type="date" name="clearance_date">

        <label>Control No.:</label>
        <input type="text" name="clearance_control_no">

        <label>Hazard Content:</label>
        <input type="text" name="hazard_content">

        <label>Total Volume:</label>
        <input type="text" name="total_volume">

        <label>Location:</label>
        <input type="text" name="hazard_location">

        <h3>Other Flammable Liquids</h3>
        <label>Components</label>
        <table>
            <tr><th>Passed</th><th>Failed</th></tr>
            <tr>
                <td><input type="checkbox" name="other_flammable_passed[]" value="Clearance of Stocks from the Ceiling"></td>
                <td><input type="checkbox" name="other_flammable_failed[]" value="Clearance of Stocks from the Ceiling"></td>
            </tr>
            <tr>
                <td><input type="checkbox" name="other_flammable_passed[]" value="Gas Detector and Shut Off Device for LPG"></td>
                <td><input type="checkbox" name="other_flammable_failed[]" value="Gas Detector and Shut Off Device for LPG"></td>
            </tr>
        </table>

        <label>LPG System provided with Approved Plans (if 300 kgs./300 GWC)</label>
        <select name="lpg_system_plans">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>

        <label>Installation Clearance</label>
        <select name="installation_clearance">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>

        <label>Date Issued:</label>
        <input type="date" name="installation_clearance_date">

        <label>Control No.:</label>
        <input type="text" name="installation_clearance_control_no">

        <label>Stored in sealed metal containers?</label>
        <select name="stored_in_metal_containers">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>

        <label>Provided with “NO SMOKING” sign?</label>
        <select name="no_smoking_sign">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>

        <!-- VIII. FIRE PROTECTION -->
        <h3>VIII. Fire Protection</h3>
        <label>First Aid Fire Protection (Fire Extinguishers)</label>
        <table>
            <tr><th>Item to Inspect</th><th>Passed</th><th>Failed</th></tr>
            <tr>
                <td>Fire Extinguisher Size</td>
                <td><input type="checkbox" name="fire_extinguisher_size_passed" value="Yes"></td>
                <td><input type="checkbox" name="fire_extinguisher_size_failed" value="Yes"></td>
            </tr>
            <tr>
                <td>Minimum number of Extinguishers</td>
                <td><input type="checkbox" name="minimum_extinguisher_passed" value="Yes"></td>
                <td><input type="checkbox" name="minimum_extinguisher_failed" value="Yes"></td>
            </tr>
            <tr>
                <td>Location</td>
                <td><input type="checkbox" name="extinguisher_location_passed" value="Yes"></td>
                <td><input type="checkbox" name="extinguisher_location_failed" value="Yes"></td>
            </tr>
            <tr>
                <td>Seals & Tags</td>
                <td><input type="checkbox" name="extinguisher_seals_tags_passed" value="Yes"></td>
                <td><input type="checkbox" name="extinguisher_seals_tags_failed" value="Yes"></td>
            </tr>
        </table>

        <label>Type:</label>
        <input type="text" name="extinguisher_type">

        <label>Quantity:</label>
        <input type="text" name="extinguisher_quantity">

        <label>Capacity:</label>
        <input type="text" name="extinguisher_capacity">

        <!-- Emergency Lighting Systems -->
        <h3>Emergency Lighting Systems</h3>
        <label>Provided:</label>
        <select name="emergency_lighting_provided">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>

        <label>Functional:</label>
        <select name="emergency_lighting_functional">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>

        <label>Locations:</label>
        <input type="text" name="emergency_lighting_locations">

        <!-- Fire Detection and Alarm -->
        <h3>Fire Detection and Alarm</h3>
        <label>Provided:</label>
        <select name="fire_detection_provided">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>

        <label>Functional:</label>
        <select name="fire_detection_functional">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>

        <label>Integrated:</label>
        <select name="fire_detection_integrated">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>

        <label>Units per floor:</label>
        <input type="text" name="units_per_floor">

        <label>Adequate:</label>
        <select name="fire_detection_adequate">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>

        <label>Location of Control Panel:</label>
        <input type="text" name="fire_detection_location_control_panel">

        <button type="submit">Next &raquo;</button>
    </form>
</body>
</html>
