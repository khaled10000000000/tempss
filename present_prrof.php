<?php
// إعداد الاتصال بقاعدة بيانات SQLite
$database_file = './databasse3.db';
$connection = new PDO("sqlite:$database_file");
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// القائمة الكاملة للأقسام المطلوبة
$sections = [
    "1م1", "1م2", "1م3", "1م4", "1م5",
    "2م1", "2م2", "2م3", "2م4", "2م5", "2م6",
    "3م1", "3م2", "3م3", "3م4", "3م5",
    "4م1", "4م2", "4م3", "4م4"
];

// تهيئة مصفوفة الجدول النهائي بحيث لكل قسم ولكل حصة من 1 إلى 7 مصفوفة لتجميع القيم
$finalSchedule = [];
foreach ($sections as $sec) {
    for ($p = 1; $p <= 7; $p++) {
        $finalSchedule[$sec][$p] = [];
    }
}

// نحدد اليوم المطلوب (مثلاً "الأحد")
$targetDay = "الأحد";

// استعلام لجلب جميع بيانات جدول الأساتذة ليوم الأحد
$sql = "SELECT * FROM prof WHERE jour = '$targetDay'";
$result = $connection->query($sql);

// نفترض أن عمود المادة هنا هو "obs" (يمكنك تغييره إذا كان مختلفًا)
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $subject = isset($row['obs']) ? $row['obs'] : "";
    // فحص الأعمدة الخاصة بالحصص (se1, se2, s3, ..., s7)
    for ($i = 1; $i <= 7; $i++) {
        if ($i == 1) {
            $column = 'se1';
        } elseif ($i == 2) {
            $column = 'se2';
        } else {
            $column = 's' . $i;
        }
        // إذا كانت الخلية غير فارغة
        if (!empty($row[$column])) {
            // لكل قسم من الأقسام نتحقق إن كانت القيمة تحتوي على رمز القسم
            foreach ($sections as $sec) {
                if (strpos($row[$column], $sec) !== false) {
                    // نقسم النص على الشرطة السفلية للحصول على الجزء (مثلاً "ق8")
                    $parts = explode("_", $row[$column]);
                    $rest = isset($parts[1]) ? $parts[1] : "";
                    // تركيب القيمة الجديدة بالشكل: المادة_الاستاذ_القسم
                    $cellData = $subject . "_" . $row['nome'] . "_" . $rest;
                    // تجميع البيانات في مصفوفة الجدول النهائية للقسم المحدد والحصة المحددة
                    $finalSchedule[$sec][$i][] = $cellData;
                }
            }
        }
    }
}

$connection = null; // إغلاق الاتصال بقاعدة البيانات

// دمج القيم داخل كل خلية بفاصل <br>
foreach ($finalSchedule as $sec => $periods) {
    foreach ($periods as $p => $values) {
        $finalSchedule[$sec][$p] = implode("<br>", $values);
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>جدول الحصص ليوم <?php echo $targetDay; ?></title>
  <style>
    body {
      font-family: sans-serif;
      direction: rtl;
    }
    table {
      border-collapse: collapse;
      margin-bottom: 10px;
      width: 100%;
    }
     td {
      border: 2px solid black;
      padding: 2px;
      text-align: center;
      font-size: 14px;
      font-weight: bold; 
    }
    th {
      background-color: #a8abac;
      font-size: 18px;
      border: 2px solid black;
      padding: 2px;
      text-align: center;
      font-weight: bold; 
    }
    tr {
    height: 65px; /* قيمة الارتفاع التي تناسب احتياجاتك */
}
td:empty  {
    background-color: #c7c7c7 !important;
    background-image: repeating-linear-gradient(
        45deg, 
        #999 0px, 
        #999 2px, 
        transparent 2px, 
        transparent 6px
    );
}
  </style>
</head>
<body>
  <table>
    <thead>
        <tr  >
            <th colspan=8>الاحد</th>
        </tr>
      <tr>
         <th>القسم</th>
         <th>09:00-08:00</th>
                    <th >10:00-09:00</th>
                    <th >11:00-10:00</th>
                    <th >12:00-11:00</th>
                    <th >14:30-13:30</th>
                    <th >15:30-14:30</th>
                    <th >16:30-15:30</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($sections as $sec): ?>
        <tr>
          <td style="background-color:#a8abac; font-size:18px; padding:5px;"><?php echo $sec; ?></td>
          <?php for ($p = 1; $p <= 7; $p++): ?>
            <td><?php echo isset($finalSchedule[$sec][$p]) ? $finalSchedule[$sec][$p] : ''; ?></td>
          <?php endfor; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>


