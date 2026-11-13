<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">


    

    <title>طباعة جدول القسم - متوسطة مبرك العربي</title>
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
                <i class="fas fa-users" style="color: var(--success); margin-left: 10px;"></i>
                طباعة جدول القسم
            </h1>
            <p style="color: var(--secondary); margin-top: 10px;">اختر القسم المراد طباعة جدول حصصه</p>
        </div>

        <!-- Form Card -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card-custom">
                    <div class="text-center mb-4">
                        <i class="fas fa-graduation-cap" style="font-size: 48px; color: var(--success);"></i>
                        <h3 style="color: var(--dark); margin-top: 15px;">اختر القسم</h3>
                    </div>
                    
                    <form method="post" action="print_eleve.php" target="_blank">
                        <div class="mb-3">
                            <label style="display: block; margin-bottom: 8px; color: var(--dark); font-weight: bold;">
                                <i class="fas fa-layer-group" style="color: var(--success); margin-left: 5px;"></i>
                                القسم
                            </label>
                            <select name="class" id="class" class="form-control">
                                <optgroup label="المستوى الأول">
                                    <option value="1م1">1م1</option>
                                    <option value="1م2">1م2</option>
                                    <option value="1م3">1م3</option>
                                    <option value="1م4">1م4</option>
                                    <option value="1م5">1م5</option>
                                    <option value="1م6">1م6</option>
                                </optgroup>
                                <optgroup label="المستوى الثاني">
                                    <option value="2م1">2م1</option>
                                    <option value="2م2">2م2</option>
                                    <option value="2م3">2م3</option>
                                    <option value="2م4">2م4</option>
                                    <option value="2م5">2م5</option>
                                </optgroup>
                                <optgroup label="المستوى الثالث">
                                    <option value="3م1">3م1</option>
                                    <option value="3م2">3م2</option>
                                    <option value="3م3">3م3</option>
                                    <option value="3م4">3م4</option>
                                    <option value="3م5">3م5</option>
                                </optgroup>
                                <optgroup label="المستوى الرابع">
                                    <option value="4م1">4م1</option>
                                    <option value="4م2">4م2</option>
                                    <option value="4م3">4م3</option>
                                    <option value="4م4">4م4</option>
                                    <option value="4م5">4م5</option>
                                </optgroup>
                            </select>
                        </div>

                        <button type="submit" class="btn-custom btn-success" style="width: 100%; justify-content: center;">
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