<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet">


    

    <title>الأربعاء </title>
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
        display: table-row-group; 
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
    height: 57px; /* قيمة الارتفاع التي تناسب احتياجاتك */
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


th {
    background-color: #212121 !important;
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
            <th colspan=8 style="font-size: 36px;">الأربعاء</th>
       

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
                </tr>
            </thead>
            <tbody>
            <?php

// قم بتوصيل قاعدة البيانات
$database_file = './databasse3.db';
$connection = new PDO("sqlite:$database_file");
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// استعلام لاسترجاع بيانات الطلاب للفئة المحددة
$sql = "SELECT * FROM prof WHERE jour = 'الأربعاء'";
$result = $connection->query($sql);
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr style=';'>
                <td style='background-color: #212121 !important;color:white;border: 2px solid white;'>{$row['nome']}</td>
                <td>{$row['se1']}</td>
                <td>{$row['se2']}</td>
                <td>{$row['s3']}</td>
                <td>{$row['s4']}</td>
                <td>{$row['s5']}</td>
                <td>{$row['s6']}</td>
                <td>{$row['s7']}</td>


              </tr>";
    }
    
  
    
    // إغلاق الاتصال بقاعدة البيانات
    $connection = null;
?>



 
     </tbody>
     </table> 

     <table > 
        <thead>
     <tr style='display:none;'>
                <th style='width:70px; '>الاستاذ</th>
                    <th style='width:80px;'>08:00-09:00</th>
                    <th style='width:80px;'>09:00-10:00</th>
                    <th style='width:80px;'>10:00-11:00</th>
                    <th style='width:80px;'>11:00-12:00</th>
                    <th style='width:80px;'>13:30-14:30</th>
                    <th style='width:80px;'>14:30-15:30</th>
                    <th style='width:80px;'>15:30-16:30</th>
                </tr>

                </thead>
            <tbody>
        
                <tr >
        <td style='width:70px; '>الشاغرة</td>
        <td id="dev1" style='width:80px;'>ق6</td>
        <td id="dev2" style='width:80px;'>ق7</td>
        <td id="dev3" style='width:80px;'>ق8</td>
        <td id="dev4" style='width:80px;'>ق11</td>
        <td id="dev5" style='width:80px;'>لايوجد</td>
        <td id="dev6" style='width:80px;'>ق3</td>
        <td id="dev" style='width:80px;'>ق3</td>


                </tr>
        
  
        
        </tbody>


</table>
<script src="j/j.min.js"></script>


  




<script>
$(document).ready(function(){
    let predefinedValues = new Set(["ق1", "ق2", "ق3", "ق4", "ق5", "ق6", "ق7", "ق8", "ق9", "ق10", "ق11", "ق12", "ق13", "ق14", "و1", "و2", "مك", "م1", "م2"]);

    // إنشاء 7 مجموعات لتخزين القيم لكل عمود
    let classSets = [new Set(), new Set(), new Set(), new Set(), new Set(), new Set(), new Set()];

    // استهداف جميع الصفوف وأخذ القيم من الأعمدة 2 إلى 8
    $("#scheduleTable tbody tr").each(function(){
        for (let i = 0; i < 7; i++) { // التعامل مع الأعمدة السبعة
            let cellValue = $(this).find(`td:eq(${i + 1})`).text().trim(); // يأخذ القيمة من كل عمود
            
            if (cellValue.length >= 4) { // التأكد من أن هناك 4 أحرف على الأقل
                let shortValue = cellValue.includes("_") ? cellValue.split("_")[1] : cellValue.substring(3);
                classSets[i].add(shortValue); // تخزين القيم الفعلية لكل عمود
            }
        }
    });

    // البحث عن القيم غير الموجودة لكل عمود وعرضها في `div` مختلف
    for (let i = 0; i < 7; i++) {
        let missingFromColumn = Array.from(predefinedValues).filter(value => !classSets[i].has(value));
        $(`#dev${i + 1}`).text(missingFromColumn.join(" - ")); // عرض القيم غير الموجودة لكل عمود في div مناسب
    }
});
</script>

<script>
$(document).ready(function(){
    let predefinedValues = ["ق1", "ق2", "ق3", "ق4", "ق5", "ق6", "ق7", "ق8", "ق9", "ق10", "ق11", "ق12", "ق13", "ق14", "و1", "و2", "مك", "م1", "م2"];

    // إنشاء مصفوفة لتخزين جميع القيم التي تم العثور عليها لكل عمود
    let classValues = Array.from({ length: 7 }, () => []);

    // استهداف جميع الصفوف وأخذ القيم من الأعمدة 2 إلى 8
    $("#scheduleTable tbody tr").each(function(){
        $(this).find("td").each(function(index){
            if (index > 0 && index <= 7) { // الأعمدة من 2 إلى 8
                let cellValue = $(this).text().trim();
                
                if (cellValue.length >= 4) { 
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
    $("td").each(function(){
        if ($(this).text().trim() === "استقبال") {
            $(this).css("background-color", "#d3d3d3").css("color", "");
        }
    });
});


</script>


 
    
</body>
</html>