<?php

namespace App\Http\Controllers\bpjs;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class antreanController extends Controller
{
    public function index()
    {
        $consid = '5140';
        $secretkey = '8wRA8A44F6';
        $userkey = '3531661b282c4997d496bf34de35871e';

        $data = [
            'consid' => $consid,
            'secretkey' => $secretkey,
            'userkey' => $userkey,
        ];

        // $show = Carbon::parse('1681350840000')->isoFormat('DD MM YYYY');
        // print_r($show);
        // die();

        return view('pages.bpjs.antrean.index')->with('list', $data);
    }
    
    // API
    public function antreanPerTanggal($tgl)
    {
        // DEFINE SECRET VAR
        $consid = '5140';
        $secretkey = '8wRA8A44F6';
        $userkey = '3531661b282c4997d496bf34de35871e';
        $url = 'antrean/pendaftaran/tanggal/'.$tgl;

        // API to BPJS
        $result = $this->antreanGet($url);

        // DEFINE VAR INTO DECRYPTION PROGRESS
        $string = $result->response;
        $key = $consid.$secretkey.$this->bpjsTimestamp();

        // RESULT DECRYPT WITH AES 256 (mode CBC) - SHA256 AND DECOMPRESSION WITH LZ-STRING
        $data = json_decode($this->stringDecrypt($key, $string));

        return response()->json($data, 200);
    }

    public function taskidPasien($kdbook) // Get Task ID Pasien
    {
        // DEFINE SECRET VAR
        $consid = '5140';
        $secretkey = '8wRA8A44F6';
        $userkey = '3531661b282c4997d496bf34de35871e';
        $url = 'antrean/getlisttask';

        // API to BPJS
        $result = $this->antreanPost($url, $kdbook);

        // DEFINE VAR INTO DECRYPTION PROGRESS
        $string = $result->response;
        $key = $consid.$secretkey.$this->bpjsTimestamp();

        // RESULT DECRYPT WITH AES 256 (mode CBC) - SHA256 AND DECOMPRESSION WITH LZ-STRING
        $data = json_decode($this->stringDecrypt($key, $string));

        return response()->json($data, 200);
    }

    public function refPoli()
    {
        // DEFINE SECRET VAR
        $consid = '5140';
        $secretkey = '8wRA8A44F6';
        $userkey = '3531661b282c4997d496bf34de35871e';
        $url = 'ref/poli';

        // API to BPJS
        $result = $this->antreanGet($url);

        // DEFINE VAR INTO DECRYPTION PROGRESS
        $string = $result->response;
        $key = $consid.$secretkey.$this->bpjsTimestamp();

        // RESULT DECRYPT WITH AES 256 (mode CBC) - SHA256 AND DECOMPRESSION WITH LZ-STRING
        $getDecryption = $this->stringDecrypt($key, $string);

        $data = [
            // 'metacode' => $result->metaData->code,
            // 'metamessage' => $result->metaData->message,
            'response' => $getDecryption
        ];

        return response()->json($data, 200);
    }
    
    public function taskStatus()
    {
        // DEFINE SECRET VAR
        $consid = '5140';
        $secretkey = '8wRA8A44F6';
        $userkey = '3531661b282c4997d496bf34de35871e';
        $url = 'antrean/getlisttask';
        $kdbook = '039401022023029';

        // API to BPJS
        $result = $this->antreanPost($url, $kdbook);

        // DEFINE VAR INTO DECRYPTION PROGRESS
        $string = $result->response;
        $key = $consid.$secretkey.$this->bpjsTimestamp();
        // print_r($string);
        // die();

        // RESULT DECRYPT WITH AES 256 (mode CBC) - SHA256 AND DECOMPRESSION WITH LZ-STRING
        $getDecryption = $this->stringDecrypt($key, $string);

        $data = [
            // 'metacode' => $result->metaData->code,
            // 'metamessage' => $result->metaData->message,
            'response' => $getDecryption
        ];

        return response()->json($data, 200);
    }
    
    public function belumDilayani()
    {
        // DEFINE SECRET VAR
        $consid = '5140';
        $secretkey = '8wRA8A44F6';
        $userkey = '3531661b282c4997d496bf34de35871e';
        $url = 'antrean/pendaftaran/aktif';

        // API to BPJS
        $result = $this->antreanGet($url);

        // DEFINE VAR INTO DECRYPTION PROGRESS
        $string = $result->response;
        $key = $consid.$secretkey.$this->bpjsTimestamp();

        // RESULT DECRYPT WITH AES 256 (mode CBC) - SHA256 AND DECOMPRESSION WITH LZ-STRING
        $getDecryption = $this->stringDecrypt($key, $string);
        
        print_r($getDecryption);
        die();

        $data = [
            // 'metacode' => $result->metaData->code,
            // 'metamessage' => $result->metaData->message,
            'response' => $getDecryption
        ];

        return response()->json($data, 200);
    }

    // TOOLS BPJS -------------------------------------------------------------------------------------------------------------------------------
    public function antreanGet($url)
    {
        $consid = '5140';
        $userkey = '3531661b282c4997d496bf34de35871e';

        $client = new Client();
        $res = $client->get('https://apijkn.bpjs-kesehatan.go.id/antreanrs/'.$url, [
            'headers' => [
                'X-cons-id' => $consid,
                'X-Timestamp' => $this->bpjsTimestamp(),
                'X-Signature' => $this->generateSignature(),
                'user_key' => $userkey,
            ]
        ]);
        // RESULT API INTO JSON DECODED
        return json_decode($res->getBody());
    }

    public function antreanPost($url, $kdbook)
    {
        $consid = '5140';
        $userkey = '3531661b282c4997d496bf34de35871e';

        $client = new Client();

        $res = $client->post('https://apijkn.bpjs-kesehatan.go.id/antreanrs/'.$url, [
            'json' => [
                'kodebooking' => $kdbook
            ],
            'headers' => [
                'X-cons-id' => $consid,
                'X-Timestamp' => $this->bpjsTimestamp(),
                'X-Signature' => $this->generateSignature(),
                'user_key' => $userkey,
            ]
        ]);

        // RESULT API INTO JSON DECODED
        return json_decode($res->getBody());
    }
    
	public function generateSignature()
	{
        $consid = '5140';
        $secretkey = '8wRA8A44F6';
        $userkey = '3531661b282c4997d496bf34de35871e';

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
}
