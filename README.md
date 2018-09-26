Latorder
-------------
Latorder is a basic Restful API routes using PHP.

## Run

You can get up and running quickly using any of the follow.



**Please note that docker and GOOGLE API KEY FOR DISTANCE MATRIX are required for this setup to work**

Paste your API Key in env_files/.env in the env variable GOOGLE_API_KEY=YOUR_GOOGLE_API_KEY and run 

```bash
./start.sh
```

Once command has finished executing, you should be able start hitting api at `http://localhost:8080`.

### Curl

- Create order

```bash
▶ curl -X POST \
  http://localhost:8080/order -d '{ "origin": ["40.6655101", "-73.89188969999998"], "destination": ["40.6905615", "-73.9976592"] }'

```

- List orders

```bash
▶ curl -X GET \
  'http://localhost:8080/orders?page=1&limit=10' 
```

- Take order

```bash
curl -X PUT \
  http://localhost:8080/order/1 \
  -d '{"status":"taken"}'
```
### Tests
```bash
./vendor/bin/phpunit --bootstrap vendor/autoload.php --testdox tests
```
