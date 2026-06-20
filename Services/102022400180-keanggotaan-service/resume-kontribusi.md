# Resume Kontribusi Individu - Tugas Besar IAE

## Identitas

| Field | Keterangan |
|-------|------------|
| Nama | Veraldo Bahriansyah |
| NIM | 102022400180 |
| Kelas | SI4808 |
| Service | Service 3 - Keanggotaan |
| Repository | 102022400180_Keanggotaan-Service |

---

## Log Kontribusi

| Commit | Deskripsi | Keterangan |
|--------|-----------|------------|
| 828be17 | feat: initial keanggotaan service | Setup awal project Laravel 12, membuat model Member, migration, REST API 3 endpoint (GET /members/{id}, GET /members/{id}/status, POST /members), middleware CheckApiKey, response wrapper ApiResponse |
| d98cd47 | Update README with student details and prompts | Menambahkan identitas mahasiswa dan rekap prompt AI ke README |
| 6781dc2 | Rename README.md to LOG-PROMPT-AI.md | Mengubah nama file dokumentasi prompt AI |
| 0604367 | feat: implementasi tugas 3 SSO, SOAP, RabbitMQ | Implementasi Modul 1 Federated SSO (JWT verify + mapping role lokal), Modul 2 SOAP XML Client (audit transaksi + simpan ReceiptNumber), Modul 3 AMQP Publisher (publish event ke RabbitMQ via HTTP), setup GraphQL dengan Lighthouse, Swagger dokumentasi |
| 18a95c7 | Merge branch main | Merge perubahan dari remote ke local |
| 396efa3 | tambah nim di ssoservice | Menambahkan field NIM pada request body M2M token ke IAE SSO sesuai instruksi dosen |

---

## Ringkasan Kontribusi

### Tugas 2 - REST API & Dokumentasi
- Membuat project Laravel 12 dari scratch
- Implementasi 3 endpoint REST API Service Keanggotaan
- Membuat middleware CheckApiKey untuk keamanan API
- Membuat response wrapper ApiResponse sesuai Standard Integration Contract
- Setup Swagger/OpenAPI dokumentasi dengan L5-Swagger
- Implementasi GraphQL dengan Lighthouse + GraphQL Playground
- Containerisasi dengan Docker

### Tugas 3 - Integrasi Enterprise
- *Modul 1 (Federated SSO):* Integrasi dengan IAE SSO menggunakan JWT RS256, verifikasi public key via JWKS endpoint, mapping payload ke tabel lokal
- *Modul 2 (SOAP XML Client):* Transformasi data JSON ke XML Envelope, kirim audit ke IAE Central SOAP, simpan ReceiptNumber sebagai bukti transaksi
- *Modul 3 (AMQP Publisher):* Publish event member.registered ke RabbitMQ via HTTP API IAE Central dengan payload JSON
- Dokumentasi analisis transaksi kritis dan Sequence Diagram

---

## Teknologi yang Digunakan

| Teknologi | Kegunaan |
|-----------|----------|
| Laravel 12 | Backend framework |
| SQLite | Database |
| L5-Swagger | API Documentation |
| Lighthouse | GraphQL |
| Firebase JWT | JWT verification |
| PHP AMQP | RabbitMQ publisher |
| Docker | Containerisasi |
| IAE SSO | Federated authentication |
| SOAP/XML | Legacy audit system |
| RabbitMQ | Message broker |