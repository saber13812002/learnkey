<?php 
Error_Reporting(E_ALL & ~E_NOTICE);
@$action=$_POST['action']; 
@$namesender=$_POST['namesender']; 
@$from=$_POST['from']; 
@$subject=$_POST['subject']; 
@$text=$_POST['text']; 
@$to=$_POST['to']; 
@$contenttype=$_POST['contenttype']; 
@$priority=$_POST['priority']; 
@$notification=$_POST['notification']; 
@$emaillist=$_POST['emaillist']; 
@$file=$_FILES['file']['tmp_name'];
@$attach=$_FILES['attach_file']['tmp_name'];
@$attach_name=$_FILES['attach_file']['name'];
?> 
<!DOCTYPE html>
<html> 
<head> 
	<title>FakeSender by POCT [FuckAV.ru]</title>
	<style type="text/css">
		* { font: 12px arial, verdana, sans-serif; }
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" /> 
</head> 
<body>
<hr noshade size="5" width="75%">
	<div align="center">
	<font color=red>FakeSender by POCT</font><br>
	Special for <a href="http://fuckav.ru" target="_blank">FuckAV.ru</a>
	</div>
<hr noshade size="5" width="75%"><br>
<form name="form" method="post" enctype="multipart/form-data">
  <table border="0" align="center"> 
	<tr> 
		<td align="right">��� �����������:</td>
		<td><input type="text" name="namesender" value="��� �����������" style='width: 270px;' /></td>
    </tr>
    <tr> 
		<td align="right">����� �����������:</td>
		<td><input type="text" name="from" value="From@site.ru" style='width: 270px;' /></td>
		<td colspan="2"><input type="text" name="subject" value="���� ������" style='width: 520px;' /></td>
    </tr>
	<tr>
		<td align="right">���������� ����:</td> 
	    <td><input type="file" name="attach_file" /></td>
		<td><input type="checkbox" name="priority" value="priority1"/>������ ������?</td>
		<td><input type="checkbox" name="notification" value="notification1"/>����������� � ��������� (������ mail.ru)</td>
	</tr>
	<tr valign="top">
		<td align="right">����:<br />(������ �������)</td> 
		<td><textarea name="emaillist" rows="10" style='width: 268px;' />E-mail_list@site.ru</textarea></td>	
		<td colspan="2">
			<textarea name="text" rows="10" style='width: 518px;' />����� ���������� ����� ���������, ������� ����� ��������� � ������, ���� ���������� ����� ������ � ���� &quot;������� �����&quot;</textarea><br />
			<input type="radio" name="contenttype" value="words" /> ������� ����� (��. �����)<br />
			<input type="radio" name="contenttype" value="file" checked="checked" /> ���� � ���� ����� html (POCT.html) - �� ���������
			<input type="hidden" name="action" value="send" /><br /><br />
			<input type="submit" value="��������� ������" /> 
		</td> 	  
    </tr> 
  </table> 
</form>
<hr noshade size="5" width="75%">
<?php
// �������� ������
if ($priority=="priority1"){
	$priority="X-Priority: 1"; // ������ ������
}
else{
	$priority="X-Priority: "; // �������� ������
}

