<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>
<style>
    @keyframes spin {
      100% { transform: rotate(360deg); }
    }

    body {
        font-family: ManaraDocs;
    }

    table {
        font: 14px Arial;
        font-weight: bold;
        direction: rtl;
        counter-reset: rowNumber;
    }

    table, th {
        border: 1px solid black;
        text-align: center;
    }
    table, td {
        border: 1px solid black;
        text-align: center;
        padding: none;
    }

    #searchInput {
        border: 3px solid black;
        text-align: center;
        width: 70%;
    }
    .b1 {
        background-color:#0f66df;
        padding: 5px;
        border-radius: 10px;
        width: 45px;
        cursor: pointer;
    }
    .b2 {
        background-color:#cf9717;
        padding: 5px;
        border-radius: 10px;
        width: 45px;
    }
    .b3 {
        background-color:#03a737;
        padding: 5px;
        width: 45px;
        border-radius: 10px;
        cursor: pointer;
    }
    .b4 {
        background-color:#e3340f;
        padding: 5px;
        border-radius: 10px;
        width: 45px;
    }
    .b5 {
        background-color:#e3340f;
        padding: 5px;
        border-radius: 10px;
        width: 45px;
        cursor: pointer;
    }
    .b6 {
        background-color:#Fc040a;
        padding: 5px;
        border-radius: 10px;
        width: 45px;
        cursor: pointer;
    }
    button:hover {
        background-color:#050101;
    }
    a {
        color:white;
    }
    .b7 {
        background-color:#Fc040a;
        padding: 5px;
        border-radius: 10px;
        width: 150px;
    }
    .b8 {
        background-color:blue;
        padding: 5px;
        border-radius: 10px;
        width: 150px;
    }
    .flex-container {
        display: flex;
        flex-direction: row;
    }
    .form-wrapper {
        margin-right: 5px;
    }
    .button-wrapper {
        display: flex;
        flex-direction: column;
    }
    .button-wrapper button {
        margin-bottom: 5px;
    }
</style>
</head>
<body>
<?php

include_once "php-export-data.class.php";
include_once "excel/PHPExcel/IOFactory.php";

// ===== الاتصال بقاعدة البيانات (مرة واحدة فقط) =====
$database_file = __DIR__ . DIRECTORY_SEPARATOR . 'databasse3.db';
$connection = new PDO("sqlite:$database_file");
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// الانتظار عند القفل بدل الفشل الفوري
$connection->exec("PRAGMA busy_timeout = 5000");
$connection->exec("PRAGMA journal_mode = WAL");

// دالة للتحقق من صحة البيانات
function isValidData($id, $jour, $nome, $matiere, $se1, $se2, $s3, $s4, $s5, $s6, $s7, $s8) {
    return true;
}

// ===== استيراد ملف Excel =====
if (isset($_REQUEST['importBtn'])) {
    $file = $_FILES['fileToImport']['tmp_name'];
    $extension = strtolower(pathinfo($_FILES['fileToImport']['name'], PATHINFO_EXTENSION));

    $allowedExtensions = array('xlsx', 'xls', 'csv');
    if (in_array($extension, $allowedExtensions)) {
        $fileType = PHPExcel_IOFactory::identify($file);
        $objReader = PHPExcel_IOFactory::createReader($fileType);
        $excel = $objReader->load($file);

        $alldata = $excel->getActiveSheet()->toArray(null, true, true, true);

        $sql = "INSERT INTO `prof` (`id`, `jour`, `nome`, `matiere`, `se1`, `se2`, `s3`, `s4`, `s5`, `s6`, `s7`, `s8`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);

        // تنفيذ كل الإدراجات في عملية واحدة (أسرع وأقل أقفالاً)
        $connection->beginTransaction();
        foreach ($alldata as $data) {
            $id      = $data['A'];
            $jour    = $data['B'];
            $nome    = $data['C'];
            $matiere = $data['D'];
            $se1     = $data['E'];
            $se2     = $data['F'];
            $s3      = $data['G'];
            $s4      = $data['H'];
            $s5      = $data['I'];
            $s6      = $data['J'];
            $s7      = $data['K'];
            $s8      = $data['L'];

            if (isValidData($id, $jour, $nome, $matiere, $se1, $se2, $s3, $s4, $s5, $s6, $s7, $s8)) {
                $stmt->execute([$id, $jour, $nome, $matiere, $se1, $se2, $s3, $s4, $s5, $s6, $s7, $s8]);
            } else {
                $connection->rollBack();
                die("Error: Invalid data");
            }
        }
        $connection->commit();
    } else {
        die("Error: Invalid file extension");
    }
}

