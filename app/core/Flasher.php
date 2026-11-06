<?php

class Flasher
{
 public static function setFlash(string $pesan, string $aksi, string $tipe): void
 {
 $_SESSION["flash"] = [
 "pesan" => $pesan,
 "aksi" => $aksi,
 "tipe" => $tipe,
 ];
 }
 public static function flash(): void
 {
 if (empty($_SESSION["flash"])) {
 return;
 }
 $flash = $_SESSION["flash"];
 $pesan = htmlspecialchars($flash["pesan"], ENT_QUOTES, "UTF-8");
 $aksi = htmlspecialchars($flash["aksi"], ENT_QUOTES, "UTF-8");
 $tipe = $flash["tipe"] === "danger" ? "danger" : "success";
 echo "<div class=\"alert alert-{$tipe}\">Data mahasiswa
<strong>{$pesan}</strong> {$aksi}.</div>";
 // Sekali tampil, langsung hapus — inilah yang membuatnya "flash".
 unset($_SESSION["flash"]);
 }
}