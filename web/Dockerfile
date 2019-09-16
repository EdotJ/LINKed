# base image
FROM node:10.16.3-alpine

# set working directory
WORKDIR /var/www

# add `/app/node_modules/.bin` to $PATH
ENV PATH /app/node_modules/.bin:$PATH

# install and cache app dependencies
COPY package.json /var/www/package.json
RUN npm install 

# start app
CMD ["npm", "start"]
