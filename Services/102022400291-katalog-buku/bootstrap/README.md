# Service 1 - Katalog Buku

## Identitas

**Nama:** Arief Rachmad Busviandri

**NIM:** 102022400291

## Deskripsi

Katalog Buku Service merupakan layanan backend berbasis Laravel yang menyediakan API untuk mengelola data buku. Service ini dikembangkan sebagai bagian dari tugas Integrasi Aplikasi Enterprise (IAE).

## Teknologi yang Digunakan

* PHP 8.x
* Laravel 12
* MySQL
* Rebing GraphQL
* L5 Swagger
* Postman

## Fitur

### REST API

* Menampilkan seluruh data buku
* Menampilkan detail buku berdasarkan ID
* Menambahkan data buku baru

### GraphQL

Endpoint:

```http
POST /graphql
```

Query:

```graphql
{
  books {
    id
    title
    author
    publisher
    year
  }
}
```

### API Key Security

Seluruh endpoint REST dilindungi menggunakan API Key pada Header:

```http
X-IAE-KEY: 102022400291
```

Jika API Key tidak valid maka sistem akan mengembalikan:

```json
{
  "status": "error",
  "message": "Invalid API Key"
}
```

## REST API Endpoint

### GET Semua Buku

```http
GET /api/v1/catalog/books
```

Response:

```json
[
  {
    "id": 1,
    "title": "Laskar Pelangi",
    "author": "Andrea Hirata",
    "publisher": "Bentang",
    "year": 2005
  }
]
```

### GET Detail Buku

```http
GET /api/v1/catalog/books/{id}
```

Contoh:

```http
GET /api/v1/catalog/books/1
```

### POST Tambah Buku

```http
POST /api/v1/catalog/books
```

Body:

```json
{
  "title": "Negeri 5 Menara",
  "author": "Ahmad Fuadi",
  "publisher": "Gramedia",
  "year": 2009
}
```

Response:

```json
{
  "message": "Book created successfully",
  "data": {
    "title": "Negeri 5 Menara",
    "author": "Ahmad Fuadi",
    "publisher": "Gramedia",
    "year": 2009
  }
}
```

## Dokumentasi Swagger

Swagger UI tersedia pada:

```http
http://127.0.0.1:8000/api/documentation
```

## AI Prompt Log

Dokumentasi penggunaan AI selama pengembangan tersedia pada file:

```text
AI_PromptLOG.md
```

## Repository

Repository ini dibuat untuk memenuhi Tugas 2 Build Your Service pada mata kuliah Integrasi Aplikasi Enterprise (IAE).

## Status

✅ REST API selesai

✅ Swagger selesai

✅ GraphQL selesai

✅ API Key Security selesai
