<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <title>طباعة الجلدات - متوسطة مبرك العربي</title>
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
                <i class="fas fa-print" style="color: var(--primary); margin-left: 10px;"></i>
                طباعة الجلدات
            </h1>
            <p style="color: var(--secondary); margin-top: 10px;">اختر نوع الجلدة والمراد طباعته</p>
        </div>

        <!-- Cards Grid -->
        <div class="row justify-content-center">
            <!-- Teacher Schedule Card -->
            <div class="col-md-6 mb-4">
                <div class="card-custom">
                    <div class="text-center mb-4">
                        <i class="fas fa-chalkboard-teacher" style="font-size: 48px; color: var(--primary);"></i>
                        <h3 style="color: var(--dark); margin-top: 15px;">جلدة الأساتذة</h3>
                        <p style="color: var(--secondary);">طباعة جدول الحصص للأساتذة بحجم A3</p>
                    </div>
                    
                    <form method="post" action="jelda_prof.php" target="_blank">
                        <div class="mb-3">
                            <label style="display: block; margin-bottom: 8px; color: var(--dark); font-weight: bold;">
                                <i class="fas fa-calendar" style="color: var(--primary); margin-left: 5px;"></i>
                                اختر اليوم
                            </label>
                            <select name="jour" id="jour" class="form-control">
                                <?php
                                try {
                                    $database_file = './databasse3.db';
                                    $connection = new PDO("sqlite:$database_file");
                                    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $sql = "SELECT DISTINCT jour FROM prof ORDER BY jour";
                                    $result = $connection->query($sql);

                                    foreach ($result as $row) {
                                        echo "<option value=\"{$row['jour']}\">{$row['jour']}</option>";
                                    }
                                } catch (PDOException $e) {
                                    echo "<option>حدث خطأ في جلب البيانات</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <button type="submit" class="btn-custom btn-primary" style="width: 100%; justify-content: center;">
                            <i class="fas fa-print"></i>
                            طباعة جلدة الأساتذة
                        </button>
                    </form>
                </div>
            </div>

            <!-- Student Schedule Card -->
            <div class="col-md-6 mb-4">
                <div class="card-custom">
                    <div class="text-center mb-4">
                        <i class="fas fa-users" style="font-size: 48px; color: var(--success);"></i>
                        <h3 style="color: var(--dark); margin-top: 15px;">جلدة التلاميذ</h3>
                        <p style="color: var(--secondary);">طباعة جدول الحصص للتلاميذ بحجم A3</p>
                    </div>
                    
                    <form method="post" action="jelda_eleve.php" target="_blank">
                        <div class="mb-3">
                            <label style="display: block; margin-bottom: 8px; color: var(--dark); font-weight: bold;">
                                <i class="fas fa-calendar" style="color: var(--success); margin-left: 5px;"></i>
                                اختر اليوم
                            </label>
                            <select name="jour" id="jour" class="form-control">
                                <?php
                                try {
                                    $database_file = './databasse3.db';
                                    $connection = new PDO("sqlite:$database_file");
                                    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $sql = "SELECT DISTINCT jour FROM prof ORDER BY jour";
                                    $result = $connection->query($sql);

                                    foreach ($result as $row) {
                                        echo "<option value=\"{$row['jour']}\">{$row['jour']}</option>";
                                    }
                                } catch (PDOException $e) {
                                    echo "<option>حدث خطأ في جلب البيانات</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <button type="submit" class="btn-custom btn-success" style="width: 100%; justify-content: center;">
                            <i class="fas fa-print"></i>
                            طباعة جلدة التلاميذ
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>