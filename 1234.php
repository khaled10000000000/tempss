<?php
// الاتصال بقاعدة البيانات
include "db.php"; // تضمين الاتصال بقاعدة البيانات
// ترتيب الأيام
$daysOrder = ["الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس"];

// مصفوفة لتجميع الجدول حسب اليوم والحصة
$finalSchedule = [];

foreach ($daysOrder as $day) {
    for ($p = 1; $p <= 7; $p++) {
        $finalSchedule[$day][$p] = [];
    }
}

// جلب معلومات الأساتذة
$sql = "SELECT * FROM prof";
$result = $connection->query($sql);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $day = $row['jour']; // اليوم الذي يدرس فيه الأستاذ
    $teacherName = $row['nome']; // اسم الأستاذ

    // إدراج الأساتذة حسب الحصص
    for ($i = 1; $i <= 7; $i++) {
        $column = ($i == 1) ? 'se1' : (($i == 2) ? 'se2' : 's' . $i);

        if (!empty($row[$column])) {
            // إضافة اسم الأستاذ إلى الحصة المناسبة
            $finalSchedule[$day][$i][] = $teacherName;
        }
    }
}

// تحويل أسماء الأساتذة في كل حصة إلى نص مفصول بشرطة
foreach ($finalSchedule as $day => $periods) {
    foreach ($periods as $period => $teachers) {
        $finalSchedule[$day][$period] = implode(" - ", $teachers);
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جدول الحصص</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            direction: rtl;
        }
        table {
            width: 95%;
            margin: 5px auto;
            border-collapse: collapse;
            border: 2px solid black;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            font-size: 20px;
        }
        th {
            background-color: #a8abac;
        }
        td {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<h2>جدول الحصص</h2>

<table>
    <thead>
        <tr>
            <th>اليوم</th>
            <th>08:00-09:00</th>
            <th>09:00-10:00</th>
            <th>10:00-11:00</th>
            <th>11:00-12:00</th>
            <th>13:30-14:30</th>
            <th>14:30-15:30</th>
            <th>15:30-16:30</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($daysOrder as $day): ?>
            <tr>
                <td style="background-color:#a8abac;"><?php echo $day; ?></td>
                <?php for ($p = 1; $p <= 7; $p++): ?>
                    <td><?php echo isset($finalSchedule[$day][$p]) ? $finalSchedule[$day][$p] : ''; ?></td>
                <?php endfor; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>


