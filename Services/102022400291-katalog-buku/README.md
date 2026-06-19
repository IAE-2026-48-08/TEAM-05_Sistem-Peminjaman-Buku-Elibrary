# Service 1 - Katalog Buku

## Identitas

* Nama : Arief Rachmad Busviandri
* NIM : 102022400291

---

## Deskripsi

Service Katalog Buku merupakan REST API sederhana yang menyediakan layanan untuk melihat daftar buku, melihat detail buku berdasarkan ID, dan menambahkan data buku.

Service ini dibangun menggunakan Laravel dan didokumentasikan menggunakan Swagger/OpenAPI.

---

## Teknologi yang Digunakan

* PHP 8.2
* Laravel 12
* Swagger / OpenAPI
* GraphQL
* SOAP Integration
* RabbitMQ Integration

---

## Authentication

Seluruh endpoint menggunakan API Key melalui header:

```http
X-IAE-KEY: 102022400291
```

---

## Base URL

```http
http://127.0.0.1:8000/api/v1/catalog
```

---

# Endpoint

## 1. Get All Books

### Request

```http
GET /books
```

### Response

```json
[
  {
    "id": 1,
    "title": "Laskar Pelangi",
    "author": "Andrea Hirata",
    "publisher": "Bentang",
    "year": 2005
  },
  {
    "id": 2,
    "title": "Bumi",
    "author": "Tere Liye",
    "publisher": "Gramedia",
    "year": 2014
  }
]
```

---

## 2. Get Book By ID

### Request

```http
GET /books/{id}
```

Contoh:

```http
GET /books/1
```

### Response

```json
{
  "id": 1,
  "title": "Laskar Pelangi",
  "author": "Andrea Hirata",
  "publisher": "Bentang",
  "year": 2005
}
```

### Response Jika Data Tidak Ditemukan

```json
{
  "message": "Book not found"
}
```

Status Code:

```http
401 Unauthorized
```

---

## 3. Create Book

### Request

```http
POST /books
```

### Response

```json
{
  "message": "Book created successfully",
  "data": []
}
```

Status Code:

```http
201 Created
```

---

# Integrasi Service

## SOAP Audit Service

Service menggunakan SOAP Audit Service untuk mencatat aktivitas ketika data buku ditambahkan.

File:

```text
app/Services/SoapAuditService.php
```

---

## RabbitMQ Service

Service menggunakan RabbitMQ untuk mengirim event ketika data buku berhasil dibuat.

File:

```text
app/Services/RabbitMqService.php
```

Event:

```json
{
  "event": "book.created"
}
```

---

# Menjalankan Project

## Install Dependency

```bash
composer install
```

## Generate Application Key

```bash
php artisan key:generate
```

## Jalankan Server

```bash
php artisan serve
```

## Generate Swagger Documentation

```bash
php artisan l5-swagger:generate
```

---

# Swagger Documentation

Akses dokumentasi API melalui:

```http
http://127.0.0.1:8000/api/documentation
```

---

# Struktur Project

```text
app
├── GraphQL
├── Http
│   ├── Controllers
│   └── Middleware
├── Models
├── Providers
└── Services
    ├── SoapAuditService.php
    └── RabbitMqService.php
```

---

# Hasil Pengujian

| Endpoint                   | Method | Status |
| -------------------------- | ------ | ------ |
| /api/v1/catalog/books      | GET    | 200    |
| /api/v1/catalog/books/{id} | GET    | 200    |
| /api/v1/catalog/books/{id} | GET    | 401    |
| /api/v1/catalog/books      | POST   | 201    |

---

# Repository

```text
102022400291_Katalog-Buku
```
