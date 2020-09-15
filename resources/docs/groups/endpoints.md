# Endpoints


## User login




> Example request:

```bash
curl -X POST \
    "http://localhost/api/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer 9|h1kro28YLrZiPakxLQX3KFRX8YN4kHnw0vIuQEteckbAsThSwyYFvlzFYFSjEtjrRp94UUJzJYHLUcmr" \
    -d '{"email":"minus","password":"minus"}'

```

```javascript
const url = new URL(
    "http://localhost/api/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer 9|h1kro28YLrZiPakxLQX3KFRX8YN4kHnw0vIuQEteckbAsThSwyYFvlzFYFSjEtjrRp94UUJzJYHLUcmr",
};

let body = {
    "email": "minus",
    "password": "minus"
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
    "status_code": 200,
    "access_token": "9|h1kro28YLrZiPakxLQX3KFRX8YN4kHnw0vIuQEteckbAsThSwyYFvlzFYFSjEtjrRp94UUJzJYHLUcmr",
    "token_type": "Bearer"
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/login`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>email</b></code>&nbsp; <small>string</small>     <br>
    An e-mail of the user

<code><b>password</b></code>&nbsp; <small>string</small>     <br>
    User password



## Get list of the products




> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer 9|h1kro28YLrZiPakxLQX3KFRX8YN4kHnw0vIuQEteckbAsThSwyYFvlzFYFSjEtjrRp94UUJzJYHLUcmr"
```

```javascript
const url = new URL(
    "http://localhost/api/products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer 9|h1kro28YLrZiPakxLQX3KFRX8YN4kHnw0vIuQEteckbAsThSwyYFvlzFYFSjEtjrRp94UUJzJYHLUcmr",
};


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
        "id": 292,
        "name": "atque",
        "ean": 24346320,
        "type": "y",
        "weight": 3,
        "color": "Ivory",
        "active": 0,
        "image": "45a552ae1356579d4e6ec0326afa6518.jpg",
        "deleted_at": null,
        "created_at": "2020-08-15T15:43:42.000000Z",
        "updated_at": "2020-08-15T18:21:31.000000Z"
    }
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/products`**



## Store new product.




> Example request:

```bash
curl -X POST \
    "http://localhost/api/product" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer 9|h1kro28YLrZiPakxLQX3KFRX8YN4kHnw0vIuQEteckbAsThSwyYFvlzFYFSjEtjrRp94UUJzJYHLUcmr" \
    -d '{"name":"table","ean":6,"type":"B","weight":18,"color":"perspiciatis","active":false,"image":"fugiat"}'

```

```javascript
const url = new URL(
    "http://localhost/api/product"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer 9|h1kro28YLrZiPakxLQX3KFRX8YN4kHnw0vIuQEteckbAsThSwyYFvlzFYFSjEtjrRp94UUJzJYHLUcmr",
};

let body = {
    "name": "table",
    "ean": 6,
    "type": "B",
    "weight": 18,
    "color": "perspiciatis",
    "active": false,
    "image": "fugiat"
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
        "name": "table",
        "ean": "11112233",
        "type": "B",
        "weight": "20",
        "color": "Brown",
        "active": "1",
        "image": "1597577655.jpg",
        "updated_at": "2020-08-16T11:34:16.000000Z",
        "created_at": "2020-08-16T11:34:16.000000Z",
        "id": 303
    }
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/product`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>name</b></code>&nbsp; <small>string</small>     <br>
    Name of the product.

<code><b>ean</b></code>&nbsp; <small>integer</small>     <br>
    EAN of the product.

<code><b>type</b></code>&nbsp; <small>string</small>     <br>
    type of the product.

<code><b>weight</b></code>&nbsp; <small>integer</small>     <br>
    weight of the product.

<code><b>color</b></code>&nbsp; <small>string</small>     <br>
    color of the product.

<code><b>active</b></code>&nbsp; <small>boolean</small>     <br>
    0 - inactive, 1 - active.

<code><b>image</b></code>&nbsp; <small>blob</small>     <br>
    image of the product.



## Update the specified resource in storage.




> Example request:

```bash
curl -X PUT \
    "http://localhost/api/product/1?name=table&ean=iusto&type=B&weight=laborum&color=non&active=illum&image=facilis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer 9|h1kro28YLrZiPakxLQX3KFRX8YN4kHnw0vIuQEteckbAsThSwyYFvlzFYFSjEtjrRp94UUJzJYHLUcmr"
```

```javascript
const url = new URL(
    "http://localhost/api/product/1"
);

let params = {
    "name": "table",
    "ean": "iusto",
    "type": "B",
    "weight": "laborum",
    "color": "non",
    "active": "illum",
    "image": "facilis",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer 9|h1kro28YLrZiPakxLQX3KFRX8YN4kHnw0vIuQEteckbAsThSwyYFvlzFYFSjEtjrRp94UUJzJYHLUcmr",
};


fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json

{
  "product": "product with id 301 edited sucessfully "
  }
}
```

### Request
<small class="badge badge-darkblue">PUT</small>
 **`api/product/{id}`**

<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<code><b>name</b></code>&nbsp;          <i>optional</i>    <br>
    string required Name of the product.

<code><b>ean</b></code>&nbsp;          <i>optional</i>    <br>
    int required EAN of the product.

<code><b>type</b></code>&nbsp;          <i>optional</i>    <br>
    string required type of the product.

<code><b>weight</b></code>&nbsp;          <i>optional</i>    <br>
    int required weight of the product.

<code><b>color</b></code>&nbsp;          <i>optional</i>    <br>
    string required color of the product.

<code><b>active</b></code>&nbsp;          <i>optional</i>    <br>
    boolean required 0 - inactive, 1 - active.

<code><b>image</b></code>&nbsp;          <i>optional</i>    <br>
    blob required image of the product.



## Remove the product.




> Example request:

```bash
curl -X POST \
    "http://localhost/api/product/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer 9|h1kro28YLrZiPakxLQX3KFRX8YN4kHnw0vIuQEteckbAsThSwyYFvlzFYFSjEtjrRp94UUJzJYHLUcmr"
```

```javascript
const url = new URL(
    "http://localhost/api/product/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer 9|h1kro28YLrZiPakxLQX3KFRX8YN4kHnw0vIuQEteckbAsThSwyYFvlzFYFSjEtjrRp94UUJzJYHLUcmr",
};


fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Product has been deleted."
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/product/{id}`**



## Restore the product.




> Example request:

```bash
curl -X POST \
    "http://localhost/api/product/restore/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer 9|h1kro28YLrZiPakxLQX3KFRX8YN4kHnw0vIuQEteckbAsThSwyYFvlzFYFSjEtjrRp94UUJzJYHLUcmr"
```

```javascript
const url = new URL(
    "http://localhost/api/product/restore/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer 9|h1kro28YLrZiPakxLQX3KFRX8YN4kHnw0vIuQEteckbAsThSwyYFvlzFYFSjEtjrRp94UUJzJYHLUcmr",
};


fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Product has been restored."
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/product/restore/{id}`**




