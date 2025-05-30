<a href="?page=transaksi&aksi=tambah" class="btn btn-primary" style="margin-bottom: 5px;">Add Transaksi</a>

   <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Transaksi

 </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Id Transaksi</th>
                                            <th>Nama</th>
                                            <th>Judul Buku</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Waktu Pengembalian</th>
                                            <th>Tanggal Kembali</th>
                                            <th>Terlambat</th>
                                            <th>Status</th>
                                            <th> Aksi </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
$no = 1;
$sql = $koneksi->query("SELECT * FROM tb_transaksi");
while ($data = $sql->fetch_assoc()) {

    // Hitung keterlambatan
    $terlambat = 0;
    if (!empty($data['tanggal_pengembalian']) && strtotime($data['tanggal_pengembalian']) > strtotime($data['tanggal_kembali'])) {
        $terlambat = (strtotime($data['tanggal_pengembalian']) - strtotime($data['tanggal_kembali'])) / (60 * 60 * 24);
    }
?>
<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $data['id_transaksi']; ?></td>
    <td><?php echo $data['nama']; ?></td>
    <td><?php echo $data['judul_buku']; ?></td>
    <td><?php echo $data['tanggal_pinjam']; ?></td>
    <td><?php echo $data['tanggal_kembali']; ?></td>
    <td><?php echo $data['tanggal_pengembalian']; ?></td>
    <td><?php echo $terlambat . ' hari'; ?></td>
    <td><?php echo $data['status']; ?></td>
    <td>
        <a href="?page=transaksi&aksi=edit&id_transaksi=<?php echo $data['id_transaksi']; ?>" class="btn btn-info">Edit</a>
        <a onclick="return confirm('anda yakin akan menghapus Data ini...???')" href="?page=transaksi&aksi=hapus&id_transaksi=<?php echo $data['id_transaksi']; ?>" class="btn btn-danger">Hapus</a>
    </td>
</tr>
<?php } ?>
