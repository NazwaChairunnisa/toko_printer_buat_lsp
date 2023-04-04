<?php include 'layout/navbar.php'; ?>
<?php
if (empty($_SESSION["cart"] || isset($_SESSION["cart"]))) {
    echo "
    <script type='text/javascript'>
        alert('Keranjang Anda Masih Kosong, Silahkan Belanja Terlebih Dahulu');
        window.location = 'index.php'
    </script>";
}
?>

<div class="keranjang-belanja container">
    <h2>Keranjang Belanja</h2>
    <table class=table table-responsive table-hover>
        <tr>
            <th>Foto</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Quantity</th>
            <th>Total Harga</th>
            <th>Aksi</th>
        </tr>
        <?php $gradTotal = 0; ?>
        <?php foreach ($_SESSION["cart"] as $id_produk => $kuantitas) : ?>
            <?php
            $data = query("SELECT * FROM produk WHERE id_produk = '$id_produk'")[0];
            $totalHarga = $data["harga"] * $kuantitas;
            $gradTotal += $totalHarga;
            ?>
            <tr>
                <td><img src="image/<?= $data["foto"]; ?>" width="100"></td>
                <td><?= $data["nama_produk"]; ?></td>
                <td><?= number_format($data["harga"])?></td>
                <td><?= $kuantitas; ?></td>
                <td><?= number_format($totalHarga); ?></td>
                <div class="text-primary me-2">
                <td><a href="hapuskeranjang.php?id=<?= $data["id_produk"]; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data?');"><i class="fa-solid fa-trash"></i></a>
                      <div class="text-danger">
                        <a href="editkeranjang.php?id=<?= $data["id_produk"]; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data?');"><i class="fa-solid fa-pen"></i></a</td>
                    </tr>
                    <?php endforeach; ?>
                <tr>
                    <td colspan="6">
                        <h4>Grand Total
                            <p>Rp. <?= number_format($gradTotal); ?></p>
                        </h4>
                    </td>
                </tr>
            </table>
            <a class="btn btn-primary" href="checkout.php">checkout</a>
        </div>
    </div>
        
    </div>
        <?php include 'layout/footer.php'; ?>