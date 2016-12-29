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
            "notEmail" 				         => "Geçersiz E-Posta adresi",
            "cantBlank" 			         => "Bu alan boş olamaz!",
            "validatePassword" 			        => "Şifreniz 5-20 karakter arasında olmalıdır",
            
            //Page names
            "mainPage" 					=> "Anasayfa",
            
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
            
            //Title of name
            "title_name" 				=> "Sayın",
            
            
            //Pagination
            "previous" 					=> "Önceki",
            "next" 					=> "Sonraki",
            
            //Menu Names
            "menuIndex" 				=> "Anasayfa",
            "menuInvoice" 				=> "Faturalar",
            "menuCurrent" 				=> "Cari",
            "menuStock" 				=> "Ürünler",
            "menuSettings" 				=> "Ayarlar",
            "menuModules" 				=> "Modüller",
            
            //Invoice List
            "invoiceNo" 				=> "Fatura No",
            "customer" 					=> "Müşteri",
            "bankName/providersName" 		        => "Banka/H. Sağlayıcı",
            "paidLeft" 					=> "Kalan",
            "invoiceExpiry" 				=> "Vade",
            "addInvoice" 				=> "Fatura Oluştur",
            
            //Invoice Detail
            "invoiceDetail" 				=> "Fatura Detayı",
            "invoice" 					=> "Fatura",
            "amount" 					=> "Miktar",
            "product" 					=> "Ürün",
            "tax" 					=> "Vergi",
            "subTotal" 					=> "Ara Toplam",
            "desc" 					=> "Açıklama",
            "due" 					=> "Vade",
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
            );
            return $value[$a];
    }
}
?>
