import mysql.connector
from decouple import config

# DB_CONNECTION=mysql
# DB_HOST='10.105.174.6'
# DB_PORT=3306
# DB_DATABASE='gpo_wttools'
# DB_USERNAME='layout'
# DB_PASSWORD='DJESbOUw9B11xP7R'

# DB_CONNECTION=mysql
# DB_HOST='localhost'
# DB_PORT=3306
# DB_DATABASE='laravel'
# DB_USERNAME='root'
# DB_PASSWORD=''

DB_CONNECTION = config('DB_CONNECTION')
DB_HOST = config('DB_HOST')
DB_PORT = config('DB_PORT')
DB_DATABASE = config('DB_DATABASE')
DB_USERNAME = config('DB_USERNAME')
DB_PASSWORD = config('DB_PASSWORD')


try:
    connection = mysql.connector.connect(
                                          host=DB_HOST,
                                          user=DB_USERNAME,
                                          password=DB_PASSWORD,
                                          database=DB_DATABASE   
                                        )
    cursor = connection.cursor()

except mysql.connector.Error as err:
    err.log('Database connection failed')
    exit()

def select_parameter(admin):
    results = executequery("""SELECT distinct(region) FROM `All_Admins`
                               WHERE admin_l1_display_name=%(admin1)s""",
                               True,{'admin1':admin})
    print(results[0])
    return results[0]    

def select_all():
    results = executequery("""SELECT ch.*,
             CONCAT(actualKey.seatKeys,'  ',actualKey.seatName,'-',actualKey.shift) AS oldKeys,
             CONCAT(ch.newKeys,'  ', ch.newSeat,'-',ch.newShift) AS newKeys,
             CONCAT(emp.first_name,'  ',emp.last_name) AS empName
         FROM `ly_changes` as ch 
             LEFT JOIN employee AS emp on emp.id_emp=ch.id_emp
             LEFT JOIN ly_key_loans as actualKey on emp.id_emp=actualKey.id_emp    
         where DATE(ch.created_at)=(SELECT max(DATE(created_at)) FROM `ly_changes`)""")
    admins = []
    for x in results:
      admins.append(x[0])
    return results
    
def update_parameters(id_emp,seatkeys,seat,shift):
    results = executequery("""UPDATE `ly_key_loans` SET `seatKeys` = %s,`seatName` = %s, `shift` = %s ,`keyReturned` =1 WHERE `ly_key_loans`.`id_emp` = %s""",
                         False,(str(seatkeys),str(seat),str(shift),str(id_emp)),True)
    return results

def insert_parameters(admin):
    results = executequery("""SELECT distinct(admin_l3_display_name) 
                            FROM `All_Admins` 
                          WHERE admin_l2_display_name=%(admin2)s 
                            AND admin_l3_display_name<>'None' 
                          ORDER BY `All_Admins`.`admin_l3_display_name` ASC;""",
                          False,{'admin2':admin})
    admins = []
    for x in results:
      admins.append(x[0])
    return admins 

def executequery(tuple, single = False, args = {}, commit = False):
    print(args)
    cursor.execute(tuple, args)
    
    if commit == True:
        connection.commit()
        print(cursor.rowcount, "record(s) affected")
    else:
        if single == True:
            return cursor.fetchone()
        else:
            return cursor.fetchall()
        

# update_parameters('10100','1','4','N/A')