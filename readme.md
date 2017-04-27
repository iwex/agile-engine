### Project setup

```bash
composer install
php vendor/bin/homestead make
vagrant up
vagrant ssh
php artisan migrate --seed
```

Find your project url in `Homestead.yaml` and add it to `/etc/hosts`

Open project url in browser.

### Samples

#### Products
##### List
`GET /api/products`

Response:

```json
{
  "data": [
    {
      "id": 1,
      "name": "veritatis quos",
      "price": 594.88,
      "vouchers": {
        "data": [
          {
            "id": 1,
            "start_date": 1493465008,
            "end_date": 1499349942,
            "discountTier": {
              "data": {
                "id": 2,
                "percent": 15
              }
            }
          },
          {
            "id": 2,
            "start_date": 1493631057,
            "end_date": 1506044850,
            "discountTier": {
              "data": {
                "id": 1,
                "percent": 10
              }
            }
          }
        ]
      }
    },
    {
      "id": 2,
      "name": "porro eum",
      "price": 536.62,
      "vouchers": {
        "data": [
          {
            "id": 3,
            "start_date": 1495026269,
            "end_date": 1505645294,
            "discountTier": {
              "data": {
                "id": 1,
                "percent": 10
              }
            }
          },
          {
            "id": 4,
            "start_date": 1494989692,
            "end_date": 1504920610,
            "discountTier": {
              "data": {
                "id": 3,
                "percent": 20
              }
            }
          }
        ]
      }
    },
    ...
  ]
}
```

#### Show one
`GET /api/products/{product}`

Response:

```json
{
  "data": {
    "id": 1,
    "name": "veritatis quos",
    "price": 594.88,
    "vouchers": {
      "data": [
        {
          "id": 1,
          "start_date": 1493465008,
          "end_date": 1499349942,
          "discountTier": {
            "data": {
              "id": 2,
              "percent": 15
            }
          }
        },
        {
          "id": 2,
          "start_date": 1493631057,
          "end_date": 1506044850,
          "discountTier": {
            "data": {
              "id": 1,
              "percent": 10
            }
          }
        }
      ]
    }
  }
}
```

#### Create
`POST /api/products`

```json
{
  "name":"Candy",
  "price" : "10.30"
}
```

Response:

```json
{
  "data": {
    "id": 11,
    "name": "Candy",
    "price": 10.3,
    "vouchers": {
      "data": []
    }
  }
}
```

#### Buy

`POST /api/{product}/buy`

Response: `204`

#### Bind vouchers

`PATCH /api/{product}/vouchers`

```json
{
  "voucher_ids": [1,2,3]
}
```

Response: `204`

#### UnBind vouchers

`DELETE /api/{product}/vouchers`

```json
{
  "voucher_ids": [1,2,3]
}
```

Response: `204`

### Vouchers
#### List
`GET /api/vouchers`

Response:

```json
{
  "data": [
    {
      "id": 1,
      "start_date": 1493465008,
      "end_date": 1499349942,
      "discountTier": {
        "data": {
          "id": 2,
          "percent": 15
        }
      }
    },
    {
      "id": 2,
      "start_date": 1493631057,
      "end_date": 1506044850,
      "discountTier": {
        "data": {
          "id": 1,
          "percent": 10
        }
      }
    },
    {
      "id": 3,
      "start_date": 1495026269,
      "end_date": 1505645294,
      "discountTier": {
        "data": {
          "id": 1,
          "percent": 10
        }
      }
    },
    {
      "id": 4,
      "start_date": 1494989692,
      "end_date": 1504920610,
      "discountTier": {
        "data": {
          "id": 3,
          "percent": 20
        }
      }
    },
    {
      "id": 5,
      "start_date": 1494886240,
      "end_date": 1502471686,
      "discountTier": {
        "data": {
          "id": 2,
          "percent": 15
        }
      }
    },
    {
      "id": 6,
      "start_date": 1495348565,
      "end_date": 1506385800,
      "discountTier": {
        "data": {
          "id": 2,
          "percent": 15
        }
      }
    },
    {
      "id": 7,
      "start_date": 1494249665,
      "end_date": 1500268418,
      "discountTier": {
        "data": {
          "id": 1,
          "percent": 10
        }
      }
    },
    {
      "id": 8,
      "start_date": 1494328954,
      "end_date": 1501450481,
      "discountTier": {
        "data": {
          "id": 2,
          "percent": 15
        }
      }
    },
    {
      "id": 9,
      "start_date": 1494818038,
      "end_date": 1499499950,
      "discountTier": {
        "data": {
          "id": 3,
          "percent": 20
        }
      }
    },
    {
      "id": 10,
      "start_date": 1494124091,
      "end_date": 1499410683,
      "discountTier": {
        "data": {
          "id": 1,
          "percent": 10
        }
      }
    },
    {
      "id": 11,
      "start_date": 1494087474,
      "end_date": 1501670821,
      "discountTier": {
        "data": {
          "id": 3,
          "percent": 20
        }
      }
    },
    {
      "id": 12,
      "start_date": 1493805720,
      "end_date": 1505303097,
      "discountTier": {
        "data": {
          "id": 1,
          "percent": 10
        }
      }
    },
    {
      "id": 13,
      "start_date": 1493615925,
      "end_date": 1501952387,
      "discountTier": {
        "data": {
          "id": 2,
          "percent": 15
        }
      }
    },
    {
      "id": 14,
      "start_date": 1493303175,
      "end_date": 1503819457,
      "discountTier": {
        "data": {
          "id": 2,
          "percent": 15
        }
      }
    },
    {
      "id": 15,
      "start_date": 1493444436,
      "end_date": 1504675575,
      "discountTier": {
        "data": {
          "id": 1,
          "percent": 10
        }
      }
    },
    {
      "id": 16,
      "start_date": 1493519388,
      "end_date": 1498540969,
      "discountTier": {
        "data": {
          "id": 4,
          "percent": 25
        }
      }
    },
    {
      "id": 17,
      "start_date": 1495169950,
      "end_date": 1500990119,
      "discountTier": {
        "data": {
          "id": 1,
          "percent": 10
        }
      }
    },
    {
      "id": 18,
      "start_date": 1494902272,
      "end_date": 1502443304,
      "discountTier": {
        "data": {
          "id": 3,
          "percent": 20
        }
      }
    },
    {
      "id": 19,
      "start_date": 1494026954,
      "end_date": 1499851143,
      "discountTier": {
        "data": {
          "id": 4,
          "percent": 25
        }
      }
    },
    {
      "id": 20,
      "start_date": 1495182067,
      "end_date": 1503452718,
      "discountTier": {
        "data": {
          "id": 1,
          "percent": 10
        }
      }
    }
  ],
  "meta": {
    "pagination": {
      "total": 20,
      "count": 20,
      "per_page": 25,
      "current_page": 1,
      "total_pages": 1,
      "links": []
    }
  }
}
```

#### Create
`POST /api/vouchers`

```json
{
  "discount_tier_id": 1,
  "start_date": "01-01-2017",
  "end_date": "01-01-2018"
}
```

Response
```json
{
  "data": {
    "id": 21,
    "start_date": 1483228800,
    "end_date": 1514764800,
    "discountTier": {
      "data": {
        "id": 1,
        "percent": 10
      }
    }
  }
}
```