// ===== حذف سجل =====
if (isset($_GET["id1"])) {
    $idDel = (int)$_GET["id1"];
    $del = $connection->prepare("DELETE FROM `prof` WHERE id = ?");
    $del->execute([$idDel]);
}

// دالة مختصرة لعرض النص بأمان
function e($v) {
    return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
}
?>

<div class="flex-container">
    <div>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToImport" />
            <input type="submit" class="btn btn-primary" name="importBtn" value="استيراد البيانات" />
        </form>
    </div>
    <div>
        <br>
        <input type="text" id="searchInput" placeholder="ابحث هنا..." />
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th>الرقم</th>
            <th>اليوم</th>
            <th>الاستاذ</th>
            <th>المادة</th>
            <th>الحصة1</th>
            <th>الحصة2</th>
            <th>الحصة3</th>
            <th>الحصة4</th>
            <th>الحصة5</th>
            <th>الحصة6</th>
            <th>الحصة7</th>
            <th>الحصة8</th>
            <th>العمليات</th>
        </tr>
    </thead>

    <tbody id="myInput">
    <?php
    $result = $connection->query("SELECT * FROM prof");

    $fields = ['jour','nome','matiere','se1','se2','s3','s4','s5','s6','s7','s8'];

    foreach ($result as $row) {
        $rid = (int)$row["id"];
        echo "<tr>";
        echo "<td>" . $rid . "</td>";
        foreach ($fields as $f) {
            echo "<td contenteditable='true' class='editable' data-id='" . $rid . "' data-field='" . $f . "'>" . e($row[$f]) . "</td>";
        }
        echo "<td>
            <button class='b1'><a href='/dach/insert_prof_abs.php?id=$rid' style='text-decoration: none; color: white;'>ادراج</a></button>
            <button class='b4'><a href='/dach/update_prof.php?id=$rid' style='text-decoration: none; color: white;'>تعديل</a></button>
            <button class='b2'><a href='/dach/prof.php?id1=$rid' style='text-decoration: none; color: white;' onclick=\"return confirm('هل تريد الحذف؟');\">حذف</a></button>
        </td>";
        echo "</tr>";
    }

    $connection = null;
    ?>
    </tbody>
</table>

<script src="j/j.min.js"></script>

<script>
$(document).ready(function(){

  // ===== البحث وحفظ النص في Local Storage =====
  var storedValue = localStorage.getItem('searchText');

  if (storedValue !== null) {
      $('#searchInput').val(storedValue);
      filterTable(storedValue);
  }

  $('#searchInput').on('keyup', function(){
      var searchText = $(this).val().toLowerCase();
      filterTable(searchText);
      localStorage.setItem('searchText', searchText);
  });

  function filterTable(searchText){
      $('#myInput tr').each(function(){
          var rowData = $(this).text().toLowerCase();
          if (rowData.indexOf(searchText) === -1) {
              $(this).hide();
          } else {
              $(this).show();
          }
      });
  }

  // ===== منع سطر جديد عند Enter =====
  $('#myInput').on('keydown', 'td.editable', function(e){
      if (e.key === 'Enter') {
          e.preventDefault();
          $(this).blur();
      }
  });

  // ===== حفظ التعديل: طلبات بالتتابع مع إعادة المحاولة =====
  var saveQueue = $.Deferred().resolve();

  function saveCell(id, field, value, attempt) {
      attempt = attempt || 1;
      return $.ajax({
          url: 'update_prof_cell.php',
          method: 'POST',
          dataType: 'json',
          timeout: 10000,
          data: { id: id, field: field, value: value }
      }).then(function(res){
          if (!res || !res.success) {
              alert((res && res.message) ? res.message : 'حدث خطأ أثناء الحفظ');
          }
      }, function(){
          if (attempt < 3) {
              return new Promise(function(r){ setTimeout(r, 500 * attempt); })
                  .then(function(){ return saveCell(id, field, value, attempt + 1); });
          }
          alert('تعذر الاتصال بالخادم لحفظ التعديل');
      });
  }

  $('#myInput').on('blur', 'td.editable', function(){
      var td = $(this);
      var id = td.data('id'), field = td.data('field'), value = td.text().trim();
      saveQueue = saveQueue.then(function(){ return saveCell(id, field, value); });
  });

});
</script>
</body>
</html>