<?php
header('Content-Type: application/json; charset=utf-8');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'طريقة غير مسموحة']);
        exit;
    }

    $id    = isset($_POST['id']) ? $_POST['id'] : null;
    $field = isset($_POST['field']) ? $_POST['field'] : null;
    $value = isset($_POST['value']) ? trim($_POST['value']) : '';

    if ($id === null || $field === null || !preg_match('/^\d+$/', (string)$id)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'بيانات غير صالحة']);
        exit;
    }

    $allowedFields = ['jour','nome','matiere','se1','se2','s3','s4','s5','s6','s7','s8'];
    if (!in_array($field, $allowedFields, true)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'حقل غير مسموح']);
        exit;
    }

    $database_file = __DIR__ . DIRECTORY_SEPARATOR . 'databasse3.db';

    $pdo = new PDO('sqlite:' . $database_file);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // هذان السطران هما الحل: الانتظار عند القفل بدل الفشل
    $pdo->exec("PRAGMA busy_timeout = 5000");
    $pdo->exec("PRAGMA journal_mode = WAL");

    $stmt = $pdo->prepare("UPDATE prof SET {$field} = :val WHERE id = :id");
    $stmt->bindValue(':val', $value, PDO::PARAM_STR);
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'خطأ داخلي: ' . $e->getMessage()]);
}