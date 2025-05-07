<?php
session_start();

// Ensure step 1 is done
if (!isset($_SESSION['checklist'])) {
    header("Location: checklist_step1.php");
    exit();
}


$inspector_id = $_SESSION['checklist']['inspector_id'];
$barangay = $_SESSION['checklist']['barangay_assigned'];

// On form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['checklist_step2'] = $_POST;
    header("Location: checklist_step3.php"); // or wherever step 3 is
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Step 2: Fire Safety Inspection - Part 2</title>
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
    <h2>Step 2: Fire Safety Inspection Checklist (Part 2)</h2>

    <form method="POST">

    <input type="hidden" name="inspector_id" value="<?= $inspector_id ?>">
    <input type="hidden" name="barangay_assigned" value="<?= $barangay ?>">



        <!-- IV. OTHER INFORMATION -->
        <h3>IV. Other Information</h3>
        <label>Type of Occupancy:</label>
        <select name="occupancy_type">
            <option value="Mercantile">Mercantile</option>
            <option value="Business">Business</option>
            <option value="Others">Others</option>
        </select>

        <label>Specify if Others:</label>
        <input type="text" name="occupancy_others">

        
        <label>Construction Type:</label>
        <select name="construction_type">
            <option>Timber Framed and Walls</option>
            <option>Steel Framed and Walls</option>
            <option>Reinforced Concrete Framed with Masonry Walls</option>
            <option>Mixed Construction</option>
        </select>

        <label>Total Floor Area (m²):</label>
        <input type="number" name="floor_area" step="0.01">

        <label>Occupant Load (Persons):</label>
        <input type="number" name="occupant_load">

        <label>Portion Occupied:</label>
        <input type="text" name="portion_occupied">

        <label>Buildieight (ng Hm):</label>
        <input type="number" name="building_height" step="0.01">

        <label>With Mezzanine?</label>
        <select name="mezzanine">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>

        <label>Handrails/Railings Provided?</label>
        <select name="handrails">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>

        <!-- V. MEANS OF EGRESS -->
        <h3>V. Means of Egress</h3>

        <table>
            <tr><th colspan="5">A. EXIT ACCESS</th></tr>
            <tr>
                <th>Component</th><th>Actual Dim. (m)</th><th>Passed</th><th>Failed</th><th>Remarks</th>
            </tr>
            <tr>
                <td>Doors</td>
                <td><input type="text" name="exitaccess_doors_dim"></td>
                <td><input type="checkbox" name="exitaccess_doors_passed" value="Yes"></td>
                <td><input type="checkbox" name="exitaccess_doors_failed" value="Yes"></td> 
                <td><input type="text" name="exitaccess_doors_remarks"></td>
            </tr>
            <tr>
                <td>Corridors / Hallways</td>
                <td><input type="text" name="exitaccess_corridors_dim"></td>
                <td><input type="checkbox" name="exitaccess_corridors_passed" value="Yes"></td>
                <td><input type="checkbox" name="exitaccess_corridors_failed" value="Yes"></td>
                <td><input type="text" name="exitaccess_corridors_remarks"></td>
            </tr>

            <tr><th colspan="5">B. EXITS</th></tr>
            <tr>
                <td>Exit Doors</td>
                <td><input type="text" name="exit_doors_width"></td>
                <td><input type="checkbox" name="exit_doors_passed" value="Yes"></td>
                <td><input type="checkbox" name="exit_doors_failed" value="Yes"></td>
                <td><input type="text" name="exit_doors_remarks"></td>
            </tr>
            <tr>
                <td>Horizontal Exits</td>
                <td><input type="text" name="horizontal_exits_width"></td>
                <td><input type="checkbox" name="horizontal_exits_passed" value="Yes"></td>
                <td><input type="checkbox" name="horizontal_exits_failed" value="Yes"></td>
                <td><input type="text" name="horizontal_exits_remarks"></td>
            </tr>
            <tr>
                <td>Stairs</td>
                <td><input type="text" name="stairs_width"></td>
                <td><input type="checkbox" name="stairs_passed" value="Yes"></td>
                <td><input type="checkbox" name="stairs_failed" value="Yes"></td>
                <td><input type="text" name="stairs_remarks"></td>
            </tr>
        </table>

        <label>At least two means of egress for each floor?</label>
        <select name="two_means_egress">
            <option>Yes</option>
            <option>No</option>
        </select>

        <label>Exit doors open and close properly?</label>
        <select name="exit_doors_properly">
            <option>Yes</option>
            <option>No</option>
        </select>

        <label>Doors swing in direction of egress?</label>
        <select name="doors_swing_egress">
            <option>Yes</option>
            <option>No</option>
        </select>

        <!-- VI. SIGNS, LIGHTING, AND EXITS SIGNAGE -->
        <h3>VI. Signs, Lighting, and Exits Signage</h3>
        <table>
            <tr>
                <th>Component</th><th>Passed</th><th>Failed</th>
            </tr>
            <tr>
                <td>Minimum letter height 150mm; stroke 19mm</td>
                <td><input type="checkbox" name="sign_letter_passed" value="Yes"></td>
                <td><input type="checkbox" name="sign_letter_failed" value="Yes"></td>
            </tr>
            <tr>
                <td>EXIT signs posted</td>
                <td><input type="checkbox" name="exit_signs_posted_passed" value="Yes"></td>
                <td><input type="checkbox" name="exit_signs_posted_failed" value="Yes"></td>
            </tr>
            <tr>
                <td>EXIT signs properly illuminated</td>
                <td><input type="checkbox" name="exit_signs_lit_passed" value="Yes"></td>
                <td><input type="checkbox" name="exit_signs_lit_failed" value="Yes"></td>
            </tr>
        </table>

        <button type="submit">Next &raquo;</button>
    </form>
</body>
</html>
