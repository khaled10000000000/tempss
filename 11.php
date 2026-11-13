<?php
// إعداد الاتصال بقاعدة بيانات SQLite
include "db.php";

$sections = [
    "1م1", "1م2", "1م3", "1م4", "1م5","1م6",
    "2م1", "2م2", "2م3", "2م4", "2م5", 
    "3م1", "3م2", "3م3", "3م4", "3م5",
    "4م1", "4م2", "4م3", "4م4"
];

// ترتيب الأيام
$days = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس'];

// مصفوفة نهائية لتخزين الجدول حسب الأيام والأقسام
$finalSchedule = [];

foreach ($days as $day) {
    // استعلام لجلب بيانات كل يوم
    $sql = "SELECT * FROM prof WHERE jour='$day'";
    $result = $connection->query($sql);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        foreach ($sections as $section) {
            for ($i = 1; $i <= 8; $i++) {
                $column = $i == 1 ? 'se1' : ($i == 2 ? 'se2' : 's' . $i);
                if (!empty($row[$column]) && strpos($row[$column], $section) !== false) {
                    $cellData = $row['nome'];
                    $finalSchedule[$day][$section][$i][] = $cellData;
                }
            }
        }
    }

    // دمج أسماء الأساتذة داخل كل خلية بفاصل سطر (<br>)
    foreach ($sections as $section) {
        for ($p = 1; $p <= 8; $p++) {
            $finalSchedule[$day][$section][$p] = isset($finalSchedule[$day][$section][$p]) ? implode("<br>", $finalSchedule[$day][$section][$p]) : "";
        }
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
      .copy-btn { margin: 10px; padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer; font-size: 16px; }
      .copy-btn:hover { background-color: #45a049; }
  </style>
</head>
<body>
<h2>جدول الحصص برسم الموسم الدراسي 2025/2024</h2>
<button class="copy-btn" onclick="copyTableData()">نسخ الجدول</button>
<table id="scheduleTable">
  <thead>
    <tr>
      <th>القسم</th>
      <th>اليوم</th>
      <th>الحصة 1</th>
      <th>الحصة 2</th>
      <th>الحصة 3</th>
      <th>الحصة 4</th>
      <th>الحصة 5</th>
      <th>الحصة 6</th>
      <th>الحصة 7</th>
      <th>الحصة 8</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($days as $day): ?>
      <?php foreach ($sections as $section): ?>
      <tr>
        <td style="font-size:18px; background-color:#a8abac; padding:5px;"> <?php echo $section; ?> </td>
        <td style="font-size:16px; background-color:#d4d4d4; padding:5px;"> <?php echo $day; ?> </td>
        <?php for ($p = 1; $p <= 8; $p++): ?>
          <td><?php echo !empty($finalSchedule[$day][$section][$p]) ? $finalSchedule[$day][$section][$p] : ''; ?></td>
        <?php endfor; ?>
      </tr>
      <?php endforeach; ?>
    <?php endforeach; ?>
</tbody>

</table>

<script>
function copyTableData() {
    const table = document.getElementById('scheduleTable');
    const rows = table.querySelectorAll('tbody tr');
    let csvData = '';

    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        let rowData = [];
        
        cells.forEach((cell, index) => {
            // تخطي عمود القسم واليوم (أول خليتين)
            if (index < 2) return;
            
            // استبدال <br> بمساحة لدمج الأسماء في خلية واحدة
            let cellText = cell.innerHTML.replace(/<br>/g, ' ');
            cellText = cellText.trim();
            rowData.push(cellText);
        });
        
        csvData += rowData.join('\t') + '\n';
    });

    // نسخ البيانات إلى الحافظة
    navigator.clipboard.writeText(csvData).then(() => {
        alert('تم نسخ البيانات بنجاح! يمكنك الآن لصقها في قاعدة البيانات.');
    }).catch(err => {
        console.error('خطأ في النسخ:', err);
        alert('حدث خطأ أثناء النسخ');
    });
}
</script>

</body>
</html>

