import requests
from decouple import config
import json

from connection import get_employees

AUTHORIZATION = config('AUTHORIZATION')
WEBEX_PEOPLE_INFO = config('WEBEX_PEOPLE_INFO')

def call_webex_api(email):
    url = f"{WEBEX_PEOPLE_INFO}?email={email}&callingData=true"
    payload={}
    headers = {
      'Authorization': AUTHORIZATION
    }
    response = requests.request("GET", url,verify=False, headers=headers, data=payload)
    
    return response


def employees():
    employee=get_employees()
    
    for row in employee:
        resp=call_webex_api(row[3])
        resp.text
        res = json.loads(resp.text)
        print(res['items'][0]['avatar'])
employees()