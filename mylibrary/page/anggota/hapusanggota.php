<?php
$id_anggota = $_GET['id_anggota']; 

$koneksi->query("DELETE FROM tb_anggota WHERE id_anggota = '$id_anggota'");
?>

<script type="text/javascript">
    window.location.href = "?page=anggota";
</script>
