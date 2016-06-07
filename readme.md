## Docker micro micro micro blog

####Install Docker:
```
wget -qO- https://get.docker.com/ | sh
sudo usermod -aG docker user
sudo apt-get install python-pip
sudo pip install docker-compose
```

#### Compile
```
chmod 744 compile
./compile
chmod 744 upload_db
./upload_db
```

#### Run
```
http://gate.blog:30001/
admin
admin
```