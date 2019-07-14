import cv2
import numpy as np
import MySQLdb
import os.path
import time
def getProfile(id):
    db = MySQLdb.connect(user='root', passwd='', host='127.0.0.1',db='protel')
    sql = "SELECT * FROM tb_user WHERE ID="+str(id)
    cursor = db.cursor()
    cursor.execute(sql);
    db.commit()
    profile = None
    for row in cursor:
        profile = row
    db.close()
    return profile
#load file haarcascade, and save it to variable "faceDetect"
while (True):
    if os.path.isfile("currentFace/kenta.jpg"):
        faceDetect = cv2.CascadeClassifier('haarcascade_frontalface_alt.xml');
        captureFrame = cv2.imread("currentFace/kenta.jpg");
        recognizer = cv2.face.LBPHFaceRecognizer_create();
        recognizer.read("filerecognizer//trainning.yml")
        f = open("final.txt", "w")
        fa = open("final.txt", "w")
        id = 0;
        fontface = cv2.FONT_HERSHEY_SIMPLEX
        img = captureFrame;
        gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
        faces = faceDetect.detectMultiScale(gray, 1.3, 5);
        print "faces = faceDetect.detectMultiScale(gray, 1.3, 5)"
        for (x, y, w, h) in faces:
            cv2.rectangle(img, (x, y), (x+w, y+h), (255, 195, 0, 0),1)
            id, conf = recognizer.predict(gray[y:y+h, x:x+w])
            print "id,conf=recognizer.predict(gray[y:y+h, x:x+w])"
            profile = getProfile(id)
            if(profile!=None):
                cv2.putText(img, str(profile[1])+"--"+str(conf), (x+5,y-5), fontface, 1, (255,255,255), 2)
                f.write(str(profile[2])+"\n")
                print "f.write(str(profile[2])"
            else:
                print "Not found"
        f.close()
        print "Ada"
        time.sleep(25)
        fa.truncate(0)
        fa.close()
        os.remove("currentFace/kenta.jpg");
    else:
        print "Standby menunggu image dari client"
captureFrame.release()
cv2.destroyAllWindows()
