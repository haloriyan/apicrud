<?php
include 'controller.php';

class users extends EMBO {
	public function info() {
		$id = EMBO::pos('id');

		$q = EMBO::tabel('user')->pilih()->dimana(['iduser' => $id])->eksekusi();
		$r = EMBO::ambil($q);
		echo json_encode($r);
	}
	public function show() {
		$q = EMBO::tabel('user')->pilih()->urutkan('added', 'DESC')->eksekusi();
		while($r = EMBO::ambil($q)) {
			$res[] = $r;
		}
		echo json_encode($res);
	}
	public function delete() {
		$id = EMBO::pos('id');
		return EMBO::tabel('user')->hapus()->dimana(['iduser' => $id])->eksekusi();
	}
	public function add() {
		$name = EMBO::pos('name');
		$email = EMBO::pos('email');
		$password = EMBO::pos('password');

		$add = EMBO::tabel('user')
					->tambah([
						'iduser'	=> rand(1, 999),
						'name'		=> $name,
						'email'		=> $email,
						'password'	=> $password,
						'added'		=> time()
					])
					->eksekusi();
		echo "200";
	}
	public function edit() {
		$id = EMBO::pos('id');

		$name = EMBO::pos('name');
		$email = EMBO::pos('email');

		$ubah = EMBO::tabel('user')
					->ubah([
						'name'	=> $name,
						'email'	=> $email
					])
					->dimana([
						'iduser' => $id
					])
					->eksekusi();
		if($ubah) {
			echo "200";
		}
	}
}

$users = new users();

?>