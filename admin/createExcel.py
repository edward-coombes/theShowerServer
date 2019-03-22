#!/usr/bin/env python

import xlsxwriter
import MySQLdb

workbook = xlsxwriter.Workbook('spreadsheet/theshowerapp.xlsx')
conn= MySQLdb.connect(host='localhost',user='',passwd='')
cursor = conn.cursor()
showerData = 'select * from app.showerInstance'
userData = 'select * from app.users'

cursor.execute(userData)
rows = cursor.fetchall()

worksheet = workbook.add_worksheet()
for row in rows:
    for col in range(0,len(row)):
        worksheet.write(row,col,row[i])

cursor.execute(showerData)
rows = cursor.fetchall()

worksheet = workbook.add_worksheet()

for row in rows:
    for col in range(0,len(row)):
        worksheet.write(row,col,row[i])

cursor.close()
conn.close()
workbook.close()
