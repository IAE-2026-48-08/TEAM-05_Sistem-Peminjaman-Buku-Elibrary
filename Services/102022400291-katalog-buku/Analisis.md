# ANALISIS.md

# Analisis Service 1 - Katalog Buku

## Identitas

* Nama : Arief Rachmad Busviandri
* NIM : 102022400291
* Service : Katalog Buku

---

# Deskripsi Layanan

Service Katalog Buku merupakan REST API yang digunakan untuk menyediakan informasi katalog buku. Service ini memungkinkan pengguna untuk melihat daftar buku, melihat detail buku berdasarkan ID, dan menambahkan data buku baru.

Service dikembangkan menggunakan framework Laravel dan didokumentasikan menggunakan OpenAPI/Swagger.

---

# Analisis Kebutuhan

Berdasarkan kontrak integrasi yang diberikan, Service Katalog Buku harus menyediakan beberapa endpoint utama:

1. Mendapatkan seluruh data buku.
2. Mendapatkan detail buku berdasarkan ID.
3. Menambahkan data buku baru.
4. Menggunakan API Key sebagai mekanisme autentikasi.
5. Mendukung integrasi SOAP Audit Service.
6. Mendukung integrasi RabbitMQ untuk event publishing.

---

# Analisis Endpoint

## GET /api/v1/catalog/books

### Tujuan

Mengambil seluruh data buku yang tersedia dalam katalog.

### Input

Tidak memerlukan parameter.

### Output

Daftar buku dalam format JSON.

### Status Code

* 200 OK

---

## GET /api/v1/catalog/books/{id}

### Tujuan

Mengambil detail buku berdasarkan ID.

### Input

Parameter ID buku.

### Output

Data buku yang sesuai.

### Status Code

* 200 OK
* 401 Book Not Found

---

## POST /api/v1/catalog/books

### Tujuan

Menambahkan data buku baru.

### Proses

1. Request diterima oleh BookController.
2. Sistem melakukan pencatatan audit menggunakan SoapAuditService.
3. Sistem mengirim event ke RabbitMQ menggunakan RabbitMqService.
4. Sistem mengembalikan response berhasil.

### Status Code

* 201 Created

---

# Analisis Arsitektur

Sistem menggunakan pendekatan REST API dengan komponen sebagai berikut:

### Client

Mengirim request ke endpoint API.

### API Gateway

Middleware API Key digunakan untuk memvalidasi akses pengguna.

### Controller

BookController bertanggung jawab memproses request dan menghasilkan response.

### Service Layer

Terdiri dari:

* SoapAuditService
* RabbitMqService

Service layer digunakan untuk memisahkan logika integrasi dari controller.

---

# Integrasi SOAP Audit Service

SOAP Audit Service digunakan untuk mencatat aktivitas ketika terjadi penambahan data buku.

Implementasi dilakukan melalui:

```php
SoapAuditService::send();
```

Tujuan integrasi ini adalah memastikan setiap aktivitas penting dapat diaudit.

---

# Integrasi RabbitMQ

RabbitMQ digunakan untuk mengirim event ketika data buku berhasil dibuat.

Implementasi dilakukan melalui:

```php
RabbitMqService::publish();
```

Event yang dikirim:

```json
{
    "event": "book.created"
}
```

Tujuan penggunaan RabbitMQ adalah mendukung komunikasi antar service secara asynchronous.

---

# Sequence Diagram

# ANALISIS.md

# Analisis Service 1 - Katalog Buku

## Identitas

* Nama : Arief Rachmad Busviandri
* NIM : 102022400291
* Service : Katalog Buku

---

# Deskripsi Layanan

Service Katalog Buku merupakan REST API yang digunakan untuk menyediakan informasi katalog buku. Service ini memungkinkan pengguna untuk melihat daftar buku, melihat detail buku berdasarkan ID, dan menambahkan data buku baru.

Service dikembangkan menggunakan framework Laravel dan didokumentasikan menggunakan OpenAPI/Swagger.

---

# Analisis Kebutuhan

Berdasarkan kontrak integrasi yang diberikan, Service Katalog Buku harus menyediakan beberapa endpoint utama:

1. Mendapatkan seluruh data buku.
2. Mendapatkan detail buku berdasarkan ID.
3. Menambahkan data buku baru.
4. Menggunakan API Key sebagai mekanisme autentikasi.
5. Mendukung integrasi SOAP Audit Service.
6. Mendukung integrasi RabbitMQ untuk event publishing.

---

# Analisis Endpoint

## GET /api/v1/catalog/books

### Tujuan

Mengambil seluruh data buku yang tersedia dalam katalog.

### Input

Tidak memerlukan parameter.

### Output

Daftar buku dalam format JSON.

### Status Code

* 200 OK

---

## GET /api/v1/catalog/books/{id}

### Tujuan

Mengambil detail buku berdasarkan ID.

### Input

Parameter ID buku.

### Output

Data buku yang sesuai.

### Status Code

* 200 OK
* 401 Book Not Found

---

## POST /api/v1/catalog/books

### Tujuan

Menambahkan data buku baru.

### Proses

1. Request diterima oleh BookController.
2. Sistem melakukan pencatatan audit menggunakan SoapAuditService.
3. Sistem mengirim event ke RabbitMQ menggunakan RabbitMqService.
4. Sistem mengembalikan response berhasil.

### Status Code

* 201 Created

---

# Analisis Arsitektur

Sistem menggunakan pendekatan REST API dengan komponen sebagai berikut:

### Client

Mengirim request ke endpoint API.

### API Gateway

Middleware API Key digunakan untuk memvalidasi akses pengguna.

### Controller

BookController bertanggung jawab memproses request dan menghasilkan response.

### Service Layer

Terdiri dari:

* SoapAuditService
* RabbitMqService

Service layer digunakan untuk memisahkan logika integrasi dari controller.

---

# Integrasi SOAP Audit Service

SOAP Audit Service digunakan untuk mencatat aktivitas ketika terjadi penambahan data buku.

Implementasi dilakukan melalui:

```php
SoapAuditService::send();
```

Tujuan integrasi ini adalah memastikan setiap aktivitas penting dapat diaudit.

---

# Integrasi RabbitMQ

RabbitMQ digunakan untuk mengirim event ketika data buku berhasil dibuat.

Implementasi dilakukan melalui:

```php
RabbitMqService::publish();
```

Event yang dikirim:

```json
{
    "event": "book.created"
}
```

Tujuan penggunaan RabbitMQ adalah mendukung komunikasi antar service secara asynchronous.

---

# Sequence Diagram

![alt text](<Sequence Diagram1 iae.jpg>)

---

# Kesimpulan

Service Katalog Buku telah berhasil menyediakan endpoint sesuai kebutuhan integrasi. Service mendukung autentikasi menggunakan API Key, dokumentasi Swagger/OpenAPI, integrasi SOAP Audit Service untuk pencatatan aktivitas, serta RabbitMQ untuk pengiriman event. Dengan implementasi tersebut, service telah memenuhi kebutuhan dasar arsitektur Enterprise Application Integration (EAI).

---

# Kesimpulan

Service Katalog Buku telah berhasil menyediakan endpoint sesuai kebutuhan integrasi. Service mendukung autentikasi menggunakan API Key, dokumentasi Swagger/OpenAPI, integrasi SOAP Audit Service untuk pencatatan aktivitas, serta RabbitMQ untuk pengiriman event. Dengan implementasi tersebut, service telah memenuhi kebutuhan dasar arsitektur Enterprise Application Integration (EAI).
      