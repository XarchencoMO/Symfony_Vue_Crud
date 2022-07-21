FROM node

WORKDIR /app/frontend

COPY  . .

RUN npm install

#EXPOSE 3080

CMD ["npm", "run", "serve"]