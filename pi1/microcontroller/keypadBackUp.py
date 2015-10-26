import RPi.GPIO as io
import time 

#constans
KEYPAD = [[1,2,3],[4,5,6],[7,8,9],["*",0,"#"]]
COLUMNS = [10,11,12]
ROWS = [3,5,7,8]

#variables
countDigits = 0

def checkKey(row, column):
    io.setup(ROWS[row], io.IN)
    if not io.input(ROWS[row]):
        print KEYPAD[row][column]
    io.setup(ROWS[row], io.OUT)
    return

def checkRows(column):
    if column == 0:
        for i in range(0,4):
            checkKey(i, column)
    elif column == 1:
        for i in range(0,4):
            checkKey(i, column)
    elif column == 2:
        for i in range(0,4):
            checkKey(i, column)
    return

#main program
io.setmode(io.BOARD)
io.setwarnings(False)

#setting up pins
for i in range(0,3):
    io.setup(COLUMNS[i], io.OUT)
    io.output(COLUMNS[i], True)

for i in range(0,4):
    io.setup(ROWS[i], io.OUT)
    io.output(ROWS[i], True)

while True:
    for i in range(0,3):
        io.output(COLUMNS[i], False)
        checkRows(i)
        io.output(COLUMNS[i], True)
        time.sleep(0.1)
