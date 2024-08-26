# pip install pycryptodome

from Crypto.Cipher import AES
from Crypto.Util.Padding import pad
from Crypto.Random import get_random_bytes
import base64




key = '1234567891234567'.encode('utf-8')
iv = '1234567891234567'.encode('utf-8')
# 要加密的原始数据
plaintext = '123'
plaintext_padded = pad(plaintext.encode('utf-8'), AES.block_size)
cipher = AES.new(key, AES.MODE_CBC, iv)
# 加密数据
ciphertext = cipher.encrypt(plaintext_padded)
# 将加密后的二进制数据转换为Base64编码的字符串，以便于存储或传输
ciphertext_base64 = base64.b64encode(ciphertext).decode('utf-8')
print("加密后的Base64字符串:", ciphertext_base64)

# wyJy7dTITM1EBaQzVmT+lw==

