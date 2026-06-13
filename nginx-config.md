# Updated Nginx Configuration for keeep.idexa.app

Here is the updated configuration for your existing Nginx server block. This config includes the PHP 8.4 block to execute the controller, the rule to secure your `config-rules` file, and routes requests properly.

```nginx
server {
    server_name keeep.idexa.app;

    root /var/www/keeep.idexa.app;
    index index.html index.php;

    # Secure: Block public access to the app-config config-rules file
    location = /api/v1/mobile/app-config/config-rules {
        deny all;
        return 404;
    }

    # API Endpoint: Route app-config requests to the directory's index.php
    location /api/v1/mobile/app-config/ {
        try_files $uri $uri/ /api/v1/mobile/app-config/index.php$is_args$args;
    }

    # SPA Router fallback and static files routing
    location / {
        try_files $uri $uri/ /index.html;
    }

    # PHP-FPM Configuration for PHP 8.4 (Added)
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

    # Deny htaccess access
    location ~ /\.ht {
        deny all;
    }

    listen 443 ssl; # managed by Certbot
    ssl_certificate /etc/letsencrypt/live/keeep.idexa.app/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/keeep.idexa.app/privkey.pem; # managed by Certbot
    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot
}

server {
    if ($host = keeep.idexa.app) {
        return 301 https://$host$request_uri;
    } # managed by Certbot

    server_name keeep.idexa.app;

    listen 80;
    return 404; # managed by Certbot
}
```
