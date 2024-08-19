
# myTODO 

Tutorial Instalasi Project myTODO


## Fitur yang tersedia

- Simple AJAX CRUD (Serverside)



## Cara Instalasi

```
1. git clone https://github.com/nuzulr24/test-energeek.git
2. buat database terlebih dahulu
3. cp .env.example .env
4. ubah data .env terlebih dahulu
5. php artisan storage:link
6. php artisan key:generate
7. php artisan migrate --seed
8. php artisan serve
```

## Disclamer
Pada website ini pure menggunakan project pribadi (_tidak mengambil atau menyontoh project orang lain_). Coding style yang digunakan bisa dianggap cukup mudah untuk dipahami bagi sebagian besar developer serta project ini tidak menggunakan postman/swagger (api documentation) karena untuk fitur yang tidak terlalu komplek (tanpa menggunakan autentikasi)

## API Backend
```
1. Ambil Semua Kategori
Endpoint: GET /category
2. Tambah Task baru
Endpoint: POST /add-todo
3. Ambil Semua Task
Endpoint: GET /todo
4. Hapus Task berdasarkan id
Endpoint: GET /todo/{id}/delete
```

## License

[MIT](https://choosealicense.com/licenses/mit/) Segala project yang dikerjakan merupakan hak cipta dari Nuzul

