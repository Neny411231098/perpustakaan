<?php
$id_transaksi = $_GET['id_transaksi'];
$sql = $koneksi->query("SELECT * FROM tb_transaksi WHERE id_transaksi='$id_transaksi'");
$tampil = $sql->fetch_assoc();
$judul_lama = $tampil['judul_buku'];
$status_lama = $tampil['status'];
?>

<div class="panel panel-default">
    <div class="panel-heading">Edit Transaksi</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form role="form" method="post">
                    <div class="form-group">
                        <label>ID Transaksi</label>
                        <input class="form-control" name="id_transaksi" value="<?= $tampil['id_transaksi'] ?>" readonly />
                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" name="nama" value="<?= $tampil['nama'] ?>" required />
                    </div>

                    <div class="form-group">
                        <label>Judul Buku</label>
                        <input class="form-control" name="judul_buku" value="<?= $tampil['judul_buku'] ?>" required />
                    </div>

                    <div class="form-group">
                        <label>Tanggal Pinjam</label>
                        <input class="form-control" type="date" name="tanggal_pinjam" value="<?= $tampil['tanggal_pinjam'] ?>" required />
                    </div>

                    <div class="form-group">
                        <label>Tanggal Kembali</label>
                        <input class="form-control" type="date" name="tanggal_kembali" value="<?= $tampil['tanggal_kembali'] ?>" required />
                    </div>

                    <div class="form-group">
                        <label>Tanggal Pengembalian</label>
                        <input class="form-control" type="date" name="tanggal_pengembalian" value="<?= $tampil['tanggal_pengembalian'] ?>" />
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Dipinjam" <?= $tampil['status'] == 'Dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
                            <option value="Dikembalikan" <?= $tampil['status'] == 'Dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
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
    $tanggal_pengembalian_raw = $_POST['tanggal_pengembalian'];
    $status = $_POST['status'];

    // Atur tanggal pengembalian (NULL jika kosong)
    $tanggal_pengembalian = !empty($tanggal_pengembalian_raw) ? "'$tanggal_pengembalian_raw'" : "NULL";

    // Hitung keterlambatan
    $terlambat = 0;
    if (!empty($tanggal_pengembalian_raw) && strtotime($tanggal_pengembalian_raw) > strtotime($tanggal_kembali)) {
        $terlambat = (strtotime($tanggal_pengembalian_raw) - strtotime($tanggal_kembali)) / (60 * 60 * 24);
    }

    // Update data transaksi
    $sql = $koneksi->query("UPDATE tb_transaksi SET 
        nama='$nama',
        judul_buku='$judul_buku',
        tanggal_pinjam='$tanggal_pinjam',
        tanggal_kembali='$tanggal_kembali',
        tanggal_pengembalian=$tanggal_pengembalian,
        terlambat='$terlambat',
        status='$status'
        WHERE id_transaksi='$id_transaksi'
    ");

    // Jika status berubah menjadi 'Dikembalikan' DAN sebelumnya bukan 'Dikembalikan' -> tambah stok
    if ($status == "Dikembalikan" && $status_lama != "Dikembalikan") {
        $koneksi->query("UPDATE tb_buku SET jumlah_buku = jumlah_buku + 1 WHERE judul_buku='$judul_buku'");
    }

    echo "<script>alert('Data berhasil diupdate'); window.location.href='?page=transaksi';</script>";
}
?>
