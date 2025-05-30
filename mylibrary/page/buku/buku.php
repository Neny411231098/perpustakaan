   <a href="?page=buku&aksi=tambah" class="btn btn-primary" style="margin-bottom: 5px;">Add Book</a>

   <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Buku

 </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Id Buku</th>
                                            <th>Judul Buku</th>
                                            <th>Pengarang</th>
                                            <th>Penerbit</th>
                                            <th>Tahun Terbit</th>
                                            <th>Stock</th>
                                            <th>Lokasi</th>
                                            <th>Tanggal input</th>
                                            <th> Aksi </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                            $no =1;

                                            $sql = $koneksi->query("select * from tb_buku");

                                            while ($data=$sql->fetch_assoc()) {

                                            
                                        ?>


                                        <tr>
                                             <td><?php echo $no++;?></td>
                                            <td><?php echo $data['id_buku'];?></td>
                                            <td><?php echo $data['judul_buku'];?></td>
                                            <td><?php echo $data['pengarang'];?></td>
                                            <td><?php echo $data['penerbit'];?></td>
                                            <td><?php echo $data['tahun_terbit'];?></td>
                                            <td><?php echo $data['jumlah_buku'];?></td>
                                            <td><?php echo $data['lokasi'];?></td>
                                            <td><?php echo $data['tanggal_input'];?></td>
                                            <td>
                                                <a href="?page=buku&aksi=edit&id_buku=<?php echo $data['id_buku']; ?>" class="btn btn-info">Edit</a>
                                                 <a onclick="return confirm('anda yakin akan menghapus Data ini...???')" href="?page=buku&aksi=hapus&id_buku=<?php echo $data['id_buku']; ?>" class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                            

                                    <?php } ?>
                                    </tbody>

                                </div>
                            </div>
</div>


