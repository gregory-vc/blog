#!/bin/bash

echo "$SSH_USER:$SSH_PASSWORD" | chpasswd

/usr/sbin/sshd -D