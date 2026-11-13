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


@media print {
    @page {
        size: A4;
        margin: 0.5cm;
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
    color: #000;
    background: #e0e0e0;
    font-family: hacen, Tahoma, "Segoe UI", sans-serif;
    padding: 2px;
}

/* ===== الجدول كبطاقة ===== */
table {
    width: 100%;
    direction: rtl;
    text-align: center;
    font-size: 17px;
    font-weight: bold;
    border-collapse: separate;
    border-spacing: 4px;
    background: #ffffff;
    border: 0;
    border-radius: 18px;
    box-shadow: 0 8px 24px rgba(14, 42, 77, .15);
    margin-bottom: 10px;
}

th, td {
    text-align: center;
    padding: 2px;
    border: 1.5px solid black;
    border-radius: var(--radius);
}

tr {
    height: 69px;
}

/* ===== العناوين ===== */
th {
    background: linear-gradient(160deg, #333, #000) !important;
    color: #fff;
    border: 1.5px solid black;
    text-shadow: 0 1px 2px rgba(0, 0, 0, .3);
}

/* شريط العنوان الرئيسي */
thead tr:first-child th {
    background: linear-gradient(100deg, #000 0%, #333 60%, #000 100%) !important;
    border-radius: 14px;
    box-shadow: inset 0 -4px 0 #666;
    letter-spacing: 1px;
}

/* ===== خلية الأستاذ ===== */
td.prof {
    background: linear-gradient(135deg, #000, #000);
    color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, .25), inset 0 1px 0 rgba(255, 255, 255, .25);
    text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
}

/* ===== خلايا الحصص ===== */
td.slot {
    background-color: #f5f5f5;
    color: #000;
    border-right: 10px solid #444;
    box-shadow: inset 0 0 0 1px rgba(0, 0, 0, .06);
}

/* ===== الخلايا الفارغة: خطوط مائلة ناعمة ===== */
td.slot:empty {
    border-right-color: transparent;
    background-image: repeating-linear-gradient(
        45deg,
        rgba(0, 0, 0, 0.15) 0px,
        rgba(255, 255, 255, .9) 2px,
        transparent 2px,
        transparent 8px
    );
}

/* ===== الخلايا المتضاربة ===== */
td.slot.conflict {
    background: linear-gradient(135deg, #000, #000) !important;
    color: #fff !important;
    border-right-color: #000 !important;
    position: relative;
}

td.slot.conflict::before {
    content: "TD";
    position: absolute;
    top: 1px;
    left: 2px;
    font-size: 11px;
    font-weight: bold;
    color: #fff;
    background: rgba(0, 0, 0, 0.3);
    padding: 1px 2px;
    border-radius: 3px;
    border: 1px solid rgba(255, 255, 255, 0.5);
    z-index: 10;
}

/* ===== الخلايا TP (علوم أو فيزياء) ===== */
td.slot.tp {
    background: linear-gradient(135deg, #000, #000) !important;
    color: #fff !important;
    border-right-color: #000 !important;
    position: relative;
}

td.slot.tp::before {
    content: "TP";
    position: absolute;
    top: 1px;
    left: 2px;
    font-size: 11px;
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
    background: linear-gradient(135deg, #000, #000) !important;
    color: #fff !important;
    border-right-color: #000 !important;
}

/* ===== استقبال ===== */
td.slot.reception {
    background-color: #e0e0e0;
    color: #000;
    border-right-color: #666;
}

/* ===== صف القاعات الشاغرة ===== */
tr.free-row td {
    background: linear-gradient(135deg, #666, #444);
    color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, .22), inset 0 1px 0 rgba(255, 255, 255, .25);
    text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
}

tr.free-row td:first-child {
    background: linear-gradient(135deg, #333, #000);
    color: #fff;
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
$sql = "SELECT * FROM prof WHERE jour = 'الأحد'";
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

     <table >
           
            <tbody>
        
                <tr>
        <td style="width:90px;">عدد الحصص</td>
        <td id="count1" style="width:80px;">0</td>
        <td id="count2" style="width:80px;">0</td>
        <td id="count3" style="width:80px;">0</td>
        <td id="count4" style="width:80px;">0</td>
        <td id="count5" style="width:80px;">0</td>
        <td id="count6" style="width:80px;">0</td>
        <td id="count7" style="width:80px;">0</td>
        <td id="count8" style="width:80px;">0</td>
                </tr>
        </tbody>
</table>
<script src="j/j.min.js"></script>

<script>
/* ===== تلوين الصفوف حسب المجموعات =====
   from = أول صف (يبدأ من 0)، to = آخر صف (غير شامل)
   strong/dark = تدرج خلية الأستاذ، soft = خلفية الحصص، txt = لون نص الأستاذ */
$(document).ready(function(){
    /* ===== حساب القاعات الشاغرة وعدد الحصص قبل أي تعديلات ===== */
    let predefinedValues = new Set(["ق1", "ق2", "ق3", "ق4", "ق5", "ق6", "ق7", "ق8", "ق9", "ق10", "ق11", "ق12", "ق13", "ق14", "و1", "و2", "مك", "م1", "م2"]);
    let classSets = Array.from({ length: 8 }, () => new Set());
    let slotSets = Array.from({ length: 8 }, () => new Set());

    $("#scheduleTable tbody tr").each(function(){
        $(this).find("td").each(function(index){
            if (index > 1 && index <= 9) {
                let cellValue = $(this).text().trim();
                if (cellValue.length >= 3) {
                    let shortValue = cellValue.includes("_") ? cellValue.split("_")[1] : cellValue.substring(3);
                    classSets[index - 2].add(shortValue);
                    slotSets[index - 2].add(cellValue);
                }
            }
        });
    });

    classSets.forEach((set, index) => {
        let missingValues = [...predefinedValues].filter(value => !set.has(value));
        $(`#dev${index + 1}`).text(missingValues.join(" - "));
    });

    for (let i = 0; i < slotSets.length; i++) {
        $(`#count${i + 1}`).text(slotSets[i].size);
    }

    const groups = [
        { from: 0,  to: 4,  strong: "#444", dark: "#222", soft: "#f0f0f0", txt: "#fff" },
        { from: 4,  to: 9,  strong: "#555", dark: "#333", soft: "#e8e8e8", txt: "#fff" },
        { from: 9,  to: 11, strong: "#666", dark: "#444", soft: "#e0e0e0", txt: "#fff" },
        { from: 11, to: 12, strong: "#777", dark: "#555", soft: "#d8d8d8", txt: "#fff" },
        { from: 12, to: 15, strong: "#888", dark: "#666", soft: "#d0d0d0", txt: "#fff" },
        { from: 15, to: 21, strong: "#555", dark: "#333", soft: "#e5e5e5", txt: "#fff" },
        { from: 21, to: 28, strong: "#666", dark: "#444", soft: "#e0e0e0", txt: "#fff" },
        { from: 28, to: 32, strong: "#777", dark: "#555", soft: "#d8d8d8", txt: "#fff" },
        { from: 32, to: 38, strong: "#888", dark: "#666", soft: "#d0d0d0", txt: "#fff" },
        { from: 38, to: 42, strong: "#999", dark: "#777", soft: "#c8c8c8", txt: "#fff" }
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