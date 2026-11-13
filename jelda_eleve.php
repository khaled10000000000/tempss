<?php
// إعداد الاتصال بقاعدة بيانات SQLite
include "db.php";

$sections = [
    "1م1", "1م2", "1م3", "1م4", "1م5","1م6",
    "2م1", "2م2", "2م3", "2م4", "2م5",
    "3م1", "3م2", "3م3", "3م4", "3م5",
    "4م1", "4م2", "4م3", "4م4"
];

// أيام الأسبوع
$days = ["الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس"];

// مصفوفة نهائية لتخزين الجدول حسب اليوم والقسم والحصة
$finalSchedule = [];

// استعلام لجلب جميع بيانات جدول الأساتذة
$sql = "SELECT * FROM prof";
$result = $connection->query($sql);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $day = $row['jour'];
    if (!in_array($day, $days)) continue;
    
    foreach ($sections as $section) {
        for ($i = 1; $i <= 8; $i++) {
            $column = $i == 1 ? 'se1' : ($i == 2 ? 'se2' : 's' . $i);
            if (!empty($row[$column]) && strpos($row[$column], $section) !== false) {
                $parts = explode("_", $row[$column]);
                $rest = isset($parts[1]) ? $parts[1] : "";
                $cellData = $row['nome'] . "_" . $rest;
                $finalSchedule[$day][$section][$i][] = $cellData;
            }
        }
    }
}
// دمج البيانات داخل كل خلية بفاصل سطر (<br>)
foreach ($days as $day) {
    foreach ($sections as $section) {
        for ($p = 1; $p <= 8; $p++) {
            if (isset($finalSchedule[$day][$section][$p])) {
                $finalSchedule[$day][$section][$p] = implode("<br>", $finalSchedule[$day][$section][$p]);
            } else {
                $finalSchedule[$day][$section][$p] = "";
            }
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

  @media print {
    @page {
        size: a3;
        margin: 0cm;
    }

    body {
        margin: 0.2cm;
    }
    

}
      body { font-family: sans-serif; direction: rtl; }
      table { border-collapse: collapse; width: 100%; }
      th, td { border: 2px solid black; padding: 2px; text-align: center; font-size: 16px; font-weight: bold;height:59px; }
      th { background-color:rgb(0, 0, 0);color: white;font-size:30px;border:2px solid white; }
      
      /* تنسيق الخلية المحددة */
      td.selected {
        background-color: #ffeb3b !important;
        border: 3px solid #ff0000 !important;
      }
      
      /* تنسيق زر إنشاء التقرير */
      #generateBtn {
        margin: 20px;
        padding: 15px 30px;
        font-size: 20px;
        background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      }
      #generateBtn:hover {
        background-color: #45a049;
      }
      
      /* تنسيق جدول التقرير */
      #reportTable {
        margin: 20px auto;
        border-collapse: collapse;
      }
      #reportTable th, #reportTable td {
        border: 2px solid black;
        padding: 10px;
        text-align: center;
        font-size: 18px;
      }
      #reportTable th {
        background-color: #333;
        color: white;
      }

  </style>
</head>
<body>
<button id="generateBtn" onclick="generateReport()">إنشاء تقرير الخلايا المحددة</button>

<?php foreach ($days as $day): ?>
<div style="margin: 20px 0;">
  <h2 style="text-align:center; font-size:35px;"><?php echo $day; ?></h2>
  <table id="scheduleTable_<?php echo $day; ?>">
    <thead>
      <tr>
        <th style="font-size:25px;">القسم</th>
        <th>08:00</th>
        <th>09:00</th>
        <th>10:00</th>
        <th>11:00</th>
        <th>13:30</th>
        <th>14:30</th>
        <th>15:30</th>
        <th>16:30</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($sections as $section): ?>
        <tr>
          <td style="font-size:25px; background-color:black; padding:3px;color:white;border:2px solid white;"> <?php echo $section; ?> </td>
          <?php for ($p = 1; $p <= 8; $p++): ?>
            <td style="color:black bold solid; font-size:16px;" onclick="toggleCell(this, '<?php echo $section; ?>', '<?php echo $day; ?>', <?php echo $p; ?>)" data-section="<?php echo $section; ?>" data-day="<?php echo $day; ?>" data-period="<?php echo $p; ?>"><?php echo isset($finalSchedule[$day][$section][$p]) ? $finalSchedule[$day][$section][$p] : ''; ?></td>
          <?php endfor; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php endforeach; ?>

<!-- جدول التقرير -->
<div id="reportContainer" style="display:none;">
  <h2 style="text-align:center;">تقرير الخلايا المحددة</h2>
  <table id="reportTable">
    <thead>
      <tr>
        <th>الأستاذ</th>
        <th>الأقسام</th>
      </tr>
    </thead>
    <tbody id="reportBody">
    </tbody>
  </table>
</div>

<script>
// مصفوفة لتخزين الخلايا المحددة
let selectedCells = [];

// دالة لتبديل تحديد الخلية
function toggleCell(cell, section, day, period) {
  if (cell.classList.contains('selected')) {
    cell.classList.remove('selected');
    // إزالة من المصفوفة
    selectedCells = selectedCells.filter(c => c.section !== section || c.day !== day || c.period !== period);
  } else {
    cell.classList.add('selected');
    // إضافة للمصفوفة
    selectedCells.push({
      section: section,
      day: day,
      period: period,
      content: cell.innerHTML
    });
  }
}

// دالة لإنشاء التقرير
function generateReport() {
  if (selectedCells.length === 0) {
    alert('الرجاء تحديد خلية واحدة على الأقل');
    return;
  }
  
  // تجميع البيانات: الأستاذ -> الأقسام والأيام مع عدد الفروج
  let profData = {};
  
  selectedCells.forEach(cell => {
    if (cell.content.trim() === '') return;
    
    // تقسيم المحتوى إذا كان يحتوي على <br> (أكثر من استاذ في الخلية)
    let profs = cell.content.split('<br>');
    
    // تحديد نوع الحصة
    let classType = (profs.length > 1) ? ' (أعمال موجهة)' : ' (حصة عادية)';
    
    profs.forEach(profEntry => {
      if (profEntry.trim() === '') return;
      
      // استخراج اسم الأستاذ (قبل _ إذا وجد)
      let profName = profEntry.split('_')[0].trim();
      
      if (!profData[profName]) {
        profData[profName] = [];
      }
      
      // إضافة القسم واليوم كفوج منفصل مع نوع الحصة
      let cellInfo = cell.section + ' (' + cell.day + ')' + classType;
      profData[profName].push(cellInfo);
    });
  });
  
  // عرض التقرير
  let reportBody = document.getElementById('reportBody');
  reportBody.innerHTML = '';
  
  for (let prof in profData) {
    let row = document.createElement('tr');
    let foujCount = profData[prof].length;
    row.innerHTML = '<td>' + prof + '</td><td>' + profData[prof].join(', ')  + foujCount + '</td>';
    reportBody.appendChild(row);
  }
  
  document.getElementById('reportContainer').style.display = 'block';
}
</script>
</body>
</html>
