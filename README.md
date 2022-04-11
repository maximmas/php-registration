# PHP Simple Form Server-Side Validation 

A PHP package that can do following functions  

- make following checking:
  - email format
  - unique email
  - passwords are the same
- save form data in log file  

---

# Quick reference

- **Supported PHP versions**: `8.1`, `8.0`
- **Maintained by**: [Maxim Maslov](https://github.com/maximmas)
- **Source**: [https://github.com/maximmas/test-php-registration](https://github.com/maximmas/test-php-registration)
 
---

# How to run quickly 

- clone project in local folder
- install dependencies
- run web server: 
  `php -S localhost:8080` 

- open in browser localhost:8080 URL

# Tests

- To run tests: 
  `vendor/bin/phpunit -c phpunit.xml`

- To run code analyzer: 
  `vendor/bin/phpstan analyse src tests`