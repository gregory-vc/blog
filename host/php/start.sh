#!/bin/bash

echo "$SSH_USER:$SSH_PASSWORD" | chpasswd

/usr/bin/supervisord