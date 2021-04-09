FROM mysql:${MYSQL_VERSION:-latest}

#RUN sed -ire 's/max_allowed_packet.*=.*/max_allowed_packet = 32505856/g' /etc/mysql/my.cnf
RUN echo "max_allowed_packet=32505856" >> /etc/mysql/my.cnf