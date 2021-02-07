# Setup "Magento 2" with Docker #


- **Requirement**:

    - PHP version: 7.2.xx or later

    - Composer version: Lastest *(Current: 2.9.0)*

- **Documentation**:

    - Composer install: [How to Install Composer on MacOS](https://tecadmin.net/install-composer-on-macos/)

    - Video: [Docker + Magento 2: Virtual Machine Tutorial](https://www.youtube.com/watch?v=QTXRYKRldiU)

    - Tutorial Doc: [Docker for Magento 2 Development](https://www.magemodule.com/all-things-magento/magento-2-tutorials/docker-magento-2-development/)

    - Change port 80 & 443 XAMPP: [How to Change Port 80 and Port 443 in XAMPP Server](https://www.youtube.com/watch?v=rbycmTTAiqI)

- **Setup step**:

    - Step 1: Create folder for install project magento 2 *(We install it on ~/Desktop)*

            $ cd Desktop
            $ mkdir magento2

    - Step 2: In the folder created, we will clone and install the lastest project magento here *(Current magento 2.4)*

            $ composer create-project --repository-url=https://repo.magento.com/ magento/project-community-edition .

        - You can skip step above with easier way is clone this project.

    - Step 3: Change memory limit for PHP

            $ find . -name '.htaccess' -exec sed -i '' s/756M/2048M/g {} + && \
            find . -name '.htaccess' -exec sed -i '' s/768M/2048M/g {} + && \
            find . -name '.user.ini' -exec sed -i '' s/756M/2048M/g {} + && \
            find . -name '.user.ini' -exec sed -i '' s/768M/2048M/g {} +

    - Step 4: Choose a domain name you would like to use to access the site and add it to your hosts file.

            $ sudo -- sh -c "echo '127.0.0.1 local.domain.com' >> /etc/hosts"

    - Step 5: Create a docker-compose.yml file *(Path still in Desktop or your setup path magento)*

            $ touch docker-compose.yml
            
        - Open it and paste this setup to your docker-compose.yml file: [Setup docker-compose.yml file](./docker-compose.yml)

        - Note: You can customize your information in any field.

    - Step 6: Fire up your virtual machine! The first time you spin up, Docker needs to download the images, this may take a few minutes. Future spin-ups will only take a few seconds, usually less than 10.

            $ docker-compose up -d --build

        - Let’s make sure that it’s up and running as planned. In a web browser, go to **[127.0.0.1:8080](http://127.0.0.1:8080/)** and make sure that you can see phpMyAdmin. If you can, it was a success.

    - Step 7: This step will be install magento 2 from server. Let's go. *(Access your Docker web container’s command line)*.

            $ docker exec -it web bash

    - Step 8: Navigate to the web document root.

            $ cd /app

    - Step 9: Optional but recommended: deploy sample data.

            $ php bin/magento sampledata:deploy

        - This step will take a long time to install, please wait !!!

    - Step 10: Overwrite information default of magento by your information. You can follow this setup: [Overwrite setup.txt](./setup.txt)

    - Step 11: All done !!!
        - User page: [https://local.domain.com](https://local.domain.com)
        - Admin page: [https://local.domain.com/admin](https://local.domain.com/admin)
        - PHP MyAdmin: [http://127.0.0.1:8080/](http://127.0.0.1:8080/)
        
        and enjoy it. Good luck !!!

- **Start/Stop and setup more about detail images server**

    - Start:
    
            $ docker-compose up -d --build

    - Stop:

            $ docker-compose down

    - Connect to web container CLI:

            $ docker exec -it web bash

    - Connect to database container CLI:

            $ docker exec -it magentomysql bash
