    <?php
    session_start();
    include 'db.php';

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $inspector_id = $_SESSION['user_id'];
    $assigned_barangays = $_SESSION['barangay_assigned'];
    $barangay = isset($assigned_barangays[0]) ? $assigned_barangays[0] : 'No Barangay Assigned';

    // Generate IO number
    function generateIO($conn) {
        $prefix = 'IO-' . date('Ymd') . '-';
        $num = 1;

        $conn->begin_transaction();
        try {
            do {
                $io_number = $prefix . str_pad($num, 4, '0', STR_PAD_LEFT);
                $stmt = $conn->prepare("SELECT COUNT(*) as count FROM inspector_checklist WHERE inspection_order_no = ?");
                $stmt->bind_param("s", $io_number);
                $stmt->execute();
                $count = $stmt->get_result()->fetch_assoc()['count'];
                $stmt->close();
                $num++;
            } while ($count > 0);
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollback();
            throw $e;
        }

        return $io_number;
    }

    $inspection_order_no = generateIO($conn);

    // Only save and proceed if the form was really filled and submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['date_issued']) && isset($_POST['date_inspected'])) {
        $_SESSION['checklist'] = [
            'inspector_id' => $_SESSION['user_id'],
            'barangay_assigned' => $barangay,
            'inspection_order_no' => $_POST['inspection_order_no'],
            'date_issued' => $_POST['date_issued'],
            'date_inspected' => $_POST['date_inspected'],

            'inspection_construction' => isset($_POST['inspection_construction']) ? 'Yes' : 'No',
            'fsic_annual' => isset($_POST['fsic_annual']) ? 'Yes' : 'No',
            'fsic_occupancy' => isset($_POST['fsic_occupancy']) ? 'Yes' : 'No',
            'verification_ntc' => isset($_POST['verification_ntc']) ? 'Yes' : 'No',
            'verification_ntcv' => isset($_POST['verification_ntcv']) ? 'Yes' : 'No',
            'verification_abatement' => isset($_POST['verification_abatement']) ? 'Yes' : 'No',
            'verification_closure' => isset($_POST['verification_closure']) ? 'Yes' : 'No',
            'fsic_new_permit' => isset($_POST['fsic_new_permit']) ? 'Yes' : 'No',
            'fsic_renewal_permit' => isset($_POST['fsic_renewal_permit']) ? 'Yes' : 'No',
            'notice_disapproval' => isset($_POST['notice_disapproval']) ? 'Yes' : 'No',
            'other_specify' => $_POST['other_specify'] ?? '',

            'building_name' => $_POST['building_name'],
            'address' => $_POST['address'],
            'business_name' => $_POST['business_name'],
            'nature_of_business' => $_POST['nature_of_business'],
            'owner_name' => $_POST['owner_name'],
            'contact_no' => $_POST['contact_no'],
            'fsec_no' => $_POST['fsec_no'],
            'fsec_date' => $_POST['fsec_date'],
            'building_permit' => $_POST['building_permit'],
            'building_permit_date' => $_POST['building_permit_date'],
            'fsic_latest' => $_POST['fsic_latest'],
            'fsic_latest_date' => $_POST['fsic_latest_date'],
            'business_permit' => $_POST['business_permit'],
            'business_permit_date' => $_POST['business_permit_date'],
            'insurance_policy' => $_POST['insurance_policy'],
            'insurance_policy_date' => $_POST['insurance_policy_date']
        ];

        header("Location: checklist_step2.php");
        exit();
    }
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Step 1 – Reference & General Info</title>
        <style>
            label { display: block; margin-top: 8px; font-weight: bold; }
            input[type="text"], input[type="date"], input[type="tel"], textarea {
                width: 100%; padding: 8px; margin-top: 4px;
            }
            .checkbox-group { margin-top: 10px; }
            .checkbox-group label { font-weight: normal; display: block; }
            button { margin-top: 20px; padding: 10px 15px; }
            body { font-family: Arial, sans-serif; margin: 20px; max-width: 800px; }
            h2, h3 { margin-top: 20px; }
        </style>
    </head>
    <body>
    <h2>Step 1: Reference, Nature of Inspection, and General Info</h2>

    <form method="POST">

        <input type="hidden" name="inspector_id" value="<?= $inspector_id ?>">
        
        <label>Inspection Order No.</label>
        <input type="text" name="inspection_order_no" value="<?= $inspection_order_no ?>" readonly>

        <label>Date Issued</label>
        <input type="date" name="date_issued" required>

        <label>Date Inspected</label>
        <input type="date" name="date_inspected" required>

        <h3>Nature of Inspection Conducted</h3>
        <div class="checkbox-group">
            <label><input type="checkbox" name="inspection_construction"> Inspection during construction</label>
            <label><input type="checkbox" name="fsic_annual"> FSIC for Certificate of Annual Inspection (PEZA)</label>
            <label><input type="checkbox" name="fsic_occupancy"> FSIC for Certificate for Occupancy</label>
            <label><input type="checkbox" name="verification_ntc"> Verification: NTC</label>
            <label><input type="checkbox" name="verification_ntcv"> Verification: NTCV</label>
            <label><input type="checkbox" name="verification_abatement"> Verification: Abatement</label>
            <label><input type="checkbox" name="verification_closure"> Verification: Closure</label>
            <label><input type="checkbox" name="fsic_new_permit"> FSIC for Business Permit (New)</label>
            <label><input type="checkbox" name="fsic_renewal_permit"> FSIC for Business Permit (Renewal)</label>
            <label><input type="checkbox" name="notice_disapproval"> Notice of Disapproval (if Cert. of Occupancy)</label>
            <label>Others (Specify): <input type="text" name="other_specify"></label>
        </div>

        <h3>General Information</h3>
        <label>Name of Building</label>
        <input type="text" name="building_name" required>

        <label>Address</label>
        <textarea name="address" required></textarea>

        <label>Business Name</label>
        <input type="text" name="business_name" required>

        <label>Nature of Business</label>
        <input type="text" name="nature_of_business" required>

        <label>Name of Owner/Representative</label>
        <input type="text" name="owner_name" required>

        <label>Contact No.</label>
        <input type="tel" name="contact_no" required>

        <label>FSEC No.</label>
        <input type="text" name="fsec_no">

        <label>FSEC Date Issued</label>
        <input type="date" name="fsec_date">

        <label>Building/Renovation Permit No.</label>
        <input type="text" name="building_permit">

        <label>Permit Date Issued</label>
        <input type="date" name="building_permit_date">

        <label>Latest FSIC No.</label>
        <input type="text" name="fsic_latest">

        <label>FSIC Date Issued</label>
        <input type="date" name="fsic_latest_date">

        <label>Business Permit No.</label>
        <input type="text" name="business_permit">

        <label>Business Permit Date</label>
        <input type="date" name="business_permit_date">

        <label>Fire Insurance Policy No.</label>
        <input type="text" name="insurance_policy">

        <label>Fire Insurance Date Issued</label>
        <input type="date" name="insurance_policy_date">

        <button type="submit">Next &raquo;</button>
    </form>
    </body>
    </html>
