import MySQLdb

db = MySQLdb.connect(host="localhost", user="deepd", passwd="", db="c9")
cur = db.cursor()
cur.execute("create table mytable(Year varchar(255), Length varchar(255), Title varchar(255), Subject varchar(255), Actor varchar(255),"\
            "Actress varchar(255), Director varchar(255) , Popularity varchar(255), Awards varchar(255), ID int not null auto_increment primary key)")
cur.execute("create table myplan(Year varchar(255), Length varchar(255), Title varchar(255),"\
            "Subject varchar(255), Actor varchar(255), Actress varchar(255), Director varchar(255) , Popularity varchar(255), Awards varchar(255),"\
            "ID int primary key, FOREIGN KEY (ID) REFERENCES mytable(ID))")
f = open('newfilm-final.csv')
for line in f.readlines():
    cur.execute("insert into mytable values(%s" % line+", NULL)")
db.commit()