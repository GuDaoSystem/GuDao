<?php

// 发送邮件
function sendMail($addressee, $subject, $content){
    // 引入PHPMailer核心文件，使用require_once包含避免出现PHPMailer类重复定义的警告
    require_once("PHPMailer/PHPMailer.php"); 
    require_once("PHPMailer/SMTP.php");

    try {
	    // 实例化PHPMailer核心类
	    $mail = new PHPMailer();

	    // 使用smtp鉴权方式发送邮件
	    $mail->isSMTP();

	    // 设置smtp鉴权 必须设置为true
	    $mail->SMTPAuth = true;

	    // 设置链接qq域名邮箱的服务器地址
	    $mail->Host = "smtp.qq.com";

	    // 设置使用ssl加密方式登录鉴权
	    $mail->SMTPSecure = "ssl";

	    // 设置ssl连接smtp服务器的远程服务器端口号（以前默认为25，现在可选465或587）
	    $mail->Port = 465;

	    // 设置发件人的主机域（默认为localhost，建议设置为系统网站的域名）
	    // $mail->Hostname = "http://www.gudaomusic.cn";

	    // 设置发送邮件的编码（可选UTF-8或GB2312）
	    $mail->CharSet = "UTF-8";

	    // 设置发件人名称
	    $mail->FromName = "孤岛";

	    // 设置smtp登录的账号（qq邮箱前缀）
	    $mail->Username ="ng.winglam";

	    // 设置smtp登录的密码（最新的授权码）
	    $mail->Password = "refhmpmmouorbiba";

	    // 设置发件人邮箱地址，必须为已存在的合法邮箱地址
	    $mail->From = "gudaomusic@foxmail.com";

	    // 设置邮件正文是否为html编码
	    $mail->isHTML(true); 

	    // 设置收件人邮箱地址，若有多个收件人则多次调用方法
	    $mail->addAddress($addressee);

	    // 设置邮件的主题
	    $mail->Subject = $subject;

	    // 设置邮件的正文，若isHTML()设置为true则可以是完整的html字符串
	    $mail->Body = $content;

	    // 设置邮件的附件，若有多个附件则多次调用方法（第一个参数为附件存放的相对/绝对路径，第二个参数为在邮件中该附件的名称）
	    // $mail->addAttachment();

	    // 发送邮件
	    $status = $mail->send();

	    // 返回发送状态
	    return $status;
	} catch(Exception $e) {
		return false;
	}
}