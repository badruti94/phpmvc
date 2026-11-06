<?php
declare(strict_types=1);

class Mahasiswa extends Controller
{
    public function index(): void {
        $data["judul"] = "Daftar Mahasiswa";
        $data["mhs"] = $this->model("Mahasiswa_model")->getAllMahasiswa();
        $this->view("templates/header", $data);
        $this->view("mahasiswa/index", $data);
        $this->view("templates/footer");
    }

    public function detail(string $id): void {
        $data["judul"] = "Detail Mahasiswa";
        $data["mhs"] = $this->model("Mahasiswa_model")->getMahasiswaById((int) $id);

        if ($data["mhs"] === false) {
            if (!headers_sent()) {
                http_response_code(404);
            }
            $data["mhs"] = null;
        }

        $this->view("templates/header", $data);
        $this->view("mahasiswa/detail", $data);
        $this->view("templates/footer");
    }

    public function tambah(): void {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $input = $this->ambilInput();
            $pesanError = $this->validasi($input);

            if ($pesanError !== null) {
                $data["judul"] = "Tambah Mahasiswa";
                $data["error"] = $pesanError;
                $this->view("templates/header", $data);
                $this->view("mahasiswa/tambah", $data);
                $this->view("templates/footer");
                return;
            }

            try {
                $this->model("Mahasiswa_model")->tambahDataMahasiswa($input);
                Flasher::setFlash("berhasil", "ditambahkan", "success");
            } catch (PDOException $e) {
                Flasher::setFlash("gagal", "ditambahkan — NRP " . $input["nrp"] . " sudah dipakai", "danger");
            }

            header("Location: " . BASEURL . "/mahasiswa");
            exit;
        }

        $data["judul"] = "Tambah Mahasiswa";
        $this->view("templates/header", $data);
        $this->view("mahasiswa/tambah", $data);
        $this->view("templates/footer");
    }

    /** GET: tampilkan form ubah. POST: simpan perubahan. */
    public function ubah(string $id): void {
        $model = $this->model("Mahasiswa_model");
        $mhs = $model->getMahasiswaById((int) $id);

        if ($mhs === false) {
            $this->error(404, "Mahasiswa dengan id " . (int) $id . " tidak ditemukan.");
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $input = $this->ambilInput();
            $pesanError = $this->validasi($input);

            if ($pesanError === null) {
                try {
                    $model->ubahDataMahasiswa($input + ["id" => (int) $id]);
                    Flasher::setFlash("berhasil", "diubah", "success");
                    header("Location: " . BASEURL . "/mahasiswa");
                    exit;
                } catch (PDOException $e) {
                    // paling sering: nrp UNIQUE milik mahasiswa lain
                    $pesanError = "NRP " . $input["nrp"] . " sudah dipakai mahasiswa lain.";
                }
            }

            // validasi gagal / NRP bentrok -> tampilkan form lagi beserta isian terakhir
            $data["judul"] = "Ubah Mahasiswa";
            $data["error"] = $pesanError;
            $data["mhs"] = array_merge($mhs, $input);
            $this->view("templates/header", $data);
            $this->view("mahasiswa/ubah", $data);
            $this->view("templates/footer");
            return;
        }

        $data["judul"] = "Ubah Mahasiswa";
        $data["mhs"] = $mhs;
        $this->view("templates/header", $data);
        $this->view("mahasiswa/ubah", $data);
        $this->view("templates/footer");
    }

    /** Hapus hanya lewat POST — supaya tidak bisa terhapus oleh link/prefetch browser. */
    public function hapus(string $id): void {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            $this->error(405, "Hapus data hanya boleh dikirim lewat form (POST), bukan lewat alamat URL.");
            return;
        }

        $model = $this->model("Mahasiswa_model");

        if ($model->getMahasiswaById((int) $id) === false) {
            Flasher::setFlash("gagal", "dihapus — data tidak ditemukan", "danger");
        } else {
            $model->hapusDataMahasiswa((int) $id);
            Flasher::setFlash("berhasil", "dihapus", "success");
        }

        header("Location: " . BASEURL . "/mahasiswa");
        exit;
    }

    /** Ambil dan rapikan input form. */
    private function ambilInput(): array {
        return [
            "nama" => trim($_POST["nama"] ?? ""),
            "nrp" => trim($_POST["nrp"] ?? ""),
            "email" => trim($_POST["email"] ?? ""),
            "jurusan" => trim($_POST["jurusan"] ?? ""),
        ];
    }

    /** @return string|null pesan error, atau null kalau input valid */
    private function validasi(array $input): ?string {
        if ($input["nama"] === "" || $input["nrp"] === "" || $input["jurusan"] === "") {
            return "Lengkapi semua field terlebih dahulu.";
        }

        if (!filter_var($input["email"], FILTER_VALIDATE_EMAIL)) {
            return "Email tidak valid.";
        }

        return null;
    }
}
