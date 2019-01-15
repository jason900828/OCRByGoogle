圖片轉文字

此光學辨識基於google API實作而成，在這裡可以直接使用

目前API權限在jason900828@gmail.com的帳號裡，可以自行設置API

# 檔案

google-ocr-credential.json、
client_id.json

這兩個檔案為記錄API權限的檔案，不能刪除

如果自行開通新的API，要更新以上兩個檔案

# 操作步驟

1.先將已經處理好的圖片上傳

2.點擊開始辨識

3.輸出結果會在txt_here/


*注意，如果圖片過於歪斜或是不清楚會導致辨識效果很差，建議圖片有做過前處理再執行辨識

# 參考資料

[Python 使用 Google 雲端硬碟 API 自動進行文字辨識教學 \- G\. T\. Wang](https://blog.gtwang.org/programming/automation-of-google-ocr-using-python-tutorial/)


# 附一些小工具

    一、Cut white edge.py：
        可以自動切除白邊，不過要跑比較久
        使用方法：
        1.將圖片放入指定路徑(./CutEdge/image/)
        2.點擊Cut white edge.py
        3.輸出一樣放在(./CutEdge/image/)
        *注意，原始檔案會刪除，如果需要保留原始檔請另存在別的地方
        *如果檔案很大，建議先用下面的Cut by length.py裁切過後再執行這個會比較快

    二、Cut by length.py：
        可以裁切成指定大小，不過要自行拿捏
        使用方法：
        1.將需要裁切的圖片放入指定路徑(./demos/image/)
        2.點擊Cut by length.py
        3.指定(x,y)座標與(寬度、高度)
        4.確認裁切的大小是否可以
        4.輸出一樣放在(./demos/image/)
        *注意，原始檔案會刪除，如果需要保留原始檔請另存在別的地方
        *注意，所有上傳的圖片皆會依照第一張的大小尺寸繼續裁切所有圖
