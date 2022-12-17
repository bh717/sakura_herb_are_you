# See https://github.com/Daursu/laradocker/blob/master/docker/nginx.DockerfilE
FROM nginx:1.20-alpine

WORKDIR /app/public

COPY ./docker/local/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./public/* /app/public/
