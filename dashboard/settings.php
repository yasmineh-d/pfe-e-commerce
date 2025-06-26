<?php
// الخطوة 1: نبداو الجلسة مرة وحدة فقط
session_start();

// الخطوة 2: نتحققو واش المستخدم مسجل الدخول
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// الخطوة 3: معلومات الاتصال وقيم افتراضية
$servername = "localhost";
$username   = "root";
$password_db = ""; // كلمة سر قاعدة البيانات
$dbname     = "efm";

$updateMessage = ''; // رسالة باش نعلمو المستخدم بنجاح أو فشل التحديث

// الاتصال بقاعدة البيانات
$conn = mysqli_connect($servername, $username, $password_db, $dbname);
if (!$conn) {
    // من الأحسن تسجل الخطأ بلا ما توقف الموقع
    error_log("Connection failed: " . mysqli_connect_error());
    // عرض رسالة خطأ للمستخدم
    $updateMessage = "<p style='color: red; text-align: center;'>Database connection error. Please try again later.</p>";
} else {
    // الخطوة 4: التعامل مع إرسال الفورم (Form Submission)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $currentAdminId = $_SESSION['admin_id']; // ID ديال الأدمن اللي مسجل الدخول
        $newEmail = $_POST['admin_email'];
        $newPassword = $_POST['admin_password']; // كلمة السر الجديدة (إلا دخلها)

        // سنقوم بتحديث كلمة السر فقط إذا لم تكن الخانة فارغة
        if (!empty($newPassword)) {
            // تحديث الإيميل وكلمة السر (بطريقة غير آمنة كيفما طلبتي)
            $sqlUpdateAdmin = "UPDATE utilisateur SET email = ?, password = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $sqlUpdateAdmin);
            mysqli_stmt_bind_param($stmt, "ssi", $newEmail, $newPassword, $currentAdminId);
        } else {
            // تحديث الإيميل فقط
            $sqlUpdateAdmin = "UPDATE utilisateur SET email = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $sqlUpdateAdmin);
            mysqli_stmt_bind_param($stmt, "si", $newEmail, $currentAdminId);
        }

        // تنفيذ الكويري
        if (mysqli_stmt_execute($stmt)) {
            // تحديث ناجح
            $updateMessage = "<p style='color: green; text-align: center;'>Settings updated successfully!</p>";
            // مهم جدا: حدث الإيميل ف الجلسة (session) باش يبقى صحيح ف الصفحات الأخرى
            $_SESSION['admin_email'] = $newEmail;
        } else {
            // فشل التحديث
            $updateMessage = "<p style='color: red; text-align: center;'>Error updating settings.</p>";
            error_log("Error updating admin settings: " . mysqli_stmt_error($stmt));
        }
        mysqli_stmt_close($stmt);
    }

    // إغلاق الاتصال بعد الانتهاء
    mysqli_close($conn);
}

// الخطوة 5: جلب بيانات الأدمن الحالية من الجلسة لعرضها ف الفورم
$adminEmail = isset($_SESSION['admin_email']) ? htmlspecialchars($_SESSION['admin_email']) : 'email@not.found';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Settings Dashboard</title>
    <link rel="stylesheet" href="../css/statistics.css"> <!-- تأكد أن هذا المسار صحيح -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <style>
        .settings-content {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            max-width: 600px;
            margin: 30px auto;
        }
        .settings-content h2 { color: #333; margin-bottom: 25px; text-align: center; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; color: #555; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .form-actions { text-align: center; margin-top: 30px; }
        .form-actions button { background-color: #007bff; color: white; padding: 10px 25px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s; }
        .form-actions button:hover { background-color: #0056b3; }
        .password-note { font-size: 12px; color: #777; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <!-- ====================== SIDEBAR ====================== -->
        <nav class="sidebar">
            <div class="sidebar-top">
                <div class="logo">
                    <img src="../images/logo_Y.png" alt="logo"> <!-- تأكد أن المسار صحيح -->
                </div>
                <ul class="nav-links">
                    <li><a href="statistics.php"><i class="fas fa-tachometer-alt"></i><span>Statistique</span></a></li>
                    <li><a href="users.php"><i class="fas fa-users"></i><span>Users</span></a></li>
                    <li><a href="product.php"><i class="fas fa-box-open"></i><span>Product</span></a></li>
                </ul>
            </div>
            <div class="sidebar-bottom">
                <ul class="nav-links">
                    <li class="active"><a href="settings.php"><i class="fas fa-cog"></i><span>Settings</span></a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Log out</span></a></li>
                </ul>
            </div>
        </nav>

        <!-- =================== MAIN CONTENT ==================== -->
        <main class="content">
            <h1 class="title">Settings</h1>
            <div class="settings-content">
                <?php echo $updateMessage; // عرض رسالة التحديث هنا ?>
                <h2>Admin Account Settings</h2>
                <form action="settings.php" method="POST">
                    <div class="form-group">
                        <label for="admin_email">Admin Email:</label>
                        <input type="email" id="admin_email" name="admin_email" value="<?php echo $adminEmail; ?>" required />
                    </div>

                    <div class="form-group">
                        <label for="admin_password">New Password:</label>
                        <input type="password" id="admin_password" name="admin_password" />
                        <p class="password-note">Leave blank if you don't want to change the password.</p>
                    </div>

                    <div class="form-actions">
                        <button type="submit">Save Settings</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>