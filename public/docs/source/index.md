---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Articles


APIs for managing articles
<!-- START_8bd67d5b8c23072f4e39d2b3cf69dfa1 -->
## Gets all articles

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "/api/v1/articles" 
```

```javascript
const url = new URL("/api/v1/articles");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "subject": "Dolor enim ea nisi laudantium officiis dolor.",
        "secondary_title": "Sint velit quia.",
        "body": "Iure tenetur dolores possimus non fuga ipsa. Consequatur sit laboriosam sit illum molestias aut eligendi et.",
        "author": "aliquid",
        "image": "\/tmp\/392b7cac993210039117c5eef45bf573.jpg",
        "created_at": "01-09-2019",
        "updated_at": "01-09-2019"
    }
}
```

### HTTP Request
`GET /api/v1/articles`


<!-- END_8bd67d5b8c23072f4e39d2b3cf69dfa1 -->

<!-- START_2f6f4918385c21304df17e1f57563404 -->
## Gets a single article

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "/api/v1/articles/1" 
```

```javascript
const url = new URL("/api/v1/articles/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "subject": "Dolor enim ea nisi laudantium officiis dolor.",
        "secondary_title": "Sint velit quia.",
        "body": "Iure tenetur dolores possimus non fuga ipsa. Consequatur sit laboriosam sit illum molestias aut eligendi et.",
        "author": "aliquid",
        "image": "\/tmp\/392b7cac993210039117c5eef45bf573.jpg",
        "created_at": "01-09-2019",
        "updated_at": "01-09-2019"
    }
}
```

### HTTP Request
`GET /api/v1/articles/{article}`


<!-- END_2f6f4918385c21304df17e1f57563404 -->

<!-- START_f25ad88ad3ff8f48775c1cc0cc4255fa -->
## Creates an article

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "/api/v1/articles" \
    -H "Content-Type: application/json" \
    -d '{"subject":"consequatur","secondary_title":"sint","body":"qui","image":"consequatur"}'

```

```javascript
const url = new URL("/api/v1/articles");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "subject": "consequatur",
    "secondary_title": "sint",
    "body": "qui",
    "image": "consequatur"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "subject": "Dolor enim ea nisi laudantium officiis dolor.",
        "secondary_title": "Sint velit quia.",
        "body": "Iure tenetur dolores possimus non fuga ipsa. Consequatur sit laboriosam sit illum molestias aut eligendi et.",
        "author": "aliquid",
        "image": "\/tmp\/392b7cac993210039117c5eef45bf573.jpg",
        "created_at": "01-09-2019",
        "updated_at": "01-09-2019"
    }
}
```

### HTTP Request
`POST /api/v1/articles`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    subject | string |  required  | The title of the article.
    secondary_title | string |  required  | The secondary title of the article.
    body | string |  required  | The body of the article.
    image | file |  required  | an image to the article.

<!-- END_f25ad88ad3ff8f48775c1cc0cc4255fa -->

<!-- START_990fef213e54638c028c8de87e0b0296 -->
## Updates an existing article

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT "/api/v1/articles/1" \
    -H "Content-Type: application/json" \
    -d '{"subject":"magni","secondary_title":"harum","body":"sed","image":"quaerat"}'

```

```javascript
const url = new URL("/api/v1/articles/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "subject": "magni",
    "secondary_title": "harum",
    "body": "sed",
    "image": "quaerat"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "subject": "Dolor enim ea nisi laudantium officiis dolor.",
        "secondary_title": "Sint velit quia.",
        "body": "Iure tenetur dolores possimus non fuga ipsa. Consequatur sit laboriosam sit illum molestias aut eligendi et.",
        "author": "aliquid",
        "image": "\/tmp\/392b7cac993210039117c5eef45bf573.jpg",
        "created_at": "01-09-2019",
        "updated_at": "01-09-2019"
    }
}
```

### HTTP Request
`PUT /api/v1/articles/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    subject | string |  required  | The title of the article.
    secondary_title | string |  required  | The secondary title of the article.
    body | string |  required  | The body of the article.
    image | file |  required  | an image to the article.

<!-- END_990fef213e54638c028c8de87e0b0296 -->

<!-- START_9bbfc77e31962e3921c3d1a010002cc9 -->
## Deletes a single articles

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE "/api/v1/articles/1" 
```

```javascript
const url = new URL("/api/v1/articles/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "subject": "Dolor enim ea nisi laudantium officiis dolor.",
        "secondary_title": "Sint velit quia.",
        "body": "Iure tenetur dolores possimus non fuga ipsa. Consequatur sit laboriosam sit illum molestias aut eligendi et.",
        "author": "aliquid",
        "image": "\/tmp\/392b7cac993210039117c5eef45bf573.jpg",
        "created_at": "01-09-2019",
        "updated_at": "01-09-2019"
    }
}
```

### HTTP Request
`DELETE /api/v1/articles/{id}`


<!-- END_9bbfc77e31962e3921c3d1a010002cc9 -->

#Authentication


APIs for managing articles
<!-- START_f76cc718539c2362f0d0a7069100319e -->
## /api/v1/auth/login
> Example request:

```bash
curl -X POST "/api/v1/auth/login" 
```

```javascript
const url = new URL("/api/v1/auth/login");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /api/v1/auth/login`


<!-- END_f76cc718539c2362f0d0a7069100319e -->

<!-- START_61e12326a1f2070b5637f4366c2ce678 -->
## Registers a new author

> Example request:

```bash
curl -X POST "/api/v1/auth/register" \
    -H "Content-Type: application/json" \
    -d '{"name":"ex","email":"deserunt","github":"ut","twitter":"perspiciatis","location":"ipsa","password":"doloribus"}'

```

