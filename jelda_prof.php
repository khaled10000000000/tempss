<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet">


    

    <title>الاحد </title>
<style>

@font-face {
    font-family: hacen;
    src: url(hacen.ttf);
  }
  @media print {
    @page {
        size: A3;
        margin: 0cm;
    }

    body {
        margin: 0.2cm;
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
    font-size: 20px;
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
    height: 40px; /* قيمة الارتفاع التي تناسب احتياجاتك */
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

<?php
            include('db.php'); 
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $selected_class = $_POST['jour'];

}

?>

<!-- جدول عرض بيانات الطلاب حسب الفئة المختارة -->

    
    <table >
            <thead >
            <tr>
            <th colspan=9 style="font-size: 38px;"><?php echo $selected_class; ?></th>
       

            </tr>
                <tr>
                <th style='width:80px;'>الاستاذ</th>
                    <th style='width:80px;'>الحصة01</th>
                    <th style='width:80px;'>الحصة02</th>
                    <th style='width:80px;'>الحصة03</th>
                    <th style='width:80px;'>الحصة04</th>
                    <th style='width:80px;'>الحصة05</th>
                    <th style='width:80px;'>الحصة06</th>
                    <th style='width:80px;'>الحصة07</th>
                    <th style='width:80px;'>الحصة08</th>



                </tr>
            </thead>
            <tbody>

 
            <?php
            include('db.php'); 

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $selected_class = $_POST['jour'];

// استعلام لاسترجاع بيانات الطلاب للفئة المحددة
$sql = "
SELECT * FROM prof
WHERE jour = '$selected_class'
AND (
    COALESCE(TRIM(se1), '') != '' OR
    COALESCE(TRIM(se2), '') != '' OR
    COALESCE(TRIM(s3),  '') != '' OR
    COALESCE(TRIM(s4),  '') != '' OR
    COALESCE(TRIM(s5),  '') != '' OR
    COALESCE(TRIM(s6),  '') != '' OR
    COALESCE(TRIM(s7),  '') != '' OR
    COALESCE(TRIM(s8),  '') != ''
)";

$result = $connection->query($sql);
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr style=';'>
                        <td>{$row['nome']}</td>
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
    
}
    
    // إغلاق الاتصال بقاعدة البيانات
    $connection = null;
?>



 
     </tbody>
     </table> 






     <script>
    document.addEventListener("DOMContentLoaded", function () {
        let theads = document.querySelectorAll("thead");
        theads.forEach((thead, index) => {
            if (index > 0) {
                thead.classList.add("hidden-header"); // يضيف الكلاس لإخفاء العناوين بعد الصفحة الأولى
            }
        });
    });
</script>






 
    
</body>
</html>