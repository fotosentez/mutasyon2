<?php
Class Lang{
    public static function getLang($a)
    {
        $value = array(
            "welcome" 					=> "Hoş geldiniz",
            "myCompany" 				=> "Bizim Şirket",
            "invoiceFrom" 				=> "Kimden",
            "invoiceTo" 				=> "Kime",
            "admin" 					=> "Kullanıcı",
            "paid" 					=> "Ödenen",
            "currency" 					=> "TRY",
            "totalInput" 				=> "Toplam Veri",
            "all" 					=> "Tümü",
            
            //Login form
            "signin" 					=> "Giriş",
            "login" 					=> "Giriş Yap",
            "password" 					=> "Şifreniz",
            "username" 					=> "Kullanıcı Adınız",
            
            //Notifications
            "mainPage" 					=> "Anasayfa",
            "validateText" 				=> "Lütfen geçerli bir içerik giriniz!",
            "validateUrl" 				=> "Lütfen geçerli bir web adresi giriniz!",
            "validateNumber" 				=> "Lütfen yalnızca numara giriniz!",
            "validateMail" 				=> "Lütfen geçerli bir e-posta giriniz!",
            "validateDiscount" 				=> "İndirim miktarı toplamdan büyük olamaz!",
            "validateDate" 				=> "Lütfen geçerli bir tarih formatı giriniz! Örn: 2017.01.01",
            "contentExist" 				=> "Böyle bir içerik zaten var!",
            "cantBlank" 			        => "Bu alan boş olamaz!",
            "proccessSuccess" 				=> "İşlem başarıyla tamamlandı",
            "validatePassword" 			        => "Şifreniz 5-20 karakter arasında olmalı ve enaz bir harf ve sayı içermelidir",
            "tokenError" 			        => "Token uyuşmuyor",
            "notAnyFile" 			        => "Lütfen bir resim yollayınız!",
            "fileVeryBig" 			        => "Maksimum yükleme boyutu 2 Mb olmalıdır",
            "fileNotJpg" 			        => "Dosya türü olarak JPEG seçiniz!",
            "writeDBError" 			        => "Veritabanına yazılırken hata oluştu!",
            "doLogin" 			                => "Giriş yapıldı anasayfaya yönlendiiriliyorsunuz",
            "cantLogin" 			        => "Kullanıcı adı yada şifre yanlış!",
            "validateShortInput" 		        => "Geçerli sayıda karakter girmediniz!",
            "doeDateCantSmall" 		                => "Vade tarihi oluşturma tarihinden önce olamaz!",
            "notEnoughStock" 		                => "Stokta yeterli ürün yok!",
            "productNotFound" 		                => "Ürün bulunamadı yada stokta yok!",
            "errorChangeValue" 		                => "Gönderilen veri değiştirildi yada gönderilemedi!",
            
            
            
            //Left Menu
            "index" 					=> "Anasayfa",
            "invoices" 					=> "Faturalar",
            "invoiceList" 				=> "Fatura Listesi",
            "addInvoice" 				=> "Fatura Ekle",
            "current" 					=> "Cari",
            "customers" 				=> "Müşteriler",
            "addCustomer" 				=> "Müşteri Ekle",
            "sellers" 					=> "Satıcılar",
            "serviceProviders" 				=> "Hizmet Sağlayıcılar",
            "stockManagements" 				=> "Stok Yönetimi",
            "stockLists" 				=> "Stok Listesi",
            "addStock" 					=> "Stok Ekle",
            "payments" 					=> "Ödemeler",
            "providers" 				=> "Hizmet Sağlayıcı",
            "addProviders" 				=> "Hizmet Sağlayıcı Ekle",
            
            //Title of name
            "title_name" 				=> "Sayın",
            
            //Colors
            "green" 				        => "Yeşil",
            "blue" 				        => "Mavi",
            "red" 				        => "Kırmızı",
            "orange" 				        => "Turuncu",
            "white" 				        => "Beyaz",
            "purple" 				        => "Mor",
            "blue-sky" 				        => "Açık Mavi",
            
            //Products
            "products" 				        => "Ürünler",
            "productsList" 				=> "Ürün Listesi",
            "addProducts" 				=> "Ürün Ekle",
            "productDetail" 				=> "Ürün Ayrıntısı",
            "productAct" 				=> "Satış hareketleri",
            "exTax" 				        => "Vergi hariç",
            "addToCart" 				=> "Sepete Ekle",
            "addToStock" 				=> "Satın Al",
            "productName" 				=> "Ürünün Adı",
            "sellerName" 				=> "Satıcı Adı",
            "eachPrice" 				=> "Birim Fiyat",
            "paidTotal" 				=> "Toplam Ödenen",
            "colors" 				        => "Renk Seçenekleri",
            "shortDesc" 				=> "Kısa Açıklama",
            "cart" 				        => "Sepet",
            "productPrefix" 				=> "Önek",
            
            
            //Pagination
            "previous" 					=> "Önceki",
            "next" 					=> "Sonraki",
            "lastPage" 					=> "Son Sayfa",
            "firstPage" 				=> "İlk Sayfa",
            
            //Page Names
            "pageTitleBlank" 				=> " ",
            "productAdd" 				=> "Yeni Ürün Ekle",
            "addInvoice" 				=> "Yeni Fatura Oluştur",
            
            //Buttons and labels
            "cancel" 					=> "İptal",
            "submit" 					=> "Tamam",
            "addNewProduct" 				=> "Yeni Ürünü Ekle",
            "finishUpload" 				=> "Yüklemeyi Bitir",
            "category" 				        => "Kategori",
            "addCategory" 				=> "Kategori Ekle",
            "uploadImages" 				=> "Resim Yükle",
            "productInfs" 				=> "Ürün Bilgileri",
            "mainCategory" 				=> "Ana Kategori",
            "subCategory" 				=> "Alt Kategori",
            "refresh" 				        => "Listeyi yenile",
            "web" 				        => "Web Adresi",
            "connectedPerson" 				=> "Sorumlu Kişi",
            
            
            //Menu Names
            "menuIndex" 				=> "Anasayfa",
            "menuInvoice" 				=> "Faturalar",
            "menuCurrent" 				=> "Cari",
            "menuStock" 				=> "Ürünler",
            "menuSettings" 				=> "Ayarlar",
            "menuModules" 				=> "Modüller",
            
            //Menu Names
            "bank" 				        => "Banka",
            
            //Invoice List
            "invoiceNo" 				=> "Fatura No",
            "customer" 					=> "Müşteri",
            "bankName/providersName" 		        => "Banka/H. Sağlayıcı",
            "paidLeft" 					=> "Kalan",
            "invoiceExpiry" 				=> "Ödeme Tarihi",
            "addInvoice" 				=> "Fatura Oluştur",
            
            //Invoice Detail
            "invoiceDetail" 				=> "Fatura Detayı",
            "invoice" 					=> "Fatura",
            "amount" 					=> "Miktar",
            "tax" 					=> "Vergi",
            "subTotal" 					=> "Ara Toplam",
            "desc" 					=> "Açıklama",
            "shipping" 					=> "Kargo",
            "discount" 					=> "İndirim",
            "total" 					=> "Toplam",
            "print" 					=> "Yazdır",
            "generatePDF" 				=> "PDF olarak kaydet",
            "date" 					=> "Tarih",
            "sku" 					=> "SKU",
            "delete" 					=> "Kaldır",
            "price" 					=> "Fiyat",
            "buy" 					=> "Satın Al",
            "cartList" 					=> "Ürün Listesi",
            
            //Customers
            "discountRate" 				=> "İndirim Oranı",
            "viewProfile" 				=> "Profile Bak",
            "noGroup" 					=> "Grup Yok",
            "address" 					=> "Adres",
            "viewProfil" 				=> "Profile Bak",
            
            //Add Customers
            "customerInfs" 				=> "Müşteri Bilgileri",
            "name" 				        => "İsim",
            "surname" 				        => "Soyisim",
            "phone" 				        => "Telefon Numarası",
            "mail" 				        => "E-Posta adresi",
            "city" 				        => "Şehir",
            "country" 				        => "Ülke",
            "group" 				        => "Grup",
            
            );
            return $value[$a];
    }
}
?>
