import cv2
import numpy as np
faceDetect = cv2.CascadeClassifier('haarcascade_frontalface_alt.xml');
captureFrame = cv2.VideoCapture(0);
id = raw_input('Masukkan ID : ')
sampleNum = 0;
while(True):
    ret, img = captureFrame.read();
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    faces = faceDetect.detectMultiScale (gray, 1.3, 5);
    for (x, y, w, h) in faces:
        sampleNum = sampleNum + 1;
        cv2.imwrite("dataset/User." + str(id) + "." + str(sampleNum) + ".jpg", gray[y:y+h, x:x+w])
        cv2.rectangle(img, (x, y), (x+w, y+h), (255, 195, 0, 0),1)
        cv2.waitKey(10);
    cv2.imshow("Fetch", img);
    cv2.waitKey(1);
    if(sampleNum>=100):
        break
captureFrame.release()
cv2.destroyAllWindows()
