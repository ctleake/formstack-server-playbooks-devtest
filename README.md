# Formstack Developer Project Environment Setup

## Prerequisites

- Virtualbox >= 5.1
- Vagrant >= 1.8.6
- Git
- Root access to your local machine

## Getting your Environment Setup
- Installed Ansible on my local machine:

```
$ sudo apt-add-repository ppa:ansible/ansible
$ sudo apt-get update
$ sudo apt-get install ansible

```

- Created a Formstack html home and cloned the formstack git repository:

    ```
    $ git clone https://github.com/formstack/server-playbooks-devtest.git
    ```

- Updated my `/etc/hosts` file

    ```
    echo 192.168.59.76   testbox.dev www.testbox.dev | sudo tee -a /etc/hosts
    ```

- Followed instructions to add my ssh passfiles to github:


- Tried to use  `vagrant up` to start provisioning my local environment, but it hung at ssh. Eventually found a fix: Oracle VM VirtualBox Manager > testbox.dev > Settings > Network and click Cable Connected


- Provisioned local formstack html home with: 

```
$ vagrant provision
```

- At this point I created a repository in github at https://github.com/ctleake/formstack-server-playbooks-devtest:

```
$ git init
$ git add .
$ git commit -m "First commit"
$ git remote set-url origin https://github.com/ctleake/formstack-server-playbooks-devtest.git
$ git push origin master
```

- Next I extracted the CodeIgniter MVC platform into the formstack local home, grabbing the ZIP file at https://github.com/bcit-ci/CodeIgniter/archive/3.1.4.zip in a develop branch
- In the develop branch I built a simple CRUD as specified in the Formstack Software Engineer Assignment.
- I had to fix NGINX /etc/nginx/site-available/default for CodeIgniter by incorporating the following lines:

```
        if (!-e $request_filename) {
              rewrite ^.*$ /index.php last;   
        }
```

- I saw that the my_app database and my_app user where already setup in MySQL on testbox.dev, so all I had to do was vagrant ssh onto the box then upload the schema:

```
$ mysql -u my_app -p my_app < my_app.sql
Enter password: secret
```

- The file my_app.sql will be in the email to Justin notifying him of my concluding the test.
- In order to deploy Unit Tests I installed PHPUnit and https://github.com/kenjis/ci-phpunit-test:

```
$ sudo apt install phpunit
$ composer require kenjis/ci-phpunit-test --dev
$ php vendor/kenjis/ci-phpunit-test/install.ph
```

- The Formstack testbox.dev at http://192.168.59.76/ defaults to the Users CRUD application 
- To run Unit Tests:

```
$ cd /var/www/html/formstack/server-playbooks-devtest/application/tests
$ phpunit
PHPUnit 5.1.3 by Sebastian Bergmann and contributors.

.........                                                           9 / 9 (100%)

Time: 1.45 seconds, Memory: 8.00Mb

OK (9 tests, 15 assertions)

Generating code coverage report in Clover XML format ... done

Generating code coverage report in HTML format ... done
```

- To examine coverage use the url:  http://192.168.59.76/application/tests/build/coverage/index.html

- There is a copy of Kenjis's excellent book on his CodeIgniter PHPUnit system at http://www.clubsantiagogym.cl/sites/271/upload/archivo-contenido-articulo-elite-pdf.pdf. Download it whilst it's still there!

- If you have any more questions about my work, please don't hesitate to email me about it at ctleake@sky.com.

  ​