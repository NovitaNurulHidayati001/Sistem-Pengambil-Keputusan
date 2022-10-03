<?php
        if ($_POST){
            $jarak = $_POST['jarak'];
            $ukuran = $_POST['ukuran'];
            $alfa = array();
            $z = array();
            $fasilitas = 0;

            $fasilitas = $_POST['fasilitas-1']+$_POST['fasilitas-2']+$_POST['fasilitas-3']+$_POST['fasilitas-4']+$_POST['fasilitas-5']+$_POST['fasilitas-6']+$_POST['fasilitas-7']+$_POST['fasilitas-8']+$_POST['fasilitas-9']+$_POST['fasilitas-10'];
            // $hasil = "Rp. ".prediksiHarga().;
            $hasil = 0;
            $hasil = perhitungan($jarak,$ukuran,$fasilitas);

        }
    function findMin($x,$y,$z){
        if ($x <= $y && $x <= $z ){
            return $x;
        }elseif ($y <= $x && $y <= $z){
            return $y;
        }else{
            return $z;
        }
    }

    function fasilitasBiasa($fasilitas){
        if ($fasilitas <= 20){
            return 1;
        }elseif ($fasilitas > 20&&$fasilitas <70) {
            return (70-$fasilitas)/50;
            // return "lebih 20 dan kurang 70";
        }else{
            return 0;
        }
    }

    function fasilitasLengkap($fasilitas){
        if ($fasilitas >= 70){
            return 1;
        }elseif ($fasilitas > 20&&$fasilitas <70) {
            return ($fasilitas-20)/50;
        }else{
            return 0;
        }
    }

    function jarakDekat($jarak){
        if ($jarak <=1){
            return 1;
        }elseif ($jarak > 1 && $jarak <3){
            return (3-$jarak)/2;
        }else{
            return 0;
        }
    }

    function jarakSedang($jarak){
        if ($jarak >= 3 && $jarak <= 5) {
            return 1;
        }elseif ($jarak > 1 && $jarak < 3) {
            return ($jarak - 1) / 2;
        }elseif ($jarak > 5 && $jarak < 7) {
            return (7 - $jarak) / 2;
        }else {
            return 0;
        }
    }

    function jarakJauh($jarak){
        if ($jarak >=7){
            return 1;
        }elseif ($jarak > 5 && $jarak <7){
            return ($jarak-5)/2;
        }else{
            return 0;
        }
    }

    function ukuranSempit($ukuran){
        if ($ukuran <=4){
            return 1;
        }elseif ($ukuran > 4 && $ukuran < 8){
            return (8-$ukuran)/4;
        }else{
            return 0;
        }
    }

    function ukuranSedang($ukuran){
        if($ukuran >= 8 && $ukuran <= 15){
            return 1;
        }elseif($ukuran > 4 && $ukuran < 8){
            return ($ukuran - 4) / 4;
        }elseif($ukuran > 15 && $ukuran < 18){
            return (18 - $ukuran) / 3;
        }else{
            return 0;
        }
    }

    function ukuranLuas($ukuran){
        if ($ukuran >= 18){
            return 1;
        }elseif ($ukuran >15 && $ukuran <18){
            return ($ukuran-15)/3;
        }else{
            return 0;
        }
    }

    function hargaMurah($alfa){
        if ($alfa>0 && $alfa <1){
            return (900-$alfa *600);
        }elseif ($alfa ==1) {
            return 300;
        }else{
            return 900;
        }
    }

    function hargaMahal($alfa){
        if ($alfa>0 && $alfa <1){
            return (300+$alfa *600);
        }elseif ($alfa ==1) {
            return 900;
        }else{
            return 300;
        }
    }

    function perhitungan($jarak,$ukuran,$fasilitas){
        $alfa[0] = findMin(fasilitasBiasa($fasilitas),ukuranSempit($ukuran),jarakDekat($jarak));
        $z[0] = hargaMahal($alfa[0]);

        $alfa[1] = findMin(fasilitasBiasa($fasilitas),ukuranSempit($ukuran),jarakSedang($jarak));
        $z[1] = hargaMurah(alfa[1]);

        $alfa[2] = findMin(fasilitasBiasa($fasilitas),ukuranSempit($ukuran),jarakJauh($jarak));
        $z[2] = hargaMurah($alfa[2]);

        $alfa[3] = findMin(fasilitasBiasa($fasilitas),ukuranSedang($ukuran),jarakDekat($jarak));
        $z[3] = hargaMahal($alfa[3]);

        $alfa[4] = findMin(fasilitasBiasa($fasilitas),ukuranSedang($ukuran),jarakSedang($jarak));
        $z[4] = hargaMurah($alfa[4]);

        $alfa[5] = findMin(fasilitasBiasa($fasilitas),ukuranSedang($ukuran),jarakJauh($jarak));
        $z[5] = hargaMurah($alfa[5]);

        $alfa[6] = findMin(fasilitasBiasa($fasilitas),ukuranLuas($ukuran),jarakDekat($jarak));
        $z[6] = hargaMahal($alfa[6]);

        $alfa[7] = findMin(fasilitasBiasa($fasilitas),ukuranLuas($ukuran),jarakSedang($jarak));
        $z[7] = hargaMurah($alfa[7]);

        $alfa[8] = findMin(fasilitasBiasa($fasilitas),ukuranLuas($ukuran),jarakJauh($jarak));
        $z[8] = hargaMurah($alfa[8]);

        $alfa[9] = findMin(fasilitasLengkap($fasilitas),ukuranSempit($ukuran),jarakDekat($jarak));
        $z[9] = hargaMahal($alfa[9]);

        $alfa[10] = findMin(fasilitasLengkap($fasilitas),ukuranSempit($ukuran),jarakSedang($jarak));
        $z[10] = hargaMahal($alfa[10]);

        $alfa[11] = findMin(fasilitasLengkap($fasilitas),ukuranSempit($ukuran),jarakJauh($jarak));
        $z[11] = hargaMurah($alfa[11]);

        $alfa[12] = findMin(fasilitasLengkap($fasilitas),ukuranSedang($ukuran),jarakDekat($jarak));
        $z[12] = hargaMahal($alfa[12]);

        $alfa[13] = findMin(fasilitasLengkap($fasilitas),ukuranSedang($ukuran),jarakSedang($jarak));
        $z[13] = hargaMahal($alfa[13]);

        $alfa[14] = findMin(fasilitasLengkap($fasilitas),ukuranSedang($ukuran),jarakJauh($jarak));
        $z[14] = hargaMurah($alfa[14]);

        $alfa[15] = findMin(fasilitasLengkap($fasilitas),ukuranLuas($ukuran),jarakDekat($jarak));
        $z[15] = hargaMahal($alfa[15]);

        $alfa[16] = findMin(fasilitasLengkap($fasilitas),ukuranLuas($ukuran),jarakSedang($jarak));
        $z[16] = hargaMahal($alfa[16]);

        $alfa[17] = findMin(fasilitasLengkap($fasilitas),ukuranLuas($ukuran),jarakJauh($jarak));
        $z[17] = hargaMurah($alfa[17]);
        // for ($i =0; $i<18; $i++){
        //     echo "alfa ke ".$i." | alfa=".$alfa[$i]." dan z=".$z[$i]."<br>";
        // }
        // die;
        //defuzzyfikasi
        $temp_1 =0;
        $temp_2 =0;

        $hasil =0;
        for ($i =0; $i<18; $i++){
            $temp_1 = $temp_1+ $alfa[$i] * $z[$i];
            $temp_2 = $temp_2+ $alfa[$i];
        }
        

        $hasil = $temp_1/$temp_2;
        return $hasil;

    }
