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

## PATIENTS

### Get All Patients

#### Request
- **Method:** GET
- **URL:** `http://localhost:8000/api/patients`
- **Headers:**
  - Accept: application/json
  - Content-Type: application/json
- **Body:** None

#### Response
- **Status:** OK (200)
- **Headers:**
  - Host: localhost:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 02:58:57 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
[
    {
        "id": 1,
        "name": "Nome do Paciente",
        "date_of_birth": "1999-01-01",
        "sex": "Masculino",
        "address": "Endereço",
        "whatsapp": "Número de Whatsapp",
        "email": "pacient@example.com",
        "rg": "Número do RG",
        "cpf": "Número do CPF",
        "user_name": "user_name_usuario",
        "photo": null,
        "created_at": "2024-03-24T02:58:22.000000Z",
        "updated_at": "2024-03-24T02:58:22.000000Z",
        "schedules": []
    }
]

```

### Get Patient by Id

#### Request
- **Method:** GET
- **URL:** `http://localhost:8000/api/patients/1`
- **Headers:**
  - Accept: application/json
  - Content-Type: application/json
- **Body:** None

#### Response
- **Status:** OK (200)
- **Headers:**
  - Host: localhost:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 02:59:23 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "id": 1,
    "name": "Nome do Paciente",
    "date_of_birth": "1999-01-01",
    "sex": "Masculino",
    "address": "Endereço",
    "whatsapp": "Número de Whatsapp",
    "email": "pacient@example.com",
    "rg": "Número do RG",
    "cpf": "Número do CPF",
    "user_name": "user_name_usuario",
    "photo": null,
    "created_at": "2024-03-24T02:58:22.000000Z",
    "updated_at": "2024-03-24T02:58:22.000000Z",
    "schedules": []
}

```

### Create Patient

#### Request
- **Method:** POST
- **URL:** `http://127.0.0.1:8000/api/patients`
- **Headers:** None
- **Body:**
  - mode: formdata
    - name: Nome do Paciente
    - date_of_birth: 1999-01-01
    - sex: Masculino
    - address: Endereço
    - whatsapp: Número de Whatsapp
    - email: pacient@example.com
    - rg: Número do RG
    - cpf: Número do CPF
    - user_name: user_name_usuario
    - imagem: [File]

#### Response
- **Status:** Created (201)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 02:58:22 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "message": "Paciente cadastrado com sucesso.",
    "data": {
        "name": "Nome do Paciente",
        "date_of_birth": "1999-01-01",
        "sex": "Masculino",
        "address": "Endereço",
        "whatsapp": "Número de Whatsapp",
        "email": "pacient@example.com",
        "rg": "Número do RG",
        "cpf": "Número do CPF",
        "user_name": "user_name_usuario",
        "updated_at": "2024-03-24T02:58:22.000000Z",
        "created_at": "2024-03-24T02:58:22.000000Z",
        "id": 1
    }
}

```

### Edit Patient

#### Request
- **Method:** POST
- **URL:** `http://127.0.0.1:8000/api/patients/1`
- **Headers:** None
- **Body:**
  - mode: formdata
    - name: Nome do Paciente
    - date_of_birth: 1990-01-01
    - sex: Feminino
    - address: Endereço
    - whatsapp: Número de Whatsapp
    - email: pacient@example.com
    - rg: Número do RG
    - cpf: Número do CPF
    - user_name: user_name_usuario
    - imagem: [File]

#### Response
- **Status:** OK (200)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 03:00:37 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "message": "Paciente atualizado com sucesso.",
    "data": {
        "id": 1,
        "name": "Nome do Paciente",
        "date_of_birth": "1990-01-01",
        "sex": "Feminino",
        "address": "Endereço",
        "whatsapp": "Número de Whatsapp",
        "email": "pacient@example.com",
        "rg": "Número do RG",
        "cpf": "Número do CPF",
        "user_name": "user_name_usuario",
        "photo": null,
        "created_at": "2024-03-24T02:58:22.000000Z",
        "updated_at": "2024-03-24T03:00:37.000000Z"
    }
}

```

### Delete Patient

#### Request
- **Method:** DELETE
- **URL:** `http://127.0.0.1:8000/api/patients/1`
- **Headers:** None
- **Body:** None

#### Response
- **Status:** OK (200)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 03:01:16 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "message": "Paciente deletado com sucesso. Id: 1"
}

```