FROM node:latest

RUN apt-get update

RUN npm install -g webpack-cli webpack
COPY . /theme
WORKDIR /theme
