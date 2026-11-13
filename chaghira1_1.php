<!DOCTYPE html>
<html lang="en">
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
  @media print {
    @page {
        size: A4;
        margin: 0cm;
    }

    body {
        margin: 0.2cm;
    }
    
    thead {
    display: table-row-group !important; /* يمنع تكرار الرأس */
  }
    
}









        
  body{
    //font-family: hacen;

    display: block;

}




        
table  {
            border:2px solid black;
 text-align: center;
    padding: none;
    border-collapse: collapse;
    font-size: 23px;
width:100%;
font-weight: bold;
    direction: rtl;
   
   
}


th,  td {
    border:2px solid black;
 text-align: center;

 padding: 2px;

}

tr {
    height: 58px; /* قيمة الارتفاع التي تناسب احتياجاتك */
}
td:empty {
    position: relative;
}

td:empty::after  {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: repeating-linear-gradient(
        45deg, 
        white 0px, 
        white 2px, 
        transparent 2px, 
        transparent 6px
    );
    opacity: 0.9; /* شفافية لإظهار اللون الأساسي */
    pointer-events: none; /* لتجنب التأثير على التفاعل مع الجدول */
}


th {
    background-color: #003884 !important;
    color:white;
    border: 2px solid white;
}

 </style>
</head>


<body>

    




<!-- جدول عرض بيانات الطلاب حسب الفئة المختارة -->

    
    <table id="scheduleTable" >
            <thead >
            <tr>
            <th colspan=9 style="font-size: 36px;">الأحد</th>
       

            </tr>
                <tr>
                <th style='width:90px; '>الاستاذ</th>
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
// استعلام لاسترجاع بيانات الطلاب للفئة المحددة
$sql = "SELECT * FROM prof WHERE jour = 'الأحد'";
$result = $connection->query($sql);
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr style=';'>
                <td style='background-color: #000099 !important;color:white;border: 2px solid white;'>{$row['nome']}</td>
                <td>{$row['se1']}</td>
                <td>{$row['se2']}</td>
                <td>{$row['s3']}</td>
                <td>{$row['s4']}</td>
                <td>{$row['s5']}</td>
                <td>{$row['s6']}</td>
                <td>{$row['s7']}</td>
                <td>{$row['s8']}</td>

              </tr>";
    }
    
  
    
    // إغلاق الاتصال بقاعدة البيانات
    $connection = null;
?>



 
     </tbody>
     </table> 

     <table >
            <thead >
            <tr>
            <th colspan=9 style="font-size: 36px;">القاعات الشاعرة ليوم الأحد</th>
       

            </tr>
                <tr>
                <th style='width:90px; '>اليوم</th>
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
                <tr style='background-color:#C70039 !important;color:white;border: 2px solid white;'>
        <td>الشاغرة</td>
        <td id="dev1">ق6</td>
        <td id="dev2">ق7</td>
        <td id="dev3">ق8</td>
        <td id="dev4">ق11</td>
        <td id="dev5">لايوجد</td>
        <td id="dev6">ق3</td>
        <td id="dev7">ق3</td>
        <td id="dev8">ق3</td>


                </tr>
               <!-- <tr style='background-color:#009860 !important;color:white;border: 2px solid white;'>
        <td>المستعملة</td>
        <td id="d1">ق6</td>
        <td id="d2">ق7</td>
        <td id="d3">ق8</td>
        <td id="d4">ق11</td>
        <td id="d5">لايوجد</td>
        <td id="d6">ق3</td>
        <td id="d7">ق3</td>
        <td id="d8">ق3</td>


                </tr> -->
        
        
        </tbody>


</table>
<script src="j/j.min.js"></script>


  




