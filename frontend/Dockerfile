FROM node:22.4.0-slim AS build

WORKDIR /usr/src/app

COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run ng build

FROM nginx:stable-alpine3.19-slim
COPY --from=build /usr/src/app/dist/frontend/browser /usr/share/nginx/html
COPY /nginx.conf /etc/nginx/conf.d/default.conf
EXPOSE 80