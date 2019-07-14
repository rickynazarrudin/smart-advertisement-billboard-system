from pyhive import hive
import time
import MySQLdb

def get_sql(substitution="${hiveconf:AGE}"):
    sql = "SELECT keyword, COUNT(keyword) as fac FROM tb_datalogtrue WHERE ip = '{variable}' GROUP BY keyword ORDER BY fac DESC LIMIT 1"
    sql = sql.format(variable=substitution)
    return sql
status = "OK"

while 1:
    f = open("final.txt", "r+")
    disp = open("output.txt", "w")
    lines = f.read()
    lines = lines.strip('\n')
    if not lines:
        print ("Standby")
    else:
        start_time = time.time()
        flag = 0
        db = MySQLdb.connect(user='root', passwd='', host='127.0.0.1',db='protel')
        print("MySQL Already connected!")
        conn = hive.Connection(host="localhost", port=10000, database="protel")
        print("HadoopHive Already connected!")
        print("Analyzing datasets")
        cursor = conn.cursor()
        cur = db.cursor()
        cursor.execute(get_sql(lines))
        # print(get_sql(lines))
        result = cursor.fetchone()
        for row in result:
            flag += 1
            # print("Masuk perulangan result")
            if flag > 1:
                break
            else:
                disp.write("%s\n" % str(row))
                try:
                    cur.execute("INSERT INTO tb_image (name,dummy) VALUES (%s,%s)",(row,status))
                    db.commit()
                    print("Displaying Advertisement")
                    time.sleep(30)
                    cur.execute("DELETE FROM tb_image WHERE name=%s AND dummy=%s",(row,status))
                    db.commit()
                except Exception as e:
                    db.rollback()
        disp.close()
        # print(get_sql(lines))
        # print(result)
        print("Save the result to Localdirectory")
        print("--- %s seconds ---" % (time.time() - start_time))
        print("\n\n")
        db.close()
        f.truncate(0)
#disp.write(result)
