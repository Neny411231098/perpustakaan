<?php
$id_transaksi = $_GET['id_transaksi']; 

$koneksi->query("DELETE FROM tb_transaksi WHERE id_transaksi = '$id_transaksi'");
?>

<script type="text/javascript">
    window.location.href = "?page=transaksi";
</script>

