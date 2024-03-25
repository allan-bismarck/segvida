# SegVida

## AUTH

#### Register User

- **Request:**
  - **Method:** POST
  - **URL:** `http://127.0.0.1:8000/api/users/register`
  - **Body:**
    ```json
    {
        "user_name": "teste",
        "email": "teste@email.com",
        "password": "12345678"
    }
    ```

- **Response:**
- **Status:** Created (201)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 15:28:29 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "user": {
        "user_name": "teste",
        "email": "teste@email.com",
        "updated_at": "2024-03-24T15:28:29.000000Z",
        "created_at": "2024-03-24T15:28:29.000000Z",
        "id": 2
    },
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoyfQ.SvsvmxrScoUn5Cn0LFQcMvle691geCoz2ngOY5tGFp8"
}
```

#### Login

- **Request:**
  - **Method:** POST
  - **URL:** `http://127.0.0.1:8000/api/auth/login`
  - **Body:**
    ```json
    {
        "identity": "allan",
        "password": "12345678"
    }
    ```

- **Response:**
- **Status:** OK (200)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 15:30:06 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "user": {
        "id": 1,
        "user_name": "allan",
        "email": "allan@email.com",
        "email_verified_at": null,
        "created_at": "2024-03-24T15:23:13.000000Z",
        "updated_at": "2024-03-24T15:23:13.000000Z"
    },
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxfQ.BhBBP8RnVr8Dxj6VPKUBCBiF5ZKL24kvSzGa4Nt4pis"
}
```

#### Logout

- **Request:**
- **Method:** GET
- **URL:** `http://127.0.0.1:8000/api/auth/logout`
- **Body:** None

- **Response:**
- **Status:** OK (200)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 15:31:55 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "message": "Logout bem-sucedido"
}
```