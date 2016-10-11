# Virtual Machine Setup for Zend Expressive Workshop

Welcome, the workshop is hands-on where you will actually be coding while you
learn. This setup will help you with the following:

- Install [VirtualBox](https://www.virtualbox.org/)
- Install [Vagrant](https://www.vagrantup.com/)
- Setup Vagrant with Ubuntu 16.04, Nginx and PHP 7 (using the [ubuntu/xenial64](https://atlas.hashicorp.com/ubuntu/boxes/xenial64/)
box)

You will need to install VirtualBox and Vagrant in order to run the virtual
machine for the workshop environment.

1. Install VirtualBox
  * Get VirtualBox from this URL: [https://www.virtualbox.org/wiki/Downloads](https://www.virtualbox.org/wiki/Downloads)

2. Install Vagrant
  * Get Vagrant from this URL: [http://www.vagrantup.com/downloads.html](http://www.vagrantup.com/downloads.html)
  * Check your BIOS to ensure hardware virtualization is enabled (this is a 64-bit VM).

   [https://www.virtualbox.org/manual/ch10.html#hwvirt](https://www.virtualbox.org/manual/ch10.html#hwvirt)

After the installation of Vagrant you can clone the repository [ezimuel/zend-expressive-workshop](https://github.com/ezimuel/zend-expressive-workshop)
using the following command:

```bash
git clone https://github.com/ezimuel/zend-expressive-workshop
```

Move inside the `zend-expressive-workshop` folder and execute Vagrant with the
following command:

```bash
vagrant up
```

If you don't have the [ubuntu/xenial64](https://atlas.hashicorp.com/ubuntu/boxes/xenial64/)
box installed in your Vagrant environment this operation will take some time.

After the setup, you will have a Ubuntu 16.04 VM with Nginx and PHP 7 running on
your [localhost:8080](http://localhost:8080). The web directory of the VM server
it's the `public` local folder. You will have also the web server log mounted
on the `log` local folder, to simplify the debug of the PHP application.

If you want to connect to the VM you can SSH into it, using the command:

```bash
vagrant ssh
```

If you want to close/stop the VM you can use the following command:

```bash
vagrant destroy
```
