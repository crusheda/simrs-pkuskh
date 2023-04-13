<?php

namespace App\Http\Controllers\bpjs;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class bpjsController extends Controller
{
    public CONST ENCRYPT_METHOD = 'AES-256-CBC';

    public function index()
    {
        $consid = env('BPJS_CONSID');
        $secretkey = env('BPJS_SCREET_KEY');
        $userkey = env('BPJS_USER_KEY_VCLAIM');
        $baseurlvclaim = env('BPJS_URL_VCLAIM');

            // Computes the timestamp
            $tStamp = $this->bpjsTimestamp();
            $signature = $this->generateSignature();

        $data = [
            'consid' => $consid,
            'secretkey' => $secretkey,
            'userkey' => $userkey,
            'baseurlvclaim' => $baseurlvclaim,
            'timestamp' => $tStamp,
            'signature' => $signature,
        ];

        // return view('pages.bpjs.bridging');
        return view('pages.bpjs.bridging')->with('list', $data);
    }

    public function vclaimRefDiagnosa()
    {
        // DEFINE SECRET VAR
        $consid = env('BPJS_CONSID');
        $secretkey = env('BPJS_SCREET_KEY');
        $userkey = env('BPJS_USER_KEY_VCLAIM');

        // API to BPJS
        // $result = $this->vclaimGet($url);
        $client = new Client();
        $res = $client->get('https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/referensi/diagnosa/A04', [
            'http_errors' => true, 'headers' => [
                'X-cons-id' => $consid,
                'X-Timestamp' => $this->bpjsTimestamp(),
                'X-Signature' => $this->generateSignature(),
                'user_key' => $userkey,
            ]
        ]);
        // RESULT API INTO JSON DECODED
        print_r($res->getBody());
        die();
        $result = json_decode($res->getBody());

        // DEFINE VAR INTO DECRYPTION PROGRESS
        $string = $result->response;
        $key = $consid.$secretkey.$this->bpjsTimestamp();

        // RESULT DECRYPT WITH AES 256 (mode CBC) - SHA256 AND DECOMPRESSION WITH LZ-STRING
        $getDecryption = $this->stringDecrypt($key, $string);
        
        $data = [
            'metacode' => $result->metaData->code,
            'metamessage' => $result->metaData->message,
            'response' => $getDecryption
        ];

        return response()->json($data, 200);
    }

    public function antreanRefPoli()
    {
        // DEFINE SECRET VAR
        $consid = env('BPJS_CONSID');
        $secretkey = env('BPJS_SCREET_KEY');
        $userkey = env('BPJS_USER_KEY_VCLAIM');
        $url = 'ref/poli';

        // API to BPJS
        // $result = $this->antreanGet($url);
        $client = new Client();
        $res = $client->get('https://apijkn.bpjs-kesehatan.go.id/antreanrs/'.$url, [
            'headers' => [
                'X-cons-id' => env('BPJS_CONSID'),
                'X-Timestamp' => $this->bpjsTimestamp(),
                'X-Signature' => $this->generateSignature(),
                'user_key' => env('BPJS_USER_KEY_VCLAIM'),
            ]
        ]);
        // RESULT API INTO JSON DECODED
        $result = json_decode($res->getBody());
        // print_r($result);
        // die();

        // DEFINE VAR INTO DECRYPTION PROGRESS
        $string = $result->response;
        $key = $consid.$secretkey.$this->bpjsTimestamp();

        // RESULT DECRYPT WITH AES 256 (mode CBC) - SHA256 AND DECOMPRESSION WITH LZ-STRING
        $getDecryption = $this->stringDecrypt($key, $string);
        
        $data = [
            'metacode' => $result->metaData->code,
            'metamessage' => $result->metaData->message,
            'response' => $getDecryption
        ];

        return response()->json($data, 200);
    }

    // TOOLS BPJS
    public function vclaimGet($url)
    {
        $client = new Client();
        $res = $client->get('https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/'.$url, [
            'headers' => [
                'X-cons-id' => env('BPJS_CONSID'),
                'X-Timestamp' => $this->bpjsTimestamp(),
                'X-Signature' => $this->generateSignature(),
                'user_key' => env('BPJS_USER_KEY_VCLAIM'),
            ]
        ]);
        // RESULT API INTO JSON DECODED
        return json_decode($res->getBody());
    }

    public function antreanGet($url)
    {
        $client = new Client();
        $res = $client->get('https://apijkn.bpjs-kesehatan.go.id/antreanrs/'.$url, [
            'headers' => [
                'X-cons-id' => env('BPJS_CONSID'),
                'X-Timestamp' => $this->bpjsTimestamp(),
                'X-Signature' => $this->generateSignature(),
                'user_key' => env('BPJS_USER_KEY_VCLAIM'),
            ]
        ]);
        // RESULT API INTO JSON DECODED
        return json_decode($res->getBody());
    }

