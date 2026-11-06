-- Skema database aplikasi phpmvc (PostgreSQL)
--
-- Cara pakai:
--   createdb -h localhost -U postgres phpmvc        # kalau database belum ada
--   psql -h localhost -U postgres -d phpmvc -f schema.sql
--
-- Aman dijalankan berulang kali (IF NOT EXISTS + ON CONFLICT DO NOTHING).

CREATE TABLE IF NOT EXISTS mahasiswa (
    id          integer GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nama        varchar(100) NOT NULL,
    nrp         varchar(20)  NOT NULL UNIQUE,
    email       varchar(100) NOT NULL,
    jurusan     varchar(100) NOT NULL,
    dibuat_pada timestamp    DEFAULT CURRENT_TIMESTAMP
);

-- Data contoh
INSERT INTO mahasiswa (nama, nrp, email, jurusan) VALUES
    ('Andi Supardi', '1212001', 'andi@mail.to', 'Teknik Informatika')
ON CONFLICT (nrp) DO NOTHING;

-- Tambah baris contoh lain kalau perlu, contoh:
-- INSERT INTO mahasiswa (nama, nrp, email, jurusan) VALUES
--     ('Budi Santoso', '1212002', 'budi@mail.to', 'Sistem Informasi')
-- ON CONFLICT (nrp) DO NOTHING;
