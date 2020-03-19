<?php
//-------- Пароль доступа к статистике ------
// В целях безопасности настроятельно рекомендуем задать пароль доступка в следующей строчке.
// Этот пароль нужно будет так же указать в AMS в разделе Настройки->RealTime статистика при
// добавлении ссылки на данный скрипт.

$Password="qwerty";

//-------- Заголовок Html ------------------
header('Content-Type: text/html; charset=windows-1251');
$HtmlHead='<html><head><META content="text/html; charset=windows-1251" http-equiv=Content-Type><title>Обработка данных</title></head>';

//--------- Сообщения форм -----------------
// В следующих строках можно задать сообщения, которые будут показаны скриптом после отправки
// формы подписки/отписки и кликов на ссылки-подтверждения.

$Form_Submit_Error="Введен не корректный E-Mail адрес<br>Пожалуйста, введите правильный E-Mail для успешной отправки формы";
$Form_Submit_OK="Спасибо.<br>Ваш запрос обрабатывается.<br>Вы получите запрос на подтверждение подписки на указанный e-mail";
$Confirmation_Link_Click="Подтверждение получено, спасибо !";
$Unsubscribe_Link_Click="Спасибо, Вы были успешно отписаны от нашей рассылки !";
//------------------------------------------

$ProgID = "-1";
$MailingID = -1;
$GroupID = -1;
$MessageID = -1;
$RcptEmail = "no_email";
$Form_Email = "no_email";
$MakeCopy = 0;
$GetCopy = 0;
$RedirURL = "nourl";
$FormName = "no_form";
$UnsubcrubeClick = 0;
$Form_FullName = "no_form_fullname";
$UnsubscribeAction = "no_action";

if(isset($_POST["FormID"]))
	{
	// check is subscribe/unsubscribe form submitted
        $FormName = trim($_POST["FormID"]);
	if(isset($_POST["FormProgID"]))
		$ProgID = trim($_POST["FormProgID"]);
	else
		{
		echo "Unknown ProgramID";
		exit;
		}	
	if(isset($_POST["FormEmail"]) && !empty($_POST["FormEmail"]))
		{
	        $Form_Email = trim(strtolower($_POST["FormEmail"]));
		if((preg_match("/(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/",$Form_Email)) or (!preg_match("/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,6}|[0-9]{1,3})(\]?)$/",$Form_Email)))
			{
			echo $HtmlHead."<body BGCOLOR=\"#E6E6E6\"><div align=\"center\"><FONT color=\"#003399\"$Form_Submit_Error</FONT></div></body></html>";
			exit;
 			}
		}
	else
		{
		echo $HtmlHead."<body BGCOLOR=\"#E6E6E6\"><div align=\"center\"><FONT color=\"#003399\"<br>$Form_Submit_Error</FONT></div></body></html>";
		exit;
		}
	if(isset($_POST["FormFullName"]) && !empty($_POST["FormFullName"]))
        	$Form_FullName = trim($_POST["FormFullName"]);
	}
