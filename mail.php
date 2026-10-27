<?php
require "PHPMailer-master/src/PHPMailer.php"; // Nhúng thư viện PHPMailer
require "PHPMailer-master/src/SMTP.php";     // Nhúng thư viện SMTP
require "PHPMailer-master/src/Exception.php"; // Nhúng thư viện Exception

if (isset($_POST['email'])) {
    $mail = new PHPMailer\PHPMailer\PHPMailer(true); // true: bật chế độ exceptions
    try {
        // Cấu hình kết nối SMTP Server
        $mail->SMTPDebug = 0;                  // 0: tắt debug, 2: bật debug chi tiết nếu cần kiểm tra lỗi
        $mail->isSMTP();
        $mail->CharSet = "utf-8";
        $mail->Host = 'smtp.gmail.com';        // SMTP Server của Gmail
        $mail->SMTPAuth = true;                // Bật xác thực SMTP
        
        $nguoigui = 'nguyentamthien710@gmail.com';
        $matkhau = 'hpcz twno tafr usvr';
        $tennguoigui = 'Nguyen Tam Thien';
        
        $mail->Username = $nguoigui;           // SMTP username
        $mail->Password = $matkhau;            // SMTP password
        $mail->SMTPSecure = 'ssl';             // Giao thức mã hóa SSL
        $mail->Port = 465;                     // Cổng kết nối SSL
        
        // Thiết lập người gửi
        $mail->setFrom($nguoigui, $tennguoigui);

        // for mutimail
        // get the email addresses from the form input
        $recipients = $_POST['email']; 
        $email_array = explode(",", $recipients); // Tách chuỗi thành mảng vd email1, email2, ...

        $mail->clearAddresses(); // Xóa danh sách người nhận cũ nếu có
        foreach ($email_array as $email) {
            $email = trim($email); // Loại bỏ khoảng trắng thừa
            if (!empty($email)) {
                $to = $email;
                $to_name = "bạn";
                $mail->addAddress($to, $to_name); // Thêm từng địa chỉ email vào danh sách người nhận[cite: 2]
            }
        }
        
        // Thêm địa chỉ nhận cố định bổ sung (nếu cần)
        $mail->addAddress("tamnvt.25it@vku.udn.vn", "TamVKU");

        // Tiêu đề và Nội dung email
        $mail->isHTML(true); // Cấu hình gửi nội dung dạng HTML
        $tieude = $_POST['tieude'];
        $mail->Subject = $tieude;

        $noidungthu = '
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><b>Xin chào TamVKU</b></h5>
                <p class="card-text">' . $_POST['content'] . '</p>
            </div>
        </div>';
        $mail->Body = $noidungthu;

    
        if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
            $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['file']['name']));
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                $mail->addAttachment($uploadfile, $_FILES['file']['name']);
            }
        }

        // Cấu hình kết nối SSL bổ sung 
        $mail->smtpConnect(array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));

        // Tiến hành gửi email
        if ($mail->send()) {
            header("Location: index.php?success=1");
            exit();
        }

    } catch (Exception $e) {
        echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
    }
}
?>