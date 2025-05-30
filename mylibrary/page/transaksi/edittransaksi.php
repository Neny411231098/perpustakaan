<?php
$id_transaksi = $_GET['id_transaksi']; 
$sql = $koneksi->query("SELECT * FROM tb_transaksi WHERE id_transaksi='$id_transaksi'");
$tampil = $sql->fetch_assoc();
?>

<div class="panel panel-default">
    <div class="panel-heading">Edit Transaksi</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form role="form" method="post">
                    <div class="form-group">
                        <label>ID Transaksi</label>
                        <input class="form-control" name="id_transaksi" value="<?php echo $tampil['id_transaksi']; ?>" readonly />
                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" name="nama" value="<?php echo $tampil['nama']; ?>" required />
                    </div>

                    <div class="form-group">
                        <label>Judul Buku</label>
                        <input class="form-control" name="judul_buku" value="<?php echo $tampil['judul_buku']; ?>" required />
                    </div>

                    <div class="form-group">
                        <label>Tanggal Pinjam</label>
                        <input class="form-control" type="date" name="tanggal_pinjam" value="<?php echo $tampil['tanggal_pinjam']; ?>" required />
                    </div>

                    <div class="form-group">
                        <label>Tanggal Kembali</label>
                        <input class="form-control" type="date" name="tanggal_kembali" value="<?php echo $tampil['tanggal_kembali']; ?>" required />
                    </div>

                    <div class="form-group">
                        <label>Tanggal Pengembalian</label>
                        <input class="form-control" type="date" name="tanggal_pengembalian" value="<?php echo $tampil['tanggal_pengembalian']; ?>" />
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Dipinjam" <?php if ($tampil['status'] == 'Dipinjam') echo 'selected'; ?>>Dipinjam</option>
                            <option value="Dikembalikan" <?php if ($tampil['status'] == 'Dikembalikan') echo 'selected'; ?>>Dikembalikan</option>
                        </select>
                    </div>

                    <div>
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $nama = $_POST['nama'];
    $judul_buku = $_POST['judul_buku'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
    $status = $_POST['status'];

    // Hitung keterlambatan
    $terlambat = 0;
    if (!empty($tanggal_pengembalian) && strtotime($tanggal_pengembalian) > strtotime($tanggal_kembali)) {
        $terlambat = (strtotime($tanggal_pengembalian) - strtotime($tanggal_kembali)) / (60 * 60 * 24);
    }

    $sql = $koneksi->query("UPDATE tb_transaksi SET 
        nama='$nama',
        judul_buku='$judul_buku',
        tanggal_pinjam='$tanggal_pinjam',
        tanggal_kembali='$tanggal_kembali',
        tanggal_pengembalian='$tanggal_pengembalian',
        terlambat='$terlambat',
        status='$status'
        WHERE id_transaksi='$id_transaksi'
    ");

    if ($sql) {
        echo "<script>alert('Data berhasil diupdate'); window.location.href='?page=transaksi';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data');</script>";
    }
}
?>
