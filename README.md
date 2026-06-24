# TEAM-05 — Sistem Peminjaman Buku E-Library
## Enterprise Application Integration (IAE) final Project — SI-48-08

Repositori ini menggabungkan seluruh layanan (*microservices*) individu untuk sistem Peminjaman Buku E-Library, terintegrasi di belakang API Gateway Nginx tunggal dan terhubung ke infrastruktur pusat IAE Central (SSO, SOAP, RabbitMQ).

---

## Anggota Kelompok

1. **Arief Rachmad Busviandri** (NIM: 102022400291) — **Service 1: Katalog Buku**
2. **Rosi Rahmawati** (NIM: 102022400314) — **Service 2: Peminjaman & Integrator Gateway**
3. **Veraldo Bahriansyah** (NIM: 102022400180) — **Service 3: Keanggotaan**

---

## Struktur Project Monorepo

```
TEAM-05_Sistem-Peminjaman-Buku-Elibrary/
├── Services/
│   ├── 102022400180-keanggotaan-service/  # Service Keanggotaan (Veraldo)
│   ├── 102022400291-katalog-buku/          # Service Katalog Buku (Arief)
│   └── 102022400314-peminjaman-service/    # Service Peminjaman (Rosi)
├── gateway/
│   └── nginx.conf                         # API Gateway Nginx Configuration
├── docker-compose.yml                     # Gateway orchestrator Docker compose
├── README.md                              # Root documentation
├── resume_kontribusi.md                   # Team contribution resume report
└── log_prompt_102022400314.md             # Rosi's Prompt Engineering log
```

---

## Konfigurasi API Gateway & Routing Hub

API Gateway Nginx bertindak sebagai gerbang tunggal yang terekspos ke luar pada port **`9090`**. API Gateway merutekan request secara internal menggunakan DNS Docker ke masing-masing container:

* **`/member/`** $\rightarrow$ Diarahkan secara internal ke container `keanggotaan-service` (Port `8000`)
* **`/catalog/`** $\rightarrow$ Diarahkan secara internal ke container `katalog-buku` (Port `8000`)
* **`/loan/`** $\rightarrow$ Diarahkan secara internal ke container `peminjaman-service` (Port `80`)

> [!NOTE]
> Semua port internal service di atas disembunyikan (tidak dipetakan ke host) untuk mencegah pemintasan (*bypass*) gateway secara langsung dari luar Docker.

---

## Cara Menjalankan Aplikasi

1. **Jalankan Seluruh Stack Aplikasi:**
   Buka terminal di root directory kelompok (`TEAM-05_Sistem-Peminjaman-Buku-Elibrary`) dan jalankan perintah:
   ```bash
   docker-compose up -d --build
   ```
   *Perintah ini secara otomatis akan mengunduh, membangun, dan menyalakan Nginx API Gateway beserta ketiga service tim.*

2. **Akses API Melalui Gateway:**
   Gunakan HTTP client (Postman/cURL) untuk memanggil service melalui port gateway `9090`:
   ```bash
   GET http://localhost:9090/loan/api/v1/loans -H "X-IAE-KEY: 102022400314"
   ```
