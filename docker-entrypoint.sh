#!/bin/sh

NginxConfig=$(cat <<EOF
server {
    listen 80;
    listen [::]:80;

    server_name localhost;
    root /app;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ ^/index\.php(/|$) {
        fastcgi_pass localhost:9000;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF
)

SupervisordConfig=$(cat <<EOF
[supervisord]
nodaemon=true
logfile=/tmp/supervisord.log
pidfile=/tmp/supervisord.pid

[program:nginx]
command=nginx -g 'daemon off;'
numprocs=1
autostart=true
autorestart=true
startsecs=0
redirect_stderr=true
stdout_logfile=/dev/stdout
stdout_logfile_maxbytes=0

[program:php-fpm]
command=php-fpm --nodaemonize
numprocs=1
autostart=true
autorestart=true
startsecs=0
redirect_stderr=true
stdout_logfile=/dev/stdout
stdout_logfile_maxbytes=0
EOF
)

mkdir /config

echo "$NginxConfig" > /config/nginx.conf
echo "$SupervisordConfig" > /config/supervisord.conf

mv /config/nginx.conf /etc/nginx/http.d/default.conf

# execute the container command
exec "$@"