#! python3
# coding=UTF-8

from __future__ import print_function
import httplib2
import os
import io
from os import listdir
from apiclient import discovery
from oauth2client import client
from oauth2client import tools
from oauth2client.file import Storage
from apiclient.http import MediaFileUpload, MediaIoBaseDownload
import json
try:
    import argparse
    flags = argparse.ArgumentParser(parents=[tools.argparser]).parse_args()
except ImportError:
    flags = None

SCOPES = 'https://www.googleapis.com/auth/drive'
CLIENT_SECRET_FILE = 'client_id.json'
APPLICATION_NAME = 'Python OCR'

def get_credentials():
    #取得有效的憑證
    #若沒有憑證，或是已儲存的憑證無效，就會自動取得新憑證

    #傳回值：取得的憑證
  
    credential_path = os.path.join("./", 'google-ocr-credential.json')
    store = Storage(credential_path)
    credentials = store.get()
    if not credentials or credentials.invalid:
        flow = client.flow_from_clientsecrets(CLIENT_SECRET_FILE, SCOPES)
        flow.user_agent = APPLICATION_NAME
        if flags:
            credentials = tools.run_flow(flow, store, flags)
        else: # Needed only for compatibility with Python 2.6
            credentials = tools.run(flow, store)
        print('憑證儲存於：' + credential_path)
    return credentials

def main(input_image_name,txtfile_name):

  # 取得憑證、認證、建立 Google 雲端硬碟 API 服務物件
    credentials = get_credentials()
    http = credentials.authorize(httplib2.Http())
    service = discovery.build('drive', 'v3', http=http)

  # 包含文字內容的圖片檔案（png、jpg、bmp、gif、pdf）
    imgfile = input_image_name

  # 輸出辨識結果的文字檔案
    txtfile = txtfile_name
 
  # 上傳成 Google 文件檔，讓 Google 雲端硬碟自動辨識文字
    mime = 'application/vnd.google-apps.document'
    res = service.files().create(
        body={
          'name': imgfile,
          'mimeType': mime
        },
        media_body=MediaFileUpload(imgfile, mimetype=mime, resumable=True)
    ).execute()

  # 下載辨識結果，儲存為文字檔案
    downloader = MediaIoBaseDownload(
        io.FileIO(txtfile, 'wb'),
        service.files().export_media(fileId=res['id'], mimeType="text/plain")
    )
    done = False
    while done is False:
        status, done = downloader.next_chunk()

    # 刪除剛剛上傳的 Google 文件檔案
    service.files().delete(fileId=res['id']).execute()

if __name__ == '__main__':
    f = open('path_number.json','r',encoding='utf-8')
    jsondata = json.loads(f.read())
    timenamefolder = jsondata['path']
    img_list =listdir("image_here/"+timenamefolder+"/")
    
    if not(os.path.isdir("txt_here/")):
        os.mkdir("txt_here/")
    if not(os.path.isdir("txt_here/"+timenamefolder+"/")):
        os.mkdir("txt_here/"+timenamefolder+"/")
    
    for i in range(len(img_list)):
        #print(int(100*i/len(img_list)),end = '\r')
        a = img_list[i].rfind('.')
        txt_name = img_list[i][:a]
        main("image_here/"+timenamefolder+"/"+img_list[i].lower(),"txt_here/"+timenamefolder+"/"+txt_name+'.txt')