else
	{
	// Traceable link click/opened message counter/(un)subscribe confimation click/receive statistic command(s)
	$InRequest = trim($_SERVER['QUERY_STRING']);
	$InRequest = mcrypt_cbc(MCRYPT_RIJNDAEL_128,$Password,base64_decode(urldecode($InRequest)),MCRYPT_DECRYPT,'amsstatinivector');
	if((strpos($InRequest,'amsclk')===false && strpos($InRequest,'amscmd')===false) || strpos($InRequest,'|{')===false)
		{
		echo "Unknown request type";
		exit;
		}
	if(strpos($InRequest,'amsclk')!==false)
		{
		// Traceable link click/opened message counter/(un)subscribe confimation click
		$InRequest = substr_replace($InRequest,'',0,7); 
		if(!mb_detect_encoding($InRequest, 'ASCII', true))
			{
			echo "Unable to decode URL !";
			exit;
			}
		$ParamsArray = explode("|{",$InRequest);
		foreach($ParamsArray as $InParam)
			{
			if(strpos($InParam,"PID=")===0)
				{
				$ProgID = trim(substr($InParam,4));
				if((strpos($ProgID,"AMS_")===false && strpos($ProgID,"MPC_")===false) || !is_numeric(substr($ProgID,4)))
					{
					echo "Unable to decode URL !";
					exit;
					}
				}
			else if(strpos($InParam,"GID=")===0)
				{
				$GroupID = trim(substr($InParam,4));
				if(!is_numeric($GroupID))
					{
					echo "Unable to decode URL !";
					exit;
					}
				}
			else if(strpos($InParam,"MLID=")===0)
				{
				$MailingID = trim(substr($InParam,5));
				if(!is_numeric($MailingID))
					{
					echo "Unable to decode URL !";
					exit;
					}
				}
			else if(strpos($InParam,"MSID=")===0)
				{
				$MessageID = trim(substr($InParam,5));
				if(!is_numeric($MessageID))
					{
					echo "Unable to decode URL !";
					exit;
					}	
				}
			else if(strpos($InParam,"EML=")===0)
				$RcptEmail = trim(substr($InParam,4));
			else if(strpos($InParam,"RD=")===0)
				$RedirURL = trim(substr($InParam,3));
			else if(strpos($InParam,"UAction=")===0)
				{
				$UnsubcrubeClick = 1;
				$UnsubscribeAction = trim(substr($InParam,8));
				}
			}
		if($ProgID=="-1")
			{
			echo "Unknown request type";
			exit;
			}
		}
	else if(strpos($InRequest,'amscmd')!==false)
		{
		// MakeCopy/GetCopy commands
		$InRequest = substr_replace($InRequest,'',0,6); 
		$ParamsArray = explode("|{",$InRequest);
		foreach($ParamsArray as $InParam)
			{
			if(strpos($InParam,"PID=")===0)
				$ProgID = trim(substr($InParam,4));
			if(strpos($InParam,"MCPY=")===0)
				$MakeCopy = 1;
			else if(strpos($InParam,"GCPY=")===0)
				$GetCopy = 1;
			}
		if($ProgID=="-1" || ($MakeCopy==0 && $GetCopy==0))
			{
			echo "Unknown request type";
			exit;
			}
		}
	else
		{
		// should never be here
		echo "Unknown request type";
		exit;
		}
	}
//-----------------------------------------------------------------

function HtmlEntDecode($text)
{
$str = '';
$i = 0;
while ($i < strlen($text))
	{
	if ($i < strlen($text) - 1 && substr($text, $i, 2) == "&#")
		{
		$chr = '';
		$i += 2;
		while ($i < strlen($text) && substr($text, $i, 1) != ";")
			{
		        $chr .= substr($text, $i, 1);
                	$i++;
			}
		if (strlen($chr) > 0)
			{
	               	$str .= utf8_chr($chr);
	        	}
		}
	else
		{
	        $str .= substr($text, $i, 1);
	        }
	$i++;
	}
return $str;
}

//--------------------------------------------------------------------

function utf8_chr($code)
{
if($code<128) return chr($code);
else if($code<2048) return chr(($code>>6)+192).chr(($code&63)+128);
else if($code<65536) return chr(($code>>12)+224).chr((($code>>6)&63)+128).chr(($code&63)+128);
else if($code<2097152) return chr($code>>18+240).chr((($code>>12)&63)+128).chr(($code>>6)&63+128).chr($code&63+128);
}
//--------------------------------------------------------------------

if($MakeCopy == 1)
	{
	if(file_exists($ProgID.'.log'))
		{
		if(!copy($ProgID.'.log',$ProgID.'.out'))
			{
			echo "Error: Can't create output file. Permission denied.";
			exit;	
			}
		$LogFile = fopen($ProgID.'.log', 'w');
		if(!$LogFile)
			{
			echo "Error: Can't update input file. Permission denied.";
			exit;
			}
		flock($LogFile, 2); 
		ftruncate($LogFile,0);
		flock($LogFile, 3);
		fclose($LogFile);
		echo "cmd_ok";
		exit;
		}
	else
		{
		echo 'Error: No File';
		exit;
		}
	}
