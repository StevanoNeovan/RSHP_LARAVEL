<?php

class AppHelpers
{
    /**
     * numberToRupiah
     * Format integer/float jadi string Rupiah (contoh: 1500000 -> "Rp 1.500.000")
     *
     * @param float|int 
     * @param bool 
     * @return string
     */
    public static function numberToRupiah($amount, $withSuffix = false): string
    {
        
        if (!is_numeric($amount)) {
            return 'Rp 0';
        }

        
        $rounded = (int) round($amount);

      
        $formatted = number_format($rounded, 0, ',', '.');

        $result = 'Rp ' . $formatted;
        if ($withSuffix) {
            $result .= ',-';
        }

        return $result;
    }

    /**
     * rupiahToNumber
     * Konversi string Rupiah (misal "Rp 1.500.000", "1.500.000", "Rp1.500.000,-") ke integer (1500000)
     *
     * @param string 
     * @return int
     */
    public static function rupiahToNumber(string $rupiahString): int
    {
        if ($rupiahString === null || $rupiahString === '') {
            return 0;
        }

       
        $s = trim($rupiahString);
        
        $s = preg_replace('/Rp/i', '', $s);
        $s = str_replace(',-', '', $s);

       
        if (strpos($s, ',') !== false) {
            $parts = explode(',', $s);
            $s = $parts[0];
        }

       
        $s = preg_replace('/[^\d\-]/', '', $s);

        if ($s === '' || $s === '-') {
            return 0;
        }

        return (int) $s;
    }

    /**
     * generateRandomString
     * Buat string acak yang aman (alphanumeric) dengan panjang tertentu
     *
     * @param int 
     * @param bool 
     * @return string
     */
    public static function generateRandomString(int $length = 16, bool $urlSafe = true): string
    {
        if ($length <= 0) {
            return '';
        }

        // karakter yang digunakan
        $chars = $urlSafe
            ? '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' // 62 char
            : '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_+=[]{}<>?,.'; // optional lebih banyak

        $maxIndex = strlen($chars) - 1;
        $result = '';

        // gunakan random_bytes untuk cryptographically secure
        $bytes = random_bytes($length);
        for ($i = 0; $i < $length; $i++) {
            $idx = ord($bytes[$i]) % ($maxIndex + 1);
            $result .= $chars[$idx];
        }

        return $result;
    }

    /**
     * get_token
     * Menghasilkan token (contoh: untuk CSRF, API key sederhana, atau token verifikasi)
     * Default 40 karakter hex (secure)
     *
     * @param int 
     * @return string
     */
    public static function get_token(int $lengthBytes = 20): string
    {
    
        return bin2hex(random_bytes($lengthBytes));
    }

    /**
     * send_msg_telegram
     * Mengirim pesan ke Telegram menggunakan Bot API
     *
     * @param string $botToken token bot (contoh: 123456:ABC-DEF...)
     * @param string|int $chatId id chat atau username (@channel)
     * @param string $message isi pesan
     * @param array $options tambahan, mis: ['parse_mode' => 'HTML', 'disable_web_page_preview' => true]
     * @return bool true jika berhasil, false jika gagal
     */
    public static function send_msg_telegram(string $botToken, $chatId, string $message, array $options = []): bool
    {
        if (empty($botToken) || empty($chatId) || $message === '') {
            return false;
        }

        $url = "https://api.telegram.org/bot" . urlencode($botToken) . "/sendMessage";

        $payload = array_merge([
            'chat_id' => $chatId,
            'text' => $message,
        ], $options);


        if (function_exists('curl_version')) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            
            $resp = curl_exec($ch);
            $err = curl_error($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($resp === false) {
               
                return false;
            }

           
            $j = json_decode($resp, true);
            if (is_array($j) && isset($j['ok']) && $j['ok'] === true) {
                return true;
            } else {
                return false;
            }
        } else {
           
            $opts = [
                'http' => [
                    'method'  => 'POST',
                    'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                    'content' => http_build_query($payload),
                    'timeout' => 10
                ]
            ];
            $context  = stream_context_create($opts);
            $resp = @file_get_contents($url, false, $context);
            if ($resp === false) {
                return false;
            }
            $j = json_decode($resp, true);
            return (is_array($j) && isset($j['ok']) && $j['ok'] === true);
        }
    }
}