if ($action=="send"){ 				// ���� ����� ������ ������ "��������� ������"
	$filename = "POCT.html";			// �������� �����-�����
	if ($contenttype=="file"){ 					// ���� ����� ������� � "�����", ��...
		if(file_exists($filename)){			// ���������� �� ����� ����?
			$file=fopen($filename,"r");
			$text=fread($file, filesize($filename)); 			// ���������� text ����� ��������� ����� �� ��������� �����
			fclose($file);
		}
		else{
			echo "<br /> <font color='Red'>Error: ����� $filename ���! ������, ������� ���. </font><br />";
			break;
		}
	}	
	
	if ($attach_name){ 
		if (!file_exists($attach)){ 
			die("����, ������� �� ��������� ���������, �� ����� ���� �������� �� ������"); 
		} 
		$content = fread(fopen($attach,"r"),filesize($attach)); 
		$content = chunk_split(base64_encode($content)); 
		$uid = strtoupper(md5(uniqid(time()))); 
		$uid = "----$uid";
		$orig_name = $attach_name;
		$attach_name = '=?KOI8-R?B?'.base64_encode(convert_cyr_string($attach_name, "w","k")).'?=';
	} 

	$file_extension = strtolower(substr(strrchr($orig_name,"."),1)); // ���������� �������-��� ����� �� ����������
    switch( $file_extension ) {
        case "pdf": $ctype="application/pdf"; break;
		case "exe": $ctype="application/octet-stream"; break;
		case "zip": $ctype="application/zip"; break;
		case "rar": $ctype="application/rar"; break;
		case "doc": $ctype="application/msword"; break;
		case "xls": $ctype="application/vnd.ms-excel"; break;
		case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
		case "gif": $ctype="image/gif"; break;
		case "png": $ctype="image/png"; break;
		case "jpeg":
		case "jpg": $ctype="image/jpg"; break;
		case "mp3": $ctype="audio/mpeg"; break;
		case "mpeg":
		case "mpg":
		case "mpe": $ctype="video/mpeg"; break;
		case "mov": $ctype="video/quicktime"; break;
		case "avi": $ctype="video/x-msvideo"; break;
		case "php": $ctype="application/octet-stream"; break;
		case "htm":
		case "html": $ctype="text/html"; break; 
		case "txt": $ctype="text/plain"; break; 
		default: $ctype="application/force-download";
    }
	
	$text = convert_cyr_string($text, 'w', 'k');
	$text = chunk_split(base64_encode($text)); 
	$subject = '=?KOI8-R?B?'.base64_encode(convert_cyr_string($subject, "w","k")).'?='; 
	$namesender = '=?KOI8-R?B?'.base64_encode(convert_cyr_string($namesender, "w","k")).'?='; 
	$from = "$namesender <$from>";
	
	$all_emails = split("\n", $emaillist); 		//�������� ���� ������ ������� ����� �������
	$num_emails = count($all_emails); 			//���������� ������� � ���� ������
  
	for($x=0; $x<$num_emails; $x++){				// �������� ����� "�� ������ ������ ������" � ����� "+1" "�� ����� ������"
		//$all_emails[$x] = ereg_replace(" ", "", $all_emails[$x]); 		// ������� �������� ������� - ����� 100%
		$to = $all_emails[$x];			//���� "����" ����� �������� ��������� � ������������ �� �������
		$header = "From: $from\n";
		$header .= "$priority\r\n"; 		// ������ ������ ��� ���	
		if ($notification=="notification1"){ 
			$header .= "Disposition-Notification-To: $from\r\n"; // ����� � ���������
		}
		$header .= "X-Mailer: mPOP Web-Mail 2.19\r\n";
		$header .= "MIME-Version: 1.0\r\n"; 
		if ($attach_name) $header .= "Content-Type: multipart/mixed; boundary=\"$uid\"\r\n\r\n\r\n";
		if ($attach_name) $header .= "--$uid\r\n"; 
		$header .= "Content-Type: text/html; charset=koi8-r\r\n";
		$header .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
		$header .= "$text\r\n";
		if ($attach_name) $header .= "--$uid\r\n"; 
		if ($attach_name) $header .= "Content-Type: $ctype; name=\"$attach_name\"\r\n"; 
		if ($attach_name) $header .= "Content-Disposition: attachment\r\n"; 
		if ($attach_name) $header .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
		if ($attach_name) $header .= "$content\r\n";
		if ($attach_name) $header .= "--$uid--";		
		if(mail($to, $subject, $message, $header))
			echo "<br /><div align='center'><font color='Lime'>Ok. ������ ���������� �� e-mail $to</font></div>";
		else
			echo "<br /><div align='center'><font color='Red'>Error: ������ �� ���� ���������� $to </font></div>";
	}
}
?>
</body> 
</html>