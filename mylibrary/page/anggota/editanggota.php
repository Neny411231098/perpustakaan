<?php

    $id_anggota = $_GET['id_anggota']; 
    $sql = $koneksi->query("SELECT * FROM tb_anggota WHERE id_anggota='$id_anggota'");
    $tampil = $sql->fetch_assoc();

    ?>

<div class="panel panel-default">
    <div class="panel-heading">
        Edit Anggota
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">

                <!-- FORM -->

                <form role="form" method="post">
                    <div class="form-group">
                        <label>ID anggota</label>
                        <input class="form-control" name="id_anggota" value ="<?php echo $tampil['id_anggota']; ?>" required />
                    </div>
                    <input type="hidden" name="id_lama" value="<?php echo $tampil['id_anggota']; ?>" />

                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" name="nama" value ="<?php echo $tampil['nama']; ?>" required />
                    </div>

                    <div class="form-group">
                        <label>alamat</label>
                        <input class="form-control" name="alamat" value ="<?php echo $tampil['alamat']; ?>" required />
                    </div>

                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input class="form-control" name="nomor_telepon" value ="<?php echo $tampil['nomor_telepon']; ?>" required />
                    </div>

                    <div>
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary" />
                    </div>
                </form>
                <!-- FORM SELESAI DI SINI -->

            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    $id_lama = $_POST['id_lama'];
    $id_anggota = $_POST['id_anggota'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nomor_telepon = $_POST['nomor_telepon'];

    $sql = $koneksi->query("update tb_anggota set
        id_anggota='$id_anggota', nama='$nama', alamat='$alamat', nomor_telepon='$nomor_telepon' where id_anggota='$id_lama'");

    if ($sql) {
        echo "<script>alert('Data berhasil diedit'); window.location.href='?page=anggota';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }
}
?>
