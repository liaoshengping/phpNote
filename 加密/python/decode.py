# pip install pycryptodome

from Crypto.Cipher import AES
from Crypto.Util.Padding import pad, unpad
from Crypto.Random import get_random_bytes
import base64

# 密钥和IV应该是16字节长（对于AES-128）
key = '1234567891234567'.encode('utf-8')
iv = '1234567891234567'.encode('utf-8')

# 将加密后的二进制数据转换为Base64编码的字符串，以便于存储或传输
ciphertext_base64 = 'wyJy7dTITM1EBaQzVmT+lw=='

# 解密过程
# 首先，将Base64编码的字符串解码回二进制数据
ciphertext_bin = base64.b64decode(ciphertext_base64)

# 创建另一个AES cipher对象用于解密，使用相同的密钥和IV
decipher = AES.new(key, AES.MODE_CBC, iv)

# 解密数据
decryptedtext_padded = decipher.decrypt(ciphertext_bin)
decryptedtext = unpad(decryptedtext_padded, AES.block_size)

# 输出解密后的原始数据
print("解密后的数据:", decryptedtext.decode('utf-8'))

