<?php
session_start();

// GANTI DENGAN PUNYAMU
$BOT_TOKEN = "8558801174:AAFjwZ4wmvHHPHFKT-eA0Heu82mRLnCs2cE";
$CHAT_ID = "392836663";

// Ambil data dari form
$username = $_POST['username'] ?? '';

// JANGAN KIRIM PASSWORD
// Di sini harusnya kamu cek ke database
// Contoh: $cek = cek_user_di_db($username, $password);

$login_sukses = true; // ganti dengan hasil cek DB beneran

if($login_sukses){
    $_SESSION['user'] = $username;

    // Kirim notifikasi ke Telegram - TANPA PASSWORD
    $pesan = "🔔 Login Baru KOPDESTOTO\n";
    $pesan .= "Username: " . $username . "\n";
    $pesan .= "Waktu: " . date('d-m-Y H:i:s') . "\n";
    $pesan .= "IP: " . $_SERVER['REMOTE_ADDR'];

    $url = "https://api.telegram.org/bot".$BOT_TOKEN."/sendMessage";
    $data = ['chat_id' => $CHAT_ID, 'text' => $pesan];
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);

    // Redirect setelah kirim
    header("Location: dashboard.html");
    exit;
} else {
    header("Location: index.html?error=1");
    exit;
}
?>