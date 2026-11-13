<?php
// إعداد الاتصال بقاعدة بيانات SQLite
$database_file = './databasse3.db';
$connection = new PDO("sqlite:$database_file");
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// التأكد من استقبال القسم
$targetSection = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['class'])) {
    $targetSection = trim($_POST['class']);  // إزالة أي فراغات غير مرغوب فيها
}

// التأكد من أن القسم ليس فارغًا
if (!empty($targetSection)) {
    // جلب جميع بيانات الأساتذة
    $sql = "SELECT * FROM prof";
    $result = $connection->query($sql);

    // تحديد الأساتذة الذين يدرّسون القسم المطلوب
    $professors = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        for ($i = 1; $i <= 7; $i++) {
            $column = ($i == 1) ? 'se1' : (($i == 2) ? 'se2' : 's' . $i);
            if (!empty($row[$column]) && stripos($row[$column], $targetSection) !== false) {
                $professors[$row['nome']] = $row['nome'];
            }
        }
    }

    // إعادة جلب بيانات الأساتذة للبحث عن "استقبال"
    $result = $connection->query($sql);
    $finalSchedule = [];
    $daysOrder = ["الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس"];

    // تهيئة الجدول الفارغ ليكون كل حصة عبارة عن مصفوفة
    foreach ($daysOrder as $d) {
        for ($p = 1; $p <= 8; $p++) {
            $finalSchedule[$d][$p] = [];  // مصفوفة لتخزين أكثر من أستاذ
        }
    }

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        if (isset($professors[$row['nome']])) {
            $day = $row['jour'];
            for ($i = 1; $i <= 8; $i++) {
                $column = ($i == 1) ? 'se1' : (($i == 2) ? 'se2' : 's' . $i);
                if (!empty($row[$column]) && stripos($row[$column], "استقبال") !== false) {
                  $finalSchedule[$day][$i][] = $row['nome'] . ' - ' . $row['matiere'];
                }
            }
        }
    }
}

$connection = null;
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>جدول الحصص للقسم <?php echo htmlspecialchars($targetSection); ?></title>
  <style>
      @media print {
          @page { size: A4 landscape; margin: 0; }
          body { margin: 0.6cm; }
      }
      body { font-family: sans-serif; direction: rtl; }
      table { border-collapse: collapse; width: 100%; }
      td, th { border: 2px solid black; padding: 1px; text-align: center; font-size: 16px; font-weight: bold; }
      th { background-color: #c7c7c7; font-size: 18px; }
      tr { height: 70px; }
      .b1{ line-height: 0.6; text-align: center; }
      .b2{ line-height: 0.6; text-align: right; }
      .b7{  text-align: left; }

  </style>
</head>
<body>
  <h3 class="b1">الجمهورية الجزائرية الديمقراطية الشعبية</h3>
  <h3 class="b1">وزارة التربية الوطنية</h3>
  <h3 class="b2">مديرية التربية لولاية معسكر</h3>
  <h3 class="b2">متوسطة مبرك العربي 500 سكن المحمدية</h3>
  <h2 class="b1">جدول ايام الاستقبال  الموسم الدراسي 2027/2026 لقسم : <?php echo htmlspecialchars($targetSection); ?></h2>
  <table>
    <thead>
      <tr>
        <th>اليوم</th>
        <th>09:00-08:00</th>
        <th>10:00-09:00</th>
        <th>11:00-10:00</th>
        <th>12:00-11:00</th>
        <th>14:30-13:30</th>
        <th>15:30-14:30</th>
        <th>16:30-15:30</th>
        <th>17:30-16:30</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($daysOrder as $day): ?>
        <tr>
          <td style="font-size:18px; background-color:#a8abac; padding:2px;"> <?php echo $day; ?> </td>
          <?php for ($p = 1; $p <= 8; $p++): ?>
            <td>
              <?php 
                if (!empty($finalSchedule[$day][$p])) {
                    echo implode('<br>', array_map('htmlspecialchars', $finalSchedule[$day][$p]));
                } 
              ?>
            </td>
          <?php endfor; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <h3 class='b7'>حرر بالمحمدية يوم : 15-10-2025</h3>
  <h2 class='b1'>امضاء المديرة</h2>
</body>
</html>



