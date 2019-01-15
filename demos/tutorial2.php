<!DOCTYPE html>
<html lang="en">
<head>
  <title>切圖工具 by Jcrop</title>
  
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery.Jcrop.js"></script>
<script type="text/javascript">


  jQuery(function($){

    var jcrop_api;

    $('#target').Jcrop({
      onChange:   showCoords,
      onSelect:   showCoords,
      onRelease:  clearCoords
    },function(){
      jcrop_api = this;
    });

    $('#coords').on('change','input',function(e){
      var x1 = $('#x1').val(),
          x2 = $('#x2').val(),
          y1 = $('#y1').val(),
          y2 = $('#y2').val();
      jcrop_api.setSelect([x1,y1,x2,y2]);
    });

  });

  // Simple event handler, called from onChange and onSelect
  // event handlers, as per the Jcrop invocation above
  function showCoords(c)
  {
    $('#x1').val(c.x);
    $('#y1').val(c.y);
    $('#x2').val(c.x2);
    $('#y2').val(c.y2);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

  function clearCoords()
  {
    $('#coords input').val('');
  };
  
  function submit_img(){
    var x1_n = $('#x1').val();
    var y1_n = $('#y1').val();
    var x2_n = $('#x2').val();
    var y2_n = $('#y2').val();
    var w_n = $('#w').val();
    var h_n = $('#h').val();
    var timenamefolder = $('#timenamefolder').val();
    var url = 'cut_img.php?x1='+x1_n.toString()+'&y1='+y1_n.toString()+'&w='+w_n.toString()+'&h='+h_n.toString()+'&timenamefolder='+timenamefolder.toString();
    $.get(url, function(data){
       $('#download').html(data);
    });

  }
   function getFileNumber(){
    
    var fileNumber=document.getElementById("inputGroupFile03").files.length;
    //var fileName = filePath.substring(filePath.lastIndexOf('\\')+1);
    $('#inputGroupFile03label').text('共上傳 '+fileNumber+' 個檔案');
   }
</script>
<link rel="stylesheet" href="demo_files/main.css" type="text/css" />
<link rel="stylesheet" href="demo_files/demos.css" type="text/css" />
<link rel="stylesheet" href="../css/jquery.Jcrop.css" type="text/css" />

</head>
<body>



<input type="text" id='timenamefolder' value="<?php echo $_GET['timenamefolder'];?>"style='display:none' >
<div class="container">
<div class="row">
<div class="span12">
<div class="jc-demo-box">

<div class="page-header">
<ul class="breadcrumb first">
  <li><a href="../index.html">首頁</a> <span class="divider">/</span></li>
  <li><a href="../CutEdge/index.html">自動切白邊</a> <span class="divider">/</span></li>
  <li class="active">手動切圖</li>
</ul>
<h1>切圖工具 by Jcrop</h1>

</div>

  <!-- This is the image we're attaching Jcrop to -->
  <img src='<?php echo $_GET['img_index'];?>' id="target"  />

  <!-- This is the form that our event handler fills -->
  <form id="coords"
    class="coords"
    onsubmit="return false;"
    action="http://example.com/post.php">

    <div class="inline-labels">
    <label>X1 <input type="text" size="4" id="x1" name="x1" /></label>
    <label>Y1 <input type="text" size="4" id="y1" name="y1" /></label>
    <label>X2 <input type="text" size="4" id="x2" name="x2" /></label>
    <label>Y2 <input type="text" size="4" id="y2" name="y2" /></label>
    <label>W <input type="text" size="4" id="w" name="w" /></label>
    <label>H <input type="text" size="4" id="h" name="h" /></label>
    <button type="button" class="btn btn-danger" id='cut_img' onclick="submit_img()">切割</button>
    </div>
    
  </form >
  <form action='upload_img.php' name="form2" id = 'uploadform' method ="POST" enctype ="multipart/form-data">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <button class="btn btn-outline-secondary" type="submit">上傳</button>
      </div>
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="inputGroupFile03" name='img[]' multiple onchange='getFileNumber();'>
        <label class="custom-file-label" for="inputGroupFile03" id='inputGroupFile03label'>選擇檔案</label>
      </div>
    </div>
  </form>
  <div id='download'></div>
  <div class="description">
  <p>
    <b>An example with a basic event handler.</b> Here we've tied
    several form values together with a simple event handler invocation.
    The result is that the form values are updated in real-time as
    the selection is changed using Jcrop's <em>onChange</em> handler.
  </p>

  <p>
    That's how easily Jcrop can be integrated into a traditional web form!
  </p>
  </div>


<div class="tapmodo-footer">
  <a href="http://tapmodo.com" class="tapmodo-logo segment">tapmodo.com</a>
  <div class="segment"><b>&copy; 2008-2013 Tapmodo Interactive LLC</b><br />
    Jcrop is free software released under <a href="../MIT-LICENSE.txt">MIT License</a>
  </div>
</div>

<div class="clearfix"></div>

</div>
</div>
</div>
</div>

</body>
</html>

