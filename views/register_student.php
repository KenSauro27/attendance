<!DOCTYPE html>
<html>
<head>
  <title>Student Registration</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h2>Register as Student</h2>
  <form method="POST" action="../process/process_register_student.php">
    <input type="text" name="name" placeholder="Full Name" class="form-control mb-2" required>
    <select name="course_id" class="form-select mb-2">
      <option value="1">BSIT</option>
      <option value="2">BSCS</option>
      <option value="3">BSA</option>
    </select>
    <select name="year_level" class="form-select mb-2">
      <option value="1">1st Year</option>
      <option value="2">2nd Year</option>
      <option value="3">3rd Year</option>
      <option value="4">4th Year</option>
    </select>
    <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
    <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>
    <button type="submit" class="btn btn-primary">Register</button>
  </form>
</body>
</html>
