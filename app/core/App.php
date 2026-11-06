<?php
declare(strict_types=1);

class App
{
    // Hanya menyimpan NAMA kelas (string).
    // Object controller disimpan di variabel lokal $objek — jangan pernah
    // menugaskan object ke properti ini (itu penyebab TypeError sebelumnya).
    protected $controller = "Home";
    protected string $method = "index";
    protected array $params = [];

    public function __construct(){
        $url = $this->parseURL();

        // 1. Tentukan controller dari segmen pertama URL
        if(!empty($url[0])){
            $namaController = ucfirst(strtolower((string) $url[0]));
            $berkas = __DIR__ . "/../controllers/{$namaController}.php";

            if(!preg_match("/^[A-Za-z0-9_]+$/", (string) $url[0]) || !is_file($berkas)){
                $this->error(404, "Controller \"" . $url[0] . "\" tidak ditemukan.");
                return;
            }

            $this->controller = $namaController;
            unset($url[0]);
        }

        require_once __DIR__ . "/../controllers/{$this->controller}.php";

        if(!class_exists($this->controller)){
            $this->error(500, "File app/controllers/{$this->controller}.php tidak berisi class {$this->controller}.");
            return;
        }

        // 2. Objek controller disimpan di variabel lokal, bukan di properti
        $namaKelas = $this->controller;
        $objek = new $namaKelas();

        // 3. Tentukan method — hanya method milik controller itu sendiri
        if(isset($url[1]) && !$this->methodBolehDipanggil($objek, (string) $url[1])){
            $this->error(404, "Method \"" . $url[1] . "\" tidak ada di controller {$this->controller}.");
            return;
        }

        if(isset($url[1])){
            $this->method = (string) $url[1];
            unset($url[1]);
        }

        $this->params = !empty($url) ? array_values($url) : [];

        // 4. Cukupkah jumlah parameternya?
        $ref = new ReflectionMethod($objek, $this->method);
        if(count($this->params) < $ref->getNumberOfRequiredParameters()){
            $this->error(404, "Parameter kurang untuk {$this->controller}::{$this->method}().");
            return;
        }

        call_user_func_array([$objek, $this->method], $this->params);
    }

    /**
     * Hanya izinkan method publik milik controller itu sendiri.
     * Tanpa ini ?url=home/view atau ?url=home/model bisa dipanggil dari URL,
     * karena keduanya diwarisi dari class Controller.
     */
    protected function methodBolehDipanggil(object $objek, string $method): bool
    {
        if(!preg_match("/^[A-Za-z_][A-Za-z0-9_]*$/", $method) || !method_exists($objek, $method)){
            return false;
        }

        $ref = new ReflectionMethod($objek, $method);

        return $ref->isPublic()
            && !$ref->isStatic()
            && $ref->getDeclaringClass()->getName() === get_class($objek);
    }

    protected function parseUrl(): array
    {
        // Sumber 1: ?url=home/detail/1  -> dari .htaccess (Apache/mod_rewrite)
        // Sumber 2: PATH_INFO           -> URL cantik di PHP built-in server
        //                                  (php -S localhost:3000 -t public)
        $url = $_GET["url"] ?? $_SERVER["PATH_INFO"] ?? "";
        $url = trim((string) $url, "/");

        if($url === ""){
            return [];
        }

        $url = (string) filter_var($url, FILTER_SANITIZE_URL);

        return explode("/", $url);
    }

    protected function error(int $kode, string $pesan): void
    {
        if(!headers_sent()){
            http_response_code($kode);
        }

        // Pakai view khusus kode tersebut kalau ada, kalau tidak pakai view umum.
        foreach ([$kode, "generic"] as $nama) {
            $berkas = __DIR__ . "/../views/errors/{$nama}.php";
            if(is_file($berkas)){
                require $berkas;
                return;
            }
        }

        echo "<h1>{$kode}</h1><p>" . htmlspecialchars($pesan, ENT_QUOTES, "UTF-8") . "</p>";
    }
}
