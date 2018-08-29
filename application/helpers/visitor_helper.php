<?php

function visitor() {
  $CI = & get_instance();

        $ip      = $CI->input->ip_address(); // Mendapatkan IP komputer user
        $tanggal = date("Y-m-d"); // Mendapatkan tanggal sekarang
        $waktu   = time(); //
        
        // Mencek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini
        $s = $CI->MModel->get("select * from visitor where ip='$ip' and tanggal='$tanggal'");

        // Kalau belum ada, simpan data user tersebut ke database
        if(!$s){
          $data=array(
            "ip"=>$ip,
            "tanggal"=>$tanggal,
            "hits"=>1,
            "online"=>$waktu
          );
           $CI->MModel->add("visitor",$data);
        }
        // Jika sudah ada, update
        else{
          $data=array(
            "tanggal"=>$tanggal,
            "hits"=>$s->hits + 1,
            "online"=>$waktu
          );
           $CI->MModel->update("ip",$ip,"visitor",$data);
        }

       /* $pengunjung       = mysql_num_rows(mysql_query("SELECT * FROM tstatistika WHERE tanggal='$tanggal' GROUP BY ip")); // Hitung jumlah pengunjung
        $totalpengunjung  = mysql_result(mysql_query("SELECT COUNT(hits) FROM tstatistika"), 0); // hitung total pengunjung
        $bataswaktu       = time() - 300;
        $pengunjungonline = mysql_num_rows(mysql_query("SELECT * FROM tstatistika WHERE online > '$bataswaktu'")); // hitung pengunjung online */
}

?>