```javascript
const url = new URL("/api/v1/auth/register");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "ex",
    "email": "deserunt",
    "github": "ut",
    "twitter": "perspiciatis",
    "location": "ipsa",
    "password": "doloribus"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "name": "aliquid",
        "email": "dickens.ramiro@gmail.com",
        "github": "madalyn.hilpert@hotmail.com",
        "twitter": "johns.sophia@daniel.com",
        "location": "634 Harvey Courts\nLednerport, TX 79135-4082",
        "latest_article_published": null,
        "created_at": "01-09-2019",
        "updated_at": "01-09-2019"
    }
}
```

### HTTP Request
`POST /api/v1/auth/register`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | The name of the author.
    email | string |  required  | The email of the author.
    github | string |  required  | The github account of the author.
    twitter | string |  required  | The twitter handle of the author.
    location | string |  required  | The Address of the author.
    password | string |  required  | The password for the author account.

<!-- END_61e12326a1f2070b5637f4366c2ce678 -->

#Author


APIs for managing authors
<!-- START_6fb26d50b7a6c257e7e49f261f7abd41 -->
## Gets all authors

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "/api/v1/authors" 
```

```javascript
const url = new URL("/api/v1/authors");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "name": "aliquid",
        "email": "dickens.ramiro@gmail.com",
        "github": "madalyn.hilpert@hotmail.com",
        "twitter": "johns.sophia@daniel.com",
        "location": "634 Harvey Courts\nLednerport, TX 79135-4082",
        "latest_article_published": null,
        "created_at": "01-09-2019",
        "updated_at": "01-09-2019"
    }
}
```

### HTTP Request
`GET /api/v1/authors`


<!-- END_6fb26d50b7a6c257e7e49f261f7abd41 -->

<!-- START_80c212b32fc16d083b161801d1ef5bc1 -->
## Show a single author

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "/api/v1/authors/1" 
```

```javascript
const url = new URL("/api/v1/authors/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "name": "aliquid",
        "email": "dickens.ramiro@gmail.com",
        "github": "madalyn.hilpert@hotmail.com",
        "twitter": "johns.sophia@daniel.com",
        "location": "634 Harvey Courts\nLednerport, TX 79135-4082",
        "latest_article_published": null,
        "created_at": "01-09-2019",
        "updated_at": "01-09-2019"
    }
}
```

### HTTP Request
`GET /api/v1/authors/{author}`


<!-- END_80c212b32fc16d083b161801d1ef5bc1 -->

<!-- START_40d091898a20797700338a9d8b0c3815 -->
## Updates an existing author

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT "/api/v1/authors/1" \
    -H "Content-Type: application/json" \
    -d '{"name":"dolor","email":"atque","github":"alias","twitter":"et","location":"praesentium"}'

```

```javascript
const url = new URL("/api/v1/authors/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "dolor",
    "email": "atque",
    "github": "alias",
    "twitter": "et",
    "location": "praesentium"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "name": "aliquid",
        "email": "dickens.ramiro@gmail.com",
        "github": "madalyn.hilpert@hotmail.com",
        "twitter": "johns.sophia@daniel.com",
        "location": "634 Harvey Courts\nLednerport, TX 79135-4082",
        "latest_article_published": null,
        "created_at": "01-09-2019",
        "updated_at": "01-09-2019"
    }
}
```

### HTTP Request
`PUT /api/v1/authors/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | The name of the author.
    email | string |  required  | The email of the author.
    github | string |  required  | The github account of the author.
    twitter | string |  required  | The twitter handle of the author.
    location | string |  required  | The Address of the author.

<!-- END_40d091898a20797700338a9d8b0c3815 -->

<!-- START_6337496b606639c30a5d30b424baeaf2 -->
## Deletes an author account

> Example request:

```bash
curl -X DELETE "/api/v1/authors/1" 
```

```javascript
const url = new URL("/api/v1/authors/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Author was deleted successfully"
}
```
> Example response (404):

```json
{
    "message": "Not found"
}
```

### HTTP Request
`DELETE /api/v1/authors/{id}`


<!-- END_6337496b606639c30a5d30b424baeaf2 -->

#general


<!-- START_8b3e70dccf4180be6ac44b24c54761fe -->
## Dump api-docs.json content endpoint.

> Example request:

```bash
curl -X GET -G "/docs" 
```

```javascript
const url = new URL("/docs");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /docs`


<!-- END_8b3e70dccf4180be6ac44b24c54761fe -->

<!-- START_7c0fe8d9df5e66a29beebfb7432be376 -->
## Display Swagger API page.

> Example request:

```bash
curl -X GET -G "/api/documentation" 
```

```javascript
const url = new URL("/api/documentation");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /api/documentation`


<!-- END_7c0fe8d9df5e66a29beebfb7432be376 -->

<!-- START_0455b2e98586c3809d37ebd3a12f1942 -->
## /swagger-ui-assets/{asset}
> Example request:

```bash
curl -X GET -G "/swagger-ui-assets/1" 
```

```javascript
const url = new URL("/swagger-ui-assets/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /swagger-ui-assets/{asset}`


<!-- END_0455b2e98586c3809d37ebd3a12f1942 -->

<!-- START_487b5c769d135e3b433454d6f12ba543 -->
## Display Oauth2 callback pages.

> Example request:

```bash
curl -X GET -G "/api/oauth2-callback" 
```

```javascript
const url = new URL("/api/oauth2-callback");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /api/oauth2-callback`


<!-- END_487b5c769d135e3b433454d6f12ba543 -->


