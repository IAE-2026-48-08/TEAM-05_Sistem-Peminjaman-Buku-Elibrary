# Resume Kontribusi Tim — TEAM-05 Sistem Peminjaman Buku Elibrary

Dokumen ini merupakan rangkuman kontribusi pengerjaan coding, integrasi, dan pembagian tugas untuk setiap anggota kelompok TEAM-05 dalam penyusunan Tugas Besar Integrasi Sistem Enterprise.

---

## 1. Rosi Rahmawati (NIM: 102022400314)

* **Peran Utama:** Penanggung Jawab Service Peminjaman & Integrator API Gateway Nginx & Docker Network
* **Kontribusi Teknis:**
  * Mengembangkan modul core **Peminjaman Buku** (Laravel).
  * Mengonfigurasi dockerization (`Dockerfile` dan `docker-compose.yml`) serta skema database SQLite awal untuk pencatatan transaksi peminjaman.
  * Mengintegrasikan Service Peminjaman Buku agar terhubung dengan API Gateway Nginx kelompok:
    * Menambahkan route `/loan/` pada Nginx gateway (`gateway/nginx.conf`).
    * Menghubungkan alur transaksi peminjaman ke Service Keanggotaan untuk memvalidasi status keaktifan anggota via REST API internal (`GET /api/members/{id}/status`).
    * Mengintegrasikan autentikasi dual-layer JWT (Federated SSO IAE) dan API Key.
  * Membuat mekanisme SOAP Audit Transaction Client untuk mencatat histori log peminjaman buku ke server legacy IAE Central SOAP.
  * Mengimplementasikan AMQP Publisher untuk mengirimkan notification event (`loan.created`) secara asinkron ke RabbitMQ message broker.
  * Mengonfigurasi visualisasi Diagram Sequence dan dokumentasi Swagger/OpenAPI lengkap.
  * **Mengonsolidasikan Seluruh Microservices Kelompok:** Mengintegrasikan semua service kelompok ke dalam satu berkas `docker-compose.yml` terpadu dengan Docker bridge network terisolasi untuk mencegah bypass gateway, menyelesaikan konflik port, dan menyederhanakan deployment.

---

## 2. Arief Rachmad Busviandri (NIM: 102022400291)

* **Peran Utama:** Penanggung Jawab Service Katalog Buku
* **Kontribusi Teknis:**
  * Mengembangkan modul core **Katalog Buku** (Laravel).
  * Membuat database migration, model Book, dan data seeding.
  * Implementasi REST API untuk manajemen buku (GET, POST).
  * Implementasi API query dengan GraphQL (Lighthouse).
  * Menghubungkan service Katalog Buku dengan Service Keanggotaan.
  * Mengonfigurasi event publisher dengan RabbitMQ (RabbitMqService) dan SOAP Audit.

---

## 3. Veraldo Bahriansyah (NIM: 102022400180)

* **Peran Utama:** Penanggung Jawab Service Keanggotaan
* **Kontribusi Teknis:**
  * Mengembangkan modul core **Keanggotaan/Member** (Laravel).
  * Membuat API endpoint keanggotaan (`GET /members/{id}`, `GET /members/{id}/status`, `POST /members`) untuk validasi status user oleh service lain.
  * Mengintegrasikan verifikasi token JWT Federated SSO IAE dengan public key (JWKS).
  * Membuat SOAP Audit Client untuk logging aktivitas registrasi member.
  * Mengimplementasikan AMQP Publisher untuk mempublikasikan event registrasi member (`member.registered`).
  * Menyusun dokumentasi swagger API untuk Service Keanggotaan.

---

## Ringkasan Keseluruhan

| Contributor | NIM | Peran Utama | Jumlah Commit | Area Kontribusi |
|-------------|-----|-------------|---------------|-----------------|
| **Rosi Rahmawati** | 102022400314 | Penanggung Jawab Service Peminjaman & Integrator Gateway | 16 | Peminjaman Service, Nginx API Gateway, Docker Network, SSO M2M, SOAP XML Audit, RabbitMQ Event Publisher |
| **Arief Rachmad Busviandri** | 102022400291 | Penanggung Jawab Service Katalog Buku | 6 | Katalog Service, GraphQL API, RabbitMQ Event Publisher, SOAP Audit |
| **Veraldo Bahriansyah** | 102022400180 | Penanggung Jawab Service Keanggotaan | 3 (Git: *Rafly Zulfikar Al Kautsar*) | Keanggotaan Service, SSO Federated JWT, SOAP XML Audit, RabbitMQ Event Publisher |

*Catatan: Total commit kelompok di repositori GitHub adalah 25 commit (16 Rosi, 6 Arief, 3 Veraldo via akun Rafly).*