	public function generateSignature()
	{
        $consid = env('BPJS_CONSID');
        $secretkey = env('BPJS_SCREET_KEY');
        $userkey = env('BPJS_USER_KEY_VCLAIM');
        $baseurlvclaim = env('BPJS_URL_VCLAIM');

        // Get Timestamp
        date_default_timezone_set('UTC');
        $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));

        // Computes the signature by hashing the salt with the secret key as the key
        $signature = hash_hmac('sha256', $consid."&".$tStamp, $secretkey, true);
        
        // base64 encode�
        $encodedSignature = base64_encode($signature);

		return $encodedSignature;
	}
    
	public function bpjsTimestamp()
	{
        // Computes the timestamp
        date_default_timezone_set('UTC');
        $result = strval(time()-strtotime('1970-01-01 00:00:00'));
		return $result;
	}

	public static function stringDecrypt($key, $string)
	{
		$encrtyp_method = 'AES-256-CBC';

        $key_hash = hex2bin(hash('sha256', $key));

        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

        $dekripsi = openssl_decrypt(base64_decode($string), $encrtyp_method, $key_hash, OPENSSL_RAW_DATA, $iv);

        $decompress = \LZCompressor\LZString::decompressFromEncodedURIComponent($dekripsi);

        return $decompress;
	}
    
	// public function decompressed()
	// {
	// 	$string = "e0GidhtXDQLftE2O2PXx6IFbJxAWc36xyOihLSNDdGyLSIuvSbWIomLRNWmLBTsCaDTgcT8cP7tzSdokmQFZE27SmOQhzVOrVVCdCY69NGKP9sGWxsD3VKIM25gz7KKeii17z2Gy8ViiQqo0Rbl6UWHmYsPIYcFrWDNzxsh2TnyuX1mQsMDxLjReDCj2sMMnJeFlZBI\/ntW6c9DaSwv88ZwRd06ydlXLmk\/9WBIWG2QJPpAB7ck2rVm4Dt3pK29oZKOkt\/w\/tjnkG1uSaLpCLyZd1ePHT\/f9m7i\/U9\/4M2XIpN4Kv4EJiNSAuReEZpZxKSniQCUq8EU4Ehq\/rB1Gsiy6vQ6h0+fVRFTBKcisQNrwf2Jr1S6baCDR8oYKWwXYNZJsBRJhb2CDDWcc0JAy3qnc9gmbL3biHdMAue5y55sfJTuF7B9AshKX\/+Ke6kTVoL7TtEDIzFTWqphwLyOx17iY8PetIhQJTKUIphpkfja3qUp+LvNRMqey4MA++9r5ebzLaF0E+sSoKN4NPnwZbIitohUtIs1dtZNr5qIezLPui\/PJXWL6zIp1hDSKVeNJQAE5T+626Ae6ajexqHKiN9wQ4S2REkSsuxRTHMT1TFqkP55r\/ZuLy3Xs7tTo7zaY8+xhiswD5PyqUBOzWFGNdKLJbQmzc4\/N4WjdmoXXzECOGT1agzyKuwfARcZGVef0";
	// 	$string1 = "DJW11EJGblMxoxnrpJGyX5iqw0A92fWHw8pWytjby4SNfU2ijr5tgNi1aNlMYf6vudDchoW4BLSLpkeDTh59SlS51LwOw88+YIdSGlL8Jo90vBiXoZDXD8jPcuuOGLIBSxP6xijU/rM89HRnXnv96Ap6p96mcTpPwPexB3MGiaOLvAww1QMk77IVoYPQ/DNF9+qAp8+fJb9QFbRzXYQ29nkzAh3m/N9q8X9evgOv/Jn/4oa330U14+x/sK4Dvrza5+pIJZAv8IILi2J4MXvGfc0YyKtn3jmvRJpbFnJ13UY8QG90pImJwCcFwdxXyC/VQ47ReHo14RukZ10vgX3frAi+vwYMi5Nr5yc+jUv/OS0Yl+7nFOdE2oKi6yfe9TdxEUG3R8dplsuhs1T12AwJBXTPZ8vI2qBTq5N9jsSW8NM=";
	// 	$key1 = "11895rsk24t0n1640762772";
	// 	$key = "11895rsk24t0n". GenerateBpjs::bpjsTimestamp();
	// 	$data = GenerateBpjs::decompress(GenerateBpjs::stringDecrypt($key1, $string1));
	// 	return response($data);
	// }
}
