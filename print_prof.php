<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet">


    

    <title>Document</title>
<style>

@font-face {
    font-family: hacen;
    src: url(a.ttf);
  }
  @media print {
            /* تعيين حجم الورق إلى A4 */
            @page {
                size: A4 landscape;
                margin: 0; /* إزالة هوامش الطباعة الافتراضية */
            }

            /* إضافة هوامش خاصة بنا إذا كنا بحاجة إليها */
            body {
                margin: 0.6cm;
   
            }
        }
  body{
font-family: hacen;
color:black solid;
    display: block;

}



        
table  {
            border:1.5px solid black;
 text-align: center;
    padding: none;
    border-collapse: collapse;
    font-size: 19px;
width:100%;
font-weight: bold;
    direction: rtl;
   
   
}


th,  td {
    border: 3px double black;
     text-align: center;


}

tr {
    height: 50px; /* قيمة الارتفاع التي تناسب احتياجاتك */
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

.b1{

 text-align: center;
    padding: none;
   line-height: 0.8;
}
.b2{

text-align: right;
   padding: none;
   line-height: 0.8;

}

 </style>
</head>
<body>

<h4 class="b1">الجمهورية الجزائرية الديمقراطية الشعبية</h2>
    <h4 class="b1">وزارة التربية الوطنية</h3>
    <h4 class="b2">مديرية التربية لولاية معسكر</h3>
    <h4  class="b2">  متوسطة مبرك العربي 500 سكن المحمدية   </h3>
    




<!-- جدول عرض بيانات الطلاب حسب الفئة المختارة -->
<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_class = $_POST['class'];
    // قم بتوصيل قاعدة البيانات
    $database_file = './databasse3.db';
    $connection = new PDO("sqlite:$database_file");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    // استعلام لاسترجاع بيانات الطلاب للفئة المحددة
    $sql = "SELECT * FROM prof WHERE nome = :class ";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':class', $selected_class);
    $stmt->execute();
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // عرض بيانات الطلاب
    if ($students) {
       
        echo "<br>";

        echo "<h2 class='b1';>جدول الحصص برسم الموسم الدراسي 2026/2025</h1></h1><br>";
        echo "<h4 class='b1'>الاستاذ(ة) : $selected_class - استاذ(ة) مادة : {$students[0]['matiere']}</h3><br>";


        echo "<table  id='scheduleTable'>
                <thead>
                    <tr>
                    <th style='width:60px;'>الايام</th>
                    <th style='width:80px;'>08:00 09:00</th>
                    <th style='width:80px;'>09:00 10:00</th>
                    <th style='width:80px;'>10:00 11:00</th>
                    <th style='width:80px;'>11:00 12:00</th>
                    <th style='width:80px;'>13:30 14:30</th>
                    <th style='width:80px;'>14:30 15:30</th>
                    <th style='width:80px;'>15:30 16:30</th>
                    <th style='width:80px;'>16:30 17:30</th>
                    </tr>
                </thead>
                <tbody>";

        foreach ($students as $student) {
            echo "<tr>
                     <td>{$student['jour']}</td>
                    <td>{$student['se1']}</td>
                    <td>{$student['se2']}</td>
                    <td>{$student['s3']}</td>
                    <td>{$student['s4']}</td>
                    <td>{$student['s5']}</td>
                    <td>{$student['s6']}</td>
                     <td>{$student['s7']}</td>
                     <td>{$student['s8']}</td>
                 
                  </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p>لا توجد   الفئة.</p>";
    }

    // إغلاق الاتصال بقاعدة البيانات
    $connection = null;
    echo "<br>";
    echo "<div id='classesContainer' style='font-size:21px; text-align: center;border:2px black solid;'></div>";

}


?>
<br>
<h4 class='b7'>2025-10-15: حرر بالمحمدية يوم </h2>
<br>
<h3 class='b1'>امضاء المديرة</h2>


 
     </tbody>
     </table> 



     <script src="j/j.min.js"></script>



<script>
$(document).ready(function(){
    let classSet = new Set();

    // استهداف جميع الصفوف مع استثناء العمود الأول (الأيام)
    $("#scheduleTable tbody tr").each(function(){
        $(this).find("td:not(:first)").each(function(){ 
            let cellValue = $(this).text().trim();
            
            // التحقق مما إذا كانت القيمة تبدأ برقم فقط
            if (cellValue.length > 0 && !isNaN(cellValue.charAt(0))) { 
                let shortValue = cellValue.substring(0, 3); // أخذ أول 4 أحرف فقط
                classSet.add(shortValue); // منع التكرار
            }
        });
    });

    // تحويل القيم إلى نص مفصول بـ "-"
    let sortedClasses = Array.from(classSet).sort(); // ترتيب القيم
    let formattedClasses = sortedClasses.join(" - "); // دمجها مع "-"

    // عرض النتيجة مع "الأقسام المسندة: "
    $("#classesContainer").text("الأقسام المسندة: " + formattedClasses);
});
</script>




 
    
</body>
</html>