<script>
$(document).ready(function(){
    let predefinedValues = new Set(["ق1", "ق2", "ق3", "ق4", "ق5", "ق6", "ق7", "ق8", "ق9", "ق10", "ق11", "ق12", "ق13", "ق14", "و1", "و2", "مك", "م1", "م2"]);

    let classSets = Array.from({ length: 8 }, () => new Set()); // إنشاء 7 مجموعات لتخزين القيم لكل عمود

    $("#scheduleTable tbody tr").each(function(){
        $(this).find("td").each(function(index){
            if (index > 0 && index <= 8) { // الأعمدة من 2 إلى 8
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
$(document).ready(function(){
    let predefinedValues = ["ق1", "ق2", "ق3", "ق4", "ق5", "ق6", "ق7", "ق8", "ق9", "ق10", "ق11", "ق12", "ق13", "ق14", "و1", "و2", "مك", "م1", "م2"];

    // إنشاء مصفوفة لتخزين جميع القيم التي تم العثور عليها لكل عمود
    let classValues = Array.from({ length: 8 }, () => []);

    // استهداف جميع الصفوف وأخذ القيم من الأعمدة 2 إلى 8
    $("#scheduleTable tbody tr").each(function(){
        $(this).find("td").each(function(index){
            if (index > 0 && index <= 8) { // الأعمدة من 2 إلى 8
                let cellValue = $(this).text().trim();
                
                if (cellValue.length >= 3) { 
                    let shortValue = cellValue.includes("_") ? cellValue.split("_")[1] : cellValue.substring(3);
                    
                    // استثناء كلمة "قبال" من التخزين
                    if (shortValue !== "قبال") {
                        classValues[index - 1].push(shortValue); 
                    }
                }
            }
        });
    });

    // ترتيب وعرض القيم لكل عمود في div المناسب
    classValues.forEach((values, index) => {
        values.sort(); // ترتيب القيم تصاعديًا
        $(`#d${index + 1}`).text(values.join(" - "));
    });
});

</script>





<script>
$(document).ready(function(){
    $("#scheduleTable tbody tr").each(function(index){
        if (index < 4) { // الصفوف 1 و 2 و 3 → أخضر
            $(this).find("td").css({
                "background-color": "green",
                "color": "black"
            });
        } else if (index >= 4 && index < 9) { // الصفوف 4 و 5 و 6 و 7 و 8 → أصفر
            $(this).find("td").css({
                "background-color": "yellow",
                "color": "black"
            });
        } else if (index >= 9 && index < 11) { // الصفوف 9 و 10 و 11 → أزرق
            $(this).find("td").css({
                "background-color": "blue",
                "color": "white"
            });
        } else if (index >= 11 && index < 12) { // الصفوف 12 و 13 و 14 و 15 و 16 → بنفسجي
            $(this).find("td").css({
                "background-color": "purple",
                "color": "white"
            });
        }
        else if (index >= 12 && index <15) { // الصفوف 12 و 13 و 14 و 15 و 16 → بنفسجي
            $(this).find("td").css({
                "background-color": "#ff0000",
                "color": "white"
            });
        }
        else if (index >= 15 && index < 21) { // الصفوف 12 و 13 و 14 و 15 و 16 → بنفسجي
            $(this).find("td").css({
                "background-color": "#ff0066",
                "color": "white"
            });
        }
        else if (index >= 21 && index < 28) { // الصفوف 12 و 13 و 14 و 15 و 16 → بنفسجي
            $(this).find("td").css({
                "background-color": "#008fb3",
                "color": "black"
            });
        }
        else if (index >= 28 && index < 32) { // الصفوف 12 و 13 و 14 و 15 و 16 → بنفسجي
            $(this).find("td").css({
                "background-color": "#996633",
                "color": "black"
            });
        }
        else if (index >= 32 && index < 38) { // الصفوف 12 و 13 و 14 و 15 و 16 → بنفسجي
            $(this).find("td").css({
                "background-color": "#cc3300",
                "color": "white"
            });
        }
          else if (index >= 38 && index < 42) { // الصفوف 12 و 13 و 14 و 15 و 16 → بنفسجي
            $(this).find("td").css({
                "background-color": "#0dd048",
                "color": "black"
            });
        }
    });
});

</script>
<script>
$(document).ready(function(){
    $("td").each(function(){
        if ($(this).text().trim() === "استقبال") {
            $(this).css("background-color", "#d3d3d3").css("color", "");
        }
    });
}); 
</script>

</body>
</html>