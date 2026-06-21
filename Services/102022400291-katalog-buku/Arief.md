# Resume Kontribusi Individu - Tugas Besar IAE

## Identitas

| Field      | Keterangan                |
| ---------- | ------------------------- |
| Nama       | Arief Rachmad Busviandri  |
| NIM        | 102022400291              |
| Kelas      | SI4808                    |
| Service    | Service 1 - Katalog Buku  |
| Repository | 102022400291_Katalog-Buku |

---

## Log Kontribusi

### 1. Implementasi REST API

* Membuat endpoint GET seluruh buku
* Membuat endpoint GET buku berdasarkan ID
* Membuat endpoint POST tambah buku
* Melakukan pengujian endpoint menggunakan browser/Postman

### 2. Implementasi Database

* Membuat migration tabel books
* Membuat model Book
* Membuat seeder data buku

### 3. Implementasi Swagger

* Menambahkan dokumentasi OpenAPI
* Menghasilkan endpoint dokumentasi pada `/docs`

### 4. Implementasi GraphQL

* Membuat BookType
* Membuat BooksQuery
* Mengaktifkan endpoint `/graphql`

### 5. Integrasi Antar Service

* Membuat MemberService.php
* Menghubungkan Service Katalog dengan Service Keanggotaan
* Mengambil status member melalui REST API

### 6. RabbitMQ

* Menambahkan RabbitMqService
* Menyiapkan publisher event

### 7. SOAP

* Menambahkan SoapAuditService
* Menyiapkan komunikasi SOAP untuk audit service

### 8. Pengujian

* Menguji endpoint REST API
* Menguji GraphQL Query
* Menguji integrasi antar-service
* Menguji Swagger Documentation

---

## Bukti Hasil

### REST API

* GET /api/v1/catalog/books
* GET /api/v1/catalog/books/{id}

### Swagger

* http://127.0.0.1:8000/docs

### GraphQL

* http://127.0.0.1:8000/graphql

### Integrasi Service

* GET /api/test-member/1

---

## Kesimpulan

Service Katalog Buku berhasil diimplementasikan menggunakan Laravel dengan dukungan REST API, Swagger/OpenAPI, GraphQL, SOAP Service, RabbitMQ, dan integrasi dengan Service Keanggotaan.
