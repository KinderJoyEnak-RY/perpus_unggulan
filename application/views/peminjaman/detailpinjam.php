<div class="box">
    <div class="box-header">
        <h3 class="box-title">Detail Pinjam Buku</h3>
    </div>
    <div class="box-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id Buku</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $data['id_buku']; ?></td>
                    <td><?= $data['judul_buku']; ?></td>
                    <td><?= $data['pengarang']; ?></td>
                    <td><?= $data['penerbit']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
