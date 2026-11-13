<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <title>طباعة جدول الأستاذ - متوسطة مبرك العربي</title>
<style>



body {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }




        





select{
    border:2px solid black;
 text-align: center;
    padding: 25px;


}



 </style>
</head>
<body>
    <div class="main-container">
        <!-- Navbar -->
        <nav class="navbar-custom">
            <a href="/dach/index.php" class="navbar-brand">
                <i class="fas fa-school"></i>
                <span>متوسطة مبرك العربي</span>
            </a>
            <div class="navbar-links">
                <a href="/dach/index.php"><i class="fas fa-home"></i> الرئيسية</a>
                <a href="/dach/prof.php"><i class="fas fa-chalkboard-teacher"></i> إدارة الأساتذة</a>
            </div>
        </nav>

        <!-- Page Title -->
        <div class="text-center mb-5">
            <h1 style="color: var(--dark); font-size: 32px; font-weight: bold;">
                <i class="fas fa-file-alt" style="color: var(--primary); margin-left: 10px;"></i>
                طباعة جدول الأستاذ
            </h1>
            <p style="color: var(--secondary); margin-top: 10px;">اختر الأستاذ المراد طباعة جدول حصصه</p>
        </div>

        <!-- Form Card -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card-custom">
                    <div class="text-center mb-4">
                        <i class="fas fa-user-tie" style="font-size: 48px; color: var(--primary);"></i>
                        <h3 style="color: var(--dark); margin-top: 15px;">اختر الأستاذ</h3>
                    </div>
                    
                    <form method="post" action="print_prof.php" target="_blank">
                        <div class="mb-3">
                            <label style="display: block; margin-bottom: 8px; color: var(--dark); font-weight: bold;">
                                <i class="fas fa-user" style="color: var(--primary); margin-left: 5px;"></i>
                                اسم الأستاذ
                            </label>
                            <select name="class" id="class" class="form-control">
                                <?php
                                try {
                                    $database_file = './databasse3.db';
                                    $connection = new PDO("sqlite:$database_file");
                                    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $sql = "SELECT DISTINCT nome FROM prof ORDER BY nome";
                                    $result = $connection->query($sql);

                                    foreach ($result as $row) {
                                        echo "<option value=\"{$row['nome']}\">{$row['nome']}</option>";
                                    }
                                } catch (PDOException $e) {
                                    echo "<option>حدث خطأ في جلب البيانات</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <button type="submit" class="btn-custom btn-primary" style="width: 100%; justify-content: center;">
                            <i class="fas fa-print"></i>
                            طباعة الجدول
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>