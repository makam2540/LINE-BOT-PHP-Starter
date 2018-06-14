import requests
 
url = 'https://notify-api.line.me/api/notify'
token = 'EzgAlxIOWuvQE7ARrLvkdJclnDnkifxd0zVOgZ8DTvUm8HxrUcLcWhk9luK5+mra+zFZ7FrYjjbrFvQw84+Axi+P1zWPnxSCTl/lF5gVTDYBjp+XEJ8EjeyUYVhuvRlTscnsKgQN+zlfy+lk8jL9ywdB04t89/1O/w1cDnyilFU=
'


headers = {'content-type':'application/x-www-form-urlencoded','Authorization':'Bearer '+token}
 
msg = 'สวัสดี เพจเขียนโปรแกรมยามว่าง'
r = requests.post(url, headers=headers , data = {'message':msg})
print(r.text)
