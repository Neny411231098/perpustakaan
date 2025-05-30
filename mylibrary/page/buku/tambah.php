<div class="panel panel-default">
    <div class="panel-heading">
        Add Book
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">

                <!-- FORM -->
                <form role="form" method="post">
                    <div class="form-group">
                        <label>ID Buku</label>
                        <input class="form-control" name="id_buku" required />
                    </div>

                    <div class="form-group">
                        <label>Judul Buku</label>
                        <input class="form-control" name="judul_buku" required />
                    </div>

                    <div class="form-group">
                        <label>Pengarang</label>
                        <input class="form-control" name="pengarang" required />
                    </div>

                    <div class="form-group">
                        <label>Penerbit</label>
                        <input class="form-control" name="penerbit" required />
                    </div>

                    <div class="form-group">
                        <label>Tahun Terbit</label>
                        <input class="form-control" name="tahun_terbit" required />
                    </div>

                    <div class="form-group">
                        <label>Stock</label>
                        <input class="form-control" type="number" name="jumlah_buku" required />
                    </div>

                    <div class="form-group">
                        <label>Lokasi</label>
                        <select class="form-control" name="lokasi" required>
                            <option value="rak1">Rak 1</option>
                            <option value="rak2">Rak 2</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Input</label>
                        <input class="form-control" type="date" name="tanggal_input" required />
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


    $buku = $_POST['id_buku'];
    $judul = $_POST['judul_buku'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun_terbit'];
    $stock = $_POST['jumlah_buku'];
    $lokasi = $_POST['lokasi'];
    $tanggal = $_POST['tanggal_input'];

    $sql = $koneksi->query("INSERT INTO tb_buku (
        id_buku, judul_buku, pengarang, penerbit, tahun_terbit, jumlah_buku, lokasi, tanggal_input
    ) VALUES (
        '$buku', '$judul', '$pengarang', '$penerbit', '$tahun', '$stock', '$lokasi', '$tanggal'
    )");

    if ($sql) {
        echo "<script>alert('Data berhasil disimpan'); window.location.href='?page=buku';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }
}
?>
