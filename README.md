# Moderato - Online Store (SECURE)


## How to run it:
1. install Apache server with MySQL (or use a package like XAMPP)
2. clone repo to `/var/www/html/` (on Linux) or `C:/xampp/htdocs/` (on Windows)
3. add `.env` file here: `moderato/utils/.env` with these fields:
    ```toml
    DB_HOST=XXX.XXX.XXX.XXX
    DB_USER=your_usrname
    DB_PASS=your_passwd
    DB_NAME=products
    CAPTCHA_KEY=public_key
    CAPTCHA_SECRET=secret_key
    ANALYTICS_ID=google_analytics_id
    SECURE=true/false
    ```

## Implemented things:
- `.htaccess` with some bot user-agents blocked
- reCAPTCHA on contact form `/about.php`
- detecting webdriver (selenium) and redirecting to `honeypot.php` (anything what goes there will be blocked)
- sitemaps (html and xml)
- `robots.txt` (allowing only indexing bots like Googlebot)
- honeypot (you need to set fail2ban on `/honeypot.php` visit)
- `/humans.php` disallowed in `robots.txt` (you need to add it to fail2ban to check if any bot don't applies to it). Some indexing bots are able to visit this site but not `humans.php` and its a test if they respect `robots.txt`
- CORS and Referer rules for `search.php` in `.htaccess` (prevent getting data directly from database without interaction with site)


## Apache server settings (for Alpine Linux):
- Enable `mod_rewrite`: in `/etc/apache2/httpd.conf` find and uncomment:

    `LoadModule rewrite_module modules/mod_rewrite.so`

- Rate-limiting
    ```
    # /etc/apache2/conf.d/mod_evasive.conf
    <IfModule mod_evasive20.c>
        DOSHashTableSize 3097
        DOSPageCount 5          # Maximum number of requests per page
        DOSSiteCount 100        # Maximum number of requests per site
        DOSPageInterval 1.0     # Period in seconds for `DOSPageCount`.
        DOSSiteInterval 1.0     # Period in seconds for a DOSSiteCount
        DOSBlockingPeriod 10    # Locking time in seconds
    </IfModule>
    ```

- fail2ban on enter to `humans.php`, `honeypot.php` pages

    Insert content of `fail2ban` folder in right place and setup fail2ban daemon
