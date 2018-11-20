FROM nginx:1.15.6-alpine

RUN rm /etc/nginx/conf.d/default.conf
ADD etc/nginx/nginx.conf /etc/nginx/nginx.conf
ADD etc/nginx/shelter.conf /etc/nginx/conf.d/shelter.conf