<?php

// Menggunakan $_POST untuk mengambil data dari dalam web, bukan URL
if (isset($_POST['submit'])) {
    # code...
    // $nama = $_POST["nama"];
    // $umur = $_POST["umur"];
    $file = $_FILES['doc'];
    // echo "Nama saya $nama, umur saya $umur";

    // print_r($file);

    $fileName = $_FILES['doc']['name'];
    $tmp = $_FILES['doc']['tmp_name'];
    $size = $_FILES['doc']['size'];

    // $type = $_FILES['doc']['type'];

    $fileExt = explode('.', $fileName); // Untuk memisahkan nama file --> explode('.',image.jpg) --> [image, jpg]

    $fileExt = strtolower(end($fileExt)); // Fungsi end() untuk mengambil nilai dari index array terakhir

    // echo $fileExt;
    $accType = ["png", "jpeg", "jpg", "pdf"];

    // Membuat variabel untuk menampung nama file yang sama yang akan diupload dan direktori tujuan
    $simpan = "../uploads/${fileName}";
    if (!empty($fileName)) {
        // Size file dihitung dari bit nya (5 MB ==> 5000*1024 = 5.002.000)
        if ($size <= 7000000) {
            if (in_array($fileExt, $accType)) {
                move_uploaded_file($tmp, $simpan);
                $ok = "File Successfully Uploaded";
            } else {
                $ok = "File type is not allowed";
            }
        } else {
            $ok = "File terlalu besar";
        }
    } else {
        $ok = "File Kosong";
    }
}

// print_r($_SERVER);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../dist/output.css">
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="flex justify-center py-64 ">
            <div class="card w-96 bg-base-200 p-2">
                <div class="card-body">
                    <!-- <input type="text" name="nama" placeholder="Nama"> 
                            <input type="number" name="umur" placeholder="Umur"> -->
                    <!-- input name nya "doc" untuk mengirim nilai ke PHP nanti nya -->
                    <div class="text-green-400">
                        <?php
                            echo "<h1>$ok</h1>"
                        ?>
                    </div>
                    <div class="items-center p-2">
                        <label class="block">
                            <input type="file" name="doc" class="text-slate-200">
                        </label>
                    </div>
                    <div class="px-2">
                        <button type="submit" name="submit" class="btn">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>