# NOTIFICATION API 

**Navigation**:

**OneSignal**

* [All](#read-payment) : `[GET] /api/v1/payments`
* [Users](#create-payment) : `[POST] /api/v1/payments`
* [Tags](#update-payment) : `[PUT] /api/v1/payments`
* [Delete Payment](#delete-payment) : `[DELETE] /api/v1/payments/{id}`

**Pusher**




## ONESIGNAL

### ALL

**Endpoint**  `POST`/api/v1/onesignal/all

**Params**

| Key        | Type   | Require | Note |
| ---------- | ------ | :-----: | ---- |
| restApiKey | String |    ✔    |      |
| appId      | String |    ✔    |      |
| title      | String |    ✔    |      |
| body       | String |    ✔    |      |
| url       | String |    ✔    |      |
| schedule       | Date |    ✔    | Date format: Y-m-d h:i:s     |

**Example Request**

```json
{
	"restApiKey":"OWU3MmMyYzMtNzFiOS00YzViLTgzMzEtZTY5NmUyOTFjODQ2",
	"appId":"0968b630-89d8-4c35-b7ab-841af6dfcecb",
	"title":"tes",
	"body":"asdf"
}
```

**Success Response**

Code: `200`

```json
{
    "code": 200,
    "description": "Ok",
    "response": {
        "results": {
            "id": "7b2fb2bf-7165-4da0-8167-cf7f3184eddc",
            "recipients": 1,
            "external_id": null
        }
    }
}
```



### USERS

**Endpoint**  `POST`/api/v1/onesignal/all

**Params**

| Key        | Type          | Require | Note |
| ---------- | ------------- | :-----: | ---- |
| restApiKey | String        |    ✔    |      |
| appId      | String        |    ✔    |      |
| title      | String        |    ✔    |      |
| body       | String        |    ✔    |      |
| userIds    | String\|Array |    ✔    |      |
| url       | String |    ✔    |      |
| schedule       | Date |    ✔    | Date format: Y-m-d h:i:s     |

**Example Request**

```json
{
	"restApiKey":"OWU3MmMyYzMtNzFiOS00YzViLTgzMzEtZTY5NmUyOTFjODQ2",
	"appId":"0968b630-89d8-4c35-b7ab-841af6dfcecb",
	"title":"tes",
	"body":"asdf",
	"userIds":"017b1113-314c-4325-832e-fc21d1d0b948"
}
```

**Success Response**

Code: `200`

```json
{
    "code": 200,
    "description": "Ok",
    "response": {
        "results": {
            "id": "d7d460e9-1bbe-4eca-979d-0b3b0457a63d",
            "recipients": 1,
            "external_id": null
        }
    }
}
```

### TAGS
### SEGMENTS

**Endpoint**  `POST`/api/v1/onesignal/all

**Params**

| Key        | Type   | Require | Note |
| ---------- | ------ | :-----: | ---- |
| restApiKey | String |    ✔    |      |
| appId      | String |    ✔    |      |
| title      | String |    ✔    |      |
| body       | String |    ✔    |      |
| tags       | Array  |    ✔    |      |
| url       | String |    ✔    |      |
| schedule       | Date |    ✔    | Date format: Y-m-d h:i:s     |

**Example Request**

```json
{
	"restApiKey":"OWU3MmMyYzMtNzFiOS00YzViLTgzMzEtZTY5NmUyOTFjODQ2",
	"appId":"0968b630-89d8-4c35-b7ab-841af6dfcecb",
	"title":"tes",
	"body":"asdf",
	"tags":[
		{"field": "tag", "key": "userId", "relation": "=", "value": "hasandotprayoga"}
	]
}
```

**Success Response**

Code: `200`

```json
{
    "code": 200,
    "description": "Ok",
    "response": {
        "results": {
            "id": "0c680c78-3814-41fc-a84f-91772e1d3e7f",
            "recipients": 1,
            "external_id": null
        }
    }
}
```

### CANCEL

**Endpoint**  `DELETE`/api/v1/onesignal/cancel

**Params**

| Key            | Type   | Require | Note |
| -------------- | ------ | :-----: | ---- |
| restApiKey     | String |    ✔    |      |
| appId          | String |    ✔    |      |
| notificationId | String |    ✔    |      |

**Example Request**

```json
{
	"restApiKey":"OWU3MmMyYzMtNzFiOS00YzViLTgzMzEtZTY5NmUyOTFjODQ2",
	"appId":"0968b630-89d8-4c35-b7ab-841af6dfcecb",
	"notificationId":"f77150b0-063d-49e5-9c50-3ec69462a487"
}
```

**Success Response**

Code: `200`

```json
{
    "code": 200,
    "description": "Ok",
    "response": {
        "results": {
            "success": true
        }
    },
    "debug": true
}
```

## PUSHER

### CHANNEL

#### PUSH

**Endpoint**  `POST`/api/v1/pusher/channel/push

**Params**

| Key        | Type   | Require | Note |
| ---------- | ------ | :-----: | ---- |
| channel | String |    ✔    |      |
| event      | String |    ✔    |      |
| data      | String/Object/Array |✔| |

**Example Request**

```json
{
	"channel":"my-channel",
	"event":"my-event",
	"data":{
		"message":"adsf"
	}
}
```

**Success Response**

Code: `200`

```json
{
    "code": 200,
    "description": "Ok",
    "response": {
        "results": [
            {
                "status": "success"
            }
        ]
    }
}
```

### BEAMS

#### INTERESTS

**Endpoint**  `POST` /api/v1/pusher/beams/interests

**Params**

| Key       | Type         | Require | Note |
| --------- | ------------ | :-----: | ---- |
| interests | String/Array |    ✔    |      |
| title     | String       |    ✔    |      |
| body      | String       |    ✔    |      |

**Example Request**

```json
{
	"interests":"hello",
	"title":"ini title",
	"body":"ini body"
}
```

**Success Response**

Code: `200`

```json
{
    "code": 200,
    "description": "Ok",
    "response": {
        "results": {
            "publishId": "pubid-99008f99-85fc-4db2-85e4-54d9e3ad3566"
        }
    }
}
```

#### USERS

**Endpoint**  `POST` /api/v1/pusher/beams/users

**Params**

| Key     | Type         | Require | Note |
| ------- | ------------ | :-----: | ---- |
| userIds | String/Array |    ✔    |      |
| title   | String       |    ✔    |      |
| body    | String       |    ✔    |      |

**Example Request**

```json
{
	"userIds":"user-tes",
	"title":"ini title",
	"body":"ini body"
}
```

**Success Response**

Code: `200`

```json
{
    "code": 200,
    "description": "Ok",
    "response": {
        "results": {
            "publishId": "pubid-99008f99-85fc-4db2-85e4-54d9e3ad3566"
        }
    }
}
```

#### GENERATE TOKEN

**Endpoint**  `GET` /api/v1/pusher/beams/generate-token

**Params**

| Key    | Type   | Require | Note |
| ------ | ------ | :-----: | ---- |
| userId | String |    ✔    |      |

**Example Request**

```json
{
	"userId":"user-tes"
}
```

**Success Response**

Code: `200`

```json
{
    "code": 200,
    "description": "Ok",
    "response": {
        "results": {
            "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvNDY5YmMwN2QtY2ViNy00NjcxLTk4MmQtZGE5ZGUxODIwYTYzLnB1c2hub3RpZmljYXRpb25zLnB1c2hlci5jb20iLCJzdWIiOiJzZGYiLCJleHAiOjE1NTExNTM2MDB9.CZTJ-LwQUoPkkMf-wXmCsrA9ogaWxmmO_YgW_AKtP10"
        }
    }
}
```
#### DELETE USER
**Endpoint**  `DELETE` /api/v1/pusher/beams/delete-user

**Params**

| Key    | Type   | Require | Note |
| ------ | ------ | :-----: | ---- |
| userId | String |    ✔    |      |

**Example Request**

```json
{
	"userId":"user-tes"
}
```

**Success Response**

Code: `200`

```json
{
    "code": 200,
    "description": "Ok",
    "response": {
        "results": {
            
        }
    }
}
```