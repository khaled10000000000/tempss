<?php
// إعداد الاتصال بقاعدة بيانات SQLite
include "db.php";

$sections = [
    "1م1", "1م2", "1م3", "1م4", "1م5","1م6",
    "2م1", "2م2", "2م3", "2م4", "2م5", 
    "3م1", "3م2", "3م3", "3م4", "3م5",
    "4م1", "4م2", "4م3", "4م4"
];

// مصفوفة نهائية لتخزين الجدول حسب الأقسام
$finalSchedule = [];

// استعلام لجلب جميع بيانات جدول الأساتذة
$sql = "SELECT * FROM prof WHERE jour='الإثنين'";
$result = $connection->query($sql);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    foreach ($sections as $section) {
        for ($i = 1; $i <= 7; $i++) {
            $column = $i == 1 ? 'se1' : ($i == 2 ? 'se2' : 's' . $i);
            if (!empty($row[$column]) && strpos($row[$column], $section) !== false) {
                $cellData = $row['nome']; // فقط اسم الأستاذ بدون أي إضافات
                $finalSchedule[$section][$i][] = $cellData;
            }
        }
    }
}

// دمج أسماء الأساتذة داخل كل خلية بفاصل سطر (<br>)
foreach ($finalSchedule as $section => $periods) {
    for ($p = 1; $p <= 7; $p++) {
        $finalSchedule[$section][$p] = isset($finalSchedule[$section][$p]) ? implode("<br>", $finalSchedule[$section][$p]) : "";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>جدول الحصص حسب الأقسام</title>
  <style>
      body { font-family: sans-serif; direction: rtl; }
      table { border-collapse: collapse; width: 100%; }
      th, td { border: 2px solid black; padding: 5px; text-align: center; font-size: 14px; font-weight: bold; }
      th { background-color: #a8abac; }
  </style>
</head>
<body>
<h2>جدول الحصص برسم الموسم الدراسي 2025/2024</h2>
<table>
  <thead>
    <tr>
      <th>القسم</th>
      <th>التلاميذ الفائبون</th>
      <th>09:00-08:00</th>
      <th>10:00-09:00</th>
      <th>11:00-10:00</th>
      <th>12:00-11:00</th>
      <th>09:00-08:00</th>
      <th>10:00-09:00</th>
      <th>11:00-10:00</th>
      <th>12:00-11:00</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($sections as $section): ?>
      <tr>
        <td style="font-size:18px; background-color:#a8abac; padding:5px;"> <?php echo $section; ?> </td>
        
        <!-- خلية فارغة بعد القسم -->
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <?php for ($p = 1; $p <= 4; $p++): ?>
          <td><?php echo !empty($finalSchedule[$section][$p]) ? $finalSchedule[$section][$p] : ''; ?></td>
        <?php endfor; ?>
      </tr>
    <?php endforeach; ?>
</tbody>

</table>
</body>
</html>

