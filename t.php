<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <title>الأحد </title>
<style>

@font-face {
    font-family: hacen;
    src: url(hacen.ttf);
}

/* ===== نظام الألوان ===== */
:root {
    --ink: #1b2433;
    --navy: #0e2a4d;
    --navy-2: #1c4a82;
    --gold: #f2b134;
    --free: #0f8a7e;
    --free-2: #0a6359;
    --reception: #e3e7ee;
    --radius: 10px;
}

@media print {
    @page {
        size: A4 landscape;
        margin: 0.3cm;
    }

    body {
        margin: 0;
        background: #fff !important;
    }

    table {
        box-shadow: none !important;
        border-collapse: separate !important;
        border-spacing: 4px !important;
        width: 100% !important;
        page-break-inside: auto;
    }

    tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }

    td, th {
        page-break-inside: avoid;
    }

    thead {
        display: table-row-group !important;
    }

    * {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
}

body {
    display: block;
    color: var(--ink);
    background: #eef1f7;
    font-family: hacen, Tahoma, "Segoe UI", sans-serif;
    padding: 2px;
}

/* ===== الجدول كبطاقة ===== */
table {
    width: 100%;
    direction: rtl;
    text-align: center;
    font-size: 27px;
    font-weight: bold;
    border-collapse: separate;
    border-spacing: 3px;
    background: #ffffff;
    border: 0;
    border-radius: 18px;
    box-shadow: 0 8px 24px rgba(14, 42, 77, .15);
    margin-bottom: 10px;
}

th, td {
    text-align: center;
    padding: 2px;
    border: 1px solid black;
    border-radius: var(--radius);
}

tr {
    height: 65px;
}

/* ===== العناوين ===== */
th {
    background: linear-gradient(160deg, var(--navy-2), var(--navy)) !important;
    color: #fff;
    border: 1.5px solid black;
    text-shadow: 0 1px 2px rgba(0, 0, 0, .3);
}

/* شريط العنوان الرئيسي */
thead tr:first-child th {
    background: linear-gradient(100deg, var(--navy) 0%, var(--navy-2) 60%, var(--navy) 100%) !important;
    border-radius: 14px;
    box-shadow: inset 0 -4px 0 var(--gold);
    letter-spacing: 1px;
}

