import shutil
import os
import cv2
from PIL import Image
import datetime
import time
import sys
import numpy as np
def change_size(read_file):
    starttime = time.time()
    image=Image.open(read_file) #读取图片 image_name应该是变量
    binary_image = image.convert('L') 
    
 
    x=binary_image.size[0]
    #print("高度x=",x)
    y=binary_image.size[1]
    #print("宽度y=",y)
    im_array = np.array(binary_image)
    #print(im_array)
    
    
    edges_x=[]
    edges_y=[]

                
    for i in range(x):
 
        for j in range(y):
 
            if im_array[j][i]>127:
                continue
             # print("横坐标",i)
             # print("纵坐标",j)
            edges_x.append(i)
            edges_y.append(j)
 
    top=min(edges_y)               
    bottom=max(edges_y)              
                    
 
    left=min(edges_x)             
    right=max(edges_x) 

    width=right-left              
    height=bottom-top            
    #print((left,top,left+width,top+height))
    pre1_picture=image.crop((left,top,left+width,top+height))       #图片截取
    pre1_picture.show()
    endtime = time.time()
    print(endtime-starttime)
    return pre1_picture   #返回图片数据

timenamefolder = str(sys.argv[1])
img_list = os.listdir('image/'+timenamefolder+'/')
i = 0
for img_file in img_list:
    shutil.move( 'image/'+timenamefolder+'/'+img_file, './')
    img = change_size(img_file)
    
    img.save(img_file)
    shutil.move( img_file, 'image/'+timenamefolder+'/')
    #os.remove(img_file)
    #print('output'+str(i)+' done!!')
    i+=1