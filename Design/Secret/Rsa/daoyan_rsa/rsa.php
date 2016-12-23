<?php
// +----------------------------------------------------------------------
// | Author: daoyan
// +----------------------------------------------------------------------
// | Date: 16/09/23 上午9:30
// +----------------------------------------------------------------------
// | Desc: rsa加密类 使用openssl实现加密
// +----------------------------------------------------------------------
namespace Common\Queue;

class Rsa
{
        /**
         * private key
         */
       private $privateKeyFilePath = 'Apps/Common/Queue/sslkey/rsa_private_key.pem';

        /**
         * public key
         */
        private $publicKeyFilePath = 'Apps/Common/Queue/sslkey/rsa_public_key.pem';

        private $_pubKey;
        private $_privKey;

        /**
         * the keys saving path
         */
        private $_keyPath;

        /**
         * the construtor,the param $path is the keys saving path
         */
        public function __construct($path)
        {
        	    $this->_keyPath = $path;
		    extension_loaded('openssl') or die('php需要openssl扩展支持');
		    (file_exists($this->privateKeyFilePath) && file_exists($this->publicKeyFilePath))
		    or die('密钥或者公钥的文件路径不正确');
        }

        /**
         * create the key pair,save the key to $this->_keyPath
         */
        public function createKey()
        {
            $r = openssl_pkey_new();
            openssl_pkey_export($r, $privKey);
            file_put_contents($this->_keyPath . DIRECTORY_SEPARATOR . 'rsa_private_key.pem', $privKey);
            $this->_privKey = openssl_pkey_get_private($privKey);

            $rp = openssl_pkey_get_details($r);
            $pubKey = $rp['key'];
            file_put_contents($this->_keyPath . DIRECTORY_SEPARATOR .  'rsa_public_key.pem', $pubKey);
            $this->_pubKey = openssl_pkey_get_public($pubKey);
        }

       /**
        * 生成Resource类型的密钥，如果密钥文件内容被破坏，openssl_pkey_get_private函数返回false
        */
        public function setupPrivKey()
        {
            $privateKey = openssl_pkey_get_private(file_get_contents($this->privateKeyFilePath));
            if (!$privateKey) {
                die('密钥不可用');
            }
            $this->_privKey = $privateKey;
        }

       /**
        * 生成Resource类型的公钥，如果公钥文件内容被破坏，openssl_pkey_get_public函数返回false
        */
        public function setupPubKey()
        {
            $publicKey = openssl_pkey_get_public(file_get_contents($this->publicKeyFilePath));
            if (!$publicKey) {
                die('公钥不可用');
            }
            $this->_pubKey = $publicKey;
        }
        /**
         * 密钥加密
         */
        public function privEncrypt($data)
        {
            if(!is_string($data)){
                return null;
            }

            $this->setupPrivKey();
            $r = openssl_private_encrypt($data, $encrypted, $this->_privKey);
            if($r){
                return base64_encode($encrypted);
            }
            return null;
        }

        /**
         * 密钥解密
         */
        public function privDecrypt($encrypted)
        {
            if(!is_string($encrypted)){
                return null;
            }

            $this->setupPrivKey();

            $encrypted = base64_decode($encrypted);

            $r = openssl_private_decrypt($encrypted, $decrypted, $this->_privKey);
            if($r){
                return $decrypted;
            }
            return null;
        }

        /**
         * 公钥加密
         */
        public function pubEncrypt($data)
        {
            if(!is_string($data)){
                return null;
            }

            $this->setupPubKey();

            $r = openssl_public_encrypt($data, $encrypted, $this->_pubKey);
            if($r){
                return base64_encode($encrypted);
            }
            return null;
        }

        /**
         * 公钥解密
         */
        public function pubDecrypt($crypted)
        {
            if(!is_string($crypted)){
                return null;
            }

            $this->setupPubKey();

            $crypted = base64_decode($crypted);

            $r = openssl_public_decrypt($crypted, $decrypted, $this->_pubKey);
            if($r){
                return $decrypted;
            }
            return null;
        }

        public function __destruct()
        {
            @ fclose($this->_privKey);
            @ fclose($this->_pubKey);
        }

}