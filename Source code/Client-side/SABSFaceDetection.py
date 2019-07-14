import cv2
import os
import time
import pexpect

i=1;
captureFrame = cv2.VideoCapture(0);
captureFrame.set(3,256);
captureFrame.set(4,144);
path = '/home/pi/Desktop/Proyek/FaceRecog/From'
faceDetect = cv2.CascadeClassifier('haarcascade_frontalface_alt.xml');
gambar9="From/kenta.jpg"

while True:
    ret, img = captureFrame.read();
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    faces = faceDetect.detectMultiScale (gray, 1.3, 5);
    for (x,y,w,h) in faces:
        cv2.rectangle(img,(x,y),(x+w,y+h),(255,0,0),2)
        cv2.imwrite(os.path.join(path , 'kenta.jpg'), gray)
        #cv2.imwrite(os.path.join(path , 'Image'+str(i)+'.png'), gray)
        if os.path.isfile(gambar9):
            #os.system("echo rikipro123\n")
            #os.system("sudo scp -r /home/pi/Desktop/Proyek/FaceRecog/From/kenta.jpg hdusernew@192.168.43.58:/home/hdusernew/protel/currentFace")
            child = pexpect.spawn ("sudo scp -r /home/pi/Desktop/Proyek/FaceRecog/From/kenta.jpg hdusernew@192.168.43.58:/home/hdusernew/protel/currentFace")
            child.expect("hdusernew@192.168.43.58's password:")
            child.sendline("rikipro123")
            child.expect(pexpect.EOF, timeout=10)
            os.remove(gambar9)
        time.sleep(3)
    cv2.imshow("Window Face Recognition", gray);
    if(cv2.waitKey(1)==ord('q')):
        break
captureFrame.release()
cv2.destroyAllWindows()
   
    
    