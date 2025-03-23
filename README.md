# Movie Theater Ticket Booking System

A web-based movie theater ticket booking system built with PHP and MySQL.

## Features

- User registration and authentication
- Browse movies (Now showing and upcoming)
- View movie details
- Book movie tickets
- Select seats
- View booking history

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache web server
- Composer (for dependency management)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/Movie-Theater-Ticket_WebPHP.git
cd Movie-Theater-Ticket_WebPHP
```

2. Install dependencies:
```bash
composer install
```

3. Create the database:
- Open phpMyAdmin
- Create a new database named `online_movie_booking`
- Import the `online_movie_booking.sql` file

4. Configure your web server:
- Point your web server's document root to the `public` directory
- Ensure mod_rewrite is enabled for Apache

5. Start the application:
- Visit `http://localhost/` in your web browser

## Directory Structure

```
Movie-Theater-Ticket_WebPHP/
├── app/                    # Application core files
│   ├── controllers/       # Controller classes
│   ├── models/           # Model classes
│   └── views/            # View templates
├── config/                # Configuration files
├── public/                # Web root directory
│   ├── css/             # CSS files
│   ├── js/              # JavaScript files
│   └── images/          # Image files
└── storage/              # File storage
    └── pdf/             # PDF files
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

 