/* ===== خلية الأستاذ ===== */
td.prof {
    background: linear-gradient(135deg, var(--strong, #1c4a82), var(--dark, #0e2a4d));
    color: var(--txt, #fff);
    box-shadow: 0 2px 5px rgba(0, 0, 0, .25), inset 0 1px 0 rgba(255, 255, 255, .25);
    text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
}

/* ===== خلايا الحصص ===== */
td.slot {
    background-color: var(--soft, #eef1f5);
    color: var(--ink);
    border-right: 10px solid var(--strong, #1c4a82);
    box-shadow: inset 0 0 0 1px rgba(0, 0, 0, .06);
}

/* ===== الخلايا الفارغة: خطوط مائلة ناعمة ===== */
td.slot:empty {
    border-right-color: transparent;
    background-image: repeating-linear-gradient(
        45deg,
        rgba(8, 0, 0, 0.35) 0px,
        rgba(255, 255, 255, .9) 2px,
        transparent 2px,
        transparent 8px
    );
}

/* ===== الخلايا المتضاربة ===== */
td.slot.conflict {
    background: linear-gradient(135deg, #ebc52d, #c92a2a) !important;
    color: #0d0c0c !important;
    border-right-color: #a61e1e !important;
    position: relative;
}

td.slot.conflict::before {
    content: "TD";
    position: absolute;
    top: 1px;
    left: 2px;
    font-size: 13px;
    font-weight: bold;
    color: #131111;
    background: rgba(0, 0, 0, 0.3);
    padding: 1px 1px;
    border-radius: 3px;
    border: 1px solid rgba(255, 255, 255, 0.5);
    z-index: 10;
}

/* ===== الخلايا TP (علوم أو فيزياء) ===== */
td.slot.tp {
    background: linear-gradient(135deg, #3708e3, #061fc1) !important;
    color: hsl(0, 38%, 97%) !important;
    border-right-color: #1a8a82 !important;
    position: relative;
}

td.slot.tp::before {
    content: "TP";
    position: absolute;
    top: 1px;
    left: 2px;
    font-size: 13px;
    font-weight: bold;
    color: #fff;
    background: rgba(0, 0, 0, 0.3);
    padding: 1px 2px;
    border-radius: 3px;
    border: 1px solid rgba(255, 255, 255, 0.5);
    z-index: 10;
}

/* ===== الخلايا المدمجة ===== */
td.slot.merged {
    position: relative;
}

td.slot.merged-hidden {
    display: none;
}

/* ===== الخلايا TD المدمجة ===== */
td.slot.conflict.merged-td {
    background: linear-gradient(135deg, #1a1a1a, #000000) !important;
    color: #fff !important;
    border-right-color: #333 !important;
}

/* ===== استقبال ===== */
td.slot.reception {
    background-color: #13eb0c;
    color: #060400;
    border-right-color: #73e71b;
}

/* ===== صف القاعات الشاغرة ===== */
tr.free-row td {
    background: linear-gradient(135deg, var(--free), var(--free-2));
    color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, .22), inset 0 1px 0 rgba(255, 255, 255, .25);
    text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
}

tr.free-row td:first-child {
    background: linear-gradient(135deg, var(--gold), #d38f0f);
    color: #3a2600;
    text-shadow: none;
}

</style>
</head>


<body>

<!-- جدول عرض بيانات الأساتذة -->

    <table id="scheduleTable" >
            <thead >
            <tr>
            <th colspan=10 style="font-size: 36px;">الأحد</th>
            </tr>
                <tr>
                <th style='width:90px; '>الاستاذ</th>
                 <th style='width:90px;display: none;'>المادة</th>
                    <th style='width:80px;'>08:00-09:00</th>
                    <th style='width:80px;'>09:00-10:00</th>
                    <th style='width:80px;'>10:00-11:00</th>
                    <th style='width:80px;'>11:00-12:00</th>
                    <th style='width:80px;'>13:30-14:30</th>
                    <th style='width:80px;'>14:30-15:30</th>
                    <th style='width:80px;'>15:30-16:30</th>
                    <th style='width:80px;'>16:30-17:30</th>
                </tr>
            </thead>
            <tbody>
            <?php

// قم بتوصيل قاعدة البيانات
$database_file = './databasse3.db';
$connection = new PDO("sqlite:$database_file");
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// استعلام لاسترجاع بيانات الأساتذة لليوم المحدد
$sql = "SELECT * FROM prof WHERE jour = 'الإثنين'";
$result = $connection->query($sql);
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $matiere = $row['matiere'];
        echo "<tr>
                <td class='prof'>{$row['nome']}</td>
                <td style='display: none;'>{$matiere}</td>
                <td class='slot' data-matter='{$matiere}'>{$row['se1']}</td>
                <td class='slot' data-matter='{$matiere}'>{$row['se2']}</td>
                <td class='slot' data-matter='{$matiere}'>{$row['s3']}</td>
                <td class='slot' data-matter='{$matiere}'>{$row['s4']}</td>
                <td class='slot' data-matter='{$matiere}'>{$row['s5']}</td>
                <td class='slot' data-matter='{$matiere}'>{$row['s6']}</td>
                <td class='slot' data-matter='{$matiere}'>{$row['s7']}</td>
                <td class='slot' data-matter='{$matiere}'>{$row['s8']}</td>
              </tr>";
    }

    // إغلاق الاتصال بقاعدة البيانات
    $connection = null;
?>

     </tbody>
     </table>


<script src="j/j.min.js"></script>

<script>
$(document).ready(function(){
    let predefinedValues = new Set(["ق1", "ق2", "ق3", "ق4", "ق5", "ق6", "ق7", "ق8", "ق9", "ق10", "ق11", "ق12", "ق13", "ق14", "و1", "و2", "مك", "م1", "م2"]);

    let classSets = Array.from({ length: 8 }, () => new Set());

    $("#scheduleTable tbody tr").each(function(){
        $(this).find("td").each(function(index){
            if (index > 0 && index <= 8) {
                let cellValue = $(this).text().trim();

                if (cellValue.length >= 3) {
                    let shortValue = cellValue.includes("_") ? cellValue.split("_")[1] : cellValue.substring(3);
                    classSets[index - 1].add(shortValue);
                }
            }
        });
    });

    classSets.forEach((set, index) => {
        let missingValues = [...predefinedValues].filter(value => !set.has(value));
        $(`#dev${index + 1}`).text(missingValues.join(" - "));
    });
});
</script>

<script>
/* ===== تلوين الصفوف حسب المجموعات =====
   from = أول صف (يبدأ من 0)، to = آخر صف (غير شامل)
   strong/dark = تدرج خلية الأستاذ، soft = خلفية الحصص، txt = لون نص الأستاذ */
$(document).ready(function(){
    const groups = [
        { from: 0,  to: 4,  strong: "#22a06b", dark: "#146c47", soft: "#dcf5e8", txt: "#fff" },    // أخضر
        { from: 4,  to: 9,  strong: "#f5b02e", dark: "#d18a0a", soft: "#fff3d1", txt: "#3a2600" }, // ذهبي
        { from: 9,  to: 11, strong: "#3b7ddd", dark: "#234f9e", soft: "#dfeafc", txt: "#fff" },    // أزرق
        { from: 11, to: 12, strong: "#8e5bd0", dark: "#613a9c", soft: "#eee3fb", txt: "#fff" },    // بنفسجي
        { from: 12, to: 15, strong: "#e5533d", dark: "#a8341f", soft: "#fde1dc", txt: "#fff" },    // مرجاني
        { from: 15, to: 21, strong: "#e0447f", dark: "#a2285a", soft: "#fde0ec", txt: "#fff" },    // وردي
        { from: 21, to: 28, strong: "#1296ad", dark: "#0a6477", soft: "#d8f1f6", txt: "#fff" },    // فيروزي
        { from: 28, to: 32, strong: "#a9713a", dark: "#774a22", soft: "#f3e5d4", txt: "#fff" },    // بني
        { from: 32, to: 38, strong: "#e8742c", dark: "#b2501a", soft: "#fde5d3", txt: "#fff" },    // برتقالي
        { from: 38, to: 42, strong: "#7cc13a", dark: "#559424", soft: "#e8f5d2", txt: "#1f3300" }  // ليموني
    ];

    $("#scheduleTable tbody tr").each(function(index){
        const g = groups.find(g => index >= g.from && index < g.to);
        if (g) {
            this.style.setProperty("--strong", g.strong);
            this.style.setProperty("--dark", g.dark);
            this.style.setProperty("--soft", g.soft);
            this.style.setProperty("--txt", g.txt);
        }
    });

    // خلايا الاستقبال بلون رمادي
    $("td.slot").each(function(){
        if ($(this).text().trim() === "استقبال") {
            $(this).addClass("reception");
        }
    });

    /* ===== دوال مساعدة ===== */

    // هل المادة علوم أو فيزياء؟
    function isSciSubject(s) {
        s = s || "";
        return s.includes("علوم") || s.includes("العلوم") ||
               s.includes("فيزياء") || s.includes("الفيزياء") ||
               s.includes("فيز");
    }

    // استخراج اسم القسم (الجزء قبل "_") مع إزالة كل المسافات
    function getClassName(cellValue) {
        if (!cellValue || cellValue.length < 3) return "";
        let name = cellValue.includes("_") ? cellValue.split("_")[0] : cellValue;
        return name.replace(/\s+/g, "");
    }

    // هل الخلية فارغة أو غير معنية؟
    function isIgnoredValue(v) {
        return v.length < 3 || v === "استقبال" || v === "لايوجد";
    }

    /* ===== كشف التضاربات: نفس القسم في نفس الحصة ===== */
    let slotColumns = Array.from({ length: 8 }, () => []);

    $("#scheduleTable tbody tr").each(function(){
        $(this).find("td.slot").each(function(index){
            if (index < 8) {
                slotColumns[index].push($(this));
            }
        });
    });

    slotColumns.forEach(function(columnCells){
        let classMap = {};
        let classData = {};

        columnCells.forEach(function(cell){
            let cellValue = cell.text().trim();
            let subjectName = cell.attr("data-matter") || "";

            if (isIgnoredValue(cellValue)) return;

            let className = getClassName(cellValue);
            if (className.length < 1) return;

            if (classMap[className]) {
                classMap[className].push(cell);
                classData[className].push(subjectName);
            } else {
                classMap[className] = [cell];
                classData[className] = [subjectName];
            }
        });

        for (let className in classMap) {
            if (classMap[className].length > 1) {
                let subjects = classData[className];
                let hasScience = subjects.some(isSciSubject);

                classMap[className].forEach(function(cell, index){
                    if (hasScience && isSciSubject(subjects[index])) {
                        cell.addClass("tp");
                    } else {
                        cell.addClass("conflict");
                    }
                });
            }
        }
    });

    /* ===== دمج الخلايا المتجاورة (0-1, 2-3, 4-5, 6-7) ===== */
    $("#scheduleTable tbody tr").each(function(){
        let rowCells = [];

        $(this).find("td.slot").each(function(index){
            let cell = $(this);
            let cellValue = cell.text().trim();

            rowCells.push({
                cell: cell,
                index: index,
                isTD: cell.hasClass("conflict"),
                isTP: cell.hasClass("tp"),
                isSci: isSciSubject(cell.attr("data-matter") || ""),
                className: getClassName(cellValue),
                value: cellValue
            });
        });

        for (let i = 0; i < rowCells.length - 1; i++) {
            let current = rowCells[i];
            let next = rowCells[i + 1];

            // فقط الأزواج المتجاورة
            let isAdjacentPair = (i === 0) || (i === 2) || (i === 4) || (i === 6);
            if (!isAdjacentPair) continue;

            // لا دمج إذا كان أحد القسمين فارغاً
            if (current.className === "" || current.className !== next.className) continue;

            // ===== دمج TP =====
            // نفس القسم + مادة علوم/فيزياء في الحصتين + إحدى الخليتين على الأقل موسومة TP
            // (لم نعد نشترط أن تكون الخليتان معاً TP لأن الكشف يتم لكل عمود على حدة)
            if (current.isSci && next.isSci && (current.isTP || next.isTP)) {
                current.cell.attr("colspan", "2").addClass("merged tp");

                // إذا اختلف النص (مثلاً قاعة مختلفة) نعرض القيمتين معاً
                if (next.value !== current.value && next.value !== "") {
                    current.cell.append("<br>").append(document.createTextNode(next.value));
                }

                next.cell.addClass("merged-hidden");
            }
            // ===== دمج TD فقط للأقسام 4م =====
            else if (current.isTD && next.isTD && current.className.includes("4م")) {
                current.cell.attr("colspan", "2").addClass("merged merged-td");
                next.cell.addClass("merged-hidden");
            }
        }
    });
});
</script>

</body>
</html>