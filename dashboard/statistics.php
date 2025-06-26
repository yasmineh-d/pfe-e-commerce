<?php
// الخطوة 1: نبداو الجلسة مرة وحدة فقط ف الأول ديال الصفحة
session_start();

// الخطوة 2: نتحققو واش المستخدم مسجل الدخول. إلا ماشي مسجل، نرجعوه لصفحة تسجيل الدخول
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit; // ضروري نديرو exit باش الكود اللي لتحت مايتنفذش
}

// الخطوة 3: نتصلو بقاعدة البيانات ونجيبو الإحصائيات (مرة وحدة)

// معلومات الاتصال
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "efm";

// متغيرات باش نخزنو فيهم النتائج
$totalClients = 0;
$totalOrders = 0;
$totalProducts = 0;

// إنشاء الاتصال
$conn = mysqli_connect($servername, $username, $password, $dbname);

// التحقق من الاتصال
if (!$conn) {
    // ف حالة فشل الاتصال، من الأحسن نسجلو الخطأ بلا ما نوقفو الموقع كامل
    error_log("Connection failed: " . mysqli_connect_error());
} else {
    // كلشي مزيان، نجيبو البيانات

    // --- جلب عدد الزبائن (Clients) ---
    // كنستعملو جدول 'utilisateur' كيفما اتفقنا
    $sqlClients = "SELECT COUNT(*) as count FROM utilisateur WHERE profil = 'client'"; // جبنا غير الناس لي البروفايل ديالهم client
    $resultClients = mysqli_query($conn, $sqlClients);
    if ($resultClients) {
        $rowClients = mysqli_fetch_assoc($resultClients);
        $totalClients = $rowClients['count'];
    }

    // --- جلب عدد الطلبات (Orders) ---
    $sqlOrders = "SELECT COUNT(*) as count FROM commande";
    $resultOrders = mysqli_query($conn, $sqlOrders);
    if ($resultOrders) {
        $rowOrders = mysqli_fetch_assoc($resultOrders);
        $totalOrders = $rowOrders['count'];
    }

    // --- جلب عدد المنتجات (Products) ---
    $sqlProducts = "SELECT COUNT(*) as count FROM produit";
    $resultProducts = mysqli_query($conn, $sqlProducts);
    if ($resultProducts) {
        $rowProducts = mysqli_fetch_assoc($resultProducts);
        $totalProducts = $rowProducts['count'];
    }

    // الخطوة 4: نسدو الاتصال بقاعدة البيانات حيت سالينا منو
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Statistics</title>

    <link rel="stylesheet" href="../css/statistics.css"> <!-- Link to your custom CSS -->
    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet" />
</head>

<body>
    <!-- ======================================================= -->
    <!--                 MAIN PAGE CONTAINER                     -->
    <!-- ======================================================= -->
    <div class="container">

        <!-- ======================================================= -->
        <!--                      SIDEBAR NAVIGATION                 -->
        <!-- ======================================================= -->
        <nav class="sidebar">
            <!-- Top section of the sidebar -->
            <div class="sidebar-top">
                <div class="logo">
                    <img src="../images/logo_Y.png" alt="logo"> <!-- تأكد من أن مسار الصورة صحيح -->
                </div>
                <ul class="nav-links">
                    <li class="active"> <!-- الصفحة الحالية هي Statistique -->
                        <a href="statistics.php">
                            <i class="fas fa-tachometer-alt"></i><span>Statistique</span>
                        </a>
                    </li>
                    <li>
                        <a href="users.php">
                            <i class="fas fa-users"></i><span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="product.php">
                            <i class="fas fa-box-open"></i><span>Product</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Bottom section of the sidebar -->
            <div class="sidebar-bottom">
                <ul class="nav-links">
                    <li>
                        <a href="settings.php">
                            <i class="fas fa-cog"></i><span>Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="logout.php">
                            <i class="fas fa-sign-out-alt"></i><span>Log out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- ======================================================= -->
        <!--                    MAIN CONTENT AREA                    -->
        <!-- ======================================================= -->
        <main class="content">
            <h1 class="title">Dashboard</h1>
            
            <!-- Container for statistics cards -->
            <div class="stats-cards">
                <!-- Card for Total Clients -->
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <p class="card-label">Total Of Clients</p>
                    <p class="card-value"><?php echo htmlspecialchars($totalClients); ?></p>
                </div>

                <!-- Card for Total Orders -->
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <p class="card-label">Total Of Orders</p>
                    <p class="card-value"><?php echo htmlspecialchars($totalOrders); ?></p>
                </div>

                <!-- Card for Total Products -->
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <p class="card-label">Total Of Products</p>
                    <p class="card-value"><?php echo htmlspecialchars($totalProducts); ?></p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>