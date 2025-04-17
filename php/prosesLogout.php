<?php
session_start();
session_destroy();

echo "<script>
    alert('Anda berhasil log out.');
    window.location.href = '../index.html';
    window.close();
</script>";

?>