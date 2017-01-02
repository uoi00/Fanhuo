<?php
function sendmail($to,$title,$body){
    Vendor('PHPMailer.PHPMailerAutoload');
    $phpmailer = new PHPMailer();

    $phpmailer->IsSMTP();  // 用smtp协议来发

    $phpmailer->Host = 'smtp.qq.com';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Username = 'uoi00';
    $phpmailer->Password = 'qulnxsnjppqvijbd';
    $phpmailer->CharSet='UTF-8';

// 可以发信了

    $phpmailer->From = 'uoi00@qq.com';
    $phpmailer->FromName = 'uoi00';
    $phpmailer->Subject = $title;
    $phpmailer->Body = $body;

//设置收信人
    $phpmailer->AddAddress($to ,'新用户');


// 发信
    if(!$phpmailer->send()){
        echo "邮件错误信息: " . $phpmailer->ErrorInfo;
    }else{
        echo 'ok';
    }
}