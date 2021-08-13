## About Project

This app has the single endpoint that responds with the IP address of the requester.

Project is build in the Lumen (8.2.4) (Laravel Components ^8.0)


## End Point Details

End point:
{baseUrl}/api/v1/ip

Response
```
{
    "ip": "11.11.11.11"
}
```

If a query string parameter of name is present, greeting key will be added in the response and the name as part of its value. Else it will only return the ip address of the requester.

Request
```
{baseUrl}/api/v1/ip?name=Parth
```
Response
```
{
    "ip": "11.11.11.11",
    "greeting": "Parth"
}
```