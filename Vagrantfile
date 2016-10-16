# Vagrant configuration for zend-expressive workshop
# @author Enrico Zimuel (enrico@zend.com)

VAGRANTFILE_API_VERSION = '2'

$script = <<SCRIPT
# Fix for https://bugs.launchpad.net/ubuntu/+source/livecd-rootfs/+bug/1561250
if ! grep -q "ubuntu-xenial" /etc/hosts; then
    echo "127.0.0.1 ubuntu-xenial" >> /etc/hosts
fi

# Fix for Temporary failure resolving 'archive.ubuntu.com'
echo "nameserver 8.8.8.8" | sudo tee /etc/resolv.conf > /dev/null

# Install dependencies
apt-get update
apt-get install -y nginx git curl php7.0 php7.0-cli php7.0-fpm php7.0-sqlite3 php7.0-pdo php7.0-xml php7.0-zip

# Configure Nginx
echo "server {
    listen 8080;

    root /home/ubuntu/zend-expressive/public;
    server_name ubuntu-xenial;

    # Logs
    access_log /home/ubuntu/zend-expressive/log/access_log;
    error_log /home/ubuntu/zend-expressive/log/error_log;

    index index.php index.html index.htm;

    location / {
        try_files \\$uri \\$uri/ /index.php;
    }
    location ~ \\.php\$ {
        fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;
        include snippets/fastcgi-php.conf;
    }
    # Block access to .htaccess
    location ~ \\.htaccess {
        deny all;
    }
}" > /etc/nginx/sites-available/zend-expressive
chmod 644 /etc/nginx/sites-available/zend-expressive
ln -s /etc/nginx/sites-available/zend-expressive /etc/nginx/sites-enabled/zend-expressive
service nginx restart

if [ -e /usr/local/bin/composer ]; then
    /usr/local/bin/composer self-update
else
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
fi

su ubuntu -c "cd /home/ubuntu/zend-expressive && composer install --optimize-autoloader"
SCRIPT

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = 'ubuntu/xenial64'
  config.vm.network "forwarded_port", guest: 8080, host: 8080
  config.vm.synced_folder '.', '/home/ubuntu/zend-expressive'
  config.vm.provision 'shell', inline: $script

  config.vm.provider "virtualbox" do |vb|
    vb.customize ["modifyvm", :id, "--memory", "1024"]
    vb.customize ["modifyvm", :id, "--name", "Zend Expressive Workshop - Ubuntu 16.04"]
  end
end
