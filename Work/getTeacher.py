from bs4 import BeautifulSoup
import requests as req
import re
resp = req.get("https://mpt.ru/o-tekhnikume/prepodavateli/portfolio-prepodavateley/index.php")
soup = BeautifulSoup(resp.text, 'lxml')
data = list()
for p in soup.find_all('p',attrs={ "class" : "fw-b"}):
    dat = p.text.split()
    href = p.parent.parent["href"]
    teach = req.get("https://mpt.ru"+href)
    teachSoup = BeautifulSoup(teach.text, 'lxml')
    email =  teachSoup.find("span",text = re.compile('(\w+[.|\w])*@(\w+[.])*\w+'))
    if(email != None):
        email = email.text.lower().replace("email: ", "").replace("e-mail: ","")
    data.append({"name":dat[1],"secName":dat[0],"thirdName":dat[2],"email":email})  
print(data)