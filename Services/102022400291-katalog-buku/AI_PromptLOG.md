# AI Prompt Log

## Identitas Mahasiswa

* Nama: Arief Rachmad Busviandri
* NIM: 102022400291
* Service: Katalog Buku

---

## Prompt 1

**Tujuan:** Membuat REST API Katalog Buku menggunakan Laravel.

**Prompt:**

> Buatkan REST API Katalog Buku menggunakan Laravel dengan endpoint GET semua buku, GET buku berdasarkan ID, dan POST tambah buku.

**Hasil:**

* Endpoint GET /api/v1/catalog/books
* Endpoint GET /api/v1/catalog/books/{id}
* Endpoint POST /api/v1/catalog/books

---

## Prompt 2

**Tujuan:** Membuat dokumentasi API menggunakan Swagger.

**Prompt:**

> Buatkan dokumentasi Swagger menggunakan L5-Swagger untuk endpoint Katalog Buku.

**Hasil:**

* Swagger berhasil diakses melalui:

  * http://127.0.0.1:8000/api/documentation
* Seluruh endpoint REST API terdokumentasi.

---

## Prompt 3

**Tujuan:** Mengimplementasikan GraphQL.

**Prompt:**

> Buatkan implementasi GraphQL untuk mengambil data buku yang sama seperti REST API.

**Hasil:**

* Membuat BookType
* Membuat BooksQuery
* Konfigurasi GraphQL berhasil dijalankan
* Query books dapat diakses melalui endpoint /graphql

---

## Prompt 4

**Tujuan:** Memperbaiki error GraphQL.

**Prompt:**

> Bantu memperbaiki error konfigurasi GraphQL pada Laravel.

**Hasil:**

* Memperbaiki struktur folder GraphQL
* Memperbaiki konfigurasi graphql.php
* GraphQL berhasil mengembalikan data buku

---

## Prompt 5

**Tujuan:** Menambahkan API Key Security.

**Prompt:**

> Implementasikan API Key Security menggunakan Middleware Laravel.

**Hasil:**

* Membuat ApiKeyMiddleware
* Menambahkan validasi header X-IAE-KEY
* Request tanpa API Key menghasilkan status 401 Unauthorized
* Request dengan API Key valid berhasil mengakses data

---

## Hasil Akhir

Service Katalog Buku berhasil diimplementasikan dengan fitur:

1. REST API
2. Swagger/OpenAPI Documentation
3. GraphQL Query
4. API Key Security

Status pengerjaan: Selesai.


# Prompt Log Tugas 3 - The Enterprise Digital City

## Prompt 1

Analisis dokumen Tugas 3 dan jelaskan kebutuhan sistem yang harus diimplementasikan berdasarkan kontrak integrasi yang diberikan.

## Prompt 2

Buatkan langkah-langkah pengerjaan Tugas 3 secara bertahap mulai dari pembuatan project Laravel hingga pengujian endpoint.

## Prompt 3

Buatkan struktur folder project Laravel yang sesuai untuk implementasi service Katalog Buku.

## Prompt 4

Buatkan endpoint REST API sesuai spesifikasi kontrak integrasi yang diberikan pada Tugas 3.

## Prompt 5

Buatkan middleware autentikasi API Key menggunakan header `X-IAE-KEY`.

## Prompt 6

Buatkan dokumentasi Swagger/OpenAPI menggunakan PHP Attributes untuk seluruh endpoint yang tersedia.

## Prompt 7

Buatkan implementasi SOAP Audit Service untuk mencatat aktivitas ketika terjadi proses penambahan data buku.

## Prompt 8

Buatkan implementasi RabbitMQ Service untuk mengirim event `book.created` sesuai kebutuhan integrasi enterprise.

## Prompt 9

Bantu memperbaiki error Laravel terkait namespace, autoloading, dan pemanggilan class service.

## Prompt 10

Bantu menganalisis error HTTP 401, HTTP 500, dan error integrasi service yang muncul saat pengujian API.

## Prompt 11

Buatkan Sequence Diagram yang menggambarkan alur proses penambahan data buku mulai dari client hingga integrasi SOAP dan RabbitMQ.

## Prompt 12

Buatkan README.md yang berisi identitas, deskripsi service, endpoint, cara menjalankan aplikasi, dan hasil pengujian.

## Prompt 13

Buatkan ANALISIS.md yang menjelaskan kebutuhan sistem, arsitektur aplikasi, integrasi service, endpoint API, dan kesimpulan implementasi.

## Prompt 14

Bantu melakukan pengujian endpoint menggunakan Swagger UI dan menjelaskan hasil response yang diperoleh.

## Prompt 15

Berikan panduan melakukan commit dan push project ke repository GitHub beserta dokumentasi yang diperlukan untuk pengumpulan tugas.
