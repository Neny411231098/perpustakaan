   <a href="?page=anggota&aksi=tambah" class="btn btn-primary" style="margin-bottom: 5px;">Add Anggota</a>

   <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Anggota

 </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Id Anggota</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Nomor Telepon</th>
                                            <th> Aksi </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                            $no =1;

                                            $sql = $koneksi->query("select * from tb_anggota");

                                            while ($data=$sql->fetch_assoc()) {

                                            
                                        ?>


                                        <tr>
                                             <td><?php echo $no++;?></td>
                                            <td><?php echo $data['id_anggota'];?></td>
                                            <td><?php echo $data['nama'];?></td>
                                            <td><?php echo $data['alamat'];?></td>
                                            <td><?php echo $data['nomor_telepon'];?></td>
                                            <td>
                                                <a href="?page=anggota&aksi=edit&id_anggota=<?php echo $data['id_anggota']; ?>" class="btn btn-info">Edit</a>
                                                 <a onclick="return confirm('anda yakin akan menghapus Data ini...???')" href="?page=anggota&aksi=hapus&id_anggota=<?php echo $data['id_anggota']; ?>" class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                            

                                    <?php 
                                    }   
                                    ?>
                                    </tbody>

                                </div>
                            </div>
</div>


