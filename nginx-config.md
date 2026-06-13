# Nginx Configuration for tryluno.lo

Add the following server block to your Nginx configuration files (e.g., in `/etc/nginx/sites-available/tryluno.lo` or `/opt/homebrew/etc/nginx/servers/tryluno.lo` depending on your setup).

```nginx
server {
    listen 80;
    server_name tryluno.lo; # Your local development domain

    # Set root path to the build/client output directory
    root /Users/ahmed/Documents/Projects/PHP/tryluno.lo/build/client;
    index index.html index.php;

    # Secure: Block public access to the app-config config-rules file
    location = /api/v1/mobile/app-config/config-rules {
        deny all;
        return 404; # Optional: hides the existence of the file
    }

    # API Endpoint: Route app-config to index.php
    location /api/v1/mobile/app-config/ {
        try_files $uri $uri/ /api/v1/mobile/app-config/index.php$is_args$args;
    }

    # SPA Router fallback and static files routing
    location / {
        try_files $uri $uri/ /__spa-fallback.html;
    }

    # PHP-FPM Configuration for PHP 8.4
    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        
        # PHP 8.4 FPM TCP Socket
        fastcgi_pass 127.0.0.1:9084;
        fastcgi_index index.php;
        
        # FastCGI Params
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }

    # Optional: Cache control for static assets
    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$ {
        expires 30d;
        add_header Cache-Control "public, no-transform";
    }

    # Optional: Log configurations
    error_log  /var/log/nginx/tryluno.lo.error.log error;
    access_log /var/log/nginx/tryluno.lo.access.log;
}
```
