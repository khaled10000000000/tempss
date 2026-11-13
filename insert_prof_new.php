<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <title>إضافة أستاذ جديد - متوسطة مبرك العربي</title>
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #64748b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #06b6d4;
            --dark: #1e293b;
            --light: #f8fafc;
            --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .navbar-custom {
            background: var(--gradient);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            margin-bottom: 30px;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            color: white !important;
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .navbar-brand i {
            font-size: 32px;
        }

        .navbar-links a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .navbar-links a:hover {
            opacity: 0.8;
        }

        .main-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .form-container {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .page-title {
            text-align: center;
            color: var(--dark);
            font-size: 28px;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .page-title i {
            color: var(--primary);
            margin-left: 10px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--dark);
            font-weight: bold;
            font-size: 14px;
        }

        .form-group label i {
            color: var(--primary);
            margin-left: 5px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            direction: rtl;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .session-group {
            background: #f8fafc;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .session-group h4 {
            color: var(--dark);
            margin-bottom: 15px;
            font-size: 18px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 10px;
        }

        .btn-custom {
            padding: 12px 30px;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: white;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }

        .alert-custom {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-custom.success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
        }

        .alert-custom.error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #ef4444;
        }

        .alert-custom i {
            font-size: 20px;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .button-group {
                flex-direction: column;
            }

            .btn-custom {
                width: 100%;
                justify-content: center;
            }
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

        <!-- Form Container -->
        <div class="form-container">
            <h1 class="page-title">
                <i class="fas fa-user-plus"></i>
                إضافة أستاذ جديد
            </h1>

            <?php
            $database_file = './databasse3.db';

            try {
                $connection = new PDO("sqlite:$database_file");
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                if (isset($_POST['submit1'])) {
                    $id = $_POST["id"];
                    $jour = $_POST["jour"];
                    $nome = $_POST["nome"];
                    $matiere = $_POST["matiere"];
                    $telephone = $_POST["telephone"] ?? '';
                    $se1 = $_POST["se1"];
                    $se2 = $_POST["se2"];
                    $s3 = $_POST["s3"];
                    $s4 = $_POST["s4"];
                    $s5 = $_POST["s5"];
                    $s6 = $_POST["s6"];
                    $s7 = $_POST["s7"];
                    $s8 = $_POST["s8"];

                    // Validation
                    if (empty($id) || empty($jour) || empty($nome) || empty($matiere)) {
                        echo '<div class="alert-custom error">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>يرجى ملء جميع الحقول المطلوبة</span>
                        </div>';
                    } else {
                        $stmt = $connection->prepare("INSERT INTO prof (id, jour, nome, matiere, telephone, se1, se2, s3, s4, s5, s6, s7, s8)
                                                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt->execute([$id, $jour, $nome, $matiere, $telephone, $se1, $se2, $s3, $s4, $s5, $s6, $s7, $s8]);

                        if ($stmt) {
                            echo '<div class="alert-custom success">
                                <i class="fas fa-check-circle"></i>
                                <span>تم إضافة الأستاذ ' . htmlspecialchars($nome) . ' بنجاح</span>
                            </div>';
                        } else {
                            echo '<div class="alert-custom error">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>حدثت مشكلة أثناء تسجيل الأستاذ</span>
                            </div>';
                        }
                    }
                }
            } catch (PDOException $e) {
                echo '<div class="alert-custom error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>خطأ في الاتصال بقاعدة البيانات: ' . htmlspecialchars($e->getMessage()) . '</span>
                </div>';
            }
            ?>
            <form action="" method="post">
                <div class="form-grid">
                    <div class="form-group">
                        <label><i class="fas fa-hashtag"></i> رقم التسجيل:</label>
                        <input type="number" class="form-control" name="id" required>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-calendar"></i> اليوم:</label>
                        <select class="form-control" name="jour" required>
                            <option value="">اختر اليوم</option>
                            <option value="الأحد">الأحد</option>
                            <option value="الإثنين">الإثنين</option>
                            <option value="الثلاثاء">الثلاثاء</option>
                            <option value="الأربعاء">الأربعاء</option>
                            <option value="الخميس">الخميس</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> الاسم واللقب:</label>
                        <input type="text" class="form-control" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-book"></i> المادة:</label>
                        <input type="text" class="form-control" name="matiere" required>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-phone"></i> رقم الهاتف:</label>
                        <input type="tel" class="form-control" name="telephone" placeholder="مثال: 213XXXXXXXXX">
                    </div>
                </div>

                <div class="session-group">
                    <h4><i class="fas fa-clock"></i> الحصص الدراسية</h4>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>الحصة 1:</label>
                            <input type="text" class="form-control" name="se1">
                        </div>
                        <div class="form-group">
                            <label>الحصة 2:</label>
                            <input type="text" class="form-control" name="se2">
                        </div>
                        <div class="form-group">
                            <label>الحصة 3:</label>
                            <input type="text" class="form-control" name="s3">
                        </div>
                        <div class="form-group">
                            <label>الحصة 4:</label>
                            <input type="text" class="form-control" name="s4">
                        </div>
                        <div class="form-group">
                            <label>الحصة 5:</label>
                            <input type="text" class="form-control" name="s5">
                        </div>
                        <div class="form-group">
                            <label>الحصة 6:</label>
                            <input type="text" class="form-control" name="s6">
                        </div>
                        <div class="form-group">
                            <label>الحصة 7:</label>
                            <input type="text" class="form-control" name="s7">
                        </div>
                        <div class="form-group">
                            <label>الحصة 8:</label>
                            <input type="text" class="form-control" name="s8">
                        </div>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn-custom btn-success" name="submit1">
                        <i class="fas fa-save"></i>
                        حفظ البيانات
                    </button>
                    <a href="/dach/prof.php" class="btn-custom btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        العودة
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>




  


  

    









