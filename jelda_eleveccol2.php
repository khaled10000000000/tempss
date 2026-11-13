<?php
// متوافق مع النسخ القديمة من PHP
include "db.php";

$dayName = "الأحد";

$sections = array(
    "1م1","1م2","1م3","1م4","1م5","1م6",
    "2م1","2م2","2م3","2م4","2م5",
    "3م1","3م2","3م3","3م4","3م5",
    "4م1","4م2","4م3","4م4"
);

// الأقسام الخاصة بقاعدة الرياضيات والعربية
$specialSections = array("4م1","4م2","4م3","4م4");

/* ---------- ألوان المواد ----------
   label : الاسم في دليل الألوان
   keys  : كلمات تبحث عنها داخل عمود matiere (الترتيب مهم: الأولى تُفحص أولًا)
   color : اللون                                                            */
$subjects = array(
    array('label' => 'الرياضيات',          'keys' => array('الرياضيات'),                         'color' => '#3939dd'), // أزرق
    array('label' => 'اللغة العربية     ',    'keys' => array('اللغة العربية'),                           'color' => '#e14c4c'), // أحمر
    array('label' => 'اللغة الفرنسية',   'keys' => array('اللغة الفرنسية'),                          'color' => '#e09148'), // بنفسجي
    array('label' => 'اللغة الإنجليزية', 'keys' => array('إنجليزية', 'انجليزية'),            'color' => '#08d4f4'), // سماوي
    array('label' => 'الفيزباء',           'keys' => array('الفيزباء', 'فيزيائ'),                'color' => '#36e233'), // وردي
    array('label' => 'العلوم الطبيعية ',      'keys' => array('العلوم الطبيعية'),                            'color' => '#fcf404'), // أصفر
    array('label' => 'الاجتماعيات',            'keys' => array('الاجتماعيات'),                           'color' => '#b37938'), // بيج
    array('label' => 'التربية الاسلامية ',    'keys' => array('التربية الاسلامية', 'التربية الإسلامية'),              'color' => '#919ead'), // رمادي
    array('label' => 'تربية بدنية',      'keys' => array('بدنية'),                           'color' => '#99f6e4'), // تركوازي
    array('label' => 'تربية تشكيلية',    'keys' => array('تشكيلية'),                         'color' => '#be85a5'), // وردي فاتح
);

define('SHARED_COLOR', '#e95eab'); // أخضر: التقاء أستاذين/مادتين في نفس الخلية
define('DOUBLE_COLOR', '#b572dc'); // برتقالي: ساعتان متتاليتان (رياضيات/عربية للسنة 4)

/* ---------- دوال مساعدة ---------- */
function hasWord($text, $words) {
    foreach ($words as $w) {
        if ($text !== '' && strpos($text, $w) !== false) return true;
    }
    return false;
}

function subjectColor($matiere, $subjects) {
    if ($matiere === '') return '#ffffff';
    foreach ($subjects as $s) {
        if (hasWord($matiere, $s['keys'])) return $s['color'];
    }
    // مادة غير معرّفة: لون تلقائي ثابت
    $hue = abs(crc32($matiere)) % 360;
    return "hsl(" . $hue . ",70%,85%)";
}

function isSciPhy($matiere) {
    return hasWord($matiere, array('علوم', 'فيزياء', 'فيزيائ'));
}

function isMathAr($matiere) {
    return hasWord($matiere, array('رياضيات', 'عربية'));
}

// ترجع المدخل الوحيد في الخلية أو null إن كانت فارغة أو فيها أكثر من مدخل
function single($schedule, $section, $p) {
    if (empty($schedule[$section][$p])) return null;
    if (count($schedule[$section][$p]) !== 1) return null;
    return $schedule[$section][$p][0];
}

// بصمة الخلية: نفس الأساتذة ونفس الباقي (مثل ق1) => نفس البصمة
function cellSignature($entries) {
    $items = array();
    foreach ($entries as $e) {
        $items[] = $e['prof'] . "_" . $e['rest'];
    }
    sort($items);
    return implode("|", $items);
}

/* ---------- جلب بيانات اليوم ---------- */
$finalSchedule = array();

