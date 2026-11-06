<?php
declare(strict_types=1);

class Home extends Controller
{
    public function index(): void {
        $data["judul"] = "Halaman Home";
        $data["mhs"] = $this->model("Mahasiswa_model")->getAllMahasiswa();
        $this->view("templates/header", $data);
        $this->view("home/index", $data);
        $this->view("templates/footer");
    }

    public function detail(string $id): void {
        $data["judul"] = "Detail Mahasiswa";
        // (int) wajib: strict_types aktif, sedangkan parameter model bertipe int
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
}
