from sqlalchemy import create_engine
from sqlalchemy import text
import pandas
import json
from decouple import config


DB_CONNECTION = config('DB_CONNECTION')
DB_HOST = config('DB_HOST')
DB_PORT = config('DB_PORT')
DB_DATABASE = config('DB_DATABASE')
DB_USERNAME = config('DB_USERNAME')
DB_PASSWORD = config('DB_PASSWORD')

DB_PARAMS=f"{DB_CONNECTION}://{DB_USERNAME}:{DB_PASSWORD}@{DB_HOST}/{DB_DATABASE}"

def get_layout_changes():
	engine = create_engine(DB_PARAMS)
	connection = engine.connect()
	
	query="""SELECT ch.*,
             CONCAT(actualKey.seatKeys,'  ',actualKey.seatName,'-',actualKey.shift) AS oldKeys,
             CONCAT(ch.newKeys,'  ', ch.newSeat,'-',ch.newShift) AS newKeys,
             CONCAT(emp.first_name,'  ',emp.last_name) AS empName
         FROM `ly_changes` as ch 
             LEFT JOIN employee AS emp on emp.id_emp=ch.id_emp
             LEFT JOIN ly_key_loans as actualKey on emp.id_emp=actualKey.id_emp    
         where DATE(ch.created_at)=(CURDATE())"""
	
	#(SELECT max(DATE(created_at)) FROM `ly_changes`)
	df = pandas.read_sql_query(query,connection)
	data = df.replace([None], [''], regex=True)
	data = data.applymap(str)
	print(data)
	engine.dispose()
	return data

