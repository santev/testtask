# testtask

Setup:

1) clone from git
2) docker-compose up -d
3) symfony server:start -d
4) make migration
5) load fixtures
6) POST data 

curl -X 'POST' \
  'https://localhost:8000/api/items/{item_id}/setprice' \
  -H 'accept: application/ld+json' \
  -H 'Content-Type: application/ld+json' \
  -d '{
  "sizeId": "1",
  "currencyId": "3",
  "decimal": "3.33"
}'
