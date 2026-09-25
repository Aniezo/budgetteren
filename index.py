import mysql.connector

try:

mydb = mysql.connector.connect(
host ="localhost"
user = "aniez"
password = "aniez"
database = "budgetteren"
)
mycursor = mydb.cursor

mycursor.excecute("SELECT inkomsten, uitgaven, vaste lasten FROM budget")

myresult = mycursor.fetchall()

print  ("---")