else if($GetCopy == 1)
	{
        if(file_exists($ProgID.'.out'))
		{
       	        $LogFile = fopen($ProgID.'.out', 'r');
		if(!$LogFile)
			{
			echo "Error: Cant open out file";
			exit;
			}
                flock($LogFile, 2);
                while(!feof($LogFile))
                	{
                        $Buffer = fgets($LogFile, 4096);
                        echo $Buffer;
                        }
                flock($LogFile, 3);
                fclose($LogFile);
		echo "cmd_ok";
                exit;
                }
	else
            	{
                echo "Error: No File";
                exit;
                }
	}
else
	{
	$today = getdate() ;
	$LogFile = fopen($ProgID.'.log', 'ab');
	if(!$LogFile)
		{
		echo "Error: Can't open log file. Permission denied.";
		exit;
		}
	flock($LogFile, 2);
	if(stristr($ProgID,"AMS_"))
		{
		if($UnsubcrubeClick=="0")
			$OutString="$MailingID:$GroupID:$RcptEmail:$RedirURL|};".$today['year'].":".$today['mon'].":".$today['mday'].":".$today['hours'].":".$today['minutes']."\r\n";
		else
			{
			$OutString="$MailingID:$GroupID:$RcptEmail:Unsubscribe_Click:$UnsubscribeAction|};".$today['year'].":".$today['mon'].":".$today['mday'].":".$today['hours'].":".$today['minutes']."\r\n";
			echo $HtmlHead."<body BGCOLOR=\"#E6E6E6\"><div align=\"center\"><FONT color=\"#003399\"<br>$Unsubscribe_Link_Click</FONT></div></body></html>";
			}
		}
	else if(stristr($ProgID,"MPC_"))
		{
                if($FormName=="no_form")
			{
                        $OutString="Confirm_Data=$MessageID:".$today['year'].":".$today['mon'].":".$today['mday'].":".$today['hours'].":".$today['minutes'].";\r\n";
			if($RedirURL=="nourl")
				echo $HtmlHead."<body BGCOLOR=\"#E6E6E6\"><div align=\"center\"><FONT color=\"#003399\"<br>$Confirmation_Link_Click</FONT></div></body></html>";
			}	
                else
			{
			$OutString="Form_Data=$FormName:".HtmlEntDecode($Form_FullName).":$Form_Email:".$today['year'].":".$today['mon'].":".$today['mday'].":".$today['hours'].":".$today['minutes'].";\r\n";
			echo $HtmlHead."<body BGCOLOR=\"#E6E6E6\"><div align=\"center\"><FONT color=\"#003399\"<br>$Form_Submit_OK</FONT></div></body></html>";
			}
                }
	fwrite($LogFile,$OutString);
        fflush($LogFile);
	flock($LogFile, 3);
	fclose($LogFile);    
	}
if($RedirURL != "nourl")
	{
	if(!headers_sent())
		{
		if($RedirURL == "open_trace")
			{
			header( 'Content-type: image/gif' );
			echo chr(71).chr(73).chr(70).chr(56).chr(57).chr(97).
			chr(1).chr(0).chr(1).chr(0).chr(128).chr(0).
			chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).
			chr(33).chr(249).chr(4).chr(1).chr(0).chr(0).
			chr(0).chr(0).chr(44).chr(0).chr(0).chr(0).chr(0).
			chr(1).chr(0).chr(1).chr(0).chr(0).chr(2).chr(2).
			chr(68).chr(1).chr(0).chr(59);
			}
		else if(strpos(strtolower($RedirURL),"http://")===0)
		        header("Location: $RedirURL");	
    	        exit;
	        }
        }
?>