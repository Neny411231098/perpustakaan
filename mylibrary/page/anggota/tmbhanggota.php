<div class="panel panel-default">
    <div class="panel-heading">
        Add Anggota
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">

                <!-- FORM -->
                <form role="form" method="post">
                    <div class="form-group">
                        <label>ID anggota</label>
                        <input class="form-control" name="id_anggota" required />
                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" name="nama" required />
                    </div>

                    <div class="form-group">
                        <label>alamat</label>
                        <input class="form-control" name="alamat" required />
                    </div>

                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input class="form-control" name="nomor_telepon" required />
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
    $id_anggota = $_POST['id_anggota'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nomor_telepon = $_POST['nomor_telepon'];

    $sql = $koneksi->query("INSERT INTO tb_anggota (
        id_anggota, nama, alamat, nomor_telepon
    ) VALUES (
        '$id_anggota', '$nama', '$alamat', '$nomor_telepon'
    )");

    if ($sql) {
        echo "<script>alert('Data berhasil disimpan'); window.location.href='?page=anggota';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }
}
?>