$stmt = $connection->prepare("SELECT * FROM prof WHERE jour = ?");
$stmt->execute(array($dayName));

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $matiere = isset($row['matiere']) ? trim($row['matiere']) : '';
    foreach ($sections as $section) {
        for ($i = 1; $i <= 8; $i++) {
            $column = ($i == 1) ? 'se1' : (($i == 2) ? 'se2' : 's' . $i);
            if (!empty($row[$column]) && strpos($row[$column], $section) !== false) {
                $parts = explode("_", $row[$column]);
                $rest = isset($parts[1]) ? $parts[1] : "";
                $finalSchedule[$section][$i][] = array(
                    'prof' => $row['nome'],
                    'mat'  => $matiere,
                    'rest' => $rest
                );
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
    @page { size: a3 landscape; margin: 0; }
    body { margin: 0.2cm; }
}
body { font-family: sans-serif; direction: rtl; }

table {
    border-collapse: separate;   /* بدل collapse حتى يعمل التباعد والتقوّس */
    border-spacing: 2px;         /* المسافة بين الخلايا */
    width: 100%;
}
th, td {
    border: 2px solid black;
    border-radius: 14px;         /* تقوّس الزوايا */
    padding: 2px; text-align: center;
    font-size: 33px; font-weight: bold;height: 130px;
    -webkit-print-color-adjust: exact; print-color-adjust: exact;
}


th { background-color: #000; color: white; font-size: 30px; border: 2px solid #000; }
td.cell { color: black; font-size: 30px; }

td.sec { font-size: 30px; background: black; padding: 3px; color: white; border: 2px solid #000;padding-left:16px; }

.legend { margin: 10px 0; display: flex; flex-wrap: wrap; gap: 6px;border: 10px solid black;padding: 10px; }
.legend span {
    border: 2px solid black; border-radius: 10px;
    padding: 20px 20px; font-weight: bold; font-size: 30px;
    -webkit-print-color-adjust: exact; print-color-adjust: exact;
}
</style>
</head>
<body>



<table>
<thead>
<tr>
  <th colspan="9" style="text-align:center;font-size:30px;border:2px solid white;"><?php echo $dayName; ?></th>
</tr>
<tr>
  <th>القسم</th>
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
<?php foreach ($sections as $section): ?>
<tr>
  <td class="sec"><?php echo $section; ?></td>
  <?php
  for ($p = 1; $p <= 8; $p++) {
      $entries = isset($finalSchedule[$section][$p]) ? $finalSchedule[$section][$p] : array();

      // خلية فارغة
      if (count($entries) == 0) {
          echo '<td class="cell" style="background-color: gray;"></td>';
          continue;
      }

      // نص الخلية: اسم الأستاذ (+ الباقي إن وجد)
      $lines = array();
      foreach ($entries as $e) {
          $lines[] = ($e['rest'] !== '') ? $e['prof'] . "_" . $e['rest'] : $e['prof'];
      }
      $text = implode("<br>", $lines);

      // 1) التقاء أستاذين أو أكثر في نفس الخلية => أخضر (مشتركة)
      if (count($entries) > 1) {
          // إذا تكرر نفس المحتوى في الحصص التالية المتتالية => دمج في خلية واحدة
          $sig  = cellSignature($entries);
          $span = 1;
          while ($p + $span <= 8 && ($p + $span - 1) != 4) {
              $nextEntries = isset($finalSchedule[$section][$p + $span]) ? $finalSchedule[$section][$p + $span] : array();
              if (count($nextEntries) > 1 && cellSignature($nextEntries) === $sig) {
                  $span++;
              } else {
                  break;
              }
          }
          $colspan = ($span > 1) ? ' colspan="' . $span . '"' : '';
          echo '<td class="cell"' . $colspan . ' style="background:' . SHARED_COLOR . '">' . $text . '</td>';
          $p += $span - 1; // تخطي الخلايا المدموجة
          continue;
      }

      $cur   = $entries[0];
      $color = subjectColor($cur['mat'], $subjects);

      // الحصة 4 و5 غير متتاليتين (استراحة الغداء)
      $next = ($p < 8 && $p != 4) ? single($finalSchedule, $section, $p + 1) : null;
      $prev = ($p > 1 && $p != 5) ? single($finalSchedule, $section, $p - 1) : null;

      // 2) علوم / فيزياء: ساعتان متتاليتان لنفس الأستاذ => دمج الخليتين
      if (isSciPhy($cur['mat']) && $next !== null && $next['prof'] === $cur['prof']) {
          echo '<td class="cell" colspan="2" style="background:' . $color . '">' . $text . '</td>';
          $p++; // تخطي الخلية التالية
          continue;
      }

      // 3) رياضيات / عربية للأقسام 4م1..4م4: ساعتان متتاليتان لنفس القسم => برتقالي
      if (in_array($section, $specialSections) && isMathAr($cur['mat'])) {
          $sameNext = ($next !== null && $next['mat'] === $cur['mat']);
          $samePrev = ($prev !== null && $prev['mat'] === $cur['mat']);
          if ($sameNext || $samePrev) {
              $color = DOUBLE_COLOR;
          }
      }

      echo '<td class="cell" style="background:' . $color . '">' . $text . '</td>';
  }
  ?>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<!-- دليل الألوان -->
<div class="legend">
<?php foreach ($subjects as $s): ?>
    <span style="background:<?php echo $s['color']; ?>"><?php echo $s['label']; ?></span>
<?php endforeach; ?>
    <span style="background:<?php echo SHARED_COLOR; ?>">اعمال مووجهة </span>
    <!--<span style="background:<?php echo DOUBLE_COLOR; ?>">ساعتان متتاليتان (رياضيات/عربية - السنة 4)</span>-->
</div>
</body>
</html>
