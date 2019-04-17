FROM nginx:1.15.6-alpine

RUN rm /etc/nginx/conf.d/default.conf
ADD config/nginx.conf /etc/nginx/nginx.conf
ADD config/shelter.conf /etc/nginx/conf.d/shelter.conf