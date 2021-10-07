<?php
include_once ('include/dbconnection.php');


class Berita
{
    public function GetRss()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://fetchrss.com/rss/615dc1e02861797479303c42615dc1b277531731d651a172.xml',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}


$tribunObj = new Berita();
$rssData = $tribunObj->GetRss();
$xml = json_decode(json_encode(simplexml_load_string($rssData, null, LIBXML_NOCDATA)), true);

foreach ($xml['channel']['item'] as $data_berita) {
    $judul = $data_berita['title'];
    $deskripsi = $data_berita['description'];
    $url_berita = $data_berita['link'];
    $tanggal = $data_berita['pubDate'];

    $stmt = $dbh->prepare('INSERT INTO berita (judul,deskripsi,link,tanggal) VALUES(?,?,?,?)');  
    $stmt->execute([$judul,$deskripsi,$url_berita,$tanggal]);  
}


echo 'Sukses Mengupdate Berita';
header('location: admin.php');





?>
