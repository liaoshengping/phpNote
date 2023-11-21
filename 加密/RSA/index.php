<?php
// 使用sha256withrsa算法进行数字签名
// 生成RSA密钥对
$keyPair = openssl_pkey_new(array(
    'private_key_bits' => 2048,
    'private_key_type' => OPENSSL_KEYTYPE_RSA
));
openssl_pkey_export($keyPair, $privateKey);
$publicKey = openssl_pkey_get_details($keyPair)['key'];

// 要签名的消息
$message = "Hello, World!";
// 对消息进行散列
$hash = hash('sha256', $message, true);
// 使用私钥进行加密，生成数字签名
openssl_sign($hash, $signature, $privateKey, OPENSSL_ALGO_SHA256);
// 将消息、数字签名和公钥一起发送给对方
$data = array(
    'message' => $message,
    'signature' => base64_encode($signature),
    'public_key' => $publicKey
);
// 对方接收到数据后进行验证
$message = $data['message'];
$signature = base64_decode($data['signature']);
$publicKey = openssl_pkey_get_public($data['public_key']);
// 使用公钥解密数字签名，并验证其有效性
$valid = openssl_verify(hash('sha256', $message, true), $signature, $publicKey, OPENSSL_ALGO_SHA256);
if ($valid === 1) {
    echo "消息的完整性和身份验证通过";
} else {
    echo "消息的完整性和身份验证失败";
}

