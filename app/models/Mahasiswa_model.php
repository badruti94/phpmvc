<?php
declare(strict_types=1);

class Mahasiswa_model
{
    private Database $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAllMahasiswa(): array {
        $this->db->query("SELECT * FROM mahasiswa ORDER BY nama ASC");
        return $this->db->resultSet();
    }

    public function getMahasiswaById(int $id) : array|false {
        $this->db->query("SELECT * FROM mahasiswa WHERE id = :id");
        $this->db->bind(":id", $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function tambahDataMahasiswa(array $data): int {
        $query = "INSERT INTO mahasiswa (nama, nrp, email, jurusan)
                                VALUES (:nama, :nrp, :email, :jurusan)
                                RETURNING id";
        $this->db->query($query);
        $this->db->bind(":nama", $data["nama"]);
        $this->db->bind(":nrp", $data["nrp"]);
        $this->db->bind(":email", $data["email"]);
        $this->db->bind(":jurusan", $data["jurusan"]);
        $this->db->execute();
        $baris = $this->db->fetchSingle();
        return (int) ($baris["id"] ?? 0);
    }

    /** Mengubah satu baris mahasiswa. Return jumlah baris yang terpengaruh. */
    public function ubahDataMahasiswa(array $data): int {
        $query = "UPDATE mahasiswa
                     SET nama = :nama,
                         nrp = :nrp,
                         email = :email,
                         jurusan = :jurusan
                   WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(":nama", $data["nama"]);
        $this->db->bind(":nrp", $data["nrp"]);
        $this->db->bind(":email", $data["email"]);
        $this->db->bind(":jurusan", $data["jurusan"]);
        $this->db->bind(":id", (int) $data["id"], PDO::PARAM_INT);
        $this->db->execute();
        return $this->db->rowCount();
    }

    /** Menghapus satu baris mahasiswa. Return jumlah baris yang terpengaruh. */
    public function hapusDataMahasiswa(int $id): int {
        $this->db->query("DELETE FROM mahasiswa WHERE id = :id");
        $this->db->bind(":id", $id, PDO::PARAM_INT);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
