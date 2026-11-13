<?php
// update_prof_ajax.php
// يعالج تحديث سجل من جدول warakadawara عبر AJAX ويرجع JSON

header('Content-Type: application/json; charset=utf-8');

try {
    // تحقق من طريقة الطلب
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'طريقة غير مسموحة']);
        exit;
    }

    // التحقق من المعطيات المطلوبة
    $required = ['id','jour','class','esa1','esa2','esa3','esa4','esa5','esa6','esa7','esa8'];
    foreach ($required as $key) {
        if (!isset($_POST[$key])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'بيانات ناقصة: ' . $key]);
            exit;
        }
    }

    // تنظيف المعطيات الأساسية
    $id = (int)$_POST['id'];
    $jour = trim((string)$_POST['jour']);
    $class = trim((string)$_POST['class']);
    $esa1 = trim((string)$_POST['esa1']);
    $esa2 = trim((string)$_POST['esa2']);
    $esa3 = trim((string)$_POST['esa3']);
    $esa4 = trim((string)$_POST['esa4']);
    $esa5 = trim((string)$_POST['esa5']);
    $esa6 = trim((string)$_POST['esa6']);
    $esa7 = trim((string)$_POST['esa7']);
    $esa8 = trim((string)$_POST['esa8']);

    if ($id <= 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'معرّف غير صالح']);
        exit;
    }

    // الاتصال بقاعدة البيانات (نفس الملف المستخدم في update_prof.php)
    $database_file = './databasse3.db';
    $connection = new PDO("sqlite:$database_file");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // استعلام مهيأ للتحديث
    $sql = "UPDATE warakadawara SET
                jour = :jour,
                class = :class,
                esa1 = :esa1,
                esa2 = :esa2,
                esa3 = :esa3,
                esa4 = :esa4,
                esa5 = :esa5,
                esa6 = :esa6,
                esa7 = :esa7,
                esa8 = :esa8
            WHERE id = :id";

    $stmt = $connection->prepare($sql);
    $ok = $stmt->execute([
        ':jour' => $jour,
        ':class' => $class,
        ':esa1' => $esa1,
        ':esa2' => $esa2,
        ':esa3' => $esa3,
        ':esa4' => $esa4,
        ':esa5' => $esa5,
        ':esa6' => $esa6,
        ':esa7' => $esa7,
        ':esa8' => $esa8,
        ':id'   => $id,
    ]);

    if (!$ok) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'تعذر تنفيذ التحديث']);
        exit;
    }

    // التحقق من وجود الصف وتحديثه
    if ($stmt->rowCount() === 0) {
        // قد لا يكون هناك تغيير فعلي في القيم، لكن الصف موجود
        // نتحقق من وجود السجل
        $check = $connection->prepare('SELECT COUNT(1) FROM warakadawara WHERE id = :id');
        $check->execute([':id' => $id]);
        $exists = (int)$check->fetchColumn() > 0;
        if (!$exists) {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'السجل غير موجود']);
            exit;
        }
    }

    echo json_encode(['success' => true, 'message' => 'تم الحفظ بنجاح']);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'خطأ داخلي', 'error' => $e->getMessage()]);
}
