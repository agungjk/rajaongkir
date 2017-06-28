# Raja Ongkir API Wrapper for Laravel
> Mempermudah penggunaan API raja ongkir pada aplikasi berbasis laravel

Dengan pacakage ini anda dapat menggunakan API Raja Ongkir dengan mudah karena sudah terintegrasi dengan facade laravel 5+.

![](cover.png)

## Install Package Composer
1. Otomatis Menggunakan Composer:
    ```sh
    composer require agungjk/rajaongkir
    ```

2. Tambahkan Manual ke **composer.json**:
    ```sh
    {
    	"require": {
    		"agungjk/rajaongkir" : "dev-master"
    	}
    }
    ```
## Integrasi Ke Laravel
1. Tambahkan service provider ke config/app.php
    ```php
    'providers' => [
    	....
    	
    	Agungjk\Rajaongkir\RajaOngkirServiceProvider::class,
    ]
    ```

2. Tambahkan juga aliasnya ke config/app.php
    ```php
    'aliases' => [
    	....
    	
    	'RajaOngkir' => Agungjk\Rajaongkir\RajaOngkirFacade::class,
    ]
    ```
    
## Publish Config Package Laravel
Jalankan command artisan berikut ```php artisan vendor:publish``` untuk publish secara otomatis, atau menggunakan cara manual seperti berikut ini:

1. Buat file **rajaongkir.php** di folder **/config** secara manual
2. Tambahkan Kodingan berikut ini:
    ```php
    <?php
    return [
    	'end_point_api' => env('RAJAONGKIR_ENDPOINT', 'http://rajaongkir.com/api/starter'),
    	'api_key' => env('RAJAONGKIR_KEY', 'SomeRandomString'),
    ];
    ```

## Setting Environment 
Tambahkan kode berikut di file .env untuk konfigurasi API rajaongkir
```
RAJAONGKIR_ENDPOINT=isi_base_url_api_akun_anda_disini
RAJAONGKIR_KEY=isi_api_key_anda_disini
```
atau anda juga dapat langsung melakukan konfigurasi di file **rajaongkir.php** di folder **config** seperti kode berikut.
```php
'end_point_api' => 'isi_base_url_api_akun_anda_disini',
'api_key' => 'isi_api_key_anda_disini',
```

## Contoh Penggunaan
Berikut adalah beberpa fungsi yang terdapat dalam package ini:
1. Mengambil Data Provinsi
    a. Semua Data Provinsi
    ```php
    $list_provinsi = RajaOngkir::province();
    ```
    b. Data Provinsi Berdasarkan ID
    ```php
    $provinsi_id = 1;
    $data_provinsi = RajaOngkir::province($provinsi_id);
    ```

2. Mengambil Data Kota
    a. Semua Data Kota
    ```php
    $list_kota = RajaOngkir::city();
    ```
    b. Data Kota Berdasarkan ID
    ```php
    $kota_id = 1;
    $data_kota = RajaOngkir::city($kota_id);
    ```

3. Mengkalkulasi Biaya
    ```php
    $kota_asal_id = 501;
    $kota_tujuan_id = 114;
    $berat = 1700; // dalam gram
    $kurir = "jne";
    $list_biaya = RajaOngkir::cost($kota_asal_id, $kota_tujuan_id, $berat, $kurir);
    ```

## Release History

* 0.2.0
    * CHANGE: Rename function for more readable
* 0.1.0
    * Initial fork version

## Meta

Agung Jati Kusumo – [@its_agungjk](https://twitter.com/its_agungjk) – agungjk.social@gmail.com

Distributed under the MIT license. See ``LICENSE`` for more information.

[https://github.com/agungjk/rajaongkir](https://github.com/agungjk/rajaongkir)

## Contributing

1. Fork it (<https://github.com/agungjk/rajaongkir/fork>)
2. Create your feature branch (`git checkout -b feature/fooBar`)
3. Commit your changes (`git commit -am 'Add some fooBar'`)
4. Push to the branch (`git push origin feature/fooBar`)
5. Create a new Pull Request

Kunjungi [rajaongkir](http://rajaongkir.com/)

Documentasi akun [starter](http://rajaongkir.com/dokumentasi/starter)
