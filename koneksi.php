<?php
$conn =new mysqli('localhost','root','','baru_aplikasi');
if ($conn) {
    echo " ";
}
else {
    die(mysqli_error($conn));
}
?>