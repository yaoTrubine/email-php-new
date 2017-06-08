<?php 
header("content-type:text/html;charset=utf-8"); 
ini_set("magic_quotes_runtime",0); 
require 'PHPMailerAutoload.php';
require 'class.phpmailer.php'; 
require 'class.smtp.php';

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$company_type = $_POST['company_type'];
$company_name = $_POST['company_name'];
$company_info = $_POST['company_info'];
$dev_example = $_POST['dev_example'];
$deadline = $_POST['deadline'];
$money = $_POST['money'];

//连接mysql
$con = mysql_connect('localhost','root','8876');
if(!$con){
    die('Could not connect:'.mysqli_connect_error());
}
mysql_select_db('mail');
mysql_query("set names utf8");  

//插入数据
$sql = "INSERT INTO `information` (`id`, `name`, `phone`, 
        `email`, `company_type`, `company_name`, 
        `company_info`, `dev_example`, `deadline`, `money`) VALUES (NULL, 
        '{$name}', '{$phone}', '{$email}', '{$company_type}', '{$company_name}', 
        '{$company_info}', '{$dev_example}', '{$deadline}', '{$money}')";

if (!mysql_query($sql,$con))
  {
  die('Error:'.mysql_error());
  }

//关闭
mysql_close($con);
/*
try { 
$mail = new PHPMailer(true); 
$mail->IsSMTP(); 
$mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码 
$mail->SMTPAuth = true; //开启认证 
$mail->Port = 25; 
$mail->Host = "smtp.yeah.net"; 
$mail->Username = "yaotrubine@yeah.net"; 
$mail->Password = "wangypxziqoo2"; 
//$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could not execute: /var/qmail/bin/sendmail ”的错误提示 
$mail->From = "yaotrubine@yeah.net"; 
$mail->FromName = "定制开发需求"; 
$to_1 = "463988629@qq.com"; 
// $to_3 = "314748387@qq.com";
$mail->AddAddress($to_1); 
$mail->Subject = "在线预约提醒"; 
$mail->Body = "姓名：".$name."<br />联系方式：".$phone."<br />邮箱：".$email
             ."<br />公司类型：".$company_type."<br />公司名称：".$company_name
             ."<br />开发需求描述：".$company_info."<br />开发参考案例：".$dev_example
             ."<br />截止日期：".$deadline."<br />完成预算：".$money;

if($_FILES['file']['tmp_name']){
    $mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);
}


$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略 
$mail->WordWrap = 200; // 设置每行字符串的长度 
//$mail->AddAttachment("f:/test.png"); //可以添加附件 
$mail->IsHTML(true); 
$mail->Send(); 
include("success.html");
} catch (phpmailerException $e) { 
echo "邮件发送失败：".$e->errorMessage(); 
} 

*/
 ?>