<?php 
session_start();
if(!empty($_SESSION['admin'])){
	require '../../config.php';
	if(!empty($_GET['pengaturan'])){
		$nama= htmlentities($_POST['namatoko']);
		$alamat = htmlentities($_POST['alamat']);
		$kontak = htmlentities($_POST['kontak']);
		$pemilik = htmlentities($_POST['pemilik']);
		$id = '1';
		
		$data[] = $nama;
		$data[] = $alamat;
		$data[] = $kontak;
		$data[] = $pemilik;
		$data[] = $id;
		$sql = 'UPDATE toko SET nama_toko=?, alamat_toko=?, tlp=?, nama_pemilik=? WHERE id_toko = ?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=pengaturan&success=edit-data"</script>';
	}

	if(!empty($_GET['kategori'])){
		$nama= htmlentities($_POST['kategori']);
		$id= htmlentities($_POST['id']);
		$data[] = $nama;
		$data[] = $id;
		$sql = 'UPDATE kategori SET  nama_kategori=? WHERE id_kategori=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=kategori&uid='.$id.'&success-edit=edit-data"</script>';
	}

	if(!empty($_GET['stok'])){
		$restok = htmlentities($_POST['restok']);
		$id = htmlentities($_POST['id']);
		$dataS[] = $id;
		$sqlS = 'select*from barang WHERE id_barang=?';
		$rowS = $config -> prepare($sqlS);
		$rowS -> execute($dataS);
		$hasil = $rowS -> fetch();
		
		$stok = $restok + $hasil['stok'];
		
		$data[] = $stok;
		$data[] = $id;
		$sql = 'UPDATE barang SET stok=? WHERE id_barang=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=barang&success-stok=stok-data"</script>';
	}

	if(!empty($_GET['barang'])){
		$id = htmlentities($_POST['id']);
		$kategori = htmlentities($_POST['kategori']);
		$nama = htmlentities($_POST['nama']);
		$jenis = htmlentities($_POST['jenis']);
		$ukuran = htmlentities($_POST['ukuran']);
		$harga = htmlentities($_POST['harga']);
		$satuan = htmlentities($_POST['satuan']);
		$stok = htmlentities($_POST['stok']);
		$tgl = htmlentities($_POST['tgl']);
		
		$data[] = $kategori;
		$data[] = $nama;
		$data[] = $jenis;
		$data[] = $ukuran;
		$data[] = $harga;
		$data[] = $satuan;
		$data[] = $stok;
		$data[] = $tgl;
		$data[] = $id;
		$sql = 'UPDATE barang SET id_kategori=?, nama_barang=?, jenis=?, 
				ukuran=?, harga=?, satuan_barang=?, stok=?, tgl_update=?  WHERE id_barang=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=barang/edit&barang='.$id.'&success=edit-data"</script>';
	}

	if(!empty($_GET['gambar'])){
		$id = htmlentities($_POST['id']);
		set_time_limit(0);
		$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
		
		if ($_FILES['foto']["error"] > 0) {
			$output['error']= "Error in File";
		} elseif (!in_array($_FILES['foto']["type"], $allowedImageType)) {
			echo "You can only upload JPG, PNG and GIF file";
			echo "<font face='Verdana' size='2' ><BR><BR><BR>
					<a href='../../index.php?page=user'>Back to upform</a><BR>";

		}elseif (round($_FILES['foto']["size"] / 1024) > 4096) {
			echo "WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB";
			echo "<font face='Verdana' size='2' ><BR><BR><BR>
					<a href='../../index.php?page=user'>Back to upform</a><BR>";

		}else{
			$target_path = '../../assets/img/user/';
			$target_path = $target_path . basename( $_FILES['foto']['name']); 
			if (file_exists("$target_path")){ 
				echo "<font face='Verdana' size='2' >Ini Terjadi Karena Telah Masuk Nama File Yang Sama,
				<br> Silahkan Rename File terlebih dahulu<br>";

			echo "<font face='Verdana' size='2' ><BR><BR><BR>
					<a href='../../index.php?page=user'>Back to upform</a><BR>";

				}elseif(move_uploaded_file($_FILES['foto']['tmp_name'], $target_path)){
					//post foto lama
				$foto2 = $_POST['foto2'];
				//remove foto di direktori
				unlink('../../assets/img/user/'.$foto2.'');
				//input foto
				$id = $_POST['id'];
				$data[] = $_FILES['foto']['name'];
				$data[] = $id;
				$sql = 'UPDATE member SET gambar=?  WHERE member.id_member=?';
				$row = $config -> prepare($sql);
				$row -> execute($data);
				echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
			}
		}
	}

	if(!empty($_GET['profil'])){
		$id = htmlentities($_POST['id']);
		$nama = htmlentities($_POST['nama']);
		$alamat = htmlentities($_POST['alamat']);
		$tlp = htmlentities($_POST['tlp']);
		$email = htmlentities($_POST['email']);
		$nik = htmlentities($_POST['nik']);
		
		$data[] = $nama;
		$data[] = $alamat;
		$data[] = $tlp;
		$data[] = $email;
		$data[] = $nik;
		$data[] = $id;
		$sql = 'UPDATE member SET nm_member=?,alamat_member=?,telepon=?,email=?,NIK=? WHERE id_member=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
	}
	if(!empty($_GET['pass'])){
		$id = htmlentities($_POST['id']);
		$user = htmlentities($_POST['user']);
		$pass = htmlentities($_POST['pass']);
		
		$data[] = $user;
		$data[] = $pass;
		$data[] = $id;
		$sql = 'UPDATE login SET user=?,pass=md5(?) WHERE id_member=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
	}

	if(!empty($_GET['harga'])){
		$id = htmlentities($_POST['id']);
		$id_barang = htmlentities($_POST['id_barang']);
		$jumlah = htmlentities($_POST['jumlah']);
		
		$sql_tampil = "select *from barang where barang.id_barang=?";
		$row_tampil = $config -> prepare($sql_tampil);
		$row_tampil -> execute(array($id_barang));
		$hasil = $row_tampil -> fetch();

		if($hasil['stok'] > $jumlah)
		{
			$harga = $hasil['harga'];
			$total = $harga * $jumlah;
			$data1[] = $jumlah;
			$data1[] = $total;
			$data1[] = $id;
			$sql1 = 'UPDATE penjualan SET jumlah=?,total=? WHERE id_penjualan=?';
			$row1 = $config -> prepare($sql1);
			$row1 -> execute($data1);
			echo '<script>window.location="../../index.php?page=jual#keranjang"</script>';
		}else{
			echo '<script>alert("Keranjang Melebihi Stok Barang Anda !");
					window.location="../../index.php?page=jual#keranjang"</script>';
		}
		
	}

	if(!empty($_GET['cari_barang'])){
		$cari = trim(strip_tags($_POST['keyword']));
		if($cari == '')
		{

		}else{
			$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
					from barang inner join kategori on barang.id_kategori = kategori.id_kategori
					where barang.id_barang like '%$cari%' or barang.nama_barang like '%$cari%' or barang.jenis like '%$cari%'";
			$row = $config -> prepare($sql);
			$row -> execute();
			$hasil1= $row -> fetchAll();
	?>
		<table class="table table-stripped" width="100%" id="example2">
			<tr>
				<th>ID Barang</th>
				<th>Nama Barang</th>
				<th>Jenis</th>
				<th>Harga</th>
				<th>Aksi</th>
			</tr>
		<?php foreach($hasil1 as $hasil){?>
			<tr>
				<td><?php echo $hasil['id_barang'];?></td>
				<td><?php echo $hasil['nama_barang'];?></td>
				<td><?php echo $hasil['jenis'];?></td>
				<td><?php echo $hasil['harga'];?></td>
				<td>
				<a href="fungsi/tambah/tambah.php?jual=harga&id=<?php echo $hasil['id_barang'];?>&id_kasir=<?php echo $_SESSION['admin']['id_member'];?>" 
					class="btn btn-success">
					<i class="fa fa-shopping-cart"></i></a></td>
			</tr>
		<?php }?>
		</table>
<?php	
		}
	}
}
