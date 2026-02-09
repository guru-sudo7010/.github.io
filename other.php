<?php
include 'db.php';

/* SAFETY CHECK */
$roll_no = $_GET['roll_no'] ?? '';
if ($roll_no == '') {
    die('Roll number is required');
}

/* FULL SQL QUERY */
$sql = "
SELECT 
    s.roll_no, s.enrollment_no, s.name, s.father_name, s.mother_name,
    s.category, s.medium, s.college,
    c.course_name, c.part, c.exam_session,
    sub.subject_name, sub.max_marks, sub.min_marks,
    m.marks_1, m.marks_2, m.marks_3, m.marks_4, m.marks_5,
    m.subject_total, m.remarks,
    r.total_marks, r.result_status
FROM students s
JOIN student_courses sc ON sc.student_id = s.student_id
JOIN courses c ON c.course_id = sc.course_id
JOIN subjects sub ON sub.course_id = c.course_id
JOIN marks m ON m.subject_id = sub.subject_id AND m.student_id = s.student_id
LEFT JOIN results r ON r.student_id = s.student_id AND r.course_id = c.course_id
WHERE s.roll_no = :roll_no
ORDER BY sub.subject_id
";

$stmt = $pdo->prepare($sql);
$stmt->execute(['roll_no' => $roll_no]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$data) die('No record found');

$student = $data[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>University of Rajasthan - Marksheet</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        table { width: 100%; font-size: 12px; border-collapse: collapse; }
        td, th { border: 1px solid #000; padding: 5px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
<div id="main">
<div id="wrapper">

<!-- HEADER -->
<div id="header">
    <img src="images/header-object.png" alt="University Logo">
</div>

<!-- SIDEBAR -->
<div class="col-3">
    <!-- Sidebar accordion from your template -->
</div>

<!-- CONTENT AREA -->
<div class="col-9">
    <button class="btn btn-primary no-print" onclick="window.print()">Print</button>

    <h2 class="text-center">University of Rajasthan</h2>
    <h3 class="text-center">
        <?= htmlspecialchars($student['course_name']) ?> <?= htmlspecialchars($student['part']) ?> - <?= htmlspecialchars($student['exam_session']) ?>
    </h3>

    <!-- STUDENT INFO -->
    <table class="table table-bordered">
        <tr>
            <td><strong>Name</strong></td><td><?= $student['name'] ?></td>
            <td><strong>Roll No</strong></td><td><?= $student['roll_no'] ?></td>
        </tr>
        <tr>
            <td><strong>Father's Name</strong></td><td><?= $student['father_name'] ?></td>
            <td><strong>Enrollment No</strong></td><td><?= $student['enrollment_no'] ?></td>
        </tr>
        <tr>
            <td><strong>Mother's Name</strong></td><td><?= $student['mother_name'] ?></td>
            <td><strong>Category</strong></td><td><?= $student['category'] ?></td>
        </tr>
        <tr>
            <td><strong>College</strong></td><td><?= $student['college'] ?></td>
            <td><strong>Medium</strong></td><td><?= $student['medium'] ?></td>
        </tr>
    </table>

    <!-- MARKS TABLE -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Subject</th><th>Max</th><th>Min</th>
            <th>I</th><th>II</th><th>III</th><th>IV</th><th>V</th>
            <th>Total</th><th>Result</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $row): ?>
        <tr>
            <td><?= $row['subject_name'] ?></td>
            <td><?= $row['max_marks'] ?></td>
            <td><?= $row['min_marks'] ?></td>
            <td><?= $row['marks_1'] ?></td>
            <td><?= $row['marks_2'] ?></td>
            <td><?= $row['marks_3'] ?></td>
            <td><?= $row['marks_4'] ?></td>
            <td><?= $row['marks_5'] ?></td>
            <td><?= $row['subject_total'] ?></td>
            <td><?= $row['remarks'] ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="8" class="text-end"><strong>Total Marks</strong></td>
            <td colspan="2"><strong><?= $student['total_marks'] ?> (<?= $student['result_status'] ?>)</strong></td>
        </tr>
        </tbody>
    </table>

    <p><strong>Disclaimer:</strong> In case of discrepancy, marksheet issued by University shall be final.</p>
</div>

<!-- FOOTER -->
<div id="footer">
    <p align="center">Copyright © 2026. All Rights Reserved.</p>
    <p align="center">Designed and maintained by INFONET CENTER, University of Rajasthan</p>
</div>

</div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
