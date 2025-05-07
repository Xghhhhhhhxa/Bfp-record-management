<?php 
// choice.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Inspector Choices</title>

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
 <!-- External Css -->
 <link href="css/choice_style.css" rel="stylesheet">
</head>

<body>

  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4">

      <!-- Logo Row -->
      <div class="row logo-row text-center">
        <div class="col-3 d-flex justify-content-end pe-2">
          <img src="img/leftlogo1.png" alt="Logo Left" class="logo-img">
        </div>
        <div class="col-6 d-flex justify-content-center align-items-center px-2">
          <span class="logo-text">Bureau of Fire Protection Hinigaran</span>
        </div>
        <div class="col-3 d-flex justify-content-start ps-2">
          <img src="img/logright.png" alt="Logo Right" class="logo-img">
        </div>
      </div>

      <!-- Welcome & Options -->
      <h2 class="text-center mb-4">Welcome, 
        <?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'Guest'; ?>!
      </h2>
      <h3 class="text-center mb-4">Choose an Option:</h3>

      <!-- Barangay selection form -->
      <form action="checklist_step1.php" method="post">
        <div class="mb-3">
          <label for="barangay" class="form-label">Assigned Barangay:</label>
          <?php if (count($_SESSION['barangay_assigned']) > 1): ?>
            <select class="form-control" id="barangay" name="barangay">
              <?php foreach ($_SESSION['barangay_assigned'] as $barangay): ?>
                <option value="<?= htmlspecialchars($barangay) ?>"><?= htmlspecialchars($barangay) ?></option>
              <?php endforeach; ?>
            </select>
          <?php else: ?>
            <input type="text" class="form-control" name="barangay" value="<?= htmlspecialchars($_SESSION['barangay_assigned'][0]) ?>" readonly>
          <?php endif; ?>
        </div>

        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <a href="print.php" class="btn btn-outline-primary w-100">View Inspector Panel</a>
          </li>
          <li class="list-group-item">
            <button type="submit" name="go_to_checklist" class="btn btn-outline-primary w-100">Go to Checklist</button>
          </li>
        </ul>
      </form>

      <div class="mt-4 text-center">
        <a href="login.php" class="btn btn-danger w-100">Logout</a>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
