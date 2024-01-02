1. bikin db 'poli'
php artisan migrate:fresh --seed

user: admin
pass: admin

user: dokter
pass: dokter

2. Perubahan middleware
Authenticate
RedirectIfAuthenticated

3. Penambahan middleware
RoleMiddleware
