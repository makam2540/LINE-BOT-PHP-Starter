import requests
 
url = 'https://notify-api.line.me/api/notify'
token = 'P2RErW0fdWNhT2gOwMcnRylymbKwS4TZ1XJFWH26Vg2'
headers = {'content-type':'application/x-www-form-urlencoded','Authorization':'Bearer '+token}
 
msg = 'สวัสดี เพจเขียนโปรแกรมยามว่าง'
r = requests.post(url, headers=headers , data = {'message':msg})
print(r.text)
