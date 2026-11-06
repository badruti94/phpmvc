<?php
declare(strict_types=1);

class Controller
{
    /**
     * $data dibuat opsional supaya view tanpa data tetap bisa dirender:
     * $this->view("templates/footer") — dulu ini penyebab ArgumentCountError.
     */
    public function view(string $view, array $data = []): void {
        if(!preg_match("#^[A-Za-z0-9_/-]+$#", $view) || str_contains($view, "..")){
            $this->error(500, "Nama view tidak valid: {$view}");
            return;
        }

        $file = __DIR__ . "/../views/{$view}.php";

        if (!is_file($file)){
            $this->error(500, "View tidak ditemukan: {$view}");
            return;
        }

        require $file;
    }

    public function model(string $model): object {
        if(!preg_match("/^[A-Za-z0-9_]+$/", $model)){
            throw new RuntimeException("Nama model tidak valid: {$model}");
        }

        $file = __DIR__ . "/../models/{$model}.php";

        if(!is_file($file)){
            throw new RuntimeException("Model tidak ditemukan: {$model}");
        }

        require_once $file;
        return new $model();
    }

    protected function error(int $kode, string $pesan): void {
        // http_response_code() hanya boleh dipanggil selama header belum terkirim,
        // kalau tidak PHP cuma memunculkan warning.
        if(!headers_sent()){
            http_response_code($kode);
        }

        // Pakai view khusus kode tersebut kalau ada, kalau tidak pakai view umum.
        foreach ([$kode, "generic"] as $nama) {
            $file = __DIR__ . "/../views/errors/{$nama}.php";
            if(is_file($file)){
                require $file;
                return;
            }
        }

        echo "<p>" . htmlspecialchars($pesan, ENT_QUOTES, "UTF-8") . "</p>";
    }
}
