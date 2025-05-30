<div class="panel panel-default">
    <div class="panel-heading">Add Transaksi</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <!-- FORM -->
                <form method="post">
                    <div class="form-group">
                        <label>ID Transaksi</label>
                        <input class="form-control" name="id_transaksi" required />
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" name="nama" required />
                    </div>
                    <div class="form-group">
                        <label>Judul Buku</label>
                        <input class="form-control" name="judul_buku" required />
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pinjam</label>
                        <input class="form-control" type="date" name="tanggal_pinjam" id="tanggal_pinjam" required />
                    </div>
                    <div class="form-group">
                        <label>Waktu Pengembalian</label>
                        <input class="form-control" type="date" name="tanggal_kembali" id="tanggal_kembali" required />
                    </div>
                    <div class="form-group">
                        <label>Tanggal Kembali</label>
                        <input class="form-control" type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" />
                    </div>
                    <div class="form-group">
                        <label>Terlambat</label>
                        <input class="form-control" name="terlambat" />
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Dipinjam">Dipinjam</option>
                            <option value="Dikembalikan">Dikembalikan</option>
                        </select>
                    </div>
                    <div>
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary" />
                    </div>
                </form>

                <!-- VALIDASI OTOMATIS TANGGAL KEMBALI -->
                <script>
                    document.getElementById('tanggal_pinjam').addEventListener('change', function () {
                        const pinjam = new Date(this.value);
                        if (isNaN(pinjam)) return;

                        const kembaliInput = document.getElementById('tanggal_kembali');
                        const maxDate = new Date(pinjam);
                        maxDate.setDate(pinjam.getDate() + 5);

                        kembaliInput.min = this.value;
                        kembaliInput.max = maxDate.toISOString().split('T')[0];
                    });
                </script>
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
    $tanggal_pengembalian = $_POST['tanggal_pengembalian'] ?? null;
    $terlambat = $_POST['terlambat'] ?? null;
    $status = $_POST['status'];

    // Validasi tanggal kembali maksimal 5 hari dari tanggal pinjam
    $selisih = (strtotime($tanggal_kembali) - strtotime($tanggal_pinjam)) / (60 * 60 * 24);
    if ($selisih > 5) {
        echo "<script>alert('Tanggal kembali maksimal 5 hari dari tanggal pinjam');</script>";
        exit;
    }

    // Ambil jumlah stok buku (jumlah_buku)
    $cekBuku = $koneksi->query("SELECT jumlah_buku FROM tb_buku WHERE judul = '$judul_buku'");
    $buku = $cekBuku->fetch_assoc();

    if (!$buku) {
        echo "<script>alert('Buku tidak ditemukan');</script>";
        exit;
    }

    $jumlah_buku = $buku['jumlah_buku'];

    // Jika status dipinjam, cek stok dulu
    if ($status == 'Dipinjam') {
        if ($jumlah_buku <= 0) {
            echo "<script>alert('Stok buku habis');</script>";
            exit;
        }

        // Kurangi stok
        $koneksi->query("UPDATE tb_buku SET jumlah_buku = jumlah_buku - 1 WHERE judul = '$judul_buku'");
    } elseif ($status == 'Dikembalikan') {
        // Tambah stok jika status dikembalikan
        $koneksi->query("UPDATE tb_buku SET jumlah_buku = jumlah_buku + 1 WHERE judul = '$judul_buku'");
    }

    // Simpan data transaksi
    $sql = $koneksi->query("INSERT INTO tb_transaksi (
        id_transaksi, nama, judul_buku, tanggal_pinjam, tanggal_kembali, tanggal_pengembalian, terlambat, status
    ) VALUES (
        '$id_transaksi',
        '$nama',
        '$judul_buku',
        '$tanggal_pinjam',
        '$tanggal_kembali',
        " . ($tanggal_pengembalian ? "'$tanggal_pengembalian'" : "NULL") . ",
        " . ($terlambat ? "'$terlambat'" : "NULL") . ",
        '$status'
    )");

    if ($sql) {
        echo "<script>alert('Data berhasil disimpan'); window.location.href='?page=transaksi';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }
}
?>
