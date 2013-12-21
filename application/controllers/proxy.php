 <?php
class Proxy extends CI_Controller
{
 public function index()
    {
        $imgUrl = $_GET["url"];
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                " Content-Type:{image/jpeg}"
                           ));
        curl_setopt ($ch, CURLOPT_URL, $imgUrl);
        header("Content-Type:image/jpeg");
        curl_exec ($ch);
		curl_close ($ch);
        exit;
    }
} 
