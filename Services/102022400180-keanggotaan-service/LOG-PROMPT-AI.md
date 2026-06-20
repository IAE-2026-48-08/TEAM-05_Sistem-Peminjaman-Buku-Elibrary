# AI Prompting Log - Service Keanggotaan (IAE-T2)

## Identitas Mahasiswa

| Field | Keterangan |
|-------|------------|
| Nama  | Veraldo Bahriansyah |
| NIM   | 102022400180 |
| Kelas | SI4808 |
| Service | Service 3 - Keanggotaan |
| Repository | 102022400180_Keanggotaan-Service |

---

## Prompt 1 - Response Wrapper / Standard Integration Contract

**Prompt:**
Saya sedang mengerjakan proyek backend Laravel untuk "Service 3 - Keanggotaan". 
Saya wajib mengikuti dokumen "Standard Integration Contract" yang mengharuskan 
semua response JSON dibungkus (wrapper) dalam format berikut jika sukses:
{
  "status": "success",
  "message": "...",
  "data": { ... },
  "meta": { "service_name": "Keanggotaan-Service", "api_version": "v1" }
}
Dan jika error:
{
  "status": "error",
  "message": "...",
  "errors": null
}
Tolong buatkan BaseController atau trait di Laravel agar semua response API saya 
otomatis konsisten mengikuti struktur di atas tanpa saya harus menulis manual di 
setiap method.

**Jawaban AI:**
Membuat class `ApiResponse` di `app/Http/Responses/ApiResponse.php` dengan dua 
static method `success()` dan `error()` yang membungkus semua response sesuai 
format Standard Integration Contract. Class ini bertindak sebagai single source 
of truth untuk format response seluruh aplikasi.

---

## Prompt 2 - Middleware CheckApiKey & Controller

**Prompt:**
Berdasarkan spesifikasi, saya memiliki 3 endpoint utama untuk Service Keanggotaan:
1. GET /api/v1/members (Collection)
2. GET /api/v1/members/{id} (Resource)
3. POST /api/v1/members (Action)
Semua endpoint ini wajib melewati Middleware custom bernama 'CheckApiKey'. 
Middleware ini harus memeriksa jika 'X-IAE-KEY' pada Request Header ada dan 
nilainya tidak kosong. Bantu saya membuat file Middleware 'CheckApiKey' tersebut 
dan berikan contoh implementasi pada Controller Keanggotaan yang menggunakan 
trait response sukses/gagal dari prompt sebelumnya.

**Jawaban AI:**
Membuat `CheckApiKey` middleware yang mengecek header `X-IAE-KEY` di setiap 
request. Jika header tidak ada maka return 401 Unauthorized menggunakan 
`ApiResponse::error()`. Middleware didaftarkan di `routes/api.php` dalam group 
prefix `v1` sehingga semua endpoint REST API otomatis terlindungi.

---

## Prompt 3 - Swagger/OpenAPI Dokumentasi

**Prompt:**
Saya sudah menginstall L5-Swagger di Laravel. Saya ingin membuat dokumentasi 
untuk endpoint `POST /api/v1/members`. Tolong buatkan anotasi OpenApi (OA) yang 
tepat untuk method store tersebut. Pastikan dalam dokumentasi Swagger-nya nanti, 
muncul opsi input Header untuk 'X-IAE-KEY' agar skenario pengujian di Swagger UI 
tidak menghasilkan error 401/403 akibat security-nya.

**Jawaban AI:**
Membuat `SwaggerController` khusus untuk deklarasi global `@OA\Info`, 
`@OA\Server`, dan `@OA\SecurityScheme` dengan nama `ApiKeyAuth` bertipe apiKey 
di header `X-IAE-KEY`. Setiap endpoint ditambahkan `security={{"ApiKeyAuth":{}}}` 
agar Swagger UI menampilkan tombol Authorize untuk input API Key sebelum testing.

---

## Prompt 4 - GraphQL dengan Lighthouse

**Prompt:**
Sekarang saya masuk ke tahap modernisasi menggunakan library Lighthouse GraphQL 
di Laravel. Saya perlu menyediakan akses ke GraphQL Playground dan membuat 
minimal 1 Query untuk mengambil data member berdasarkan ID (sama seperti 
GET /api/v1/members/{id}) namun dengan keleluasaan pemilihan field oleh klien.
Bagaimana cara menulis `schema.graphql` yang benar untuk query 
`member(id: ID!): Member` menggunakan directive `@find` bawaan Lighthouse? 
Berikan juga contoh query yang harus dieksekusi di GraphQL Playground untuk 
menguji field 'nama' dan 'status' saja.

**Jawaban AI:**
Menulis `graphql/schema.graphql` dengan type `Query` berisi dua query yaitu 
`member(id: ID! @eq): Member @find` untuk ambil data by ID dan 
`members: [Member!]! @all` untuk ambil semua data. Directive `@find` dan `@eq` 
dari Lighthouse otomatis generate query database tanpa perlu resolver manual. 
Contoh query di Playground untuk field tertentu saja:
```graphql
{
    member(id: 1) {
        name
        status
    }
}
```

---

## Prompt 5 - Pemisahan Middleware REST vs GraphQL

**Prompt:**
Ketika saya mencoba mengakses GraphQL Playground, query gagal karena Playground 
tidak mengirimkan header 'X-IAE-KEY' yang diwajibkan di middleware API saya.
Bagaimana praktik terbaik di Laravel untuk memisahkan middleware REST API 
(yang wajib pakai X-IAE-KEY) dengan endpoint GraphQL, tanpa mengorbankan 
keamanan data di production? Apakah saya harus mengaturnya di 
`config/lighthouse.php` atau di `RouteServiceProvider`?

**Jawaban AI:**
Solusi terbaik adalah mendaftarkan `CheckApiKey` middleware hanya di group route 
REST API di `routes/api.php`, bukan secara global. Lighthouse otomatis register 
route `/graphql` sendiri secara terpisah. Untuk production, keamanan GraphQL 
diatur lewat `config/lighthouse.php` di bagian `route.middleware`. GraphQL 
Playground dinonaktifkan di production dengan `GRAPHQL_PLAYGROUND_ENABLED=false` 
di file `.env`.
