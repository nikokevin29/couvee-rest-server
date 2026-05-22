# Couvee REST Server

REST API backend for a **pet shop management system** — built as a learning project with Laravel 7. Covers customer management, pet records, grooming services, product sales, purchase orders, and PDF reporting.

> **Note:** This is a fictional pet shop ("Couvee") used as a learning exercise. Not intended for production use.

---

## Features

| Module | Description |
|--------|-------------|
| Authentication | Employee login with role-based access (Owner, CS, Kasir) |
| Customer | CRUD + search by name/ID |
| Pet (Hewan) | Pet records linked to owner, breed, and size category |
| Services (Layanan) | Service catalog for grooming offerings |
| Products (Produk) | Inventory management with supplier linking |
| Employees (Pegawai) | Staff management with role tracking |
| Suppliers | Vendor management |
| Service Transactions | Grooming/service orders with status tracking |
| Sales Transactions | Product sales with line items |
| Purchase Orders | Inventory procurement with PDF reports |
| Audit Log | Every write operation records actor + action type |
| PDF Reports | Monthly revenue reports via Laravel DomPDF |

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Framework | Laravel 7.0 |
| Language | PHP 7.2.5+ |
| Database | MySQL |
| Auth | Token-based API guard + Session guard |
| PDF | Laravel DomPDF |
| Real-time | Pusher 4.1 |
| Notifications | Firebase Cloud Messaging (FCM) + Nexmo SMS |
| Testing | PHPUnit 8.5 |

## API Routes

Base prefix: `/api`

```
POST   /pegawai/login

# Customer
GET    /customer
POST   /customer
GET    /customer/{id}
PUT    /customer/{id}
DELETE /customer/{id}

# Pet (Hewan)
GET    /hewan
POST   /hewan
GET    /hewan/{id}
PUT    /hewan/{id}
DELETE /hewan/{id}

# Services, Products, Employees, Suppliers
# → same CRUD pattern as above

# Transactions
POST   /transaksi-pelayanan          # Service order
POST   /transaksi-penjualan          # Product sale
POST   /pemesanan-barang             # Purchase order

# Reports
GET    /laporan/pendapatan-bulanan   # Monthly revenue PDF
```

## Project Structure

```
app/
├── Http/Controllers/    # 16 controllers (one per entity)
├── Http/Middleware/     # 7 middleware files
├── Models/              # 14+ Eloquent models with soft deletes
routes/
├── api.php              # API route definitions
├── web.php
database/
├── migrations/
└── seeds/
```

## Getting Started

### Requirements

- PHP 7.2.5+
- Composer
- MySQL
- Node.js + npm (for asset compilation)

### Installation

```bash
git clone https://github.com/nikokevin29/couvee-rest-server.git
cd couvee-rest-server

composer install
npm install

cp .env.example .env
php artisan key:generate
```

Configure `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=couvee
DB_USERNAME=root
DB_PASSWORD=
```

```bash
php artisan migrate
php artisan db:seed

php artisan serve
```

API will be available at `http://localhost:8000/api`.

## Notes

This project was built to learn:
- Laravel REST API structure
- Eloquent ORM relationships and soft deletes
- Role-based authentication patterns
- Transaction and line-item data modeling
- PDF report generation with DomPDF

---

*Built with Laravel 7 · MySQL · PHP*
