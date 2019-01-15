#! python3
# coding=UTF-8

##會有順序問題
import os
from os import listdir
import shutil
from PIL import Image
import sys


def image_cut(img_file,x,y,w,h):
    
    img = Image.open(img_file)
    # 裁切區域的 x 與 y 座標（左上角）
    
    crop_img = img.crop((x,y,x+w,y+h))
    return  crop_img

timenamefolder = str(sys.argv[1])
img_list =listdir("./image/"+timenamefolder+'/')

x = int(sys.argv[2])
y = int(sys.argv[3])
w = int(sys.argv[4])
h = int(sys.argv[5])
 

for imgfile in img_list:
    shutil.move("./image/"+timenamefolder+'/'+imgfile,'./')
    crop_img = image_cut(imgfile,x,y,w,h)
    crop_img.save(imgfile)
    shutil.move(imgfile,"./image/"+timenamefolder+'/')
    
    