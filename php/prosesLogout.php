<?php
session_start();
session_destroy();

echo "<script>
    alert('Anda berhasil log out.');
    window.location.href = '../halaman_sementara.html';
    window.close();
</script>";

?>