# SegVida

## SPECIALISTS

### Get All Specialists

#### Request
- **Method:** GET
- **URL:** `http://localhost:8000/api/specialists`
- **Headers:**
  - Accept: application/json
  - Content-Type: application/json

#### Response
- **Status:** OK (200)
- **Headers:**
  - Host: localhost:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 03:05:55 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
[
    {
        "id": 2,
        "name": "Nome do Especialista",
        "CRM": "CRM do Especialista",
        "sex": "Masculino",
        "photo": null,
        "created_at": "2024-03-24T03:04:43.000000Z",
        "updated_at": "2024-03-24T03:04:43.000000Z",
        "specialty": [],
        "schedules": [],
        "availabilities": []
    }
]

```

### Get Specialist by Id

#### Request
- **Method:** GET
- **URL:** `http://localhost:8000/api/specialists/1`
- **Headers:**
  - Accept: application/json
  - Content-Type: application/json

#### Response
- **Status:** OK (200)
- **Headers:**
  - Host: localhost:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 03:06:43 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "id": 2,
    "name": "Nome do Especialista",
    "CRM": "CRM do Especialista",
    "sex": "Masculino",
    "photo": null,
    "created_at": "2024-03-24T03:04:43.000000Z",
    "updated_at": "2024-03-24T03:04:43.000000Z",
    "specialty": [],
    "schedules": [],
    "availabilities": []
}

```

### Create Specialist

#### Request
- **Method:** POST
- **URL:** `http://127.0.0.1:8000/api/specialists`
- **Headers:** None
- **Body:**
  - mode: formdata
    - key: name, value: Nome do Especialista, type: text
    - key: CRM, value: CRM do Especialista (opcional), type: text
    - key: sex, value: Masculino, type: text
    - key: image, type: file, src: /C:/Users/Usuário/Downloads/foto.jpg

#### Response
- **Status:** Created (201)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 02:40:50 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "name": "Nome do Especialista",
    "CRM": "CRM do Especialista (opcional)",
    "sex": "Masculino",
    "updated_at": "2024-03-24T02:40:50.000000Z",
    "created_at": "2024-03-24T02:40:50.000000Z",
    "id": 1,
    "specialty": []
}

```

### Edit Specialist

#### Request
- **Method:** POST
- **URL:** `http://127.0.0.1:8000/api/specialists/1`
- **Headers:** None
- **Body:**
  - mode: formdata
    - key: name, value: Nome do Especialista, type: text
    - key: CRM, value: 11111, type: text
    - key: sex, value: Feminino, type: text
    - key: foto, type: file, src: []

#### Response
- **Status:** OK (200)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 02:41:54 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "message": "Especialista atualizado com sucesso.",
    "data": {
        "id": 1,
        "name": "Nome do Especialista",
        "CRM": "11111",
        "sex": "Feminino",
        "photo": null,
        "created_at": "2024-03-24T02:40:50.000000Z",
        "updated_at": "2024-03-24T02:41:54.000000Z",
        "specialty": []
    }
}

```

### Delete Specialist

#### Request
- **Method:** DELETE
- **URL:** `http://127.0.0.1:8000/api/specialists/1`
- **Headers:** None
- **Body:** None

#### Response
- **Status:** OK (200)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sat, 23 Mar 2024 02:45:07 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "message": "Especialista deletado com sucesso."
}

```