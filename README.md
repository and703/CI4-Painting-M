# CI4 Painting Management System

An industrial painting division management application built with CodeIgniter 4 for a Pirelli tire factory in Indonesia. Manages the lifecycle of painted tire components through Tag Printing, Parking Slot Assignment, FIFO Tracking, Curing, and Checkout.

## Overview

This application handles:
- **Tag Printing** - Workers log in with their NIK (employee ID) and print painting tags
- **Parking Slot Assignment** - Painted components are assigned to parking slots (Type A/M/B machines)
- **FIFO Tracking** - First-In-First-Out tracking for parking slots
- **Curing** - Track curing status (UNCURED/CURED) for components
- **Checkout** - Moving man checkout with quantity confirmation
- **Reports** - DataTables-based reports for moving man, print status, checkout, parking, and curing

## Tech Stack

- **Framework**: CodeIgniter 4
- **PHP**: 7.3+
- **Databases**: MySQL/MariaDB (local) + Microsoft SQL Server (remote plant data)
- **Frontend**: Bootstrap, Highcharts, DataTables, Toastify, TinyMCE

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/and703/CI4-Painting-Tag.git
   cd CI4-Painting-Tag
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Configure environment:
   ```bash
   cp e.nv .env
   ```
   Edit `.env` with your database credentials:
   ```dotenv
   database.default.hostname = localhost
   database.default.database = pcs
   database.default.username = root
   database.default.password =

   database.pcs.hostname = 172.21.202.240
   database.pcs.database = PCS
   database.pcs.username = Traceability
   database.pcs.password = your_password_here
   ```

4. Generate application key:
   ```bash
   php spark key:generate
   ```

5. Run database migrations:
   ```bash
   php spark migrate
   ```

6. Start the development server:
   ```bash
   php spark serve
   ```

## Project Structure

```
app/
├── Controllers/
│   ├── Worker.php              # Main controller (login, views)
│   ├── ParkingController.php   # Parking slot assignment logic
│   ├── CuringController.php    # Curing operations
│   ├── Komik.php               # Painting tag CRUD and printing
│   ├── Chart.php               # Dashboard chart data
│   ├── Report.php              # Moving man report
│   ├── Report_paint.php        # Print status report
│   ├── Report_paint_out.php    # Checkout status report
│   ├── Report_parking.php      # Parking filled report
│   ├── Report_cure.php         # Curing status report
│   └── R_status.php            # Real-time parking status
├── Models/
│   ├── Worker_model.php        # Worker auth, painting data (dual DB)
│   ├── KomikModel.php          # Painting tag CRUD
│   ├── ParkModel.php           # Parking slots (Type A)
│   ├── Park_M_Model.php        # Parking slots (Type M)
│   ├── Park_B_Model.php        # Parking slots (Type B)
│   ├── FIFOModel.php           # Base FIFO model
│   ├── FIFO1Model.php          # FIFO for Type A
│   ├── FIFO2Model.php          # FIFO for Type M
│   ├── FIFO3Model.php          # FIFO for Type B
│   ├── MMModel.php             # Moving man records
│   ├── CQModel.php             # QC user auth
│   ├── QModel.php              # QC quantity confirmation
│   ├── ReportBaseModel.php     # Base report model (DataTables)
│   └── M_Report*.php           # Report-specific models
└── Views/
    ├── layouts/                # Layout templates
    ├── worker_view.php         # Login page
    ├── komik/                  # Tag CRUD views
    ├── C_U/                    # Containment unit views (parking, curing, etc.)
    └── v_report*.php           # Report views
```

## Database

### Local Database (MySQL/MariaDB)
- `painting` - Painting tag records
- `parking` - Parking slots for Type A machines
- `parking_m` - Parking slots for Type M machines
- `parking_b` - Parking slots for Type B machines
- `mman` - Moving man/checkout records
- `cfrm_qty` - QC quantity confirmations
- `users` - QC user accounts
- `fifo_park`, `fifo_park_m`, `fifo_park_b` - FIFO tracking tables
- `bf_cure` - Before curing status
- `ip_cust_exp` - Custom aging/IP expiration times

### Remote Database (SQL Server)
- `MD_WORKERS` - Worker master data
- `MD_MATERIALS` - Material master data
- `DC_EVENTS` - Production events
- `MD_MACHINES` - Machine master data

## Security Features

- CSRF protection enabled on all forms
- Password hashing for QC users
- Session-based authentication
- Environment-based configuration (credentials in `.env`)

## License

MIT License
