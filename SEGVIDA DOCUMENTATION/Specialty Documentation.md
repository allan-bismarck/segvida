# SegVida

#### Menu de Navegação

- [Home](https://github.com/allan-bismarck/segvida)
- [Clinics](https://github.com/allan-bismarck/segvida/blob/main/SEGVIDA%20DOCUMENTATION/Clinic%20Documentation.md)
- [Specialists](https://github.com/allan-bismarck/segvida/blob/main/SEGVIDA%20DOCUMENTATION/Specialist%20Documentation.md)
- [Specialties](https://github.com/allan-bismarck/segvida/blob/main/SEGVIDA%20DOCUMENTATION/Specialty%20Documentation.md)
- [Patients](https://github.com/allan-bismarck/segvida/blob/main/SEGVIDA%20DOCUMENTATION/Patient%20Documentation.md)
- [Images](https://github.com/allan-bismarck/segvida/blob/main/SEGVIDA%20DOCUMENTATION/Image%20Documentation.md)
- [Availabilities](https://github.com/allan-bismarck/segvida/blob/main/SEGVIDA%20DOCUMENTATION/Availability%20Documentation.md)
- [Schedules](https://github.com/allan-bismarck/segvida/blob/main/SEGVIDA%20DOCUMENTATION/Schedule%20Documentation.md)
- [Auth](https://github.com/allan-bismarck/segvida/blob/main/SEGVIDA%20DOCUMENTATION/Auth%20Documentation.md)
- [Users](https://github.com/allan-bismarck/segvida/blob/main/SEGVIDA%20DOCUMENTATION/User%20Documentation.md)

## SPECIALTIES

### Get All Specialties

#### Request
- **Method:** GET
- **URL:** `http://localhost:8000/api/specialties`
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
  - Date: Sun, 24 Mar 2024 02:50:05 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
[
    {
        "id": 1,
        "name": "Nome da Especialidade",
        "color": "Cor da Especialidade",
        "photo": null,
        "created_at": "2024-03-24T02:46:09.000000Z",
        "updated_at": "2024-03-24T02:46:09.000000Z"
    },
    {
        "id": 2,
        "name": "Nome da Especialidade",
        "color": "Cor da Especialidade",
        "photo": null,
        "created_at": "2024-03-24T02:47:07.000000Z",
        "updated_at": "2024-03-24T02:47:07.000000Z"
    },
    {
        "id": 3,
        "name": "Nome da Especialidade",
        "color": "Cor da Especialidade",
        "photo": 4,
        "created_at": "2024-03-24T02:49:30.000000Z",
        "updated_at": "2024-03-24T02:49:31.000000Z"
    }
]

```

### Get Specialty by Id

#### Request
- **Method:** GET
- **URL:** `http://localhost:8000/api/specialties/3`
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
  - Date: Sun, 24 Mar 2024 02:50:51 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "id": 3,
    "name": "Nome do Especialista",
    "color": "Cor do Especialista",
    "photo": 4,
    "created_at": "2024-03-24T02:49:30.000000Z",
    "updated_at": "2024-03-24T02:49:31.000000Z"
}

```

### Create Specialty

#### Request
- **Method:** POST
- **URL:** `http://127.0.0.1:8000/api/specialties`
- **Headers:** None
- **Body:**
  - mode: formdata
  - formdata:
    - key: name
      value: Nome da Especialidade
      type: text
    - key: color
      value: Cor da Especialidade
      type: text
    - key: image
      type: file
      src: /C:/Users/Usuário/Downloads/foto.jpg

#### Response
- **Status:** Created (201)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 02:49:31 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "message": "Especialidade cadastrada com sucesso.",
    "data": {
        "name": "Nome da Especialidade",
        "color": "Cor da Especialidade",
        "updated_at": "2024-03-24T02:49:31.000000Z",
        "created_at": "2024-03-24T02:49:30.000000Z",
        "id": 3,
        "photo": 4
    }
}

```

### Edit Specialty

#### Request
- **Method:** POST
- **URL:** `http://127.0.0.1:8000/api/specialties/1`
- **Headers:** None
- **Body:**
  - mode: formdata
  - formdata:
    - key: name
      value: Ortopedia
      type: text
    - key: color
      value: 0x00FFFF
      type: text
    - key: image
      type: file
      src: []

#### Response
- **Status:** OK (200)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 02:51:44 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "message": "Especialidade atualizada com sucesso.",
    "data": {
        "id": 1,
        "name": "Ortopedia",
        "color": "0x00FFFF",
        "photo": null,
        "created_at": "2024-03-24T02:46:09.000000Z",
        "updated_at": "2024-03-24T02:46:09.000000Z"
    }
}

```

### Delete Specialty

#### Request
- **Method:** DELETE
- **URL:** `http://127.0.0.1:8000/api/specialties/2`
- **Headers:** None
- **Body:** None

#### Response
- **Status:** OK (200)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 02:52:16 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "message": "Especialidade deletada com sucesso",
    "id": "2"
}

```