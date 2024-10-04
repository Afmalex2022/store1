<?php
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// التحقق مما إذا كان الملف صورة فعلية أو وهمية
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "الملف هو صورة - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "الملف ليس صورة.";
        $uploadOk = 0;
    }
}

// التحقق إذا كان الملف موجودًا مسبقًا
if (file_exists($target_file)) {
    echo "عذرًا، الملف موجود مسبقًا.";
    $uploadOk = 0;
}

// السماح بأنواع ملفات معينة فقط
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "عذرًا، يسمح فقط بملفات JPG و JPEG و PNG و GIF.";
    $uploadOk = 0;
}

// التحقق مما إذا كان الرفع مسموحًا
if ($uploadOk == 0) {
    echo "عذرًا، لم يتم رفع الملف.";
// إذا كان كل شيء جيدًا، حاول رفع الملف
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "تم رفع الملف ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " بنجاح.";
    } else {
        echo "عذرًا، حدث خطأ أثناء رفع الملف.";
    }
}
?>
