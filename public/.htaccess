RewriteEngine on

#Không cho xem cấu trúc thư mục
Options -Indexes

# Đảm bảo các yêu cầu không phải là một tệp hoặc thư mục thực!
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

# Điều hướng tất cả các yêu cầu tới index.php
RewriteRule ^(.*)$ index.php?url=$1