?>
<htlml>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Fuzzy Tsukamoto</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <!-- <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'> -->

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/creative.min.css" rel="stylesheet">
    <link href="css/input.css" rel="stylesheet">
    <style type="text/css">
        body{
     /*background-image:url(https://hxwf5.files.wordpress.com/2012/08/bliss.jpg);*/
     background-color:  #b6b6b6  ;
     background-repeat:no-repeat;
     background-size:cover;
     width:100%;
     height:70vh;
     overflow:auto;
     }
    </style>
    <script src="js/jquery.js"></script>
    <!-- <script src="js/tsukamoto.js"></script> -->

</head>

<body id="page-top">
    <br>
    <br>
    <form method="post" autocomplete="off">
        <div class="form-group row">
            <label class="col-md-4 control-label text-right" for="jarak">Jarak Kos</label>
            <div class="col-md-4">
                <input id="jarak" name="jarak" type="number" placeholder="Jarak" class="form-control input-md">
            </div>
            <label class="control-label text-left" for="km">km</label>
        </div>

        <div class="form-group row">
            <label class="col-md-4 control-label text-right" for="ukuran">Ukuran Kamar</label>
            <div class="col-md-4">
                <input id="ukuran" name="ukuran" type="number" placeholder="Ukuran kamar" class="form-control input-md">
            </div>
            <label class="control-label text-left" for="m">m<sup>2</sup></label>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label text-right" for="fasilitasKos">Fasilitas</label>
            <div class="col-md-4">
                <div class="checkbox">
                    <label for="fasilitas-0">
                    <input type="checkbox" name="fasilitas-1" id="fasilitas-0" value="8">
                    Tempat Tidur
                    </label>
                </div>
                <div class="checkbox">
                    <label for="fasilitas-1">
                    <input type="checkbox" name="fasilitas-2" id="fasilitas-1" value="8">
                    Almari
                    </label>
                </div>
                <div class="checkbox">
                    <label for="fasilitas-2">
                    <input type="checkbox" name="fasilitas-3" id="fasilitas-2" value="8">
                    Meja
                    </label>
                </div>
                <div class="checkbox">
                    <label for="fasilitas-3">
                    <input type="checkbox" name="fasilitas-4" id="fasilitas-3" value="10">
                    Kamar Mandi Dalam
                    </label>
                </div>
                <div class="checkbox">
                    <label for="fasilitas-4">
                    <input type="checkbox" name="fasilitas-5" id="fasilitas-4" value="10">
                    Dapur
                    </label>
                </div>
                <div class="checkbox">
                    <label for="fasilitas-5">
                    <input type="checkbox" name="fasilitas-6" id="fasilitas-5" value="11">
                    Wi-Fi
                    </label>
                </div>
                <div class="checkbox">
                    <label for="fasilitas-6">
                    <input type="checkbox" name="fasilitas-7" id="fasilitas-6" value="11">
                    TV
                    </label>
                </div>
                <div class="checkbox">
                    <label for="fasilitas-7">
                    <input type="checkbox" name="fasilitas-8" id="fasilitas-7" value="12">
                    AC
                    </label>
                </div>
                <div class="checkbox">
                    <label for="fasilitas-8">
                    <input type="checkbox" name="fasilitas-9" id="fasilitas-8" value="11">
                    Meja dan Kursi Belajar
                    </label>
                </div>
                <div class="checkbox">
                    <label for="fasilitas-9">
                    <input type="checkbox" name="fasilitas-10" id="fasilitas-9" value="11">
                    Laundry
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-6 text-center">
            <button type="submit" id="proses" class="proses">PROSES</button>
        </div>

    </form>
    <div class="col-lg-6 text-center">
        <h3 style="display: inline">Hasil Prediksi</h3>
        <input type="text" name="hasil" id="hasil" class="hasil" value="<?php echo "Rp.".number_format($hasil).".000";?>" style=" border:none" />
    </div>
</body>
</html>



